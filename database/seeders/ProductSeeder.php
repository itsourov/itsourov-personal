<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::factory(30)->create();



        // foreach (\App\Models\Product::all() as $product) {
        //     for ($i = 0; $i < 4; $i++) {
        //         $product->addMedia(fake()->imageUrl())

        //             ->toMediaCollection('productImages', 'product-image');
        //     }
        // }
    }
}