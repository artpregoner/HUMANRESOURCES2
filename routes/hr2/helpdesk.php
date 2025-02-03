<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR2\HelpdeskController;
// use App\Livewire\Hr2\Helpdesk\Index;
// use App\Livewire\Hr2\Helpdesk\Show;

// Route::prefix('hr2/helpdesk')->group(function () {
//     Route::get('/list', Index::class)->name('hr2.helpdesk.index');
//     Route::get('/show/{ticketId}', Show::class)->name('hr2.helpdesk.show');
// });

Route::prefix('hr2/helpdesk')->group(function(){
    Route::get('/list', [HelpdeskController::class, 'index'])->name('hr2.helpdesk.index');

    // Show ticket details and responses
    Route::get('ticket/{ticket}', [HelpdeskController::class, 'show'])->name('hr2.helpdesk.show');
    // Add a response to a specific ticket
    Route::post('ticket/{ticket}/respond', [HelpdeskController::class, 'respond'])->name('hr2.helpdesk.respond');

    // Delete a ticket
    Route::delete('ticket/{ticket}', [HelpdeskController::class, 'destroy'])->name('hr2.helpdesk.destroy');

    //update ticket status
    Route::patch('/helpdesk/{ticket}/update-status', [HelpdeskController::class, 'updateStatus'])->name('hr2.helpdesk.updateStatus');

});

