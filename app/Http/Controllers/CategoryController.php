<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\InfluencerCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $influencerCategories = InfluencerCategory::all();
        $businessCategories = BusinessCategory::all();
        return view('dashboard.category.index', compact('influencerCategories', 'businessCategories'));
    }
}
