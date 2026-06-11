<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Agrega la llave foránea role_id a la tabla users.
 * 
 * Esta migración reemplaza el antiguo campo 'role' (string) por una FK
 * hacia la tabla roles, lo que permite un sistema de permisos más robusto.
 * Mantiene compatibilidad migrando los datos existentes.
 */
return new class extends Migration
{
    /**
     * Agrega role_id como FK y migra datos del antiguo campo 'role'.
     */
    public function up(): void
    {
        // Agregamos la FK hacia la tabla roles
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained('roles')->nullOnDelete();
        });

        // Si existe el antiguo campo 'role', migramos los datos
        if (Schema::hasColumn('users', 'role')) {
            $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
            $farmaceuticoRoleId = DB::table('roles')->where('name', 'farmaceutico')->value('id');

            DB::table('users')->get()->each(function ($user) use ($adminRoleId, $farmaceuticoRoleId) {
                if ($user->role === 'admin' && $adminRoleId) {
                    DB::table('users')->where('id', $user->id)->update(['role_id' => $adminRoleId]);
                } elseif ($user->role === 'farmaceutico' && $farmaceuticoRoleId) {
                    DB::table('users')->where('id', $user->id)->update(['role_id' => $farmaceuticoRoleId]);
                }
            });
        }
    }

    /**
     * Elimina la FK y el campo role_id.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
