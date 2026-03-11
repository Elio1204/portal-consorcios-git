@extends('layouts.app')

@section('contenido')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-light text-gray-800">Gastos Programados</h1>
            <p class="text-gray-500 mt-1">Control de abonos mensuales y mantenimientos preventivos</p>
        </div>
        <div class="text-[#FA8072] text-4xl opacity-80">
            <i class="bi bi-shield-check"></i>
        </div>
    </div>

    <div class="bg-white/60 backdrop-blur-md border border-white/50 rounded-3xl p-6 shadow-sm min-h-[60vh]">

        <div class="flex justify-between items-end mb-8">
            <div>
                <h3 class="text-gray-800 font-medium text-lg">Mantenimientos y Abonos</h3>
                <p class="text-gray-400 text-sm">Listado de servicios técnicos contratados</p>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($ficha_control as $ficha)

            <div class="group flex flex-col md:flex-row md:items-center justify-between p-5 bg-white/40 hover:bg-white/95 rounded-2xl transition-all duration-300 border border-transparent hover:border-[#FA8072]/40 hover:shadow-md gap-6">

                <div class="flex items-center gap-4 min-w-[240px]">
                    <div class="w-12 h-12 rounded-xl bg-[#FA8072]/15 flex items-center justify-center text-[#FA8072] group-hover:bg-[#FA8072] group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="bi bi-clipboard-check text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $ficha->descripcion }}</p>
                        <p class="text-[11px] text-gray-400 font-medium mt-0.5 uppercase tracking-tight">
                            Últ. Control: {{ $ficha->fic_realizado ? date('d/m/Y', strtotime($ficha->fic_realizado)) : 'Pendiente' }}
                        </p>
                    </div>
                </div>

                <div class="flex-1 grid grid-cols-2 md:grid-cols-3 gap-4 text-sm items-center">
                    
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Periodicidad</p>
                        <span class="inline-block px-2 py-0.5 rounded-md bg-[#FA8072]/10 text-[#FA8072] text-[10px] font-bold uppercase mb-1">
                            @switch($ficha->periodicidad)
                                @case(1) Mensual @break
                                @case(2) Bimestral @break
                                @case(6) Semestral @break
                                @case(12) Anual @break
                                @default Otro
                            @endswitch
                        </span>
                        <p class="font-medium text-gray-700 text-xs">
                            <i class="bi bi-calendar3 mr-1 text-gray-400"></i>
                            Vto: {{ date('d/m/Y', strtotime($ficha->fic_vto)) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Empresa / Proveedor</p>
                        <p class="font-medium text-gray-700 truncate text-xs">
                            <i class="bi bi-building mr-1 text-gray-400"></i>
                            {{ $ficha->prove ?? 'Sin asignar' }}
                        </p>
                    </div>

                    <div class="flex justify-start md:justify-center">
                        <button type="button" 
                            onclick="abrirModalGenerico(this)"
                            data-titulo="Control: {{ $ficha->descripcion }}"
                            data-label1="Proveedor"
                            data-valor1="{{ $ficha->prove }}"
                            data-label2="Próximo Vto"
                            data-valor2="{{ date('d/m/Y', strtotime($ficha->fic_vto)) }}"
                            data-label-detalle="Notas Técnicas"
                            data-detalle="{{ $ficha->fic_observaciones ?? 'No existen observaciones adicionales para este servicio.' }}"
                            class="text-[11px] font-bold text-[#FA8072] hover:text-red-600 transition-colors flex items-center gap-1 cursor-pointer">
                            VER DETALLES <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between md:justify-end gap-4 min-w-[130px]">
                    <div class="text-right w-full md:w-auto">
                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-50 border border-gray-100 text-sm font-bold text-gray-800 shadow-sm group-hover:bg-white group-hover:border-[#FA8072]/40 group-hover:text-[#FA8072] transition-all">
                            {{ $ficha->fic_ult_abono ? '$' . number_format($ficha->fic_ult_abono, 2, ',', '.') : 'S/C' }}
                        </span>
                    </div>
                </div>

            </div>
            
            @empty
            <div class="flex flex-col items-center justify-center py-20 px-4 text-center bg-white/30 rounded-3xl border border-dashed border-gray-200">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <i class="bi bi-clipboard-x text-2xl text-gray-300"></i>
                </div>
                <h3 class="text-gray-800 font-medium text-lg">Sin gastos programados</h3>
                <p class="text-gray-500 text-sm mt-1">No se registran servicios de mantenimiento activos para este consorcio.</p>
            </div>
            @endforelse
        </div>

        @if($ficha_control->hasPages())
        <div class="mt-8 pt-6 border-t border-gray-100">
            {{ $ficha_control->links() }}
        </div>
        @endif
    </div>
</div>

{{-- 
    IMPORTANTE: Borré el código del modal de este archivo porque 
    ahora usamos el @include('components.modal-generico') que pusiste en el layout. 
--}}

@endsection