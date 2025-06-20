<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'role'     => 'admin',
        ]);

        // Add salesperson
        User::create([
            'name'     => 'Salesperson',
            'email'    => 'salesperson@example.com',
            'password' => bcrypt('12345678'),
            'role'     => 'salesperson',
        ]);
    }
}
