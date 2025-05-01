<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'teamticket@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone' => '0987654321',
            
        ]);

        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('john321'),
            'role' => 'user',
            'phone' => '1234567890',
        ]);
    }
}
