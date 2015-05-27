<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">





	<title><?php echo $codigo?></title>
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
    <?php //<h2><B>Investigación: <?php echo $codigo</b></h2> 

    //<div style="text-align:justify"></div>


    if( $datos_inv[0]['inv_codigo_investigacion']<>""){
   echo "<h2><B>Investigación: $codigo</b></h2>";
                           $inv="";
                           $i=1;
                           if(count($datos_inv)>1){
                                foreach($datos_inv as $dato){
                                $inv.="<div style='text-align:justify'><th><B>Investigación:".$i."</b></th> <BR>
                                    <th><B>Código Investigación: </b></th>".$dato['inv_codigo_investigacion']." <BR>
                                    <th><B>Fecha: </b></th>".$dato['inv_fecha_creacion']." <BR>
                                    <th><B>Indicador: </b></th>".$dato['inv_indicador_usuario']." <BR>
                                    <th><B>Cargo Usuario: </b></th>".$dato['inv_cargo_usuario']." <BR>
                                    <th><B>Descripción: </b></th>".$dato['inv_descripcion']."<BR>
                                    <th><B>Lugar: </b></th>".$dato['inv_lugar_suceso']." <BR>
                                    <th><B>Estatus investigación: </b></th>".$dato['inv_estatus']." <BR></div>";
                                $i++;
                            }
                               
                           }else{                           
                            foreach($datos_inv as $dato){
                                $inv.="<div style='text-align:justify'><th><B>Código Investigación: </b></th>".$dato['inv_codigo_investigacion']." <BR>
                                    <th><B>Fecha: </b></th>".$dato['inv_fecha_creacion']." <BR>
                                    <th><B>Indicador: </b></th>".$dato['inv_indicador_usuario']." <BR>
                                    <th><B>Cargo Usuario: </b></th>".$dato['inv_cargo_usuario']." <BR>
                                    <th><B>Descripción: </b></th>".$dato['inv_descripcion']."<BR>
                                    <th><B>Lugar: </b></th>".$dato['inv_lugar_suceso']." <BR>
                                    <th><B>Estatus investigación: </b></th>".$dato['inv_estatus']." <BR></div>";

                            }
                           }
                            echo $inv;
    }?>
</tbody>
<tbody>
    
    <?php 
    if( $datos_org[0]['org_filial']<>""){
   echo "<h2><B>Organización: </b></h2>";
                           $org="";
                           $i=1;
                           if(count($datos_org)>1){
                                foreach($datos_org as $dato){
                                $org.="<div style='text-align:justify'><th><B>Organización:".$i."</b></th> <BR>
                                    <th><B>Organización: </b></th>".$dato['org_filial']." <BR>
                                    <th><B>Región: </b></th>".$dato['org_region']." <BR>
                                    <th><B>Distrito: </b></th>".$dato['org_distrito']." <BR>
                                    <th><B>Localidad: </b></th>".$dato['org_area_localidad']." <BR></div>";
                                $i++;
                                }
                           }else{
                                foreach($datos_org as $dato){
                                    $org.="<div style='text-align:justify'><th><B>Organización: </b></th>".$dato['org_filial']." <BR>
                                        <th><B>Región: </b></th>".$dato['org_region']." <BR>
                                        <th><B>Distrito: </b></th>".$dato['org_distrito']." <BR>
                                        <th><B>Localidad: </b></th>".$dato['org_area_localidad']." <BR></div>";

                                }
                            }
                            echo $org;
    }?>
</tbody>
<tbody>
    <?php 
    if( $datos_bien_afectado[0]['bien_afectado_cantidad']<>""){
   echo "<h2><B>Bien Afectado: </b></h2> ";
                           $bien_afectado="";
                           $i=1;
                           if(count($datos_bien_afectado)>1){
                                foreach($datos_bien_afectado as $dato){
                                $bien_afectado.="<div style='text-align:justify'><th><B>Bien Afectado:".$i."</b></th> <BR>
                                    <th><B>Bien Afectado 1era Clase: </b></th>".$dato['bien_afectado_desc_1era_clase']." <BR>
                                    <th><B>Bien Afectado 2da Clase: </b></th>".$dato['bien_afectado_desc_2da_clase']." <BR>
                                    <th><B>Bien Afectado 3era Clase: </b></th>".$dato['bien_afectado_desc_3ra_clase']." <BR>
                                    <th><B>Nombre Propietario: </b></th>".$dato['bien_afectado_nombre_propietario']." <BR>
                                    <th><B>Descripción de Bienes: </b></th><P ALIGN='justify'>".$dato['bien_afectado_desc_bienes']." </P><BR>
                                    <th><B>Cantidad: </b></th>".$dato['bien_afectado_cantidad']." <BR>
                                    <th><B>Observaciones: </b></th>".$dato['bien_afectado_observaciones']." <BR>
                                    <th><B>Monto Total: </b></th>".$dato['bien_afectado_mnto_total']." <BR></div>"; 
                                $i++;
                                }
                           }else{                           
                            foreach($datos_bien_afectado as $dato){
                                $bien_afectado.="<div style='text-align:justify'><th><B>Bien Afectado 1era Clase: </b></th>".$dato['bien_afectado_desc_1era_clase']." <BR>
                                    <th><B>Bien Afectado 2da Clase: </b></th>".$dato['bien_afectado_desc_2da_clase']." <BR>
                                    <th><B>Bien Afectado 3era Clase: </b></th>".$dato['bien_afectado_desc_3ra_clase']." <BR>
                                    <th><B>Nombre Propietario: </b></th>".$dato['bien_afectado_nombre_propietario']." <BR>
                                    <th><B>Descripción de Bienes: </b></th><P ALIGN='justify'>".$dato['bien_afectado_desc_bienes']." </P><BR>
                                    <th><B>Cantidad: </b></th>".$dato['bien_afectado_cantidad']." <BR>
                                    <th><B>Observaciones: </b></th>".$dato['bien_afectado_observaciones']." <BR>
                                    <th><B>Monto Total: </b></th>".$dato['bien_afectado_mnto_total']." <BR></div>";

                            }
                            }
                            echo $bien_afectado;
    }?>
</tbody>
<tbody>
    
    <?php 
    if( $datos_persona[0]['persona_inv_primer_nombre']<>""){
   echo "<h2><B>Persona: </b></h2>";
                           $persona="";
                           $i=1;
                           if(count($datos_persona)>1){
                             foreach($datos_persona as $dato){
                                $persona.="<div style='text-align:justify'><th><B>Persona:".$i."</b></th> <BR>
                                    <th><B>CI: </b></th>".$dato['persona_inv_ci']." <BR>
                                    <th><B>Nombre: </b></th>".$dato['persona_inv_primer_nombre']." ".$dato['persona_inv_primer_apellido']." <BR></div>";
                                $i++;
                             }
                           }else{
                            foreach($datos_persona as $dato){
                                $persona.="<div style='text-align:justify'><th><B>CI: </b></th>".$dato['persona_inv_ci']." <BR>
                                    <th><B>Nombre: </b></th>".$dato['persona_inv_primer_nombre']." ".$dato['persona_inv_primer_apellido']." <BR></div>";

                            }
                           }
                            echo $persona;
    }?>
</tbody>
<tbody>
    <?php 
    if( $datos_empresa[0]['empresa_inv_rif']<>""){
   echo "<h2><B>Empresa: </b></h2>";
                 
                           $empresa="";
                           $i=1;
                           if(count($datos_empresa)>1){
                                foreach($datos_empresa as $dato){
                                $empresa.="<div style='text-align:justify'><th><B>Empresa:".$i."</b></th> <BR>
                                    <th><B>RIF: </b></th>".$dato['empresa_inv_rif']." <BR>
                                    <th><B>Razón Social: </b></th>".$dato['empresa_inv_razon_social']." <BR></div>";
                                $i++;
                                }
                           }else{
                                foreach($datos_empresa as $dato){
                                $empresa.="<div style='text-align:justify'><th><B>RIF: </b></th>".$dato['empresa_inv_rif']." <BR>
                                    <th><B>Razón Social: </b></th>".$dato['empresa_inv_razon_social']." <BR></div>";

                                }
                           }
                            echo $empresa;
    }?>
</tbody>
<tbody>
    <?php 
    if( $datos_resumen_ejecutivo[0]['resumen_ejecutivo_conclusiones']<>""){    
    echo "<h2><B>Resumen Ejecutivo: </b></h2>";
            
                           $resumen_ejecutivo="";
                           $i=1;
                           if(count($datos_resumen_ejecutivo)>1){
                               foreach($datos_resumen_ejecutivo as $dato){
                                $resumen_ejecutivo.="<div style='text-align:justify'><th><B>Resumen Ejecutivo:".$i."</b></th> <BR>
                                    <th><B>Recomendaciones: </b></th>".$dato['resumen_ejecutivo_recomendaciones']." <BR>
                                    <th><B>Conocimiento del Hecho: </b></th>".$dato['resumen_ejecutivo_conoc_hecho']." <BR>
                                    <th><B>Conclusiones: </b></th>".$dato['resumen_ejecutivo_conclusiones']." <BR>
                                    <th><B>Actividades Realizadas: </b></th>".$dato['resumen_ejecutivo_actividades_realizadas']." <BR>
                                    <th><B>Actividades Pendientes: </b></th>".$dato['resumen_ejecutivo_actividades_pendientes']." <BR></div>";
                                $i++;
                               }
                           }else{
                            foreach($datos_resumen_ejecutivo as $dato){
                                $resumen_ejecutivo.="<div style='text-align:justify'><th><B>Recomendaciones: </b></th>".$dato['resumen_ejecutivo_recomendaciones']." <BR>
                                    <th><B>Conocimiento del Hecho: </b></th>".$dato['resumen_ejecutivo_conoc_hecho']." <BR>
                                    <th><B>Conclusiones: </b></th>".$dato['resumen_ejecutivo_conclusiones']." <BR>
                                    <th><B>Actividades Realizadas: </b></th>".$dato['resumen_ejecutivo_actividades_realizadas']." <BR>
                                    <th><B>Actividades Pendientes: </b></th>".$dato['resumen_ejecutivo_actividades_pendientes']." <BR></div>";

                            }
                           }
                            echo $resumen_ejecutivo;
    }?>
</tbody>
<tbody>
    <?php 
    if( $datos_sumario[0]['sumario_conclucion_general']<>""){    
    echo "<h2><B>Sumario: </b></h2>";
                           $sumario="";
                           $i=1;
                           if(count($datos_sumario)>1){
                            foreach($datos_sumario as $dato){
                                $sumario.="<div style='text-align:justify'><th><B>Sumario: ".$i."</b></th> <BR>
                                    <th><B>Antecedente: </b></th>".$dato['sumario_antecedente_general']." <BR>
                                    <th><B>Conclusión: </b></th>".$dato['sumario_conclucion_general']." <BR>
                                    <th><B>Decisión: </b></th>".$dato['sumario_decision_general']." <BR></div>";
                                $i++;
                            }
                           }else{
                                foreach($datos_sumario as $dato){
                                $sumario.="<div style='text-align:justify'><th><B>Antecedente: </b></th>".$dato['sumario_antecedente_general']." <BR>
                                    <th><B>Conclusión: </b></th>".$dato['sumario_conclucion_general']." <BR>
                                    <th><B>Decisión: </b></th>".$dato['sumario_decision_general']." <BR></div>";
                           }
                           }
                            echo $sumario;
    } ?>
</tbody>
<tbody>
    <?php 
    if( $datos_iii[0]['iii_fecha_creacion']<>""){    
    echo "<h2><B>Informe Inicial de Investigación: </b></h2>";
                           $iii="";$i=1;
                          
                           if(count($datos_iii)>1){
                            foreach($datos_iii as $dato){
                                $iii.="<div style='text-align:justify'><th><B>Informe Inicial de Investigación: ".$i."</b></th> <BR>
                                    <th><B>Fecha: </b></th>".$dato['iii_fecha_creacion']." <BR>
                                    <th><B>Descripción Inicial: </b></th>".$dato['iii_desc_inf_inicial']." <BR></div>";
                                $i++;
                            }
                           }else{
                                foreach($datos_iii as $dato){
                                $iii.="<div style='text-align:justify'>
                                    <th><B>Fecha: </b></th>".$dato['iii_fecha_creacion']." <BR>
                                    <th><B>Descripción Inicial: </b></th>".$dato['iii_desc_inf_inicial']." <BR></div>";                                
                            }
                           }
                            echo $iii;
    }?>
</tbody>

<tbody>
    <?php 
    if( $datos_actuacion[0]['actuacion_fecha_creacion']<>""){    
    echo "<h2><B>Actuaciones: </b></h2>";
                           $actuacion="";
                           $i = 1;
                            if(count($datos_actuacion)>1){
                            foreach($datos_actuacion as $dato){
                                $actuacion.="<div style='text-align:justify'><th><B>Actuación: ".$i."</b></th><BR>
                                    <th><B>Fecha Informe: </b></th>".$dato['actuacion_fecha_informe']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['actuacion_fecha_creacion']." <BR>
                                    <th><B>Lugar Informe: </b></th>".$dato['actuacion_lugar_informe']." <BR>
                                    <th><B>Descripción Informe: </b></th>".$dato['actuacion_descripcion_informe']." <BR></div>"; 
                                $i++;
                            }
                                }else{  
                                    foreach($datos_actuacion as $dato){
                                    $actuacion.="<div style='text-align:justify'>
                                    <th><B>Fecha Informe: </b></th>".$dato['actuacion_fecha_informe']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['actuacion_fecha_creacion']." <BR>
                                    <th><B>Lugar Informe: </b></th>".$dato['actuacion_lugar_informe']." <BR>
                                    <th><B>Descripción Informe: </b></th>".$dato['actuacion_descripcion_informe']." <BR></div>";
                                    }
                                    }                                                                                                   

                            
                            echo $actuacion;
    }?>
</tbody>
<tbody>
    
    <?php 
    if( $datos_inspeccion[0]['inspeccion_fecha_inspeccion']<>""){    
    echo "<h2><B>Inspección: </b></h2>";
                           $inspeccion="";$i = 1;
                           if(count($datos_inspeccion)>1){
                            foreach($datos_inspeccion as $dato){
                                $inspeccion.="<div style='text-align:justify'><th><B>Inspección: ".$i."</b></th><BR>
                                    <th><B>Fecha Inspección: </b></th>".$dato['inspeccion_fecha_inspeccion']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['inspeccion_fecha_creacion']." <BR>
                                    <th><B>Lugar del Suceso: </b></th>".$dato['inspeccion_lugar_suceso']." <BR>
                                    <th><B>Dirección: </b></th>".$dato['inspeccion_direccion']." <BR>
                                    <th><B>Resultado: </b></th>".$dato['inspeccion_resultado']." <BR>                                        
                                    <th><B>Hora Suceso: </b></th>".$dato['inspeccion_hora_suceso']." <BR></div>";
                                    $i++;
                            }
                           }else{
                                foreach($datos_inspeccion as $dato){
                                $inspeccion.="<div style='text-align:justify'>
                                    <th><B>Fecha Inspección: </b></th>".$dato['inspeccion_fecha_inspeccion']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['inspeccion_fecha_creacion']." <BR>
                                    <th><B>Lugar del Suceso: </b></th>".$dato['inspeccion_lugar_suceso']." <BR>
                                    <th><B>Dirección: </b></th>".$dato['inspeccion_direccion']." <BR>
                                    <th><B>Resultado: </b></th>".$dato['inspeccion_resultado']." <BR>                                        
                                    <th><B>Hora Suceso: </b></th>".$dato['inspeccion_hora_suceso']." <BR></div>";                                    
                            }   
                           }
                            echo $inspeccion;
    }?>
    <BR><BR><BR>
</tbody>
</div>

</body>
</html>