<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Propietario;
use App\Models\Mascota;

class PropietarioMascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Propietario::factory(10)->create()->each(function ($propietario) {
            $mascotasCount = rand(1, 3); // Cada propietario tendrá entre 1 y 3 mascotas
            Mascota::factory($mascotasCount)->create([
                'propietario_id' => $propietario->id,
            ]);
        });
    }
}
