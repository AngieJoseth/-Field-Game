<?php
include_once('../controladores/Controlador_Base.php');
include_once('../controladores/CRUD/Controlador_datosjugador.php');
include_once('../controladores/CRUD/Controlador_jugador.php');
class Controlador_cuenta extends Controlador_Base
{
   function registrar($args)
   {
        $controlador_datosjugador = new Controlador_datosjugador();
        $controlador_jugador = new Controlador_jugador();
        if($controlador_jugador->crear($args)){
            $filtro = ['columna'=>'nickname','tipo_filtro'=>'coincide','filtro'=>$args['nickname']];
            $respuesta = $controlador_jugador->leer_filtrado($filtro);
            $idJugador = ['idJugador'=>$respuesta[0]['id'],'tiempo'=>0];
            $nuevosArgs = array_merge($args,$idJugador);
            return $controlador_datosjugador->crear($nuevosArgs);
        }
        return false;
   }

   function login($args)
   {
        $controlador_datosjugador = new Controlador_datosjugador();
        $controlador_jugador = new Controlador_jugador();
        $filtro = ['columna'=>'nickname','tipo_filtro'=>'coincide','filtro'=>$args['nickname']];
        $respuesta = $controlador_jugador->leer_filtrado($filtro);
        $jugador = $respuesta[0];
        $filtro = ['columna'=>'id','tipo_filtro'=>'coincide','filtro'=>$jugador['id']];
        $datosJugador = $controlador_datosjugador->leer_filtrado($filtro)[0];
        return ['jugador'=>$jugador,'datosJugador'=>$datosJugador];
   }
}