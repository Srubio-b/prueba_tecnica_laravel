<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('identificacion')->unique();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->text('notas')->nullable();
            $table->unsignedBigInteger('entidad_id');
            $table->foreign('entidad_id')
                  ->references('id')
                  ->on('entidades')
                  ->onDelete('cascade');
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};
