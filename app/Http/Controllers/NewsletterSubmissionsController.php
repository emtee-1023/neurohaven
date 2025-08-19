<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubmissions;
use GrahamCampbell\ResultType\Success;

class NewsletterSubmissionsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_submissions,email',
        ]);

        NewsletterSubmissions::create($validated);
        return redirect()->route('home')->with('Success', 'Email Submitted');
    }
}
