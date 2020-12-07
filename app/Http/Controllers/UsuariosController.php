<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    function listar(Request $rq){
        /*"SELECT * FROM usuarios"*/
        $bs = str_replace(array(" ", "-", "_"),"%",$rq->buscar);
        return Usuarios::where("nombre", "like", "%$bs%")
                        ->orWhere("apellido", "like", "%$bs%")
                        ->orWhere("direccion", "like", "%$bs%")
                        ->simplePaginate(10);
    }
    function eliminar($id){
        //ORM DE LARAVEL
        /*"DELETE FROM usuarios WHERE id=$id";*/
        Usuarios::destroy($id);
    }
    function crear(Request $rq){
        //ORM DE LARAVEL
        /*"DELETE FROM usuarios WHERE id=$id";*/
        $us = new Usuarios();
        $us->nombre = $rq->nombre;
        $us->apellido = $rq->apellido;
        $us->edad = $rq->edad;
        $us->direccion = $rq->direccion;
        $us->save();
    }
    function editar(Request $rq){
        $us = Usuarios::find($rq->id);
        $us->nombre = $rq->nombre;
        $us->apellido = $rq->apellido;
        $us->edad = $rq->edad;
        $us->direccion = $rq->direccion;
        $us->save();
    }
}
