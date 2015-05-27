<!DOCTYPE html> 
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>Datos de Empresa <?php echo $datos_empresa[0]['rif'];?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('DataTables-1.10.4/media/css/jquery.dataTables.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('DataTables-1.10.4/examples/resources/syntax/shCore.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('DataTables-1.10.4/examples/resources/demo.css');?>">
	<style type="text/css" class="init">

	th, td { white-space: nowrap; }
	div.dataTables_wrapper {
		width: 90%;
		margin: 0 auto;
	}

	</style>
	</script>
</head>

<body class="dt-example">
    <div class="container">

                            
<!--                            [inv_codigo_investigacion] => PDV-CRP-2014-08-10
            [bien_afectado] => **NO INDICA**
            [inv_indicador_usuario] => VASQUEZAY
            [inv_cargo_usuario] => Analista de Asuntos Internos
            [inv_descripcion] => 
            [inv_fecha_creacion] => 2014-12-27-->
				<thead>

				</thead>
                               
<BR><BR>

<tbody>
    <?php 
    if( $datos_empresa[0]['rif']<>""){
                    
                           
                           //$i=1;
                          // if(count($datos_empresa)>1){
                                foreach($datos_empresa as $dato){
                                $empresa="";
                                echo "<h2><B>Datos del Perfil de la Empresa ".$dato['razon_social'].": </b></h2>";    
                                $empresa.="<div style='text-align:justify'><th></th> <BR>
                                    <th><B>RIF: </b></th>".$dato['rif']." <BR>
                                    <th><B>Registro Nacional de Contratiasta: </b></th>".$dato['reg_nacional_contratista']." <BR>
                                    <th><B>Observaciones: </b></th>".$dato['observaciones']." <BR>
                                    <th><B>Fecha &Uacute;ltima Verificaci&oacute;n: </b></th>".$dato['fch_ultima_verificacion']." <BR>
                                    <th><B>Direcci&oacute;n Fiscal: </b></th>".$dato['direccion_fiscal']." <BR>
                                    <th><B>Registro Mercantil: </b></th>".$dato['registro_mercantil']." <BR>
                                    <th><B>Raz&oacute;n Social: </b></th>".$dato['razon_social']." <BR>
                                    <th><B>Analista: </b></th>".$dato['id_analista_estado_def']." <BR>
                                    <th><B>Fecha Estado: </b></th>".$dato['fch_estado_def']." <BR>
                                    <th><B>Estado: </b></th>".$dato['desc_estado']." <BR>
                                    <th><B>Comentario Estado: </b></th>".$dato['comentario_estado']." <BR>
                                    </div>";
                                echo $empresa;
                                //$i++;
                                }
                           /*}else{
                                foreach($datos_empresa as $dato){
                                $empresa.="<div style='text-align:justify'><th><B>RIF: </b></th>".$dato['empresa_inv_rif']." <BR>
                                    <th><B>Razón Social: </b></th>".$dato['empresa_inv_razon_social']." <BR></div>";

                                }
                           }*/
                            
    }?>
<BR><BR><BR>
</tbody>
<tbody>
    <?php 
    if( $datos_empresa_verificacion[0]['rif']<>""){

                 
                           
                           //$i=1;
                          // if(count($datos_empresa)>1){
                                foreach($datos_empresa_verificacion as $dato){
                                    $empresa_verificacion="";
                                    echo "<h2><B>Datos de la Verificicaci&oacute;n con codigo ".$dato['nro_verificacion_emp']." </b></h2>";
                                    $empresa_verificacion.="<div style='text-align:justify'><th></th> <BR>
                                    <th><B>RIF: </b></th>".$dato['rif']." <BR>
                                    <th><B>Registro Nacional de Contratista: </b></th>".$dato['id']." <BR>
                                    <th><B>Numero de Verificaci&oacute;n: </b></th>".$dato['nro_verificacion_emp']." <BR>
                                    <th><B>Estado Actual: </b></th>".$dato['estado_actual']." <BR>                                        
                                    <th><B>Estado Anterior: </b></th>".$dato['estado_anterior']." <BR>    
                                    <th><B>N&uacute;mero de Orden: </b></th>".$dato['nro_orden_emp']." <BR>
                                    <th><B>Usuario Verificador: </b></th>".$dato['id_usuario']." <BR>
                                    <th><B>Gerencia que Solicita: </b></th>".$dato['origen_solicitud']." <BR>
                                    <th><B>Gerencia Contratante: </b></th>".$dato['gcia_contratante']." <BR>
                                    <th><B>Fecha de Creaci&oacute;n: </b></th>".$dato['fch_creacion']." <BR>
                                    <th><B>Comentario: </b></th>".$dato['comentario']." <BR>
                                    <th><B>Resultado de Inspecci&oacute;n: </b></th>".$dato['resultado_inspeccion']." <BR>
                                    <th><B>Fecha de decisi&oacute;n: </b></th>".$dato['fch_decision']." <BR>
                                    <th><B>Usuario Aprobador: </b></th>".$dato['id_aprobador']." <BR>
                                    <th><B>Comentario de Decision: </b></th>".$dato['comentario_decision']." <BR>
                                    <th><B>Usuario Supervisor: </b></th>".$dato['id_supervisor']." <BR>
                                    <th><B>Nombres y Apellidos: </b></th>".$dato['nombres_apellidos']." <BR>
                                    <th><B>Fecha Creaci&oacute;n: </b></th>".$dato['fecha_creacion']." <BR>
                                    <th><B>Nombres: </b></th>".$dato['primer_nombre']." ".$dato['segundo_nombre']." <BR>
                                    <th><B>Apellidos: </b></th>".$dato['primer_apellido']." ".$dato['segundo_apellido']." <BR>
                                    <th><B>Cedula: </b></th>".$dato['cedula']." <BR>
                                    <th><B>Localidad: </b></th>".$dato['lugar']." <BR>
                                    <th><B>Cargo del Gerente Aprobador: </b></th>".$dato['cargo_gerente']." <BR> 
                                    </div>";
                                //$i++;
                                    echo $empresa_verificacion;
                                }
                           /*}else{
                                foreach($datos_empresa as $dato){
                                $empresa.="<div style='text-align:justify'><th><B>RIF: </b></th>".$dato['empresa_inv_rif']." <BR>
                                    <th><B>Razón Social: </b></th>".$dato['empresa_inv_razon_social']." <BR></div>";

                                }
                           }*/
                            
    }?>
<BR><BR><BR>
</tbody>

</div>

</body>
</html>