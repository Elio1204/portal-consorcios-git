<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class ConectarBaseConsorcio
{
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario tiene guardada una base en la sesión...
        if (session()->has('base_cliente')) {
            
            $base = session('base_cliente');

            // Hacemos el salto dinámico que probamos antes
            Config::set('database.connections.consorcio', config('database.connections.mysql'));
            Config::set('database.connections.consorcio.database', $base);
            
            // Establecemos la conexión como predeterminada para esta petición
            DB::setDefaultConnection('consorcio');
        }

        return $next($request);
    }
}