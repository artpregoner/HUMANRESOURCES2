<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


Route::get('/', [AuthController::class, 'index'])->name('login');
