<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\InfluencerCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function index()
    // {
    //     $influencerCategories = InfluencerCategory::all();
    //     $businessCategories = BusinessCategory::all();
    //     return view('dashboard.category.index', compact('influencerCategories', 'businessCategories'));
    // }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $influencerCategories = InfluencerCategory::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })->get();

        $businessCategories = BusinessCategory::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('dashboard.category.index', compact('influencerCategories', 'businessCategories'));
    }

}