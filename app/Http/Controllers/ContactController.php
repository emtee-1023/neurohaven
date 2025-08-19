<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $mailSubject = 'CONTACT FORM SUBMISSION ' . Carbon::now()->format('Y-m-d H:i');
        $to = 'info@neurohaven.africa';
        $body = "Name: {$validated['name']}\nEmail: {$validated['email']}\nSubject: {$validated['subject']}\nMessage: {$validated['message']}";

        Mail::raw(
            $body,
            function ($mail) use ($to, $mailSubject, $validated) {
                $mail->to($to)
                    ->subject($mailSubject)
                    ->replyTo($validated['email'], $validated['name']);
            }
        );

        return back()->with('Success', 'Your message has been sent!');
    }
}
