<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Reference;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return [
            'sliders' => Slider::orderBy('order')->with('media')->get(),
            'services' => Service::latest()->take(3)->with('media')->get(),
            'blogs' => Blog::latest('published_at')->take(3)->with(['media', 'user'])->get(),
            'references' => Reference::orderBy('order')->take(6)->with('media')->get(),
            'testimonials' => \App\Models\Testimonial::where('is_active', true)->orderBy('order')->take(3)->get(),
        ];
    }

    public function services()
    {
        return Service::where('is_active', true)->latest()->with('media')->get();
    }

    public function serviceDetail($slug)
    {
        return Service::where('slug', $slug)->where('is_active', true)->with('media')->firstOrFail();
    }

    public function blogs()
    {
        return Blog::latest('published_at')->with(['media', 'user'])->paginate(9);
    }

    public function blogDetail($slug)
    {
        return Blog::where('slug', $slug)->with(['media', 'user'])->firstOrFail();
    }

    public function references()
    {
        return Reference::orderBy('order')->with('media')->get();
    }

    public function settings()
    {
        // Only return safe public settings
        return Setting::whereIn('group', ['general', 'social', 'contact', 'seo', 'home'])->pluck('value', 'key');
    }

    public function menus()
    {
        return \App\Models\MenuItem::where('is_active', true)->orderBy('order')->get()->groupBy('type');
    }

    public function faqs()
    {
        return \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        if (empty($query))
            return ['services' => [], 'blogs' => []];

        $services = Service::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('summary', 'like', "%{$query}%");
            })
            ->with('media')->take(5)->get();

        $blogs = Blog::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->with('media')->take(5)->get();

        return ['services' => $services, 'blogs' => $blogs];
    }

    public function sliders()
    {
        return Slider::where('is_active', true)
            ->orderBy('order')
            ->with('media')
            ->get();
    }
}
