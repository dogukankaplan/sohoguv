<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        return Offer::latest()->get();
    }

    public function show(Offer $offer)
    {
        return $offer;
    }

    // Usually offers are not created via Admin, but we might want status updates
    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        $offer->update($validated);
        return response()->json($offer);
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return response()->json(['message' => 'Offer deleted']);
    }
}
