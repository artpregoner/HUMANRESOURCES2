<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
Route::get('/myprofile', [AdminController::class, 'myprofile'])->name('admin.myprofile');

require __DIR__ . '/helpdesk.php';
// require __DIR__ . '/claims.php';
