<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('transactions/{user_id}/show', [TransactionController::class, 'show'])->name('transactions.show');
Route::post('transactions/{user_id}/deposit', [TransactionController::class, 'deposit'])->name('deposit.store');
Route::post('transactions/{user_id}/withdraw', [TransactionController::class, 'withdraw'])->name('withdraw.store');
