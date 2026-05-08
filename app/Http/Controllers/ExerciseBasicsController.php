<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\models\Propietario;

class ExerciseBasicsController extends Controller
{
    public function getAllPets()
    {
        $data = \DB::select('SELECT * FROM mascotas');

        return response()->json($data);
    }

    public function save(Request $r)
    {
        $m = new Mascota();
        $m->nombre      = $r->nombre;
        $m->especie     = $r->especie;
        $m->raza        = $r->raza;
        $m->peso        = $r->peso;
        $m->fecha_nac   = $r->fecha_nacimiento;
        $m->propietario = $r->propietario_id;
        $m->save();

        return response()->json(['ok' => true]);
    }

    public function getPet($id)
    {
        $mascota = \DB::select('SELECT * FROM mascotas WHERE id = ' . $id);

        $dueno = \DB::select('SELECT * FROM propietarios WHERE id = ' . $mascota[0]->id_propietario);

        return response()->json([
            'mascota' => $mascota[0],
            'dueno'   => $dueno[0],
        ]);
    }

    public function deletePet($id)
    {
        \DB::statement('DELETE FROM mascotas WHERE id = ' . $id);

        return response()->json('deleted');
    }

    public function updatePet($id, Request $r)
    {
        $fields = $r->all();

        foreach ($fields as $campo => $valor) {
            \DB::statement("UPDATE mascotas SET {$campo} = '{$valor}' WHERE id = {$id}");
        }

        return 200;
    }
}
