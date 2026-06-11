<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medu - Gestión Farmacéutica Moderna</title>
    <link rel="icon" type="image/svg+xml" href="/images/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    keyframes: {
                        'fade-in': {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        'fade-in-up': {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                    },
                    animation: {
                        'fade-in': 'fade-in 0.5s ease-out',
                        'fade-in-up': 'fade-in-up 0.6s ease-out',
                    },
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-white" style="font-family:'Plus Jakarta Sans',sans-serif;">
    
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-100 animate-fade-in">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class=" flex items-center gap-2 hover:scale-105 transition-transform">
                    <img src="{{ asset('images/logo.svg') }}" alt="Medu Logo" class="h-8 w-8">
                    <span class="text-xl font-bold text-slate-900">Medu</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition hover:scale-105">Funcionalidades</a>
                    <a href="#benefits" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition hover:scale-105">Beneficios</a>
                    <a href="#pricing" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition hover:scale-105">Precios</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('login.form') }}" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition hover:scale-105">Iniciar sesión</a>
                    <a href="{{ route('register.form') }}" class="rounded-full bg-emerald-600 px-4 py-2 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:translate-y-px hover:bg-emerald-700 hover:scale-105">
                        Registrarse
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden animate-fade-in-up">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 via-white to-slate-50"></div>
        <div class="absolute top-20 left-10 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 h-80 w-80 rounded-full bg-sky-400/15 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in" style="animation-delay: 0.2s;">
                    <div class="animate-bounce inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-emerald-700 mb-6">
                        Gestión farmacéutica moderna
                    </div>
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold tracking-tight text-slate-900 leading-tight">
                        Un sistema clínico, claro y listo para operar.
                    </h1>
                    <p class="mt-6 text-lg text-slate-600 leading-relaxed">
                        Centraliza inventario, movimientos, lotes y usuarios con una interfaz sobria, profesional y fácil de usar. Optimiza tu farmacia con tecnología moderna.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('register.form') }}" class="rounded-full bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:translate-y-px hover:bg-emerald-700 hover:scale-105">
                            Comenzar gratis
                        </a>
                        <a href="#features" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:scale-105">
                            Ver funcionalidades
                        </a>
                    </div>
                </div>
                <div class="relative animate-fade-in" style="animation-delay: 0.4s;">
                    <div class="rounded-2xl border border-white/50 bg-white/80 p-6 shadow-2xl shadow-slate-200/50 backdrop-blur hover:scale-105 transition-transform duration-300">
                        <div class="grid gap-4">
                            <div class="rounded-xl border border-emerald-100 bg-emerald-50 p-4 hover:scale-105 transition-transform">
                                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-600">Inventario</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900">Control total</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4 hover:scale-105 transition-transform">
                                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Movimientos</p>
                                    <p class="mt-2 text-xl font-bold text-slate-900">Entrada / salida</p>
                                </div>
                                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4 hover:scale-105 transition-transform">
                                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Lotes</p>
                                    <p class="mt-2 text-xl font-bold text-slate-900">Trazabilidad</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 lg:py-32 bg-white animate-fade-in">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl lg:text-4xl font-extrabold tracking-tight text-slate-900">
                    Funcionalidades poderosas
                </h2>
                <p class="mt-4 text-lg text-slate-600">
                    Todo lo que necesitas para gestionar tu farmacia de manera eficiente
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-lg shadow-slate-100/50 hover:shadow-xl transition hover:scale-105 animate-fade-in" style="animation-delay: 0.1s;">
                    <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Control de inventario</h3>
                    <p class="text-slate-600">Gestión completa de medicamentos con categorías, stock, precios y proveedores.</p>
                </div>

                <!-- Feature 2 -->
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-lg shadow-slate-100/50 hover:shadow-xl transition hover:scale-105 animate-fade-in" style="animation-delay: 0.2s;">
                    <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Movimientos</h3>
                    <p class="text-slate-600">Registro de entradas y salidas con trazabilidad completa y auditoría.</p>
                </div>

                <!-- Feature 3 -->
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-lg shadow-slate-100/50 hover:shadow-xl transition hover:scale-105 animate-fade-in" style="animation-delay: 0.3s;">
                    <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Lotes y vencimientos</h3>
                    <p class="text-slate-600">Control de fechas de vencimiento y gestión de lotes por proveedor.</p>
                </div>

                <!-- Feature 4 -->
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-lg shadow-slate-100/50 hover:shadow-xl transition hover:scale-105 animate-fade-in" style="animation-delay: 0.4s;">
                    <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Roles y permisos</h3>
                    <p class="text-slate-600">Gestión de usuarios con roles de administrador y farmacéutico.</p>
                </div>

                <!-- Feature 5 -->
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-lg shadow-slate-100/50 hover:shadow-xl transition hover:scale-105 animate-fade-in" style="animation-delay: 0.5s;">
                    <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Reportes</h3>
                    <p class="text-slate-600">Exportación de datos en PDF y CSV para análisis y auditoría.</p>
                </div>

                <!-- Feature 6 -->
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-lg shadow-slate-100/50 hover:shadow-xl transition hover:scale-105 animate-fade-in" style="animation-delay: 0.6s;">
                    <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Seguridad</h3>
                    <p class="text-slate-600">Autenticación segura con control de acceso y auditoría de cambios.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20 lg:py-32 bg-gradient-to-br from-slate-900 to-slate-800 text-white animate-fade-in">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl lg:text-4xl font-extrabold tracking-tight">
                    Beneficios de usar Medu
                </h2>
                <p class="mt-4 text-lg text-slate-300">
                    Optimiza tu farmacia con tecnología moderna
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur hover:scale-105 transition-transform animate-fade-in" style="animation-delay: 0.1s;">
                    <div class="flex items-start gap-3 mb-4">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white font-bold">✓</span>
                        <h3 class="text-lg font-bold">Control en tiempo real</h3>
                    </div>
                    <p class="text-slate-300 pl-11">Inventario con lotes y vencimientos siempre actualizado.</p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur hover:scale-105 transition-transform animate-fade-in" style="animation-delay: 0.2s;">
                    <div class="flex items-start gap-3 mb-4">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white font-bold">✓</span>
                        <h3 class="text-lg font-bold">Gestión rápida</h3>
                    </div>
                    <p class="text-slate-300 pl-11">Proveedores y movimientos clínicos de forma eficiente.</p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur hover:scale-105 transition-transform animate-fade-in" style="animation-delay: 0.3s;">
                    <div class="flex items-start gap-3 mb-4">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white font-bold">✓</span>
                        <h3 class="text-lg font-bold">Acceso seguro</h3>
                    </div>
                    <p class="text-slate-300 pl-11">Roles para separar operaciones y administración.</p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur hover:scale-105 transition-transform animate-fade-in" style="animation-delay: 0.4s;">
                    <div class="flex items-start gap-3 mb-4">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white font-bold">✓</span>
                        <h3 class="text-lg font-bold">Interfaz intuitiva</h3>
                    </div>
                    <p class="text-slate-300 pl-11">Diseño moderno y fácil de usar para todo el equipo.</p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur hover:scale-105 transition-transform animate-fade-in" style="animation-delay: 0.5s;">
                    <div class="flex items-start gap-3 mb-4">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white font-bold">✓</span>
                        <h3 class="text-lg font-bold">Trazabilidad total</h3>
                    </div>
                    <p class="text-slate-300 pl-11">Historial completo de movimientos y cambios.</p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur hover:scale-105 transition-transform animate-fade-in" style="animation-delay: 0.6s;">
                    <div class="flex items-start gap-3 mb-4">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white font-bold">✓</span>
                        <h3 class="text-lg font-bold">Exportación fácil</h3>
                    </div>
                    <p class="text-slate-300 pl-11">Reportes en PDF y CSV para análisis externos.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 lg:py-32 bg-emerald-50 animate-fade-in">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-extrabold tracking-tight text-slate-900 mb-4">
                ¿Listo para transformar tu farmacia?
            </h2>
            <p class="text-lg text-slate-600 mb-8">
                Comienza a usar Medu hoy mismo y optimiza tu gestión farmacéutica.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register.form') }}" class="rounded-full bg-emerald-600 px-8 py-4 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:translate-y-px hover:bg-emerald-700 hover:scale-105">
                    Crear cuenta gratuita
                </a>
                <a href="{{ route('login.form') }}" class="rounded-full border border-slate-200 bg-white px-8 py-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:scale-105">
                    Iniciar sesión
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('images/logo.svg') }}" alt="Medu Logo" class="h-8 w-8">
                        <span class="text-xl font-bold">Medu</span>
                    </div>
                    <p class="text-slate-400 text-sm">
                        Gestión farmacéutica moderna para clínicas y farmacias.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Producto</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#features" class="hover:text-white transition">Funcionalidades</a></li>
                        <li><a href="#benefits" class="hover:text-white transition">Beneficios</a></li>
                        <li><a href="#pricing" class="hover:text-white transition">Precios</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Empresa</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-white transition">Sobre nosotros</a></li>
                        <li><a href="#" class="hover:text-white transition">Contacto</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-white transition">Privacidad</a></li>
                        <li><a href="#" class="hover:text-white transition">Términos</a></li>
                        <li><a href="#" class="hover:text-white transition">Seguridad</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-8 pt-8 text-center text-sm text-slate-400">
                <p>&copy; 2026 Medu. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

</body>
</html>
