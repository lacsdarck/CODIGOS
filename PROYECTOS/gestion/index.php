<?php

/*echo "hola ".$_GET['nombre']."!";*/

$tipo=$_GET['tipo'];

if($tipo=='nombre'){
	echo "me llamo:".$_GET['nombre'];

}else if($tipo=='producto'){

echo 'id: '.$_GET['id_producto'].'--tituloo:'.$_GET['titulo'];

}

?>