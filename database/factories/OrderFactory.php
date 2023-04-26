<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::get()->random();
        return [
            'user_id' => $user->id,
            'order_total' => random_int(10, 1000),
            'order_status' => OrderStatus::toArray()[random_int(0, count(OrderStatus::toArray()) - 1)],
            'name' => $user->name,
            'email' => $user->email,
            'phone' => fake()->phoneNumber(),
            'payment_method' => PaymentMethod::toArray()[random_int(0, count(PaymentMethod::toArray()) - 1)],
            'payment_status' => PaymentStatus::toArray()[random_int(0, count(PaymentStatus::toArray()) - 1)],
        ];
    }
}