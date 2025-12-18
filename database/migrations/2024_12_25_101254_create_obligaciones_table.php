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
        Schema::create('obligaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained('matriculas')->cascadeOnDelete();
            $table->string('mes'); 
            $table->string('matricula');
            $table->string('pension');
            $table->string('materiales');
            $table->string('extraclases');
            $table->string('uniforme');
            $table->string('Descripción'); 
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obligaciones');
    }
};
