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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('obligacion_id')->constrained('obligaciones')->cascadeOnDelete();
            $table->string('mes');
            $table->date('fecha_pago');
            $table->string('valor');
            $table->string('recibo');
            $table->string('Descripción');
            $table->string('tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
