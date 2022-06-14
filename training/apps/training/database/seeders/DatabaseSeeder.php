<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Create admin
        User::create([
            'user_name' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'role' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        // Create user
        User::create([
            'user_name' => 'user',
            'first_name' => 'Normal',
            'last_name' => 'User',
            'role' => 0,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        User::factory()
            ->count(10)
            ->hasArticles(5)
            ->hasCategories(5)
            ->create();
    }
}
