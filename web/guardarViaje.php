<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$placa = $_GET['placabus']; //obtenemos la placa por URL
//GUARDAR EN BASE DE DATOS LO OBTENIDO
$usuario = "root";
$contrasena = "Admin123+";  // en mi caso tengo contraseña pero en casa caso introducidla aquí.
$servidor = "35.237.166.125";
$basededatos = "localizadordb";

$conexion = mysqli_connect($servidor,$usuario,$contrasena)or die("No se pudo conectar:");
$db = mysqli_select_db($conexion,$basededatos) or die("No se pudo seleccionar la base de datos");

// Realizar una consulta MySQL
$id_viaje = -1;
$query_c = "CALL ADD_VIAJE('$placa',@salida)";
$query_r = "select @salida";
$result = mysqli_query($conexion,$query_c) or die("Consulta fallida 1:" . mysqli_error($conexion) );
$result_id = mysqli_query($conexion,$query_r) or die("Consulta fallida 2:" . mysqli_error($conexion) );
$respuesta = mysqli_fetch_array($result_id);
$json_response = json_encode($respuesta);
//echo("<!DOCTYPE html><html><body>" . $json_response . "</body></html>");
echo($json_response);
// Cerrar la conexión
mysqli_close($conexion);
?>