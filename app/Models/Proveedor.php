<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo para gestionar los proveedores de medicinas.
 * 
 * Cada proveedor puede suministrar múltiples medicinas. Guardamos su información
 * de contacto para poder comunicarnos cuando sea necesario (pedidos, devoluciones, etc).
 */
class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
    ];

    /**
     * Un proveedor puede tener muchas medicinas asociadas.
     * Por ejemplo, "Bayer" puede ser proveedor de varios medicamentos diferentes.
     */
    public function medicinas(): HasMany
    {
        return $this->hasMany(Medicina::class);
    }
}
