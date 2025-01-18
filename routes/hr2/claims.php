<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR2\ClaimsController;


Route::prefix('hr2/claims')->group(function(){
    Route::get('/list', [ClaimsController::class, 'index'])->name('hr2.claims.index');
    Route::get('/show', [ClaimsController::class, 'show'])->name('hr2.claims.show');
    // Route::get('/hr2/myprofile', [ClaimsController::class, 'myprofile'])->name('hr2.myprofile');
});
