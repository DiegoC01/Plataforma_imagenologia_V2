<?php

$host = "localhost";
$usuario = "root";
$pass = "root";
$bd = "BD_imagenologiaHCVB";

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
