<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\models\Propietario;
use App\Http\Requests\Mascotas\StoreMascotaRequest;
use App\Http\Requests\Mascotas\UpdateMascotaRequest;

class ExerciseBasicsController extends Controller
{
    public function getAllPets()
    {
        $data = Mascota::with('propietario')->paginate(15);

        return response()->json($data);
    }

    public function save(StoreMascotaRequest $request)
    {
        $mascota = Mascota::create($request->validated());
        $mascota->load('propietario');

        return response()->json(['ok' => true, 'mascota' => $mascota],201);
    }

    public function getPet(Mascota $mascota)
    {
        Mascota::findOrFail($mascota->id);
        $mascota->load('propietario');

        return response()->json([
            'mascota' => $mascota,
        ]);
    }

    public function updatePet(UpdateMascotaRequest $request, Mascota $mascota)
    {
        Mascota::findOrFail($mascota->id);
        $mascota->update($request->validated());
        $mascota->load('propietario');

        return response()->json(['ok' => true, 'mascota' => $mascota]);
    }

    public function deletePet(Mascota $mascota)
    {
        Mascota::findOrFail($mascota->id);
        $mascota->delete();

        return response()->json(['ok' => true], 204);
    }

    
}
