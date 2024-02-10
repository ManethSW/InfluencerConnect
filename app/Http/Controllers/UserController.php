<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        if ($user->role_id->name == "Influencer") {
            $request->validate([
                'name' => ['string', 'max:255'],
                'email' => ['email', 'unique:users,email,' . $user->id],
                'phone' => ['string', 'min:10'],
                'dob' => ['date', 'before:today'],
                'address' => ['string', 'max:255'],
            ]);
        } else {
            $request->validate([
                'name' => ['string', 'max:255'],
                'email' => ['email', 'unique:users,email,' . $user->id],
                'phone' => ['string', 'min:10'],
                'address' => ['string', 'max:255'],
                'business_website' => ['url', 'max:255'],
                'business_type' => ['string', 'max:255'],
                'business_size' => ['numeric', 'min:1'],
            ]);
        }

        $user->update($request->all());
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function store(Request $request, Validator $validator)
    {
        // dd($request->role_id);
        if ((int) $request->role_id === 10) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'phone' => ['required', 'string', 'min:10'],
                'dob' => ['required', 'date', 'before:today'],
                'address' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
                'role_id' => [
                    'required',
                    Rule::in(collect(UserRole::cases())->map(function ($value, $key) {
                        return $value->value;
                    })->toArray())
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->route('users.index')->withErrors($validator)->withInput();
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'role_id' => $request->role_id,
                'status' => 1,
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'phone' => ['required', 'string', 'min:10'],
                'address' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
                'business_website' => ['required', 'url', 'max:255'],
                'business_type' => ['required', 'string', 'max:255'],
                'business_size' => ['required', 'numeric', 'min:1'],
                'role_id' => [
                    'required',
                    Rule::in(collect(UserRole::cases())->map(function ($value, $key) {
                        return $value->value;
                    })->toArray())
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->route('users.index')->withErrors($validator)->withInput();
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'business_website' => $request->business_website,
                'business_type' => $request->business_type,
                'business_size' => $request->business_size,
                'role_id' => $request->role_id,
                'status' => 1,
            ]);
        }

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
