<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\ClaimsController;


Route::prefix('portal/claims')->group(function(){
    Route::get('/list', [ClaimsController::class, 'index'])->name('portal.claims.index');
    Route::get('/create', [ClaimsController::class, 'create'])->name('portal.claims.create');
});
