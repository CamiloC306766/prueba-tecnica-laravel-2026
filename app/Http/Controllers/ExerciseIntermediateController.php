<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Notificadores\MailNotificador;
use App\Http\Services\ConsultaService;
use App\Http\Requests\Consulta\StoreConsultaRequest;
use App\Http\Requests\Consulta\UpdateConsultaRequest;
use App\Http\Resources\ConsultaResource;

class ExerciseIntermediateController extends Controller
{
    protected $consultaService;

    public function __construct(ConsultaService $consultaService)
    {
        $this->consultaService = $consultaService;
    }

    public function index(Request $request)
    {
        $estado = $request->query('estado');

        $resultado = $this->consultaService->getConsultas($estado);

        return response()->json(ConsultaResource::collection($resultado));
    }

    public function store(StoreConsultaRequest $request)
    {
       
        $consulta = $this->consultaService->createConsulta($request->validated());
        return response()->json(ConsultaResource::make($consulta), 201);
    }

    public function show(Consulta $consulta)
    {
        $consulta = $this->consultaService->getOneConsulta($consulta);

        return response()->json(ConsultaResource::make($consulta));
    }

    public function update(UpdateConsultaRequest $request, Consulta $consulta)
    {
        $consulta = $this->consultaService->updateConsulta($consulta, $request->validated());

        return response()->json(ConsultaResource::make($consulta));
    }

    public function destroy(Consulta $consulta)
    {
        $consulta = $this->consultaService->deleteConsulta($consulta);

        return response()->json(null, 204);
    }

    
}
