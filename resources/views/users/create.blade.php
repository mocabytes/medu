@extends('layouts.dashboard')

@section('title', 'Crear Usuario - Medu')

@section('content')
    <div class="space-y-6">
        <section class="rounded-4xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/50">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Crear nuevo usuario</h1>
                    <p class="mt-1 text-sm text-slate-500">Define credenciales y rol para un nuevo acceso al sistema.</p>
                </div>
                <a href="{{ route('users.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Volver al listado</a>
            </div>

            @if($errors->any())
                <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-rose-900">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST" class="mt-6 grid gap-6 sm:grid-cols-2">
                @csrf

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Nombre completo</span>
                    <input type="text" name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100" required>
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Correo electrónico</span>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100" required>
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Rol</span>
                    <select name="role_id" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100" required>
                        @foreach($roles as $value => $label)
                            <option value="{{ $value }}" @selected(old('role_id') === (string) $value)>{{ ucfirst($label) }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Contraseña</span>
                    <input type="password" name="password" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100" required>
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Confirmar contraseña</span>
                    <input type="password" name="password_confirmation" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100" required>
                </label>

                <div class="sm:col-span-2">
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">Crear usuario</button>
                </div>
            </form>
        </section>
    </div>
@endsection
