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
						<th>Cédula</th>
						<th>Nombre Apellido</th>
						<th><?php echo $complemento1;?></th>
						<th><?php echo $complemento2;?></th>
						<th>Ubicación</th>
						
					</tr>
				</thead>
                               

<tbody>
                 <?php
                           
                            $i=0;
                            $fila="";
                            $base_url ="";
                            foreach($datos as $dato){
                                $i++;
                                $base_url = base_url('verificaciones/verificaciones_11/'.$dato['a']);
                                $fila.="
                                <tr>
                                    <td><a target='_blank' href=$base_url>".$dato['a']."</a></td>
                                    <td>".$dato['b']."</td>
                                    <td>".$dato['c']."</td>
                                    <td>".$dato['d']."</td>
                                    <td>".$dato['f']."</td>
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