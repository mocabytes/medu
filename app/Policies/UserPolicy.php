<?php

namespace App\Policies;

use App\Models\User;

/**
 * Policy para controlar el acceso al CRUD de usuarios.
 * 
 * El manejo de usuarios es una operación administrativa crítica. Solo los
 * administradores pueden ver, crear, editar o eliminar usuarios. Además,
 * un admin no puede eliminar su propia cuenta para evitar quedarse sin acceso.
 */
class UserPolicy
{
    /**
     * Solo los administradores pueden ver la lista de usuarios.
     * Los farmacéuticos no necesitan ver todos los usuarios del sistema.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Solo los administradores pueden ver los detalles de un usuario.
     * Incluye información sensible como email y rol asignado.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Solo los administradores pueden crear nuevos usuarios.
     * Esto permite asignar roles apropiados desde el principio.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Solo los administradores pueden editar usuarios existentes.
     * Incluye cambiar roles, lo cual es una operación sensible.
     */
    public function update(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Solo los administradores pueden eliminar usuarios.
     * 
     * Protección importante: un admin no puede eliminar su propia cuenta.
     * Esto evita que el sistema quede sin administradores por error.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin() && $user->id !== $model->id;
    }
}
