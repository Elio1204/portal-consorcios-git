<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyXad Portal</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased flex h-screen overflow-hidden relative isolate">

    <div class="absolute inset-0 -z-20 overflow-hidden" aria-hidden="true">
        <div class="absolute -top-40 left-0 w-[60rem] h-[60rem] rounded-full bg-[#FA8072]/5 blur-3xl"></div>

        <div class="absolute -bottom-40 right-0 w-[70rem] h-[70rem] rounded-full bg-[#00CFFF]/5 blur-3xl"></div>

        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80rem] h-[80rem] rounded-full bg-[#003C8F]/2 blur-3xl"></div>
    </div>
    <aside class="w-64 bg-white/80 backdrop-blur-md border-r border-gray-200 flex flex-col z-10 relative">

        <div class="h-20 flex items-center px-6 border-b border-gray-100 relative">
            <a href="/inicio" class="block transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('img/logoKeyxad.png') }}" alt="Logo KeyXad" class="h-10 w-auto object-contain drop-shadow-sm">
            </a>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">

            <a href="/inicio" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors {{ request()->is('inicio') ? 'bg-gray-50 text-[#FA8072]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#FA8072]' }}">
                <i class="bi bi-house-door text-xl"></i>
                Inicio
            </a>

            <a href="/ordenes-trabajo" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors {{ request()->is('ordenes-trabajo*') ? 'bg-gray-50 text-[#FA8072]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#FA8072]' }}">
                <i class="bi bi-tools text-xl"></i>
                Órdenes de Trabajo
            </a>

            <a href="/expensas" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors {{ request()->is('expensas*') ? 'bg-gray-50 text-[#FA8072]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#FA8072]' }}">
                <i class="bi bi-file-earmark-pdf text-xl"></i>
                Mis Expensas
            </a>

            <a href="/proyectados" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors {{ request()->is('proyectados*') ? 'bg-gray-50 text-[#FA8072]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#FA8072]' }}">
                <i class="bi bi-file-earmark-pdf text-xl"></i>
                Proyectados
            </a>

        </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto p-8 relative z-0">

        <div class="mb-6 flex items-center justify-between">
            @unless(request()->is('inicio'))
            <a href="/inicio" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:border-[#FA8072] hover:text-[#FA8072] transition-colors shadow-sm">
                <i class="bi bi-arrow-left"></i>
                Volver
            </a>
            @endunless

            @yield('page_header')
        </div>

        <div class="flex-1">
            @yield('contenido')
        </div>

        <footer class="mt-12 bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-8 flex-shrink-0">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start justify-between">

                <div class="text-center md:text-left">
                    <span class="text-xl font-bold tracking-wider text-gray-800">Key<span class="text-[#FA8072]">Xad</span></span>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                        Sistema integral de gestión de consorcios y propiedades.<br>
                        &copy; {{ date('Y') }} Todos los derechos reservados.
                    </p>
                </div>

                <div class="text-center md:text-left">
                    <h4 class="font-bold text-gray-700 mb-3 uppercase tracking-wider text-xs">Enlaces Útiles</h4>
                    <ul class="space-y-2 text-sm text-gray-500 font-medium">
                        <li><a href="#" class="hover:text-[#FA8072] transition-colors"><i class="bi bi-book mr-1"></i> Manual de Usuario</a></li>
                        <li><a href="#" class="hover:text-[#FA8072] transition-colors"><i class="bi bi-shield-check mr-1"></i> Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-[#FA8072] transition-colors"><i class="bi bi-lock mr-1"></i> Políticas de Privacidad</a></li>
                    </ul>
                </div>

                <div class="text-center md:text-right">
                    <h4 class="font-bold text-gray-700 mb-3 uppercase tracking-wider text-xs">Soporte Técnico</h4>
                    <ul class="space-y-2 text-sm text-gray-500 font-medium">
                        <li>
                            <a href="mailto:info@keyxad.ar" class="hover:text-[#FA8072] transition-colors">
                                info@keyxad.ar <i class="bi bi-envelope ml-1 text-[#FA8072]/80"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/5491149148885" target="_blank" class="hover:text-[#FA8072] transition-colors">
                                11-4914-8885 <i class="bi bi-whatsapp ml-1 text-[#FA8072]/80"></i>
                            </a>
                        </li>
                        <li class="mt-4">
                            <span class="inline-block px-3 py-1 bg-gray-50 border border-gray-100 rounded-lg text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                Versión 1.0
                            </span>
                        </li>
                    </ul>
                </div>

            </div>
        </footer>

    </main>
        @include('components.modal-generico')
</body>

</html>