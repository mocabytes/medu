<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicinas', function (Blueprint $table) {
            $table->string('presentacion')->nullable()->after('principio_activo');
            $table->string('concentracion')->nullable()->after('presentacion');
            $table->string('laboratorio')->nullable()->after('concentracion');
            $table->string('codigo_barras')->nullable()->unique()->after('laboratorio');
            $table->string('ubicacion')->nullable()->after('codigo_barras');
            $table->integer('stock_minimo')->default(10)->after('stock_actual');
            $table->boolean('requiere_receta')->default(false)->after('stock_minimo');
        });
    }

    public function down(): void
    {
        Schema::table('medicinas', function (Blueprint $table) {
            $table->dropColumn([
                'presentacion',
                'concentracion',
                'laboratorio',
                'codigo_barras',
                'ubicacion',
                'stock_minimo',
                'requiere_receta'
            ]);
        });
    }
};
