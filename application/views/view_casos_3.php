<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('DataTables-1.10.4/media/css/jquery.dataTables.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('DataTables-1.10.4/examples/resources/syntax/shCore.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('DataTables-1.10.4/examples/resources/demo.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/dataTables.responsive.css');?>">
	<style type="text/css" class="init">

	div.container { max-width: 1200px }

	</style>
        
        <script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/media/js/jquery.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/media/js/jquery.dataTables.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/examples/resources/syntax/shCore.js');?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/examples/resources/demo.js');?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url('/js/dataTables.responsive.js');?>"></script>
        
	<script type="text/javascript" language="javascript" class="init">



$(document).ready(function() {
	$('#example').DataTable( {
		responsive: true,
                "scrollY": 240,
		"scrollX": true,
	} );
} );



	</script>
</head>

<body class="dt-example">
	<div class="container">
		<section>
			

			<table id="example" class="display nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Código</th>
						<th>Fecha</th>
						<th>Investigador</th>
						<th>Cargo</th>
						<th>Descripción</th>
						
					</tr>
				</thead>
                               

<tbody>
                 <?php
                           
                            $i=0;
                            $fila="";
                            $base_url ="";
                            foreach($datos as $dato){
                                $i++;
                                $base_url = base_url('casos/casos_4/'.$dato['inv_codigo_investigacion']);
                                $fila.="
                                <tr>
                                    <td><a target='_blank' href=$base_url>".$dato['inv_codigo_investigacion']."</a></td>
                                    <td>".$dato['inv_fecha_creacion']."</td>
                                    <td>".$dato['inv_indicador_usuario']."</td>
                                    <td>".ucwords(strtolower(str_replace(' DE ASUNTOS INTERNOS', '', $dato['inv_cargo_usuario'])))."</td>
                                    <td>".$dato['inv_descripcion']."</td>
                                </tr>";
                        
                        
                            }
                            echo $fila;
                            ?>
	
	</tbody>
			</table>


			
		</section>
	</div>
</body>
</html>