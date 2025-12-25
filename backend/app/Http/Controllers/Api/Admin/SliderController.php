<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return Slider::orderBy('order')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|string',
            'title' => 'nullable|string',
            'order' => 'integer',
        ]);

        $slider = Slider::create($validated);
        return response()->json($slider, 201);
    }

    public function show(Slider $slider)
    {
        return $slider;
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'image' => 'required|string',
            'title' => 'nullable|string',
            'order' => 'integer',
        ]);

        $slider->update($validated);
        return response()->json($slider);
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return response()->json(['message' => 'Slider deleted']);
    }
}
