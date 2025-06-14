<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;



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


// Authentication routes
require __DIR__ . '/auth.php';


// employee portal routes
require __DIR__ . '/portal/portal.php';


// admin routes
require __DIR__ . '/admin/admin.php';
