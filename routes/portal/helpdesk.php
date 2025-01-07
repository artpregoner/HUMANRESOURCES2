<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\HelpdeskController;

Route::get('/portal/helpdesk/list', [HelpdeskController::class, 'index'])->name('portal.helpdesk.index');
Route::get('/portal/helpdesk/create', [HelpdeskController::class, 'create'])->name('portal.helpdesk.create');
Route::get('/portal/helpdesk/edit',[HelpdeskController::class, 'edit'])->name('portal.helpdesk.edit');

//reponse in helpdesk
Route::get('/portal/helpdesk/canned-response',[HelpdeskController::class, 'responseHelpdesk'])->name('portal.helpdesk.response');
