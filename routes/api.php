<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseBasicsController;
use App\Http\Controllers\ExerciseIntermediateController;

Route::prefix('v1')->group(function () {
    // Ejercicio 1 — CRUD de mascotas
    Route::get('/mascotas',          [ExerciseBasicsController::class, 'getAllPets']);
    Route::post('/mascotas',         [ExerciseBasicsController::class, 'save']);
    Route::get('/mascotas/{id}',     [ExerciseBasicsController::class, 'getPet']);
    Route::put('/mascotas/{id}',     [ExerciseBasicsController::class, 'updatePet']);
    Route::delete('/mascotas/{id}',  [ExerciseBasicsController::class, 'deletePet']);

    // Ejercicio 2 — CRUD de consultas
    Route::get('/consultas/por-estado/{estado}', [ExerciseIntermediateController::class, 'porEstado']);
    Route::get('/consultas',                     [ExerciseIntermediateController::class, 'index']);
    Route::post('/consultas',                    [ExerciseIntermediateController::class, 'store']);
    Route::get('/consultas/{id}',                [ExerciseIntermediateController::class, 'show']);
    Route::put('/consultas/{id}',                [ExerciseIntermediateController::class, 'update']);
    Route::delete('/consultas/{id}',             [ExerciseIntermediateController::class, 'destroy']);
});
