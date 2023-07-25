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

         $tags = ['Laravel', 'TypeScript', 'JavaScript', 'HTML', 'CSS'];
         foreach ($tags as $tag) {
             \App\Models\Tag::factory()->create([
                 'name' => $tag
             ]);
         }

        $user = \App\Models\User::factory()->create([
             'name' => 'Super Admin',
             'email' => 'test@example.com',
             'password' => '1234567890'
         ]);

        $user2 = \App\Models\User::factory()->create([
            'name' => 'Admin2',
            'email' => 'test2@example.com',
            'password' => '1234567890'
        ]);

        \App\Models\Note::factory(10)->create([
            'user_id' => $user->id
        ]);

    }
}
