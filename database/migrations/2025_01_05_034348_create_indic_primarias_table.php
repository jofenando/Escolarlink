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
        Schema::create('indic_primarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asig_primaria_id')->constrained('indic_primarias')->cascadeOnDelete();
			$table->string('indicador');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indic_primarias');
    }
};
