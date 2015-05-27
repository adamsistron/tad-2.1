<?php //echo "xxxxx";?>
<!DOCTYPE html>

<head>

	<!-- Basics -->
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Inicio Sesi&oacute;n - TAD</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('css/animate.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('css/styles.css');?>">
	
</head>

	<!-- Main HTML -->
	
<body>
    <div style="width: 60%; margin: 0 auto"><center><img src="<?php echo base_url('images/pdvsa.ico');?>" style="margin-top: 2em;" alt="Smiley face" height="42" width="42"> <br>Inicio de Sesi&oacute;n </center></div>
	<!-- Begin Page Content -->
	
	<div id="container">
            
		<form class="" accept-charset="utf-8" method="post" action="<?php echo base_url('sesion/login')?>">
		
		<label for="name">Indicador:</label>
		
		<input type="name" name="indicador">
		
                <label for="username">Contrase&ntilde;a:</label>
		
				
		<input type="password" name="password">
		
		<div id="lower">
		
		<!--input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label-->
		
		<input type="submit" value="Entrar">
		
		</div>
		
		</form>
		
	</div>
	
	
	<!-- End Page Content -->
	
</body>

</html>
	
	
	
	
	
		
	

