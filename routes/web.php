<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InfluencerCardController;
use App\Models\InfluencerCard;
use App\Http\Controllers\InfluencerCategoryController;
use App\Http\Controllers\BusinessCategoryController;

Auth::routes();

Route::get('user-type', [App\Http\Controllers\UserTypeController::class, 'create'])->name('user-type.create');
Route::post('user-type', [App\Http\Controllers\UserTypeController::class, 'store'])->name('user-type.store');

Route::post('register/influencer', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('store_user.store');

Route::get('register/influencerindividual', function () {
    return view('auth.register-influencer-individual');
})->name('auth.register-influencer-individual');

Route::get('register/business', function () {
    return view('auth.register-business');
})->name('auth.register-business');

Route::get('profile', function () {
    return view('profile');
})->name('profile');

Route::get('collaborations', function () {
    return view('collaborations');
})->name('collaborations');

Route::middleware(['superadmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.dashboard');
    })->name('dashboard');
});

Route::prefix('dashboard')->middleware(['superadmin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
    Route::get('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');

    Route::resource('influencerCards', InfluencerCardController::class);
    Route::get('influencerCards/{influencerCard}/suspend', [InfluencerCardController::class, 'suspend'])->name('influencerCards.suspend');
    Route::get('influencerCards/{influencerCard}/activate', [InfluencerCardController::class, 'activate'])->name('influencerCards.activate');

    Route::resource('categories', CategoryController::class);
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::resource('influencerCategories', InfluencerCategoryController::class);
    Route::resource('businessCategories', BusinessCategoryController::class);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/collaborations', [App\Http\Controllers\CollaborationsController::class, 'show'])->name('collaborations');

Route::get('/', function () {
    $influencerCards = InfluencerCard::with('user', 'influencerCategory')->get();

    return view('home', ['influencerCards' => $influencerCards]);
});
