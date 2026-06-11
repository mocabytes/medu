<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Acceso - Medu')</title>
    <link rel="icon" type="image/svg+xml" href="/images/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-white" style="font-family:'Plus Jakarta Sans',sans-serif;background:radial-gradient(circle at top left,rgba(16,185,129,.22),transparent 30%),radial-gradient(circle at bottom right,rgba(59,130,246,.18),transparent 28%),linear-gradient(135deg,#07111f 0%,#0f172a 48%,#0b1324 100%);">
    <div class="relative min-h-screen overflow-hidden">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute left-28 top-16 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl"></div>
            <div class="absolute right-20 bottom-16 h-80 w-80 rounded-full bg-sky-400/15 blur-3xl"></div>
        </div>

        <div class="relative grid min-h-screen lg:grid-cols-[1.15fr_0.85fr]">
            <section class="hidden flex-col justify-between p-10 lg:flex xl:p-16">
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/8 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-emerald-200">Gestión farmacéutica moderna</div>
                    <h1 class="mt-8 text-4xl font-extrabold tracking-tight text-white xl:text-5xl">Un sistema clínico, claro y listo para operar.</h1>
                    <p class="mt-5 max-w-lg text-base leading-7 text-slate-300">Centraliza inventario, movimientos, lotes y usuarios con una interfaz sobria, profesional y fácil de usar.</p>

                    <div class="mt-10 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/6 p-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Inventario</p>
                            <p class="mt-2 text-2xl font-bold text-white">Control total</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/6 p-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Movimientos</p>
                            <p class="mt-2 text-2xl font-bold text-white">Entrada / salida</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/6 p-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Trazabilidad</p>
                            <p class="mt-2 text-2xl font-bold text-white">Lotes y vencimiento</p>
                        </div>
                    </div>
                    <div class="mt-8 rounded-[1.75rem] border border-white/10 bg-white/6 p-5 shadow-sm shadow-white-200/50">
                        <p class="text-sm font-semibold text-white-400">Beneficios de usar Medu</p>
                        <div class="mt-4 space-y-5 text-sm text-white">
                            <div class="flex items-start gap-3 rounded-2xl bg-white/10 p-4 shadow-sm shadow-slate-100">
                                <span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">✓</span>
                                <span>Control de inventario en tiempo real con lotes y vencimientos.</span>
                            </div>
                            <div class="flex items-start gap-3 rounded-2xl bg-white/10 p-4 shadow-sm shadow-slate-100">
                                <span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">✓</span>
                                <span>Gestión rápida de proveedores y movimientos clínicos.</span>
                            </div>
                            <div class="flex items-start gap-3 rounded-2xl bg-white/10 p-4 shadow-sm shadow-slate-100">
                                <span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">✓</span>
                                <span>Acceso seguro con roles para separar operaciones y administración.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="max-w-md text-sm text-slate-400">Diseñado para una lectura rápida en escritorio y móvil, con foco en inventario y operaciones diarias.</p>
            </section>

            <section class="flex min-h-screen items-center justify-center px-6 py-10 lg:px-10 lg:py-16">
                <div class="w-full max-w-md rounded-2xl border border-white/20 bg-white p-8 text-slate-900 shadow-2xl shadow-slate-950/20 backdrop-blur-xl ring-1 ring-slate-200/70 sm:p-10">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
</body>
</html>