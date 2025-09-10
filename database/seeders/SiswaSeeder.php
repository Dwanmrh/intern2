<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            User::updateOrCreate(
                ['email' => "siswa{$i}@gmail.com"],
                [
                    'name' => "Siswa {$i}",
                    'password' => Hash::make('Siswa890'),
                    'role' => 'siswa',
                ]
            );
        }
    }
}
