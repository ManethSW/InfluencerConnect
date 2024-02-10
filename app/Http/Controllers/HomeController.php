<?php

namespace App\Http\Controllers;

use App\Models\InfluencerCard;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index()
    {
        $influencerCards = InfluencerCard::with('user', 'influencerCategory')->get();

        return view('home', compact('influencerCards'));
    }
}
