<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenesTrabajoController extends Controller
{
    //
    public function index()
    {

            // 1. Verificamos que haya sesión
        if (!session()->has('id_uf')) {
            return redirect('/')->with('error', 'Sesión no iniciada');
        }


        $idcons = session('idcons');
        $iduf = session('id_uf');
        $path_adm = session('path_adm');
        $path_pdf = session('path_pdf');


        $ots = DB::table('ots')
            ->leftJoin('proveedores', 'ots.idproveedor', '=', 'proveedores.idproveedor')
            ->leftJoin('estados', 'ots.idestado', '=', 'estados.idestado')
            ->select('ots.*', 'proveedores.proveedor as prove_nombre', 'estados.estado as prove_estado')
            ->where('ots.idconsorcio', $idcons)
            ->where('ots.iduf', $iduf)
            ->paginate(10);

        return view('ordenes.index', compact('ots', 'path_adm', 'path_pdf'));
    }
}
