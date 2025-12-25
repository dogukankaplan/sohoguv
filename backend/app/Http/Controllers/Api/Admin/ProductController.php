<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return Product::latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sub_category' => 'nullable|string',
            'features' => 'nullable|array',
            'image' => 'nullable|string',
        ]);

        if (empty($request->slug)) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sub_category' => 'nullable|string',
            'features' => 'nullable|array',
            'image' => 'nullable|string',
        ]);

        if (empty($request->slug)) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $product->update($validated);
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
