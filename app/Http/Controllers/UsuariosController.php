<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    function visualizar(){
        return Usuarios::all();
    }
    function eliminar($id){
        //ORM DE LARAVEL
        Usuarios::destroy($id);
    }
}
