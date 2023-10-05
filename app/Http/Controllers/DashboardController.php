<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('dashboard.admin-dashboard');
    }
    public function influencerDashboard()
    {
        return view('influencer-dashboard');
    }

    public function businessDashboard()
    {
        return view('business-dashboard');
    }
}