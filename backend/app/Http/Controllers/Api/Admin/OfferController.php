<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        return Offer::with('service')->latest()->paginate(20);
    }

    public function show(Offer $offer)
    {
        if (!$offer->is_read) {
            $offer->update(['is_read' => true]);
        }
        return $offer->load('service');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return response()->json(null, 204);
    }
}
