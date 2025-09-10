<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InformasiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(),
            'deskripsi' => $this->faker->paragraph(),
            'file_informasi' => 'informasi.pdf',
            'tanggal' => now(),
            'foto' => 'informasi.jpg',
        ];
    }
}
