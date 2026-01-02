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
        // 1. Sections - Try DB first, fallback to hardcoded
        try {
            $sections = \App\Models\Section::where('is_active', true)->orderBy('order')->get();

            if ($sections->isEmpty()) {
                throw new \Exception('No sections found');
            }
        } catch (\Exception $e) {
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

        // 2. Auxiliary Data - Use rescue to safely return empty collection if table/column missing
        $services = rescue(fn() => \App\Models\Service::where('is_active', true)->orderBy('order')->take(6)->get(), collect());
        $clients = rescue(fn() => \App\Models\Client::orderBy('order')->get(), collect());
        $testimonials = rescue(fn() => \App\Models\Testimonial::where('is_active', true)->orderBy('order')->get(), collect());

        return view('home', compact('sections', 'services', 'clients', 'testimonials'));
    }
}
