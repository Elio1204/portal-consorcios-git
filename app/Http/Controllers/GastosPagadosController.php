<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GastosPagadosController extends Controller
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
            $pagos = \Illuminate\Support\Facades\DB::table('pagos')
                ->where('idcons', $idcons)
                ->orderBy('idpago', 'desc')
                ->paginate(5);

            return view('pagos.index');

    }
}
