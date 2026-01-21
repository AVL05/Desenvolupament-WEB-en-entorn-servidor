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
        Schema::create('movies', function (Blueprint $table) {
            $table->id(); // Campo id autoincremental
            $table->string('title'); // Campo title tipo string
            $table->string('year', 8); // Campo year, string con longitud 8
            $table->string('director', 64); // Campo director, string con longitud 64
            $table->string('poster'); // Campo poster tipo string
            $table->boolean('rented')->default(false); // Campo rented tipo boolean, valor por defecto false
            $table->text('synopsis'); // Campo synopsis tipo text
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};