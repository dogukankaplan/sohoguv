<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|max:255',
            'subject' => 'nullable|max:255',
            'message' => 'required',
        ]);

        ContactSubmission::create($validated);

        return redirect()->route('contact')->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.');
    }
}
