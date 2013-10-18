<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>XROM-CLOUD</title>
<link href="../css/login.css" rel="stylesheet" type="text/css">
 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="../js/obj_main.js" type="text/javascript"></script>
<script type="text/javascript">

	$(function () {
		$('#mensaje').hide();	
		$('#frm_login').submit(function () {
			
				obj_main.login($(this));
				
				
				return false;
		});
		
	});

</script>
</head>

<body>


<div id="main">
	
    <div id="login">
    
    	<div class="panel">
    		
            
            <img src="img/gpa.jpg" style="float:left;" />
            <form id="frm_login" method="post" action="comprobar.php">
            
            <h1>BIENVENIDO AL SISTEMA DE ENCUESTAS</h1>
            <p id="mensaje"></p>
            	<table>
                	<tr>
                    	<td><input type="text" name="usuario" id="usuario" placeholder="usuario" required /></td>
                    </tr>
                    
                    <tr>
                    	<td><input type="password" name="password" id="password" placeholder="password" required /></td>
                    </tr>
                    
                </table>
                <input type="submit" value="Entrar al Sistema" />
                <input type="hidden" name="envio" value="TRUE" />
            </form>
        </div><!--panel-->
        
    </div><!--login-->
  
    <ul class="submenu">
    	<li><a href="#">Recuperar Password</a></li>
        <li><a href="#">Soporte Tecnico</a></li>
        <li><a href="#">Ayuda</a></li>
    </ul>
 
    
 </div><!--main-->  
  
<div id="footer"><p>Cras augue ipsum, pharetra in, scelerisque ac, mollis vel, metus. Nulla ullamcorper. Nam convallis lectus non quam. Praesent sit amet ante sed erat tempor consequat. Donec libero pede,</p></div>




</body>
</html>
