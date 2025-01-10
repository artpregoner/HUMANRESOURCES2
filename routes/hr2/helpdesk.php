<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR2\HelpdeskController;

Route::get('/hr2/helpdesk/list', [HelpdeskController::class, 'index'])->name('hr2.helpdesk.index');
// Route::get('/hr2/helpdesk/create', [HelpdeskController::class, 'create'])->name('portal.helpdesk.create');
// Route::get('/hr2/helpdesk/edit',[HelpdeskController::class, 'edit'])->name('portal.helpdesk.edit');

//reponse in helpdesk
Route::get('/hr2/helpdesk/canned-response',[HelpdeskController::class, 'responseHelpdesk'])->name('hr2.helpdesk.response');


