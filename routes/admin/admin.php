<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CreateEmployeeController;


Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');


    Route::get('/self-service/employee', [CreateEmployeeController::class, 'index'])->name('admin.create.employee');
    Route::get('/self-service/employee/show/{id}', [CreateEmployeeController::class, 'show'])->name('admin.show.employee');
    Route::get('/self-service/employee/list', [CreateEmployeeController::class, 'employeeList'])->name('admin.index.employee');

    Route::post('/self-service/employee/create/user', [CreateEmployeeController::class, 'createUser'])->name('admin.create.user');

    Route::post('/self-service/employee/store', [CreateEmployeeController::class, 'store'])->name('admin.create.employee.store');
});
require __DIR__ . '/helpdesk.php';
require __DIR__ . '/claims.php';
