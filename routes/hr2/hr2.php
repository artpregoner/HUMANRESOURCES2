<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR2\HR2Controller;

Route::middleware(['auth', 'role:hr'])->group(function(){
    Route::get('/hr2', [HR2Controller::class, 'index'])->name('hr2.index');
    Route::get('/hr2/myprofile', [HR2Controller::class, 'myprofile'])->name('hr2.myprofile');
});
require __DIR__ . '/helpdesk.php';
require __DIR__ . '/claims.php';
