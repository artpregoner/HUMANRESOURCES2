<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClaimsController;


Route::prefix('claims')->middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/list', [ClaimsController::class, 'index'])->name('admin.claims.index');

    Route::get('/show/{claims}', [ClaimsController::class, 'show'])->name('admin.claims.show');

    // softdelete a ticket dont delete the attachments uploaded
    Route::delete('ticket/{ticket}', [ClaimsController::class, 'destroy'])->name('admin.claims.destroy');

    //archived tickets
    Route::get('trash', [ClaimsController::class, 'trash'])->name('admin.claims.trash');
    Route::post('restore/{id}', [ClaimsController::class, 'restore'])->name('admin.claims.restore');

    // force delete a ticket including attachments
    Route::delete('force-delete/{ticket}', [ClaimsController::class, 'forceDelete'])->name('admin.claims.forceDelete');
});
