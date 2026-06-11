<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

/**
 * Modelo principal de usuarios del sistema.
 * 
 * Cada usuario tiene un rol que define sus permisos: admin (acceso total) o farmaceutico (solo movimientos y consulta).
 * Implementa verificación de email para mayor seguridad.
 */
class User extends Authenticatable // implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable; // , MustVerifyEmailTrait

    /**
     * Campos que se pueden asignar masivamente.
     * Importante: el password se hashea automáticamente antes de guardar.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * Campos que nunca se deben incluir en las respuestas JSON o serializaciones.
     * El password nunca debe exponerse, ni el token de "recordarme".
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversiones automáticas de tipos.
     * email_verified_at se convierte a objeto Carbon, el password se mantiene hasheado.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relación: un usuario pertenece a un solo rol.
     * El rol determina qué puede hacer el usuario en el sistema.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Accessor para obtener el nombre del rol de forma segura.
     * Si el usuario no tiene rol asignado, devuelve 'sin rol' en lugar de null.
     */
    public function getRoleNameAttribute(): ?string
    {
        return optional($this->role)->name ?? 'sin rol';
    }

    /**
     * Verifica si el usuario es administrador.
     * Se usa en las policies y controladores para autorizar acciones críticas.
     */
    public function isAdmin(): bool
    {
        return $this->roleName === 'admin';
    }

    /**
     * Verifica si el usuario es farmacéutico.
     * Los farmacéuticos solo pueden registrar movimientos y consultar inventario.
     */
    public function isFarmaceutico(): bool
    {
        return $this->roleName === 'farmaceutico';
    }
}
