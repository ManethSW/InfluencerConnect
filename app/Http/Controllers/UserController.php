<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'like', '%' . $search . '%')->get();

        return view('dashboard.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        if ($user->role_id->name == 'Influencer') {
            return view('dashboard.users.edit-influencer', compact('user'));
        } else {
            return view('dashboard.users.edit-business', compact('user'));
        }
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'unique:users,email,' . $user->id],
            'phone' => ['string', 'min:10'],
            'description' => ['string', 'max:255'],
            'type' => ['string', 'max:255'],
            'gender' => ['string', 'max:255'],
            'avatar' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'banner' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            // Store the new image and update the avatar value
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $avatarPath;
        } else {
            // Remove the avatar value to avoid overwriting
            unset($validatedData['avatar']);
        }

        $user->update($validatedData);
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function store(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'unique:users,email,' . $user->id],
            'password' => ['string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function destroy(User $user)
    {
        if ($user->influencerCards()->exists()) {
            // If there are, return an error message and stop the deletion process
            return redirect()->route('users.index')
                ->with('error', 'Cannot delete this Influencer Category as it is being used by some Influencer Cards');
        } else {
            // If there are no InfluencerCards associated with the InfluencerCategory, delete it
            $user->delete();

            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
        }
    }

    public function suspend(User $user)
    {
        $user->update(['status' => 0]);
        return redirect()->route('users.index')
            ->with('success', 'User suspended successfully');
    }

    public function activate(User $user)
    {
        $user->update(['status' => 1]);
        return redirect()->route('users.index')
            ->with('success', 'User activated successfully');
    }
}
