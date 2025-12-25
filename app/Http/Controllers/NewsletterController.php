<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        NewsletterSubscriber::create([
            'email' => $validated['email'],
            'ip_address' => $request->ip(),
            'subscribed_at' => now(),
        ]);

        return back()->with('success', 'Bültene başarıyla kaydoldunuz!');
    }
}
