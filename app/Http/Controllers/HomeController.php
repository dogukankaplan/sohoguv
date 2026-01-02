<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Service;
use App\Models\Client;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Attempt to fetch dynamic sections if table exists
            $sections = \App\Models\Section::where('is_active', true)
                ->orderBy('order')
                ->get();

            if ($sections->isEmpty()) {
                throw new \Exception('No sections found');
            }
        } catch (\Exception $e) {
            // Fallback to hardcoded sections structure if DB is empty or migration not run
            $sections = collect([
                (object) [
                    'type' => 'hero',
                    'title' => setting('hero_title', 'GÜVENLİĞİNİZ BİZİM İŞİMİZ'),
                    'subtitle' => setting('hero_subtitle', 'SOHO Güvenlik Sistemleri ile eviniz ve iş yeriniz güvende.'),
                    'content' => null,
                    'image' => null
                ],
                (object) ['type' => 'stats'],
                (object) ['type' => 'services'],
                (object) ['type' => 'features'],
                (object) ['type' => 'clients'],
                (object) ['type' => 'cta'],
            ]);
        }

        // Other existing data with safe database querying
        try {
            $services = \App\Models\Service::where('is_active', true)->orderBy('order')->take(6)->get();
        } catch (\Exception $e) {
            $services = collect();
        }

        try {
            $clients = \App\Models\Client::orderBy('order')->get();
        } catch (\Exception $e) {
            $clients = collect();
        }

        try {
            $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            $testimonials = collect();
        }

        // Pass to view
        return view('home', compact('sections', 'services', 'clients', 'testimonials'));
    }
}
