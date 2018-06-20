<?php
$ip = "http://soluciones5024.com";
$output = shell_exec("ping $ip");
 
if (strpos($output, "recibidos = 0")) {
    echo 'No Conectado';
} else {
    echo 'Conectado';
}