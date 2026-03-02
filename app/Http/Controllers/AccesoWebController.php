<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config; 

class AccesoWebController extends Controller
{
    //
    public function index(Request $request)
    {

    //esto para leer los parametros que se le pasan por la url
        $email = $request->query('email');
        $clave = $request->query('clave');


        $propietario = DB::table('acceso_propietarios')
            ->where('email', $email)
            ->where('clave', $clave)
            ->first();

        if (!$propietario) {
            return "Error: Acceso denegado. Comuníquese con el administrador del consorcio.";
        } 


        $administracion = DB::table('administraciones')
            ->where('idadmin', $propietario->idadmin)
            ->first();

        // aca hago salto dinamico entre bases de datos, segun la administracion que corresponda al propietario


        //esto para mostrar el resultado de la consulta, y verificar que se esta leyendo la base de datos correcta segun el propietario
        Config::set('database.connections.consorcio', config('database.connections.mysql'));
        Config::set('database.connections.consorcio.database', $administracion->base);


        //conexion a la base de datos del consorcio correspondiente
        $datos_uf = DB::connection('consorcio')
        ->table('cons_uni_fun')
        ->where('iduf', $propietario->iduf)
        ->first();

        $datos_consorcio = DB::connection('consorcio')
        ->table('consorcios')
        ->where('idcons', $propietario->idcons)
        ->first();


        // dd($datos_consorcio);
        session([
            'id_uf' => $propietario->iduf,
            'id_admin' => $propietario->idadmin,
            'base_cliente' => $administracion->base,
            'idcons' => $propietario->idcons,
            'nombre_admin' => $administracion->nombre,
            'path_adm' => $administracion->path_adm,
            'path_pdf' => $datos_consorcio->path_pdf
        ]);

        // redireccionamos al usuario a la pantalla principal del portal
        return redirect('/inicio');
    }
}