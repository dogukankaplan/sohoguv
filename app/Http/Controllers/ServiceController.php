<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        return view('services.index', compact('services'));
    }

    public function solutions()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $heroSection = \App\Models\Section::where('type', 'solutions_hero')->first();
        $ctaSection = \App\Models\Section::where('type', 'solutions_cta')->first();

        return view('solutions.index', compact('services', 'heroSection', 'ctaSection'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $title = $service->title . ' - İzmir Kamera ve Güvenlik Sistemleri';
        $description = \Illuminate\Support\Str::limit(strip_tags($service->description), 160);

        return view('services.show', compact('service', 'title', 'description'));
    }
}
