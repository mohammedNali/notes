<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();


         $user = \App\Models\User::factory()->create([
             'name' => 'Super Admin',
             'email' => 'test@example.com',
             'password' => '1234567890'
         ]);

        \App\Models\Note::factory(10)->create([
            'user_id' => $user->id
        ]);
    }
}
