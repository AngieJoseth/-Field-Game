<?php
class PalabrasNivel
{
   public $id;
   public $idPalabra;
   public $idNivel;

   function __construct($id,$idPalabra,$idNivel){
      $this->id = $id;
      $this->idPalabra = $idPalabra;
      $this->idNivel = $idNivel;
   }
}
?>