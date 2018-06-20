<?php

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
$link = mysql_connect('soluciones502.com', 'root', 'Admin123')or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('localizadordb') or die('No se pudo seleccionar la base de datos');

// Realizar una consulta MySQL
$query = 'insert into localizador.entradas values($latitud,$longitud,$velocidad)';
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($link);
?>