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
            ->where('valor_presup', '>', 0)
            ->orderBy('fe_ingreso', 'desc')
            ->paginate(3);


        $total_expensas = \Illuminate\Support\Facades\DB::table('expensas_liquidacion')
            ->where('idcons', $idcons)
            ->where('iduf', $id_uf)
            ->sum('total');

        $total_punitorios = \Illuminate\Support\Facades\DB::table('cons_uf_punitorios')
            ->where('idcons', $idcons)
            ->where('iduf', $id_uf)
            ->sum('importe_2do');

        $total_particular = \Illuminate\Support\Facades\DB::table('gastos_particulares')
            ->where('idcons', $idcons)
            ->where('iduf', $id_uf)
            ->sum('gas_par_importe');


        $total_pagos = \Illuminate\Support\Facades\DB::table('pagos')
            ->where('idcons', $idcons)
            ->where('iduf', $id_uf)
            ->sum('importe_total'); 


        $total_deuda = $total_expensas + $total_punitorios + $total_particular - $total_pagos;

        // dd(session()->all());


        return view('inicio', [
            "id_uf" => $id_uf,
            "base_cliente" => $base_cliente,
            'piso' => $unidad->piso,
            'depto' => $unidad->depto,
            "unidad" => $unidad,
            "consorcio" => $consorcio, 
            "ots" => $ots,
            "nombre_consorcio" =>  $consorcio->nombre,
            "total_a_pagar" => $total_deuda,
            "nombre_admin" => session('nombre_admin') // Directo de la sesión

        ]);
    }

}
