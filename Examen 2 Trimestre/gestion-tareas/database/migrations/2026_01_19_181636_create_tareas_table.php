<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->date('fecha_modificacion')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->boolean('completada')->default(false);

            // Claves foráneas
            $table->foreignId('id_usr_crea')->constrained('usuarios');
            $table->foreignId('id_usr_mod')->nullable()->constrained('usuarios');
            $table->foreignId('id_usr_comp')->nullable()->constrained('usuarios');

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
