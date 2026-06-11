<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

/**
 * Modelo para gestionar los roles de usuario en el sistema.
 * 
 * Los roles definen los permisos y niveles de acceso: admin puede hacer todo,
 * farmaceutico solo puede registrar movimientos y consultar inventario.
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Un rol puede tener muchos usuarios asignados.
     * Por ejemplo, el rol "admin" puede estar asignado a varios administradores.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
