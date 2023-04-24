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



        foreach (\App\Models\Product::all() as $product) {
            $product->addMediaFromUrl(fake()->imageUrl())
                ->toMediaCollection('product-thumbnails', 'product-thumbnails');
            $product->addMediaFromUrl(fake()->imageUrl())
                ->toMediaCollection('product-images', 'product-images');
            $product->addMediaFromUrl(fake()->imageUrl())
                ->toMediaCollection('product-images', 'product-images');
            $product->addMediaFromUrl(fake()->imageUrl())
                ->toMediaCollection('product-images', 'product-images');
        }
    }
}