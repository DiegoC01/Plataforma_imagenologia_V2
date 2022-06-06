<?php

$host = "ec2-54-227-248-71.compute-1.amazonaws.com";
$usuario = "ewenxgtlkruflj";
$pass = "3fbff6de5781b3a2a062ae8f4fd8947e015f909103689e3d8d56eddf52677912";
$bd = "d5r5lnm9t8um47";

// CONEXION AL SISTEMA
$conectar = mysqli_connect($host, $usuario, $pass ,$bd);
mysqli_set_charset($conectar,"utf8");

// Verificar conexión
if (isset($conectar)) {
  // echo "Conectado a la BD";.
}else {
  die("Error en la conexion a la BD: " . mysqli_connect_error());
}

// CONEXION SERVER SIDE
$sql_details = array(
    'user' => $usuario,
    'pass' => $pass,
    'db'   => $bd,
    'host' => $host
);
?>
