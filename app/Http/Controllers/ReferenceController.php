<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Testimonial;

class ReferenceController extends Controller
{
    public function index()
    {
        $clients = Client::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->get();

        return view('references', compact('clients', 'testimonials'));
    }
}
