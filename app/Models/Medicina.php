<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Movimiento;

/**
 * Modelo principal para gestionar los medicamentos del inventario.
 * 
 * Es el corazón del sistema: cada medicina tiene su categoría, proveedor, precios,
 * stock actual y mínimo. El stock mínimo sirve para alertar cuando estamos por quedarnos
 * sin existencias. Usa soft deletes para no perder el historial si se elimina por error.
 */
class Medicina extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'categoria_id',
        'proveedor_id',
        'nombre_comercial',
        'principio_activo',
        'presentacion',
        'concentracion',
        'laboratorio',
        'codigo_barras',
        'ubicacion',
        'precio_compra',
        'precio_venta',
        'stock_actual',
        'stock_minimo',
        'requiere_receta',
        'created_by',
        'updated_by',
    ];

    /**
     * Una medicina pertenece a una categoría.
 * Por ejemplo, "Paracetamol" pertenece a la categoría "Analgésicos".
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Una medicina puede tener un proveedor asignado.
     * Esto nos ayuda a saber de dónde compramos cada medicamento.
     */
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    /**
     * Usuario que creó el registro de la medicina.
     * Sirve para auditoría y saber quién agregó el producto al inventario.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Usuario que modificó por última vez la medicina.
     * Útil para rastrear cambios y responsabilidades.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Una medicina puede tener muchos movimientos de stock.
     * Cada entrada, salida o ajuste se registra aquí para tener el kardex completo.
     */
    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }
}
