<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return \App\Models\Product::where('category', 'colorvu')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_category' => 'required|string', // bullet, turret, etc.
            'image' => 'nullable|string',
            'features' => 'nullable|array',
        ]);

        $validated['category'] = 'colorvu';
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        // Handle duplicate slugs
        if (\App\Models\Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-' . time();
        }

        return \App\Models\Product::create($validated);
    }

    public function show(\App\Models\Product $product)
    {
        return $product;
    }

    public function update(Request $request, \App\Models\Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_category' => 'required|string',
            'image' => 'nullable|string',
            'features' => 'nullable|array',
        ]);

        if ($request->has('name') && $request->name !== $product->name) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
            if (\App\Models\Product::where('slug', $validated['slug'])->where('id', '!=', $product->id)->exists()) {
                $validated['slug'] .= '-' . time();
            }
        }

        $product->update($validated);

        return $product;
    }

    public function destroy(\App\Models\Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
