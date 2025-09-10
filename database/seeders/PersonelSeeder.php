<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PersonelSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => "personel{$i}@gmail.com"],
                [
                    'name' => "Personel {$i}",
                    'password' => Hash::make('Personel890'),
                    'role' => 'personel',
                ]
            );
        }
    }
}
