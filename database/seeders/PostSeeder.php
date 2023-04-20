<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Post::factory(20)->create();

        foreach (Post::all() as $post) {

            $post->addMediaFromUrl(fake()->imageUrl(1280, 720))
                ->withResponsiveImages()
                ->toMediaCollection('post-thumbnails', 'post-thumbnails');
        }
    }
}