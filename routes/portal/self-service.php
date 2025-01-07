<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\SelfServiceController;




Route::get('/portal/self-service/payslip', [SelfServiceController::class,'index'])->name('portal.ess.index');
