<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('transactions/{user_id}/show', [TransactionController::class, 'apiShow']);
    Route::post('transactions/{user_id}/deposit', [TransactionController::class, 'apiDeposit']);
    Route::post('transactions/{user_id}/withdraw', [TransactionController::class, 'apiWithdraw']);
    Route::post('transactions/{user_id}/balance', [TransactionController::class, 'apiBalance']);
});
