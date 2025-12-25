<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'counts' => [
                'services' => Service::count(),
                'blogs' => Blog::count(),
                'products' => Product::count(),
                'offers' => Offer::count(),
                'contacts' => Contact::count(),
                'pending_offers' => Offer::where('status', 'pending')->count(),
                'unread_contacts' => Contact::where('is_read', false)->count(),
            ]
        ]);
    }
}
