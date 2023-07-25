<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        \App\Models\User::factory(9)->create();


        // seeding the priority table
        \App\Models\Priority::factory()->create([
            'priority' => 'Low',
            'priority_order' => 1
        ]);

        \App\Models\Priority::factory()->create([
            'priority' => 'Medium',
            'priority_order' => 2
        ]);

        \App\Models\Priority::factory()->create([
            'priority' => 'High',
            'priority_order' => 3
        ]);

        // seeding the tasklist table
        \App\Models\Tasklist::factory()->create([
            'user_id' => 1,
            'title' => 'My First Tasklist',
            'color' => '#FF0000',
        ]);

        \App\Models\Tasklist::factory(5)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
