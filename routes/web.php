<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EnrollmentController; 
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
| Public Routes
*/
Route::get('/', function () {
    return view('home');
})->name('home');


/*
| Protected Routes (Login Required)
*/
Route::middleware('auth')->group(function () {
    
    // Dashboard & Main Index
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');

    Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');

    /* --- MULTI-STEP ENROLLMENT ROUTES --- */
    // Step 1: student info
    Route::get('/enroll/step-1', [EnrollmentController::class, 'showStep1'])->name('enrollments.step1');
    Route::post('/enroll/step-1', [EnrollmentController::class, 'postStep1'])->name('enrollments.post.step1');
    
    // Step 2: department, course, semester, school year
    Route::get('/enroll/step-2', [EnrollmentController::class, 'showStep2'])->name('enrollments.step2');
    Route::post('/enroll/step-2', [EnrollmentController::class, 'postStep2'])->name('enrollments.post.step2');
    
    // Step 3: subject selection
    Route::get('/enroll/step-3', [EnrollmentController::class, 'showStep3'])->name('enrollments.step3');
    Route::post('/enroll/step-3', [EnrollmentController::class, 'postStep3'])->name('enrollments.post.step3');
    
    // Step 4: review & confirm
    Route::get('/enroll/step-4', [EnrollmentController::class, 'showStep4'])->name('enrollments.step4');

    // The Final Submission Action (POST)
    Route::post('/enroll/store', [EnrollmentController::class, 'store'])->name('enrollments.store');

    // STEP 5: Success Page
    Route::get('/enroll/success', [EnrollmentController::class, 'success'])->name('enrollments.success');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    | Admin Only Routes
    */
    Route::middleware('can:admin-only')->group(function () {
        Route::get('/admin/add-subject', [AdminController::class, 'create'])->name('admin.add_subject');
        Route::post('/admin/subjects/store', [AdminController::class, 'storeSubject'])->name('admin.subjects.store');
    });

});

require __DIR__.'/auth.php';