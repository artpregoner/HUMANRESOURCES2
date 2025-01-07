<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\ClaimsController;

Route::get('/portal/claims/list', [ClaimsController::class, 'index'])->name('portal.claims.index');
Route::get('/portal/claims/create', [ClaimsController::class, 'create'])->name('portal.claims.create');
