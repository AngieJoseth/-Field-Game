<?php
include_once('../controladores/Controlador_Base.php');
class Controlador_juego extends Controlador_Base
{
    function palabras($args) {
      $nivel = $args['nivel'];
      $sql = "SELECT UPPER(Palabra.palabra) as 'palabra', Palabra.valor FROM Palabra INNER JOIN PalabrasNivel ON Palabra.id = PalabrasNivel.idPalabra WHERE PalabrasNivel.idNivel = ?;";
      $parametros = array($nivel);
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return false;
      }else{
         return $respuesta;
      }
    }

    function sortearPalabra($args){
        $palabras = $this->palabras($args);
        shuffle($palabras);
        return $palabras[0];
    }

    function palabraToShow($args){
        $toShow = "";
        $palabraSorteada = $this->sortearPalabra($args);
        $palabra = $palabraSorteada['palabra'];
        $palabraEstadoActual = "";
        for ($i = 0; $i<=strlen($palabra)-1 ; $i++){
            $toShow .= $palabra[$i].' ';
            $palabraEstadoActual .= '_ ';
        }        
        $palabraSorteada['palabra'] = trim($toShow,' ');
        $toInsert = ['palabraEstadoActual'=>trim($palabraEstadoActual,' ')];
        return array_merge($palabraSorteada, $toInsert);
    }

    function validar($args){
        $letra = $args['letra'];
        $palabra = $args['palabra'];
        $palabraEstadoActual = $args['palabraEstadoActual'];
        $mostrado = false;
        $toShow = "";
        for ($i = 0; $i<=strlen($palabra)-1 ; $i++){
            if($palabra[$i]==$letra && $palabraEstadoActual[$i]=='_' ){
                $toShow .= $palabra[$i];
                $mostrado = true;     
            }else {
                $toShow .= $palabraEstadoActual[$i]; 
            }
       
        }
        if( $mostrado ){
            return $toShow ;
        }
        return false;
    }
}