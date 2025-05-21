<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        // Later, you might fetch dynamic data here
        // $featuredOpportunities = \App\Models\Opportunity::where('is_featured', true)->take(3)->get();
        // return view('home', compact('featuredOpportunities'));
        return view('home');
    }

    // Add dashboard if not already present from Breeze or if you customize it
    public function dashboard(): View
    {
        return view('dashboard'); // Assumes Breeze's dashboard
    }
}