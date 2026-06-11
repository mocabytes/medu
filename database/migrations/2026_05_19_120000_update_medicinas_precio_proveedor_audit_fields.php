<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Agrega campos de precios, proveedor y auditoría a la tabla medicinas.
 * 
 * Reemplaza el antiguo campo 'precio' por 'precio_compra' y 'precio_venta'
 * para tener control de márgenes. Agrega FK hacia proveedores y campos de
 * auditoría (created_by, updated_by) para rastrear quién modificó cada registro.
 */
return new class extends Migration
{
    /**
     * Agrega los nuevos campos y elimina el antiguo 'precio'.
     */
    public function up(): void
    {
        Schema::table('medicinas', function (Blueprint $table) {
            // FK hacia proveedores - nullable por compatibilidad
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores')->nullOnDelete()->after('categoria_id');
            // Separar precio de compra y venta para calcular márgenes
            $table->decimal('precio_compra', 8, 2)->default(0)->after('laboratorio');
            $table->decimal('precio_venta', 8, 2)->default(0)->after('precio_compra');
            // Campos de auditoría - quién creó y quién modificó
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->after('precio_venta');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete()->after('created_by');
            // Eliminamos el antiguo campo 'precio' que ya no sirve
            $table->dropColumn('precio');
        });
    }

    /**
     * Revierte los cambios: restaura 'precio' y elimina los nuevos campos.
     */
    public function down(): void
    {
        Schema::table('medicinas', function (Blueprint $table) {
            $table->decimal('precio', 8, 2)->default(0)->after('principio_activo');
            $table->dropForeign(['proveedor_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['proveedor_id', 'precio_compra', 'precio_venta', 'created_by', 'updated_by']);
        });
    }
};
