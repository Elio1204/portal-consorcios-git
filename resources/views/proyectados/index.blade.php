@extends('layouts.app')

@section('contenido')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-light text-gray-800">Proyectados</h1>
            <p class="text-gray-500 mt-1">Visualización de gastos planificados para los próximos meses</p>
        </div>
        <div class="text-[#FA8072] text-4xl opacity-80">
            <i class="bi bi-graph-up-arrow"></i>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-md border border-gray-100 shadow-sm rounded-2xl p-6 min-h-[60vh]">
        
        <div class="space-y-3">
            @forelse($proyectados as $proyectado)
            
            <div class="group flex flex-col md:flex-row md:items-center justify-between p-4 bg-white/40 hover:bg-white/90 rounded-2xl transition-all duration-300 border border-transparent hover:border-[#FA8072]/40 hover:shadow-md gap-4">

                <div class="flex items-center gap-4 min-w-[200px]">
                    <div class="w-12 h-12 rounded-xl bg-[#FA8072]/15 flex items-center justify-center text-[#FA8072] group-hover:bg-[#FA8072] group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="bi bi-hourglass-split text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $proyectado->periodo ?? 'Sin periodo' }}</p>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $proyectado->pro_enc_aceptado == 't' ? 'Terminado' : ($proyectado->pro_enc_aceptado ?? 'En proceso   ' )}}</p>
                    </div>
                </div>

                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Hasta</p>
                        <p class="font-medium text-gray-700">
                            <i class="bi bi-calendar-event mr-1 text-[#FA8072]/70"></i>
                            {{ $proyectado->pro_enc_desde ?? 'Sin lectura' }}
                        </p>
                    </div>
                    
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Hasta</p>
                        <p class="font-medium text-gray-700">
                            <i class="bi bi-calendar-event mr-1 text-[#FA8072]/70"></i>
                            {{ $proyectado->pro_enc_hasta ?? 'Sin lectura' }}
                        </p>
                    </div>
                </div>

<button type="button" 
    onclick="abrirModalProyectado(this)"
    data-titulo="Proyectado #{{ $proyectado->periodo ?? 'S/N' }}"
    data-periodo="{{ $proyectado->periodo ?? 'Sin periodo' }}"
    data-hasta="{{ $proyectado->pro_enc_hasta ?? 'Sin lectura' }}"
    data-detalle="{{ $proyectado->periodo ?? 'Sin detalle adicional cargado en el sistema.' }}"
    class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-50 border border-gray-100 text-sm font-bold text-gray-700 shadow-sm hover:bg-white hover:border-[#FA8072]/40 hover:text-[#FA8072] transition-colors cursor-pointer">
    Ver más <i class="bi bi-arrows-angle-expand ml-2 text-[10px]"></i>
</button>

            </div>
            
            @empty
            
            <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
                <div class="w-16 h-16 bg-[#FA8072]/10 rounded-full flex items-center justify-center mb-4">
                    <i class="bi bi-clipboard-data text-2xl text-[#FA8072]"></i>
                </div>
                <h3 class="text-gray-800 font-medium text-lg">No hay gastos proyectados</h3>
                <p class="text-gray-500 text-sm mt-1">Los futuros trabajos y mantenimientos planificados aparecerán aquí.</p>
            </div>
            
            @endforelse
        </div>
        
        @if(method_exists($proyectados, 'hasPages') && $proyectados->hasPages())
            <div class="mt-6 pt-6 border-t border-gray-100">
                {{ $proyectados->links() }}
            </div>
        @endif

    </div>
</div>
@endsection