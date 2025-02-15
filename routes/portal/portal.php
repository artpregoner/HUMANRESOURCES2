<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\PortalController;


Route::middleware(['auth'])->group(function(){
    Route::get('/portal', [PortalController::class, 'home'])->name('home');
    Route::get('/portal/myprofile',[PortalController::class,'myprofile'])->name('portal.myprofile');
});
// other routes
require __DIR__ . '/self-service.php';
require __DIR__ . '/helpdesk.php';
require __DIR__ . '/claims.php';
