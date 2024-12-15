<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\DashboardController;
use App\Http\Controllers\Portal\EmployeeProfileController;

Route::get('/portal', [DashboardController::class, 'home'])->name('home');
Route::get('/portal/myprofile',[EmployeeProfileController::class,'myprofile'])->name('portal.myprofile');
