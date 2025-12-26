<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $title = 'Teklif Oluştur';
        $description = 'İzmir güvenlik sistemleri teklif formu';

        return view('quote.index', compact('title', 'description'));
    }
}
