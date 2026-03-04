@extends('layouts.app')

@section('contenido')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-light text-gray-800">Órdenes de Trabajo</h1>
            <p class="text-gray-500 mt-1">Historial de mantenimiento y reparaciones</p>
        </div>
        <div class="text-[#FA8072] text-4xl opacity-80">
            <i class="bi bi-receipt"></i>
        </div>
    </div>

    <div class="bg-white/60 backdrop-blur-md border border-white/50 rounded-3xl p-6 shadow-sm">

        <div class="flex justify-between items-end mb-6">
            <div>
                <h3 class="text-gray-800 font-medium text-lg">Listado de Órdenes</h3>
                <p class="text-gray-400 text-sm">Últimos informes ingresados</p>
            </div>
            <!-- <a href="#" class="text-[#FA8072] text-sm hover:underline font-medium">Ver todas</a> -->

        </div>

        <div class="space-y-3">
            @forelse($ots as $orden)

            <div class="group flex flex-col md:flex-row md:items-center justify-between p-4 bg-white/40 hover:bg-white/90 rounded-2xl transition-all duration-300 border border-transparent hover:border-[#FA8072]/40 hover:shadow-md gap-4">

                <div class="flex items-center gap-4 min-w-[200px]">
                    <div class="w-12 h-12 rounded-xl bg-[#FA8072]/15 flex items-center justify-center text-[#FA8072] group-hover:bg-[#FA8072] group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="bi bi-tools text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">OT #{{ $orden->ot_nro }}</p>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $orden->sector_afectado ?? 'Sector general' }}</p>
                    </div>
                </div>

                <div class="flex-1 grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Ingreso / Estado</p>
                        <p class="font-medium text-gray-700">
                            <i class="bi bi-calendar3 mr-1 text-[#FA8072]/70"></i>
                            {{ date('d/m/Y', strtotime($orden->fe_ingreso)) }}
                        </p>
                        <p class="text-xs text-[#FA8072] font-semibold mt-0.5">{{ $orden->prove_estado }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Proveedor</p>
                        <p class="font-medium text-gray-700 truncate">
                            <i class="bi bi-person mr-1 text-[#FA8072]/70"></i>
                            {{ $orden->prove_nombre ?? 'Sin proveedor asignado' }}
                        </p>
                    </div>

                    <div class="hidden md:block md:col-span-3 lg:col-span-1">
                        @if($orden->prov_informe)
                        <div class="hidden md:block md:col-span-3 lg:col-span-1">
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Informe detallado</p>
                            <p class="text-gray-600 text-xs line-clamp-2 leading-relaxed">
                                {{ $orden->prov_informe ?? 'Sin informe detallado' }}
                            </p>
                            @if($orden->prov_informe)
                            <button type="button"
                                onclick="abrirModalInforme('{{ $orden->ot_nro }}', this.getAttribute('data-informe'))"
                                data-informe="{{ $orden->prov_informe }}"
                                class="inline-block mt-1 text-[10px] text-[#FA8072] font-bold hover:underline transition-all">
                                Leer completo <i class="bi bi-arrows-fullscreen align-middle ml-1"></i>
                            </button>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between md:justify-end gap-4 min-w-[120px]">
                    <div class="text-right w-full md:w-auto mt-2 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white border border-[#FA8072]/20 text-sm font-bold text-gray-700 shadow-sm group-hover:border-[#FA8072] group-hover:text-[#FA8072] transition-colors">
                            {{ $orden->valor_presup ? '$' . number_format($orden->valor_presup, 2, ',', '.') : 'A cotizar' }}
                        </span>
                    </div>
                </div>

            </div>
            @empty

            <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-white/30 rounded-2xl border border-dashed border-[#FA8072]/30">
                <div class="w-16 h-16 bg-[#FA8072]/10 rounded-full flex items-center justify-center mb-4">
                    <i class="bi bi-inbox text-2xl text-[#FA8072]"></i>
                </div>
                <h3 class="text-gray-800 font-medium text-lg">No hay órdenes registradas para la unidad</h3>
                <p class="text-gray-500 text-sm mt-1">Cuando se generen nuevas órdenes de trabajo, aparecerán aquí.</p>
            </div>
            @endforelse
        </div>

    </div>
</div>

<div id="modalInforme" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="cerrarModalInforme()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            
            <div class="relative transform overflow-hidden rounded-2xl bg-white/90 backdrop-blur-md text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-white">
                
                <div class="bg-gray-50/50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#FA8072]/15 flex items-center justify-center text-[#FA8072]">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-titulo">
                            Informe de OT
                        </h3>
                    </div>
                    <button type="button" onclick="cerrarModalInforme()" class="text-gray-400 hover:text-gray-500 hover:bg-gray-100 p-2 rounded-full transition-colors">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="px-6 py-5">
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-wrap" id="modal-texto-informe">
                            Cargando informe...
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50/50 px-6 py-4 flex justify-end">
                    <button type="button" onclick="cerrarModalInforme()" class="inline-flex justify-center rounded-xl bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors">
                        Cerrar
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    function abrirModalInforme(nroOt, textoInforme) {
        // Llenar los datos
        document.getElementById('modal-titulo').innerText = 'Informe de OT #' + nroOt;
        document.getElementById('modal-texto-informe').innerText = textoInforme;
        
        // Mostrar el modal
        const modal = document.getElementById('modalInforme');
        modal.classList.remove('hidden');
    }

    function cerrarModalInforme() {
        // Ocultar el modal
        const modal = document.getElementById('modalInforme');
        modal.classList.add('hidden');
    }
</script>
@endsection