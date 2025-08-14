<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;

class BookingController extends Controller
{
    public function fetchLatest(Request $request)
    {
        $eventUri = $request->query('event_uri');
        $token = env('CALENDLY_PAT');

        // Fetch event details from Calendly API
        $response = Http::withToken($token)->get($eventUri);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch event'], 400);
        }

        $event = $response->json('resource');
        // Fetch invitee details (if needed)
        $inviteesUrl = $eventUri . '/invitees';
        $inviteeResponse = Http::withToken($token)->get($inviteesUrl);
        $invitee = $inviteeResponse->json('collection.0');

        // Store booking in DB
        $sessionTimeEat = isset($event['start_time'])
            ? \Carbon\Carbon::parse($event['start_time'])->setTimezone('Africa/Nairobi')
            : null;
        $booking = Booking::create([
            'name' => $invitee['name'] ?? 'Unknown',
            'email' => $invitee['email'] ?? null,
            'phone' => $invitee['text_reminder_number'] ?? null,
            'calendly_event_id' => $event['uri'] ?? $eventUri,
            'session_time' => $sessionTimeEat,
            'amount' => 1000,
            'payment_status' => 'pending',
        ]);


        // Redirect to payment or confirmation
        return redirect()->route('pesapal.pay', ['booking' => $booking->id]);
    }

    public function getSessions()
    {
        $sessions = Booking::all();
        return view('booking.admin-session-list', ['sessions' => $sessions]);
    }
}
