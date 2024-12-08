<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\HelpdeskController;

Route::get('/portal/helpdesk/create', [HelpdeskController::class, 'create'])->name('create');
Route::get('/portal/helpdesk/list', [HelpdeskController::class, 'read'])->name('read');
