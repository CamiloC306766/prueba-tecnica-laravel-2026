<?php

namespace Database\Factories;

use App\Models\Mascota;
use App\Models\Veterinario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'mascota_id' => Mascota::factory(),
            'veterinario_id' => Veterinario::factory(),
            'motivo' => fake()->sentence(),
            'diagnostico' => fake()->optional()->paragraph(),
            'estado' => fake()->randomElement(['pendiente', 'en_progreso', 'completada', 'cancelada']),
            'fecha_consulta' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }

    public function pendiente(): static
    {
        return $this->state(fn() => ['estado' => 'pendiente']);
    }

    public function completada(): static
    {
        return $this->state(fn() => ['estado' => 'completada']);
    }
}
