<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(2)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'business@example.com',
            'avatar' => 'https:\/\/ui-avatars.com\/api\/?name=Hello"'
        ]);

        $this->call([
            JobOpeningSeeder::class,
        ]);
    }
}