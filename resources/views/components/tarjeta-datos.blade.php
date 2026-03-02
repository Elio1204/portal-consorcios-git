@props(['titulo', 'valor', 'iconClass' => 'bi-info-circle'])

<div class="bg-white/60 backdrop-blur-md border border-white/40 rounded-2xl p-4 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
    <div class="p-3 bg-[#FA8072]/10 rounded-xl text-[#FA8072] text-2xl">
        <i class="bi {{ $iconClass }}"></i>
    </div>
    
    <div class="flex flex-col">
        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $titulo }}</span>
        <span class="text-lg font-semibold text-gray-800">{{ $valor }}</span>
    </div>
</div>