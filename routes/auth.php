<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/submitmylogin', [AuthController::class, 'submitLogin'])->name('submitLogin');


Route::post('/submitmylogout', [AuthController::class, 'logout'])->name('logout');
