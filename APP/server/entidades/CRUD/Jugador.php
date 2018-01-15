<?php
class Jugador
{
   public $id;
   public $nombre;
   public $nickname;

   function __construct($id,$nombre,$nickname){
      $this->id = $id;
      $this->nombre = $nombre;
      $this->nickname = $nickname;
   }
}
?>