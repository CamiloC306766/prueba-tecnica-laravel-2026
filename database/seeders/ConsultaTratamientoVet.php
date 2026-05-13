<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Consulta;
use App\Models\Tratamiento;
use App\Models\Veterinario;

class ConsultaTratamientoVet extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos veterinarios
        $veterinarios = Veterinario::factory(5)->create()->each(function ($veterinario) {
            // Para cada veterinario, crear algunas consultas
            $consultas = Consulta::factory(3)->create([
                'veterinario_id' => $veterinario->id,
            ])->each(function ($consulta) {
                Tratamiento::factory(rand(1, 3))->create([
                    'consulta_id' => $consulta->id,
                ]);
            });
        });

    
    }
}
