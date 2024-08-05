<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        if ($user->count() == 0) {
            if ($user->where('role', 'admin')->count() == 0) {
                $user->create([
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'password' => bcrypt('password123'),
                    'role' => 'admin',
                ]);
            }

            if ($user->where('role', 'user')->count() == 0) {
                $user->create([
                    'name' => 'User',
                    'email' => 'user@example.com',
                    'password' => bcrypt('password123'),
                    'role' => 'user',
                ]);
            }

            if ($user->where('role', 'operator')->count() == 0) {
                $user->create([
                    'name' => 'Operator',
                    'email' => 'operator@example.com',
                    'password' => bcrypt('password123'),
                    'role' => 'operator',
                ]);
            }
        }
    }
}
