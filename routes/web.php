<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/portal', [Authcontroller::class, 'home'])->name('portal.home');

require __DIR__ . '/auth.php';
