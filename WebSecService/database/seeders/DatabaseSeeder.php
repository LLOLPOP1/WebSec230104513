<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Remove the direct User::factory() call
        $this->call([
            TestUsersSeeder::class,
            ProductSeeder::class, // We'll create this next
        ]);
    }
}
