<?php

require("db_info.php");

$TAMANO_PAGINA = 10;

$placa = $_GET['placa']; //Averiguar si inicia el viaje
$pagina = $_GET['pagina']; //Pagina a mostrar

if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}
else {
   $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}



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
//$query_all = "select * from VIAJE where placa = '$placa'";
$query_all = "select * from VIAJE where placa = '$placa' and ID IN (select DISTINCT id_viaje from PUNTO)";

$result_all = mysqli_query($connection,$query_all)or die("Consulta fallida 4:" . mysqli_error($connection));
$num_total_registros = mysqli_num_rows($rs_noticias);
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

//$query_page = "select * from VIAJE where placa = '$placa' order by fecha,id desc LIMIT $inicio,$TAMANO_PAGINA";
$query_page = "select * from VIAJE where placa = '$placa' and ID IN (select DISTINCT id_viaje from PUNTO) order by fecha,id desc LIMIT $inicio,$TAMANO_PAGINA";
$result_page = mysqli_query($connection,$query_page)or die("Consulta fallida 4:" . mysqli_error($connection));

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<viajes>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result_page)){
  // Add to XML document node
  echo '<viaje ';
  echo 'id="' . $row['ID'] . '" ';
  echo 'fecha="' . $row['FECHA'] . '" ';
  echo 'calificacion="' . $row['CALIFICACION'] . '" ';
  echo 'placa="' . $row['PLACA'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</viajes>';
mysqli_close($connection);
?>