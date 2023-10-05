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
        return view('dashboard.users.edit', compact('user'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'unique:users,email,' . $user->id],
            'phone' => ['string', 'min:10'],
            'dob' => ['date', 'before:today'],
            'address' => ['string', 'max:255'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => [
                'required',
                Rule::in(collect(UserRole::cases())->map(function ($value, $key) {
                    return $value->value;
                })->toArray())
            ],
        ]);

        $user->update($request->all());
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function store(Request $request, Validator $validator)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'min:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => [
                'required',
                Rule::in(collect(UserRole::cases())->map(function ($value, $key) {
                    return $value->value;
                })->toArray())
            ],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => 1,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
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