<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

    class ProyectadosController extends Controller
    {
        //
        public function index()
        {
            if (!session()->has('id_uf')) {
                return redirect('/')->with('error', 'Sesión no iniciada');
            }

            // 2. Traemos las rutas de la mochila
            $path_adm = session('path_adm');
            $path_pdf = session('path_pdf');
            $idcons = session('idcons');

            //padre
            $proyectados = \Illuminate\Support\Facades\DB::table('proyectados_encabezado')
                ->where('idcons', $idcons)
                ->orderBy('pro_enc_hasta', 'desc')
                ->paginate(5);

            //hijo
// extraemos solo los IDs de los encabezados que se están mostrando en esta pagina
            $ids_encabezados = collect($proyectados->items())->pluck('idpro_enc')->toArray();

// traemos los detalles (Hijos) pro solo los de esos ids y los agrupamos
            $detalles = \Illuminate\Support\Facades\DB::table('proyectados')
            ->whereIn('idpro_enc', $ids_encabezados)
            ->get()
            ->groupBy('idpro_enc'); 

            return view('proyectados.index', compact('proyectados', 'detalles' ,'path_adm', 'path_pdf', 'idcons'));
        }
    }
