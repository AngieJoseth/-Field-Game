<?php
include_once('../controladores/Controlador_Base.php');
include_once('../entidades/CRUD/PalabrasNivel.php');
class Controlador_palabrasnivel extends Controlador_Base
{
   function crear($args)
   {
      $palabrasnivel = new PalabrasNivel($args["id"],$args["idPalabra"],$args["idNivel"]);
      $sql = "INSERT INTO PalabrasNivel (idPalabra,idNivel) VALUES (?,?);";
      $parametros = array($palabrasnivel->idPalabra,$palabrasnivel->idNivel);
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function actualizar($args)
   {
      $palabrasnivel = new PalabrasNivel($args["id"],$args["idPalabra"],$args["idNivel"]);
      $parametros = array($palabrasnivel->idPalabra,$palabrasnivel->idNivel,$palabrasnivel->id);
      $sql = "UPDATE PalabrasNivel SET idPalabra = ?,idNivel = ? WHERE id = ?;";
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
      $sql = "DELETE FROM PalabrasNivel WHERE id = ?;";
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
         $sql = "SELECT * FROM PalabrasNivel;";
      }else{
      $parametros = array($id);
         $sql = "SELECT * FROM PalabrasNivel WHERE id = ?;";
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function leer_paginado($args)
   {
      $pagina = $args["pagina"];
      $registrosPorPagina = $args["registros_por_pagina"];
      $desde = (($pagina-1)*$registrosPorPagina);
      $sql ="SELECT * FROM PalabrasNivel LIMIT $desde,$registrosPorPagina;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function numero_paginas($args)
   {
      $registrosPorPagina = $args["registros_por_pagina"];
      $sql ="SELECT IF(ceil(count(*)/$registrosPorPagina)>0,ceil(count(*)/$registrosPorPagina),1) as 'paginas' FROM PalabrasNivel;";
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
            $sql = "SELECT * FROM PalabrasNivel WHERE $nombreColumna = ?;";
            break;
         case "inicia":
            $sql = "SELECT * FROM PalabrasNivel WHERE $nombreColumna LIKE '$filtro%';";
            break;
         case "termina":
            $sql = "SELECT * FROM PalabrasNivel WHERE $nombreColumna LIKE '%$filtro';";
            break;
         default:
            $sql = "SELECT * FROM PalabrasNivel WHERE $nombreColumna LIKE '%$filtro%';";
            break;
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }
}