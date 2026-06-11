@extends('layouts.dashboard')

@section('title', 'Usuarios - Medu')

@section('content')
<div @class(['space-y-6', 'animate-slide-up'])>
    <div @class(['flex', 'flex-col', 'gap-4', 'sm:flex-row', 'sm:items-center', 'sm:justify-between'])>
        <div>
            <p @class(['text-xs', 'font-semibold', 'uppercase', 'tracking-[0.28em]', 'text-emerald-700'])>Usuarios</p>
            <h1 @class(['mt-3', 'text-3xl', 'font-bold', 'text-slate-900'])>Administración de Usuarios</h1>
            <p @class(['mt-2', 'text-sm', 'text-slate-500'])>Administra cuentas, roles y permisos de acceso.</p>
        </div>
        <a href="{{ route('users.create') }}" @class(['inline-flex', 'items-center', 'justify-center', 'rounded-full', 'bg-emerald-600', 'px-5', 'py-3', 'text-sm', 'font-semibold', 'text-white', 'shadow-lg', 'shadow-emerald-600/20', 'transition', 'hover:bg-emerald-700', 'hover:scale-105', 'hover:shadow-xl', 'hover:shadow-emerald-600/30'])>+ Nuevo usuario</a>
    </div>
    <section @class(['rounded-4xl', 'border', 'border-slate-200', 'bg-white', 'p-6', 'shadow-xl', 'shadow-slate-200/50', 'animate-slide-up']) style="animation-delay: 0.2s">
        @if(session('success'))
        <div @class(['mt-6', 'rounded-2xl', 'border', 'border-emerald-200', 'bg-emerald-50', 'p-4', 'text-emerald-900', 'animate-fade-in'])>
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div @class(['mt-6', 'rounded-2xl', 'border', 'border-rose-200', 'bg-rose-50', 'p-4', 'text-rose-900', 'animate-fade-in'])>
            <ul @class(['list-disc', 'pl-5', 'text-sm'])>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div @class(['mt-6', 'overflow-hidden', 'rounded-3x1', 'border', 'border-slate-200', 'shadow-sm'])>
            <div @class(['overflow-x-auto', 'bg-white'])>
                <table @class(['min-w-full', 'divide-y', 'divide-slate-200', 'text-sm'])>
                    <thead @class(['bg-slate-50', 'text-slate-600'])>
                        <tr>
                            <th @class(['px-6', 'py-4', 'text-left', 'font-semibold', 'uppercase', 'tracking-[0.2em]'])>Nombre</th>
                            <th @class(['px-6', 'py-4', 'text-left', 'font-semibold', 'uppercase', 'tracking-[0.2em]'])>Email</th>
                            <th @class(['px-6', 'py-4', 'text-left', 'font-semibold', 'uppercase', 'tracking-[0.2em]'])>Rol</th>
                            <th @class(['px-6', 'py-4', 'text-left', 'font-semibold', 'uppercase', 'tracking-[0.2em]'])>Creado</th>
                            <th @class(['px-6', 'py-4', 'text-center', 'font-semibold', 'uppercase', 'tracking-[0.2em]'])>Acciones</th>
                        </tr>
                    </thead>
                    <tbody @class(['divide-y', 'divide-slate-200', 'bg-white'])>
                        @forelse($users as $user)
                        <tr @class(['hover:bg-slate-50/80', 'transition', 'animate-fade-in']) style="animation-delay: {{ $loop->index * 0.05 }}s">
                            <td @class(['px-6', 'py-4', 'font-semibold', 'text-slate-900'])>{{ $user->name }}</td>
                            <td @class(['px-6', 'py-4', 'text-slate-600'])>{{ $user->email }}</td>
                            <td @class(['px-6', 'py-4'])>
                                <span @class([
                                    'inline-flex',
                                    'rounded-full',
                                    'px-3',
                                    'py-1',
                                    'text-xs',
                                    'font-semibold',
                                    'uppercase',
                                    'bg-sky-100 text-sky-700' => ($user->role_name ?? '') === 'admin',
                                    'bg-slate-100 text-slate-700' => ($user->role_name ?? '') !== 'admin',
                                ])>{{ ucfirst($user->role_name ?? 'sin rol') }}</span>
                            </td>
                            <td @class(['px-6', 'py-4', 'text-slate-500'])>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td @class(['px-6', 'py-4', 'text-center'])>
                                <div @class(['inline-flex', 'items-center', 'gap-2'])>
                                    <a href="{{ route('users.edit', $user) }}" @class(['inline-flex', 'h-10', 'w-10', 'items-center', 'justify-center', 'rounded-full', 'border', 'border-slate-200', 'bg-white', 'text-slate-700', 'transition', 'hover:border-slate-300', 'hover:bg-slate-50', 'hover:scale-110', 'hover:-rotate-12']) title="Editar usuario">✎</a>
                                    @if(auth()->id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" @class(['inline-flex', 'h-10', 'w-10', 'items-center', 'justify-center', 'rounded-full', 'border', 'border-slate-200', 'bg-white', 'text-rose-600', 'transition', 'hover:border-rose-300', 'hover:bg-rose-50', 'hover:scale-110', 'hover:shake']) title="Eliminar usuario">🗑</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" @class(['px-6', 'py-16', 'text-center', 'text-slate-500'])>No hay usuarios registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div @class(['mt-5'])>
            {{ $users->links() }}
        </div>
    </section>
</div>
@endsection