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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->date('fecha_finalizacion')->nullable();
            $table->boolean('completada')->default(false);
            
            $table->foreignId('id_usr_crea')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_usr_mod')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('id_usr_comp')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
