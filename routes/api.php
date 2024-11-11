<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::delete('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/balance', [BalanceController::class, 'show']);

    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::post('/deposit', [TransactionController::class, 'deposit']);
    Route::post('/transactions', [TransactionController::class, 'transfer']);
    Route::delete('/transactions/{id}', [TransactionController::class, 'cancel']);
});
