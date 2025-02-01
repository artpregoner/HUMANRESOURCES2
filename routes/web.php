<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;

// Route::get('/storage-link', function () {
//     Artisan::call('storage:link');
// });

// Authentication routes
require __DIR__ . '/auth.php';


// employee portal routes
require __DIR__ . '/portal/portal.php';


// hr2 routes
require __DIR__ . '/hr2/hr2.php';
