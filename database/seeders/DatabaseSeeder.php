<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user = \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
        ]);

        \App\Models\Post::factory(30)->create([
            'user_id' => $user->id
        ]);
    }
}