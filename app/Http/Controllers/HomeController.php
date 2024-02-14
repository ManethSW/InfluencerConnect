<?php

namespace App\Http\Controllers;

use App\Models\FeaturedInfluencer;

class HomeController extends Controller
{
    public function index()
    {
        $featuredInfluencers = FeaturedInfluencer::with('user', 'influencerCategory')
            ->where('status', 1)
            ->get();

        return view('home', compact('featuredInfluencers'));
    }
}
