<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeRequestController;
use App\Http\Controllers\Api\Claims\ClaimPayrollController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::post('login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return response()->json([
        'token' => $user->createToken('api-token')->plainTextToken
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('employee-requests', EmployeeRequestController::class);

Route::prefix('claims')->middleware('auth:sanctum')->group(function () {
    Route::get('approved', [ClaimPayrollController::class, 'getApprovedClaims']);
    Route::post('send-to-payroll', [ClaimPayrollController::class, 'sendToPayroll']);
    Route::post('payroll-update', [ClaimPayrollController::class, 'handlePayrollUpdate']);
});
