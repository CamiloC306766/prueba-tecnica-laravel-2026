<?php

namespace Database\Factories;

use App\Models\Propietario;
use Illuminate\Database\Eloquent\Factories\Factory;

class MascotaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'propietario_id' => Propietario::factory(),
            'nombre' => fake()->firstName(),
            'especie' => fake()->randomElement(['perro', 'gato', 'conejo', 'ave']),
            'raza' => fake()->optional()->word(),
            'peso' => fake()->randomFloat(2, 0.5, 80),
            'fecha_nacimiento' => fake()->dateTimeBetween('-15 years', '-1 month')->format('Y-m-d'),
        ];
    }
}
