<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        // foreach (User::all() as $user) {
        //     $user->addMediaFromUrl(fake()->imageUrl())

        //         ->toMediaCollection('profile-image', 'profile-image');

        // }
    }
}