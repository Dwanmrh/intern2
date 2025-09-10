<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ModulFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(),
            'deskripsi' => $this->faker->paragraph(),
            'prodiklat' => 'SIP',
            'mapel' => $this->faker->word(),
            'tahun' => now()->year,
            'file' => 'modul.pdf',
        ];
    }
}
