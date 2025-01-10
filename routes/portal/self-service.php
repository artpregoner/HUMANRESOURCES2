<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\SelfServiceController;




Route::prefix('portal/self-service')->group(function(){
    Route::get('/payslip', [SelfServiceController::class,'index'])->name('portal.ess.index');
});
