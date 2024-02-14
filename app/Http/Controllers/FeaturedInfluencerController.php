<?php

namespace App\Http\Controllers;

use App\Models\FeaturedInfluencer;
use App\Models\InfluencerCategory;
use App\Models\User;
use Illuminate\Http\Request;

class FeaturedInfluencerController extends Controller
{
    public function index()
    {
        $featuredInfluencers = FeaturedInfluencer::all();

        // Get the list of all users who are influencers and not already featured
        $influencers = User::where('role_id', 10)
            ->whereNotIn('id', $featuredInfluencers->pluck('influencer_id'))
            ->get();

        // Get all the influencer categories taht are active
        $influencerCategories = InfluencerCategory::where('status', 1)->get();

        return view('dashboard.featured-influencers.index', compact('featuredInfluencers', 'influencers', 'influencerCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'influencer_id' => 'required|exists:users,id',
            'influencer_category_id' => 'required|exists:influencer_categories,id',
        ]);

        FeaturedInfluencer::create($request->all());

        return redirect()->route('featuredInfluencers.index')
            ->with('success', 'Influencer added to featured successfully.');
    }

    public function show(FeaturedInfluencer $featuredInfluencer)
    {
        return $featuredInfluencer;
    }

    public function update(Request $request, FeaturedInfluencer $featuredInfluencer)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'influencer_category_id' => 'required|exists:influencer_categories,id',
        ]);

        $featuredInfluencer->update($request->all());

        return redirect()->route('featuredInfluencers.index')
            ->with('success', 'Influencer updated successfully');
    }

    public function updateStatus(Request $request, FeaturedInfluencer $featuredInfluencer)
    {
        $featuredInfluencer->update($request->all());

        return redirect()->route('featuredInfluencers.index')
            ->with('success', 'Influencer status updated successfully');
    }

    public function destroy(FeaturedInfluencer $featuredInfluencer)
    {
        $featuredInfluencer->delete();

        return response()->json();
    }
}
