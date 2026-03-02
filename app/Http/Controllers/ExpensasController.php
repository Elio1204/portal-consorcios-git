<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpensasController extends Controller
{
    public function index()
    {
        // 1. Verificamos que haya sesión
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
            ->paginate(10); // Paginación de 10 por página, puedes ajustar esto según tus necesidades
            

        // 4. Mandamos todo a una vista nueva
        return view('expensas.index', compact('expensas', 'path_adm', 'path_pdf'));
    }

    public function descargar($archivo)
    {
        // 1. Verificamos que haya sesión
        if (!session()->has('id_uf')) {
            return redirect('/')->with('error', 'Sesión no iniciada');
        }

        $path_pdf = session('path_pdf');
        $path_adm = session('path_adm');
        $ruta_fisica = public_path("keyxad/_lib/file/doc/{$path_adm}/{$path_pdf}/{$archivo}");

        if (!file_exists($ruta_fisica)) {
            // Si no existe (como pasa ahora en tu entorno local), mostramos error 404 amigable
            abort(404, 'El documento PDF no se encuentra en el servidor.');
        }

        return response()->file($ruta_fisica);
    }
}
