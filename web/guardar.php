<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$latitud = $_GET['lati']; //obtenemos la latitud por URL

$longitud = $_GET['longi']; //obtenemos la longitud por URL

$velocidad = $_GET['veloci']; //obtenemos la longitud por URL

$longitud = $longitud * 10; //multiplico la longitud por 10 

$coordenadas = array('latitud' => $latitud, 'longitud' => $longitud, 'velocidad' => $velocidad); //Creamos el array
//Creamos el JSON
$json_string = json_encode($coordenadas);
$file = 'coordenadas.json';
file_put_contents($file, $json_string);
//GUARDAR EN BASE DE DATOS LO OBTENIDO

$usuario = "root";
$contrasena = "Admin123+";  // en mi caso tengo contraseña pero en casa caso introducidla aquí.
$servidor = "35.237.166.125";
$basededatos = "localizadordb";

$conexion = mysqli_connect($servidor,$usuario,$contrasena)or die("No se pudo conectar:");
$db = mysqli_select_db($conexion,$basededatos) or die("No se pudo seleccionar la base de datos");

// Realizar una consulta MySQL
$query = "insert into entradas values($latitud,$longitud,$velocidad)";
$result = mysqli_query($conexion,$query) or die("Consulta fallida:" . mysqli_error($conexion) );

// Cerrar la conexión
mysqli_close($conexion);
?>