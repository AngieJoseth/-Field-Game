<?php
class PalabrasResueltas
{
   public $id;
   public $idJugador;
   public $idPalabra;

   function __construct($id,$idJugador,$idPalabra){
      $this->id = $id;
      $this->idJugador = $idJugador;
      $this->idPalabra = $idPalabra;
   }
}
?>