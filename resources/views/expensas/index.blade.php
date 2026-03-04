@extends('layouts.app')

@section('contenido')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-light text-gray-800">Mis Expensas</h1>
            <p class="text-gray-500 mt-1">Gestión de liquidaciones, avisos y comprobantes</p>
        </div>
        <div class="text-[#FA8072] text-4xl opacity-80">
            <i class="bi bi-receipt"></i>
        </div>
    </div>

    <div class="flex space-x-2 border-b border-gray-200/60 mb-6">
        <button onclick="cambiarPestana('liquidaciones')" id="btn-liquidaciones" class="tab-btn active px-4 py-3 text-sm font-medium border-b-2 border-[#FA8072] text-[#FA8072] transition-colors">
            <i class="bi bi-file-earmark-pdf mr-1"></i> Liquidaciones
        </button>
        <button onclick="cambiarPestana('avisos')" id="btn-avisos" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
            <i class="bi bi-cash-coin mr-1"></i> Avisos de Pago
        </button>
        <button onclick="cambiarPestana('tercero')" id="btn-tercero" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
            <i class="bi bi-folder2-open mr-1"></i> Tercer Módulo
        </button>
    </div>

    <div class="bg-white/80 backdrop-blur-md border border-gray-100 shadow-sm rounded-2xl overflow-hidden min-h-[60vh]">

        <div id="tab-liquidaciones" class="tab-content block">
            <div class="grid grid-cols-1 divide-y divide-gray-100">
                @forelse($expensas as $expensa)
                @php
                $url_segura = route('expensas.descargar', ['archivo' => $expensa->archivo]);
                @endphp

                <div class="p-5 hover:bg-gray-50 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-colors">
                            <i class="bi bi-file-earmark-pdf text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">{{ $expensa->archivo }}</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Liquidación Mensual</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ $url_segura }}" target="_blank" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:border-[#FA8072] hover:text-[#FA8072] transition-colors flex items-center gap-2 shadow-sm">
                            <i class="bi bi-eye"></i> Ver PDF
                        </a>
                        <a href="{{ $url_segura }}?descargar=1" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-500 rounded-lg hover:bg-gray-200 transition-colors" title="Descargar">
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                        <i class="bi bi-folder-x text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800">No hay liquidaciones</h3>
                    <p class="text-gray-500 text-sm mt-1">Aún no se han subido liquidaciones para este consorcio.</p>
                </div>
                @endforelse
            </div>

            @if($expensas->hasPages())
            <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                {{ $expensas->links() }}
            </div>
            @endif
        </div>



        <!-- ------------------------AVISOS DE PAGO------------------------------ -->

        <div id="tab-avisos" class="tab-content hidden">
            <div class="grid grid-cols-1 divide-y divide-gray-100">

                @forelse($avisos as $aviso)
                @php
                // Asegurate de que la ruta coincida con cómo descargas los avisos
                $url_descarga = route('expensas.descargar', ['archivo' => $aviso->archivo ?? '']);
                @endphp

                <div class="p-5 hover:bg-gray-50 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-500 group-hover:bg-green-500 group-hover:text-white transition-colors">
                            <i class="bi bi-cash-coin text-2xl"></i>
                        </div>

                        <div>
                            <h3 class="font-medium text-gray-800">
                                {{ $aviso->archivo ?? 'Aviso_de_Pago' }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-0.5">
                                Vencimiento: {{ date('d/m/Y', strtotime($aviso->fecha_vto)) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ $url_descarga }}" target="_blank" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:border-[#FA8072] hover:text-[#FA8072] transition-colors shadow-sm inline-flex items-center gap-2">
                            <i class="bi bi-download"></i> Descargar Cupón
                        </a>
                    </div>
                </div>

                @empty
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                        <i class="bi bi-wallet-x text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800">No hay avisos de pago</h3>
                    <p class="text-gray-500 text-sm mt-1">Aún no se han generado avisos de pago para este consorcio.</p>
                </div>
                @endforelse

            </div>

            @if($avisos->hasPages())
            <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                {{ $avisos->links() }}
            </div>
            @endif
        </div>

        <div id="tab-tercero" class="tab-content hidden">
            <div class="p-10 text-center">
                <p class="text-gray-500">Contenido del tercer módulo en construcción...</p>
            </div>
        </div>

    </div>
</div>



<script>
    function cambiarPestana(pestanaId) {
        // 1. Ocultar todos los contenidos
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
            el.classList.remove('block');
        });

        // 2. Despintar todos los botones
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-[#FA8072]', 'text-[#FA8072]');
            btn.classList.add('border-transparent', 'text-gray-500');
        });

        // 3. Mostrar el contenido seleccionado
        document.getElementById('tab-' + pestanaId).classList.remove('hidden');
        document.getElementById('tab-' + pestanaId).classList.add('block');

        // 4. Pintar el botón seleccionado con el color salmón
        document.getElementById('btn-' + pestanaId).classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('btn-' + pestanaId).classList.add('border-[#FA8072]', 'text-[#FA8072]');
    }
</script>
@endsection