<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds), // Asignar un usuario aleatorio
            'amount' => $this->faker->randomFloat(2, 1, 1000), // Cantidad aleatoria entre 1 y 1000
            'type' => $this->faker->randomElement(['Depósito', 'Retiro']), // Tipo de transacción aleatoria
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Fecha de creación aleatoria en el último año
            'updated_at' => now(),
        ];
    }
}
