<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR2\ClaimsController;


Route::prefix('hr2/claims')->middleware(['auth', 'role:hr'])->group(function(){
    Route::get('/list', [ClaimsController::class, 'index'])->name('hr2.claims.index');
    // Route::get('/show', [ClaimsController::class, 'show'])->name('hr2.claims.show');

    //show the claims
    Route::get('/show/{claims}', [ClaimsController::class, 'show'])->name('hr2.claims.show');

    //archived tickets
    Route::get('trash', [ClaimsController::class, 'trash'])->name('hr2.claims.trash');
    Route::post('restore/{id}', [ClaimsController::class, 'restore'])->name('hr2.claims.restore');
});
