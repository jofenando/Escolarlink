<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calificacion_indicadors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calif_perido_id')->constrained('calificacion_periodos')->cascadeOnDelete();
            $table->string('asignatura');
            $table->string('indicador'); //varios indicadores por asignatura
            $table->string('periodo_1'); 
            $table->string('periodo_2');
            $table->string('periodo_3');
            $table->string('periodo_4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacion_indicadors');
    }
};
