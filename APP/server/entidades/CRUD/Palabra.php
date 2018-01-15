<?php
class Palabra
{
   public $id;
   public $palabra;
   public $valor;

   function __construct($id,$palabra,$valor){
      $this->id = $id;
      $this->palabra = $palabra;
      $this->valor = $valor;
   }
}
?>