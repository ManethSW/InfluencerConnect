<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InfluencerCardController;
use App\Models\InfluencerCard;
use App\Http\Controllers\InfluencerCategoryController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\CollaborationController;

Auth::routes();

Route::get('user-type', [App\Http\Controllers\UserTypeController::class, 'create'])->name('user-type.create');
Route::post('user-type', [App\Http\Controllers\UserTypeController::class, 'store'])->name('user-type.store');

Route::post('register/influencer', [App\Http\Controllers\Auth\RegisterController::class, 'storeInfluencer'])->name('register-influencer.store');
Route::post('register/business', [App\Http\Controllers\Auth\RegisterController::class, 'storeBusiness'])->name('register-business.store');

Route::get('register/influencer', function () {
    return view('auth.register-influencer');
})->name('auth.register-influencer');

Route::get('register/business', function () {
    return view('auth.register-business');
})->name('auth.register-business');

Route::get('profile', function () {
    return view('profile');
})->name('profile');

Route::get('collaborations', function () {
    return view('collaborations');
})->name('collaborations');

Route::prefix('collaborations')->group(function () {
//    Route::get('incoming', [App\Http\Controllers\IncomingOffersController::class, 'index'])->name('collaborations.incoming');
//    Route::get('proposals', [App\Http\Controllers\MyProposalsController::class, 'index'])->name('collaborations.proposals');
//    Route::get('active_influencer', [App\Http\Controllers\ActiveInfluencerController::class, 'index'])->name('collaborations.active_influencer');
    Route::get('my_collaborations', [App\Http\Controllers\CollaborationController::class, 'getByBusiness'])->name('collaborations.my_collaborations');
//    Route::get('active_business', [App\Http\Controllers\ActiveBusinessController::class, 'index'])->name('collaborations.active_business');
});

Route::put('collaborations/{collaboration}/updateByBusiness', [App\Http\Controllers\CollaborationController::class, 'updateByBusiness'])->name('collaborations.updateByBusiness');

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

    Route::resource('collaborations', CollaborationController::class);
});

Route::get('/collaborations', [App\Http\Controllers\CollaborationsController::class, 'show'])->name('collaborations');
Route::get('/collaborations/business/{businessId}', [CollaborationController::class, 'getByBusiness'])->name('collaborations.business');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    $influencerCards = InfluencerCard::with('user', 'influencerCategory')->get();

    return view('home', ['influencerCards' => $influencerCards]);
});
