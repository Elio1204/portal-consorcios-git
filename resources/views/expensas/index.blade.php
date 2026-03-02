@extends('layouts.app')

@section('contenido')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-light text-gray-800">Mis Expensas</h1>
            <p class="text-gray-500 mt-1">Historial de liquidaciones y comprobantes</p>
        </div>
        <div class="text-[#FA8072] text-4xl opacity-80">
            <i class="bi bi-receipt"></i>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-md border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
        <div class="grid grid-cols-1 divide-y divide-gray-100">
            
            @forelse($expensas as $expensa)
                @php
                    // Generamos la URL usando el nombre de la ruta definida en web.php
                    $url_segura = route('expensas.descargar', ['archivo' => $expensa->archivo]);
                @endphp

                <div class="p-5 hover:bg-gray-50 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                    
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-colors">
                            <i class="bi bi-file-earmark-pdf text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">{{ $expensa->archivo }}</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Documento PDF</p>
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
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                        <i class="bi bi-folder-x text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800">No hay expensas disponibles</h3>
                    <p class="text-gray-500 text-sm">Aún no se han subido liquidaciones para este consorcio.</p>
                </div>
            @endforelse

            </div> @if($expensas->hasPages())
            <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                {{ $expensas->links() }}
            </div>
        @endif

        </div>
    </div>
</div>
@endsection