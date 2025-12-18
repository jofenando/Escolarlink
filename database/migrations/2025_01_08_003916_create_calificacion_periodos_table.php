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
        Schema::create('calificacion_periodos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calif_final_id')->constrained('calificacion_finals')->cascadeOnDelete();
            $table->string('asignatura');
            $table->string('prom_periodo_1'); //promedio periodo_1
            $table->string('prom_periodo_2'); //promedio periodo_2
            $table->string('prom_periodo_3'); //promedio periodo_3
            $table->string('prom_periodo_4'); //promedio periodo_4
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacion_periodos');
    }
};
