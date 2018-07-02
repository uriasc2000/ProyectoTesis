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
$query_all = "select * from VIAJE where placa = '$placa'";
$result_all = mysqli_query($connection,$query_all)or die("Consulta fallida 4:" . mysqli_error($connection));
$num_total_registros = mysqli_num_rows($result_all);
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

$query_page = "select * from VIAJE where placa = '$placa' order by fecha,id desc LIMIT $inicio,$TAMANO_PAGINA";
$result_page = mysqli_query($connection,$query_page)or die("Consulta fallida 4:" . mysqli_error($connection));
//$respuesta = mysqli_fetch_array($result_page);

$tabla = "<table><tr><th>ID</th><th>FECHA</th><th>CALIFICACION</th><th>PLACA</th></tr>";

foreach($result_page as $i){
    $tabla .= "<tr>";
    $tabla .= "<td>".$i['ID']."</td>";
    $tabla .= "<td>".$i['FECHA']."</td>";
    $tabla .= "<td>".$i['CALIFICACION']."</td>";
    $tabla .= "<td>".$i['PLACA']."</td>";
    $tabla .= "<td><form action=\"mimapa.php\" method =\"GET\">";                                
    $tabla .= "<input type=\"hidden\" value =\"".$i['ID']."\" name =\"viaje\" id=\"viaje\" />";
    $tabla .= "<input type=\"submit\" value=\"Ver\"/>";
    $tabla .= "</form></td>";          
    $tabla .= "</tr>";
}

$tabla .= "</table>";

header("Content-type: text/json");
echo json_encode($tabla);
mysqli_close($connection);
?>