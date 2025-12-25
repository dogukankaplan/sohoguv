<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function index()
    {
        return Reference::latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string',
            'link' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $reference = Reference::create($validated);
        return response()->json($reference, 201);
    }

    public function show(Reference $reference)
    {
        return $reference;
    }

    public function update(Request $request, Reference $reference)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string',
            'link' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $reference->update($validated);
        return response()->json($reference);
    }

    public function destroy(Reference $reference)
    {
        $reference->delete();
        return response()->json(['message' => 'Reference deleted']);
    }
}
