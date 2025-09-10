<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DashboardFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(),
            'tanggal' => now(),
            'file' => 'dashboard.pdf',
        ];
    }
}
