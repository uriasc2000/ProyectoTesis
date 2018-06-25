<?php
require("db_info.php");

$idviaje = $_GET['id_viaje']; //Averiguar si inicia el viaje

// Start XML file, create parent node
$doc = domxml_new_doc("1.0");
$node = $doc->create_element("markers");
$parnode = $doc->append_child($node);

// Opens a connection to a MySQL server
$connection=mysqli_connect ($servidor, $usuario, $contrasena);
if (!$connection) {
  die('Not connected : ' . mysqli_error($connection));
}

// Set the active MySQL database
$db_selected = mysqli_select_db($basededatos, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($connection));
}

// Select all the rows in the markers table
//$query = "SELECT * FROM markers WHERE 1";
$query = "SELECT id,concat(VELOCIDAD,' Km/h') AS name,'' AS address, latitud,longitud, 'B' AS tipo FROM PUNTO WHERE ID_VIAJE = $idviaje";
$result = mysqli_query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($connection));
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $doc->create_element("marker");
  $newnode = $parnode->append_child($node);

  $newnode->set_attribute("id", $row['id']);
  $newnode->set_attribute("name", $row['name']);
  $newnode->set_attribute("address", $row['address']);
  $newnode->set_attribute("latitud", $row['latitud']);
  $newnode->set_attribute("longitud", $row['longitud']);
  $newnode->set_attribute("tipo", $row['tipo']);
}

$xmlfile = $doc->dump_mem();
echo $xmlfile;

?>