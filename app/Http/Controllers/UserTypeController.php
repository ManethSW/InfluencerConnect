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

        if ($userType === 'influencer' || $userType === 'individual') {
            return redirect()->route('auth.register-influencer-individual');
        } elseif ($userType === 'business') {
            return redirect()->route('auth.register-business');
        } else {
            return redirect()->route('user-type.create');
        }
    }
}
