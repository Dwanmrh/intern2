<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'jabatan' => $this->faker->jobTitle(),
            'foto' => 'profil.jpg',
        ];
    }
}
