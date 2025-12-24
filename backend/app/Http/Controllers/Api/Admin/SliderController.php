<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return Slider::with('media')->orderBy('order')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'order' => 'integer',
            'is_active' => 'boolean',
            'image' => 'required|image|max:4096', // Slider needs image
        ]);

        $slider = Slider::create($validated);

        if ($request->hasFile('image')) {
            $slider->addMediaFromRequest('image')->toMediaCollection('sliders');
        }

        return response()->json($slider->load('media'), 201);
    }

    public function show(Slider $slider)
    {
        return $slider->load('media');
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'order' => 'integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:4096',
        ]);

        $slider->update($validated);

        if ($request->hasFile('image')) {
            $slider->clearMediaCollection('sliders');
            $slider->addMediaFromRequest('image')->toMediaCollection('sliders');
        }

        return response()->json($slider->load('media'));
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return response()->json(null, 204);
    }
}
