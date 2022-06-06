<?php
  include_once 'conexion.php';


  $imagen = addslashes(file_get_contents($_FILES['examen']['ex_1']))

  $query_guardar_examen =  "INSERT INTO examen (imagen) VALUES ($imagen)";

?>
