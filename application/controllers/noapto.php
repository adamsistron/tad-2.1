<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noapto extends CI_Controller {

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
            
            //$this->load->view('menu');
            
            redirect(base_url('/noapto/noaptos/'), 'refresh');
	}
        
        public function noaptos()
	{
            
            $db=$this->load->database('noapto',TRUE);
            
            $query = $db->query("SELECT a, count FROM vista_noapto_count");

            
            $lenel = '';
            $nomina = '';
            $lenel_nomina = "";
            $estatus_ant = "";

    foreach ($query->result_array() as $row)
    {
        
       
        if($row['a'] == 'LENEL'){
            $lenel[] = $row['count'];
        }
        if($row['a'] == 'NOMINA'){
            $nomina[] = $row['count'];
        }
        if($row['a'] == 'LENEL+NOMINA'){
            $lenel_nomina[] = $row['count'];
        }
        $estatus_ant = $row['a'];
        

    }
            $serie_data[] = array('name' => 'LENEL', 'data' => $lenel);
            $serie_data[] = array('name' => 'NOMINA', 'data' => $nomina);
            $serie_data[] = array('name' => 'LENEL_NOMINA', 'data' => $lenel_nomina);


        $this->view_data['serie_data'] = json_encode($serie_data, JSON_NUMERIC_CHECK);
	//$this->load->view('view_noapto_1', $this->view_data);
        
        $this->view_data['view_name'] = "view_noapto_1";
        $this->view_data['menu'] = "noapto";
        $this->load->view('output', $this->view_data);
         
	}
        public function nomina_lenel($sistema)
        //public function nomina_lenel($anio,$estatus)
	{
            
//echo $sistema; die();
            
            if($sistema=='LENEL'){
                $sql="SELECT 
                        siev_noapto_distinct.filial, 
                        siev_noapto_distinct.region, 
                        COUNT(siev_noapto_distinct.cedula) AS cantidad
                      FROM 
                        public.lenel_noaptos_distinct, 
                        public.siev_noapto_distinct
                      WHERE 
                        lenel_noaptos_distinct.cedula_siev = siev_noapto_distinct.cedula
                      GROUP BY filial, region
                      ORDER BY 3 DESC

            ";
            }
            if($sistema=='NOMINA'){
                $sql="SELECT 
                        siev_noapto_distinct.filial, 
                        siev_noapto_distinct.region, 
                        COUNT(siev_noapto_distinct.cedula) AS cantidad
                      FROM 
                        public.nomina_noaptos_distinct, 
                        public.siev_noapto_distinct
                      WHERE 
                        nomina_noaptos_distinct.cedula_siev = siev_noapto_distinct.cedula
                      GROUP BY filial, region
                      ORDER BY 3 DESC
            ";
            }
            if($sistema=='LENEL_NOMINA'){
                $sql="SELECT 
                        siev_noapto_distinct.filial, 
                        siev_noapto_distinct.region, 
                        COUNT(siev_noapto_distinct.cedula) AS cantidad
                      FROM 
                        public.siev_noapto_distinct, 
                        public.siev_lenel_nomina
                      WHERE 
                        siev_lenel_nomina.cedula_siev_nomina = siev_noapto_distinct.cedula
                      GROUP BY filial, region
                      ORDER BY 3 DESC 
            ";
            }
            
            $db=$this->load->database('noapto',TRUE);

            $query = $db->query($sql);
            //echo $query;
            $datos = "";
            foreach ($query->result_array() as $row)
            {
            $nomina_tipo_nomina = $row['filial'];
            $nomina_departamento = $row['region'];
            $cantidad = $row['cantidad'];
            
                       
            $datos .= "$nomina_tipo_nomina*$nomina_departamento\t$cantidad%\n";
            }
            
            $db->close();
            
            $this->view_data['sistema'] = $sistema;
            $this->view_data['datos'] = $datos;
            //$this->load->view('view_noapto_2', $this->view_data);
            
            $this->view_data['view_name'] = "view_noapto_2";
            $this->view_data['menu'] = "noapto";
            $this->load->view('output', $this->view_data);
            
            

	}
        public function casos_3(){
          
            
            $filial=  strtoupper($this->input->post('filial'));
            $region=  strtoupper($this->input->post('region'));
            $sistema=  strtoupper($this->input->post('sistema'));
            $db=$this->load->database('noapto',TRUE);
            
            //echo $sistema;die();
            
            $complemento1="";
            $complemento2="";
            
            if($sistema=="LENEL"){
                $sql = "SELECT 
                        siev_noapto_distinct.cedula AS a, 
                        TRIM(lenel.nombre||' '||lenel.apellido) AS b, 
                        lenel.carnet AS c, 
                        lenel.tipo_trabajador AS d, 
                        lenel.region||' / '||lenel.localidad AS f
                      FROM 
                        public.lenel, 
                        public.siev_noapto_distinct
                      WHERE 
                        siev_noapto_distinct.cedula = lenel.cedula AND
                        siev_noapto_distinct.filial = '$filial' AND 
                        siev_noapto_distinct.region = '$region';";
                
                
                    $complemento1="N° Carnet";
                    $complemento2="Tipo Trabajador";
                
            }
            if($sistema=="LENEL_NOMINA"){
                $sql="SELECT 
  siev_noapto_distinct.cedula AS a, 
  siev_noapto_distinct.nombre||' / '||siev_noapto_distinct.apellido AS b, 
  lenel.carnet||' /'||lenel.tipo_trabajador AS c, 
  nomina.numero_persona||' /'||nomina.posicion AS d, 
  siev_noapto_distinct.distrito||' /'||siev_noapto_distinct.localidad AS f
FROM 
  public.siev_lenel_nomina, 
  public.nomina, 
  public.lenel, 
  public.siev_noapto_distinct
WHERE 
  siev_lenel_nomina.cedula_siev_lenel = lenel.cedula AND
  siev_lenel_nomina.cedula_siev_nomina = nomina.ci AND
  siev_lenel_nomina.cedula_siev_lenel = siev_noapto_distinct.cedula AND
  siev_noapto_distinct.filial = '$filial' AND 
  siev_noapto_distinct.region = '$region';";
                
                $complemento1="N° Carnet / Tipo Trabajador";//c
                $complemento2="N° Persona / Posición";//d
                
            }
            if($sistema=="NOMINA"){
                $sql="SELECT 
                        siev_noapto_distinct.cedula AS a, 
                        nomina.nombre_apellido AS b, 
                        nomina.sociedad||' / '||nomina.division||' / '||nomina.division_personal||' / '||nomina.sub_division_personal AS f, 
                        nomina.ambiente_sap||' / '||nomina.grupo_personal||' / '||nomina.area_personal||' / '||nomina.posicion AS c, 
                        nomina.fecha_ippcn||' / '||nomina.fecha_emblema AS d
                      FROM 
                        public.siev_noapto_distinct, 
                        public.nomina
                      WHERE 
                        siev_noapto_distinct.cedula = nomina.ci AND
                      siev_noapto_distinct.filial = '$filial' AND 
                      siev_noapto_distinct.region = '$region';";
                
                $complemento1="SAP / Grupo / Area / Posición";//c
                $complemento2="Fecha IPPCN / Fecha Emblema";//d
            }
            
            //echo $sql;die();
            $query = $db->query($sql);
            
            
            
            //print_r($q);die();
            $datos=array();
		foreach ($query->result_array() as $row){
			$datos[] = $row;

		}
		$query->free_result();
		$db->close();

                $this->view_data['sistema'] = $sistema;
                $this->view_data['datos'] = $datos;

                $this->view_data['complemento1'] = $complemento1;
                $this->view_data['complemento2'] = $complemento2;
                $this->load->view('view_noapto_3', $this->view_data);
        }
        


  

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
