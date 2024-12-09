<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\HelpdeskController;

Route::get('/portal/helpdesk/create', [HelpdeskController::class, 'create'])->name('helpdesk.create');
Route::get('/portal/helpdesk/list', [HelpdeskController::class, 'read'])->name('helpdesk.read');
Route::get('/portal/helpdesk/update',[HelpdeskController::class, 'update'])->name('helpdesk.update');
