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
            $table->foreignId('consulta_id')
                ->constrained('consultas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('descripcion');
            $table->string('dosis')->nullable();
            $table->string('duracion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
