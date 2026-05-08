<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VeterinarioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'especialidad' => fake()->randomElement(['Cirugía', 'Dermatología', 'Medicina General', 'Ortopedia']),
            'numero_colegiado' => fake()->unique()->numerify('VET-####'),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
