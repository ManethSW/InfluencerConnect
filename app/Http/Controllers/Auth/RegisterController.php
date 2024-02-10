<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\EmailValidation;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $userType = $request->session()->get('user_type');
        if ($userType == 1) {
            return view('auth.register-influencer');
        } elseif ($userType == 2) {
            return view('auth.register-business');
        } else {
            return redirect()->route('user-type.create');
        }
    }

    public function storeInfluencer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'min:10'],
            'dob' => ['required', 'date', 'before:today'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.register-influencer')->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role_id' => UserRole::Influencer,
            'status' => 1,
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function storeBusiness(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'min:10'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'business_website' => ['required', 'url', 'max:255'],
            'business_type' => ['required', 'string', 'max:255'],
            'business_size' => ['required', 'numeric', 'min:1'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.register-business')->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role_id' => UserRole::Business,
            'business_website' => $request->business_website,
            'business_type' => $request->business_type,
            'business_size' => $request->business_size,
            'status' => 1,
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

}
