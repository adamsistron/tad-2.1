<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verificaciones extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
       function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
                $this->load->library(array('session','table'));
                //$this->load->model('consulta_despachos_model');
                //$this->load->database();
		$session_id = $this->session->userdata('indicador_usuario');
		//echo $session_id;die();
		if($session_id==""){
		redirect(base_url(''), 'refresh');
		}

	}
	
	public function index()
	{
        
             redirect(base_url('/verificaciones/verificaciones_1/'), 'refresh');
	}
        
        public function verificaciones_1()
	{
            
            $db=$this->load->database('siev',TRUE);
            
//            $query = $db->query("SELECT 
//  extract('year' FROM stagin_investigaciones_casos_abiertas_detalle.inv_fecha_creacion) AS anio, 
//  stagin_investigaciones_casos_abiertas_detalle.inv_estatus AS estatus,
//  COUNT(DISTINCT stagin_investigaciones_casos_abiertas_detalle.inv_codigo_investigacion) AS casos
//  
//FROM 
//  public.stagin_investigaciones_casos_abiertas_detalle
//GROUP BY 
//  extract('year' FROM stagin_investigaciones_casos_abiertas_detalle.inv_fecha_creacion), 
//  stagin_investigaciones_casos_abiertas_detalle.inv_estatus
//ORDER  BY anio ASC, estatus ASC
//");
       $query = $db->query("

  SELECT 
         substring (v_formato_resultado_verificacion_empresas.fch_decision from 7 for 4) as anio,
           estado.desc_estado as estatus,
           COUNT(DISTINCT v_formato_resultado_verificacion_empresas.nro_verificacion_emp) as condicion
        FROM 
          public.v_formato_resultado_verificacion_empresas, 
          public.estado
        WHERE 
          v_formato_resultado_verificacion_empresas.id_estado_actual = estado.id_estado 
          and  
          cast(substring (v_formato_resultado_verificacion_empresas.fch_decision from 7 for 4) as int)>='2010'
        group by  
            anio,
            estatus
        order by
        anio, estatus
        ");
          
             // $query = $db->query($sql);      
            //$abierto = array();
            //$cerrado = array();
            $abierto = '';
            $cerrado = '';
            $apto    = '';
            $no_apto = '';
            $suspendido = '';
            $anio_ant = "";
            $estatus_ant = "";

    foreach ($query->result_array() as $row)
    {
        
        if($row['anio']<>$anio_ant){
            $categorias[] = $row['anio'];
        }
        $anio_ant = $row['anio'];
        
        //echo $row['casos'];
        
//        if($row['estatus'] == 'ABIERTO'){
//            $abierto[] = $row['casos'];
//        }else{
//            $cerrado[] = $row['casos'];
//        }
       
        if($row['estatus'] == 'APTO'){
            $apto[] = $row['condicion'];
            }else{
                 if($row['estatus'] == 'NO APTO'){
                     $no_apto[] = $row['condicion'];
                 }else{
                     if($row['estatus'] == 'SUSPENDIDA'){
                     $suspendido[] = $row['condicion'];
                     }
                }
           // $cerrado[] = $row['casos'];
        }
        $estatus_ant = $row['estatus'];
        

    }
//            $anios = count($categorias);
//            $serie_data[] = array('name' => 'ABIERTO', 'data' => $abierto);
//            $serie_data[] = array('name' => 'CERRADO', 'data' => $cerrado);
            $anios = count($categorias);
            $serie_data[] = array('name' => 'APTO', 'data' => $apto);
            $serie_data[] = array('name' => 'NO APTO', 'data' => $no_apto);
            $serie_data[] = array('name' => 'SUSPENDIDA', 'data' => $suspendido);

            $query->free_result();
            $db->close();

        $this->view_data['anios'] = $anios;
        $this->view_data['caterorias'] = json_encode($categorias);
        $this->view_data['serie_data'] = json_encode($serie_data, JSON_NUMERIC_CHECK);
	//$this->load->view('view_verificaciones_1', $this->view_data);
        
        $this->view_data['view_name'] = "view_verificaciones_1";
        $this->view_data['menu'] = "verificaciones";
        $this->load->view('output', $this->view_data);
         
	}
       /* public function verificaciones_2($anio,$estatus)
	{
        
            $db=$this->load->database('siev',TRUE);

          
            $sql=" SELECT v_formato_resultado_verificacion_empresas.id_usuario, 
                    trim(v_formato_resultado_verificacion_empresas.razon_social) AS razon_social, 
                    count(distinct v_formato_resultado_verificacion_empresas.nro_verificacion_emp) as nro_verificacion_emp
                   FROM 
                    public.v_formato_resultado_verificacion_empresas, 
                    public.estado
                  WHERE 
                    v_formato_resultado_verificacion_empresas.id_estado_actual = estado.id_estado and substring (v_formato_resultado_verificacion_empresas.fch_decision from 7 for 4)='$anio' and 
                    estado.desc_estado='$estatus'group by id_usuario, razon_social
                   order by
                    v_formato_resultado_verificacion_empresas.id_usuario,    v_formato_resultado_verificacion_empresas.razon_social
                ";
             
//echo $sql;die();
            $query = $db->query($sql);

            $datos = "";
            $id_usuario='';
            $razon_social='';
            $nro_verificacion_emp='';
            foreach ($query->result_array() as $row)
            {        
                $nro_verificacion_emp = $row['nro_verificacion_emp'];
                $razon_social = $row['razon_social'];
                $id_usuario = $row['id_usuario'];
            }

            $cantidad = count($nro_verificacion_emp);
            $serie_data[] = array('name' => 'APTO', 'data' => $razon_social);
            $this->load->view('view_verificaciones_2');

	}*/
        
    public function verificaciones_2($org,$filial,$anio,$estatus){
            
        $db=$this->load->database('siev',TRUE);
        /*if ($estatus=='NO%20APTO'){
           $estatus='NO APTO'; 
        }*/
        $org = str_replace('%20', ' ', $org);
        $filial = str_replace('%20', ' ', $filial);
        $estatus = str_replace('%20', ' ', $estatus);
        $org=rawurldecode($org);
        $filial=rawurldecode($filial);
        
        $sql="SELECT v_formato_resultado_verificacion_empresas.id_usuario,                     
                    count(distinct v_formato_resultado_verificacion_empresas.nro_verificacion_emp) as nro_verificacion_emp
                   FROM 
                    public.v_formato_resultado_verificacion_empresas, 
                    public.estado,
                    public.organizacion,
                    public.orden_solicitud_empresa,
                    public.filial,
                    public.region
                  WHERE 
                    v_formato_resultado_verificacion_empresas.id_estado_actual = estado.id_estado and
                    substring (v_formato_resultado_verificacion_empresas.fch_decision from 7 for 4)='$anio' and 
                    estado.desc_estado='$estatus' and
                    orden_solicitud_empresa.nro_verificacion_emp = v_formato_resultado_verificacion_empresas.nro_verificacion_emp and
                    orden_solicitud_empresa.id_usuario=v_formato_resultado_verificacion_empresas.id_usuario and 
                    orden_solicitud_empresa.id_org_analista = organizacion.id_org and
                    organizacion.id_filial=filial.id_filial and
                    organizacion.id_region=region.id_region and
                    filial.desc_filial='$org' and
		    region.desc_region='$filial'
                    group by v_formato_resultado_verificacion_empresas.id_usuario
                   order by
                    v_formato_resultado_verificacion_empresas.id_usuario
                ";
        
        //echo $sql;die();
                   $query = $db->query("$sql");

    $i=0;
    $serie_data = "";
    foreach ($query->result_array() as $row)
    {
        
       $serie_data .= "['".$row['id_usuario']."',".$row['nro_verificacion_emp']."],\n";
       
        $i++;
    }
 
$query->free_result();
$db->close();
        $this->view_data['anio'] = $anio;
        $this->view_data['estatus'] = $estatus;
        $this->view_data['org'] = $org;
        $this->view_data['filial'] = $filial;
        $this->view_data['serie_data'] = $serie_data;
	//$this->load->view('view_verificaciones_2', $this->view_data);
        
        $this->view_data['view_name'] = "view_verificaciones_2";
        $this->view_data['menu'] = "verificaciones";
        $this->load->view('output', $this->view_data);

	}


        
        public function verificaciones_3(){
          
            
            //$filial=  strtoupper($this->input->post('filial'));
            
            $anio=  strtoupper($this->input->post('anio'));
            $estatus=  strtoupper($this->input->post('estatus'));
            $id_usuario=  strtoupper($this->input->post('id_usuario'));
            $db=$this->load->database('siev',TRUE);

            $sql = "SELECT 
  substring (v_formato_resultado_verificacion_empresas.fch_decision from 7 for 4) as anio,
  v_formato_resultado_verificacion_empresas.id_usuario, 
  trim(v_formato_resultado_verificacion_empresas.origen_solicitud) AS origen_solicitud,
  v_formato_resultado_verificacion_empresas.razon_social, 
  v_formato_resultado_verificacion_empresas.rif, 
  trim(v_formato_resultado_verificacion_empresas.comentario_decision) AS comentario_decision, 
  v_formato_resultado_verificacion_empresas.nro_verificacion_emp,  
  estado.desc_estado
FROM 
  public.v_formato_resultado_verificacion_empresas, 
  public.estado
WHERE 
  v_formato_resultado_verificacion_empresas.id_estado_actual = estado.id_estado and substring (v_formato_resultado_verificacion_empresas.fch_decision from 7 for 4)='$anio'
  AND
  estado.desc_estado='$estatus' AND v_formato_resultado_verificacion_empresas.id_usuario = '$id_usuario'
order by
v_formato_resultado_verificacion_empresas.razon_social";
            
            
            //echo $sql;die();
            $query = $db->query($sql);
            
            
            
            //print_r($q);die();
            $datos=array();
		foreach ($query->result_array() as $row){
			$datos[] = $row;

		}
$query->free_result();
$db->close();
                $this->view_data['datos'] = $datos;
                $this->load->view('view_verificaciones_3', $this->view_data);
        }
        
        public function casos_4($codigo){
            
            //echo "****************$codigo****************";
            $db=$this->load->database('siev',TRUE);
            $sql = "SELECT inv_id, inv_codigo_investigacion, inv_indicador_usuario, inv_cargo_usuario, 
            inv_lugar_suceso, inv_descripcion, inv_fecha_creacion, inv_estatus, 
            org_filial, org_region, org_distrito, org_area_localidad, bien_afectado_desc_1era_clase, 
            bien_afectado_desc_2da_clase, bien_afectado_desc_3ra_clase, bien_afectado_nombre_propietario, 
            bien_afectado_desc_bienes, bien_afectado_cantidad, bien_afectado_observaciones, 
            bien_afectado_mnto_total, persona_inv_ci, persona_inv_primer_nombre, 
            persona_inv_primer_apellido, empresa_inv_rif, empresa_inv_razon_social, 
            resumen_ejecutivo_recomendaciones, resumen_ejecutivo_conoc_hecho, 
            resumen_ejecutivo_conclusiones, resumen_ejecutivo_actividades_realizadas, 
            resumen_ejecutivo_actividades_pendientes, sumario_antecedente_general, 
            sumario_conclucion_general, sumario_decision_general, iii_fecha_creacion, 
            iii_desc_inf_inicial, actuacion_fecha_informe, actuacion_fecha_creacion, 
            actuacion_lugar_informe, actuacion_descripcion_informe, inspeccion_fecha_creacion, 
            inspeccion_fecha_inspeccion, inspeccion_lugar_suceso, inspeccion_direccion, 
            inspeccion_resultado, inspeccion_hora_suceso, id_desviacion
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY empresa_inv_rif, persona_inv_ci";
            
            //echo $sql;die();
            
                    $query = $db->query($sql);
            
                $datos=array();
		foreach ($query->result_array() as $row){
			$datos[] = $row;
                        

		}
                //$datos = array_unique($datos1, SORT_REGULAR);
                
                //print_r($unique);die();
                //print_r($datos);die();
                //echo count($datos);
                $file ="";
                $inv_codigo_investigacion_ant = "";
                $inv_indicador_usuario_ant = "";
                $inv_cargo_usuario_ant = "";
                $inv_lugar_suceso_ant = "";
                $inv_descripcion_ant = "";
                $inv_fecha_creacion_ant = "";
                $inv_estatus_ant = "";
                $org_filial_ant = "";
                $org_region_ant = "";
                $org_distrito_ant = "";
                $org_area_localidad_ant = "";
                $bien_afectado_desc_1era_clase_ant = "";
                $bien_afectado_desc_2da_clase_ant = "";
                $bien_afectado_desc_3ra_clase_ant = "";
                $bien_afectado_nombre_propietario_ant = "";
                $bien_afectado_desc_bienes_ant = "";
                $bien_afectado_cantidad_ant = "";
                $bien_afectado_observaciones_ant = "";
                $bien_afectado_mnto_total_ant = "";
                $persona_ant = "";
                $empresa_ant = "";
                $resumen_ejecutivo_recomendaciones_ant = "";
                $resumen_ejecutivo_conoc_hecho_ant = "";
                $resumen_ejecutivo_conclusiones_ant = "";
                $re_act_rea = "";
                $re_conclusiones = "";
                $resumen_ejecutivo_actividades_realizadas_ant = "";
                $re_conoc_hecho = "";
                $re_recomendaciones = "";
                $empresa_imp = "";
                $persona_imp = "";
                $persona_imp_ant = "";
                $sumario_antecedente_general_ant = "";
                $sumario_conclucion_general_ant = "";
                $sumario_decision_general_ant = "";
                $iii_fecha_creacion_ant = "";
                $iii_desc_inf_inicial_ant = "";
                $actuacion_fecha_informe_ant = "";
                $actuacion_fecha_creacion_ant = "";
                $actuacion_lugar_informe_ant = "";
                $actuacion_descripcion_informe_ant = "";
                $inspeccion_fecha_creacion_ant = "";
                $inspeccion_fecha_inspeccion_ant = "";
                $inspeccion_lugar_suceso_ant = "";
                $inspeccion_direccion_ant = "";
                $inspeccion_resultado_ant = "";
                $inspeccion_hora_suceso_ant = "";
                $id_desviacion_ant = "";
                
                
                
                
                echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
                echo "<title>$codigo</title>";
                
//                if($_POST){
//		  
//		  //echo "nuevo regiastro";
//		    $keys_post = array_keys($_POST);
//		    foreach ($keys_post as $trim_key_post){
//		      $key_post=trim($trim_key_post);
//		      $$key_post = $_POST[$key_post];
//		      $$key_post=str_replace("'","´",$$key_post);
//		      $$key_post=str_replace('"',"´",$$key_post);
//		      //echo $$key_post;die();
//		      error_log("variable $key_post viene desde $ _POST");
//		      //echo "TODAS LAS VARIABLES"."$key_post = {$$key_post} <br/>\n";
//		      if($$key_post<>""){
//		        //echo "Variable Llena: "."$key_post = {$$key_post} <br/>\n";
//		      }
//		      if($$key_post==""){
//		        //echo "Variable Vacia: "."$key_post = {$$key_post} <br/>\n";
//		      }
//		    }//echo "FIN\n\n";//die();
//		  }
                
                //die();
                for($i=0; $i<count($datos);$i++){
                    
                    
                    if($datos[$i]['inv_codigo_investigacion'] <> $inv_codigo_investigacion_ant){
                        echo $datos[$i]['inv_codigo_investigacion']."\n<br><br>";
                    }
                    $inv_codigo_investigacion_ant = $datos[$i]['inv_codigo_investigacion'];
                    
                    if($datos[$i]['inv_indicador_usuario'] <> $inv_indicador_usuario_ant){
                        echo $datos[$i]['inv_indicador_usuario']."\n<br><br>";
                    }
                    $inv_indicador_usuario_ant = $datos[$i]['inv_indicador_usuario'];
                    
                    if($datos[$i]['inv_cargo_usuario'] <> $inv_cargo_usuario_ant){
                        echo $datos[$i]['inv_cargo_usuario']."\n<br><br>";
                    }
                    $inv_cargo_usuario_ant = $datos[$i]['inv_cargo_usuario'];
                    
                    if($datos[$i]['inv_lugar_suceso'] <> $inv_lugar_suceso_ant){
                        echo $datos[$i]['inv_lugar_suceso']."\n<br><br>";
                    }
                    $inv_lugar_suceso_ant = $datos[$i]['inv_lugar_suceso'];
                    
                    if($datos[$i]['inv_descripcion'] <> $inv_descripcion_ant){
                        echo $datos[$i]['inv_descripcion']."\n<br><br>";
                    }
                    $inv_descripcion_ant = $datos[$i]['inv_descripcion'];
                    
                    if($datos[$i]['inv_fecha_creacion'] <> $inv_fecha_creacion_ant){
                        echo $datos[$i]['inv_fecha_creacion']."\n<br><br>";
                    }
                    $inv_fecha_creacion_ant = $datos[$i]['inv_fecha_creacion'];
                    
                    if($datos[$i]['inv_estatus'] <> $inv_estatus_ant){
                        echo $datos[$i]['inv_estatus']."\n<br><br>";
                    }
                    $inv_estatus_ant = $datos[$i]['inv_estatus'];                    
                    
                    if($datos[$i]['org_filial'] <> $org_filial_ant){
                        echo $datos[$i]['org_filial']."\n<br><br>";
                    }
                    $org_filial_ant = $datos[$i]['org_filial'];
                    
                    if($datos[$i]['org_region'] <> $org_region_ant){
                        echo $datos[$i]['org_region']."\n<br><br>";
                    }
                    $org_region_ant = $datos[$i]['org_region'];
                    
                    if($datos[$i]['org_distrito'] <> $org_distrito_ant){
                        echo $datos[$i]['org_distrito']."\n<br><br>";
                    }
                    $org_distrito_ant = $datos[$i]['org_distrito'];
                    
                    if($datos[$i]['org_area_localidad'] <> $org_area_localidad_ant){
                        echo $datos[$i]['org_area_localidad']."\n<br><br>";
                    }
                    $org_area_localidad_ant = $datos[$i]['org_area_localidad'];


                    if($datos[$i]['bien_afectado_desc_1era_clase'] <> $bien_afectado_desc_1era_clase_ant){
                        echo $datos[$i]['bien_afectado_desc_1era_clase']."\n<br><br>";
                    }
                    $bien_afectado_desc_1era_clase_ant = $datos[$i]['bien_afectado_desc_1era_clase'];

                    if($datos[$i]['bien_afectado_desc_2da_clase'] <> $bien_afectado_desc_2da_clase_ant){
                        echo $datos[$i]['bien_afectado_desc_2da_clase']."\n<br><br>";
                    }
                    $bien_afectado_desc_2da_clase_ant = $datos[$i]['bien_afectado_desc_2da_clase'];

                    if($datos[$i]['bien_afectado_desc_3ra_clase'] <> $bien_afectado_desc_3ra_clase_ant){
                        echo $datos[$i]['bien_afectado_desc_3ra_clase']."\n<br><br>";
                    }
                    $bien_afectado_desc_3ra_clase_ant = $datos[$i]['bien_afectado_desc_3ra_clase'];

                    if($datos[$i]['bien_afectado_nombre_propietario'] <> $bien_afectado_nombre_propietario_ant){
                        echo $datos[$i]['bien_afectado_nombre_propietario']."\n<br><br>";
                    }
                    $bien_afectado_nombre_propietario_ant = $datos[$i]['bien_afectado_nombre_propietario'];

                    if($datos[$i]['bien_afectado_desc_bienes'] <> $bien_afectado_desc_bienes_ant){
                        echo $datos[$i]['bien_afectado_desc_bienes']."\n<br><br>";
                    }
                    $bien_afectado_desc_bienes_ant = $datos[$i]['bien_afectado_desc_bienes'];

                    if($datos[$i]['bien_afectado_cantidad'] <> $bien_afectado_cantidad_ant){
                        echo $datos[$i]['bien_afectado_cantidad']."\n<br><br>";
                    }
                    $bien_afectado_cantidad_ant = $datos[$i]['bien_afectado_cantidad'];

                    if($datos[$i]['bien_afectado_observaciones'] <> $bien_afectado_observaciones_ant){
                        echo $datos[$i]['bien_afectado_observaciones']."\n<br><br>";
                    }
                    $bien_afectado_observaciones_ant = $datos[$i]['bien_afectado_observaciones'];

                    if($datos[$i]['bien_afectado_mnto_total'] <> $bien_afectado_mnto_total_ant){
                        echo $datos[$i]['bien_afectado_mnto_total']."\n<br><br>";
                    }
                    $bien_afectado_mnto_total_ant = $datos[$i]['bien_afectado_mnto_total'];
                    
                    
                    $empresa = $datos[$i]['empresa_inv_rif'].'-'.$datos[$i]['empresa_inv_razon_social'];
                    if($empresa <> $empresa_ant && $empresa<> "-"){
                        $empresa_imp .= $empresa."\n<br><br>";
                        //echo $empresa."\n<br><br>";
                    }
                    $empresa_ant = $empresa;

                    $persona = $datos[$i]['persona_inv_ci'].'-'.$datos[$i]['persona_inv_primer_nombre'].'-'.$datos[$i]['persona_inv_primer_apellido'];
                    if($persona <> $persona_ant && $persona<>"--" && $persona_imp<>$persona_imp_ant){
                        //$persona_imp .= $persona."\n<br>";
                        echo $persona."\n<br>";
                    }
                    $persona_ant = $persona;
                    
                    

                    if($datos[$i]['resumen_ejecutivo_recomendaciones'] <> $resumen_ejecutivo_recomendaciones_ant){
                        $re_recomendaciones .= "RE Recomendaciones:\n<br>".$datos[$i]['resumen_ejecutivo_recomendaciones']."\n<br><br>";
                    }
                    $resumen_ejecutivo_recomendaciones_ant = $datos[$i]['resumen_ejecutivo_recomendaciones'];

                    if($datos[$i]['resumen_ejecutivo_conoc_hecho'] <> $resumen_ejecutivo_conoc_hecho_ant){
                        $re_conoc_hecho .= "RE Cono Hecho:\n<br>".$datos[$i]['resumen_ejecutivo_conoc_hecho']."\n<br><br>";
                    }
                    $resumen_ejecutivo_conoc_hecho_ant = $datos[$i]['resumen_ejecutivo_conoc_hecho'];

                    if($datos[$i]['resumen_ejecutivo_conclusiones'] <> $resumen_ejecutivo_conclusiones_ant){
                        $re_conclusiones .= "RE Conclusiones:\n<br>".$datos[$i]['resumen_ejecutivo_conclusiones']."\n<br><br>";
                    }
                    $resumen_ejecutivo_conclusiones_ant = $datos[$i]['resumen_ejecutivo_conclusiones'];

                    if($datos[$i]['resumen_ejecutivo_actividades_realizadas'] <> $resumen_ejecutivo_actividades_realizadas_ant){
                        $re_act_rea = "RE Actividades Realizadas:\n<br>".$datos[$i]['resumen_ejecutivo_actividades_realizadas']."\n<br><br>";
                    }
                    $resumen_ejecutivo_actividades_realizadas_ant = $datos[$i]['resumen_ejecutivo_actividades_realizadas'];
                    
                    /*  
                $sumario_antecedente_general_ant = "";
                $sumario_conclucion_general_ant = "";
                $sumario_decision_general_ant = "";
                $iii_fecha_creacion_ant = "";
                $iii_desc_inf_inicial_ant = "";
                $actuacion_fecha_informe_ant = "";
                $actuacion_fecha_creacion_ant = "";
                $actuacion_lugar_informe_ant = "";
                $actuacion_descripcion_informe_ant = "";
                $inspeccion_fecha_creacion_ant = "";
                $inspeccion_fecha_inspeccion_ant = "";
                $inspeccion_lugar_suceso_ant = "";
                $inspeccion_direccion_ant = "";
                $inspeccion_resultado_ant = "";
                $inspeccion_hora_suceso_ant = "";
                $id_desviacion_ant = "";
                     * 
                sumario_antecedente_general, 
                sumario_conclucion_general, sumario_decision_general, iii_fecha_creacion, 
                iii_desc_inf_inicial, actuacion_fecha_informe, actuacion_fecha_creacion, 
                actuacion_lugar_informe, actuacion_descripcion_informe, inspeccion_fecha_creacion, 
                inspeccion_fecha_inspeccion, inspeccion_lugar_suceso, inspeccion_direccion, 
                inspeccion_resultado, inspeccion_hora_suceso, id_desviacion
                */
                    
                    
                    if($datos[$i]['sumario_antecedente_general'] <> $sumario_antecedente_general_ant){
                        echo "sumario_antecedente_general:\n<br>".$datos[$i]['sumario_antecedente_general']."\n<br><br>";
                    }
                    $sumario_antecedente_general_ant = $datos[$i]['resumen_ejecutivo_actividades_realizadas'];
                }
                
                
                echo $empresa_imp;
                echo $persona_imp;
                echo $re_recomendaciones;
                echo $re_conoc_hecho;
                echo $re_act_rea;
                echo $re_conclusiones;
		$query->free_result();
		$db->close();
                //print_r($datos);die();
            
        }
        
        public function casos_5($codigo){
            
            //echo "****************$codigo****************";
            $db=$this->load->database('siev',TRUE);
            
            $sql_inv = "SELECT DISTINCT inv_id, inv_codigo_investigacion, inv_indicador_usuario, inv_cargo_usuario, 
            inv_lugar_suceso, trim(inv_descripcion) as inv_descripcion, inv_fecha_creacion, inv_estatus           
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY inv_id";
            
            $sql_org = "SELECT  DISTINCT org_filial, org_region, org_distrito, org_area_localidad           
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY org_filial";
            
            $sql_bien_afectado = "SELECT DISTINCT
            bien_afectado_desc_1era_clase, 
            bien_afectado_desc_2da_clase, bien_afectado_desc_3ra_clase, bien_afectado_nombre_propietario, 
            bien_afectado_desc_bienes, bien_afectado_cantidad, trim(bien_afectado_observaciones) as bien_afectado_observaciones, 
            bien_afectado_mnto_total
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY bien_afectado_desc_1era_clase";

            $sql_persona = "SELECT DISTINCT persona_inv_ci, persona_inv_primer_nombre, 
            persona_inv_primer_apellido
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY persona_inv_ci";
            //echo $sql;die();
            $sql_empresa = "SELECT DISTINCT
            empresa_inv_rif, empresa_inv_razon_social
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY empresa_inv_rif";
            
            $sql_resumen_ejecutivo = "SELECT DISTINCT
            resumen_ejecutivo_recomendaciones, resumen_ejecutivo_conoc_hecho, 
            resumen_ejecutivo_conclusiones, resumen_ejecutivo_actividades_realizadas, 
            resumen_ejecutivo_actividades_pendientes
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY resumen_ejecutivo_recomendaciones";
            
            $sql_sumario = "SELECT DISTINCT sumario_antecedente_general, 
            trim(sumario_conclucion_general) as sumario_conclucion_general, trim(sumario_decision_general) as sumario_decision_general
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY sumario_decision_general";

            $sql_iii = "SELECT DISTINCT iii_fecha_creacion, trim(iii_desc_inf_inicial) as iii_desc_inf_inicial
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY iii_fecha_creacion";
            
            $sql_actuacion = "SELECT DISTINCT actuacion_fecha_informe, actuacion_fecha_creacion, 
            actuacion_lugar_informe, trim(actuacion_descripcion_informe) as actuacion_descripcion_informe
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY actuacion_fecha_creacion";

            $sql_inspeccion = "SELECT DISTINCT inspeccion_fecha_creacion, 
            inspeccion_fecha_inspeccion, inspeccion_lugar_suceso, inspeccion_direccion, 
            trim(inspeccion_resultado) as inspeccion_resultado, inspeccion_hora_suceso
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE inv_codigo_investigacion='$codigo' ORDER BY inspeccion_fecha_creacion";
  
            $query = $db->query($sql_inv);
            $datos_inv=array();
            foreach ($query->result_array() as $row){
                    $datos_inv[] = $row;
                    }
            $query = $db->query($sql_org);
            $datos_org=array();
            foreach ($query->result_array() as $row){
                    $datos_org[] = $row;
                    }
            $query = $db->query($sql_bien_afectado);
            $datos_bien_afectado=array();
            foreach ($query->result_array() as $row){
                    $datos_bien_afectado[] = $row;
                    }
            $query = $db->query($sql_persona);
            $datos_persona=array();
            foreach ($query->result_array() as $row){
                    $datos_persona[] = $row;
                    }
            $query = $db->query($sql_empresa);
            $datos_empresa=array();
            foreach ($query->result_array() as $row){
                    $datos_empresa[] = $row;
                    }
            $query = $db->query($sql_resumen_ejecutivo);
            $datos_resumen_ejecutivo=array();
            foreach ($query->result_array() as $row){
                    $datos_resumen_ejecutivo[] = $row;
                    }
            $query = $db->query($sql_sumario);
            $datos_sumario=array();
            foreach ($query->result_array() as $row){
                    $datos_sumario[] = $row;
                    }
            $query = $db->query($sql_iii);
            $datos_iii=array();
            foreach ($query->result_array() as $row){
                    $datos_iii[] = $row;
                    }
            $query = $db->query($sql_actuacion);
            $datos_actuacion=array();
            foreach ($query->result_array() as $row){
                    $datos_actuacion[] = $row;
                    }
            $query = $db->query($sql_inspeccion);
            $datos_inspeccion=array();
            foreach ($query->result_array() as $row){
                    $datos_inspeccion[] = $row;
                    }                              
                    
                        
		$query->free_result();
$db->close();
                $this->view_data['codigo'] = $codigo;
                $this->view_data['datos_inv'] = $datos_inv;
                $this->view_data['datos_org'] = $datos_org;
                $this->view_data['datos_bien_afectado'] = $datos_bien_afectado;
                $this->view_data['datos_persona'] = $datos_persona;
                $this->view_data['datos_empresa'] = $datos_empresa;
                $this->view_data['datos_resumen_ejecutivo'] = $datos_resumen_ejecutivo;
                $this->view_data['datos_sumario'] = $datos_sumario;
                $this->view_data['datos_iii'] = $datos_iii;
                $this->view_data['datos_actuacion'] = $datos_actuacion;
                $this->view_data['datos_inspeccion'] = $datos_inspeccion;
                              
                $this->load->view('view_casos_4', $this->view_data);
            
        }

	 public function verificaciones_4()
	{
            
            $db=$this->load->database('siev',TRUE);
            
       $query = $db->query("
            SELECT 
             count (inv_id) as total,
             extract ('year' from inv_fecha_creacion ) as anio,
             verificacionest.inv_estatus as estatus

            FROM 
              public.verificacionest
            WHERE 
                verificacionest.inv_estatus = 'CERRADO' or verificacionest.inv_estatus = 'ABIERTO'
             group by 
            anio, verificacionest.inv_estatus
             order by anio

        ");

            $abierto = '';
            $cerrado = '';
            $total   = '';
            $anio = '';
            $estatus = '';
            $anio_ant = "";
            $estatus_ant = "";


    foreach ($query->result_array() as $row)
    {
        
        if($row['anio']<>$anio_ant){
            $categorias[] = $row['anio'];
        }
        $anio_ant = $row['anio'];
        
        //echo $row['casos'];
        
//        if($row['estatus'] == 'ABIERTO'){
//            $abierto[] = $row['casos'];
//        }else{
//            $cerrado[] = $row['casos'];
//        }
       
        if($row['estatus'] == 'CERRADO'){
            $cerrado[] = $row['total'];
            }else{
                 if($row['estatus'] == 'ABIERTO'){
                     $abierto[] = $row['total'];
                 }
                }

        $estatus_ant = $row['estatus'];
        

    }


            $anios = count($categorias);
            $serie_data[] = array('name' => 'ABIERTO', 'data' => $abierto);
            $serie_data[] = array('name' => 'CERRADO', 'data' => $cerrado);

$query->free_result();
$db->close();            

        $this->view_data['anios'] = $anios;
        $this->view_data['caterorias'] = json_encode($categorias);
        $this->view_data['serie_data'] = json_encode($serie_data, JSON_NUMERIC_CHECK);
	$this->load->view('view_verificaciones_4', $this->view_data);
         
	}
        
        
        public function verificaciones_5($anio,$estatus)
	{
            
            
            $db=$this->load->database('siev',TRUE);
$sql="SELECT 
            org_filial,
            org_region,
            COUNT(DISTINCT inv_codigo_investigacion) AS casos
            FROM verificacionest
            WHERE 
            inv_estatus = '$estatus'
            AND extract('year' FROM verificacionest.inv_fecha_creacion) ='$anio'
            GROUP BY org_filial,org_region
            ORDER BY org_filial,casos DESC,org_region
            ";
//echo $sql;die();
            $query = $db->query($sql);
            //echo $query;
            $datos = "";
            foreach ($query->result_array() as $row)
            {
            $org_filial = $row['org_filial'];
            $org_region = $row['org_region'];
            $casos = $row['casos'];
            
                       
            $datos .= "$org_filial*$org_region\t$casos%\n";
            }
            
          $query->free_result();
$db->close();
            $this->view_data['anio'] = $anio;
            $this->view_data['estatus'] = $estatus;
            $this->view_data['datos'] = $datos;
            $this->load->view('view_verificaciones_5', $this->view_data);

	}
        
        
        public function verificaciones_6(){
          
            
            $filial=  strtoupper($this->input->post('filial'));
            $region=  strtoupper($this->input->post('region'));
            $anio=  strtoupper($this->input->post('anio'));
            $estatus=  strtoupper($this->input->post('estatus'));
            $db=$this->load->database('siev',TRUE);

            $sql = "
                    SELECT distinct
                      verificacionest.inv_codigo_investigacion,
                      verificacionest.inv_indicador_usuario, 
                      UPPER(verificacionest.inv_cargo_usuario) AS inv_cargo_usuario, 
                      trim(substring(verificacionest.inv_descripcion from 0 for 200)) AS inv_descripcion, 
                      verificacionest.inv_fecha_creacion
                    FROM 
                      public.verificacionest
                    WHERE 

                    verificacionest.inv_estatus = '$estatus' AND
                      verificacionest.org_filial = '$filial' AND 
                     verificacionest.org_region = '$region' 
                          AND extract('year' FROM verificacionest.inv_fecha_creacion) = '$anio'
                    ORDER BY inv_fecha_creacion DESC";
            
            
            //echo $sql;die();
            $query = $db->query($sql);
            
            
            
            //print_r($q);die();
            $datos=array();
		foreach ($query->result_array() as $row){
			$datos[] = $row;

		}
		$query->free_result();
		$db->close();
                //print_r($data);die();
		//return($data);  
                $this->view_data['datos'] = $datos;
                $this->load->view('view_verificaciones_6', $this->view_data);
        }


public function verificaciones_7($rif){
            
            //echo "****************$codigo****************";
            $db=$this->load->database('siev',TRUE);
           // echo $rif;die();
            $sql_empresa = "SELECT 
                    empresa.rif, 
                    empresa.reg_nacional_contratista, 
                    empresa.observaciones, 
                    empresa.fch_ultima_verificacion, 
                    empresa.direccion_fiscal, 
                    empresa.registro_mercantil, 
                    empresa.razon_social, 
                    empresa.id_analista_estado_def, 
                    empresa.comentario_estado,                     
                    empresa.fch_estado_def,
                      estado.desc_estado

                  FROM 
                    public.empresa, public.estado

                  WHERE 
                    trim(empresa.rif) ='$rif' and estado.id_estado = empresa.id_estado_def";
            
             $sql_empresa_verificacion="
            SELECT 
              v_formato_resultado_verificacion_empresas.rif, 
              v_formato_resultado_verificacion_empresas.nro_verificacion_emp, 
              v_formato_resultado_verificacion_empresas.nro_orden_emp, 
              v_formato_resultado_verificacion_empresas.id_usuario, 
              v_formato_resultado_verificacion_empresas.nro_semana, 
              v_formato_resultado_verificacion_empresas.origen_solicitud, 
              v_formato_resultado_verificacion_empresas.gcia_contratante, 
              v_formato_resultado_verificacion_empresas.id_perfil_emp, 
              v_formato_resultado_verificacion_empresas.fch_creacion, 
              v_formato_resultado_verificacion_empresas.id_tipo_empresa, 
              v_formato_resultado_verificacion_empresas.comentario, 
              v_formato_resultado_verificacion_empresas.declaracion_impuestos_est, 
              v_formato_resultado_verificacion_empresas.ince_est, 
              v_formato_resultado_verificacion_empresas.sso_est, 
              v_formato_resultado_verificacion_empresas.resultado_inspeccion, 
              v_formato_resultado_verificacion_empresas.bienes_empresa, 
              v_formato_resultado_verificacion_empresas.razon_social,               
              v_formato_resultado_verificacion_empresas.nit, 
              v_formato_resultado_verificacion_empresas.registro_mercantil, 
              v_formato_resultado_verificacion_empresas.registro_seniat, 
              v_formato_resultado_verificacion_empresas.direccion_fiscal, 
              v_formato_resultado_verificacion_empresas.direccion, 
              v_formato_resultado_verificacion_empresas.tlf, 
              v_formato_resultado_verificacion_empresas.actividad_economica, 
              v_formato_resultado_verificacion_empresas.capital_suscrito, 
              v_formato_resultado_verificacion_empresas.capital_pagado, 
              v_formato_resultado_verificacion_empresas.fch_decision, 
              v_formato_resultado_verificacion_empresas.id_aprobador, 
              v_formato_resultado_verificacion_empresas.comentario_decision, 
              v_formato_resultado_verificacion_empresas.nombres_apellidos, 
              v_formato_resultado_verificacion_empresas.fecha_creacion, 
              v_formato_resultado_verificacion_empresas.id, 
              v_formato_resultado_verificacion_empresas.id_supervisor, 
              v_formato_resultado_verificacion_empresas.primer_nombre, 
              v_formato_resultado_verificacion_empresas.segundo_nombre, 
              v_formato_resultado_verificacion_empresas.primer_apellido, 
              v_formato_resultado_verificacion_empresas.segundo_apellido, 
              v_formato_resultado_verificacion_empresas.cedula, 
              v_formato_resultado_verificacion_empresas.lugar, 
              v_formato_resultado_verificacion_empresas.cargo_gerente,
               estado1.desc_estado as estado_actual,
                estado2.desc_estado as estado_anterior

            FROM 
              public.v_formato_resultado_verificacion_empresas, 
              public.estado as estado1,
              public.estado as estado2

            WHERE 
              v_formato_resultado_verificacion_empresas.id_estado_actual = estado1.id_estado and
                v_formato_resultado_verificacion_empresas.id_estado_anterior = estado2.id_estado and
                trim(v_formato_resultado_verificacion_empresas.rif)='$rif'  order by to_date (v_formato_resultado_verificacion_empresas.fch_decision, 'DD-MM-YYYY') DESC;"; 

            $query = $db->query($sql_empresa);
            $datos_empresa=array();
            foreach ($query->result_array() as $row){
                    $datos_empresa[] = $row;
                    }
                                         
            $query = $db->query($sql_empresa_verificacion);
            $datos_empresa_verificacion=array();
            foreach ($query->result_array() as $row){
                    $datos_empresa_verificacion[] = $row;
                    }       
                        
$query->free_result();
$db->close();

                $this->view_data['datos_empresa'] = $datos_empresa;
                $this->view_data['datos_empresa_verificacion'] = $datos_empresa_verificacion;
                              
                $this->load->view('view_verificaciones_7', $this->view_data);
            
        }
public function verificaciones_8($cod_verficacion){
            
            //echo "****************$codigo****************";
            $db=$this->load->database('siev',TRUE);
           // echo $rif;die();
           /* $sql_empresa = "SELECT 
                    empresa.rif, 
                    empresa.reg_nacional_contratista, 
                    empresa.observaciones, 
                    empresa.fch_ultima_verificacion, 
                    empresa.direccion_fiscal, 
                    empresa.registro_mercantil, 
                    empresa.razon_social, 
                    empresa.id_analista_estado_def, 
                    empresa.comentario_estado,                     
                    empresa.fch_estado_def,
                      estado.desc_estado

                  FROM 
                    public.empresa, public.estado

                  WHERE 
                    empresa.rif ='$rif' and estado.id_estado = empresa.id_estado_def";
            */
             $sql_empresa_verificacion="
            SELECT 
              v_formato_resultado_verificacion_empresas.rif, 
              v_formato_resultado_verificacion_empresas.nro_verificacion_emp, 
              v_formato_resultado_verificacion_empresas.nro_orden_emp, 
              v_formato_resultado_verificacion_empresas.id_usuario, 
              v_formato_resultado_verificacion_empresas.nro_semana, 
              v_formato_resultado_verificacion_empresas.origen_solicitud, 
              v_formato_resultado_verificacion_empresas.gcia_contratante, 
              v_formato_resultado_verificacion_empresas.id_perfil_emp, 
              v_formato_resultado_verificacion_empresas.fch_creacion, 
              v_formato_resultado_verificacion_empresas.id_tipo_empresa, 
              v_formato_resultado_verificacion_empresas.comentario, 
              v_formato_resultado_verificacion_empresas.declaracion_impuestos_est, 
              v_formato_resultado_verificacion_empresas.ince_est, 
              v_formato_resultado_verificacion_empresas.sso_est, 
              v_formato_resultado_verificacion_empresas.resultado_inspeccion, 
              v_formato_resultado_verificacion_empresas.bienes_empresa, 
              v_formato_resultado_verificacion_empresas.razon_social,               
              v_formato_resultado_verificacion_empresas.nit, 
              v_formato_resultado_verificacion_empresas.registro_mercantil, 
              v_formato_resultado_verificacion_empresas.registro_seniat, 
              v_formato_resultado_verificacion_empresas.direccion_fiscal, 
              v_formato_resultado_verificacion_empresas.direccion, 
              v_formato_resultado_verificacion_empresas.tlf, 
              v_formato_resultado_verificacion_empresas.actividad_economica, 
              v_formato_resultado_verificacion_empresas.capital_suscrito, 
              v_formato_resultado_verificacion_empresas.capital_pagado, 
              v_formato_resultado_verificacion_empresas.fch_decision, 
              v_formato_resultado_verificacion_empresas.id_aprobador, 
              v_formato_resultado_verificacion_empresas.comentario_decision, 
              v_formato_resultado_verificacion_empresas.nombres_apellidos, 
              v_formato_resultado_verificacion_empresas.fecha_creacion, 
              v_formato_resultado_verificacion_empresas.id, 
              v_formato_resultado_verificacion_empresas.id_supervisor, 
              v_formato_resultado_verificacion_empresas.primer_nombre, 
              v_formato_resultado_verificacion_empresas.segundo_nombre, 
              v_formato_resultado_verificacion_empresas.primer_apellido, 
              v_formato_resultado_verificacion_empresas.segundo_apellido, 
              v_formato_resultado_verificacion_empresas.cedula, 
              v_formato_resultado_verificacion_empresas.lugar, 
              v_formato_resultado_verificacion_empresas.cargo_gerente,
               estado1.desc_estado as estado_actual,
                estado2.desc_estado as estado_anterior

            FROM 
              public.v_formato_resultado_verificacion_empresas, 
              public.estado as estado1,
              public.estado as estado2

            WHERE 
              v_formato_resultado_verificacion_empresas.id_estado_actual = estado1.id_estado and
                v_formato_resultado_verificacion_empresas.id_estado_anterior = estado2.id_estado and
                v_formato_resultado_verificacion_empresas.nro_verificacion_emp='$cod_verficacion'  order by to_date (v_formato_resultado_verificacion_empresas.fch_decision, 'DD-MM-YYYY') DESC;"; 

           /* $query = $db->query($sql_empresa);
            $datos_empresa=array();
            foreach ($query->result_array() as $row){
                    $datos_empresa[] = $row;
                    }
              */                           
            $query = $db->query($sql_empresa_verificacion);
            $datos_empresa_verificacion=array();
            foreach ($query->result_array() as $row){
                    $datos_empresa_verificacion[] = $row;
                    }       
                        
$query->free_result();
$db->close();

               // $this->view_data['datos_empresa'] = $datos_empresa;
                $this->view_data['datos_empresa_verificacion'] = $datos_empresa_verificacion;
                              
                $this->load->view('view_verificaciones_8', $this->view_data);
            
        }
        public function verificaciones_9($cod_verficacion){
            
            //echo "****************$codigo****************";
            $db=$this->load->database('siev',TRUE);
           // echo $rif;die();
            $sql_empresa = "SELECT inv_id, inv_codigo_investigacion, inv_indicador_usuario, inv_cargo_usuario, 
       inv_lugar_suceso, inv_descripcion, inv_fecha_creacion, inv_estatus, 
       org_filial, org_region, org_distrito, org_area_localidad, persona_inv_ci, 
       persona_inv_primer_nombre, persona_inv_primer_apellido
  FROM verificacionest
  where inv_codigo_investigacion='$cod_verficacion'";
            
             $sql_empresa_verificacion="
            SELECT 
              v_formato_resultado_verificacion_empresas.rif, 
              v_formato_resultado_verificacion_empresas.nro_verificacion_emp, 
              v_formato_resultado_verificacion_empresas.nro_orden_emp, 
              v_formato_resultado_verificacion_empresas.id_usuario, 
              v_formato_resultado_verificacion_empresas.nro_semana, 
              v_formato_resultado_verificacion_empresas.origen_solicitud, 
              v_formato_resultado_verificacion_empresas.gcia_contratante, 
              v_formato_resultado_verificacion_empresas.id_perfil_emp, 
              v_formato_resultado_verificacion_empresas.fch_creacion, 
              v_formato_resultado_verificacion_empresas.id_tipo_empresa, 
              v_formato_resultado_verificacion_empresas.comentario, 
              v_formato_resultado_verificacion_empresas.declaracion_impuestos_est, 
              v_formato_resultado_verificacion_empresas.ince_est, 
              v_formato_resultado_verificacion_empresas.sso_est, 
              v_formato_resultado_verificacion_empresas.resultado_inspeccion, 
              v_formato_resultado_verificacion_empresas.bienes_empresa, 
              v_formato_resultado_verificacion_empresas.razon_social,               
              v_formato_resultado_verificacion_empresas.nit, 
              v_formato_resultado_verificacion_empresas.registro_mercantil, 
              v_formato_resultado_verificacion_empresas.registro_seniat, 
              v_formato_resultado_verificacion_empresas.direccion_fiscal, 
              v_formato_resultado_verificacion_empresas.direccion, 
              v_formato_resultado_verificacion_empresas.tlf, 
              v_formato_resultado_verificacion_empresas.actividad_economica, 
              v_formato_resultado_verificacion_empresas.capital_suscrito, 
              v_formato_resultado_verificacion_empresas.capital_pagado, 
              v_formato_resultado_verificacion_empresas.fch_decision, 
              v_formato_resultado_verificacion_empresas.id_aprobador, 
              v_formato_resultado_verificacion_empresas.comentario_decision, 
              v_formato_resultado_verificacion_empresas.nombres_apellidos, 
              v_formato_resultado_verificacion_empresas.fecha_creacion, 
              v_formato_resultado_verificacion_empresas.id, 
              v_formato_resultado_verificacion_empresas.id_supervisor, 
              v_formato_resultado_verificacion_empresas.primer_nombre, 
              v_formato_resultado_verificacion_empresas.segundo_nombre, 
              v_formato_resultado_verificacion_empresas.primer_apellido, 
              v_formato_resultado_verificacion_empresas.segundo_apellido, 
              v_formato_resultado_verificacion_empresas.cedula, 
              v_formato_resultado_verificacion_empresas.lugar, 
              v_formato_resultado_verificacion_empresas.cargo_gerente,
               estado1.desc_estado as estado_actual,
                estado2.desc_estado as estado_anterior

            FROM 
              public.v_formato_resultado_verificacion_empresas, 
              public.estado as estado1,
              public.estado as estado2

            WHERE 
              v_formato_resultado_verificacion_empresas.id_estado_actual = estado1.id_estado and
                v_formato_resultado_verificacion_empresas.id_estado_anterior = estado2.id_estado and
                v_formato_resultado_verificacion_empresas.nro_verificacion_emp='$cod_verficacion'  order by to_date (v_formato_resultado_verificacion_empresas.fch_decision, 'DD-MM-YYYY') DESC;"; 

           $query = $db->query($sql_empresa);
            $datos_empresa=array();
            foreach ($query->result_array() as $row){
                    $datos_empresa[] = $row;
                    }
                                        
            $query = $db->query($sql_empresa_verificacion);
            $datos_empresa_verificacion=array();
            foreach ($query->result_array() as $row){
                    $datos_empresa_verificacion[] = $row;
                    }       
                        
$query->free_result();
$db->close();

                $this->view_data['datos_empresa'] = $datos_empresa;
                $this->view_data['datos_empresa_verificacion'] = $datos_empresa_verificacion;
                              
                $this->load->view('view_verificaciones_9', $this->view_data);
            
        }
        public function verificaciones_10($anio,$estatus)
	{

        $estatus = str_replace('%20', ' ', $estatus);

            
            $db=$this->load->database('siev',TRUE);
$sql="SELECT filial.desc_filial as org_filial,
		    region.desc_region as org_region,
                    count(distinct v_formato_resultado_verificacion_empresas.nro_verificacion_emp) as nro_verificacion_emp
                   FROM 
                    public.v_formato_resultado_verificacion_empresas, 
                    public.estado,
                    public.organizacion,
                    public.orden_solicitud_empresa,
                    public.filial,
                    public.region
                  WHERE 
                    v_formato_resultado_verificacion_empresas.id_estado_actual = estado.id_estado and
                    substring (v_formato_resultado_verificacion_empresas.fch_decision from 7 for 4)='$anio' and 
                    estado.desc_estado='$estatus' and 
                    orden_solicitud_empresa.nro_verificacion_emp = v_formato_resultado_verificacion_empresas.nro_verificacion_emp and
                    orden_solicitud_empresa.id_usuario=v_formato_resultado_verificacion_empresas.id_usuario and 
                    orden_solicitud_empresa.id_org_analista = organizacion.id_org and
                    organizacion.id_filial=filial.id_filial and
                     organizacion.id_region=region.id_region
                  group by filial.desc_filial, region.desc_region
                  order by
                    filial.desc_filial
            ";
//echo $sql;die();
            $query = $db->query($sql);
            //echo $query;
            $datos = "";
            foreach ($query->result_array() as $row)
            {
            $org_filial = $row['org_filial'];
            $org_region = $row['org_region'];
            $nro_verificacion_emp = $row['nro_verificacion_emp'];
            
                       
            $datos .= "$org_filial*$org_region\t$nro_verificacion_emp%\n";
            }
            
$query->free_result();
$db->close();
            $this->view_data['anio'] = $anio;
            $this->view_data['estatus'] = $estatus;
            $this->view_data['datos'] = $datos;
            //$this->load->view('view_verificaciones_10', $this->view_data);
            
            $this->view_data['view_name'] = "view_verificaciones_10";
        $this->view_data['menu'] = "verificaciones";
        $this->load->view('output', $this->view_data);

	}

public function verificaciones_11($ci){
            
            //echo "****************$codigo****************";
            $db=$this->load->database('siev',TRUE);
           // echo $rif;die();          
             
             
                $sql_estado = "SELECT DISTINCT
                    numero_verificacion, 
                    to_date(fecha_creacion,'DD/MM/YYYY') AS fecha_creacion,
                    to_date(fecha_decision,'DD/MM/YYYY') AS fecha_decision,   
                    tipo_verificacion,
                    estado_verificacion,
                    
                    to_date(lpv_fch_edo_ant,'DD/MM/YYYY') AS lpv_fch_edo_ant,
                    lpv_enviar_fnte,
                    to_date(lpv_fch_creacion ,'DD/MM/YYYY') AS  lpv_fch_creacion,
                    to_date(lpv_fch_status_visita,'DD/MM/YYYY') AS lpv_fch_status_visita,
                    trim(lpv_comentario_general_estudio) AS lpv_comentario_general_estudio, 
                    trim(lpv_comentario_general_laboral) AS lpv_comentario_general_laboral, 
                    trim(lpv_comentario_general_seguridad) AS lpv_comentario_general_seguridad, 
                    to_date(lpv_fch_decision,'DD/MM/YYYY') AS lpv_fch_decision ,
                    trim(lpv_comentario_estado) AS lpv_comentario_estado, 
                    trim(lpv_comentario_visita) AS lpv_comentario_visita,
                    
                    to_date(pfper_fch_creacion,'DD/MM/YYYY') AS pfper_fch_creacion,
                    pfper_edo_civil, 
                    pfper_profesion, 
                    pfper_direccion, 
                    pfper_tlf, 
                    pfper_cel, 
                    pfper_gerencia, 
                    to_date(osp_fch_creacion,'DD/MM/YYYY') AS osp_fch_creacion,
                    osp_nro_semana, 
                    osp_nro_verificacion, 
                    osp_anio, 
                    osp_solicitante_nombre, 
                    osp_empresa_solicitante, 
                    osp_direccion_solicitante, 
                    osp_correo_solicitante, 
                    osp_pto_focal, 
                    osp_gcia_contratante

                  FROM 
                    verificaciones_personas_bt

                  WHERE 
                   per_ci='$ci';";  
             
                $sql_localidad = "SELECT DISTINCT
                    desc_filial, 
                    desc_region, 
                    desc_distrito,
                    desc_area_loc

                  FROM 
                   verificaciones_personas_bt

                  WHERE 
                    per_ci='$ci';";                  
             
                $sql_persona = "SELECT DISTINCT
                    per_sexo, 
                    per_nacionalidad, 
                    per_ci,
                    to_date(per_fch_nac, 'YYYY MM DD') AS per_fch_nac,
                    per_lugar_nac , 
                    per_estado_nac , 
                    per_primer_nombre , 
                    per_primer_apellido , 
                    per_segundo_apellido , 
                    per_segundo_nombre , 
                    per_tipo_doc

                  FROM 
                    verificaciones_personas_bt

                  WHERE 
                    per_ci='$ci';";             
             
                $sql_verificacion = "SELECT DISTINCT
                    to_date(lpv_fch_edo_ant,'DD/MM/YYYY') AS lpv_fch_edo_ant,
                    lpv_enviar_fnte,
                    to_date(lpv_fch_creacion ,'DD/MM/YYYY') AS  lpv_fch_creacion,
                    to_date(lpv_fch_status_visita,'DD/MM/YYYY') AS lpv_fch_status_visita,
                    trim(lpv_comentario_general_estudio) AS lpv_comentario_general_estudio, 
                    trim(lpv_comentario_general_laboral) AS lpv_comentario_general_laboral, 
                    trim(lpv_comentario_general_seguridad) AS lpv_comentario_general_seguridad, 
                    to_date(lpv_fch_decision,'DD/MM/YYYY') AS lpv_fch_decision ,
                    trim(lpv_comentario_estado) AS lpv_comentario_estado, 
                    trim(lpv_comentario_visita) AS lpv_comentario_visita

                  FROM 
                    verificaciones_personas_bt

                  WHERE 
                    per_ci='$ci';";            
             
                $sql_fecha_estado = "SELECT DISTINCT
                    to_date(per_fch_estado_def,'DD/MM/YYYY') AS per_fch_estado_def,
                    to_date(per_fch_estado_visita,'DD/MM/YYYY') AS per_fch_estado_visita,
                    per_coment_estado_def , 
                    per_coment_visita
                    

                  FROM 
                   verificaciones_personas_bt

                  WHERE 
                   per_ci='$ci';";             
             
                $sql_comentario = "SELECT DISTINCT
                    per_coment_general , 
                    per_comentario

                  FROM 
                   verificaciones_personas_bt

                  WHERE 
                    per_ci='$ci';";
             
                $sql_solicitud = "SELECT DISTINCT
                    to_date(pfper_fch_creacion,'DD/MM/YYYY') AS pfper_fch_creacion,
                    pfper_edo_civil, 
                    pfper_profesion, 
                    pfper_direccion, 
                    pfper_tlf, 
                    pfper_cel, 
                    pfper_gerencia, 
                    to_date(osp_fch_creacion,'DD/MM/YYYY') AS osp_fch_creacion,
                    osp_nro_semana, 
                    osp_nro_verificacion, 
                    osp_anio, 
                    osp_solicitante_nombre, 
                    osp_empresa_solicitante, 
                    osp_direccion_solicitante, 
                    osp_correo_solicitante, 
                    osp_pto_focal, 
                    osp_gcia_contratante

                  FROM 
                    verificaciones_personas_bt
                    
                  WHERE 
                    per_ci='$ci';";
             
                $sql_pista_seguridad = "SELECT DISTINCT
                    to_date(verperant_fch_creacion,'DD/MM/YYYY') AS verperant_fch_creacion,
                    perant_nro_expediente, 
                    perant_desviacion, 
                    perant_lugar_apertura_exp, 
                    perant_acciones_tomadas, 
                    perant_accion_historial, 
                    to_date(perant_fch_creacion,'DD/MM/YYYY') AS perant_fch_creacion,
                    to_date(perant_fch_actualizacion,'DD/MM/YYYY') AS perant_fch_actualizacion,
                    perant_nombre_apellidos, 
                    perant_region, 
                    to_date(perant_fch_delito,'DD/MM/YYYY') AS perant_fch_delito,
                    perant_comentario_notes

                  FROM 
                   verificaciones_personas_bt

                  WHERE 
                    per_ci='$ci';";
                
                $sql_pista_academica = "SELECT DISTINCT
                    to_date(verperest_fch_creacion,'DD/MM/YYYY') AS verperest_fch_creacion,
                    verperest_comentario, 
                    perest_instituto_estudio, 
                    perest_titulo, 
                    perest_especialidad, 
                    perest_anio, 
                    to_date(perest_fecha_creacion,'DD/MM/YYYY') AS perest_fecha_creacion,
                    perest_comentario, 
                    to_date(perest_fecha_ultima_actualizacion,'DD/MM/YYYY') AS perest_fecha_ultima_actualizacion,
                    perest_observaciones_estudio, 
                    perest_resultado_estudio

                  FROM 
                    verificaciones_personas_bt

                  WHERE 
                    per_ci='$ci';";
                            
                $sql_pista_laboral = "SELECT DISTINCT
                    to_date(verperexp_fch_creacion,'DD/MM/YYYY') AS verperexp_fch_creacion,
                    verperexp_comentario , 
                    perexp_cargo, 
                    perexp_mes_anio_in, 
                    perexp_mes_anio_fin, 
                    perexp_tlf, 
                    perexp_e_mail, 
                    perexp_direccion_web, 
                    perexp_ubicacion, 
                    perexp_empresas, 
                    perexp_motivo_retiro, 
                    to_date(perexp_fecha_creacion,'DD/MM/YYYY') AS perexp_fecha_creacion,
                    to_date(perexp_fecha_actualizacion,'DD/MM/YYYY') AS perexp_fecha_actualizacion,
                    perexp_comentario, 
                    perexp_observaciones_laboral

                  FROM 
                    verificaciones_personas_bt

                  WHERE 
                        per_ci='$ci';";

            $query = $db->query($sql_estado);
            $datos_estado=array();
            foreach ($query->result_array() as $row){
                    $datos_estado[] = $row;
                    }
                    
            $query = $db->query($sql_localidad);
            $datos_localidad=array();
            foreach ($query->result_array() as $row){
                    $datos_localidad[] = $row;
                    }
                    
            $query = $db->query($sql_persona);
            $datos_persona=array();
            foreach ($query->result_array() as $row){
                    $datos_persona[] = $row;
                    }
                    
            $query = $db->query($sql_verificacion);
            $datos_verificacion=array();
            foreach ($query->result_array() as $row){
                    $datos_verificacion[] = $row;
                    }
                    
            $query = $db->query($sql_fecha_estado);
            $datos_fecha_estado=array();
            foreach ($query->result_array() as $row){
                    $datos_fecha_estado[] = $row;
                    }
                    
            $query = $db->query($sql_comentario);
            $datos_comentario=array();
            foreach ($query->result_array() as $row){
                    $datos_comentario[] = $row;
                    }
                    
            $query = $db->query($sql_solicitud);
            $datos_solicitud=array();
            foreach ($query->result_array() as $row){
                    $datos_solicitud[] = $row;
                    }
                    
            $query = $db->query($sql_pista_seguridad);
            $datos_pista_seguridad=array();
            foreach ($query->result_array() as $row){
                    $datos_pista_seguridad[] = $row;
                    }
                    
            $query = $db->query($sql_pista_academica);
            $datos_pista_academica=array();
            foreach ($query->result_array() as $row){
                    $datos_pista_academica[] = $row;
                    }
                    
            $query = $db->query($sql_pista_laboral);
            $datos_pista_laboral=array();
            foreach ($query->result_array() as $row){
                    $datos_pista_laboral[] = $row;
                    }                              
                    
                        
		$query->free_result();
                $this->view_data['cedula'] = $ci;
                $this->view_data['datos_estado'] = $datos_estado;
                $this->view_data['datos_localidad'] = $datos_localidad;
                $this->view_data['datos_persona'] = $datos_persona;
                $this->view_data['datos_verificacion'] = $datos_verificacion;
                $this->view_data['datos_fecha_estado'] = $datos_fecha_estado;
                $this->view_data['datos_comentario'] = $datos_comentario;
                $this->view_data['datos_solicitud'] = $datos_solicitud;
                $this->view_data['datos_pista_seguridad'] = $datos_pista_seguridad;
                $this->view_data['datos_pista_academica'] = $datos_pista_academica;
                $this->view_data['datos_pista_laboral'] = $datos_pista_laboral;
                              
                $this->load->view('view_verificaciones_11', $this->view_data);
            
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
