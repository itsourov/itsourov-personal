<?php

namespace Database\Seeders;

use App\Enums\DownloadLinkType;
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
            // $product->addMedia(fake()->image())
            //     ->toMediaCollection('product-thumbnails', 'product-thumbnails');
            // $product->addMedia(fake()->image())
            //     ->toMediaCollection('product-images', 'product-images');
            // $product->addMedia(fake()->image())
            //     ->toMediaCollection('product-images', 'product-images');
            // $product->addMedia(fake()->image())
            //     ->toMediaCollection('product-images', 'product-images');

            for ($i = 0; $i < 30; $i++) {

                $product->downloadItems()->create([
                    'type' => DownloadLinkType::toArray()[rand(0, 2)],
                    'title' => fake()->text(100),
                    'content' => fake()->url(),
                    'size' => random_int(1, 50) . ' MB',
                ]);
            }
        }
    }
}