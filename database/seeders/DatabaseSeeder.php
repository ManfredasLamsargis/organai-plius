<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create(); // creates 10 random users

        // Admin
        $this->call([
            DeliverySeeder::class,
            BodyPartTypeSeeder::class,
            MessageSeeder::class,
        ]);

        // Client
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // optional
        ]);
    }
}
