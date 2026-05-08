<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
            $table->integer('consulta_id');
            $table->string('descripcion');
            $table->string('dosis')->nullable();
            $table->string('duracion')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
