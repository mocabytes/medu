<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador para gestionar los usuarios del sistema.
 * 
 * Solo los administradores pueden acceder a este CRUD. Permite crear, editar,
 * eliminar usuarios y asignarles roles (admin o farmaceutico). Importante:
 * un admin no puede eliminar su propia cuenta para evitar quedarse sin acceso.
 */
class UserController extends Controller
{
    /**
     * Aplica las policies de autorización automáticamente a todos los métodos.
     * Esto asegura que solo los admins puedan acceder a estas funciones.
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Muestra la lista de todos los usuarios del sistema.
     * Incluye el rol de cada usuario para identificar rápidamente admins y farmacéuticos.
     */
    public function index()
    {
        $users = User::with('role')->orderBy('name')->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     * Carga los roles disponibles para que el admin pueda asignar uno.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * Guarda un nuevo usuario en la base de datos.
     * El password se hashea automáticamente antes de guardar.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     * Permite cambiar nombre, email, rol y password (opcional).
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza los datos de un usuario existente.
     * Si se proporciona un nuevo password, lo hashea. Si no, mantiene el actual.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $validated['role_id'];

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario del sistema.
     * 
     * Protección importante: un admin no puede eliminar su propia cuenta.
     * Esto evita que el sistema quede sin administradores por error.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->withErrors(['user' => 'No puedes eliminar tu propia cuenta.']);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
