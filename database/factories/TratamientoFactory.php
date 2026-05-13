<?php

namespace Database\Factories;

use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tratamiento>
 */
class TratamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'consulta_id' => \App\Models\Consulta::factory(),
            'descripcion' => $this->faker->sentence(),
            'dosis' => $this->faker->randomFloat(2, 0.1, 10),
            'duracion' => $this->faker->numberBetween(1, 30) . ' días',
        ];
    }
}
