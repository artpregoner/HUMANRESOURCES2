<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\DashboardController;

Route::get('/portal', [DashboardController::class, 'home'])->name('home');
