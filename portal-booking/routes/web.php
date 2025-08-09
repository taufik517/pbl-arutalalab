<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
Route::get('/booking', [BookingController::class, "index"])->name('booking.index');

Route::get('/booking/create', [BookingController::class, "create"])->name('booking.create');
Route::post('/booking' , [BookingController::class, "store"])->name('booking.store');

Route::get('/booking/{booking}/edit', [BookingController::class, "edit"])->name('booking.edit');
Route::put('/booking/{booking}', [BookingController::class, "update"])->name('booking.update');

Route::delete('/booking/{booking}', [BookingController::class, "destroy"])->name('booking.destroy');

});

require __DIR__.'/auth.php';
