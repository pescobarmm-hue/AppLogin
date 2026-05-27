<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración (crear la tabla).
     */
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();                // Columna ID autoincremental
            $table->string('name');      // Nombre de la carrera (texto)
            $table->string('code')->unique()->nullable(); //codigo unico
            $table->text('description')->nullable(); //para descripcion de las carreras
            $table->boolean('is_active')->default(true); //activa por defecto
            $table->timestamps();        // created_at y updated_at
        });
    }

    /**
     * Revertir la migración (eliminar la tabla).
     */
    public function down(): void
    {
        Schema::dropIfExists('careers'); // Borra la tabla si existe
    }
};
