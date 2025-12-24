<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function index()
    {
        return Reference::with('media')->orderBy('order')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'order' => 'integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $reference = Reference::create($validated);

        if ($request->hasFile('image')) {
            $reference->addMediaFromRequest('image')->toMediaCollection('references');
        }

        return response()->json($reference->load('media'), 201);
    }

    public function show(Reference $reference)
    {
        return $reference->load('media');
    }

    public function update(Request $request, Reference $reference)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'order' => 'integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $reference->update($validated);

        if ($request->hasFile('image')) {
            $reference->clearMediaCollection('references');
            $reference->addMediaFromRequest('image')->toMediaCollection('references');
        }

        return response()->json($reference->load('media'));
    }

    public function destroy(Reference $reference)
    {
        $reference->delete();
        return response()->json(null, 204);
    }
}
