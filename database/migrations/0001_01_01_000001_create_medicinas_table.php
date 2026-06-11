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
        Schema::create('medicinas', function (Blueprint $table) {
            $table->id();
            // Aquí está la famosa FK conectando con Categorías:
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('nombre_comercial');
            $table->string('principio_activo');
            $table->decimal('precio', 8, 2); // Hasta 8 dígitos en total, 2 de ellos decimales
            $table->integer('stock_actual')->default(0); // El stock arranca en cero por defecto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicinas');
    }
};
