<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\ClaimsController;


Route::prefix('portal/claims')->middleware(['auth', 'role:employee'])->group(function(){
    Route::get('/list', [ClaimsController::class, 'index'])->name('portal.claims.index');
    Route::get('/create', [ClaimsController::class, 'create'])->name('portal.claims.create');


    Route::get('/show/{claims}', [ClaimsController::class, 'show'])->name('portal.claims.show');


    // softdelete a ticket
    Route::delete('ticket/{ticket}', [ClaimsController::class, 'destroy'])->name('portal.helpdesk.destroy');

    //archived tickets
    Route::get('trash', [ClaimsController::class, 'trash'])->name('portal.helpdesk.trash');
    Route::post('restore/{id}', [ClaimsController::class, 'restore'])->name('portal.helpdesk.restore');

    // force delete a ticket
    Route::delete('force-delete/{ticket}', [ClaimsController::class, 'forceDelete'])->name('portal.helpdesk.forceDelete');
});
