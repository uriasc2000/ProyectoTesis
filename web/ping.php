<?php
$ip = "http://www.forosdelweb.com";
$output = shell_exec("ping $ip");
 
if (strpos($output, "recibidos = 0")) {
    echo 'No Conectado';
} else {
    echo 'Conectado';
}