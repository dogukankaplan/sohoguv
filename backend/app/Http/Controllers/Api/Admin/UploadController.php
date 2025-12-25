<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10240', // 10MB max
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename, 'public');

            // Construct full URL
            // Since we are likely serving partially or via API directly, we return the full URL
            $url = asset('storage/' . $path);

            return response()->json([
                'url' => $url,
                'path' => $path
            ]);
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }
}
