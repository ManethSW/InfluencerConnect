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

//    public function showRegistrationForm(Request $request)
//    {
//        $userType = $request->session()->get('user_type');
//        if ($userType == 1 || $userType == 2) {
//            return view('auth.register-influencer-individual');
//        } elseif ($userType == 3) {
//            return view('auth.register-business');
//        } else {
//            return redirect()->route('user-type.create');
//        }
//    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.register-influencer-individual')->withErrors($validator)->withInput();
        }

        $user = null;

        if ($request->session()->get('user_type') == "influencer") {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => UserRole::Influencer,
            ]);
        } else if ($request->session()->get('user_type') == "individual") {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => UserRole::Individual,
            ]);
        } else if ($request->session()->get('user_type') == "business") {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => UserRole::Business,
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }

}
