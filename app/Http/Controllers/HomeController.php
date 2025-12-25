<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Client;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::latest()->take(6)->get();
        $clients = Client::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)
            ->where('is_featured', true)
            ->take(3)
            ->get();

        return view('home', compact('services', 'clients', 'testimonials'));
    }
}
