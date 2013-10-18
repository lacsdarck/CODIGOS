// objeto para registro de boletines 
var obj_main = {
	
	status :  function () {	

		$.ajax({
				url : 'ajax/ajax_main.php?opcion=1' , 
				type : 'GET' , 
				cache : false , 
				success : function (response) {
					var json = $.parseJSON(response);
					
					$('.num_suscriptores').text(json.suscriptores);
					$('.num_boletines').text(json.boletines);
					$('.num_bloqueo').text(json.bloqueo);
				
				}
				
		});
	} , 
	
	guadar_config : function (form) {
		
		var acept_pass = true;
		if ($('#pass1').val() != "") {	
			
			if (!obj_main.validar_pass()) {
			
				alert('debe coincidir la contraseña en ambos campos');
				$('#pass1 ,#pass2').css('border-color','#900');
				
				acept_pass = false;
			}
		}
		
		if (acept_pass) {
			$.ajax({
				
				url : form.attr('action') , 
				type : 'POST' , 
				data : form.serialize() , 
				cache : false , 
				success : function (response) {
					
					
					 
					var json = $.parseJSON(response);
					alert(json.mensaje);
					
				}
				
			});
		
		}
	} , 
	
	
	validar_pass : function () {
				
		if ($('#pass1').val() == $('#pass2').val()) {
				
				return true;
						
			} else {
							
				return false;
		}
						

	} , 
	
	login : function (form) {
			$.ajax({
				
				url : form.attr('action') , 
				type : 'POST' , 
				data : form.serialize() , 
				cache : false , 
				beforeSend : function () {
					
					$('#mensaje').show('slow');
					$('#mensaje').text('conectando con el servidor');	
				
					
				} ,
				success : function (response) {
						
					console.log(response);
					var json = $.parseJSON(response);
					
					$('#mensaje').text(json.mensaje);	
				
						
						if(json.access) {
							location.href = json.url;
						} 
					
				}
				
			});
		
	}
	
};



