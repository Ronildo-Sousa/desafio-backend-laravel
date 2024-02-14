<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $sender_id = User::factory()->create(['type' => UserType::Regular->value])->id;
        $random = rand(0, count(TransactionStatus::cases()));

        return [
            'sender_id' => $sender_id,
            'receiver_id' => User::factory(),
            'amount' => fake()->numberBetween(1, 999999999),
            'status' => TransactionStatus::cases()[$random]->value,
        ];
    }
}
