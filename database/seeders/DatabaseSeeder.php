<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Assuming you've created UsersTableSeeder, CarsTableSeeder, TransactionsTableSeeder, and CarImagesTableSeeder

        // Seed the default user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Call other seeders
        $this->call([
            UsersTableSeeder::class,
            CarsTableSeeder::class,
            TransactionsTableSeeder::class,
            CarImagesTableSeeder::class,
        ]);
    }
}
