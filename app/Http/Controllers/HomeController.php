<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Client;
use App\Models\Testimonial;
use App\Models\Stat;
use App\Models\Feature;
use App\Models\HeroSection;
use App\Models\Section;

use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Sections - Try DB first, fallback to hardcoded
        try {
            $sections = Section::where('is_active', true)->orderBy('order')->get();

            if ($sections->isEmpty()) {
                throw new \Exception('No sections found in database');
            }
        } catch (\Exception $e) {
            Log::error('HomeController Error [Sections]: ' . $e->getMessage());

            $sections = collect([
                (object) [
                    'type' => 'hero',
                    'title' => setting('hero_title', 'SOHO GÜVENLİK'),
                    'subtitle' => setting('hero_subtitle', 'Yeni nesil güvenlik teknolojileri ile geleceğinizi koruma altına alın.'),
                    'content' => null,
                    'image' => null,
                    'bg_color' => 'bg-white'
                ],
                (object) ['type' => 'stats'],
                (object) ['type' => 'services'],
                (object) ['type' => 'features'],
                (object) ['type' => 'clients'],
                (object) ['type' => 'testimonials'],
                (object) ['type' => 'cta'],
            ]);
        }

        // 2. Auxiliary Data - Use try-catch for logging
        $services = collect();
        try {
            $services = Service::where('is_active', true)->orderBy('order')->take(6)->get();
        } catch (\Exception $e) {
            Log::error('HomeController Error [Services]: ' . $e->getMessage());
        }

        $clients = collect();
        try {
            $clients = Client::orderBy('order')->get();
        } catch (\Exception $e) {
            Log::error('HomeController Error [Clients]: ' . $e->getMessage());
        }

        $testimonials = collect();
        try {
            $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            Log::error('HomeController Error [Testimonials]: ' . $e->getMessage());
        }

        return view('home', compact('sections', 'services', 'clients', 'testimonials'));
    }
}
