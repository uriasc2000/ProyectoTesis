<?php
require("db_info.php");

$idviaje = $_GET['id_viaje']; //Averiguar si inicia el viaje

error_reporting(E_ALL);
ini_set('display_errors', '1');

function parseToXML($htmlStr)
{
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}

// Opens a connection to a MySQL server
$connection=mysqli_connect ($servidor, $usuario, $contrasena);
if (!$connection) {
  die('Not connected : ' . mysqli_error());
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connection,$basededatos);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($connection));
}

// Select all the rows in the markers table
//$query = "select * from markers where 1";
$query = "select id,concat(VELOCIDAD,' Km/h') as name,'' as address, latitud,longitud, 'B' as tipo from PUNTO where ID_VIAJE = $idviaje";
$result = mysqli_query($connection,$query);
//if (!$result) {
  //die('Invalid query: ' . mysqli_error());
//}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $row['id'] . '" ';
  echo 'name="' . parseToXML($row['name']) . '" ';
  echo 'address="' . parseToXML($row['address']) . '" ';
  echo 'latitud="' . $row['latitud'] . '" ';
  echo 'longitud="' . $row['longitud'] . '" ';
  echo 'tipo="' . $row['tipo'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';

?>