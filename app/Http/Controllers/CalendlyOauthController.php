<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CalendlyOAuthController extends Controller
{
    public function redirectToCalendly()
    {
        $query = http_build_query([
            'client_id' => config('services.calendly.client_id'),
            'response_type' => 'code',
            'redirect_uri' => config('services.calendly.redirect_uri'),
        ]);

        return redirect("https://auth.calendly.com/oauth/authorize?$query");
    }

    public function handleCallback(\Illuminate\Http\Request $request)
    {
        $code = $request->query('code');

        // Exchange code for token
        $response = Http::asForm()->post('https://auth.calendly.com/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.calendly.client_id'),
            'client_secret' => config('services.calendly.client_secret'),
            'redirect_uri' => config('services.calendly.redirect_uri'),
            'code' => $code,
        ]);

        $data = $response->json();

        if ($response->successful()) {
            // Store access token in session or DB
            Session::put('calendly_access_token', $data['access_token']);
            return redirect('/calendly/events');
        }

        return response()->json($data, 400);
    }

    public function showEvents()
    {
        $token = session('calendly_access_token');

        if (!$token) {
            return redirect('/calendly/authorize');
        }

        // ✅ Step 1: Get and cache the user URI
        $userUri = session('calendly_user_uri');

        if (!$userUri) {
            $userResponse = Http::withToken($token)->get('https://api.calendly.com/users/me');

            if ($userResponse->failed()) {
                return response()->json(['error' => 'Failed to retrieve Calendly user info'], 400);
            }

            $userUri = $userResponse->json('resource.uri');
            session(['calendly_user_uri' => $userUri]);
        }

        // ✅ Step 2: Fetch event types using user URI
        $eventsResponse = Http::withToken($token)->get('https://api.calendly.com/event_types', [
            'user' => $userUri
        ]);

        if ($eventsResponse->failed()) {
            return response()->json($eventsResponse->json(), 400);
        }

        $events = $eventsResponse->json('collection');

        return view('calendly.events', compact('events'));
    }

    public function showBookingPage()
    {
        // Example: fixed event URI
        $eventUri = 'https://calendly.com/devsolutions/neurohaven-preview'; // change to your actual event URL

        // Extract username and event_slug from the URL
        $parsed = parse_url($eventUri);
        $path = $parsed['path']; // e.g. /your-username/paid-session
        $embedUrl = 'https://calendly.com' . $path;

        return view('calendly.booking', compact('embedUrl'));
    }

    public function handleWebhook(\Illuminate\Http\Request $request)
    {
        $payload = $request->all();
        $invitee = $payload['payload']['invitee'] ?? [];
        $event = $payload['payload']['event'] ?? [];
        Log::info('Calendly minimal log', [
            'name' => $invitee['name'] ?? null,
            'email' => $invitee['email'] ?? null,
            'phone' => $invitee['text_reminder_number'] ?? null,
            'event_id' => $event['uri'] ?? null,
            'session_time' => $event['start_time'] ?? null,
        ]);

        // Extract booking info from Calendly webhook payload
        $event_id = $payload['payload']['event']['uri'] ?? null;
        $session_time = $payload['payload']['event']['start_time'] ?? null;
        $name = $invitee['name'] ?? 'Unknown';
        $email = $invitee['email'] ?? null;
        $phone = $invitee['text_reminder_number'] ?? null;
        $amount = 1000; // Set your session price here

        // Validate required fields
        if (!$email || !$event_id || !$session_time) {
            Log::error('Missing required booking fields', [
                'email' => $email,
                'event_id' => $event_id,
                'session_time' => $session_time,
                'payload' => $payload
            ]);
            return response()->json(['error' => 'Missing required booking fields'], 400);
        }

        // Create booking record
        $booking = \App\Models\Booking::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'calendly_event_id' => $event_id,
            'session_time' => $session_time,
            'amount' => $amount,
            'payment_status' => 'pending',
        ]);

        // Respond to Calendly (or trigger frontend redirect to payment)
        return response()->json(['success' => true, 'booking_id' => $booking->id]);
    }
}
