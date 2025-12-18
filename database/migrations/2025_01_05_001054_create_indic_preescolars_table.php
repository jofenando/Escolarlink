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
        Schema::create('indic_preescolars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asig_preescolar_id')->constrained('indic_preescolars')->cascadeOnDelete();
			$table->string('indicador');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indic_preescolars');
    }
};
