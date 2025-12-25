<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::where('is_active', true)->orderBy('order')->get();

        return view('about', compact('teamMembers'));
    }
}
