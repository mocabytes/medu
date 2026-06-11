<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador para manejar la autenticación de usuarios.
 * 
 * Se encarga del login, registro y logout. Incluye rate limiting para evitar
 * ataques de fuerza bruta y asigna el rol de "farmaceutico" por defecto a los
 * nuevos registros (el admin debe crear otros admins desde el panel).
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     * Simplemente retorna la vista, la validación ocurre en el método login().
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Muestra el formulario de registro.
     * Los nuevos usuarios se registran con rol "farmaceutico" por defecto.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Procesa el intento de login del usuario.
     * 
     * Valida las credenciales, verifica el rate limiting (máximo 5 intentos por minuto),
     * y si todo está bien, autentica al usuario y lo redirige al inventario.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $this->ensureIsNotRateLimited($request);

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($this->throttleKey($request));
            $request->session()->regenerate();
            return redirect()->intended(route('medicinas.index'));
        }

        RateLimiter::hit($this->throttleKey($request), 60);

        throw ValidationException::withMessages([
            'email' => ['Credenciales inválidas.'],
        ]);
    }

    /**
     * Verifica si el usuario ha excedido el límite de intentos de login.
     * 
     * Si hay más de 5 intentos fallidos en 1 minuto, bloquea temporalmente
     * el login para prevenir ataques de fuerza bruta.
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => ["Demasiados intentos. Intente de nuevo en {$seconds} segundos."],
        ]);
    }

    /**
     * Genera una clave única para el rate limiting basada en email e IP.
     * Así cada combinación email+IP tiene su propio contador de intentos.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    /**
     * Procesa el registro de un nuevo usuario.
     * 
     * Crea el usuario con rol "farmaceutico" por defecto, lo autentica automáticamente
     * y envía un email de verificación. Los admins deben ser creados por otro admin.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $role = Role::firstOrCreate(
            ['name' => 'farmaceutico'],
            ['description' => 'Acceso operativo de farmacia']
        );

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $role->id,
        ]);

        Auth::login($user);
        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with('success', 'Te hemos enviado un enlace de verificación a tu correo.');
    }

    /**
     * Cierra la sesión del usuario actual.
     * 
     * Invalida la sesión y regenera el token CSRF para evitar ataques de session fixation.
     * Luego redirige al formulario de login.
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login.form');
    }
}
