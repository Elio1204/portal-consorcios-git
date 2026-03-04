<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpensasController extends Controller
{
    public function index()
    {

        if (!session()->has('id_uf')) {
            return redirect('/')->with('error', 'Sesión no iniciada');
        }

        // 2. Traemos las rutas de la mochila
        $path_adm = session('path_adm');
        $path_pdf = session('path_pdf');
        $idcons = session('idcons');


        $expensas = DB::table('expensas')
            ->where('idcons', $idcons)
            ->orderBy('idexp', 'desc')
            ->paginate(5); 

        $avisos = DB::table('expensas_liquidacion')
            ->where('idcons', $idcons)
            ->where('iduf', session('id_uf'))
            ->orderBy('fecha_vto', 'desc')
            ->paginate(5);
            

        return view('expensas.index', compact('expensas', 'avisos', 'path_adm', 'path_pdf'));
    }

    public function descargar($archivo)
    {

        if (!session()->has('id_uf')) {
            return redirect('/')->with('error', 'Sesión no iniciada');
        }

        $path_pdf = session('path_pdf');
        $path_adm = session('path_adm');
        $ruta_fisica = public_path("keyxad/_lib/file/doc/{$path_adm}/{$path_pdf}/{$archivo}");

        if (!file_exists($ruta_fisica)) {
            abort(404, 'El documento PDF no se encuentra en el servidor.');
        }

        return response()->file($ruta_fisica);
    }
}
