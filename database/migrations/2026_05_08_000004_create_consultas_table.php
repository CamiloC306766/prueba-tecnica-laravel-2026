<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->integer('mascota_id');
            $table->integer('veterinario_id');
            $table->string('motivo');
            $table->text('diagnostico')->nullable();
            $table->string('estado', 20);
            $table->date('fecha_consulta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
