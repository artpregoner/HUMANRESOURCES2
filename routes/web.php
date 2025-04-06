<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Livewire\Counter;
// use Livewire\Livewire;
// use App\Http\Livewire\Auth\Login;

// Livewire::component('auth.login', Login::class);

// Route::get('/login', function () {
//     return view('livewire.auth.login');
// })->name('login');

// Route::get('/counter', Counter::class);
// Route::get('/storage-link', function () {
//     Artisan::call('storage:link');
// });

Route::get('/index', function () {
    return view('index');
});

// Authentication routes
require __DIR__ . '/auth.php';


// employee portal routes
require __DIR__ . '/portal/portal.php';


// admin routes
require __DIR__ . '/admin/admin.php';
