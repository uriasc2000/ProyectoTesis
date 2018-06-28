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
$respuesta = mysqli_fetch_array($result);

$tabla = "<table><tr><th>ID</th><th>FECHA</th><th>CALIFICACION</th><th>PLACA</th></tr>";

foreach($result as $i){
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