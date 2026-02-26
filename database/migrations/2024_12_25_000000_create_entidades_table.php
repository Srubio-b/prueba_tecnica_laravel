<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the entities table.
     */
    public function up(): void
    {
        Schema::create('entidades', function (Blueprint $table) {
            $table->id();                              // PK autoincremental
            $table->string('nombre');                  // Nombre de la entidad (obligatorio)
            $table->string('nit')->unique();           // NIT único (obligatorio)
            $table->string('direccion')->nullable();   // Dirección (opcional)
            $table->string('telefono')->nullable();    // Teléfono (opcional)
            $table->string('email')->nullable();       // Email (opcional)
            $table->timestamps();                      // created_at y updated_at
        });
    }

    /**
     * Delete the entities table when performing a rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('entidades');
    }
};