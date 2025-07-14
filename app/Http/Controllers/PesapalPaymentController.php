<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Libraries\PesapalV3;
use Illuminate\Support\Facades\Log;

class PesapalPaymentController extends Controller
{
    public function checkout(Request $request, Booking $booking)
    {
        Log::info('Pesapal checkout called', ['booking_id' => $booking->id]);
        $amount = $booking->amount;
        $description = 'Session Booking Payment';
        $reference = 'BOOKING-' . $booking->id;
        $callbackUrl = config('services.pesapal.callback_url');
        // Use live credentials and live endpoint
        $consumerKey = env('PESAPAL_CONSUMER_KEY', config('services.pesapal.consumer_key'));
        $consumerSecret = env('PESAPAL_CONSUMER_SECRET', config('services.pesapal.consumer_secret'));
        $isSandbox = false;

        $pesapal = new PesapalV3($consumerKey, $consumerSecret, $isSandbox);
        $token = $pesapal->getAccessToken();
        if (!$token) {
            Log::error('Pesapal token error');
            return back()->withErrors(['error' => 'Could not authenticate with Pesapal.']);
        }

        $orderData = [
            'id' => $reference,
            'currency' => 'KES',
            'amount' => $amount,
            'description' => $description,
            'callback_url' => $callbackUrl,
            'notification_id' => env('PESAPAL_NOTIFICATION_ID'), // Optional: set your notification ID if using IPN
            'billing_address' => [
                'email_address' => $booking->email,
                'phone_number' => $booking->phone ? $booking->phone : '0',
                'first_name' => $booking->name,
                'last_name' => '',
            ],
        ];
        Log::info('Pesapal orderData', $orderData);
        $order = $pesapal->submitOrder($token, $orderData);
        Log::info('Pesapal submitOrder response', ['order' => $order]);
        if (!$order || empty($order['redirect_url'])) {
            Log::error('Pesapal redirect_url missing', ['order' => $order]);
            return back()->withErrors(['error' => 'Could not create Pesapal order.']);
        }
        // Redirect user to Pesapal payment page
        return redirect()->away($order['redirect_url']);
    }
    public function initiatePayment(Booking $booking)
    {
        // Show the summary page first
        return view('pesapal.pay', compact('booking'));
    }

    public function handleCallback(Request $request)
    {
        // Example Pesapal callback params: pesapal_transaction_id, pesapal_merchant_reference, status
        $reference = $request->input('pesapal_merchant_reference');
        $transactionId = $request->input('pesapal_transaction_id');

        // Find booking by reference
        $bookingId = null;
        if ($reference && strpos($reference, 'BOOKING-') === 0) {
            $bookingId = intval(str_replace('BOOKING-', '', $reference));
        }
        $booking = $bookingId ? Booking::find($bookingId) : null;

        // Fetch payment status from Pesapal
        $consumerKey = env('PESAPAL_CONSUMER_KEY');
        $consumerSecret = env('PESAPAL_CONSUMER_SECRET');
        $isSandbox = false;
        $pesapal = new PesapalV3($consumerKey, $consumerSecret, $isSandbox);
        $token = $pesapal->getAccessToken();
        $statusDescription = null;
        if ($token && $transactionId) {
            $statusResponse = $pesapal->getOrderStatus($token, $transactionId);
            Log::info('Pesapal getOrderStatus response', ['response' => $statusResponse]);
            $statusDescription = $statusResponse['payment_status_description'] ?? null;
        }

        if ($booking) {
            $booking->payment_status = ($statusDescription === 'COMPLETED') ? 'paid' : 'failed';
            $booking->pesapal_transaction_id = $transactionId;
            $booking->save();
        } else {
            Log::error('Booking not found in callback', [
                'reference' => $reference,
                'transactionId' => $transactionId
            ]);
        }

        // Show confirmation or error
        if ($booking && $booking->payment_status === 'paid') {
            return view('booking.confirmed', compact('booking'));
        } else {
            return view('pesapal.callback', ['error' => 'Payment failed or not completed.']);
        }
    }
}
