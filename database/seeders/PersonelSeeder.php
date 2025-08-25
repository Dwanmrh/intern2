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
        // Buat akun personel default
        User::create([
            'name' => 'Personel SIP',
            'email' => 'personelsip@personel.com',
            'password' => Hash::make('Personel890'),
            'role' => 'personel',
        ]);

        // Kalau perlu beberapa akun personel
        User::create([
            'name' => 'Personel PAG',
            'email' => 'personelpag@personel.com',
            'password' => Hash::make('Personel890'),
            'role' => 'personel',
        ]);
    }
}
