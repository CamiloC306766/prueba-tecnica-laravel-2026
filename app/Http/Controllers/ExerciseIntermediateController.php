<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Notificadores\MailNotificador;

class ExerciseIntermediateController extends Controller
{
    public function index()
    {
        $consultas = Consulta::all();

        $resultado = [];
        foreach ($consultas as $consulta) {
            $resultado[] = [
                'id' => $consulta->id,
                'fecha' => $consulta->fecha_consulta,
                'motivo' => $consulta->motivo,
                'estado' => $consulta->estado,
                'mascota' => $consulta->mascota->nombre,
                'veterinario' => $consulta->veterinario->nombre,
                'tratamientos' => $consulta->tratamientos->count(),
            ];
        }

        return response()->json($resultado);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'veterinario_id' => 'required|exists:veterinarios,id',
            'motivo' => 'required|string',
            'fecha_consulta' => 'required|date',
        ]);

        $consulta = new Consulta();
        $consulta->mascota_id = $request->mascota_id;
        $consulta->veterinario_id = $request->veterinario_id;
        $consulta->motivo = $request->motivo;
        $consulta->fecha_consulta = $request->fecha_consulta;
        $consulta->estado = 'pendiente';
        $consulta->save();

        $notificador = new MailNotificador();
        $notificador->notificar($consulta);

        return response()->json($consulta->toArray(), 201);
    }

    public function show($id)
    {
        $consulta = Consulta::find($id);

        if (!$consulta) {
            abort(404, 'Consulta no encontrada');
        }

        return response()->json($consulta->toArray());
    }

    public function update(Request $request, $id)
    {
        $consulta = Consulta::find($id);

        if (!$consulta) {
            abort(404);
        }

        $consulta->fill($request->all());
        $consulta->save();

        (new MailNotificador())->notificar($consulta);

        return response()->json($consulta);
    }

    public function destroy($id)
    {
        $consulta = Consulta::find($id);

        if (!$consulta) {
            abort(404);
        }

        $consulta->delete();

        return response()->json(null, 204);
    }

    public function porEstado($estado)
    {
        $consultas = \DB::select("SELECT * FROM consultas WHERE estado = '$estado'");

        return response()->json($consultas);
    }
}
