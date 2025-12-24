<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::with('media')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Main service image
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $service = Service::create($validated);

        if ($request->hasFile('image')) {
            $service->addMediaFromRequest('image')->toMediaCollection('services');
        }

        return response()->json($service->load('media'), 201);
    }

    public function show(Service $service)
    {
        return $service->load('media');
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if (isset($validated['title']) && $validated['title'] !== $service->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $service->update($validated);

        if ($request->hasFile('image')) {
            $service->clearMediaCollection('services');
            $service->addMediaFromRequest('image')->toMediaCollection('services');
        }

        return response()->json($service->load('media'));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(null, 204);
    }
}
