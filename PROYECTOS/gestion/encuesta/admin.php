<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mini-Administrador de encuesta</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"> </script>
<script type="text/javascript" src="../js/funciones_javascript.js"> </script>
<link rel="stylesheet" href="../css/principal.css">
</head>

<body>
<?php
	require('conexion.php');
	$continuar=false;
	
	if(isset($_POST['pregunta'])) $continuar=true;
	if(isset($_POST['opciones'])) $continuar=true;

	if($continuar==true){
		$pre=$_POST['pregunta'];
		$opc=$_POST['opciones'];
		$opciones = explode(",",$opc);
		
		//contamos cantidad de elementos
		//separados por coma
		$tot_elems=count($opciones);
		
		//iniciamos variables que usaremos
		$coma="";
		$i=0;
		$unidad="1";
		$respuesta="";
		
		//escribimos cadena del tipo "0,1,0,0,0"
		while($i<=$tot_elems-1){
			$respuesta=$respuesta.$coma.$unidad;
			$coma=",";
			$i++;
		}	
		//verificar si existe encuesta la actualizamos
		//sino la registramos
		$cons_cant=mysql_query("SELECT COUNT(*) AS nroenc FROM encuesta",$con);
		$cant=mysql_fetch_array($cons_cant);
		if($cant['nroenc']==0){
			$insenc="INSERT INTO encuesta(pregunta, opciones, respuestas) VALUES ('$pre','$opc','$respuesta')";
			$insencresult = mysql_query($insenc, $con);
			echo "<div id=\"agregado\">Agregado <a href=\"./\">Ver encuesta</a></div>";
		}else{
			$cons_id=mysql_query("SELECT idenc FROM encuesta",$con);
			$idenc=mysql_fetch_array($cons_id);
			$id=trim($idenc['idenc']);
			
			$updenc="UPDATE encuesta SET pregunta='$pre', opciones='$opc', respuestas='$respuesta', nrovotos=0 WHERE idenc=$id";
			$updencresult = mysql_query($updenc, $con);
			echo "<div id=\"modificado\">Modificado <a href=\"./\">Ver encuesta</a></div>";
		}
	}
?>
<h3>Mini-Administrador de encuesta</h3>
<form name="frmEncuesta" method="post" action="admin.php">
  <p>Escriba la pregunta</p>
  <p>
    <input name="pregunta" type="text" id="pregunta" />
  </p>
  <p>Escriba las opciones separandolas por comas. Ej. Ubuntu, Red Hat, Suse, Debian</p>
  <p>
    <input name="opciones" type="text" id="opciones" />
  </p>
  <p>
    <input id="botosito"type="submit" name="Submit" value="Crear Encuesta" />
  </p>
</form>
</body>
</html>
