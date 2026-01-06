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

        // Force-Inject Partners if missing (This fixes the empty DB issue)
        if ($sections->isNotEmpty()) {
            // Check if partners exists
            if (!$sections->contains('type', 'partners')) {
                // Find index of clients
                $clientsIndex = $sections->search(function ($item) {
                    return $item->type === 'clients';
                });

                $partnerSection = (object) ['type' => 'partners'];

                if ($clientsIndex !== false) {
                    $sections->splice($clientsIndex + 1, 0, [$partnerSection]);
                } else {
                    $sections->push($partnerSection);
                }
            }

            // Check if solution_partners exists
            if (!$sections->contains('type', 'solution_partners')) {
                // Find index of partners (we just added it possibly)
                $partnersIndex = $sections->search(function ($item) {
                    return $item->type === 'partners';
                });

                $solutionSection = (object) ['type' => 'solution_partners'];

                if ($partnersIndex !== false) {
                    $sections->splice($partnersIndex + 1, 0, [$solutionSection]);
                } else {
                    $sections->push($solutionSection);
                }
            }

            // Check if VIDEO exists, if not, we might want to inject it for demo purposes or if a setting exists
            // For now, we only inject if explicitly requested, but since user asked for it, let's add it if not present
            // AFTER Hero or Stats
            if (!$sections->contains('type', 'video')) {
                $heroIndex = $sections->search(function ($item) {
                    return $item->type === 'hero';
                });

                $videoSection = (object) [
                    'type' => 'video',
                    'title' => 'Tanıtım Videomuz',
                    'subtitle' => 'SOHO GÜVENLİK',
                    // Default SOHO introduction or a clear placeholder
                    'content' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'content_rich' => null, // Add missing property to avoid undefined property error
                ];

                if ($heroIndex !== false) {
                    // Add after stats if stats exist after hero
                    $statsIndex = $sections->search(function ($item) {
                        return $item->type === 'stats';
                    });

                    if ($statsIndex !== false) {
                        $sections->splice($statsIndex + 1, 0, [$videoSection]);
                    } else {
                        $sections->splice($heroIndex + 1, 0, [$videoSection]);
                    }
                }
            }
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
