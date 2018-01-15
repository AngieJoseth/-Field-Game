<?php
include_once('../controladores/Controlador_Base.php');
include_once('../entidades/CRUD/PalabrasResueltas.php');
class Controlador_palabrasresueltas extends Controlador_Base
{
   function crear($args)
   {
      $palabrasresueltas = new PalabrasResueltas($args["id"],$args["idJugador"],$args["idPalabra"]);
      $sql = "INSERT INTO PalabrasResueltas (idJugador,idPalabra) VALUES (?,?);";
      $parametros = array($palabrasresueltas->idJugador,$palabrasresueltas->idPalabra);
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function actualizar($args)
   {
      $palabrasresueltas = new PalabrasResueltas($args["id"],$args["idJugador"],$args["idPalabra"]);
      $parametros = array($palabrasresueltas->idJugador,$palabrasresueltas->idPalabra,$palabrasresueltas->id);
      $sql = "UPDATE PalabrasResueltas SET idJugador = ?,idPalabra = ? WHERE id = ?;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function borrar($args)
   {
      $id = $args["id"];
      $parametros = array($id);
      $sql = "DELETE FROM PalabrasResueltas WHERE id = ?;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function leer($args)
   {
      $id = $args["id"];
      if ($id==""){
         $sql = "SELECT * FROM PalabrasResueltas;";
      }else{
      $parametros = array($id);
         $sql = "SELECT * FROM PalabrasResueltas WHERE id = ?;";
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function leer_paginado($args)
   {
      $pagina = $args["pagina"];
      $registrosPorPagina = $args["registros_por_pagina"];
      $desde = (($pagina-1)*$registrosPorPagina);
      $sql ="SELECT * FROM PalabrasResueltas LIMIT $desde,$registrosPorPagina;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function numero_paginas($args)
   {
      $registrosPorPagina = $args["registros_por_pagina"];
      $sql ="SELECT IF(ceil(count(*)/$registrosPorPagina)>0,ceil(count(*)/$registrosPorPagina),1) as 'paginas' FROM PalabrasResueltas;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta[0];
   }

   function leer_filtrado($args)
   {
      $nombreColumna = $args["columna"];
      $tipoFiltro = $args["tipo_filtro"];
      $filtro = $args["filtro"];
      switch ($tipoFiltro){
         case "coincide":
            $parametros = array($filtro);
            $sql = "SELECT * FROM PalabrasResueltas WHERE $nombreColumna = ?;";
            break;
         case "inicia":
            $sql = "SELECT * FROM PalabrasResueltas WHERE $nombreColumna LIKE '$filtro%';";
            break;
         case "termina":
            $sql = "SELECT * FROM PalabrasResueltas WHERE $nombreColumna LIKE '%$filtro';";
            break;
         default:
            $sql = "SELECT * FROM PalabrasResueltas WHERE $nombreColumna LIKE '%$filtro%';";
            break;
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }
}