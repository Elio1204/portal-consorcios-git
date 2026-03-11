<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FichaControlesController extends Controller
{
    //

    public function index(){

        if (!session()->has('id_uf')) {
            return redirect('/')->with('error', 'Sesión no iniciada');
        }


        $idcons = session('idcons');
        $iduf = session('id_uf');
        $path_adm = session('path_adm');
        $path_pdf = session('path_pdf');

        $ficha_control = DB::table('consorcio_ficha')
        ->leftjoin('controles', 'consorcio_ficha.idcontrol', 'controles.idcontrol')
        ->leftjoin('proveedores', 'consorcio_ficha.idproveedor', 'proveedores.idproveedor')
        ->select('consorcio_ficha.*', 'controles.con_descripcion as descripcion', 'proveedores.proveedor as prove')
        ->where('consorcio_ficha.idcons', $idcons)
        ->where('consorcio_ficha.idproveedor', '>', 0 )
        ->where('consorcio_ficha.fic_realizado', '<>', '0000-00-00')
        ->paginate(10);


        return view('ficha-controles.index', compact('ficha_control'));
    }
}
