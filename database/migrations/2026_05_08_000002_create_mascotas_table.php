<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('especie');
            $table->string('raza')->nullable();
            $table->integer('peso');
            $table->date('fecha_nac');
            $table->integer('id_propietario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
