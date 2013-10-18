<?php 
session_start(); 
//datos para establecer la conexion con la base de mysql. 
include("conexion.php");
function quitar($mensaje) 
{ 
   $nopermitidos = array("",'\',"<','>',""); 
   $mensaje = str_replace($nopermitidos,"", $mensaje); 
   return $mensaje; 
} 
if (isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['envio'])  ) {	
   
        $usuario = $db->real_escape_string(trim($_POST['usuario']));
		
		$password = sha1($db->real_escape_string(trim($_POST['password'])));
		
				// buscar en base de datos ... 
				
				$q = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
				
					$result = $db->query($q);
					
				if ($result->num_rows == 1) {
					
					$perfil = $result->fetch_object();
					// sessiones de acceso ...  
					
					session_start();
					
					$_SESSION['id_usuario'] = $perfil->id_usuario;
					$_SESSION['usuario'] = $perfil->usuario;
					$_SESSION['nombre'] = $perfil->nombre;

					
					$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);//que es esto 

					// ---------------------------------------------------
					
					// configuracion de entrada ... 
					
					$q = "SELECT * FROM configuracion WHERE folio = '1'";
						
						$result = $db->query($q);
						$configuracion = $result->fetch_object();
						
						$_SESSION['ip'] = $configuracion->ip;
							
					
					// ---------------------------------------------------
					
						
						// grabar session ... 
						$ss = session_id();
						
						$q = "INSERT INTO online (session, id_usuario, fecha, ip) 
								VALUES ( '$ss' , '$perfil->id_usuario', NOW() , '$_SERVER[REMOTE_ADDR]');";
					
						
						$db->query($q);
					
					// ---------------------------------------------------
					
					$response = array (
				
						'access' => true ,
						'url' => '../encuesta/admin.php' , 
						'mensaje' => 'acceso correcto , entrando al sistema', 
					);
					
					
					// ---------------------------------------------------
					
				} else { // no se encontro el usuario 
					
				
					
					
					$response = array (
				
						'access' => false , 
						'url' => 'login.php', 
						'mensaje' => 'acceso denegado , intente nuevamente', 
					);
					
				
					
				}
			

$db->close();
echo json_encode($response);
				
}
?>