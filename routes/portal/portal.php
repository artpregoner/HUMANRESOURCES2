<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\PortalController;

Route::get('/portal', [PortalController::class, 'home'])->name('home');
Route::get('/portal/myprofile',[PortalController::class,'myprofile'])->name('portal.myprofile');
