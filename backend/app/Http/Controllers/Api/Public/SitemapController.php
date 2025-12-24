<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Blog;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $baseUrl = env('FRONTEND_URL', 'http://localhost:5173');

        $content = '<?xml version="1.0" encoding="UTF-8"?>';
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Static Pages
        $staticPages = [
            '/',
            '/corporate',
            '/services',
            '/blog',
            '/contact',
            '/references',
        ];

        foreach ($staticPages as $page) {
            $content .= '<url>';
            $content .= '<loc>' . $baseUrl . $page . '</loc>';
            $content .= '<changefreq>weekly</changefreq>';
            $content .= '<priority>' . ($page === '/' ? '1.0' : '0.8') . '</priority>';
            $content .= '</url>';
        }

        // Services
        $services = Service::where('status', true)->get();
        foreach ($services as $service) {
            $content .= '<url>';
            $content .= '<loc>' . $baseUrl . '/services/' . $service->slug . '</loc>';
            $content .= '<lastmod>' . $service->updated_at->toAtomString() . '</lastmod>';
            $content .= '<changefreq>monthly</changefreq>';
            $content .= '<priority>0.9</priority>';
            $content .= '</url>';
        }

        // Blogs
        $blogs = Blog::where('status', true)->get();
        foreach ($blogs as $blog) {
            $content .= '<url>';
            $content .= '<loc>' . $baseUrl . '/blog/' . $blog->slug . '</loc>';
            $content .= '<lastmod>' . $blog->updated_at->toAtomString() . '</lastmod>';
            $content .= '<changefreq>weekly</changefreq>';
            $content .= '<priority>0.7</priority>';
            $content .= '</url>';
        }

        $content .= '</urlset>';

        return response($content, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
