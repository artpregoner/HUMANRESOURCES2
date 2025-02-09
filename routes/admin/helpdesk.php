<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HelpdeskController;

Route::prefix('helpdesk')->middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/list', [HelpdeskController::class, 'index'])->name('admin.helpdesk.index');

    // Show ticket details and responses
    Route::get('ticket/{ticket}', [HelpdeskController::class, 'show'])->name('admin.helpdesk.show');
    // Add a response to a specific ticket
    Route::post('ticket/{ticket}/respond', [HelpdeskController::class, 'respond'])->name('admin.helpdesk.respond');

    // Delete a ticket
    Route::delete('ticket/{ticket}', [HelpdeskController::class, 'destroy'])->name('admin.helpdesk.destroy');

    //update ticket status
    Route::patch('/helpdesk/{ticket}/update-status', [HelpdeskController::class, 'updateStatus'])->name('admin.helpdesk.updateStatus');

    //archived tickets
    Route::get('trash', [HelpdeskController::class, 'trash'])->name('admin.helpdesk.trash');
    Route::post('restore/{id}', [HelpdeskController::class, 'restore'])->name('admin.helpdesk.restore');

    // force delete a ticket
    Route::delete('force-delete/{ticket}', [HelpdeskController::class, 'forceDelete'])->name('admin.helpdesk.forceDelete');

});

