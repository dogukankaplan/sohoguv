<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\SolutionPartner;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        return view('partners.index', compact('partners'));
    }

    public function solutions()
    {
        $solutionPartners = SolutionPartner::where('is_active', true)->orderBy('order')->get();
        return view('partners.solutions', compact('solutionPartners'));
    }
}
