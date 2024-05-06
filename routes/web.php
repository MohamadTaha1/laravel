<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarSaleController;
use App\Http\Controllers\CarRentController;
use App\Http\Controllers\BiddingController;


use Illuminate\Support\Facades\Route;

Route::get('/', [CarController::class, 'fetchFromApi'])->name('welcome');
Route::get('/cars/api', [CarController::class, 'fetchFromApi'])->name('cars.api-index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/bidding', [BiddingController::class, 'index'])->name('bidding.index');
    Route::get('/bidding/{car}/setup', [BiddingController::class, 'showSetup'])->name('bidding.setup');
    Route::post('/bidding/{car}/setup', [BiddingController::class, 'setupBidding'])->name('bidding.submitSetup');
    Route::get('/bidding/{car}', [BiddingController::class, 'show'])->name('bidding.show');
    Route::post('/bidding/{car}/bid', [BiddingController::class, 'placeBid'])->name('bidding.bid');
});

// Inside routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::resource('cars', CarController::class);
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store')->middleware('auth');
    Route::patch('cars/{car}/sale', [CarController::class, 'sale'])->name('cars.sale');
    Route::patch('cars/{car}/rent', [CarController::class, 'rent'])->name('cars.rent');
    Route::post('/cars/{car}/rent-request', [CarRentController::class, 'rentRequest'])->name('cars.rent.request');

    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');

    Route::get('/my-transactions', [CarSaleController::class, 'myTransactions'])->name('transactions.index')->middleware('auth');

});

Route::get('/cars-for-rent', [CarRentController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('cars-for-rent');

// Submit a rent request
Route::post('/cars/{car}/rent-request', [CarRentController::class, 'rentRequest'])
    ->middleware(['auth', 'verified'])
    ->name('cars.rent.request');

// Respond to a rent request
Route::patch('/rent-requests/{rentRequest}/respond', [CarRentController::class, 'respondToRentRequest'])
    ->middleware(['auth', 'verified'])
    ->name('rentRequests.respond');

Route::get('/cars-for-sale', [CarSaleController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('cars-for-sale');

Route::post('/cars/{car}/buy-request', [CarSaleController::class, 'buyRequest'])->name('cars.buy.request');
Route::patch('/buy-requests/{buyRequest}/respond', [CarSaleController::class, 'respondToBuyRequest'])->name('buyRequests.respond');


Route::patch('/buy-requests/{buyRequest}/respond', [CarSaleController::class, 'respondToBuyRequest'])->name('buyRequests.respond')->middleware('auth');
Route::patch('/rent-requests/{rentRequest}/respond', [CarRentController::class, 'respondToRentRequest'])->name('rentRequests.respond')->middleware('auth');





require __DIR__.'/auth.php';
