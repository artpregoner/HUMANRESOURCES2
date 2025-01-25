<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\HelpdeskController;


Route::prefix('portal/helpdesk')->group(function () {
    Route::get('/list', [HelpdeskController::class, 'index'])->name('portal.helpdesk.index');
    Route::get('/create', [HelpdeskController::class, 'create'])->name('portal.helpdesk.create');
    Route::get('/edit',[HelpdeskController::class, 'edit'])->name('portal.helpdesk.edit');


    //reponse in helpdesk
    Route::get('/canned-response',[HelpdeskController::class, 'responseHelpdesk'])->name('portal.helpdesk.response');
});
// ->middleware(['auth', 'role:employee'])
