<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla de lotes de medicamentos.
 * 
 * Esta es la parte crítica del sistema de vencimientos. Cada lote tiene su
 * propia fecha de vencimiento y controlamos la cantidad restante para saber
 * cuándo estamos por quedarnos sin stock. El comando de vencimientos revisa
 * esta tabla para alertar sobre lotes próximos a vencer.
 */
return new class extends Migration
{
    /**
     * Crea la tabla lotes con control de vencimientos y cantidades.
     */
    public function up(): void
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_lote')->unique(); // Código único del lote (ej: LOT-2026-001)
            // FK hacia medicinas - si se borra la medicina, se borran sus lotes
            $table->foreignId('medicina_id')->constrained('medicinas')->onDelete('cascade');
            $table->date('fecha_vencimiento'); // Fecha en que vence el lote
            $table->integer('cantidad_inicial'); // Cantidad cuando se recibió el lote
            $table->integer('cantidad_restante'); // Cantidad actual (se actualiza con movimientos)
            $table->timestamps();
        });

    }

    /**
     * Elimina la tabla lotes si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
