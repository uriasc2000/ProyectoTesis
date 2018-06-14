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
?>