<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de encuesta</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"> </script>
<script type="text/javascript" src="../js/funciones_javascript.js"> </script>
<link rel="stylesheet" href="../css/principal.css">
</head>
<body>
<?php
require('conexion.php');
//consultamos si hay datos en la tabla
$cons_cant=mysql_query("SELECT COUNT(*) AS nroenc FROM encuesta",$con);
$cant=mysql_fetch_array($cons_cant);
if($cant['nroenc']==0){
	echo "<p>No hay encuesta</p>";
	echo "<p><a href=\"admin.php\">Agregar encuesta</p>";
}else{
	//consultamos la encuesta actual
	$cons_enc_act=mysql_query("SELECT * FROM encuesta",$con);
	$datos=mysql_fetch_array($cons_enc_act);
	//obtenemos los datos de la tabla
	$id=$datos['idenc'];
	$preg=$datos['pregunta'];
	$opc=$datos['opciones'];
	//empezamos a crear la estructura html
	echo "	
	<p><strong>".$preg."</strong></p>
	<div id=\"resultados\"> \n";
	//especificamos un formulario
	echo "	
	<form onsubmit=\"cargarResultados(); return false\" name=\"frmencuesta\" action=\"\">
	<input type=\"hidden\" name=\"cod\" value=\"".$id."\" /> \n";
	//especificamos opciones
	//NOTA, usamos explode para separar cada item por las comas
	$opciones = explode(",",$opc);
	$i=0;
	//contamos cuantas partes tiene opciones
	$tot_elems=count($opciones);
	while($i<=$tot_elems-1){
		$j=$i+1;
		//note que $opciones es un array y visualizamos sus elementos 
		//mediante esta forma: elemento=$opciones[ubicacion_integer]
		echo "	
		<p>
			<input type=\"radio\" name=\"opcion\" value=\"".$j."\" id=\"opcion".$j."\" /> ".trim($opciones[$i])."
		</p> \n";
		$i++;
	}
	echo "	
	<input type=\"hidden\" name=\"nroopciones\" value=\"".$i."\" />";
		 
	echo "	
	<p>
		<input class=\"boton\" type=\"submit\" value=\"Votar\" />
	</p>
	</form>
	</div> \n";
}
?>
</body>
</html>
