function nuevoAjax(){
	var xmlhttp=false;
	try{
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlhttp=false;
		}
	}
	
	if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
		xmlhttp = new XMLHttpRequest();
	}
	
	return xmlhttp;
}

function cargarResultados(){
	divResultado = document.getElementById('resultados');
	//obtengo el codigo de la encuesta
	codenc=document.frmencuesta.cod.value;
	//obtengo el numero de opciones
	nroopc=document.frmencuesta.nroopciones.value;
	//creo un bucle para ver si alguna opcion esta checked
	//si esta checked ese valor lo envio por post
	i=1;
	while(i<=nroopc){
		opcion=document.getElementById('opcion'+i).checked;
		if (opcion==true){
			alt=i;
		}
		i++;
	}
	ajax=nuevoAjax();
	ajax.open("POST", "resultados.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//envio dos valores el id de la encuesta y la opcion elegida de la encuesta
	ajax.send("idenc="+codenc+"&alternativa="+alt)
}