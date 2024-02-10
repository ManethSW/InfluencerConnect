<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CollaborationsController extends Controller
{
    public function index() {}

    public function show(Request $request) {
        $activePage = $request->query('page', 'incoming'); // Default to 'incoming' if no query parameter is provided
        return view('collaborations', ['activePage' => $activePage]);
    }
}
