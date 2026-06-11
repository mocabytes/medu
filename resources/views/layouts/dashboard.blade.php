<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Medu'))</title>
    <link rel="icon" type="image/svg+xml" href="/images/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen text-slate-900" style="font-family:'Plus Jakarta Sans',sans-serif;background:radial-gradient(circle at top left,rgba(16,185,129,.16),transparent 28%),radial-gradient(circle at top right,rgba(14,165,233,.14),transparent 30%),linear-gradient(180deg,#f8fafc 0%,#effaf5 46%,#f8fafc 100%);">
    <div class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="-left-24 absolute top-24 h-56 w-56 rounded-full bg-emerald-300/20 blur-3xl"></div>
        <div class="-right-20 absolute top-20 h-72 w-72 rounded-full bg-sky-300/15 blur-3xl"></div>
    </div>

    <div class="relative min-h-screen animate-fade-in">
        <nav class="sticky top-0 z-40 border-b border-white/70 bg-white/75 backdrop-blur-xl">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-4">
                    <img src="images/logo.svg" alt="Medu Logo" class="h-11 w-auto">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.32em] text-emerald-700">Medu</p>
                        <p class="text-sm font-semibold text-slate-800">Panel de inventario clínico</p>
                    </div>
                </div>

                <div class="hidden items-center gap-2 md:flex">
                    <a href="{{ route('medicinas.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800 hover:scale-105 hover:shadow-md">Inventario</a>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('users.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800 hover:scale-105 hover:shadow-md">Usuarios</a>
                        <a href="{{ route('proveedores.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800 hover:scale-105 hover:shadow-md">Proveedores</a>
                        <a href="{{ route('roles.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800 hover:scale-105 hover:shadow-md">Roles</a>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    @if(auth()->check())
                    <div class="hidden rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm font-medium text-emerald-800 sm:block">Hola, {{ auth()->user()->name }}</div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-slate-900/15 transition hover:bg-slate-800 hover:scale-105 hover:shadow-xl hover:shadow-slate-900/25">Salir</button>
                    </form>
                    @else
                    <a href="{{ route('login.form') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-slate-900/15 transition hover:bg-slate-800 hover:scale-105 hover:shadow-xl hover:shadow-slate-900/25">Iniciar sesión</a>
                    @endif
                </div>
            </div>
        </nav>

        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 animate-slide-up">
            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-emerald-900 shadow-sm shadow-emerald-100 animate-fade-in">
                    <p class="font-semibold">Operación exitosa</p>
                    <p class="text-sm text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('warning'))
                <div class="mb-6 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-4 text-amber-900 shadow-sm shadow-amber-100 animate-fade-in">
                    <p class="font-semibold">Atención</p>
                    <p class="text-sm text-amber-800">{{ session('warning') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-4 text-rose-900 shadow-sm shadow-rose-100 animate-fade-in">
                    <p class="font-semibold">Error</p>
                    <p class="text-sm text-rose-800">{{ session('error') }}</p>
                </div>
            @endif
            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-4 text-rose-900 shadow-sm shadow-rose-100 animate-fade-in">
                    <p class="font-semibold">Hay errores de validación</p>
                    <ul class="mt-2 list-disc pl-5 text-sm text-rose-800">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>