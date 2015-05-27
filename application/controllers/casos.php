<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Casos extends CI_Controller {

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
                $this->load->library(array('session'));

		$session_id = $this->session->userdata('indicador_usuario');
		//echo "aaaaaaa";
		//print_r($this->session->all_userdata());die();
		if($session_id==""){
		//echo "<script>alert('xxxXXXxxx')</script>";		
		redirect(base_url(''), 'refresh');
		}
		

	}
	
	public function index()
	{
            
            //$this->load->view('menu');
            
            redirect(base_url('/casos/casos_1/'), 'refresh');
	}
        
        public function casos_1()
	{
            
            $db=$this->load->database('siev',TRUE);
            
            $query = $db->query("SELECT 
  extract('year' FROM stagin_investigaciones_casos_abiertas_detalle.inv_fecha_creacion) AS anio, 
  stagin_investigaciones_casos_abiertas_detalle.inv_estatus AS estatus,
  COUNT(DISTINCT stagin_investigaciones_casos_abiertas_detalle.inv_codigo_investigacion) AS casos
  
FROM 
  public.stagin_investigaciones_casos_abiertas_detalle
GROUP BY 
  extract('year' FROM stagin_investigaciones_casos_abiertas_detalle.inv_fecha_creacion), 
  stagin_investigaciones_casos_abiertas_detalle.inv_estatus
ORDER  BY anio ASC, estatus ASC
");
            //$abierto = array();
            //$cerrado = array();
            $abierto = '';
            $cerrado = '';
            $anio_ant = "";
            $estatus_ant = "";

    foreach ($query->result_array() as $row)
    {
        
        if($row['anio']<>$anio_ant){
            $categorias[] = $row['anio'];
        }
        $anio_ant = $row['anio'];
        
        //echo $row['casos'];
        
        if($row['estatus'] == 'ABIERTO'){
            $abierto[] = $row['casos'];
        }else{
            $cerrado[] = $row['casos'];
        }
        $estatus_ant = $row['estatus'];
        

    }
            $anios = count($categorias);
            $serie_data[] = array('name' => 'ABIERTO', 'data' => $abierto);
            $serie_data[] = array('name' => 'CERRADO', 'data' => $cerrado);

	$db->close();

        $this->view_data['anios'] = $anios;
        $this->view_data['caterorias'] = json_encode($categorias);
        $this->view_data['serie_data'] = json_encode($serie_data, JSON_NUMERIC_CHECK);
	//$this->load->view('view_casos_1', $this->view_data);
        
        
        $this->view_data['view_name'] = "view_casos_1";
        $this->view_data['menu'] = "casos";
        $this->load->view('output', $this->view_data);
         
	}
        public function casos_2($anio,$estatus)
	{
            
            
            //$anio=$this->input->post('anio');
            //$estatus=  strtoupper($this->input->post('estatus'));
            //$anio=2014;
            //$estatus="ABIERTO";
            
            //echo "$anio/$estatus";die();
            
            $db=$this->load->database('siev',TRUE);
$sql="SELECT 
            org_filial,
            org_region,
            COUNT(DISTINCT inv_codigo_investigacion) AS casos
            FROM stagin_investigaciones_casos_abiertas_detalle
            WHERE 
            inv_estatus = '$estatus'
            AND extract('year' FROM stagin_investigaciones_casos_abiertas_detalle.inv_fecha_creacion) = $anio
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
	    $db->close();
            $this->view_data['anio'] = $anio;
            $this->view_data['estatus'] = $estatus;
            $this->view_data['datos'] = $datos;
            //$this->load->view('view_casos_2', $this->view_data);
            
            $this->view_data['view_name'] = "view_casos_2";
            $this->view_data['menu'] = "casos";
            $this->load->view('output', $this->view_data);

	}
        public function casos_3(){
          
            
            $filial=  strtoupper($this->input->post('filial'));
            $region=  strtoupper($this->input->post('region'));
            $anio=  strtoupper($this->input->post('anio'));
            $estatus=  strtoupper($this->input->post('estatus'));
            $db=$this->load->database('siev',TRUE);

            $sql = "SELECT distinct
  stagin_investigaciones_casos_abiertas_detalle.inv_codigo_investigacion,
  /*CASE WHEN bien_afectado_desc_1era_clase IS NULL THEN '**NO INDICA**'
            
            ELSE UPPER(bien_afectado_desc_1era_clase)
       END AS bien_afectado,*/ 
  stagin_investigaciones_casos_abiertas_detalle.inv_indicador_usuario, 
  UPPER(stagin_investigaciones_casos_abiertas_detalle.inv_cargo_usuario) AS inv_cargo_usuario, 
  trim(substring(stagin_investigaciones_casos_abiertas_detalle.inv_descripcion from 0 for 100)) AS inv_descripcion, 
  stagin_investigaciones_casos_abiertas_detalle.inv_fecha_creacion
FROM 
  public.stagin_investigaciones_casos_abiertas_detalle
WHERE 

stagin_investigaciones_casos_abiertas_detalle.inv_estatus = '$estatus' AND
  stagin_investigaciones_casos_abiertas_detalle.org_filial = '$filial' AND 
  stagin_investigaciones_casos_abiertas_detalle.org_region = '$region' 
      AND extract('year' FROM stagin_investigaciones_casos_abiertas_detalle.inv_fecha_creacion) = $anio
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
                $this->view_data['datos'] = $datos;
                $this->load->view('view_casos_3', $this->view_data);
        }
        


  public function casos_4($codigo){
            
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
            trim(bien_afectado_desc_bienes) as bien_afectado_desc_bienes, bien_afectado_cantidad, trim(bien_afectado_observaciones) as bien_afectado_observaciones, 
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
  public function casos_6(){
            
 $db=$this->load->database('siev',TRUE);
            
            $query = $db->query("SELECT org_filial, count(distinct inv_codigo_investigacion) AS casos
  FROM stagin_investigaciones_casos_abiertas_detalle
  GROUP BY org_filial
");
  /*
   ['Shanghai', 23.7],
                ['Lagos', 16.1],
                ['Instanbul', 14.2],
   */
$i=0;
$serie_data = "";
    foreach ($query->result_array() as $row)
    {
        
       $serie_data .= "['".$row['org_filial']."',".$row['casos']."],\n";
       
        $i++;
    }
 
$query->free_result();
$db->close();

        $this->view_data['serie_data'] = $serie_data;
	$this->load->view('view_casos_6', $this->view_data);
            //$this->load->view('view_casos_6');

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
