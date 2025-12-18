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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matricula_id')->constrained('matricula_id')->cascadeOnDelete();
            $table->string('nombre_docente');
            $table->string('foto');
            $table->string('informacion');
            $table->string('telefono');
            $table->string('correo');
            $table->string('estado');
            $table->string('grado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
