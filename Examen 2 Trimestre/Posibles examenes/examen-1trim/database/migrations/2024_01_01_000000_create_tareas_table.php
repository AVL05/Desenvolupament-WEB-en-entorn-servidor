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
            $table->id(); // ID autoincremental (PK)
            $table->string('nombre'); // Nombre corto de la tarea
            $table->text('descripcion'); // Descripción detallada
            $table->date('fecha_finalizacion')->nullable(); // Fecha opcional cuando se completa
            $table->boolean('completada')->default(false); // Estado de la tarea (true/false)
            
            // Claves foráneas para tracking de usuarios
            // Constrained asume 'users' por defecto si el nombre sigue convención, pero lo especificamos por claridad
            $table->foreignId('id_usr_crea')->constrained('users')->onDelete('cascade'); // Si borran el usuario, se borran sus tareas
            $table->foreignId('id_usr_mod')->nullable()->constrained('users')->onDelete('set null'); // Si borran el usuario, queda null
            $table->foreignId('id_usr_comp')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps(); // created_at y updated_at
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
