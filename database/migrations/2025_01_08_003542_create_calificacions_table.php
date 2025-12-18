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
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matriculas_id')->constrained('matriculas')->cascadeOnDelete();
			$table->string('estudiante');
            $table->string('grado');
			$table->string('año_escolar');
            $table->string('docente');
			$table->string('obser_periodo_1');
			$table->string('obser_periodo_2');
			$table->string('obser_periodo_3');
			$table->string('obser_periodo_4');
			$table->string('comentario_final');
			$table->string('firma_docente');
			$table->string('firma_directora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};
