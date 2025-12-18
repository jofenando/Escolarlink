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
        Schema::create('calificacion_finals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calificacion_id')->constrained('calificacions')->cascadeOnDelete();
			$table->string('asignatura');
			$table->string('observaciones');
			$table->string('nota_final');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacion_finals');
    }
};
