<?php

namespace App\Http\Controllers;

use App\Models\InfluencerCard;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $influencerCards = InfluencerCard::with('user', 'influencerCategory')->get();

        return view('home', compact('influencerCards'));
    }
}