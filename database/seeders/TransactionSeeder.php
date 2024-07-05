<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Transaction::factory()->count(100)->create();

        // Obtener todos los IDs de usuarios disponibles
        $userIds = User::pluck('id')->toArray();

        foreach ($userIds as $userId) {
            // Verificar cuántas transacciones tiene el usuario actual
            $countTransactions = Transaction::where('user_id', $userId)->count();

            // Generar transacciones adicionales si el usuario tiene menos de 5 transacciones
            $transactionsNeeded = 5 - $countTransactions;

            if ($transactionsNeeded > 0) {
                Transaction::factory()->count($transactionsNeeded)->create(['user_id' => $userId]);
            }
        }
    }
}
