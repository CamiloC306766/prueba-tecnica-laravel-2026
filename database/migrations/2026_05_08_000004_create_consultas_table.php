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
            $table->foreignId('mascota_id')
                ->constrained('mascotas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('veterinario_id')
                ->constrained('veterinarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('motivo');
            $table->text('diagnostico')->nullable();
            $table->enum('estado', ['pendiente', 'en_progreso', 'completada', 'cancelada']);
            $table->date('fecha_consulta');
            $table->timestamps();
            $table->softDeletes();
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
