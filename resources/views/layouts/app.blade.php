<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyXad Portal</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-white/80 backdrop-blur-md border-r border-gray-200 flex flex-col">

        <div class="h-16 flex items-center px-6 border-b border-gray-100">
            <span class="text-xl font-bold tracking-wider text-gray-800">Key<span class="text-[#FA8072]">Xad</span></span>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="/inicio" class="flex items-center gap-3 px-4 py-3 bg-gray-50 text-[#FA8072] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Inicio
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Órdenes de Trabajo
            </a>

            <a href="/expensas" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-700 rounded-xl font-medium transition-colors">
                <i class="bi bi-file-earmark-pdf text-xl"></i>
                Mis Expensas
            </a>
        </nav>
    </aside>

    <main class="flex-1 overflow-y-auto p-8">

        <!-- top bar: back link and optional title/controls -->
        <div class="mb-6 flex items-center justify-between">
            <!-- back button only if not on inicio -->
            @unless(request()->is('inicio'))
                <a href="/inicio" class="inline-flex items-center gap-2 px-4 py-2 bg-[#FA8072] text-white rounded-lg text-sm font-semibold hover:bg-[#e16960] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver
                </a>
            @endunless

            <!-- páginas específicas pueden definir su propio título u otros controles -->
            @yield('page_header')
        </div>

        @yield('contenido')

    </main>

</body>

</html>