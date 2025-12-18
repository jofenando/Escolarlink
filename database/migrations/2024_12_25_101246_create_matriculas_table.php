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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->string('estado_matricula');
            $table->string('año_escolar');
            $table->date('fecha_matricula');
            $table->string('grado');
            $table->string('jornada');
            $table->string('nombre_estudiante');
            $table->string('lugar_nacimiento');
            $table->date('fecha_nacimiento');
            $table->float('tipo_doc_estudiante');
            $table->string('documento_estudiante');
            $table->string('lugar_documento');
            $table->string('tipo_sangre');
            $table->string('tipo_rh');
            $table->string('eps');
            $table->string('direccion');
            $table->string('nombre_padre');
            $table->float('documento_padre');
            $table->string('profesion_padre');
            $table->string('ocupacion_padre');
            $table->float('tel_fijo_padre');
            $table->float('tel_cel_padre');
            $table->string('email_padre');
            $table->string('nombre_madre');
            $table->float('documento_madre');
            $table->string('profesion_madre');
            $table->string('ocupacion_madre');
            $table->float('tel_fijo_madre');
            $table->float('tel_cel_madre');
            $table->string('email_madre');
            $table->string('autorizado_recoger1');
            $table->string('parentesco_recoger1');
            $table->string('autorizado_recoger2');
            $table->string('parentesco_recoger2');
            $table->string('foto_estudiante');
            $table->string('formato_matricula');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
