<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Execute dependent seeders in order
        $this->call([
            SchoolSeeder::class,
            TrackSeeder::class,
            ElectiveSeeder::class,
            UserSeeder::class,
        ]);

        // Generate 50 dummy users using the UserFactory
        User::factory()->count(50)->create();
    }
}
