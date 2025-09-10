<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BeritaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(),
            'isi_berita' => $this->faker->paragraph(),
            'tanggal' => now(),
            'foto' => 'default.jpg',
            'file_berita' => 'file.pdf',
        ];
    }
}
