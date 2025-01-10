<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR2\HelpdeskController;


Route::prefix('hr2/helpdesk')->group(function(){
    Route::get('/list', [HelpdeskController::class, 'index'])->name('hr2.helpdesk.index');

    //reponse in helpdesk
    Route::get('/canned-response',[HelpdeskController::class, 'responseHelpdesk'])->name('hr2.helpdesk.response');
});

