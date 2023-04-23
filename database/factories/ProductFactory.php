<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sellingPrice = fake()->numberBetween(20, 399);
        return [
            'title' => fake()->text(200),
            'slug' => fake()->slug(),
            'featured_image' => 'https://picsum.photos/600/400',
            'images' => ['https://picsum.photos/601/400', 'https://picsum.photos/601/401'],
            'selling_price' => $sellingPrice,
            'original_price' => fake()->numberBetween($sellingPrice, 399),
            'short_description' => fake()->paragraph(5),
            'long_description' => fake()->paragraph(15),

        ];
    }
}