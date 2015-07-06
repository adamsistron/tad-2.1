<!-- Latest compiled and minified CSS -->
<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"-->

<!-- Optional theme -->
<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"-->

<!-- Latest compiled and minified JavaScript -->
<!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script-->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TAD | Técnicas de Análisis de Datos</title>

    <!-- Bootstrap -->
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <?php
    if(!isset($view_name)) {
        $jquery = base_url('js/jquery.min_1.js');
    echo "<script src='".$jquery."'></script>";
        }
        ?>
  </head>
  <body>
      <nav class="navbar navbar-default">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">-</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('')?>">
                <img style="width: 55%; margin: 0"alt="Brand" src="<?php echo base_url('images/pdvsa.ico');?>"></a>
          </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
<!--        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
        <li id="scli"><a href="<?php echo site_url('scli/scli_1')?>">SCLi</a></li>
        <li id="scli"><a href="<?php echo site_url('sisccombf/eess')?>">SISCCOMBF</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SIEV<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li id="casos"><a href="<?php echo site_url('casos/casos_1')?>">Investigaciones (Casos)</a></li>
            <li class="divider"></li>
            <li id="verificaciones"><a href="<?php echo site_url('verificaciones/verificaciones_1')?>">Verificaciones (P. Júridicas)</a></li>
            <li id="casos"><a href="<?php echo site_url('verificaciones/verificaciones_4')?>">Cambios de Clasificación</a></li>
            <li id="casos"><a href="<?php echo site_url('noapto/noaptos')?>">No Aptos</a></li>
            
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SSPO<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li id="pv"><a href="<?php echo site_url('casos/casos_1')?>">Prevención (PV)</a></li>
            <li id="pi"><a href="<?php echo site_url('verificaciones/verificaciones_1')?>">Protección Industrial (PI)</a></li>
            <li id="sti"><a href="<?php echo site_url('verificaciones/verificaciones_4')?>">Seguridad en Tecnologías de Información (STI)</a></li>
    
            
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SERPCP<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li id="evento1"><a href="<?php echo site_url('serpcp/eventos_1')?>">Eventos por N/F/R</a></li>
            <li id="evento3"><a href="<?php echo site_url('serpcp/eventos_3')?>">Eventos no deseados</a></li>
    
            
          </ul>
        </li>
        <!--<li id="usuarios"><a href="<?php echo site_url('#')?>">Usuarios</a></li>-->
        <!--<li id="serpcp"><a href="<?php echo site_url('serpcp/eventos_1')?>">SERPCP</a></li>-->
      </ul>
        <ul class="nav navbar-nav navbar-right ">
            <li><button onclick="logout()" type="button" class="btn btn-danger navbar-btn">Salir(<?php echo $this->session->userdata('indicador_usuario');?>)</button></li>
      </ul>
    </div><!-- /.navbar-collapse -->
           </nav>

      <div class="container-fluid" style="height: complex">
        <?php 
        if(isset($view_name)) {
        $this->load->view($view_name);
        }?>
        
      </div>

    </div><!-- /.container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="<?php //echo base_url("js/jquery.min.js");?>"></script>-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script-->
    <link href="<?php echo base_url("css/bootstrap.min.css");?>" rel="stylesheet">
    <script src="<?php echo base_url("js/bootstrap.min.js");?>"></script>
    
    
    
    <script>
        <?php if(isset($menu)) {
            echo "$('#$menu').addClass('active')";
        }?>
        
        function logout(){
        window.location.href = "<?php echo base_url('sesion/logout');?>";
    }
        </script>
  </body>
</html>
