<div id="modalGenerico" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="cerrarModalGenerico()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            
            <div class="relative transform overflow-hidden rounded-2xl bg-white/95 backdrop-blur-md text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-6xl border border-white">
                
                <div class="bg-gray-50/50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#FA8072]/15 flex items-center justify-center text-[#FA8072]">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-gen-titulo">
                            Detalle
                        </h3>
                    </div>
                    <button type="button" onclick="cerrarModalGenerico()" class="text-gray-400 hover:text-[#FA8072] hover:bg-red-50 p-2 rounded-full transition-colors cursor-pointer">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="px-6 py-5">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1" id="modal-gen-label1">Dato 1</p>
                            <p class="font-semibold text-gray-700 text-sm" id="modal-gen-valor1">-</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1" id="modal-gen-label2">Dato 2</p>
                            <p class="font-semibold text-gray-700 text-sm" id="modal-gen-valor2">-</p>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1" id="modal-gen-label-detalle">Descripción</p>
                        <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-wrap bg-gray-50/50 p-3 rounded-xl border border-gray-50" id="modal-gen-detalle">
                            -
                        </p>
                    </div>

                    <div class="mt-4">
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-2" id="modal-gen-label-lista">Items Proyectados</p>
                        <div id="modal-gen-lista-contenido" class="bg-white border border-gray-100 rounded-xl overflow-hidden divide-y divide-gray-50">
                        </div>
                    </div>

                </div>

                <div class="bg-gray-50/50 px-6 py-4 flex justify-end">
                    <button type="button" onclick="cerrarModalGenerico()" class="inline-flex justify-center rounded-xl bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors cursor-pointer">
                        Cerrar
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Esta función es local, se puede llamar desde cualquier pantalla
    function abrirModalGenerico(boton) {
        // 1. Llenamos los títulos (labels) dinámicos
        document.getElementById('modal-gen-titulo').innerText = boton.getAttribute('data-titulo') || 'Detalle';
        document.getElementById('modal-gen-label1').innerText = boton.getAttribute('data-label1') || 'Dato 1';
        document.getElementById('modal-gen-label2').innerText = boton.getAttribute('data-label2') || 'Dato 2';
        document.getElementById('modal-gen-label-detalle').innerText = boton.getAttribute('data-label-detalle') || 'Descripción Detallada';

        // 2. Llenamos los valores de la base de datos
        document.getElementById('modal-gen-valor1').innerText = boton.getAttribute('data-valor1') || '-';
        document.getElementById('modal-gen-valor2').innerText = boton.getAttribute('data-valor2') || '-';
        document.getElementById('modal-gen-detalle').innerText = boton.getAttribute('data-detalle') || 'Sin información adicional.';
        



        // --- NUEVA LÓGICA PARA LISTAS DINÁMICAS ---
        const listaRaw = boton.getAttribute('data-lista');
        const contenedorLista = document.getElementById('modal-gen-lista-contenido');
        
        if (listaRaw && listaRaw !== '[]') {
            // Convertimos el texto JSON de nuevo a un listado real
            const items = JSON.parse(listaRaw);
            let htmlLista = '';
            
            // Recorremos cada hijo y armamos un renglón
            items.forEach(item => {
                // ACÁ TENÉS QUE PONER LOS NOMBRES REALES DE TUS COLUMNAS (ej: item.concepto, item.importe)
                htmlLista += `
                    <div class="p-3 text-sm flex justify-between items-center hover:bg-gray-50 transition-colors">
                        <span class="text-gray-600">${item.pro_descripcion}</span>
                        <span class="font-bold text-gray-800">$ ${item.pro_total}</span>
                    </div>
                `;
            });
            contenedorLista.innerHTML = htmlLista;
            document.getElementById('modal-gen-label-lista').parentElement.classList.remove('hidden');
        } else {
            // Si no hay lista o está vacía, ocultamos esta sección para que el modal quede limpio
            document.getElementById('modal-gen-label-lista').parentElement.classList.add('hidden');
        }




        // 3. Mostramos el modal
        const modal = document.getElementById('modalGenerico');
        modal.classList.remove('hidden');
    }

    function cerrarModalGenerico() {
        const modal = document.getElementById('modalGenerico');
        modal.classList.add('hidden');
    }
</script>