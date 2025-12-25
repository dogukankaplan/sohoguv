<?php

namespace App\Http\Controllers;

use App\Models\CustomerRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function fault()
    {
        return view('forms.fault');
    }

    public function inventory()
    {
        return view('forms.inventory');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:fault,inventory',
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        CustomerRequest::create($validated);

        return back()->with('success', 'Talebiniz başarıyla alındı. En kısa sürede sizinle iletişime geçilecektir.');
    }
}
