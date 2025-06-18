<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Auth::routes(['verify' => true]); // This line adds all auth routes, including verification routes

// Route::get('/counter', Counter::class);
// Route::get('/storage-link', function () {
//     Artisan::call('storage:link');
// });

Route::get('ui', function () {
    return view('ui-tester');
}
);
Route::get('/', [LandingPageController::class, 'main'])->name('landingpage');

Route::get('/index', function () {
    return view('index');
});


Route::middleware('auth')->group( function () {

    Route::post('/submitmylogout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])->middleware('throttle:6,1')->name('verification.send');
});

// Authentication routes
require __DIR__ . '/auth.php';


// employee portal routes
require __DIR__ . '/portal/portal.php';


// admin routes
require __DIR__ . '/admin/admin.php';
