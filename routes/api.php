<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseBasicsController;

Route::prefix('v1')->group(function () {
    Route::get('/mascotas',          [ExerciseBasicsController::class, 'getAllPets']);
    Route::post('/mascotas',         [ExerciseBasicsController::class, 'save']);
    Route::get('/mascotas/{id}',     [ExerciseBasicsController::class, 'getPet']);
    Route::put('/mascotas/{id}',     [ExerciseBasicsController::class, 'updatePet']);
    Route::delete('/mascotas/{id}',  [ExerciseBasicsController::class, 'deletePet']);
});
