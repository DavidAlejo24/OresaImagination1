<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios;
use Illuminate\Http\Request;
class UsuariosController extends Controller
{
    function listar(Request $rq){
        /*"SELECT * FROM usuarios"*/
        /*$bs = str_replace(array(" ", "-", "_"),"%",$rq->buscar);
        return Usuarios::where("nombre", "like", "%$bs%")
                        ->orWhere("apellido", "like", "%$bs%")
                        ->orWhere("direccion", "like", "%$bs%")
                        ->simplePaginate(10);*/
        /*SELECT * FROM usuarios WHERE nombre like "%dr%" OR apellido like "%dr%"
            pepe jose chalo macias de ecuador
            %pepe%ecuador%
        */ //str_replace("valores a cambiar", "valores con los que cambia", $variable) 

        $bs = str_replace(array(" ", "-", "_"), "%", $rq->buscar);
        return Usuarios::where("nombre", "like", "%$bs%")
                        ->orWhere("apellido", "like", "%$bs%")
                        ->orWhere("direccion", "like", "%$bs%")
                        ->orderBy("created_at", "DESC")
                        ->simplePaginate(10);
        //where(campo, condicional, variable)
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

    function ver(){
        return Auth::user();
    }
}
