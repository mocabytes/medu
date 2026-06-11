<?php
// Middleware para verificar el rol del usuario
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Maneja una solicitud entrante.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     */
    public function handle($request, Closure $next, $role)
    {
        if (! Auth::check() || Auth::user()->roleName !== $role) {
            abort(403, 'No autorizado');
        }
        return $next($request);
    }
}
