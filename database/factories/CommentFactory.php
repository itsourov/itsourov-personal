<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bool = fake()->boolean();
        return [
            'user_id' => User::get()->random()->id,
            'comment' => fake()->text(),
            'rating' => random_int(1, 5),
            'commentable_id' => $bool ? Post::get()->random()->id : Product::get()->random()->id,
            'commentable_type' => $bool ? Post::class : Product::class,
        ];
    }
}