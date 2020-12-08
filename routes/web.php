<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

//página principal
Route::get('/', function () {
    return view('welcome');
});

//renderización de vistas de vue
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/usuarios', function () {
    return Inertia\Inertia::render('Usuarios/Visualizar');
})->name('usuarios.visualizar');

//Funciones de Usuarios
Route::get("/usuarios/listar", [UsuariosController::class, "listar"])->name("usuarios.listar")->middleware("permission:usuarios.listar");
Route::post("/usuarios/crear", [UsuariosController::class, "crear"])->name("usuarios.crear")->middleware("permission:usuarios.crear");
Route::put("/usuarios/editar", [UsuariosController::class, "editar"])->name("usuarios.editar")->middleware("permission:usuarios.editar");
Route::delete("/usuarios/eliminar/{id}", [UsuariosController::class, "eliminar"])->name("usuarios.eliminar")->middleware("permission:usuarios.eliminar");

Route::get("/ver", [UsuariosController::class, "ver"])->name("usuarios.ver")->middleware("permission:users.ver");