<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admmin',
            'email' => 'admi@gmail.com',
            'password' => bcrypt('123456789'),

        ]);
        Product::factory(200)->create();
        Client::factory(50)->create();
    }
}
