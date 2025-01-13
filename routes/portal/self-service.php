<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\EmployeePayslipController;




Route::prefix('portal/self-service')->group(function(){
    Route::get('/payslip', [EmployeePayslipController::class,'index'])->name('portal.ess.payslip.index');
});
