
<body id="ede"><?php
require('conexion.php');
//obtengo posicion de la opcion elegida
$id=$_POST['idenc'];
$vot=$_POST['alternativa'];
//consulto la encuesta enviada
$consulta=mysql_query("SELECT * FROM encuesta WHERE idenc=$id",$con);
$datos=mysql_fetch_array($consulta);
$opc=$datos['opciones'];
$resp=$datos['respuestas'];
//opciones aqui
//explode separa c/item por las comas
//aqui creamos automaticamente un array
//con los elementos separados por coma
$opciones = explode(",",$opc);
$rptas = explode(",",$resp);
$i=0;
//iniciamos variables de cadenas vacias
$respuesta_nueva="";
$alternativas="";
$coma="";
//contamos la cantidad de respuestas
$tot_elems=count($rptas);

while($i<=$tot_elems-1){
	$j=$i+1;
	//si la opcion elegida coincide con el elemento
	//sumamos 1 a la opcion
	if($j==$vot){
		$valor_respuesta=$rptas[$i]+1;	
	}else{
		$valor_respuesta=$rptas[$i];
	}
	//escribimos cadena del tipo "0 1 0 0"
	$respuesta_nueva=$respuesta_nueva.$coma.$valor_respuesta;
	$alternativas=$alternativas.$rptas[$i];
	$coma=",";
	$i++;
}

//actualizamos a nuevos valores de respuestas, y sumamos en una unidad el numero de votos
$updenc="UPDATE encuesta SET respuestas='$respuesta_nueva', nrovotos=nrovotos+1 WHERE idenc=$id";
$updencresult = mysql_query($updenc, $con);

//ahora listamos resultados
$consulta2=mysql_query("SELECT * FROM encuesta WHERE idenc=$id",$con);
$listado=mysql_fetch_array($consulta2);
$preg=$listado['pregunta'];
$opc=$listado['opciones'];
$resp=$listado['respuestas'];
$nrovot=$listado['nrovotos'];
$opciones = explode(",",$opc);
$rptas = explode(",",$resp);
$i=0;
$tot_elems=count($opciones);

while($i<=$tot_elems-1){
	echo "<p>";
	echo $opciones[$i];
	$ResulOpc = $rptas[$i]-1;
	//-1 por que empieza con 1 en los resultados 
	//esto por que si coloco 0 (ceros) no acepta
	//total de votos por cada opcion por el 100% y sobre el numero total de votos
	$ResulPorc=( $ResulOpc * 100 ) / $nrovot;
	echo "&nbsp;<strong>".round($ResulPorc,2)."%</strong>";
	echo "</p> \n";
	$i++;
}

echo "<p style=\"text-align:center;\">Total de votos: ".$nrovot."</p> \n";
echo "<p id=\"atras\"> <a href=\"admin.php\">volver atras</p>"
?>
