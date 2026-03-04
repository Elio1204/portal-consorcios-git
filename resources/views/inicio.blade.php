@extends('layouts.app')

@section('contenido')
<div class="max-w-6xl mx-auto space-y-6">

    <div class="bg-white/80 backdrop-blur-md border border-gray-100 shadow-sm rounded-2xl p-6 md:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="text-[#FA8072] font-bold text-xs uppercase tracking-widest">
                <i class="bi bi-building mr-1"></i> {{ $nombre_consorcio }}
            </span>
            <h1 class="text-2xl md:text-3xl font-light text-gray-800 mt-1">
                Hola, <span class="font-medium">{{ $unidad->titular }}</span>
            </h1>
            <p class="text-gray-500 text-sm mt-1">
                <i class="bi bi-geo-alt"></i> Unidad Funcional {{ $piso }}{{ $depto ? '-' . $depto : '' }}
            </p>
        </div>

        <div class="text-left md:text-right bg-gray-50 p-4 rounded-xl border border-gray-100 w-full md:w-auto">
            <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Administración</p>
            <p class="text-sm font-medium text-gray-700">
                <i class="bi bi-shield-check text-[#FA8072] mr-1"></i> {{ $nombre_admin }}
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-1 space-y-6">


            <div class="bg-[#FA8072] rounded-2xl p-6 text-white shadow-lg shadow-[#FA8072]/20 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl"></div>

                <p class="text-white/80 text-sm font-medium mb-1">Saldo de cuenta</p>

                <h2 class="text-3xl font-bold">
                    $ {{ number_format(abs($total_a_pagar), 2, ',', '.') }}
                </h2>

                <div class="mt-4 text-xs rounded-lg py-1.5 px-3 backdrop-blur-sm inline-block 
                    @if($total_a_pagar > 0) bg-red-900/30 text-white 
                    @elseif($total_a_pagar == 0) bg-green-500/40 text-white 
                    @else bg-blue-500/40 text-white @endif">

                    @if($total_a_pagar > 0)
                    <i class="bi bi-exclamation-triangle-fill mr-1"></i> Pendiente de pago
                    @elseif($total_a_pagar == 0)
                    <i class="bi bi-check-circle-fill mr-1"></i> Expensas al día
                    @else
                    <i class="bi bi-info-circle-fill mr-1"></i> Saldo a favor
                    @endif

                </div>
            </div>

            <div class="bg-white/60 backdrop-blur-md border border-gray-100 rounded-2xl p-5 shadow-sm">
                <h3 class="text-gray-800 font-medium mb-3 text-sm uppercase tracking-wide">Ficha de Unidad</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex justify-between items-center border-b border-gray-50 pb-2">
                        <span class="text-gray-500">ID Unidad</span>
                        <span class="font-medium text-gray-800">#{{ $id_uf }}</span>
                    </li>
                    <!-- <li class="flex justify-between items-center pb-1">
                        <span class="text-gray-500">Coeficiente</span>
                        <span class="font-medium text-gray-800">{{ $unidad->porcentaje ?? '0' }}%</span>
                    </li> -->
                </ul>
            </div>

        </div>

        <div class="lg:col-span-2">
            <div class="bg-white/60 backdrop-blur-md border border-gray-100 rounded-2xl p-6 shadow-sm h-full">

                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h3 class="text-gray-800 font-medium text-lg">Órdenes de Trabajo</h3>
                        <p class="text-gray-400 text-sm">Últimos informes ingresados</p>
                    </div>
                    <a href="/ordenes-trabajo" class="text-[#FA8072] text-sm hover:underline font-medium">Ver ordenes de la unidad</a>
                </div>

                <div class="space-y-2">
                    @forelse($ots as $orden)
                    <div class="group flex items-center justify-between p-3 hover:bg-white rounded-xl transition-all border border-transparent hover:border-gray-100 hover:shadow-sm">

                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:text-[#FA8072] group-hover:bg-[#FA8072]/10 transition-colors">
                                <i class="bi bi-tools"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $orden->prov_informe }}</p>
                                <p class="text-xs text-gray-500">{{ date('d M, Y', strtotime($orden->fe_ingreso)) }}</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <span class="text-[10px] font-bold px-2.5 py-1 rounded-md bg-gray-100 text-gray-600 uppercase tracking-wider">
                                {{ $orden->valor_presup ? '$' . number_format($orden->valor_presup
                                , 2) : 'Sin presupuesto' }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10 text-gray-400">
                        <i class="bi bi-inbox text-4xl mb-3"></i>
                        <p class="text-sm">No hay órdenes de trabajo registradas</p>
                    </div>
                    @endforelse


                    @if($ots->hasPages())
                    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                        {{ $ots->links() }}
                    </div>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>
@endsection