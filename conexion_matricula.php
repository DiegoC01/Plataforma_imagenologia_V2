<?php
/*Esta parte del código estaba antes.
$host = "db-diac.ckhlco3b9xsr.us-east-1.rds.amazonaws.com";
$usuario = "icinf_g3";
$pass = "icinf.2020#";
$bd = "matricula";
*/
//Las siguientes líneas de código se pueden borrar más adelante

// CONEXION AL SISTEMA
$conectar2 = mysqli_connect($host, $usuario, $pass ,$bd);
mysqli_set_charset($conectar2,"utf8");

// Verificar conexión
if (isset($conectar2)) {
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
