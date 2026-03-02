<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PortalController extends Controller
{
    //
   public function index()
    {
        if(!session()->has('id_uf')) {
            return 'Error: Acceso denegado.';
        }

        $id_uf = session('id_uf');
        $idcons = session('idcons');
        $idadmin = session('id_admin');
        $base_cliente = session('base_cliente');
        // $nombre_admin = session('nombre_admin');

        // 1. Datos de la Unidad (Base del cliente)
        $unidad = \Illuminate\Support\Facades\DB::table('cons_uni_fun')
            ->where('iduf', $id_uf)
            ->first();

        // 2. Datos del Consorcio (Para mostrar el nombre del edificio)
        $consorcio = \Illuminate\Support\Facades\DB::table('consorcios')
            ->where('idcons', $idcons)
            ->first();

        // 3. Últimas 3 Órdenes de Trabajo
        $ots = \Illuminate\Support\Facades\DB::table('ots')
            ->where('idconsorcio', $idcons)
            ->orderBy('fe_ingreso', 'desc')
            ->limit(3)
            ->get();
        // dd(session()->all());


        return view('inicio', [
            "id_uf" => $id_uf,
            "base_cliente" => $base_cliente,
            "unidad" => $unidad,
            "consorcio" => $consorcio, 
            "ots" => $ots,
            "nombre_consorcio" =>  $consorcio->nombre, 
            "nombre_admin" => session('nombre_admin') // Directo de la sesión

        ]);
    }

}
