<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">





	<title><?php echo "Persona: ".$cedula?></title>
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
    echo "<font size=5><B><u>Verificaciones de la Persona con Cédula:</u> ".$cedula."</b></font> ";
    if( $datos_persona[0]['per_ci']<>""){
   echo "<h2><B>Datos Persona: </b></h2> ";
                           $persona="";
                           $i=1;
                           if(count($datos_persona)>1){
                                foreach($datos_persona as $dato){
                                $persona.="<div style='text-align:justify'><th><B>Persona:".$i."</b></th> <BR>
                                    <th><B>Primer Nombre: </b></th>".$dato['per_primer_nombre']." <BR>
                                    <th><B>Segundo Nombre: </b></th>".$dato['per_segundo_nombre']." <BR>
                                    <th><B>Primer Apellido: </b></th>".$dato['per_primer_apellido']." <BR>
                                    <th><B>Segundo Apellido: </b></th>".$dato['per_segundo_apellido']." <BR>
                                    <th><B>Cédula: </b></th>".$dato['per_ci']." <BR> 
                                    <th><B>Tipo Documento: </b></th>".$dato['per_tipo_doc']." <BR>                                        
                                    <th><B>Nacionalidad: </b></th>".$dato['per_nacionalidad']." <BR>                                        
                                    <th><B>Sexo: </b></th>".$dato['per_sexo']." <BR>
                                    <th><B>Fecha Nacimiento: </b></th>".$dato['per_fch_nac']."<BR>
                                    <th><B>Lugar Nacimiento: </b></th>".$dato['per_lugar_nac']." <BR>
                                    <th><B>Estado Nacimiento: </b></th>".$dato['per_estado_nac']." <BR><BR></div>"; 
                                $i++;
                                }
                           }else{                           
                            foreach($datos_persona as $dato){
                                $persona.="<div style='text-align:justify'>
                                    <th><B>Primer Nombre: </b></th>".$dato['per_primer_nombre']." <BR>
                                    <th><B>Segundo Nombre: </b></th>".$dato['per_segundo_nombre']." <BR>
                                    <th><B>Primer Apellido: </b></th>".$dato['per_primer_apellido']." <BR>
                                    <th><B>Segundo Apellido: </b></th>".$dato['per_segundo_apellido']." <BR>
                                    <th><B>Cédula: </b></th>".$dato['per_ci']." <BR> 
                                    <th><B>Tipo Documento: </b></th>".$dato['per_tipo_doc']." <BR>                                        
                                    <th><B>Nacionalidad: </b></th>".$dato['per_nacionalidad']." <BR>                                        
                                    <th><B>Sexo: </b></th>".$dato['per_sexo']." <BR>
                                    <th><B>Fecha Nacimiento: </b></th>".$dato['per_fch_nac']."<BR>
                                    <th><B>Lugar Nacimiento: </b></th>".$dato['per_lugar_nac']." <BR>
                                    <th><B>Estado Nacimiento: </b></th>".$dato['per_estado_nac']." <BR></div>";

                            }
                            }
                            echo $persona;
    }?>
</tbody>
<tbody>
    
    <?php 
    if( $datos_localidad[0]['desc_filial']<>""){
   echo "<h2><B>Organización: </b></h2>";
                           $localidad="";
                           $i=1;
                           if(count($datos_localidad)>1){
                                foreach($datos_localidad as $dato){
                                $localidad.="<div style='text-align:justify'><th><B>Organización:".$i."</b></th> <BR>
                                    <th><B>Organización: </b></th>".$dato['desc_filial']." <BR>
                                    <th><B>Región: </b></th>".$dato['desc_region']." <BR>
                                    <th><B>Distrito: </b></th>".$dato['desc_distrito']." <BR>
                                    <th><B>Localidad: </b></th>".$dato['desc_area_loc']." <BR><BR></div>";
                                $i++;
                                }
                           }else{
                                foreach($datos_localidad as $dato){
                                    $localidad.="<div style='text-align:justify'><th><B>Organización: </b></th>".$dato['desc_filial']." <BR>
                                        <th><B>Región: </b></th>".$dato['desc_region']." <BR>
                                        <th><B>Distrito: </b></th>".$dato['desc_distrito']." <BR>
                                        <th><B>Localidad: </b></th>".$dato['desc_area_loc']." <BR></div>";

                                }
                            }
                            echo $localidad;
    }?>
</tbody>
<tbody>
    <?php 
    if( $datos_fecha_estado[0]['per_fch_estado_def']<>""){
   echo "<h2><B>Estado Definitivo: </b></h2>";
                 
                           $fecha_estado="";
                           $i=1;
                           if(count($datos_fecha_estado)>1){
                                foreach($datos_fecha_estado  as $dato){
                                $fecha_estado.="<div style='text-align:justify'><th><B>Estado Definitivo:".$i."</b></th> <BR>
                                    <th><B>Fecha Estado Definitivo: </b></th>".$dato['per_fch_estado_def']." <BR>
                                    <th><B>Comentario Estado Definitivo: </b></th>".$dato['per_coment_estado_def']." <BR>                                        
                                    <th><B>Fecha Estado Visita: </b></th>".$dato['per_fch_estado_visita']." <BR>                                        
                                    <th><B>Comentario Estado Visita: </b></th>".$dato['per_coment_visita']." <BR><BR></div>";
                                $i++;
                                }
                           }else{
                                foreach($datos_fecha_estado as $dato){
                                $fecha_estado.="<div style='text-align:justify'>
                                    <th><B>Fecha Estado Definitivo: </b></th>".$dato['per_fch_estado_def']." <BR>
                                    <th><B>Comentario Estado Definitivo: </b></th>".$dato['per_coment_estado_def']." <BR>                                        
                                    <th><B>Fecha Estado Visita: </b></th>".$dato['per_fch_estado_visita']." <BR>                                        
                                    <th><B>Comentario Estado Visita: </b></th>".$dato['per_coment_visita']." <BR></div>";                                    

                                }
                           }
                            echo $fecha_estado;
    }?>
</tbody>
<tbody>
    <?php 
    if( $datos_comentario[0]['per_coment_general']<>""){    
    echo "<h2><B>Comentario: </b></h2>";
            
                           $comentario="";
                           $i=1;
                           if(count($datos_comentario)>1){
                               foreach($datos_comentario as $dato){
                                $comentario.="<div style='text-align:justify'><th><B>Comentario:".$i."</b></th> <BR>
                                    <th><B>Comentario General: </b></th>".$dato['per_coment_general']." <BR>
                                    <th><B>Comentario Persona: </b></th>".$dato['per_comentario']." <BR><BR></div>";
                                $i++;
                               }
                           }else{
                            foreach($datos_comentario as $dato){
                                $comentario.="<div style='text-align:justify'>
                                    <th><B>Comentario General: </b></th>".$dato['per_coment_general']." <BR>
                                    <th><B>Comentario Persona: </b></th>".$dato['per_comentario']." <BR></div>";

                            }
                           }
                            echo $comentario;
    }?>
</tbody>
<tbody>
    <?php //<h2><B>Investigación: <?php echo $codigo</b></h2> 

    //<div style="text-align:justify"></div>

 
    if( $datos_estado[0]['numero_verificacion']<>""){
   echo "<h2><B>Verificaciones: </b></h2>";
                           $estado="";
                           $i=1;
                           if(count($datos_estado)>1){
                                foreach($datos_estado as $dato){
                                $estado.="<div style='text-align:justify'><th><B>Verificación:".$i."</b></th> <BR>
                                    <th><B>Número Verificación: </b></th><font color='red'>".$dato['numero_verificacion']."</font> <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['fecha_creacion']." <BR>
                                    <th><B>Fecha Decisión: </b></th>".$dato['fecha_decision']." <BR>
                                    <th><B>Tipo Verificación: </b></th>".$dato['tipo_verificacion']." <BR>
                                    <th><B>Estado Verificación: </b></th><font color='red'>".$dato['estado_verificacion']."</font><BR>   
                                    <th><B>Fecha Estado Anterior: </b></th>".$dato['lpv_fch_edo_ant']." <BR>
                                    <th><B>Enviar Funte: </b></th>".$dato['lpv_enviar_fnte']." <BR>
                                    <th><B>Fecha Visita: </b></th>".$dato['lpv_fch_status_visita']." <BR>
                                    <th><B>Comentario General: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_estudio']." </P><BR>
                                    <th><B>Comentario Laboral: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_laboral']." </P><BR>
                                    <th><B>Comentario Seguridad: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_seguridad']." </P><BR>
                                    <th><B>Comentario Estado: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_estado']." </P><BR>
                                    <th><B>Comentario Visita: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_visita']." </P><BR>
                                    <th><B>Solicitud de Verificación:".$i." </b></th><BR>                                    
                                    <th><B>Edo Civil: </b></th>".$dato['pfper_edo_civil']." <BR>
                                    <th><B>Profesión: </b></th>".$dato['pfper_profesion']." <BR>
                                    <th><B>Deirección: </b></th>".$dato['pfper_direccion']." <BR>
                                    <th><B>Teléfono: </b></th>".$dato['pfper_tlf']." <BR>
                                    <th><B>Celular: </b></th>".$dato['pfper_cel']." <BR>
                                    <th><B>Gerencia: </b></th>".$dato['pfper_gerencia']." <BR> 
                                    <th><B>Nro Semana: </b></th>".$dato['osp_nro_semana']." <BR>
                                    <th><B>Nro Verificación</b></th>".$dato['osp_nro_verificacion']." <BR>
                                    <th><B>Año: </b></th>".$dato['osp_anio']." <BR>
                                    <th><B>Nombre Solicitante: </b></th>".$dato['osp_solicitante_nombre']." <BR>
                                    <th><B>Empresa Solicitante: </b></th>".$dato['osp_empresa_solicitante']." <BR>
                                    <th><B>Dirección Solicitante: </b></th>".$dato['osp_direccion_solicitante']." <BR>
                                    <th><B>Correo Solicitante: </b></th>".$dato['osp_correo_solicitante']." <BR>
                                    <th><B>Punto Focal: </b></th>".$dato['osp_pto_focal']." <BR>                                         
                                    <th><B>Gerencia Contratante: </b></th>".$dato['osp_gcia_contratante']." <BR>
                                    <BR></div>";                                        
                                $i++;
                            }
                               
                           }else{                           
                            foreach($datos_estado as $dato){
                                $estado.="<div style='text-align:justify'><th><B>Número Verificación: </b></th><font color='red'>".$dato['numero_verificacion']." </font><BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['fecha_creacion']." <BR>
                                    <th><B>Fecha Decisión: </b></th>".$dato['fecha_decision']." <BR>
                                    <th><B>Tipo Verificación: </b></th>".$dato['tipo_verificacion']." <BR>
                                    <th><B>Estado Verificación: </b></th><font color='red'>".$dato['estado_verificacion']."</font><BR>
                                        
                                    <th><B>Fecha Estado Anterior: </b></th>".$dato['lpv_fch_edo_ant']." <BR>
                                    <th><B>Enviar Funte: </b></th>".$dato['lpv_enviar_fnte']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['lpv_fch_creacion']." <BR>
                                    <th><B>Fecha Visita: </b></th>".$dato['lpv_fch_status_visita']." <BR>
                                    <th><B>Fecha Decisión: </b></th>".$dato['lpv_fch_decision']." <BR>
                                    <th><B>Comentario General: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_estudio']." </P><BR>
                                    <th><B>Comentario Laboral: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_laboral']." </P><BR>
                                    <th><B>Comentario Seguridad: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_seguridad']." </P><BR>
                                    <th><B>Comentario Estado: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_estado']." </P><BR>
                                    <th><B>Comentario Visita: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_visita']." </P><BR>
                                    
                                    <th><B>Fecha Creación: </b></th>".$dato['pfper_fch_creacion']." <BR>
                                    <th><B>Edo Civil: </b></th>".$dato['pfper_edo_civil']." <BR>
                                    <th><B>Profesión: </b></th>".$dato['pfper_profesion']." <BR>
                                    <th><B>Deirección: </b></th>".$dato['pfper_direccion']." <BR>
                                    <th><B>Teléfono: </b></th>".$dato['pfper_tlf']." <BR>
                                    <th><B>Celular: </b></th>".$dato['pfper_cel']." <BR>
                                    <th><B>Gerencia: </b></th>".$dato['pfper_gerencia']." <BR> 
                                    <th><B>Fecha Creación: </b></th>".$dato['osp_fch_creacion']." <BR>
                                    <th><B>Nro Semana: </b></th>".$dato['osp_nro_semana']." <BR>
                                    <th><B>Nro Verificación</b></th>".$dato['osp_nro_verificacion']." <BR>
                                    <th><B>Año: </b></th>".$dato['osp_anio']." <BR>
                                    <th><B>Nombre Solicitante: </b></th>".$dato['osp_solicitante_nombre']." <BR>
                                    <th><B>Empresa Solicitante: </b></th>".$dato['osp_empresa_solicitante']." <BR>
                                    <th><B>Dirección Solicitante: </b></th>".$dato['osp_direccion_solicitante']." <BR>
                                    <th><B>Correo Solicitante: </b></th>".$dato['osp_correo_solicitante']." <BR>
                                    <th><B>Punto Focal: </b></th>".$dato['osp_pto_focal']." <BR>                                         
                                    <th><B>Gerencia Contratante: </b></th>".$dato['osp_gcia_contratante']." <BR>
                                    <BR></div>";

                            }
                           }
                            echo $estado;
    }?>
</tbody>


<tbody>
    
    <?php /* 
    if( $datos_verificacion[0]['lpv_fch_creacion']<>""){
   echo "<h2><B>Verificación: </b></h2>";
                           $verificacion="";
                           $i=1;
                           if(count($datos_verificacion)>1){
                             foreach($datos_verificacion as $dato){
                                $verificacion.="<div style='text-align:justify'><th><B>Verificación:".$i."</b></th> <BR>
                                    <th><B>Fecha Estado Anterior: </b></th>".$dato['lpv_fch_edo_ant']." <BR>
                                    <th><B>Enviar Funte: </b></th>".$dato['lpv_enviar_fnte']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['lpv_fch_creacion']." <BR>
                                    <th><B>Fecha Visita: </b></th>".$dato['lpv_fch_status_visita']." <BR>
                                    <th><B>Fecha Decisión: </b></th>".$dato['lpv_fch_decision']." <BR>
                                    <th><B>Comentario General: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_estudio']." </P><BR>
                                    <th><B>Comentario Laboral: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_laboral']." </P><BR>
                                    <th><B>Comentario Seguridad: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_seguridad']." </P><BR>
                                    <th><B>Comentario Estado: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_estado']." </P><BR>
                                    <th><B>Comentario Visita: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_visita']." </P><BR><BR></div>";
                                $i++;
                             }
                           }else{
                            foreach($datos_verificacion as $dato){
                                $verificacion.="<div style='text-align:justify'>
                                    <th><B>Fecha Estado Anterior: </b></th>".$dato['lpv_fch_edo_ant']." <BR>
                                    <th><B>Enviar Funte: </b></th>".$dato['lpv_enviar_fnte']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['lpv_fch_creacion']." <BR>
                                    <th><B>Fecha Visita: </b></th>".$dato['lpv_fch_status_visita']." <BR>
                                    <th><B>Fecha Decisión: </b></th>".$dato['lpv_fch_decision']." <BR>
                                    <th><B>Comentario General: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_estudio']." </P><BR>
                                    <th><B>Comentario Laboral: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_laboral']." </P><BR>
                                    <th><B>Comentario Seguridad: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_general_seguridad']." </P><BR>
                                    <th><B>Comentario Estado: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_estado']." </P><BR>
                                    <th><B>Comentario Visita: </b></th><P ALIGN='justify'>".$dato['lpv_comentario_visita']." </P><BR></div>";

                            }
                           }
                            echo $verificacion;
    }*/?>
</tbody>

<tbody>
    <?php /*
    if( $datos_solicitud[0]['osp_nro_verificacion']<>""){    
    echo "<h2><B>Solicitud: </b></h2>";
                           $solicitud="";
                           $i=1;
                           if(count($datos_solicitud)>1){
                            foreach($datos_solicitud as $dato){
                                $solicitud.="<div style='text-align:justify'><th><B>Solicitud: ".$i."</b></th> <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['pfper_fch_creacion']." <BR>
                                    <th><B>Edo Civil: </b></th>".$dato['pfper_edo_civil']." <BR>
                                    <th><B>Profesión: </b></th>".$dato['pfper_profesion']." <BR>
                                    <th><B>Deirección: </b></th>".$dato['pfper_direccion']." <BR>
                                    <th><B>Teléfono: </b></th>".$dato['pfper_tlf']." <BR>
                                    <th><B>Celular: </b></th>".$dato['pfper_cel']." <BR>
                                    <th><B>Gerencia: </b></th>".$dato['pfper_gerencia']." <BR> 
                                    <th><B>Fecha Creación: </b></th>".$dato['osp_fch_creacion']." <BR>
                                    <th><B>Nro Semana: </b></th>".$dato['osp_nro_semana']." <BR>
                                    <th><B>Nro Verificación</b></th>".$dato['osp_nro_verificacion']." <BR>
                                    <th><B>Año: </b></th>".$dato['osp_anio']." <BR>
                                    <th><B>Nombre Solicitante: </b></th>".$dato['osp_solicitante_nombre']." <BR>
                                    <th><B>Empresa Solicitante: </b></th>".$dato['osp_empresa_solicitante']." <BR>
                                    <th><B>Dirección Solicitante: </b></th>".$dato['osp_direccion_solicitante']." <BR>
                                    <th><B>Correo Solicitante: </b></th>".$dato['osp_correo_solicitante']." <BR>
                                    <th><B>Punto Focal: </b></th>".$dato['osp_pto_focal']." <BR>                                         
                                    <th><B>Gerencia Contratante: </b></th>".$dato['osp_gcia_contratante']." <BR><BR></div>";
                                $i++;
                            }
                           }else{
                                foreach($datos_solicitud as $dato){
                                $solicitud.="<div style='text-align:justify'>
                                    <th><B>Fecha Creación: </b></th>".$dato['pfper_fch_creacion']." <BR>
                                    <th><B>Edo Civil: </b></th>".$dato['pfper_edo_civil']." <BR>
                                    <th><B>Profesión: </b></th>".$dato['pfper_profesion']." <BR>
                                    <th><B>Deirección: </b></th>".$dato['pfper_direccion']." <BR>
                                    <th><B>Teléfono: </b></th>".$dato['pfper_tlf']." <BR>
                                    <th><B>Celular: </b></th>".$dato['pfper_cel']." <BR>
                                    <th><B>Gerencia: </b></th>".$dato['pfper_gerencia']." <BR> 
                                    <th><B>Fecha Creación: </b></th>".$dato['osp_fch_creacion']." <BR>
                                    <th><B>Nro Semana: </b></th>".$dato['osp_nro_semana']." <BR>
                                    <th><B>Nro Verificación</b></th>".$dato['osp_nro_verificacion']." <BR>
                                    <th><B>Año: </b></th>".$dato['osp_anio']." <BR>
                                    <th><B>Nombre Solicitante: </b></th>".$dato['osp_solicitante_nombre']." <BR>
                                    <th><B>Empresa Solicitante: </b></th>".$dato['osp_empresa_solicitante']." <BR>
                                    <th><B>Dirección Solicitante: </b></th>".$dato['osp_direccion_solicitante']." <BR>
                                    <th><B>Correo Solicitante: </b></th>".$dato['osp_correo_solicitante']." <BR>
                                    <th><B>Punto Focal: </b></th>".$dato['osp_pto_focal']." <BR>                                         
                                    <th><B>Gerencia Contratante: </b></th>".$dato['osp_gcia_contratante']." <BR></div>";
                           }
                           }
                            echo $solicitud;
    } */?>
</tbody>
<tbody>
    <?php 
    if( $datos_pista_seguridad[0]['perant_nro_expediente']<>""){    
    echo "<h2><B>Pista de Seguridad: </b></h2>";
                           $pista_seguridad="";
                           $i=1;                          
                           if(count($datos_pista_seguridad)>1){
                            foreach($datos_pista_seguridad as $dato){
                                $pista_seguridad.="<div style='text-align:justify'><th><B>Pista de Seguridad: ".$i."</b></th> <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['verperant_fch_creacion']." <BR>
                                    <th><B>Nro Expediente: </b></th>".$dato['perant_nro_expediente']." <BR>
                                    <th><B>Desviación: </b></th>".$dato['perant_desviacion']." <BR>
                                    <th><B>Lugar Apertura Expediente: </b></th>".$dato['perant_lugar_apertura_exp']." <BR> 
                                    <th><B>Acciones Tomadas: </b></th>".$dato['perant_acciones_tomadas']." <BR>
                                    <th><B>Historial Acción: </b></th>".$dato['perant_accion_historial']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['perant_fch_creacion']." <BR>
                                    <th><B>Fecha Actualización: </b></th>".$dato['perant_fch_actualizacion']." <BR> 
                                    <th><B>Nombre Apellidos: </b></th>".$dato['perant_nombre_apellidos']." <BR>
                                    <th><B>Región: </b></th>".$dato['perant_region']." <BR>
                                    <th><B>Fecha Delito: </b></th>".$dato['perant_fch_delito']." <BR>                                        
                                    <th><B>Comentario Notes: </b></th>".$dato['perant_comentario_notes']." <BR><BR></div>";
                                $i++;
                            }
                           }else{
                                foreach($datos_pista_seguridad as $dato){
                                $pista_seguridad.="<div style='text-align:justify'>
                                    <th><B>Fecha Creación: </b></th>".$dato['verperant_fch_creacion']." <BR>
                                    <th><B>Nro Expediente: </b></th>".$dato['perant_nro_expediente']." <BR>
                                    <th><B>Desviación: </b></th>".$dato['perant_desviacion']." <BR>
                                    <th><B>Lugar Apertura Expediente: </b></th>".$dato['perant_lugar_apertura_exp']." <BR> 
                                    <th><B>Acciones Tomadas: </b></th>".$dato['perant_acciones_tomadas']." <BR>
                                    <th><B>Historial Acción: </b></th>".$dato['perant_accion_historial']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['perant_fch_creacion']." <BR>
                                    <th><B>Fecha Actualización: </b></th>".$dato['perant_fch_actualizacion']." <BR> 
                                    <th><B>Nombre Apellidos: </b></th>".$dato['perant_nombre_apellidos']." <BR>
                                    <th><B>Región: </b></th>".$dato['perant_region']." <BR>
                                    <th><B>Fecha Delito: </b></th>".$dato['perant_fch_delito']." <BR>                                        
                                    <th><B>Comentario Notes: </b></th>".$dato['perant_comentario_notes']." <BR></div>";                               
                            }
                           }
                            echo $pista_seguridad;
    }?>
</tbody>

<tbody>
    <?php 
    if( $datos_pista_academica[0]['perest_titulo']<>""){    
    echo "<h2><B>Pista Académica: </b></h2>";
                           $pista_academica="";
                           $i = 1;
                            if(count($datos_pista_academica)>1){
                            foreach($datos_pista_academica as $dato){
                                $pista_academica.="<div style='text-align:justify'><th><B>Pista Académica: ".$i."</b></th><BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['verperest_fch_creacion']." <BR>
                                    <th><B>Comentario: </b></th>".$dato['verperest_comentario']." <BR>
                                    <th><B>Instituto Estudio: </b></th>".$dato['perest_instituto_estudio']." <BR>
                                    <th><B>Titulo: </b></th>".$dato['perest_titulo']." <BR>
                                    <th><B>Especialidad: </b></th>".$dato['perest_especialidad']." <BR>
                                    <th><B>Año: </b></th>".$dato['perest_anio']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['perest_fecha_creacion']." <BR>
                                    <th><B>Comentario: </b></th>".$dato['perest_comentario']." <BR>
                                    <th><B>Fecha Última Actualización: </b></th>".$dato['perest_fecha_ultima_actualizacion']." <BR>                                        
                                    <th><B>Observaciones Estudio: </b></th>".$dato['perest_observaciones_estudio']." <BR>                                        
                                    <th><B>Resultado Estudio: </b></th>".$dato['perest_resultado_estudio']." <BR><BR></div>"; 
                                $i++;
                            }
                                }else{  
                                    foreach($datos_pista_academica as $dato){
                                    $pista_academica.="<div style='text-align:justify'>
                                    <th><B>Fecha Creación: </b></th>".$dato['verperest_fch_creacion']." <BR>
                                    <th><B>Comentario: </b></th>".$dato['verperest_comentario']." <BR>
                                    <th><B>Instituto Estudio: </b></th>".$dato['perest_instituto_estudio']." <BR>
                                    <th><B>Titulo: </b></th>".$dato['perest_titulo']." <BR>
                                    <th><B>Especialidad: </b></th>".$dato['perest_especialidad']." <BR>
                                    <th><B>Año: </b></th>".$dato['perest_anio']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['perest_fecha_creacion']." <BR>
                                    <th><B>Comentario: </b></th>".$dato['perest_comentario']." <BR>
                                    <th><B>Fecha Última Actualización: </b></th>".$dato['perest_fecha_ultima_actualizacion']." <BR>                                        
                                    <th><B>Observaciones Estudio: </b></th>".$dato['perest_observaciones_estudio']." <BR>                                        
                                    <th><B>Resultado Estudio: </b></th>".$dato['perest_resultado_estudio']." <BR></div>"; 
                                    }
                                    }                                                                                                   

                            
                            echo $pista_academica;
    }?>
</tbody>
<tbody>
    
    <?php 
    if( $datos_pista_laboral[0]['verperexp_fch_creacion']<>""){    
    echo "<h2><B>Pista Laboral: </b></h2>";
                           $pista_laboral="";$i = 1;
                           if(count($datos_pista_laboral)>1){
                            foreach($datos_pista_laboral as $dato){
                                $pista_laboral.="<div style='text-align:justify'><th><B>Pista Laboral: ".$i."</b></th><BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['verperexp_fch_creacion']." <BR>
                                    <th><B>Comentario: </b></th>".$dato['verperexp_comentario']." <BR>
                                    <th><B>Cargo: </b></th>".$dato['perexp_cargo']." <BR>
                                    <th><B>Mes/Año Inicio: </b></th>".$dato['perexp_mes_anio_in']." <BR>
                                    <th><B>Mes/Año Fin: </b></th>".$dato['perexp_mes_anio_fin']." <BR>
                                    <th><B>Teléfono: </b></th>".$dato['perexp_tlf']." <BR>
                                    <th><B>Correo Electrónico: </b></th>".$dato['perexp_e_mail']." <BR>
                                    <th><B>Dirección Web: </b></th>".$dato['perexp_direccion_web']." <BR>
                                    <th><B>Ubicación: </b></th>".$dato['perexp_ubicacion']." <BR>
                                    <th><B>empresas: </b></th>".$dato['perexp_empresas']." <BR> 
                                    <th><B>Motivo Retiro: </b></th>".$dato['perexp_motivo_retiro']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['perexp_fecha_creacion']." <BR>
                                    <th><B>Fecha Actualización: </b></th>".$dato['perexp_fecha_actualizacion']." <BR>
                                    <th><B>Comentario: </b></th>".$dato['perexp_comentario']." <BR>                                        
                                    <th><B>Observaciones Laborales: </b></th>".$dato['perexp_observaciones_laboral']." <BR><BR></div>";
                                    $i++;
                            }
                           }else{
                                foreach($datos_pista_laboral as $dato){
                                $pista_laboral.="<div style='text-align:justify'>
                                    <th><B>Fecha Creación: </b></th>".$dato['verperexp_fch_creacion']." <BR>
                                    <th><B>Comentario: </b></th>".$dato['verperexp_comentario']." <BR>
                                    <th><B>Cargo: </b></th>".$dato['perexp_cargo']." <BR>
                                    <th><B>Mes/Año Inicio: </b></th>".$dato['perexp_mes_anio_in']." <BR>
                                    <th><B>Mes/Año Fin: </b></th>".$dato['perexp_mes_anio_fin']." <BR>
                                    <th><B>Teléfono: </b></th>".$dato['perexp_tlf']." <BR>
                                    <th><B>Correo Electrónico: </b></th>".$dato['perexp_e_mail']." <BR>
                                    <th><B>Dirección Web: </b></th>".$dato['perexp_direccion_web']." <BR>
                                    <th><B>Ubicación: </b></th>".$dato['perexp_ubicacion']." <BR>
                                    <th><B>empresas: </b></th>".$dato['perexp_empresas']." <BR> 
                                    <th><B>Motivo Retiro: </b></th>".$dato['perexp_motivo_retiro']." <BR>
                                    <th><B>Fecha Creación: </b></th>".$dato['perexp_fecha_creacion']." <BR>
                                    <th><B>Fecha Actualización: </b></th>".$dato['perexp_fecha_actualizacion']." <BR>
                                    <th><B>Comentario: </b></th>".$dato['perexp_comentario']." <BR>                                        
                                    <th><B>Observaciones Laborales: </b></th>".$dato['perexp_observaciones_laboral']." <BR></div>";                                    
                            }   
                           }
                            echo $pista_laboral;
    }?>
    <BR><BR><BR>
</tbody>
</div>

</body>
</html>