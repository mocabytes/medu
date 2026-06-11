<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicinaController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RoleController;

/**
 * Enrutamiento Principal de la Aplicación.
 * 
 * Implementación del patrón Front Controller nativo de Laravel.
 * Las rutas están agrupadas para aplicar middlewares de seguridad
 * y segregar el acceso según la jerarquía de roles del sistema.
 */

// Landing page pública
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Redirección del endpoint raíz (/) hacia el controlador de recursos principal.
// Route::get('/', function () {
//     return redirect()->route('medicinas.index');
// });

/**
 * Módulo de Autenticación.
 * 
 * Gestiona el ciclo de vida de la sesión HTTP (Login, Register, Logout).
 * Utiliza peticiones POST para mutar el estado de la sesión, respetando
 * la semántica del protocolo HTTP y previniendo vulnerabilidades CSRF.
 */
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('throttle:10,1');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->intended(route('medicinas.index'));
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/**
 * Grupo de Rutas Privadas (Requieren Autenticación.
 * 
 * El middleware 'auth' intercepta la petición y verifica la existencia
 * de una cookie de sesión válida antes de invocar la lógica del controlador.
 */
Route::middleware(['auth'])->group(function () {

    // Endpoints de solo lectura y lectura/escritura de baja criticidad.
    // Accesibles por cualquier actor autenticado en el sistema (Farmacéuticos y Admins).
    Route::get('/medicinas/export-pdf', [MedicinaController::class, 'exportPdf'])->name('medicinas.exportPdf');
    Route::get('/medicinas/export-csv', [MedicinaController::class, 'exportCsv'])->name('medicinas.exportCsv');
    Route::get('/medicinas/{medicina}/movimientos', [MedicinaController::class, 'movimientos'])->name('medicinas.movimientos');

    Route::resource('medicinas', MedicinaController::class)->except(['show']);
    Route::resource('proveedores', ProveedorController::class)->except(['show']);
    Route::resource('roles', RoleController::class)->except(['show']);

    // Endpoints transaccionales para el flujo de Kardex.
    Route::get('/movimientos/create', [MovimientoController::class, 'create'])->name('movimientos.create');
    Route::post('/movimientos', [MovimientoController::class, 'store'])->name('movimientos.store');

    Route::resource('users', UserController::class)->except(['show'])->middleware('can:viewAny,App\\Models\\User');
});
