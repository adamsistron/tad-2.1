<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo base_url('css/responsivemobilemenu.css');?>" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/responsivemobilemenu.js');?>"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
</head>
<body>
        <div class="rmm">
            <ul>
                <li><a href='<?php echo base_url('/inicio');?>'>INICIO</a></li>
                <li><a href='<?php echo base_url('scli/scli_1');?>'>Despachos</a></li>
                <li><a href='<?php echo base_url('sesion/logout');?>'>SALIR(<?php echo $this->session->userdata('indicador_usuario');?>)</a></li>
            </ul>
        </div>
</body>
</html>
