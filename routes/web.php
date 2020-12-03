<?php

use Illuminate\Support\Facades\Route;
use App\Models\Usuarios;
use App\Http\Controllers\UsuariosController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/usuarios', function () {
    return Inertia\Inertia::render('Usuarios/Visualizar');
})->name('usuarios.visualizar');

Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    Route::group(['middleware' => ['auth', 'verified']], function () {
        //Funciones de Usuarios
        Route::get("/usuarios/listar", "App\Http\Controllers\UsuariosController@listar")->name("usuarios.listar");
        Route::delete("/usuarios/eliminar/{id}", "App\Http\Controllers\UsuariosController@eliminar")->name("usuarios.eliminar");
        Route::post("/usuarios/crear", "App\Http\Controllers\UsuariosController@crear")->name("usuarios.crear");
        Route::put("/usuarios/editar", "App\Http\Controllers\UsuariosController@editar")->name("usuarios.editar");
    });
});