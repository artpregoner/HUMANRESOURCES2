<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\ClaimsController;

Route::get('/portal/claims/create', [ClaimsController::class, 'create'])->name('portal.claims.create');
Route::get('/portal/claims/list', [ClaimsController::class, 'read'])->name('portal.claims.read');
