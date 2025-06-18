<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\ClaimsController;


Route::prefix('portal/claims')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/list', [ClaimsController::class, 'index'])->name('portal.claims.index');
    Route::get('/create', [ClaimsController::class, 'create'])->name('portal.claims.create');


    Route::get('/show/{claims}', [ClaimsController::class, 'show'])->name('portal.claims.show');


    // softdelete a ticket dont delete the attachments uploaded
    Route::delete('ticket/{claims}', [ClaimsController::class, 'destroy'])->name('portal.claims.destroy');

    //archived tickets
    Route::get('trash', [ClaimsController::class, 'trash'])->name('portal.claims.trash');
    Route::post('restore/{id}', [ClaimsController::class, 'restore'])->name('portal.claims.restore');

    // force delete a ticket including attachments
    Route::delete('force-delete/{claims}', [ClaimsController::class, 'forceDelete'])->name('portal.claims.forceDelete');
    Route::get('/{claim}/details', [ClaimsController::class, 'getDetails'])->name('portal.claims.details');

    Route::get('/claims/{id}/pdf', [ClaimsController::class, 'downloadPDF'])
    ->name('claims.download-pdf');
});
