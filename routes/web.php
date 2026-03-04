<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccesoWebController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\ExpensasController;
use App\Http\Controllers\OrdenesTrabajoController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/acceso_web_qr', [AccesoWebController::class, 'index']);

// Rutas protegidas que necesitan conexión a la base del consorcio
Route::middleware(['conectar.consorcio'])->group(function () {
    
    Route::get('/inicio', [PortalController::class, 'index']);
    Route::get('/expensas', [App\Http\Controllers\ExpensasController::class, 'index']);
    Route::get('/expensas/descargar/{archivo}', [App\Http\Controllers\ExpensasController::class, 'descargar'])->name('expensas.descargar');
    Route::get('/ordenes-trabajo', [App\Http\Controllers\OrdenesTrabajoController::class, 'index']);
});