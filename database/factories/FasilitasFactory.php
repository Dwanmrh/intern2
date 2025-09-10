<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FasilitasFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => $this->faker->word(),
            'deskripsi' => $this->faker->paragraph(),
            'tanggal' => now(),
            'foto' => 'fasilitas.jpg',
        ];
    }
}
