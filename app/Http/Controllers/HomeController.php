<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Client;
use App\Models\Testimonial;
use App\Models\Stat;
use App\Models\Feature;
use App\Models\HeroSection;

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

        // Dynamic content from admin panel
        $stats = Stat::where('is_active', true)->orderBy('order')->get();
        $whySohoFeatures = Feature::where('section', 'why_soho')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
        $whyUsFeatures = Feature::where('section', 'why_us')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
        $hero = HeroSection::where('page', 'home')
            ->where('is_active', true)
            ->first();

        return view('home', compact(
            'services',
            'clients',
            'testimonials',
            'stats',
            'whySohoFeatures',
            'whyUsFeatures',
            'hero'
        ));
    }
}
