<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$inicioViaje = $_GET['inicio']; //Averiguar si inicia el viaje
$placa = $_GET['placabus']; //obtenemos la placa por URL
$latitud = $_GET['lati']; //obtenemos la latitud por URL
$longitud = $_GET['longi']; //obtenemos la longitud por URL
$velocidad = $_GET['veloci']; //obtenemos la longitud por URL
$longitud = $longitud * 10; //multiplico la longitud por 10

//INICIA EL VIAJE

//GUARDAR EN BASE DE DATOS LO OBTENIDO
$usuario = "root";
$contrasena = "Admin123+";  // en mi caso tengo contraseña pero en casa caso introducidla aquí.
$servidor = "35.237.166.125";
$basededatos = "localizadordb";
$id_viaje = -1;

if($inicioViaje==1){//Inicio del viaje
    $conexion = mysqli_connect($servidor,$usuario,$contrasena)or die("No se pudo conectar:");
    $db = mysqli_select_db($conexion,$basededatos) or die("No se pudo seleccionar la base de datos");
    // Realizar una consulta MySQL
    $query_c = "CALL ADD_NEW_VIAJE('$placa',@salida)";
    $query_r = "select @salida";
    $result = mysqli_query($conexion,$query_c) or die("Consulta fallida 1:" . mysqli_error($conexion) );
    $result_id = mysqli_query($conexion,$query_r) or die("Consulta fallida 2:" . mysqli_error($conexion) );
    $respuesta = mysqli_fetch_array($result_id);
    $id_viaje = $respuesta["@salida"];
    echo $id_viaje;
    mysqli_close($conexion);
}elseif($inicioViaje==0){//Continual el viaje
    $conexion = mysqli_connect($servidor,$usuario,$contrasena)or die("No se pudo conectar:");
    $db = mysqli_select_db($conexion,$basededatos) or die("No se pudo seleccionar la base de datos");
    // Realizar una consulta MySQL
    $query = "select viaje_actual from ACTUALES where placa = '$placa'";
    $result = mysqli_query($conexion,$query) or die("Consulta fallida 3:" . mysqli_error($conexion) );
    $respuesta = mysqli_fetch_array($result);
    //$json = json_encode($respuesta);
    $viaje_actual = $respuesta["viaje_actual"];
    //echo $viaje_actual;
    $queryi = "insert into PUNTO (latitud, longitud,velocidad,id_viaje) VALUES ($latitud,$longitud,$velocidad,$viaje_actual)";
    $resulti = mysqli_query($conexion,$queryi) or die("Consulta fallida 4:" . mysqli_error($conexion));
    mysqli_close($conexion);
}

?>