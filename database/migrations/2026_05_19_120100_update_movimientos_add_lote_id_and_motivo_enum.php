<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Refactoriza la tabla movimientos para eliminar campos duplicados.
 * 
 * Esta migración es crítica: elimina la fecha_vencimiento de movimientos
 * (que ahora está en lotes) y normaliza el campo motivo a un enum. También
 * agrega lote_id para rastrear de qué lote provino cada movimiento.
 * Limpia datos inconsistentes usando regex para normalizar motivos existentes.
 */
return new class extends Migration
{
    /**
     * Agrega lote_id, normaliza motivo a enum y elimina campos duplicados.
     */
    public function up(): void
    {
        // Agregamos FK hacia lotes para rastrear el origen de cada movimiento
        if (!Schema::hasColumn('movimientos', 'lote_id')) {
            Schema::table('movimientos', function (Blueprint $table) {
                $table->foreignId('lote_id')->nullable()->constrained('lotes')->nullOnDelete()->after('medicina_id');
            });
        }

        // Guardamos el motivo original en un campo temporal antes de normalizar
        if (!Schema::hasColumn('movimientos', 'motivo_detalle')) {
            Schema::table('movimientos', function (Blueprint $table) {
                $table->string('motivo_detalle')->nullable()->after('motivo');
            });
            DB::table('movimientos')->update(['motivo_detalle' => DB::raw('motivo')]);
        }

        // Normalizamos los motivos existentes usando regex para detectar variaciones
        DB::table('movimientos')
            ->whereRaw("LOWER(motivo) REGEXP 'factura|compra|entrada|ingreso|purchase'")
            ->update(['motivo' => 'compra']);

        DB::table('movimientos')
            ->whereRaw("LOWER(motivo) REGEXP 'merma|deterioro|perdida|descarte|waste'")
            ->update(['motivo' => 'merma']);

        DB::table('movimientos')
            ->whereRaw("LOWER(motivo) REGEXP 'devoluci[oó]n|return'")
            ->update(['motivo' => 'devolucion']);

        // Todo lo que no encaja se asume como venta (valor por defecto)
        DB::table('movimientos')
            ->whereNotIn('motivo', ['compra', 'venta', 'merma', 'devolucion'])
            ->update(['motivo' => 'venta']);

        // Convertimos motivo a enum y eliminamos campos duplicados
        Schema::table('movimientos', function (Blueprint $table) {
            $table->enum('motivo', ['compra', 'venta', 'merma', 'devolucion'])->default('venta')->change();
            // Eliminamos campos que ahora están en otras tablas
            $table->dropColumn(['numero_lote', 'fecha_creacion', 'fecha_vencimiento', 'laboratorio']);
        });
    }

    /**
     * Revierte los cambios: restaura campos antiguos y elimina lote_id.
     */
    public function down(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->string('motivo')->change();
            $table->string('numero_lote')->nullable()->after('motivo');
            $table->date('fecha_creacion')->nullable()->after('numero_lote');
            $table->date('fecha_vencimiento')->nullable()->after('fecha_creacion');
            $table->string('laboratorio')->nullable()->after('fecha_vencimiento');
        });

        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');
        });
    }
};
