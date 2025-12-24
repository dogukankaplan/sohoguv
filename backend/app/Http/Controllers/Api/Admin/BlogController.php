<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::with(['media', 'user'])->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = Auth::id(); // Assign current user as author
        $validated['published_at'] = now();

        $blog = Blog::create($validated);

        if ($request->hasFile('image')) {
            $blog->addMediaFromRequest('image')->toMediaCollection('blogs');
        }

        return response()->json($blog->load('media'), 201);
    }

    public function show(Blog $blog)
    {
        return $blog->load(['media', 'user']);
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if (isset($validated['title']) && $validated['title'] !== $blog->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $blog->update($validated);

        if ($request->hasFile('image')) {
            $blog->clearMediaCollection('blogs');
            $blog->addMediaFromRequest('image')->toMediaCollection('blogs');
        }

        return response()->json($blog->load('media'));
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json(null, 204);
    }
}
