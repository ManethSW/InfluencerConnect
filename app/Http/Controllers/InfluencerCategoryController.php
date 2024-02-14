<?php

namespace App\Http\Controllers;

use App\Models\InfluencerCategory;
use Illuminate\Http\Request;


class InfluencerCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:influencer_categories',
        ]);

        InfluencerCategory::create($request->all());

        return redirect()->route('category.index')
            ->with('success', 'Influencer Category created successfully.');
    }

    public function update(Request $request, InfluencerCategory $influencerCategory)
    {
        $request->validate([
            'name' => 'required|unique:influencer_categories,name,' . $influencerCategory->id,
        ]);

        $influencerCategory->update($request->all());

        return redirect()->route('category.index')
            ->with('success', 'Influencer Category updated successfully');
    }

    public function updateStatus(Request $request, InfluencerCategory $influencerCategory)
    {
        $influencerCategory->update($request->all());

        return redirect()->route('category.index')
            ->with('success', 'Influencer Category status updated successfully');
    }


    public function destroy(InfluencerCategory $influencerCategory)
    {
        $influencerCategory->delete();

        return redirect()->route('category.index')
            ->with('success', 'Influencer Category deleted successfully');
    }

}
