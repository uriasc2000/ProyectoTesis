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
//CREAR CONEXION
//CREDENCIALES BASE DE DATOS
$HOST = "ec2-50-16-241-91.compute-1.amazonaws.com";
$DB = "d9760bupnbe5kt";
$USUARIO = "eubqinvrqabscc";
$PASSWORD = "e04c3d34b6d0be5c97027021c77cdfd81c62c89a123f40adba4f26c3a049f392";
$PORT = "5432";

$cadenaConexion = "host=$HOST port=$PORT dbname=$DB user=$USUARIO password=$PASSWORD";

$conexion = pg_connect($cadenaConexion) or die("ERROR DE CONEXION: ".pg_last_error());

$query = "insert into localizador.entradas values($latitud,$longitud,$velocidad)";

$resultado = pg_query($conexion,$query)or die("error en consulta SQL");

pg_clientencoding($conexion);
?>