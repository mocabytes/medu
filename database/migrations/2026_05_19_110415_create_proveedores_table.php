<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla de proveedores de medicamentos.
 * 
 * Cada proveedor puede suministrar múltiples medicinas. Guardamos su
 * información de contacto para poder comunicarnos cuando sea necesario
 * (pedidos, devoluciones, problemas de calidad, etc).
 */
return new class extends Migration
{
    /**
     * Crea la tabla proveedores con los campos de contacto.
     */
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del proveedor (ej: Bayer, Pfizer)
            $table->string('telefono')->nullable(); // Teléfono de contacto
            $table->string('email')->nullable(); // Email para pedidos
            $table->text('direccion')->nullable(); // Dirección física
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla proveedores si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
