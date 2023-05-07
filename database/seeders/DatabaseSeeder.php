<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Storage;
use Database\Seeders\PostCategorySeeder;
use Database\Seeders\ProductCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Storage::deleteDirectory('public');





        $this->call(PostCategorySeeder::class);
        $this->call(ProductCategorySeeder::class);

        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(OrderSeeder::class);
    }
}