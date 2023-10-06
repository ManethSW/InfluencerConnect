<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InfluencerCardController;
use App\Models\InfluencerCard;

Auth::routes();

Route::get('user-type', [App\Http\Controllers\UserTypeController::class, 'create'])->name('user-type.create');
Route::post('user-type', [App\Http\Controllers\UserTypeController::class, 'store'])->name('user-type.store');

Route::post('register/influencer', [App\Http\Controllers\Auth\RegisterController::class, 'storeInfluencer'])->name('register-influencer.store');
Route::post('register/business', [App\Http\Controllers\Auth\RegisterController::class, 'storeBusiness'])->name('register-business.store');

Route::get('/layouts/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');


Route::get('register/influencer', function () {
    return view('auth.register-influencer');
})->name('auth.register-influencer');

Route::get('register/business', function () {
    return view('auth.register-business');
})->name('auth.register-business');

Route::resource('users', UserController::class);
Route::get('users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
Route::get('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');

Route::resource('influencerCards', InfluencerCardController::class);
Route::get('influencerCards/{influencerCard}/suspend', [InfluencerCardController::class, 'suspend'])->name('influencerCards.suspend');
Route::get('influencerCards/{influencerCard}/activate', [InfluencerCardController::class, 'activate'])->name('influencerCards.activate');

Route::resource('categories', CategoryController::class);
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::resource('influencerCategories', App\Http\Controllers\InfluencerCategoryController::class);
Route::resource('businessCategories', App\Http\Controllers\BusinessCategoryController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    $influencerCards = InfluencerCard::with('user', 'influencerCategory')->get();

    return view('home', ['influencerCards' => $influencerCards]);
});