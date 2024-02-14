<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessCategory;

class BusinessCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:business_categories',
        ]);

        BusinessCategory::create($request->all());

        return redirect()->route('category.index')
            ->with('success', 'Business Category created successfully.');
    }

    public function update(Request $request, BusinessCategory $businessCategory)
    {
        $request->validate([
            'name' => 'required|unique:business_categories,name,' . $businessCategory->id,
        ]);

        $businessCategory->update($request->all());

        return redirect()->route('category.index')
            ->with('success', 'Business Category updated successfully');
    }

    public function updateStatus(Request $request, BusinessCategory $businessCategory)
    {
        $businessCategory->update($request->all());

        return redirect()->route('category.index')
            ->with('success', 'Business Category status updated successfully');
    }

    public function destroy(BusinessCategory $businessCategory)
    {
        $businessCategory->delete();

        return redirect()->route('category.index')
            ->with('success', 'Influencer Category deleted successfully');
    }
}
