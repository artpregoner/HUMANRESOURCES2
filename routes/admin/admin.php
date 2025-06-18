<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CreateEmployeeController;
use App\Http\Controllers\Admin\WorkforceController;


Route::middleware(['auth', 'role:admin|hr'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware('verified')->name('admin.index');


    Route::get('/self-service/employee', [CreateEmployeeController::class, 'index'])->name('admin.create.employee');
    Route::get('/self-service/employee/show/{id}', [CreateEmployeeController::class, 'show'])->name('admin.show.employee');
    Route::get('/self-service/employee/list', [CreateEmployeeController::class, 'employeeList'])->name('admin.index.employee');

    Route::post('/self-service/employee/create/user', [CreateEmployeeController::class, 'createUser'])->name('admin.create.user');

    Route::post('/self-service/employee/store', [CreateEmployeeController::class, 'store'])->name('admin.create.employee.store');

    Route::get('/workforce/analytics', [WorkforceController::class, 'index'])->name('admin.workforce.index');

});
require __DIR__ . '/helpdesk.php';
require __DIR__ . '/claims.php';
