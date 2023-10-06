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


    public function destroy(InfluencerCategory $influencerCategory)
    {
        // Check if there are any InfluencerCards associated with the InfluencerCategory
        if ($influencerCategory->influencerCards()->exists()) {
            // If there are, return an error message and stop the deletion process
            return redirect()->route('category.index')
                ->with('error', 'Cannot delete this Influencer Category as it is being used by some Influencer Cards');
        } else {
            // If there are no InfluencerCards associated with the InfluencerCategory, delete it
            $influencerCategory->delete();

            return redirect()->route('category.index')
                ->with('success', 'Influencer Category deleted successfully');
        }
    }

}