<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'url' => $this->faker->url(),
            'logo' => 'logo.png',
        ];
    }
}
