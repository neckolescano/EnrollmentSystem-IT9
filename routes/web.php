<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EnrollmentController; // Make sure this import is here!
use Illuminate\Support\Facades\Route;

// Public Route
Route::get('/', function () {
    return view('home');
})->name('home');

// Protected Routes (Login Required)
Route::middleware('auth')->group(function () {
    
    // Redirect dashboard to home view, but keep the name 'dashboard'
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');

    // Your CRUD Transaction
    Route::resource('enrollments', EnrollmentController::class);

    // Profile Management (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';