<?php

require("db_info.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Abrir conexion con el servidor
$connection=mysqli_connect ($servidor, $usuario, $contrasena);
if (!$connection) {
  die('Not connected : ' . mysqli_error());
}

// Seleccionar base de datos
$db_selected = mysqli_select_db($connection,$basededatos);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($connection));
}

//Crear query para obtener datos
$query = "select * from VIAJE where placa = 'C-123XYZ' order by fecha desc";
$result = mysqli_query($connection,$query)or die("Consulta fallida 4:" . mysqli_error($conexion));

$arreglo = mysqli_fetch_array($result);

echo header("Content-type: text/json");
echo json_encode($arreglo);

mysqli_close($connection);
?>

<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Viajes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>
  <body>

</body>
</html>
