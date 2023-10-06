<?php

namespace App\Http\Controllers;

use App\Models\InfluencerCard;
use App\Models\InfluencerCategory;
use App\Models\User;
use Illuminate\Http\Request;

class InfluencerCardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $influencerCards = InfluencerCard::with([
            'user' => function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', "%{$search}%");
                }
            }
        ], 'influencerCategory')->get();

        $users = User::all();
        $categories = InfluencerCategory::all();

        return view('dashboard.influencer-cards.index', compact('influencerCards', 'users', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'influencer_category_id' => 'required|exists:influencer_categories,id',
            'avatar' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'rating' => 'required|integer',
            'description' => 'required|string',
            'visible' => 'required|boolean',
        ]);

        $avatarPath = $request->file('avatar')->store('avatars', 'public');

        InfluencerCard::create([
            'user_id' => $validatedData['user_id'],
            'influencer_category_id' => $validatedData['influencer_category_id'],
            'avatar' => $avatarPath,
            'rating' => $validatedData['rating'],
            'description' => $validatedData['description'],
            'visible' => $validatedData['visible'],
        ]);

        return redirect()->route('influencerCards.index')
            ->with('success', 'Influencer card created successfully');
    }

    public function edit(InfluencerCard $influencerCard)
    {
        $users = User::all();
        $categories = InfluencerCategory::all();

        return view('dashboard.influencer-cards.edit', compact('influencerCard', 'users', 'categories'));
    }

    public function update(Request $request, InfluencerCard $influencerCard)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'influencer_category_id' => 'required|exists:influencer_categories,id',
            'avatar' => 'file|mimes:jpg,jpeg,png|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('avatar')) {
            // Store the new image and update the avatar value
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $avatarPath;
        } else {
            // Remove the avatar value to avoid overwriting
            unset($validatedData['avatar']);
        }

        $influencerCard->update($validatedData);

        return redirect()->route('influencerCards.index')
            ->with('success', 'Influencer card updated successfully');
    }


    public function destroy(InfluencerCard $influencerCard)
    {
        $influencerCard->delete();

        return redirect()->route('influencerCards.index')
            ->with('success', 'Influencer card deleted successfully');
    }

    public function suspend(InfluencerCard $influencerCard)
    {
        $influencerCard->update(['visible' => false]);

        return redirect()->route('influencerCards.index')
            ->with('success', 'Influencer card suspended successfully');
    }

    public function activate(InfluencerCard $influencerCard)
    {
        $influencerCard->update(['visible' => true]);

        return redirect()->route('influencerCards.index')
            ->with('success', 'Influencer card activated successfully');
    }

}