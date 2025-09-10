<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => "admin{$i}@gmail.com"],
                [
                    'name' => "Super Admin {$i}",
                    'password' => Hash::make('Admin890'),
                    'role' => 'admin',
                ]
            );
        }
    }
}
