<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransactionController extends Controller
{
    public function apiShow(Request $request, $user_id)
    {
        $transactions = Transaction::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return $transactions;
    }

    public function show(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $transactions = Transaction::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        $totalDeposits = Transaction::where('user_id', $user_id)->where('type', 'Depósito')->sum('amount');
        $totalWithdrawals = Transaction::where('user_id', $user_id)->where('type', 'Retiro')->sum('amount');
        $balance = $totalDeposits - $totalWithdrawals;

        return view('transactions.show', compact('transactions', 'user', 'balance'));
    }

    public function apiDeposit(Request $request, $user_id)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $transaction = Transaction::create([
            'user_id' => $user_id,
            'type' => 'Depósito',
            'amount' => $request->amount,
        ]);

        return $transaction;
    }

    public function deposit(Request $request, $user_id)
    {
        // $request->validate([
        //     'user_id' => 'required|integer',
        //     'type' => 'required|string',
        //     'amount' => 'required|numeric',
        // ]);

        $transaction = Transaction::create([
            'user_id' => $user_id,
            'type' => 'Depósito',
            'amount' => $request->amount,
        ]);

        return redirect()->route('transactions.show', $user_id);
    }

    public function apiWithdraw(Request $request, $user_id)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $transaction = Transaction::create([
            'user_id' => $user_id,
            'type' => 'Retiro',
            'amount' => $request->amount,
        ]);

        return $transaction;
    }

    public function withdraw(Request $request, $user_id)
    {
        // $request->validate([
        //     'user_id' => 'required|integer',
        //     'type' => 'required|string',
        //     'amount' => 'required|numeric',
        // ]);

        $transaction = Transaction::create([
            'user_id' => $user_id,
            'type' => 'Retiro',
            'amount' => $request->amount,
        ]);

        return redirect()->route('transactions.show', $user_id);
    }

    public function apiBalance(Request $request, $user_id)
    {
        $totalDeposits = Transaction::where('user_id', $user_id)->where('type', 'Depósito')->sum('amount');
        $totalWithdrawals = Transaction::where('user_id', $user_id)->where('type', 'Retiro')->sum('amount');
        $balance = $totalDeposits - $totalWithdrawals;

        return $balance;
    }
}
