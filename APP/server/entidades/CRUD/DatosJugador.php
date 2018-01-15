<?php
class DatosJugador
{
   public $id;
   public $idJugador;
   public $tiempo;

   function __construct($id,$idJugador,$tiempo){
      $this->id = $id;
      $this->idJugador = $idJugador;
      $this->tiempo = $tiempo;
   }
}
?>