<?php
// Proveedor de servicios para registrar policies
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        \App\Models\Medicina::class => \App\Policies\MedicinaPolicy::class,
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Proveedor::class => \App\Policies\ProveedorPolicy::class,
        \App\Models\Role::class => \App\Policies\RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
