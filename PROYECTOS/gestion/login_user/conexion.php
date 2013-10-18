<?php
$bd_host = "127.0.0.1"; 
$bd_usuario = "root"; 
$bd_password = "root"; 
$bd_base = "prueba"; 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 
?>