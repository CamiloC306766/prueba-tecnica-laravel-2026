<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropietarioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'telefono' => fake()->optional()->phoneNumber(),
            'direccion' => fake()->optional()->address(),
        ];
    }
}
