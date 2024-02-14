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
use App\Http\Controllers\ProposalController;

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

Route::get('collaborations', [App\Http\Controllers\CollaborationController::class, 'getAll'])->name('collaborations.getAll');

Route::prefix('collaborations')->group(function () {
//    Route::get('incoming', [App\Http\Controllers\IncomingOffersController::class, 'index'])->name('collaborations.incoming');
    Route::get('my_proposals', [App\Http\Controllers\ProposalController::class, 'getByInfluencers'])->name('collaborations.my_proposals');
    Route::get('active_influencer', [App\Http\Controllers\CollaborationController::class, 'getByInfluencer'])->name('collaborations.active_influencer');
    Route::get('my_collaborations', [App\Http\Controllers\CollaborationController::class, 'getByBusiness'])->name('collaborations.my_collaborations');
    Route::get('active_business', [App\Http\Controllers\CollaborationController::class, 'getActiveCollaborations'])->name('collaborations.active_business');
});

Route::post('collaborations/storeByBusiness', [App\Http\Controllers\CollaborationController::class, 'storeByBusiness'])->name('collaborations.storeByBusiness');
Route::put('collaborations/{collaboration}/updateByBusiness', [App\Http\Controllers\CollaborationController::class, 'updateByBusiness'])->name('collaborations.updateByBusiness');

Route::resource('proposals', ProposalController::class)->middleware('auth');
Route::put('proposals/{proposal}/updateByInfluencers', [App\Http\Controllers\ProposalController::class, 'updateByInfluencers'])->name('proposals.updateByInfluencers');
Route::delete('proposals/{proposal}/destroyByInfluencers', [App\Http\Controllers\ProposalController::class, 'destroyByInfluencers'])->name('proposals.destroyByInfluencers');
Route::get('proposals/{proposal}/acceptProposal', [App\Http\Controllers\ProposalController::class, 'acceptProposal'])->name('proposals.acceptProposal');
Route::get('proposals/{proposal}/rejectProposal', [App\Http\Controllers\ProposalController::class, 'rejectProposal'])->name('proposals.rejectProposal');
Route::post('/tasks/submit', [CollaborationController::class, 'submitTask'])->name('tasks.submit');
Route::post('/tasks/complete', [CollaborationController::class, 'completeTask'])->name('tasks.complete');

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

    Route::resource('proposals', ProposalController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    $influencerCards = InfluencerCard::with('user', 'influencerCategory')->get();

    return view('home', ['influencerCards' => $influencerCards]);
});
