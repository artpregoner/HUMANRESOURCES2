<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\HelpdeskController;

Route::get('/portal/helpdesk/create', [HelpdeskController::class, 'create'])->name('portal.helpdesk.create');
Route::get('/portal/helpdesk/list', [HelpdeskController::class, 'read'])->name('portal.helpdesk.read');
Route::get('/portal/helpdesk/update',[HelpdeskController::class, 'update'])->name('portal.helpdesk.update');
Route::get('/portal/helpdesk/canned-response',[HelpdeskController::class, 'responseHelpdesk'])->name('portal.helpdesk.response');
