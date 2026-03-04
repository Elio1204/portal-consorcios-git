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


            $proyectados = \Illuminate\Support\Facades\DB::table('proyectados_encabezado')
                ->where('idcons', $idcons)
                ->orderBy('pro_enc_hasta', 'desc')
                ->paginate(5);

            return view('proyectados.index', compact('proyectados', 'path_adm', 'path_pdf', 'idcons'));
        }
    }
