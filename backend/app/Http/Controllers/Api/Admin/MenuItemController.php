<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $items = \App\Models\MenuItem::orderBy('order')->get();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'type' => 'required|string',
            'order' => 'integer',
            'is_active' => 'boolean',
            'new_tab' => 'boolean'
        ]);

        $item = \App\Models\MenuItem::create($validated);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return \App\Models\MenuItem::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = \App\Models\MenuItem::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'url' => 'sometimes|string|max:255',
            'type' => 'sometimes|string',
            'order' => 'integer',
            'is_active' => 'boolean',
            'new_tab' => 'boolean'
        ]);

        $item->update($validated);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = \App\Models\MenuItem::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
