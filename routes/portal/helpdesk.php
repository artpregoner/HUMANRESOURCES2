<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\HelpdeskController;


Route::prefix('portal/helpdesk/')->group(function () {
    // shwo ticket
    Route::get('list', [HelpdeskController::class, 'index'])->name('portal.helpdesk.index');

    // Create new ticket
    Route::get('create', [HelpdeskController::class, 'create'])->name('portal.helpdesk.create');
    Route::post('create/store', [HelpdeskController::class, 'store'])->name('portal.helpdesk.store');

    // Show ticket details and responses
    Route::get('ticket/{ticket}', [HelpdeskController::class, 'show'])->name('portal.helpdesk.show');
    // Add a response to a specific ticket
    Route::post('ticket/{ticket}/respond', [HelpdeskController::class, 'respond'])->name('portal.helpdesk.respond');

    // softdelete a ticket
    Route::delete('ticket/{ticket}', [HelpdeskController::class, 'destroy'])->name('portal.helpdesk.destroy');

    //archived tickets
    Route::get('trash', [HelpdeskController::class, 'trash'])->name('portal.helpdesk.trash');
    Route::post('restore/{id}', [HelpdeskController::class, 'restore'])->name('portal.helpdesk.restore');

    // force delete a ticket
    Route::delete('force-delete/{ticket}', [HelpdeskController::class, 'forceDelete'])->name('portal.helpdesk.forceDelete');

});
