<?php
// Kernel de HTTP para registrar middlewares personalizados
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array<string, class-string|array>
     */
    protected $routeMiddleware = [
        // ...otros middlewares de Laravel...
        'role' => \App\Http\Middleware\CheckRole::class, // Middleware de rol
        // 'ensure.logged.in' => \App\Http\Middleware\EnsureLoggedIn::class, // Ya no se usa
    ];
}
