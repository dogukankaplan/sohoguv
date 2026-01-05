<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Client;
use App\Models\Partner;
use App\Models\SolutionPartner;
use App\Models\Testimonial;
use App\Models\Stat;
use App\Models\Feature;
use App\Models\HeroSection;
use App\Models\Section;
use App\Models\Slider;

use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Sliders - Fetch active sliders
        $sliders = collect();
        try {
            $sliders = Slider::active()->get();
        } catch (\Exception $e) {
            Log::error('HomeController Error [Sliders]: ' . $e->getMessage());
        }

        // 2. Sections - Try DB first, fallback to hardcoded
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
                (object) ['type' => 'partners'],
                (object) ['type' => 'solution_partners'],
                (object) ['type' => 'testimonials'],
                (object) ['type' => 'cta'],
            ]);
        }

        // 3. Auxiliary Data - Use try-catch for logging
        $services = collect();
        try {
            $services = Service::where('is_active', true)->orderBy('order')->take(6)->get();
        } catch (\Exception $e) {
            Log::error('HomeController Error [Services]: ' . $e->getMessage());
        }

        $clients = collect();
        try {
            $clients = Client::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            Log::error('HomeController Error [Clients]: ' . $e->getMessage());
        }

        $partners = collect();
        try {
            $partners = Partner::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            Log::error('HomeController Error [Partners]: ' . $e->getMessage());
        }

        $solutionPartners = collect();
        try {
            $solutionPartners = SolutionPartner::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            Log::error('HomeController Error [SolutionPartners]: ' . $e->getMessage());
        }

        $testimonials = collect();
        try {
            $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            Log::error('HomeController Error [Testimonials]: ' . $e->getMessage());
        }

        return view('home', compact('sliders', 'sections', 'services', 'clients', 'partners', 'solutionPartners', 'testimonials'));
    }
}
