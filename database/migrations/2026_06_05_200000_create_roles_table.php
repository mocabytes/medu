<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla de roles para el sistema de permisos.
 * 
 * Los roles definen qué pueden hacer los usuarios: admin tiene acceso total,
 * farmaceutico solo puede registrar movimientos y consultar inventario.
 * El name es único para evitar duplicados.
 */
return new class extends Migration
{
    /**
     * Crea la tabla roles con los campos básicos.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // 'admin', 'farmaceutico', etc.
            $table->string('description')->nullable(); // Descripción opcional del rol
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla roles si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
