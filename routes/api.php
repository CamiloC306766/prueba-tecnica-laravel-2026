<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseBasicsController;
use App\Http\Controllers\ExerciseIntermediateController;

Route::prefix('v1')->group(function () {
    Route::prefix('mascotas')->controller(ExerciseBasicsController::class)->group(function () {
        // Ejercicio 1 — CRUD de mascotas
        Route::get('/',          'getAllPets');
        Route::post('/',         'save');
        Route::get('/{mascota}', 'getPet');
        Route::put('/{mascota}', 'updatePet');
        Route::delete('/{mascota}', 'deletePet');
    });

    Route::prefix('consultas')->controller(ExerciseIntermediateController::class)->group(function () {
        // Ejercicio 2 — CRUD de consultas
        // Route::get('/por-estado/{estado}', 'porEstado');
        Route::get('/',                     'index');
        Route::post('/',                    'store');
        Route::get('/{consulta}',                'show');
        Route::put('/{consulta}',                'update');
        Route::delete('/{consulta}',             'destroy');
        });
    });
