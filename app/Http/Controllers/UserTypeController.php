<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function create()
    {
        return view('auth.user-type');
    }
    public function store(Request $request)
    {
        $userType = $request->input('user_type');
        $request->session()->put('user_type', $userType);

        if ($userType === 'influencer') {
            return redirect()->route('auth.register-influencer');
        } elseif ($userType === 'business') {
            return redirect()->route('auth.register-business');
        } else {
            // Handle invalid user type
        }
    }
}