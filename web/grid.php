<?php

require("db_info.php");

$placa = $_GET['placa']; //Averiguar si inicia el viaje

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
$query = "select * from VIAJE where placa = '$placa' order by fecha desc";
$result = mysqli_query($connection,$query)or die("Consulta fallida 4:" . mysqli_error($connection));

$arreglo = mysqli_fetch_array($result);

echo json_encode($arreglo);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<viajes>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<viaje ';
  echo 'id="' . $row['id'] . '" ';
  echo 'fecha="' . $row['fecha'] . '" ';
  echo 'calificacion="' . $row['calificacion'] . '" ';
  echo 'placa="' . $row['placa'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</viajes>';

mysqli_close($connection);
?>