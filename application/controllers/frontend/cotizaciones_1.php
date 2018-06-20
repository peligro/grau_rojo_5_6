<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cotizaciones extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
      $this->layout->setLayout('backend');
      $this->load->model('acabados_model');
      $this->load->model('cotizaciones_model');
      $this->load->model('auditorias_model');
      $this->load->model('procesosespeciales_model');
    }
    
       
    
	public function obtenerclientes()
	{
		$datos=$this->clientes_model->getClientesAll();	
		//var_dump($datos);
		
		header('Content-Type: application/json');
	
		echo json_encode($datos->result());
	//echo json_encode( $datos->result_object("array") );
		
		//$this->layout->view('grillamoldes',compact('datos'));	   
	}

	public function moldesgrau()
	{
		$datos=$this->acabados_model->getMoldes();	
	
		header('Content-Type: application/json');
		echo json_encode($datos->result());
		//echo json_encode( $datos->result_object("array") );
		
		//$this->layout->view('grillamoldes',compact('datos'));	   
	}
	
     public function index2()
	{
        if($this->session->userdata('id'))
        {
          
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3); 
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
			
			if($this->session->userdata('perfil')!= 2)
			{
				$datos=$this->cotizaciones_model->getCotizacionesPaginacion($pagina,$porpagina,"limit");		 
//				$cuantos=$this->cotizaciones_model->getCotizacionesPaginacion($pagina,$porpagina,"cuantos");
			}
			
			if($this->session->userdata('perfil')== 2)
			{
				$datos=$this->cotizaciones_model->getCotizacionesPorVendedorPaginacion($pagina,$porpagina,"limit");		 
			//	$cuantos=$this->cotizaciones_model->getCotizacionesPorVendedorPaginacion($pagina,$porpagina,"cuantos");
			}

			
        $config['base_url'] = base_url().'cotizaciones/index';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
             
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
           $this->layout->view('index',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
     public function index()
	{
        if($this->session->userdata('id'))
        {
          
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
			
			if($this->session->userdata('perfil')!= 2)
			{
				$datos=$this->cotizaciones_model->getCotizacionesPaginacion2($pagina,$porpagina,"limit");		 
				$cuantos=$this->cotizaciones_model->getCotizacionesPaginacion2($pagina,$porpagina,"cuantos");
			}
			
			if($this->session->userdata('perfil')== 2)
			{
				$datos=$this->cotizaciones_model->getCotizacionesPorVendedorPaginacion($pagina,$porpagina,"limit");		 
			//	$cuantos=$this->cotizaciones_model->getCotizacionesPorVendedorPaginacion($pagina,$porpagina,"cuantos");
			}

			
        $config['base_url'] = base_url().'cotizaciones/index';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
                         
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
           $this->layout->view('index2',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function solicitan_muestra_estado($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getSolicitaMuestraPorId($id);
            $coti=$this->cotizaciones_model->getCotizacionPorId($datos->id_cotizacion);
            $user=$this->usuarios_model->getUsuariosPorId($coti->id_vendedor);
            if(sizeof($datos)==0){show_404();}
            $data=array
            (
                'estado'=>'1',
                'quien'=>$this->session->userdata('id'),
                'cuando'=>date("Y-m-d"),
            );
            $this->db->where('id', $id);
            $this->db->update("solicita_muestra",$data);
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
            $this->email->to($user->correo); 
            $this->email->subject('Mensaje de Cartonajes Grau');
            $html='';
            $html.='<h2>Nuevo Mensaje:</h2>';
            $html.='Estimado '.$user->nombre.'  ha sido liberada la solicitud de muestra de la cotización N° '.$coti->id.' ';
            $this->email->message($html);   
            $this->email->send();
            $this->session->set_flashdata('ControllerMessage', 'Se ha liberado exitosamente y se ha enviado un mail al vendedor <strong>'.$user->nombre.'</strong> .');
            redirect(base_url()."cotizaciones/solicitan_muestra/".$pagina,  301); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
    
    public function oc($idc)
    {
         if($this->session->userdata('id'))
        { 
             //Arrays de datos para la vista
             $id=$idc;
             $correlativo="0";
             $orden_compra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
             $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
             $datos=$this->cotizaciones_model->getCotizacionPorId($id);
             $cantidad=$datos->cantidad_1;             
             $folia1_ps=$fotomecanica->folia1_proceso_seletec;             
             $folia2_ps=$fotomecanica->folia2_proceso_seletec;             
             $folia3_ps=$fotomecanica->folia3_proceso_seletec;             
             $cuno1_ps=$fotomecanica->cuno1_proceso_seletec;             
             $cuno2_ps=$fotomecanica->cuno2_proceso_seletec;             
             /************************************************/
             $folia1=$this->procesosespeciales_model->getDetalleProcesosPorId($folia1_ps);
             $folia2=$this->procesosespeciales_model->getDetalleProcesosPorId($folia2_ps);
             $folia3=$this->procesosespeciales_model->getDetalleProcesosPorId($folia3_ps);
             $cuno1=$this->procesosespeciales_model->getDetalleProcesosPorId($cuno1_ps);
             $cuno2=$this->procesosespeciales_model->getDetalleProcesosPorId($cuno2_ps);
             
             /************************************************/
             $fv1=$fotomecanica->procesos_especiales_folia_valor;
             $fv2=$fotomecanica->procesos_especiales_folia_2_valor;
             $fv3=$fotomecanica->procesos_especiales_folia_3_valor;
             $cv1=$fotomecanica->procesos_especiales_cuno_valor;
             $cv2=$fotomecanica->procesos_especiales_cuno_2_valor;
             
             $mfolia1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_molde_selected);
             $mfolia2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_molde_selected);
             $mfolia3=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_molde_selected);
             $mcuno1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_molde_selected);
             $mcuno2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_molde_selected);
             
             //valores de procesos especiales (Folia y cuno)
             $tesp1=$fotomecanica->folia1_proceso_seletec;
             $tesp2=$fotomecanica->folia2_proceso_seletec;
             $tesp3=$fotomecanica->folia3_proceso_seletec;
             $tesp4=$fotomecanica->cuno1_proceso_seletec;
             $tesp5=$fotomecanica->cuno2_proceso_seletec;
             $tesp6=$fotomecanica->folia1_molde_selected;
             $tesp7=$fotomecanica->folia2_molde_selected;
             $tesp8=$fotomecanica->folia3_molde_selected;
             $tesp9=$fotomecanica->cuno1_molde_selected;
             $tesp10=$fotomecanica->cuno2_molde_selected;
             
             $prov = json_decode($orden_compra->proveedores);
//             echo "<pre>";
//             print_r($prov);echo "</pre>";//exit();
             //contabilizo variable cantidad de procesos especiales
             if($tesp1!=0){ 
                 $procesosespeciales++; 
                 //$proveedor1=$this->proveedores_model->getProveedoresTodoPorId($prov->nfolia1);} 
                 $proveedor1=$this->proveedores_model->getProveedoresPorNombreClave($prov->folia1->pfolia1);} 
                   
             if($tesp2!=0){ 
                 $procesosespeciales++; 
                 $proveedor2=$this->proveedores_model->getProveedoresPorNombreClave($prov->folia2->pfolia2);} 
             if($tesp3!=0){ 
                 $procesosespeciales++; 
                 $proveedor3=$this->proveedores_model->getProveedoresPorNombreClave($prov->folia3->pfolia3);} 
             if($tesp4!=0){ 
                 $procesosespeciales++;  
                 $proveedor4=$this->proveedores_model->getProveedoresPorNombreClave($prov->cuno1->pcuno1);} 
             if($tesp5!=0){ 
                 $procesosespeciales++;  
                 $proveedor5=$this->proveedores_model->getProveedoresPorNombreClave($prov->cuno2->pcuno2);} 
             if($tesp6!=0){ 
                 $procesosespeciales++;  
                 $proveedor6=$this->proveedores_model->getProveedoresPorNombreClave($prov->cffolia1->mpfolia1);} 
             if($tesp7!=0){ 
                 $procesosespeciales++;  
                 $proveedor7=$this->proveedores_model->getProveedoresPorNombreClave($prov->cffolia2->mpfolia2);} 
             if($tesp8!=0){ 
                 $procesosespeciales++;  
                 $proveedor8=$this->proveedores_model->getProveedoresPorNombreClave($prov->cffolia3->mpfolia3);} 
             if($tesp9!=0){ 
                 $procesosespeciales++;  
                 $proveedor9=$this->proveedores_model->getProveedoresPorNombreClave($prov->cfcuno1->mpcuno1);} 
             if($tesp10!=0){ 
                 $procesosespeciales++;  
                 $proveedor10=$this->proveedores_model->getProveedoresPorNombreClave($prov->cfcuno2->mpcuno2);} 
            
                function array_oc($p,$folia,$proveedor,$datos,$procesosespeciales,$correlativo){
                $precio=$folia->costo_compra;
                if($folia->codigo==111 || $folia->codigo==113){
                $descripcion=$folia->caracteristicas." (Monto Fijo)";
                $total=$precio;
                $total=$folia->costo_compra;    
                }else{
                $descripcion=$folia->caracteristicas;
                $total=$datos->cantidad_1*$precio;
                //$total=$folia->costo_compra*$cantidad;       
                }
                $contacto=$proveedor->contacto;
                $codigo=$folia->codigo;
                $razon=$proveedor->nombre;
                $formapago=$proveedor->forma_pago;
                $direccion="Santiago";
                $ciudad="Santiago";
                $telefono=$proveedor->telefono;
                $cuenta=$proveedor->num_cuenta;
                $correo=$proveedor->correo;
                $tipocuenta=$proveedor->tipo_cuenta;
                if($tipocuenta==1){$tipocuenta="Cuenta Corriente";}
                if($tipocuenta==2){$tipocuenta="Cuenta Vista";}
                if($tipocuenta==3){$tipocuenta="Cuenta Rut";}
                if($tipocuenta==4){$tipocuenta="Cuenta Ahorro";}

                    $data = array(
                        'descripcion'=>$descripcion,
                        'contacto'=>$contacto,
                        'codigo'=>$codigo,
                        'precio'=>$precio,
                        'total'=>$total,
                        'razon'=>$razon,
                        'formapago'=>$formapago,
                        'direccion'=>$direccion,
                        'ciudad'=>$ciudad,
                        'telefono'=>$telefono,
                        'cuenta'=>$cuenta,
                        'correo'=>$correo,
                        'tipocuenta'=>$tipocuenta,
                        'cantidad'=>$datos->cantidad_1,
                        'cotizacion'=>$datos->id,
                        'grupo'=>$procesosespeciales,
                        'correlativo'=>$correlativo,
                    );

                    return $data;
                }
                
//                $var = array_oc(1,$cuno2, $proveedor5, $datos, $procesosespeciales,$correlativo);
//              $prov = print_r($cuno2);
//             echo "<pre>";
               //print_r($data);exit();
             //fin de datos para la vista
             $this->load->library('mPDF');
             $css= file_get_contents('public/frontend/css/oc.css');
             
             $this->mPDF->pdf = new mPDF();
             if($tesp1!=0){  
             $correlativo++;
             $var = array_oc(1,$folia1, $proveedor1, $datos, $procesosespeciales,$correlativo);
             //print_r($var);exit();
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);
             }
             if($tesp2!=0){
             $correlativo++;
             $var = array_oc(1,$folia2, $proveedor2, $datos, $procesosespeciales,$correlativo);
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);  
             }
             if($tesp3!=0){
             $correlativo++;
             $var = array_oc(1,$folia3, $proveedor3, $datos, $procesosespeciales,$correlativo);
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);  
             }
             if($tesp4!=0){
             $correlativo++;
             $var = array_oc(1,$cuno1, $proveedor4, $datos, $procesosespeciales,$correlativo);
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);    
             }
             if($tesp5!=0){
             $correlativo++;
             $var = array_oc(1,$cuno2, $proveedor5, $datos, $procesosespeciales,$correlativo);
            // print_r($prov);echo "</pre>";exit();
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);      
             }
             if($tesp6!=0){
             $correlativo++;
             $var = array_oc(1,$mfolia1, $proveedor6, $datos, $procesosespeciales,$correlativo);
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);      
             }
             if($tesp7!=0){
             $correlativo++;
             $var = array_oc(1,$mfolia2, $proveedor7, $datos, $procesosespeciales,$correlativo);
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);      
             }
             if($tesp8!=0){
             $correlativo++;
             $var = array_oc(1,$mfolia3, $proveedor8, $datos, $procesosespeciales,$correlativo);
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);      
             }
             if($tesp9!=0){
             $correlativo++;
             $var = array_oc(1,$mcuno1, $proveedor9, $datos, $procesosespeciales,$correlativo);
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);      
             }
             if($tesp10!=0){
             $correlativo++;
             $var = array_oc(1,$mcuno2, $proveedor10, $datos, $procesosespeciales,$correlativo);
             $html=$this->load->view('frontend/cotizaciones/oc_trabajosespeciales', compact('var'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);      
             }
             if($procesosespeciales<=0){
             $this->session->set_flashdata('ControllerMessage', 'Esta orden no posee trabajos especiales.');
             redirect(base_url().'cotizaciones/orden_de_compra/'.$idc,  301);
             }else{    
             $this->mPDF->pdf->Output();
             }
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
        
	}
    public function solicitan_muestra()
    {
        if($this->session->userdata('id'))
        {
              if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
            $datos=$this->cotizaciones_model->getCotizacionesSolicitanMuestraPaginacion($pagina,$porpagina,"limit");
            $cuantos=$this->cotizaciones_model->getCotizacionesSolicitanMuestraPaginacion($pagina,$porpagina,"cuantos");
            $config['base_url'] = base_url().'cotizaciones/solicitan_muestra';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
             
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
           $this->layout->view('solicitan_muestra',compact('datos','cuantos','pagina')); 
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function buscar()
	{
        if($this->session->userdata('id'))
        { 
             $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 
            $clientes=$this->clientes_model->getClientesNormal();
            $this->layout->view('buscar',compact('clientes')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function buscar2()
	{
         if($this->session->userdata('id'))
        { 
             $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 
            $clientes=$this->clientes_model->getClientesNormal();
            $this->layout->view('buscar2',compact('clientes')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
        
	}
    public function buscar2_respuesta()
	{
        if($this->session->userdata('id'))
        { 
             if ( $this->input->post() )
             {
                $this->session->set_userdata('cliente', $this->input->post('cliente',true));
                $this->session->set_userdata('condicion_del_producto', $this->input->post('condicion_del_producto',true));
                $this->session->set_userdata('buscar', $this->input->post('buscar',true));
                $this->session->set_userdata('buscar2', $this->input->post('buscar2',true));
                $this->session->set_userdata('buscar3', $this->input->post('buscar3',true));
                $this->session->set_userdata('buscar4', $this->input->post('buscar4',true));
				$this->session->set_userdata('buscar5', $this->input->post('buscar5',true));
                $this->session->set_userdata('que_buscar', $this->input->post("que_buscar",true));
                $id= $this->session->userdata('cliente');
                $condicion_del_producto= $this->session->userdata('condicion_del_producto');
                $buscar= $this->session->userdata('buscar');
                $buscar2= $this->session->userdata('buscar2');
                $buscar3= $this->session->userdata('buscar3');
                $buscar4= $this->session->userdata('buscar4');
				$buscar5= $this->session->userdata('buscar5');
                $que_buscar=$this->session->userdata('que_buscar');
             }else
             {
                $id= $this->session->userdata('cliente');
                $condicion_del_producto= $this->session->userdata('condicion_del_producto');
                $buscar= $this->session->userdata('buscar');
                $buscar2= $this->session->userdata('buscar2');
                $buscar3= $this->session->userdata('buscar3');
                $buscar4= $this->session->userdata('buscar4');
				$buscar5= $this->session->userdata('buscar5');
                $que_buscar=$this->session->userdata('que_buscar');
             }
             //print_r($_POST);exit;
             //echo $condicion_del_producto;exit;
             switch($condicion_del_producto)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
									
                               }
             $cliente=$this->clientes_model->getClientePorId($id);
             //if(sizeof($cliente)==0){show_404();}
             if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
            //echo $this->input->post("que_buscar",true);exit;
            switch($que_buscar)
            {
                case '1':
                
                     $datos=$this->cotizaciones_model->getCotizacionesBuscarPaginacion($pagina,$porpagina,"limit",$id,$condicion,$buscar);
                     $cuantos=$this->cotizaciones_model->getCotizacionesBuscarPaginacion($pagina,$porpagina,"cuantos",$id,$condicion,$buscar);
                break;
                case '2':
                
                     $datos=$this->cotizaciones_model->getCotizacionesBuscarPorNumeroOidAntiguoPaginacion($pagina,$porpagina,"limit",$id,$condicion,$buscar2);
                     $cuantos=$this->cotizaciones_model->getCotizacionesBuscarPorNumeroOidAntiguoPaginacion($pagina,$porpagina,"cuantos",$id,$condicion,$buscar2);
                break;
                case '3':
                
                     $datos=$this->orden_model->getOrdenesRelacionadasConCotizacionPorIdBuscar($pagina,$porpagina,"limit",$buscar3);
                     $cuantos=$this->orden_model->getOrdenesRelacionadasConCotizacionPorIdBuscar($pagina,$porpagina,"cuantos",$buscar3);
                break;
				case '4':
                     $datos=$this->cotizaciones_model->getCotizacionesPorMoldeNumero($pagina,$porpagina,"limit",$id,$buscar4,$condicion);
                     $cuantos=$this->cotizaciones_model->getCotizacionesPorMoldeNumero($pagina,$porpagina,"cuantos",$id,$buscar4,$condicion);
                break;
				case '5':
                      $datos=  $this->cotizaciones_model->getCotizacionesPorMolde($pagina,$porpagina,"limit",$id,$buscar5,$condicion);
                      $cuantos=$this->cotizaciones_model->getCotizacionesPorMolde($pagina,$porpagina,"cuantos",$id,$buscar5,$condicion);
                break;
            }
      // print_r($datos);exit;
        $config['base_url'] = base_url().'cotizaciones/buscar2_respuesta/';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
             $this->layout->view('buscar2_respuesta',compact('cliente','datos','pagina','cuantos','que_buscar')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function estado($id=null,$pagina=null)
    {
         if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            $user=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
            if(sizeof($datos)==0){show_404();}
            if($this->input->post())
            {
                if($this->form_validation->run('estado_cotizacion'))
                {
                      $data=array
                          (
                            "estado"=>$this->input->post('estado',true),
                            "glosa"=>$this->input->post('glosa',true),
                            "quien_autoriza"=>$this->session->userdata('id'),
                            "fecha_autoriza"=>date("Y-m-d"),
                          );  
                        $this->db->where('id', $id);
                        $this->db->update("cotizaciones",$data);
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                        $this->email->to($user->correo); 
                        $this->email->subject('Mensaje de Cartonajes Grau');
                        $html='';
                        $html.='<h2>Nuevo Mensaje:</h2>';
                        $html.='Estimado '.$user->nombre.'  ha sido liberada la solicitud de cotización N° '.$id.' por '.$this->session->userdata('nombre').' , quién dejó la siguiente glosa : <br /><br />'.$this->input->post('glosa',true).' ';
                        $this->email->message($html);   
                        //echo $html;exit;
                        $this->email->send();
                   
                    $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.'.  $checks);
                    redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301);
                }
            }
            $this->layout->js
            (
                array
                (
                   
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                )
            );    
            
            $this->layout->view('estado',compact('id','datos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
     public function buscar2_respuesta2($id=null,$pagina=null)
    {
          if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            if(sizeof($datos)==0){show_404();}
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $cliente=$this->clientes_model->getClientePorId($datos->id_cliente);
			
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_cotizacion') )
    			         {
    			              
                            
                               //die("aa ".$acepta_excedentes);
                               if(isset($_POST["hacer_cromalin"]))
                               {
                                 $hacer_cromalin="SI";
                               }else
                               {
                                 $hacer_cromalin="NO";
                               }
                                
                               $producto=$this->input->post("producto",true);
                               if($producto==2000)
                               {
                                  $producto=$this->input->post("producto2",true);
                               }else
                               {
                                 $producto=$producto;
                               }
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista";
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                    break;
                               }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
                               }
                               if($this->input->post("can2",true)==0)
                               {
                                 $cantidad_2=1;
                               }else
                               {
                                 $cantidad_2=$this->input->post("can2",true);
                               }
                               if($this->input->post("can3",true)==0)
                               {
                                 $cantidad_3=1;
                               }else
                               {
                                 $cantidad_3=$this->input->post("can3",true);
                               }
                               if($this->input->post("can4",true)==0)
                               {
                                 $cantidad_4=1;
                               }else
                               {
                                 $cantidad_4=$this->input->post("can4",true);
                               }
                               
                               
                               $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "nombre_cliente"=>$this->input->post("nombre_cliente",true),
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>$this->input->post("can1",true),
                                    "cantidad_2"=>$cantidad_2,
                                    "cantidad_3"=>$cantidad_3,
                                    "cantidad_4"=>$cantidad_4,
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
                                    "precio_1"=>100,
                                    "precio_2"=>100,
                                    "precio_3"=>100,
                                    "precio_4"=>100,
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$this->input->post("materialidad_1",true),
                                    "materialidad_2"=>$this->input->post("materialidad_2",true),
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "cantidad_especifica_sino"=>$this->input->post("cantidad_especifica_sino",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$this->input->post("cliente_entrega",true),
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>"2",
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
									"id_antiguo"=>$this->input->post("id_antiguo",true),
                                    "detalle_cambios"=>$this->input->post("detalle_cambios",true),
									"detalle_de_muestra"=>$this->input->post("detalle_de_muestra",true),
                                    "estan_los_moldes"=>$this->input->post("estan_los_moldes",true),
                                    "numero_molde"=>$this->input->post("molde",true),
                                 );
                               
//                                                                   "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
//                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    $guardar=$this->cotizaciones_model->insertar($data);
                                    //creo fotomecanica
                                    $dataFotomecanica=array
                                    (
                                        "id_usuario"=>$this->session->userdata('id'),
                                        "id_cotizacion"=>$this->input->post("id",true),
                                        "condicion_del_producto"=>$fotomecanica->condicion_del_producto,
                                        "estan_las_peliculas"=>$fotomecanica->estan_las_peliculas,
                                        "estan_los_moldes"=>$fotomecanica->estan_los_moldes,
                                        "numero_molde"=>$fotomecanica->numero_molde,
                                        "colores"=>$fotomecanica->colores,
                                        "colores_metalicos"=>$fotomecanica->colores_metalicos,
                                        "acabado_impresion_1"=>$fotomecanica->acabado_impresion_1,
                                        "acabado_impresion_2"=>$fotomecanica->acabado_impresion_2,
                                        "acabado_impresion_3"=>$fotomecanica->acabado_impresion_3,
                                        "acabado_impresion_4"=>$fotomecanica->acabado_impresion_4,
                                        "acabado_impresion_5"=>$fotomecanica->acabado_impresion_5,
                                        "acabado_impresion_6"=>$fotomecanica->acabado_impresion_6,
                                        "reserva_barniz"=>$fotomecanica->reserva_barniz,
                                        "tamano_caja_corrugado"=>$fotomecanica->tamano_caja_corrugado,
                                        "comentarios"=>$fotomecanica->comentarios,
                                        "fecha"=>date("Y-m-d"),
                                        "desctec"=>$fotomecanica->desctec,
                                        "archivo"=>$fotomecanica->archivo,
                                        "materialidad_datos_tecnicos"=>$fotomecanica->materialidad_datos_tecnicos,
                                        "materialidad_eleccion"=>$fotomecanica->materialidad_eleccion,
                                        "materialidad_1"=>$fotomecanica->materialidad_1,
                                        "materialidad_2"=>$fotomecanica->materialidad_2,
                                        "materialidad_3"=>$fotomecanica->materialidad_2,
                                        "materialidad_4"=>$fotomecanica->materialidad_2,
                                        "estado"=>$fotomecanica->estado,
										"procesos_especiales_folia"=>$fotomecanica->procesos_especiales_folia,
                                        "procesos_especiales_folia_valor"=>$fotomecanica->procesos_especiales_folia_valor,
                                        "procesos_especiales_folia_2"=>$fotomecanica->procesos_especiales_folia_2,
                                        "procesos_especiales_folia_2_valor"=>$fotomecanica->procesos_especiales_folia_2_valor,
                                        "procesos_especiales_folia_3"=>$fotomecanica->procesos_especiales_folia_3,
                                        "procesos_especiales_folia_3_valor"=>$fotomecanica->procesos_especiales_folia_3_valor,
                                        "procesos_especiales_cuno"=>$fotomecanica->procesos_especiales_cuno,
                                        "procesos_especiales_cuno_valor"=>$fotomecanica->procesos_especiales_cuno_valor,
                                        "procesos_especiales_cuno_2"=>$fotomecanica->procesos_especiales_cuno_2,
                                        "procesos_especiales_cuno_2_valor"=>$fotomecanica->procesos_especiales_cuno_2_valor,
                                        "quien"=>$fotomecanica->quien,
                                        "cuando"=>$fotomecanica->cuando,
                                        "glosa"=>$fotomecanica->glosa,
                                        "impresion"=>$fotomecanica->impresion,
                                        );
                                        $this->cotizaciones_model->insertarFotomecanica($dataFotomecanica);
                                    //creo ingeniería
                                    
                                         $dataIngenieria=array
                                      (
                                         "id_usuario"=>$this->session->userdata('id'),
                                         "id_cotizacion"=>$this->input->post("id",true),
                                         "producto"=>$ing->producto,
                                         "medidas_de_la_caja"=>$ing->medidas_de_la_caja,
                                         "medidas_de_la_caja_2"=>$ing->medidas_de_la_caja_2,
                                         "medidas_de_la_caja_3"=>$ing->medidas_de_la_caja_3,
                                         "medidas_de_la_caja_4"=>$ing->medidas_de_la_caja_4,
                                         "unidades_por_pliego"=>$ing->unidades_por_pliego,
                                         "hacer_troquel"=>$ing->hacer_troquel,
                                         "lleva_troquelado"=>$ing->lleva_troquelado,
                                         "piezas_totales_en_el_pliego"=>$ing->piezas_totales_en_el_pliego,
                                         "metros_de_cuchillo"=>$ing->metros_de_cuchillo,
                                         "tamano_a_imprimir_1"=>$ing->tamano_a_imprimir_1,
                                         "tamano_a_imprimir_2"=>$ing->tamano_a_imprimir_2,
                                         "tamano_cuchillo_1"=>$ing->tamano_cuchillo_1,
                                         "tamano_cuchillo_2"=>$ing->tamano_cuchillo_2,
                                         "materialidad_datos_tecnicos"=>$ing->materialidad_datos_tecnicos,
                                         "materialidad_eleccion"=>$ing->materialidad_eleccion,
                                         "materialidad_1"=>$ing->materialidad_1,
                                         "materialidad_2"=>$ing->materialidad_2,
                                         "materialidad_3"=>$ing->materialidad_3,
                                         "materialidad_4"=>$ing->materialidad_4,
                                         "piezas_adicionales"=>$ing->piezas_adicionales,
                                         "detalle_piezas_adicionales"=>$ing->detalle_piezas_adicionales,
                                         "tipo_de_pegado"=>$ing->tipo_de_pegado,
                                         "lineas_pegado"=>$ing->lineas_pegado,
                                         "detalle_lineas_pegado"=>$ing->detalle_lineas_pegado,
                                         "es_una_maquina"=>$ing->es_una_maquina,
                                         "impresion_compartida"=>$ing->impresion_compartida,
                                         "contiene_otras_cotizaciones"=>$ing->contiene_otras_cotizaciones,
                                         "numero_cotizacion"=>$ing->numero_cotizacion,
                                         "archivo"=>$ing->archivo,
                                         "fecha"=>date("Y-m-d"),
                                         "trabajos_adicionales"=>$ing->trabajos_adicionales,
                                         "trabajos_adicionales_glosa"=>$ing->trabajos_adicionales_glosa,
                                         "estado"=>$ing->estado,
                                         "estan_los_moldes"=>$ing->estan_los_moldes,
                                         "numero_molde"=>$ing->numero_molde,
                                         "id_adhesivo"=>$ing->id_adhesivo,
                                         "quien"=>$ing->quien,
                                         "cuando"=>$ing->cuando,
                                         "solo_pegado"=>$ing->solo_pegado,
                                         "tamano_pieza_a_empaquetar_ancho"=>$ing->tamano_pieza_a_empaquetar_ancho,
                                         "tamano_pieza_a_empaquetar_largo"=>$ing->tamano_pieza_a_empaquetar_largo,
                                         "glosa"=>$ing->glosa,
                                         "pegado"=>$ing->pegado,
                                         "doblado"=>$ing->doblado,
                                         "empaquetado"=>$ing->empaquetado,
                                         "tipo_pegado"=>$ing->tipo_pegado,
                                         "pegado_puntos"=>$ing->pegado_puntos,
                                         "pegado_cantidad_puntos"=>$ing->pegado_cantidad_puntos,
                                         "tipo_fondo"=>$ing->tipo_fondo,
                                         "lleva_aletas"=>$ing->lleva_aletas,
                                         "total_aplicaciones_adhesivo"=>$ing->total_aplicaciones_adhesivo,
                                      );
                                           $this->cotizaciones_model->insertarIngenieria($dataIngenieria);
                                    
                                    //sigo
                                    $usrId=$this->session->userdata('id');
                                    $dataEstado = array("cotizaciones_id"=>$guardar,"id_estado"=>1,"fecha"=>date("Y-m-d"),"usuarios_id"=>$usrId);
                                    $this->cotizaciones_model->insertarEstadoCotizacion($dataEstado);
                                    
                                    $this->load->library('email');

                                    $this->email->from('sistemagrau@seleccionprofesional.cl', 'Cartonajes Grau');
                                    $this->email->to('ega@grauindus.cl'); 
                                    
                                    //$this->email->cc('otro@otro-ejemplo.com'); 
                                    //$this->email->bcc('ellos@su-ejemplo.com'); 
                                    $ven=$this->vendedores_model->getVendedorPorId($this->input->post("vendedor",true));
                                    $cliente=$this->input->post("cliente",true);
                                    if($cliente==3000)
                                    {
                                        $cli=$this->input->post("nombre_cliente",true);
                                    }else
                                    {
                                        $clienteBD=$this->clientes_model->getClientePorId($cliente);
                                        $cli=$clienteBD->razon_social;
                                    }
                                    $this->email->subject('Se genero Cotizacion Nro '.$guardar);
                                    $msg="Se Generó Cotización para ".$cli." (Vendedor : ".$ven->nombre.")";
                                    $msg.="\n Producto:$producto";
                                    $msg.="\n Condición del Producto:$condicion";
                                    $msg.="\n Cantidad 1:".quitarPuntosNumero($this->input->post("can1",true));
                                    $msg.="\n Cantidad 2:".quitarPuntosNumero($this->input->post("can2",true));
                                    $msg.="\n Cantidad 3:".quitarPuntosNumero($this->input->post("can3",true));
                                    $msg.="\n Cantidad 4:".quitarPuntosNumero($this->input->post("can4",true));
                                   // $msg.="\n\n para mas detalle revise el sistema en http://www.seleccionprofesional.cl/grau";
                                    //echo $msg;exit;
                                    $this->email->message($msg);	

                                    $this->email->send();
                                    
                                    
                              
                              
                                //    $checkInternos['checks'] = $this->input->post("acInternos");
                              //                                    $checks = 1;
								if($_POST['acInternos']!="")
								{
									foreach($_POST['acInternos'] as $check)
									{
										$data = array("cotizaciones_id"=>$guardar,"acabados_id_acabado"=>$check);
										$this->cotizaciones_model->insertarCotizacionesAcabados($data);
									}
								}
								
								$check = "";
									
								if($_POST['acExternos']!="")
								{
									
									foreach($_POST['acExternos'] as $check)
									{
										$data = array("cotizaciones_id"=>$guardar,"acabados_id_acabado"=>$check);
										$this->cotizaciones_model->insertarCotizacionesAcabados($data);
									}
                                }
                            // print_r(substr(implode(', ', $this->input->post('acInternos')), 0));
                                
                            if($guardar>0)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
					           redirect(base_url().'cotizaciones',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'cotizaciones/add',  301);
                            }   
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->vendedores_model->getVendedoresSelect();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            //print_r($internos);exit;
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
           $this->layout->view('buscar2_respuesta2',compact("tipos","vendedores","acInternos","acExternos","internos","externos","pagina","datos","id","cliente","orden","fotomecanica","ing"));          
    }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function agregar()
	{
        if($this->session->userdata('id'))
        { 
             $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 
            $clientes=$this->clientes_model->getClientesNormal();
            $this->layout->view('agregar',compact('clientes')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function searchop()
	{
        if($this->session->userdata('id'))
        { 
            $busqueda=$this->cotizaciones_model->getCotizacionEnRojo($this->input->post("valor",true)); 
          //echo  $busqueda->nombre_producto_normal;
          echo $this->input->post("valor",true);
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
    public function ajax_crear_grupo()
	{
        if($this->session->userdata('id'))
        {
            $data=array();
            $arreglo = $this->input->post("arreglo",true);
            $error_cot=0;
            
            for($i=1;$i<=10;$i++){
                if($arreglo['idc_0'.$i]!=""){
                $datos=$this->cotizaciones_model->getCotizacionPorId($arreglo['idc_0'.$i]);
                if(sizeof($datos)==0){
                    $error_cot.=$error_cot+1;
                    $cot.=$arreglo['idc_0'.$i].',';
                }}
            }
            if($arreglo['idc_10']!=""){
                $datos=$this->cotizaciones_model->getCotizacionPorId($arreglo['idc_10']);
                if(sizeof($datos)==0){
                    $coti=$arreglo['idc_10'];
                    $error_coti.=$error_coti+1;
                }}
            $cot.=$coti;
            $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 

            if($arreglo['cant'] < 2){
                $error=1;
                $mensaje='<span id="span" hidden="true" style="margin-left: 10px;padding-right: 20px; padding-left: 20px; color:white; background-color:red">Debe tener al menos 2 cotizaciones!!</span>';
            } 
            if($arreglo['grupo']==""){
                $error=1;
                $mensaje='<span id="span" hidden="true" style="margin-left: 10px;padding-right: 20px; padding-left: 20px; color:white; background-color:red">Debe colocar el nombre de grupo!!</span>';
            }
            if($error_cot>=1){
                $error=1;
                if($error_cot>1){$texto="Las cotizaciones";$texto2="existen";}else{$texto="La cotizacion";$texto2="existe";}
                $estado=0;
                $mensaje='<span id="span" hidden="true" style="margin-left: 10px;padding-right: 20px; padding-left: 20px; color:white; background-color:red">'.$texto.' '.$cot.' no '.$texto2.'!!</span>';
            }
            
            $estado=1;
            $mensaje_exito='<span id="span" hidden="true" style="margin-left: 10px;padding-right: 20px; padding-left: 20px; color:white; background-color:green">Grupo creado con exito!!</span>';
            
            if($error==1){   
             echo $mensaje;
            }else{
             unset($arreglo['cant']);
             $guardar=$this->grupos_model->insertar($arreglo);
             echo $mensaje_exito;
            }
        }else
        {
            echo "No se pudo crear el grupo!!";
        }       
	}
        
    public function agregar_respuesta()
	{
        if($this->session->userdata('id'))
        { 
             if ( $this->input->post() )
             {
                if ( $this->input->post("tokem",true)==1 )
                {
                     if($this->input->post("cliente",true)==3000)
                       {
                         $valida='ad_cotizacion2';
                       }else
                       {
                         $valida='ad_cotizacion';
                       }
                       if ( $this->form_validation->run($valida) )
    			         {
    			              
                               if(isset($_POST["acepta_excedentes"]))
                               {
                                 $acepta_excedentes="SI";
                               }else
                               {
                                 $acepta_excedentes="NO";
                               }
                               //die("aa ".$acepta_excedentes);
                               if(isset($_POST["hacer_cromalin"]))
                               {
                                 $hacer_cromalin="SI";
                               }else
                               {
                                 $hacer_cromalin="NO";
                               }
                                
                               $producto=$this->input->post("producto",true);
                               if($producto==2000)
                               {
                                  $producto=$this->input->post("producto2",true);
                               }else
                               {
                                 $producto=$producto;
                               }
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista";
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                    break;
                               }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
                               }
                               $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "nombre_cliente"=>$this->input->post("nombre_cliente",true),
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>quitarPuntosNumero($this->input->post("can1",true)),
                                    "cantidad_2"=>quitarPuntosNumero($this->input->post("can2",true)),
                                    "cantidad_3"=>quitarPuntosNumero($this->input->post("can3",true)),
                                    "cantidad_4"=>quitarPuntosNumero($this->input->post("can4",true)),
                                    "acepta_excedentes"=>$acepta_excedentes,
                                    "precio_1"=>100,
                                    "precio_2"=>100,
                                    "precio_3"=>100,
                                    "precio_4"=>100,
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$this->input->post("materialidad_1",true),
                                    "materialidad_2"=>$this->input->post("materialidad_2",true),
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "cantidad_especifica_sino"=>$this->input->post("cantidad_especifica_sino",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$this->input->post("cliente_entrega",true),
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>"2",
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
									"id_antiguo"=>$this->input->post("id_antiguo",true),
									
                                 );
                               
//                                                                   "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
//                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    $guardar=$this->cotizaciones_model->insertar($data);
                                    
                                    $usrId=$this->session->userdata('id');
                                    $dataEstado = array("cotizaciones_id"=>$guardar,"id_estado"=>1,"fecha"=>date("Y-m-d"),"usuarios_id"=>$usrId);
                                    $this->cotizaciones_model->insertarEstadoCotizacion($dataEstado);
                                    
                                    $this->load->library('email');

                                    $this->email->from('sistemagrau@seleccionprofesional.cl', 'Cartonajes Grau');
                                    $this->email->to('ega@grauindus.cl'); 
                                    
                                    //$this->email->cc('otro@otro-ejemplo.com'); 
                                    //$this->email->bcc('ellos@su-ejemplo.com'); 
                                    $ven=$this->vendedores_model->getVendedorPorId($this->input->post("vendedor",true));
                                    $cliente=$this->input->post("cliente",true);
                                    if($cliente==3000)
                                    {
                                        $cli=$this->input->post("nombre_cliente",true);
                                    }else
                                    {
                                        $clienteBD=$this->clientes_model->getClientePorId($cliente);
                                        $cli=$clienteBD->razon_social;
                                    }
                                    $this->email->subject('Se genero Cotizacion Nro '.$guardar);
                                    $msg="Se Generó Cotización para ".$cli." (Vendedor : ".$ven->nombre.")";
                                    $msg.="\n Producto:$producto";
                                    $msg.="\n Condición del Producto:$condicion";
                                    $msg.="\n Cantidad 1:".quitarPuntosNumero($this->input->post("can1",true));
                                    $msg.="\n Cantidad 2:".quitarPuntosNumero($this->input->post("can2",true));
                                    $msg.="\n Cantidad 3:".quitarPuntosNumero($this->input->post("can3",true));
                                    $msg.="\n Cantidad 4:".quitarPuntosNumero($this->input->post("can4",true));
                                   // $msg.="\n\n para mas detalle revise el sistema en http://www.seleccionprofesional.cl/grau";
                                    //echo $msg;exit;
                                    $this->email->message($msg);	

                                    $this->email->send();
                                    
                                    
                              
                              
                                //    $checkInternos['checks'] = $this->input->post("acInternos");
                              //                                    $checks = 1;
								if($_POST['acInternos']!="")
								{
									foreach($_POST['acInternos'] as $check)
									{
										$data = array("cotizaciones_id"=>$guardar,"acabados_id_acabado"=>$check);
										$this->cotizaciones_model->insertarCotizacionesAcabados($data);
									}
								}
								
								$check = "";
									
								if($_POST['acExternos']!="")
								{
									
									foreach($_POST['acExternos'] as $check)
									{
										$data = array("cotizaciones_id"=>$guardar,"acabados_id_acabado"=>$check);
										$this->cotizaciones_model->insertarCotizacionesAcabados($data);
									}
                                }
                            // print_r(substr(implode(', ', $this->input->post('acInternos')), 0));
                                
                            if($guardar>0)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
					           redirect(base_url().'cotizaciones',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'cotizaciones/add',  301);
                            }
                            }
                }else
                {
                     //$this->session->set_userdata("chelasybares");
                $this->session->set_userdata('cliente', $this->input->post('cliente',true));
                $cliente= $this->session->userdata('cliente');
                $datos=$this->cotizaciones_model->getCotizacionesPorClienteUltima($cliente);
                $this->layout->css
                    (
                        array
                        (
                            base_url()."public/backend/css/calendario.css",
                            base_url()."public/backend/fancybox/jquery.fancybox.css",
                            base_url()."public/frontend/css/prism.css",
                            base_url()."public/frontend/css/chosen.css",
                        )
                    );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->vendedores_model->getVendedoresSelect();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            //print_r($datos);exit;
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
           $this->layout->view('agregar_respuesta',compact("tipos","vendedores","acInternos","acExternos","internos","externos","pagina","datos"));          
                }
               
             }else
             {
               redirect(base_url().'cotizaciones/agregar',  301);
             }
             
             
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
     public function buscar_respuesta()
	{
        if($this->session->userdata('id'))
        {
           
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
            if ( $this->input->post() )
             {
                //$this->session->set_userdata("chelasybares");
                $this->session->set_userdata('cliente', $this->input->post('cliente',true));
                $this->session->set_userdata('condicion_del_producto', $this->input->post('condicion_del_producto',true));
                $this->session->set_userdata('buscar', $this->input->post('buscar',true));
                $cliente= $this->session->userdata('cliente');
                $condicion_del_producto= $this->session->userdata('condicion_del_producto');
             }else
             {
                $cliente= $this->session->userdata('cliente');
                $condicion_del_producto= $this->session->userdata('condicion_del_producto');
                $buscar= $this->session->userdata('buscar');
             }
        $datos=$this->cotizaciones_model->getCotizacionesBuscarPaginacion($pagina,$porpagina,"limit",$cliente,$condicion_del_producto,$buscar);
        $cuantos=$this->cotizaciones_model->getCotizacionesBuscarPaginacion($pagina,$porpagina,"cuantos",$cliente,$condicion_del_producto,$buscar);
        $config['base_url'] = base_url().'cotizaciones/buscar_respuesta';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
           $this->layout->view('buscar_respuesta',compact('datos','cuantos','pagina','buscar')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
     public function search1($valor=null)
	{
        if($this->session->userdata('id'))
        {
            if(!$valor){show_404();}
             
            switch($valor)
            {
                case '1':
                    $buscar="Nuevo";
                break;
                case '2':
                    $buscar="Repetición con cambios";
                break;
                case '3':
                    $buscar="Repetición sin cambios";
                break;
                case '4':
                    $buscar="Producto Genérico";
                break;
                case '5':
                    $buscar="";
                break;            
                case '6':
                    $buscar="Cotizaciones Rechazadas";
                break;            
            }
            if($this->uri->segment(4))
            {
                $pagina=$this->uri->segment(4);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
			
        $datos=$this->cotizaciones_model->getCotizacionesRepeticionPaginacion($pagina,$porpagina,"limit",$buscar);
        $cuantos=$this->cotizaciones_model->getCotizacionesRepeticionPaginacion($pagina,$porpagina,"cuantos",$buscar);
		
        $config['base_url'] = base_url().'cotizaciones/search1';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '4';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
           $this->layout->view('search1',compact('datos','cuantos','pagina','buscar')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
     public function clientes($valor=null)
	{
        if($this->session->userdata('id'))
        {
            if(!$valor){show_404();}
            $cliente=$this->clientes_model->getClientePorId($valor); 
//         echo "AA";
//        exit();
            if(sizeof($cliente)==0){show_404();}
            if($this->uri->segment(4))
            {
                $pagina=$this->uri->segment(4);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->cotizaciones_model->getCotizacionesPorClientePaginacion($pagina,$porpagina,"limit",$valor);
        $cuantos=$this->cotizaciones_model->getCotizacionesPorClientePaginacion($pagina,$porpagina,"cuantos",$valor);
        $config['base_url'] = base_url().'cotizaciones/clientes/'.$valor;
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '4';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
           $this->layout->view('clientes',compact('datos','cuantos','pagina','buscar','cliente')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}

        
    public function search2()
	{
            if($this->session->userdata('id'))
            {

                if($this->uri->segment(3))
                {
                    $pagina=$this->uri->segment(3);
                }else
                {
                   $pagina=0;
                }
                $porpagina=10;
                if ( $this->input->post() )
                 {
                    $this->session->set_userdata('valor', $this->input->post('buscar',true));
                    $buscar= $this->session->userdata('valor');
                 }else
                 {
                    $buscar= $this->session->userdata('valor');
                 }                
            $datos=$this->cotizaciones_model->getCotizaconSearchPaginacion($pagina,$porpagina,"limit",$buscar);		 
            $cuantos=$this->cotizaciones_model->getCotizaconSearchPaginacion($pagina,$porpagina,"cuantos",$buscar);
            $config['base_url'] = base_url().'cotizaciones/search';
                $config['total_rows'] = $cuantos;
                $config['per_page'] = $porpagina;
                $config['uri_segment'] = '3';
                $config['num_links'] = '4';
                $config['first_link'] = 'Primero';
                $config['next_link'] = 'Siguiente';
                $config['prev_link'] = 'Anterior';
                $config['last_link'] = 'Ultimo';
                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li><a><b>';
                $config['cur_tag_close'] = '</b></a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $this->pagination->initialize($config);
                $this->layout->css
                (
                    array
                    (
                        base_url()."public/backend/fancybox/jquery.fancybox.css",
                        base_url()."public/frontend/css/prism.css",
                        base_url()."public/frontend/css/chosen.css",
                    )
                );
                $this->layout->js
                (
                    array
                    (
                        base_url()."public/backend/fancybox/jquery.fancybox.js"
                    )
                ); 
                $this->layout->view('search',compact('datos','cuantos','pagina')); 
            }else
            {
                redirect(base_url().'usuarios/login',  301);
            }        
        }

        
     public function search($valor=null)
	{
        if($this->session->userdata('id'))
        {
          
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3); 
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
            if ( $this->input->post() )
             {  
                $this->session->set_userdata('valor', $this->input->post('buscar',true));
                $buscar= $this->session->userdata('valor');
                
             }else
             {
                $buscar= $this->session->userdata('valor');
             }              
			
                if($this->session->userdata('perfil')!= 2)
                {
                //echo $buscar;exit();
                        $datos=$this->cotizaciones_model->getCotizaconSearchPaginacion($pagina,$porpagina,"limit",$buscar);		 
                        $cuantos=$this->cotizaciones_model->getCotizaconSearchPaginacion($pagina,$porpagina,"cuantos",$buscar);
//                                exit($datos."-".$cuantos);
                }
			 $busqueda=$this->cotizaciones_model->getCotizacionEnRojo($buscar); 
//			if($this->session->userdata('perfil')== 2)
//			{
//				$datos=$this->cotizaciones_model->getCotizacionesPorVendedorPaginacion($pagina,$porpagina,"limit");		 
//				$cuantos=$this->cotizaciones_model->getCotizacionesPorVendedorPaginacion($pagina,$porpagina,"cuantos");
//			}

			
        $config['base_url'] = base_url().'cotizaciones/search';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
             
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
           $this->layout->view('index2',compact('datos','cuantos','pagina','busqueda')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
     public function search_cot($valor=null)
	{
        if($this->session->userdata('id'))
        {
          
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3); 
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
           
                $buscar= $valor;
                		
                if($this->session->userdata('perfil')!= 2)
                {
                //echo $buscar;exit();
                        $datos=$this->cotizaciones_model->getCotizaconSearchUnaPaginacion($pagina,$porpagina,"limit",$buscar);		 
                        $cuantos=$this->cotizaciones_model->getCotizaconSearchUnaPaginacion($pagina,$porpagina,"cuantos",$buscar);
//                                exit($datos."-".$cuantos);
                }
			 $busqueda=$this->cotizaciones_model->getCotizacionEnRojo($buscar); 
//			if($this->session->userdata('perfil')== 2)
//			{
//				$datos=$this->cotizaciones_model->getCotizacionesPorVendedorPaginacion($pagina,$porpagina,"limit");		 
//				$cuantos=$this->cotizaciones_model->getCotizacionesPorVendedorPaginacion($pagina,$porpagina,"cuantos");
//			}

			
        $config['base_url'] = base_url().'cotizaciones/search';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
             
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
           $this->layout->view('index2',compact('datos','cuantos','pagina','busqueda')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}        
        
     public function tipo($id=null)
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
           if($this->uri->segment(4))
            {
                $pagina=$this->uri->segment(4);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->materiales_model->getMaterialesPaginacionPorTipo($pagina,$porpagina,"limit",$id);
        $cuantos=$this->materiales_model->getMaterialesPaginacionPorTipo($pagina,$porpagina,"cuantos",$id);
        $config['base_url'] = base_url().'materiales/tipo/'.$id;
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '4';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
           
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
            $tipos=$this->materiales_model->getMaterialesTipo();
            $t=$this->materiales_model->getMaterialesTipoPorId($id);
           $this->layout->view('tipo',compact('datos','cuantos','pagina','tipos','t')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
     public function detalle_ajax($id=null)
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            //$id=$this->input->post("valor1",true);
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
   	    $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
	    $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
	    $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
	    $orden=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
	    $orden_produccion=$this->cotizaciones_model->getOrdenDeProduccionPorCotizacion($id);
//            print_r($fotomecanica);exit;
            
            $data['id'] = $id;
            $data['datos'] = $this->cotizaciones_model->getCotizacionPorId($id);
            $data['acInternos'] = $this->acabados_model->getAcabadosInternos();
            $data['acExternos'] = $this->acabados_model->getAcabadosExternos();
		   
		   
            $data['ing'] = $this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $data['fotomecanica'] = $this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $data['hoja'] = $this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $data['orden'] = $this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $data['orden_produccion'] = $this->cotizaciones_model->getOrdenDeProduccionPorCotizacion($id);
            
            
        //    $this->layout->view('detalle_ajax',compact("datos","id")); 
            $this->layout->view('detalle_ajax',$data); 
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
    
    public function ultimas_referencias()
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            $id=$this->input->post("valor1",true);
            $cotis=$this->cotizaciones_model->getCotizacionesPorCliente($id);
            //print_r($cotis);exit;
            $ordenes=$this->orden_model->getOrdenesPorClienteUltimas4($id);
            $this->layout->view('ultimas_referencias',compact("cotis","id","ordenes")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
     public function materialidad()
    {
         if($this->session->userdata('id'))
        {
            //die("sss");
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            $id=$this->input->post("valor1",true);
            switch($id)
            {
                case '1':
                    $this->layout->view('materialidad1'); 
                break;
                case '2':
                    $this->layout->view('materialidad1'); 
                break;
                case '3':
                    $this->layout->view('materialidad3'); 
                break;
                case '4':
                    $this->layout->view('materialidad5'); // Onda vista micro onda
                break;
                case '5':
                    $this->layout->view('materialidad4'); //Solo cartulina
                break;
                
                case '7':
                    $this->layout->view('materialidad7'); //Proposicion
                break;
				case '9':
                    $this->layout->view('materialidad9'); //Corrugado / Corrugado
                break;
				case '10':
                    $this->layout->view('materialidad10'); // Micro / Micro
                break;
                default:
                    $this->layout->view('materialidad'); 
                break;
            }
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
    public function por_cliente()
    {
         $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $id1=$this->input->post("valor1",true);
        $id=$this->input->post("valor2",true);
        //die("ddd");
        if($id1==0)
        {
           
            $this->layout->view('por_cliente2',compact("datos"));
        }elseif($id1==3)
        {
             $datos=$this->orden_model->getOrdenesProductoGenerico();
            //print_r($datos);
            $this->layout->view('por_cliente3',compact("datos"));
        }else
        {
             $datos=$this->orden_model->getOrdenesPorCliente($id);
            //print_r($datos);
            $this->layout->view('por_cliente',compact("datos"));
        }
         
    }
      public function cotizacion_de_cliente2($id=null)
	{
	    if($this->session->userdata('id'))
        {
        if(!$id){show_404();}
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $cliente=$this->cotizaciones_model->getCotizacionPorId($id);
        
        if(sizeof($datos)==0){show_404();}
        $impresionPresupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($id);
        if($datos->id_cliente==3000)
        {
            $cliente=strtoupper($datos->nombre_cliente);
            $correo="";
            $direccion="";
            $ciudad="";
            $comuna="";
            $rut="";
            $telefono="";

        }else
        {
            $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
            $cliente= strtoupper($cli->razon_social);
            $correo=$cli->correo;
            $direccion=$cli->direccion;
            $ciudad=$cli->ciudad;
            $comuna=$cli->comuna;
            $rut=$cli->rut;
            $telefono=$cli->telefono;
            $contacto=$this->clientes_model->geContactosClientePorIdUltimo($datos->id_cliente);
        }
       // print_r($cli);exit();
        /*INICIO BUSQUEDA SOFTLAND JAIME SUAREZ +56957763170 */
//            $productosGrauLtda="";
//            $productosGrauSpa="";      
//            $productosMicrobox="";
//            $productosPubligrafika="";
//            $productosTenspa="";        
            if ($cliente) {
                $str_cliente=str_replace("Ñ", "N", $cliente);
                $productosGrauLtda=$this->orden_model->getProductosClientesGRAULTDA($str_cliente);
                $productosGrauSpa=$this->orden_model->getProductosClientesGRAUSPA($str_cliente);        
                $productosMicrobox=$this->orden_model->getProductosClientesMICROBOX($str_cliente);
                $productosPubligrafika=$this->orden_model->getProductosClientesPUBLIGRAFIKA($str_cliente);
                $productosTenspa=$this->orden_model->getProductosClientesTENSPA($str_cliente);
            }
            //print_r($hoja);exit();
        /*FIN BUSQUEDA SOFTLAND*/
        
        $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
        $cuerpo='<!doctype html>
			<html> 
            <head>
            <meta charset="utf-8" />
            
<style type="text/css">
    .tabla
    {
         border: #000099; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; width: 1200px;
    }
</style>
            </head>
			<body>';
         
    $cuerpo.='<table style="width: 1200px;">';
    $cuerpo.='
    <tr>
        <td style="text-align: center;"><h1>Cartonajes GRAU</h1></td>
    </tr>
';        
 $cuerpo.='    <tr>
        <td colspan="2">
            RUT : 79.897.500-5
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="text-decoration:underline;">PRESUPUESTO</span> N° '.$id.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
 fecha(date('Y-m-d')).'
        </td><br /><br /><br />
    </tr>'; 
     $cuerpo.='    <tr>
        <td colspan="2">
            SEÑORES
            <br />
            '.$cliente.'
        </td>
    </tr>'; 
    $cuerpo.='    <tr>
        <td colspan="2">
             &nbsp;
        </td>
    </tr>';    
     $cuerpo.='    <tr>
        <td colspan="2">
             '.$direccion.', '.$comuna.', '.$ciudad.'
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Rut : '.esRut($rut).'
        </td>
    </tr>';     
    $cuerpo.='    <tr>
        <td colspan="2">
             FONO : '.$telefono.'
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              AT : '.$contacto->nombre.'
        </td>
    </tr>';    
     $cuerpo.='    <tr>
        <td colspan="2">
             <br />
             DE NUESTRA CONSIDERACIÓN:
             <br / >
             Tenemos el agrado, de acuerdo a las condiciones estipuladas a continuación, cotizarle lo siguiente:
        </td>
    </tr>';     
  	$cuerpo.='</table>';
    $cuerpo.='<table class="tabla">';
     $cuerpo.='    <tr>
        <td style="width: 150px;">
            UNIDADES
        </td>
        <td style="width: 400px;">
        DETALLE
        </td>
        <td style="width: 150px;">
        VALOR UNITARIO
        </td>
    </tr>';     
    $cuerpo.='<tr>
        <td colspan="3"><hr /></td></tr>';
     $cuerpo.='    <tr>
        <td style="width: 150px;">
            '.number_format($datos->cantidad_1,0,'','.').'
        </td>
        <td style="width: 400px;">
            '.$datos->producto.'
        </td>
        <td style="width: 150px;">$
        '.number_format($hoja->valor_empresa,0,'','.').'
        </td>
    </tr>'; 
    if($datos->cantidad_2>1)
    {
       $cuerpo.='    <tr>
        <td style="width: 150px;">
            '.number_format($datos->cantidad_2,0,'','.').'
        </td>
        <td style="width: 400px;">
            '.$datos->producto.'
        </td>
        <td style="width: 150px;">
        $ '.number_format($hoja->valor_empresa_2,0,'','.').'
        </td>
    </tr>';  
    }
    if($datos->cantidad_3>1)
    {
    $cuerpo.='    <tr>
        <td style="width: 150px;">
            '.number_format($datos->cantidad_3,0,'','.').'
        </td>
        <td style="width: 400px;">
            '.$datos->producto.'
        </td>
        <td style="width: 150px;">
        $ '.number_format($hoja->valor_empresa_3,0,'','.').'
        </td>
    </tr>'; 
    }
    if($datos->cantidad_4>1)
    {
    $cuerpo.='    <tr>
        <td style="width: 150px;">
            '.number_format($datos->cantidad_4,0,'','.').'
        </td>
        <td style="width: 400px;">
            '.$datos->producto.'
        </td>
        <td style="width: 150px;">
        $ '.number_format($hoja->valor_empresa_4,0,'','.').'
        </td>
    </tr>'; 
    }
    $cuerpo.='<tr>
        <td colspan="3">
            <br /><br /><br /><br /><br /><br />
        </td>
        </tr>'; 
        $cuerpo.='</table>';
        $cuerpo.='<table class="tabla">';
     $cuerpo.='<tr>
        <td colspan="3"><hr /></td></tr>';
    $cuerpo.='    <tr>
        <td>
            <span style="text-decoration:underline;; font-weight: bold;">CONDICIONES DE VENTA</spaN>
        </td>
        <td>
        &nbsp;
        </td>
        <td>
        &nbsp;
        </td>
    </tr>'; 

    $cuerpo.='<tr>
        <td colspan="3"><hr /></td></tr>';
        $forma_pago=$this->clientes_model->getFormasPagoPorId($datos->forma_pago);
        if($datos->envasado==""){
            $formap="Paquetes";
        }else{
            $formap=$datos->envasado;
        }
    $cuerpo.='    
	<tr>
        <td>
            - PRECIOS NETOS MÁS I.V.A
            <br />
            - FORMA DE PAGO : '.$forma_pago->forma_pago.'
            <br />
            - VARIACIONES DE CANTIDAD +-10%
        </td>
        <td>
        &nbsp;
        </td>
        <td>
        - FORMA DE ENTREGA : '.$formap.'
            <br />
            - PLAZO DE ENTREGA : 20 Días
            <br />
            - VALIDEZ DE PRESUPUESTO, 30 Días
            <br / >
            - PUESTO EN SANTIAGO
        </td>
    </tr>';   
  
    $cuerpo.='    
	<tr>
        <td>
        </td>
		
        <td>
        </td>
		
        <td>
        <strong>- Condición del Producto: '.$datos->condicion_del_producto.'</strong>
        </td>
    </tr>';   
  
    
//    $cuerpo.='<tr>
//        <td colspan="3"><hr /></td></tr>';
//    $cuerpo.='    <tr>
//        <td>
//            <span style="text-decoration:underline;; font-weight: bold;">PRODUCTOS REGISATRADOS EN ALMACEN</spaN>
//        </td>
//        <td>
//        &nbsp;
//        </td>
//        <td>
//        &nbsp;
//        </td>
//    </tr>'; 
$cuerpo.='</table>';


//$cuerpo.='<table class="tabla">';
//    $cuerpo.='<tr>
//        <td>
//            <strong>CODIGO</strong>
//        </td>
//        <td>
//            <strong>DESCRIPCIÓN</strong>
//        </td>
//        <td>
//            <strong>UNIDAD</strong>
//        </td>
//        <td>
//            <strong>COSTO</strong>
//        </td>        
//    </tr>'; 
    $productos="";
        if($productosGrauSpa!='')
	{   
            foreach ($productosGrauSpa as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}
        if($productosGrauLtda!='')        
	{        
            foreach ($productosGrauLtda as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}       
        if($productosMicrobox!='')        
	{              
            foreach ($productosMicrobox as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}   
        if($productosPubligrafika!='')        
	{
            foreach ($productosPubligrafika as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}  

        if($productosTenspa!='')        
	{                
            foreach ($productosTenspa as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}   

//        if ($productos=="")
//        {
//             $cuerpo.='<tr><td colspan="4"><strong>No hay productos Registrados en Almacen</strong></td></tr>';
//        }
//        else $cuerpo.=$productos;
        
    $cuerpo.='</table>';
     $cuerpo.='<br/>';     
    $cuerpo.='<table>';
     $cuerpo.='<tr>
        <td style=" text-align: center;">
            <strong>En espera de una favorable acogida a la presente, atentamente</strong>
        </td>
        </tr>'; 
    $cuerpo.='</table>';
    
    $cuerpo.='<table>';
     $cuerpo.='<tr>
        <td colspan="3">
            <hr />
            <br />
        </td>
        </tr>'; 
    $cuerpo.='    <tr>
        <td>
            '.strtoupper ($vendedor->nombre).'
            <br />
            ________________________________
            <br />
            <center><span style="font-style: oblique; font-weight: bold;">EJECUTIVO COMERCIAL</span></center>
        </td>
         <td>
            &nbsp;
            <br />
            ________________________________
            <br />
            <center><span style="font-style: oblique; font-weight: bold;">ACEPTADO</span></center>
        </td>
         <td>
           JUAN TAPIA ESCKER
            <br />
            ________________________________
            <br />
           <center> <span style="font-style: oblique; font-weight: bold;">GERENCIA COMERCIAL</span></center>
        </td>
    </tr>'; 
    $cuerpo.='<tr>
        <td colspan="3">
            <br /><br /><br />
        </td>
        </tr>'; 
        $cuerpo.='<tr>
        <td colspan="3" style=" text-align: center; ">
            JUAN FRANCISCO RIVAS 9435 FONOS : 22 495 9500
            <br />
            LA CISTERNA - SANTIAGO <br />
            WWW.GRAUINDUS.CL
        </td>
           
        </td>
        </tr>'; 
    
    $cuerpo.='</table>';
    
      $cuepo.='</body></html>';
/********************Segunda Pagina***************************/
$cuerpo2='<!doctype html>
			<html> 
            <head>
            <meta charset="utf-8" />
            
<style type="text/css">
    .tabla
    {
         border: #000099; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; width: 1200px;
    }
</style>
            </head>
			<body>';

  $cuerpo2.='<table style="width: 1200px;">';
          
 $cuerpo2.='    <tr>
        <td colspan="2">
            RUT : 79.897.500-5
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="text-decoration:underline;">PRESUPUESTO</span> N° '.$id.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
 fecha(date('Y-m-d')).'
        </td><br /><br /><br />
    </tr>';   
     $cuerpo2.='    <tr>
        <td colspan="2">
            SEÑORES
            <br />
            '.$cliente.'
        </td>
    </tr>'; 
    $cuerpo2.='    <tr>
        <td colspan="2">
             &nbsp;
        </td>
    </tr>';    
     $cuerpo2.='    <tr>
        <td colspan="2">
             '.$direccion.', '.$comuna.', '.$ciudad.'
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Rut : '.esRut($rut).'
        </td>
    </tr>';     
    $cuerpo2.='    <tr>
        <td colspan="2">
             FONO : '.$telefono.'
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              AT : '.$contacto->nombre.'
        </td>
    </tr>';    
         
  	$cuerpo2.='</table>';

    $cuerpo2.='<table style="width: 1200px;">';
 $cuerpo2.='<tr>
        <td colspan="3"><hr /></td></tr>';
    $cuerpo2.='    <tr>
        <td>
            <span style="text-decoration:underline;; font-weight: bold;">PRODUCTOS REGISATRADOS EN ALMACEN</spaN>
        </td>
        <td>
        &nbsp;
        </td>
        <td>
        &nbsp;
        </td>
    </tr>'; 
$cuerpo2.='</table>';


$cuerpo2.='<table class="tabla">';
    $cuerpo2.='<tr>
        <td>
            <strong>CODIGO</strong>
        </td>
        <td>
            <strong>DESCRIPCIÓN</strong>
        </td>
        <td>
            <strong>UNIDAD</strong>
        </td>
        <td>
            <strong>COSTO</strong>
        </td>        
    </tr>'; 
    $productos="";
        if($productosGrauSpa!='')
	{   
            foreach ($productosGrauSpa as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}
        if($productosGrauLtda!='')        
	{        
            foreach ($productosGrauLtda as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}       
        if($productosMicrobox!='')        
	{              
            foreach ($productosMicrobox as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}   
        if($productosPubligrafika!='')        
	{
            foreach ($productosPubligrafika as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}  

        if($productosTenspa!='')        
	{                
            foreach ($productosTenspa as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}   

        if ($productos=="")
        {
             $cuerpo2.='<tr><td colspan="4"><strong>No hay productos Registrados en Almacen</strong></td></tr>';
        }
        else $cuerpo2.=$productos;
        
    $cuerpo2.='</table>';
     $cuerpo2.='<br/>'; 
/***********************************************/
            //echo $cuerpo;exit;
		//$mpdf=new mPDF(); 
		$nombre="Cotización de Cliente ".$id." ".date("Y-m-d H:i:s").".pdf";
		//$this->mpdf->WriteHTML(utf8_encode($cuerpo));
		$this->mpdf->WriteHTML($cuerpo);
		$this->mpdf->AddPage('P','','','','','','','','','','');
                $this->mpdf->WriteHTML($cuerpo2);  
                $this->mpdf->Output($nombre,'I');
		exit;
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function cotizacion_de_cliente($id=null,$pagina=null)
	{
	if($this->session->userdata('id'))
        {
 
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $cotizacionPresupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $user=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        if (is_numeric($datos->forma_pago)) $forma_pago=$this->clientes_model->getFormasPagoPorId($datos->forma_pago); 
        else $forma_pago=$this->clientes_model->getFormasPagoPorNombre($datos->forma_pago);
        $orden=$this->orden_model->getOrdenesPorCotizacion($id);

		
            if(sizeof($hoja)==0)
            {
          
                
                if($this->input->post("pegado",true) == '')
                {
                        $pegado= '30';
                }else{

                        $pegado= $this->input->post("pegado",true);
                }
          
            if ($this->input->post("id",true)!='')
            {        
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "id_cotizacion"=>$this->input->post("id",true),
                        "valor_empresa"=>$this->input->post("valor_empresa",true),
                        "pegado"=>$this->input->post("pegado",true),
                        "valor_extra"=>$this->input->post("valor_extra",true),                        
                        "costo_adicional"=>'0',
                        "dias_de_entrega"=>'20',
                        "margen"=>'15',
                        "valor_acabado_1"=>'0',
                        "valor_acabado_2"=>'0',
                        "valor_acabado_3"=>'0',
                    );
                    
                    

                }
              
          
            }
            else
            {
        

               $data=array
                (
                    "valor_empresa"=>$this->input->post("valor_empresa",true),
                    "valor_empresa_2"=>$this->input->post("valor_empresa2",true),
                    "valor_extra"=>$this->input->post("valor_extra",true),                        
                );
                   

            }
       	
        //print_r($orden);exit;
        if(sizeof($datos)==0){show_404();}
        $this->layout->setLayout('template_ajax');
        $this->layout->view('cotizacion_de_cliente',compact('datos','ing','fotomecanica','cotizacionPresupuesto','user','vendedor','cli','presupuesto','forma_pago','id','pagina','hoja','orden'));  
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
	}
    public function hoja_de_costos($id=null,$pagina=null)
	{
	if($this->session->userdata('id'))
        {
 
        if(!$id){show_404();}
        //retornando la cotizacion copiada
        $copia = $this->input->post("copia",true);
        
        if($copia==1){$id = $copia;}
        //*******************************************************
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $cotizacionPresupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $user=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $hoja2=$this->cotizaciones_model->getHojaDeCostos2PorIdCotizacion($id);
        $idc = substr($hoja->codigo_duplicado,0,4);
        if($idc!=""){
        $copias=$this->cotizaciones_model->obtenerMaximoIdCopias($idc);}
        if (is_numeric($datos->forma_pago)) $forma_pago=$this->clientes_model->getFormasPagoPorId($datos->forma_pago); 
        else $forma_pago=$this->clientes_model->getFormasPagoPorNombre($datos->forma_pago);
        $orden=$this->orden_model->getOrdenesPorCotizacion($id);

		
            if(sizeof($hoja)==0)
            {
          
                
                if($this->input->post("pegado",true) == '')
                {
                        $pegado= '30';
                        $pegado_migrado= $this->input->post("pegado",true);
                }else{

                        $pegado= $this->input->post("pegado",true);
                        $pegado_migrado= $this->input->post("pegado",true);
                }
          
            if ($this->input->post("id",true)!='')
            {        
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "id_cotizacion"=>$this->input->post("id",true),
                        "valor_empresa"=>$this->input->post("valor_empresa",true),
                        "pegado"=>$this->input->post("pegado",true),
                        "valor_extra"=>$this->input->post("valor_extra",true),                        
                        "costo_adicional"=>'0',
                        "dias_de_entrega"=>'20',
                        "margen"=>'15',
                        "valor_acabado_1"=>'0',
                        "valor_acabado_2"=>'0',
                        "valor_acabado_3"=>'0',
                    );
                    
                    

                }
              
          
            }
            else
            {
        

               $data=array
                (
                    "valor_empresa"=>$this->input->post("valor_empresa",true),
                    "valor_empresa_2"=>$this->input->post("valor_empresa2",true),
                    "valor_extra"=>$this->input->post("valor_extra",true),                        
                );
                   
//                 $this->db->where('id_cotizacion', $this->input->post('id',true));
//                 $this->db->update("hoja_de_costos_datos",$data);
               //  print_r($data);exit();
            }
       	
        //print_r($datos);exit;
        if(sizeof($datos)==0){show_404();}
        $this->layout->setLayout('template_ajax');
       // print_r($hoja);exit();
//        if($hoja->impreso==1){
//            $hoja = $hoja2;
//        $this->layout->view('hoja_de_costos2',compact('copias','datos','ing','fotomecanica','cotizacionPresupuesto','user','vendedor','cli','presupuesto','forma_pago','id','pagina','hoja','orden'));      
//        }else{
        $this->layout->view('hoja_de_costos',compact('copias','datos','ing','fotomecanica','cotizacionPresupuesto','user','vendedor','cli','presupuesto','forma_pago','id','pagina','hoja','orden'));          
        //}
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
	}
    public function hoja_de_costos2($id=null,$pagina=null)
	{
	if($this->session->userdata('id'))
        {
 
        if(!$id){show_404();}
        //retornando la cotizacion copiada
        $copia = $this->input->post("copia",true);
        
        if($copia==1){$id = $copia;}
        //*******************************************************
        $datos=$this->cotizaciones_model->getCotizacion2PorId($id);
        $ing=$this->cotizaciones_model->getCotizacionIngenieria2PorIdCotizacion($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanica2PorIdCotizacion($id);
        $cotizacionPresupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $user=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostos2PorIdCotizacion($id);
        $idc = substr($hoja->codigo_duplicado,0,4);
        if($idc!=""){
        $copias=$this->cotizaciones_model->obtenerMaximoIdCopias($idc);}
        if (is_numeric($datos->forma_pago)) $forma_pago=$this->clientes_model->getFormasPagoPorId($datos->forma_pago); 
        else $forma_pago=$this->clientes_model->getFormasPagoPorNombre($datos->forma_pago);
        $orden=$this->orden_model->getOrdenesPorCotizacion($id);

		
            if(sizeof($hoja)==0)
            {
          
                
                if($this->input->post("pegado",true) == '')
                {
                        $pegado= '30';
                        $pegado_migrado= $this->input->post("pegado",true);
                }else{

                        $pegado= $this->input->post("pegado",true);
                        $pegado_migrado= $this->input->post("pegado",true);
                }
          
            if ($this->input->post("id",true)!='')
            {        
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "id_cotizacion"=>$this->input->post("id",true),
                        "valor_empresa"=>$this->input->post("valor_empresa",true),
                        "pegado"=>$this->input->post("pegado",true),
                        "valor_extra"=>$this->input->post("valor_extra",true),                        
                        "costo_adicional"=>'0',
                        "dias_de_entrega"=>'20',
                        "margen"=>'15',
                        "valor_acabado_1"=>'0',
                        "valor_acabado_2"=>'0',
                        "valor_acabado_3"=>'0',
                    );
                    
                    

                }
              
          
            }
            else
            {
        

               $data=array
                (
                    "valor_empresa"=>$this->input->post("valor_empresa",true),
                    "valor_empresa_2"=>$this->input->post("valor_empresa2",true),
                    "valor_extra"=>$this->input->post("valor_extra",true),                        
                );
                   
//                 $this->db->where('id_cotizacion', $this->input->post('id',true));
//                 $this->db->update("hoja_de_costos_datos",$data);
               //  print_r($data);exit();
            }
       	
        //print_r($orden);exit;
        if(sizeof($datos)==0){show_404();}
        $this->layout->setLayout('template_ajax');
        $this->layout->view('hoja_de_costos2',compact('copias','datos','ing','fotomecanica','cotizacionPresupuesto','user','vendedor','cli','presupuesto','forma_pago','id','pagina','hoja','orden'));  
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
	}
        
        
        
    public function hoja_de_costos_propia($id=null,$pagina=null)
	{
	if($this->session->userdata('id'))
        {
 
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $cotizacionPresupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $user=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        if (is_numeric($datos->forma_pago)) $forma_pago=$this->clientes_model->getFormasPagoPorId($datos->forma_pago); 
        else $forma_pago=$this->clientes_model->getFormasPagoPorNombre($datos->forma_pago);
        $orden=$this->orden_model->getOrdenesPorCotizacion($id);

		
            if(sizeof($hoja)==0)
            {
          
                
                if($this->input->post("pegado",true) == '')
                {
                        $pegado= '30';
                }else{

                        $pegado= $this->input->post("pegado",true);
                }
          
            if ($this->input->post("id",true)!='')
            {        
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "id_cotizacion"=>$this->input->post("id",true),
                        "valor_empresa"=>$this->input->post("valor_empresa",true),
                        "pegado"=>$this->input->post("pegado",true),
                        "valor_extra"=>$this->input->post("valor_extra",true),                        
                        "costo_adicional"=>'0',
                        "dias_de_entrega"=>'20',
                        "margen"=>'15',
                        "valor_acabado_1"=>'0',
                        "valor_acabado_2"=>'0',
                        "valor_acabado_3"=>'0',
                    );
                }

            }
            else
            {
               $data=array
                (
                    "valor_empresa"=>$this->input->post("valor_empresa",true),
                    "valor_empresa_2"=>$this->input->post("valor_empresa2",true),
                    "valor_extra"=>$this->input->post("valor_extra",true),                        
                );
                   
//                 $this->db->where('id_cotizacion', $this->input->post('id',true));
//                 $this->db->update("hoja_de_costos_datos",$data);
               //  print_r($data);exit();
            }     	
        //print_r($orden);exit;
        if(sizeof($datos)==0){show_404();}
        $this->layout->setLayout('template_ajax');
        //$this->layout->view('hc_propia',compact('datos','ing','fotomecanica','cotizacionPresupuesto','user','vendedor','cli','presupuesto','forma_pago','id','pagina','hoja','orden'));  
        $this->layout->view('hc_propia',compact('datos','ing','fotomecanica','cotizacionPresupuesto','user','vendedor','cli','presupuesto','forma_pago','id','pagina','hoja','orden'));  
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
	}
    
  public function pdf($id=null)
	{
	if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        //print_r($datos);exit;
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $cotizacionPresupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $user=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        if (is_numeric($datos->forma_pago)) $forma_pago=$this->clientes_model->getFormasPagoPorId($datos->forma_pago); 
        else $forma_pago=$this->clientes_model->getFormasPagoPorNombre($datos->forma_pago);        
//        $forma_pago=$this->clientes_model->getFormasPagoPorNombre($datos->forma_pago);
//        print_r($forma_pago);
//        exit;
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $orden=$this->orden_model->getOrdenesPorCotizacion($id);
        if(sizeof($datos)==0){show_404();}
        
        $cuerpo=' <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        
<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/estilos.css" />
    </head>
    <body>';
    $tamano1=$ing->tamano_a_imprimir_1;
    $tamano2=$ing->tamano_a_imprimir_2;
	
	 if($tamano1==60 and $tamano2>100)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==70 and $tamano2>120)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==80 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==90 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1>90 and $tamano2>60)
    {
        $maquina="Máquina Roland 800";
    }else
    {
        $maquina="Máquina Roland 800";
    }
    
        if($fotomecanica->colores>3)
        {
            if($maquina=="Máquina Roland 800")
            {
               if($maquina=="Máquina Roland 800")
            {
				if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
				{
				    $color1=0;
					$color2= $fotomecanica->colores*150;				
				}else{			
                    $color1=0;
                    $color2= $fotomecanica->colores*100;
				}
            }else
            {
				//ultra
				
				
				if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
				{
				    $color1=0;
					$color2= $fotomecanica->colores*150;				
				}else{			
                    $color1=0;
                    $color2= $fotomecanica->colores*100;
				}

            }
            }else
            {
				//ultra
               if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
				{
				    $color1=0;
					$color2= $fotomecanica->colores*150;				
				}else{			
                    $color1=0;
                    $color2= $fotomecanica->colores*100;
				}
            }
        }else
        {
			  if($fotomecanica->colores == 0)
				{
					$color1=0;
					$color2=0;
				}elseif($fotomecanica->colores >= 1 and $fotomecanica->colores <= 3)
				{	
						if($maquina=="Máquina Roland 800")
						{
						   $color1= 400;
						   $color2=0;
						}else
						{
							//ultra
						   $color1= 300;
						   $color2=0;
						}
				}
        }
       // echo $ing->unidades_por_pliego;exit;
         
         $canTotal=number_format($datos->cantidad_1/5000,0,"","")-1;//6000 1
         //echo $canTotal;exit;
         $cantidad_1=$datos->cantidad_1/$ing->unidades_por_pliego;
   
        
		
		 if($datos->cantidad_1/$ing->unidades_por_pliego>5000)
         {
         
			$vecescan1 = ($datos->cantidad_1/$ing->unidades_por_pliego) / 5000;
			
			 if($vecescan1 >1)
            {
				   $can1= 30 * $vecescan1;
			}else{
				
				   $can1=30;
			}
			
			
             if($vecescan1 >1)
            {
                //$entero=number_format(($cantidad_1/5000)+0.5,0,'','');
                $can2= 50 * $vecescan1;
            }else
            {
                $can2=50;
            }
                
            
         }else
         {
            $can1=0;
            $can2=0;
         }
        

         $barniz=substr($fotomecanica->acabado_impresion_1,0,6);
        //echo $barniz;exit;
         if(($fotomecanica->fot_lleva_barniz!='') && ($fotomecanica->fot_lleva_barniz!='Nada'))
         {
            $cantidadBarniz=$datos->cantidad_1-1000;
            if($cantidadBarniz<1000)
            {
                if($maquina=="Máquina Roland 800")
                {
                    //$bar1=150;
                    $bar1=100;
                    $bar2=0;
                }else
                {
                    $bar1=100;
                    $bar2=0;
                }
            }else
            {
			
               //echo $datos->cantidad_1/$ing->unidades_por_pliego;exit;
               $enteroBarniz=($datos->cantidad_1/$ing->unidades_por_pliego);
		//echo $enteroBarniz;exit();
               if($enteroBarniz < 1000)
			   {
				//$bar1=150;
				$bar1=100;
                $bar2=0;   
			   }else
			   {
               $enteroBarniz=(((number_format($enteroBarniz,0,'','')/1000)+1)-2)*1;
               //echo $enteroBarniz;exit();
               //echo $enteroBarniz;exit;   
               //$bar1=150;
               $bar1=100;
               $bar2=$enteroBarniz;
			   }
            }
            
            
         }else
         {
                $bar1=0;
                $bar2=0;
         }
		 if($datos->procesos_especiales_folia=="SI")
        {
            $folia=25;
        }else
        {
            $folia=0;
        }
		
	if ($fotomecanica->acabado_impresion_4!='')	
            $acabado_nombre4=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
	if ($fotomecanica->acabado_impresion_5!='')       
            $acabado_nombre5=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
	if ($fotomecanica->acabado_impresion_6!='')      
            $acabado_nombre6=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
	
        //rutina ehndz  para acabados internos
        $var1=0;
        $var2=0;
        $var3=0;
        if (($fotomecanica->acabado_impresion_1!='') && ($fotomecanica->acabado_impresion_1!=16))	
            $var1=1;
	if (($fotomecanica->acabado_impresion_2!='')  && ($fotomecanica->acabado_impresion_2!=16))      
            $var2=1;
	if (($fotomecanica->acabado_impresion_3!='')  && ($fotomecanica->acabado_impresion_3!=16))      
            $var3=1;
        $totalTrabajosInternos=$var1+$var2+$var3; 
        if($totalTrabajosInternos>0){
            $totalTrabajosInternos;
        }else{
            $totalTrabajosInternos="No";
        }
        //fin rutina ehndz  para acabados externos
        //rutina ehndz  para acabados externos
        $var4=0;
        $var5=0;
        $var6=0;
        if (($fotomecanica->acabado_impresion_4!='') && ($fotomecanica->acabado_impresion_4!=17))	
            $var4=1;
	if (($fotomecanica->acabado_impresion_5!='')  && ($fotomecanica->acabado_impresion_5!=17))      
            $var5=1;
	if (($fotomecanica->acabado_impresion_6!='')  && ($fotomecanica->acabado_impresion_6!=17))      
            $var6=1;
        $totalTrabajosExternos=$var4+$var5+$var6; 
        if($totalTrabajosExternos>0){
            $totalTrabajosExternos;
        }else{
            $totalTrabajosExternos="No";
        }
        //echo $totalTrabajosExternos=$var4+$var5+$var6;exit();
        //fin rutina ehndz  para acabados externos
        
	if(strstr($acabado_nombre4->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }

	if(strstr($acabado_nombre5->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
	if(strstr($acabado_nombre6->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
        if($laca == null)
        {
                $laca=0;
        }
		
	if(strstr($acabado_nombre4->caracteristicas,"TERMOLAMINADO") != false)
        {
//            exit("paso1");
            $termolaminado=50;
			
        } 
		
	if(strstr($acabado_nombre5->caracteristicas,"TERMOLAMINADO") != false)
        {
//            exit("paso2");            
            $termolaminado=50;
			
        }
		
        if(strstr($acabado_nombre6->caracteristicas,"TERMOLAMINADO") != false)
        {
//            exit("paso3");            
            $termolaminado=50;
			
        }
		
	if($acabado_nombre4->tipo == 'Externo' and $acabado_nombre4->id != 17)
        {
            //echo $acabado_nombre4->tipo;
            $numeros_de_acabados=1;			
        }
		
	if($acabado_nombre5->tipo == 'Externo' and $acabado_nombre5->id != 17)
        {
            //echo $acabado_nombre5->tipo;
            $numeros_de_acabados=2;		
        }
		
         if($acabado_nombre6->tipo == 'Externo' and $acabado_nombre6->id != 17)
        {
            //echo $acabado_nombre6->tipo;
            $numeros_de_acabados=3;	
        } 
		
	if($numeros_de_acabados >= 2)
        {
            $termolaminado=0;
        }
		
	if($fotomecanica->acabado_impresion_4!="17" or $fotomecanica->acabado_impresion_5!="17" or $fotomecanica->acabado_impresion_6!="17")
        {
            if($fotomecanica->acabado_impresion_4!="" or $fotomecanica->acabado_impresion_5!="" or $fotomecanica->acabado_impresion_6!="")
            {
                if($termolaminado == 50)
                {
                    $externo=0;
                }else{
                    $externo=50;
                }
            }else
            {
                $externo=0;
            }
        }else
        {
            $externo=0;
        }
		
        //Para la descripcion SI o  No
        if($externo==0)
        {
            $descripcion_trabajo_externo = 'NO';
        }
        else
        {
            $descripcion_trabajo_externo = 'SI';
        }
		
       // echo $ing->materialidad_datos_tecnicos;exit;
        if($ing->materialidad_datos_tecnicos=="Onda a la Vista")
        {
             $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
          // echo $canTotal2;exit;
            if($canTotal2>=1)
            {
                $micromicro=30*$canTotal2;
            }else
            {
                $micromicro=0;
            }
        }else
        {
            $micromicro=0;
        }
         if($ing->materialidad_datos_tecnicos=="Cartulina-cartulina")
        {
             $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
          // echo $canTotal2;exit;
         //   if($canTotal2>=1)
           // {
                //$cartulina=30*$canTotal2;
                $cartulina=30;
            //}else
            //{
              //  $cartulina=0;
            //}
        }else
        {
            $cartulina=0;
        }
        if($ing->materialidad_datos_tecnicos=="Sólo Cartulina")
        {
           $emplacado=0;
           $emplacado=0;
        }else
        {
             $mermaEmplacadoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(35);
             $emplacado= $datos->cantidad_1  / $ing->unidades_por_pliego; /*Valor x dividido por Unidad por pliego*/

                $emplacado= $emplacado / 1000; /*Resultado de emplacado dividido por 1000*/                                       

                $emplacado= ($emplacado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                                  

            $emplacado= $emplacado/ 1000; /*emplacado dividido por 1000*/                   

                $emplacado = $emplacado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               

                $Entero = number_format($emplacado,0,'',''); /* Guardar entero del emplacado*/                         

                $emplacado_fijo= 50; //*Multiplicar entero del emplacado por 15
                $emplacado = $Entero * $mermaEmplacadoArray->precio; //*Multiplicar entero del emplacado por 15
                $emplacado_merma = $mermaEmplacadoArray->precio; //*Multiplicar entero del emplacado por 15
           
        }
        if($fotomecanica->estan_los_moldes=="NO LLEVA" or $fotomecanica->estan_los_moldes=="CLIENTE LO APORTA" or $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
        {
            $troquelado=0;
            $troquelado_fijo=0;
        }else
        {
            
            $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
             $troquelado= $datos->cantidad_1  / $ing->unidades_por_pliego; /*Valor x dividido por Unidad por pliego*/

                            $troquelado= $troquelado / 1000; /*Resultado de emplacado dividido por 1000*/                                                              

                            $troquelado= ($troquelado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          

                    $troquelado= $troquelado/ 1000; /*emplacado dividido por 1000*/                      

                        $troquelado = $troquelado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               

                            $EnteroTroquelado = number_format($troquelado,0,'',''); /* Guardar entero del emplacado*/                          

                            $troquelado_fijo = 40; /*Multiplicar entero del emplacado por 15*/
                            $troquelado = $EnteroTroquelado * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
                            $troquelado_merma = $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        
        //$sum=$color1+$color2+$can1+$can2+$bar1+$bar2+$laca+$folia+$termolaminado+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
        //$sum=$color1+$color2+$can1+$bar1+$bar2+$laca+$folia+$termolaminado+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
        $sum=$color1+$color2+$can1+$bar1+$bar2+$externo+$micromicro+$cartulina+$emplacado+$troquelado+$emplacado_fijo+$troquelado_fijo;
        
        if(sizeof($hoja)>=1)
                                        {
                                            $arreglo55=array
                                                (
                                                    "total_merma"=>$sum,
                                                );
                                                $this->db->where('id', $hoja->id);
                                                $this->db->update("hoja_de_costos_datos",$arreglo55);
                                        }
       /**
        * fin validaciones mermas
        * */ 

       $tiraje=$datos->cantidad_1/$ing->unidades_por_pliego;
       if($tiraje<4000)
       {
         $tiraje2="Menos de 4.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(17);
         $factor_rango=$factor_rangos->precio;
       }elseif($tiraje>4000 and $tiraje<10000)
       {
         $tiraje2="4.001 a 10.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(18);
         $factor_rango=$factor_rangos->precio;
         
       }else
       {
        $tiraje2="Más de 10.000";
        $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(19);
         $factor_rango=$factor_rangos->precio;
       }
       /**
                             * pre impresión
                             * */
                             if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                             if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz3=0;
                                        }else
                                        {
                                            $barniz3=1;
                                        }
                             //echo $barniz3;exit;
                             if($maquina=="Máquina Roland 800")
                                {
                                    $recargoPlanchaArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(26);
                                    $recargoPlancha=$recargoPlanchaArray->precio;
                                    $valorParaPlanchaMetal=1;
                                }else
                                {
                                    $recargoPlancha=0;
                                    $valorParaPlanchaMetal=0;
                                }
                             //echo $valorParaPlanchaMetal;exit;
                             $arte=$this->variables_cotizador_model->getVariablesCotizadorPorId(1);
                             $cantidadArte=$fotomecanica->colores*$arte->precio;
							
                             $plancha_metal=$this->variables_cotizador_model->getVariablesCotizadorPorId(2);
							 
                             $cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))+(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
                             //echo $plancha_metal->precio;exit;
                             //$cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*1));
                             
                             $copiado=$this->variables_cotizador_model->getVariablesCotizadorPorId(3);
                             $cantidadCopiapo=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))+(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
                              //$cantidadCopiapo=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3));
                             $peliculasPreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(4);
                             $peliculasVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(28);
                             $cantidadPeliculas=$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$fotomecanica->colores*$peliculasVariable->precio;
                             $montajePreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(5);
                             $cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->colores;
                             
                             
                             if($datos->impresion_hacer_cromalin=='SI')
                             {
                                $cromalinVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(22);
                                $cromalin=$cromalinVariable->precio;
                                $coloresCromalin=1;
                             }else
                             {
                                $cromalin=0;
                                $coloresCromalin=0;
                             }
							 
							 
					 if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
					{
			            $coloresArte= $barniz3 + $fotomecanica->colores;
                                    $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
                                    //$coloresPlanchaMetal=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
                                    $coloresCopiado=$fotomecanica->colores+$barniz3;
                                    //$coloresCopiado=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
                                    $coloresPeliculas=$barniz3 +$fotomecanica->colores;
                                    $coloresMontaje=$barniz3 +$fotomecanica->colores;
                    }
					if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
					{
                
                                            $coloresArte= 0;
                                            $coloresPlanchaMetal = 0;
                                            $coloresCopiado = 0;
                                            $coloresPeliculas = 0;
                                            $coloresMontaje = 0;
                                            $cantidadMontaje=0;
                                            $cantidadArte = 0;
                                            // se cobra $cantidadPlantaMetal = 0;
                                            // se cobra $cantidadCopiapo = 0;
                                            $cantidadPeliculas = 0;
                                            $cromalin = 0;
                                            
                                        }					
				    
					if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
					{
					//exit();	//ver cambio de peliculas con fotomecanicas y validar
                                        $coloresArte= 0;
                                        $coloresPlanchaMetal= 0;
                                        $coloresCopiado=0;
                                        $coloresPeliculas=0;
                                        $coloresMontaje=0;
                                        }
					if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
					{
                                        $coloresArte= 0;
                                        $coloresPlanchaMetal= 0;
                                        $coloresCopiado=0;
                                        $coloresPeliculas=0;
                                        $coloresMontaje=0;
                                        }
                                        

					if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
                                        {
                                            $coloresArte= 0;
                                            $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
                                            $coloresCopiado=$fotomecanica->colores;
                                            $coloresPeliculas=0;
                                            $coloresMontaje=0;
                                            $cantidadArte = 0;
                                            // se cobra $cantidadPlantaMetal = 0;
                                            // se cobra $cantidadCopiapo = 0;
                                            $cantidadPeliculas = 0;
                                            // se cobra $cantidadMontaje = 0;
                                        }					 
					
				//echo "montaje".$cantidadMontaje;	
							 

								
                             $costoVenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(15);
                             $costoAdministracion=$this->variables_cotizador_model->getVariablesCotizadorPorId(16);
                             //$totalPreImpresion=$cantidadArte+$cantidadPlantaMetal+$cantidadCopiapo+$cantidadPeliculas+$cantidadMontaje+$cromalin;
                              if ($fotomecanica->condicion_del_producto=='Repetición Sin Cambios')
                                $totalPreImpresion=$cantidadArte+$cantidadPlantaMetal+$cantidadCopiapo+$cantidadPeliculas+$cromalin;
                             else
                                $totalPreImpresion=$cantidadArte+$cantidadPlantaMetal+$cantidadCopiapo+$cantidadPeliculas+$cantidadMontaje+$cromalin;
//                            
//                              echo "------Pre impresion------<br>";
//                                      
//                                        echo $cantidadArte."<br>";
//                                        echo $cantidadPlantaMetal."<br>";
//                                        echo $cantidadCopiapo."<br>";
//                                        echo $cantidadPeliculas."<br>";
//                                        echo $cantidadMontaje."<br>";
//                                        echo $cromalin."<br>";
//                                            echo "------------<br>";
//                                        exit();
		$cuerpo.='
       <div class="container fuente">
            <header>
                <div>
                <h1><span id="titulo">Cartonajes Grau LTDA.</span> &nbsp;&nbsp;&nbsp; Hoja de Costos
               
                </h1>
                </div>
                <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                <div id="numero_de_costo">
                Número de Costo : '.$id.'
                </div>
                <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                <div id="datos_basicos">
                    <!--tabla HTML-->
                    <table>
                        <tr>
                            <td class="celda_1">Fecha <span class="derecha">:</span></td>
                            <td class="celda_2">'.fecha($datos->fecha).'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">Costeo <span class="derecha">:</span></td>
                            <td class="celda_5">'.$user->nombre.'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">Nombre <span class="derecha">:</span></td>
                            <td class="celda_2">'.$cli->razon_social.'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">E-Mail <span class="derecha">:</span></td>
                            <td class="celda_5">'.$cli->correo.'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">Dirección <span class="derecha">:</span></td>
                            <td class="celda_2">'.$cli->direccion.'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">RUT <span class="derecha">:</span></td>
                            <td class="celda_5">'.esRut($cli->rut).'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">Teléfono <span class="derecha">:</span></td>
                            <td class="celda_2">'.$cli->telefono.'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">Ciudad <span class="derecha">:</span></td>
                            <td class="celda_5">'.$cli->ciudad.'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">Vendedor <span class="derecha">:</span></td>
                            <td class="celda_2">'.$vendedor->nombre.'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">Comuna <span class="derecha">:</span></td>
                            <td class="celda_5">'.$cli->comuna.'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">&nbsp;</td>
                            <td class="celda_2">&nbsp;</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">AT <span class="derecha">:</span></td>
                            <td class="celda_5">'.$cli->contacto.'</td>
                        </tr>
                    </table>
                    <!--/fin tabla HTML-->
                    <!--separador 20-->
                    
                    ';
                    $acabado_1=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_1);
                    
                    $cuerpo.='
                    <!--/separador 20-->
                    <div id="numero_de_costo">
                    Descripción del trabajo
                    </div>
                    
                    <div>
                        '.$ing->producto.', Impreso a '.$fotomecanica->colores.' colores, Barniz:'.$fotomecanica->fot_lleva_barniz.', Reserva Barniz:'.$fotomecanica->fot_reserva_barniz.', Cala Caucho:'.$fotomecanica->fot_cala_caucho.', En Placa'.$fotomecanica->materialidad_1.' onda: '.$fotomecanica->materialidad_2.' liner: '.$fotomecanica->materialidad_3.' Tamaño: '.$ing->medidas_de_la_caja.'X'.$ing->medidas_de_la_caja_2.'X'.$ing->medidas_de_la_caja_3.'X'.$ing->medidas_de_la_caja_4.'
                    </div>
                    <div class="separador_10"></div>
                    <div id="maquina">
                        <strong>Estado del producto: '.$fotomecanica->condicion_del_producto.'</strong>
                    </div>
               
                    <div>
                    <hr class="hr_punteada" />
                    Ancho : '.$tamano1.' Cm, Largo : '.$tamano2.' Cm, UNIDAD/PLIEGO : '.$ing->unidades_por_pliego.', COLORES : '.$fotomecanica->colores.', PIEZAS TOTALES EN EL PLIEGO(Desgajado) : '.$ing->piezas_totales_en_el_pliego.', TERMINACIÓN : '.$acabado_1->caracteristicas.', Barniz: '.$fotomecanica->fot_lleva_barniz.','.$fotomecanica->fot_reserva_barniz.', Trabajos_Externos: '.$totalTrabajosExternos.', Trabajos_Internos: '.$totalTrabajosInternos.'
                    <hr class="hr_punteada" />
                    </div>
                    <div id="cantidad">
                    <strong>Valor por : </strong>'.number_format($datos->cantidad_1,0,"",".").'
                    </div>
                
                    <div>
                        <!--materialidad-->
                        <table >
                            <tr>
                                <td class="celda_66 izquierda">
                                    ';
                    
                                  switch($fotomecanica->materialidad_datos_tecnicos)
                                  {
									  //border="1"
                                    case 'Microcorrugado':
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
//                                        print_r($materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        //print_r($base_imprenta);exit();
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        if ($materialidad_2->precio>0) $materialidad_precio2=($materialidad_2->precio/1000); else $materialidad_precio2=0;
                                        if ($materialidad_3->precio>0) $materialidad_precio3=($materialidad_3->precio/1000); else $materialidad_precio3=0;
                                        if ($materialidad_2->gramaje>0) $materialidad_gramaje2=($materialidad_2->gramaje/1000); else $materialidad_gramaje2=0;
                                        $costo_kilo=0;
                                        if (($materialidad_2->gramaje>0) and ($materialidad_3->gramaje>0) and ($materialidad_2->precio>0))
                                            $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
					else 	
                                            $costo_kilo=0;
									
                                        if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;
                                        }
                                        elseif($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        else
                                        $costo_kilo_obtenido=140;
                                        
                                        $costo_kilo=$costo_kilo+$costo_kilo_obtenido;
										
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                      
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                          //  echo $tira1."<br>";
                                          //  echo $tira2."<br>";
                                            $tiraje=$tira1+$tira2;
//                                           echo $datos->cantidad_1."<br>";
//                                           echo $ing->unidades_por_pliego."<br>";
//                                           echo $sum."<br>";
//                                           echo $factor_rango."<br>";
//                                           echo $base_imprenta->precio."<br>";
//                                           echo $fotomecanica->colores."<br>";
//                                           echo $barniz2."<br>";exit();
                                           
                                         }else
                                         {
                                         $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                         
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                                       /*
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                       */
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'MOLDE GENERICO':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'MOLDE REGISTRADOS DEL CLIENTE':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;   
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO ESTA MOLDE, PRODUCTO NO FABRICADO ANTERIORMENTE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        $ondaGramaje=$materialidad_2->gramaje;
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;
                                        $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
										
										
										
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Microcorrugado
                                        <br />
                                        <span>Tapa: </span> '.$tapa->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_1->reverso.'
                                        <br />
                                        <span>Onda: </span> '.$monda->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_2->reverso.'
                                        <br />
                                        <span>Liner: </span> '.$mliner->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_3->gramaje.' / <strong>Precio:</strong> '.$materialidad_3->precio.'
									    <br />
										<strong>Reverso :</strong>'.$materialidad_3->reverso.'
                                        <br />
                                        COSTO MONOTAPA POR KILO: '.number_format($costo_kilo,0,'','.').' &nbsp; 
										<br />
										GRAMOS ONDA M2 '.$GramosMetroCuadrado.' &nbsp; 
										 <br />
										COSTO MONOTAPA POR M2 '.$costoMonotapaPorMetro2.'
										<br />
										Forma de Pago :'.$forma_pago->forma_pago.'
                                                                                    
                                        <br />
                                        IMPRESIÓN : '.$fotomecanica->impresion.'
                                        <br >
                                        Molde : '.$moldeNombre.'
                                        ';
                                    break;
                                    case 'Corrugado'://la misma
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
										
										if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
										}
										
										if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
										}
										
										
										if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
										}
										
										
										if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
										}
										
										if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
										}
										
										
										if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
										}
										
                                        //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
										
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
										
                                        if($fotomecanica->fot_lleva_barniz=='Nada' || $fotomecanica->fot_lleva_barniz=='')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
//                                             echo $tira1."<br>";
//                                             echo $datos->cantidad_1."<br>";
//                                           echo $ing->unidades_por_pliego."<br>";
//                                           echo $sum."<br>";
//                                           echo $factor_rango."<br>";
//                                           echo $base_imprenta->precio."<br>";
//                                           echo $fotomecanica->colores."<br>";
//                                          echo $barniz2."<br>";exit();
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                                       /*
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                       */
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'MOLDE GENERICO':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'MOLDE REGISTRADOS DEL CLIENTE':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;                                          
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO ESTA MOLDE, PRODUCTO NO FABRICADO ANTERIORMENTE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }  
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        $ondaGramaje=$materialidad_2->gramaje;
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;
										
										
                                        $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
										
										
										
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Corrugado
                                        <br />
                                        <span>Tapa: </span> '.$tapa->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_1->reverso.'
                                        <br />
                                        <span>Onda: </span> '.$monda->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_2->reverso.'
                                        <br />
                                        <span>Liner: </span> '.$mliner->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_3->gramaje.' / <strong>Precio:</strong> '.$materialidad_3->precio.'
									    <br />
										<strong>Reverso :</strong>'.$materialidad_3->reverso.'
                                        <br />
                                        COSTO MONOTAPA POR KILO: '.number_format($costo_kilo,0,'','.').' &nbsp; 
										<br />
										GRAMOS ONDA M2 '.$GramosMetroCuadrado.' &nbsp; 
										 <br />
										COSTO MONOTAPA POR M2 '.$costoMonotapaPorMetro2.'
										<br />
										Forma de Pago :'.$forma_pago->forma_pago.'
                                        <br />
                                        IMPRESIÓN : '.$fotomecanica->impresion.'
                                        <br >
                                        Molde : '.$moldeNombre.'
                                        ';
                                    break;
                                    case 'Cartulina-cartulina':
									
									//-----------
									 $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        //$materialidad_3="No Aplica";;
                                        //$materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
										
                                        //$formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+0*0/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0)))*1000;           
                                       //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
                                        $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                      //  echo "<h1>barniz</h1>:".$barniz2;exit();
                                        if($maquina=="Máquina Roland 800")
                                         {
                                           echo $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                           echo"<br>". $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }   
                                         
                                        
                                         $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+0*0/1000);
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje; //$materialidad_1->gramaje.
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
										
                                        $tapaNombre2=$materialidad_2->nombre;
                                        $tapaGramaje2=$materialidad_2->gramaje;
                                        $tapaFecha2=$materialidad_2->fecha_ultima_actualizacion;
                                        $tapaPrecio2=$materialidad_2->precio;
                                        
                                        $tapaNombre3=$materialidad_3->nombre;
                                        $tapaGramaje3=$materialidad_3->gramaje;
                                        $tapaFecha3=$materialidad_3->fecha_ultima_actualizacion;
                                        $tapaPrecio3=$materialidad_3->precio;
                     
                                        $cuerpo.=
                                        '
                                        <span><strong>Datos técnicos: </strong> </span> Cartulina - Cartulina
                                        <br />
                                        <span><strong>Tapa: </strong> </span>'.$fotomecanica->materialidad_1.' / <strong>Gramaje:</strong> '. $materialidad_1->gramaje .' / <strong>Precio:</strong> '.$materialidad_1->precio.' / <strong>Reverso:</strong> '.$materialidad_1->reverso.'
                                        <br />
                                        <span><strong>Tapa (Respaldo): </strong> </span> '. $fotomecanica->materialidad_3.' / <strong>Gramaje:</strong> '. $materialidad_3->gramaje.' / <strong>Precio:</strong> '. $materialidad_3->precio.' / <strong>Reverso:</strong> '. $materialidad_3->reverso.'
                                        
                                        <br />
                                        IMPRESIÓN : '. $fotomecanica->impresion.'
                                        <br >
                                        Molde : '. $moldeNombre;
									//-----------
									
									
									
                                     
                                    break;
                                    case 'Sólo Cartulina':
									
									$materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        //$materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        //$materialidad_3="No Aplica";;
                                        //$materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
										
                                        //$formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        //$costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+0*0/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0)))*1000;           
                                       //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
                                        $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $costo_kilo=0;
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+0*0/1000);
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'MOLDE GENERICO':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'MOLDE REGISTRADOS DEL CLIENTE':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;                                          
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO ESTA MOLDE, PRODUCTO NO FABRICADO ANTERIORMENTE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }  
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
										
                                        $tapaNombre2=$materialidad_2->nombre;
                                        $tapaGramaje2=$materialidad_2->gramaje;
                                        $tapaFecha2=$materialidad_2->fecha_ultima_actualizacion;
                                        $tapaPrecio2=$materialidad_2->precio;
									
									
                                     $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2="No Aplica";
                                        $materialidad_3="No Aplica";
                                        $materialidad_4="No Aplica";
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Sólo Cartulina
                                        <br />
                                        <span>Tapa: </span> '.$fotomecanica->materialidad_1.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
                                        <br />
                                        
                                        ';
                                    break;
                                    case 'Onda a la Vista ( Micro/Micro )':
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_4);
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Onda a la Vista ( Micro/Micro )
                                        <br />
                                        <span>Liner: </span> '.$fotomecanica->materialidad_1.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
                                        <br />
                                        <span>Onda: </span> '.$fotomecanica->materialidad_2.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
                                        <br />
                                        <span>Liner 2: </span> '.$fotomecanica->materialidad_3.' / <strong>Gramaje:</strong> '.$materialidad_3->gramaje.' / <strong>Precio:</strong> '.$materialidad_3->precio.'
                                        <br />
                                        <span>Onda 2: </span> '.$fotomecanica->materialidad_4.' / <strong>Gramaje:</strong> '.$materialidad_4->gramaje.' / <strong>Precio:</strong> '.$materialidad_4->precio.'
                                        <br />
                                        
                                        ';
                                    break;
                                    case 'Otro':
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3="No Aplica";
                                        $materialidad_4="No Aplica";
                                        $cuerpo.=
                                        '
                                        <strong>Datos técnicos:<strong> Otro
                                        <br />
                                        <strong>Tapa: </strong> '.$fotomecanica->materialidad_1.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
                                        <br />
                                        <span>Tapas: </span> '.$fotomecanica->materialidad_2.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
                                        <br />
                                        
                                        ';
                                    break;
                                    case 'Se solicita proposición':
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Se solicita proposición
                                        <br />
                                        <span>Tapa: </span> '.$fotomecanica->materialidad_1.'
                                        <br />
                                        <span>Tapas: </span> '.$fotomecanica->materialidad_2.'
                                        <br />
                                        
                                        ';
                                    break;
                                //ojo borrar este case
                                    case 'Indefinido':
//                                        exit("paso");
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
										
										if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
										}
										
										if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
										}
										
										
										if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
										}
										
										
										if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
										}
										
										if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
										}
										
										
										if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
										}
										
                                        //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
										
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
										
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                     
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                                                                     
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                                       /*
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                       */
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'MOLDE GENERICO':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'MOLDE REGISTRADOS DEL CLIENTE':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;                                          
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO ESTA MOLDE, PRODUCTO NO FABRICADO ANTERIORMENTE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }  
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        $ondaGramaje=$materialidad_2->gramaje;
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;
                                        $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
										
										
										
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Indefinido
                                        <br />
                                        <span>Tapa: </span> '.$tapa->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_1->reverso.'
                                        <br />
                                        <span>Onda: </span> '.$monda->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_2->reverso.'
                                        <br />
                                        <span>Liner: </span> '.$mliner->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_3->gramaje.' / <strong>Precio:</strong> '.$materialidad_3->precio.'
									    <br />
										<strong>Reverso :</strong>'.$materialidad_3->reverso.'
                                        <br />
                                        COSTO MONOTAPA POR KILO: '.number_format($costo_kilo,0,'','.').' &nbsp; 
										<br />
										GRAMOS ONDA M2 '.$GramosMetroCuadrado.' &nbsp; 
										 <br />
										COSTO MONOTAPA POR M2 '.$costoMonotapaPorMetro2.'
										<br />
										Forma de Pago :'.$forma_pago->forma_pago.'
                                        <br />
                                        IMPRESIÓN : '.$fotomecanica->impresion.'
                                        <br >
                                        Molde : '.$moldeNombre.'
                                        ';
                                    break;                                
                                  }  
                               //valign_top border="1"
                                  /***************procesos especiales******************/
    
    //valores de procesos especiales (Folia y cuno)
     $tesp1=$fotomecanica->folia1_proceso_seletec;
     $tesp2=$fotomecanica->folia2_proceso_seletec;
     $tesp3=$fotomecanica->folia3_proceso_seletec;
     $tesp4=$fotomecanica->cuno1_proceso_seletec;
     $tesp5=$fotomecanica->cuno2_proceso_seletec;
     
      $fv1=$fotomecanica->procesos_especiales_folia_valor;
      $fv2=$fotomecanica->procesos_especiales_folia_2_valor;
      $fv3=$fotomecanica->procesos_especiales_folia_3_valor;
      $cv1=$fotomecanica->procesos_especiales_cuno_valor;
      $cv2=$fotomecanica->procesos_especiales_cuno_2_valor;
    
    //inicializo variable cantidad de procesos especiales
    $procesosespeciales=0;
    
    //contabilizo variable cantidad de procesos especiales
    if($tesp1!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    if($tesp2!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    if($tesp3!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    if($tesp4!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    if($tesp5!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    
    //Lleno los arrays de procesos especiales
    $folia1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_proceso_seletec);
    $folia2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia2_proceso_seletec);
    $folia3=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia3_proceso_seletec);
    $cuno1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno1_proceso_seletec);
    $cuno2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno2_proceso_seletec);
    
    //Lleno los arrays de costos fijos
    $cffolia1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_molde_selected);
    $cffolia2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia2_molde_selected);
    $cffolia3=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia3_molde_selected);
    $cfcuno1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno1_molde_selected);
    $cfcuno2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno2_molde_selected); 
              
    //Totalizo el monto de procesos especiales
    $totaltrabajosespeciales=$folia1->valor_venta+$folia2->valor_venta+$folia3->valor_venta+$cuno1->valor_venta+$cuno2->valor_venta;
    
   //echo "total trabajosespeciales".$totaltrabajosespeciales."<br>";
                                $cuerpo.='    
                                <td>
                <td class="celda_6 valign_top">
                    <!--trabajos externos-->
                    <table border="1">
                            <tr>
                                <td class="celda_5" colspan="10"><strong>&nbsp;&nbsp;Trabajos Externos</strong></td>
                                <td class="celda_5" >&nbsp;Unidad de Uso&nbsp;</td>                                                
                                <td class="celda_5" >&nbsp;Cantidad&nbsp;</td>
                                <td class="celda_5" >&nbsp;Ancho&nbsp;</td>
                                <td class="celda_5" >&nbsp;Largo&nbsp;</td>
                                <td class="celda_5" >&nbsp;M2&nbsp;</td>
                                <td class="celda_5" >&nbsp;V. Unit.M2&nbsp;</td>												
                                <td class="celda_5" >&nbsp;C. Unit&nbsp;</td>
                                <td class="celda_5" >&nbsp;Total&nbsp;</td>                                                
                            </tr>';
                                  
               if($procesosespeciales>0 && $tesp1 != 0){ 
               $cuerpo.='<tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;'.str_replace("�", "ñ", ucwords(strtolower($folia1->caracteristicas))).'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$folia1->unidades_de_venta.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$datos->cantidad_1.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$folia1->ancho.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$folia1->largo.'&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>												
                    <td class="celda_3">&nbsp;'.$folia1->valor_venta.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$folia1->valor_venta.'&nbsp;</td>';
                    if ($fv1=="Nuevo"){ 
                        $costo1=$folia1->valor_venta*$datos->cantidad_1;
                        $costoa1=$cffolia1->valor_venta;
                    $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo1,0,"",".").'&nbsp;</td></tr>
                    <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;Molde Folia&nbsp;</td>
                    <td class="celda_5">&nbsp;Monto Fijo</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>												
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;'.number_format($costoa1,0,"",".").'&nbsp;</td></tr>';
                     }else{
                    $costo1=$folia1->valor_venta*$datos->cantidad_1;
                    $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo1,0,"",".").'&nbsp;</td></tr>';
                     } 
                }
                
                 if($procesosespeciales>0 && $tesp2 != 0){ 
               $cuerpo.='<tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;'.str_replace("�", "ñ", ucwords(strtolower($folia2->caracteristicas))).'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$folia2->unidades_de_venta.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$datos->cantidad_1.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$folia2->ancho.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$folia2->largo.'&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>												
                    <td class="celda_3">&nbsp;'.$folia2->valor_venta.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$folia2->valor_venta.'&nbsp;</td>';
                     if ($fv2=="Nuevo"){
                         $costo2=$folia2->valor_venta*$datos->cantidad_1;
                         $costoa2=$cffolia2->valor_venta;
                    $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo2,0,"",".").'&nbsp;</td></tr>
                    <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;Molde Folia&nbsp;</td>
                    <td class="celda_5">&nbsp;Monto Fijo</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>												
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;'.number_format($costoa2,0,'','.').'&nbsp;</td></tr>';
                    
                     }else{ 
                         $costo2=$folia2->valor_venta*$datos->cantidad_1; 
                    $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo2,0,"",".").'&nbsp;</td></tr>';
                     } 
                     }    
                     if($procesosespeciales>0 && $tesp3 != 0){ 
                    $cuerpo.='<tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;'.str_replace("�", "ñ", ucwords(strtolower($folia3->caracteristicas))).'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$folia3->unidades_de_venta.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$datos->cantidad_1.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$folia3->ancho.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$folia3->largo.'&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>												
                    <td class="celda_3">&nbsp;'.$folia3->valor_venta.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$folia3->valor_venta.'&nbsp;</td>';
                    if ($fv3=="Nuevo"){ 
                    $costo3=$folia3->valor_venta*$datos->cantidad_1; 
                    $costoa3=$cffolia3->valor_venta;
                    $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo3,0,"",".").'&nbsp;</td></tr>
                    <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;Molde Folia&nbsp;</td>
                    <td class="celda_5">&nbsp;Monto Fijo</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>												
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;'.number_format($costoa3,0,"",".").'&nbsp;</td></tr>';
                    
                    }else{ 
                        $costo3=$folia3->valor_venta*$datos->cantidad_1;
                    $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo3,0,'','.').'</td></tr>';
                    }
                    } 
                    
                     if($procesosespeciales>0 && $tesp4 != 0){ 
                    $cuerpo.='<tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;'.str_replace("�", "ñ", ucwords(strtolower($cuno1->caracteristicas))).'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$cuno1->unidades_de_venta.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$datos->cantidad_1.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$cuno1->ancho.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$cuno1->largo.'&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>												
                    <td class="celda_3">&nbsp;'.$cuno1->valor_venta.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$cuno1->valor_venta.'&nbsp;</td>';
                    if ($cv1=="Nuevo"){
                    $costo4=$cuno1->valor_venta*$datos->cantidad_1;
                    $costoa4=$cfcuno1->valor_venta;
                    $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo4,0,"",".").'&nbsp;</td></tr>
                    <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;Molde Folia&nbsp;</td>
                    <td class="celda_5">&nbsp;Monto Fijo</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>												
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;'.number_format($costoa4,0,"",".").'&nbsp;</td></tr>';
                    
                    }else{ 
                    $costo4=$cuno1->valor_venta*$datos->cantidad_1;
                    $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo4,0,"",".").'&nbsp;</td></tr>';
                    }
                    }
                     if($procesosespeciales>0 && $tesp5 != 0){ 
                    $cuerpo.='<tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;'.str_replace("�", "ñ", ucwords(strtolower($cuno2->caracteristicas))).'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$cuno2->unidades_de_venta.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$datos->cantidad_1.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$cuno2->ancho.'&nbsp;</td>
                    <td class="celda_5">&nbsp;'.$cuno2->largo.'&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>												
                    <td class="celda_3">&nbsp;'.$cuno2->valor_venta.'&nbsp;</td>
                    <td class="celda_3">&nbsp;'.$cuno2->valor_venta.'&nbsp;</td>';
                     if ($cv2=="Nuevo"){ 
                    $costo5=$cuno2->valor_venta*$datos->cantidad_1;
                    $costoa5=$cfcuno2->valor_venta;
                    $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo5,0,"",".").'&nbsp;</td></tr>
                    <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;Molde Folia&nbsp;</td>
                    <td class="celda_5">&nbsp;Monto Fijo</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>
                    <td class="celda_5">&nbsp;&nbsp;</td>												
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;&nbsp;</td>
                    <td class="celda_3">&nbsp;'.number_format($costoa5,0,"",".").'&nbsp;</td></tr>';
                    
                     }else{
                     $costo5=$cuno2->valor_venta*$datos->cantidad_1;
                     $cuerpo.='<td class="celda_3">&nbsp;'.number_format($costo5,0,"",".").'&nbsp;</td></tr>';
                     }
                    }        
                                
                                //$cantidad_4=$datos->cantidad_4 / $ing->unidades_por_pliego;
                                $externos_produccion=0;
//                                exit($fotomecanica->acabado_impresion_4."hollaaa");
				if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
                                    
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                        $cantidad_4=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datos->cantidad_1*$acabado_4Valor);
                                        $cantidad_4=$datos->cantidad_1;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=$acabado_4MedidaMasValorVenta*$datos->cantidad_1;
                                        $cantidad_4=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datos->cantidad_1);
                                        $cantidad_4=$datos->cantidad_1;                                        
                                    }                                      
                                }
					

                                if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);                                      
                                        $cantidad_5=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datos->cantidad_1*$acabado_5Valor);
                                        $cantidad_5=$datos->cantidad_1;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=$acabado_5MedidaMasValorVenta*$datos->cantidad_1;
                                        $cantidad_5=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datos->cantidad_1);
                                        $cantidad_5=$datos->cantidad_1;
                                    }                                      
                                }    
                                if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datos->cantidad_1*$acabado_5Valor);
                                        $cantidad_6=$datos->cantidad_1;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta;
                                        $precio_total_6=$acabado_6MedidaMasValorVenta*$datos->cantidad_1;
                                        $cantidad_6=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datos->cantidad_1);
                                        $cantidad_6=$datos->cantidad_1;
                                    }                                      
									

                                }           
               $cuerpo.=' <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;'; $cuerpo.=str_replace("�", "ñ", ucwords(strtolower($acabado_4))); $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;'; $cuerpo.=$acabado_4UnidadVentaNombre; $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;'; if ($cantidad_4!="") $cuerpo.=$cantidad_4; $cuerpo.='&nbsp;</td>
                    <td class="celda_3">&nbsp;'; if ($acabado_4UnidadVentaNombre!="") $cuerpo.=$tamano1; else $cuerpo.= "";  $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;'; if ($acabado_4UnidadVentaNombre!="") $cuerpo.=$tamano2; else $cuerpo.= "";  $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;'; if ($acabado_4UnidadVentaNombre!="") $cuerpo.=(($tamano1*$tamano2)/10000); else $cuerpo.= "";  $cuerpo.='&nbsp;</td>												
                    <td class="celda_3">&nbsp;'; if ($acabado_4Valor>0) $cuerpo.= number_format($acabado_4Valor,0,'','.'); else $cuerpo.= "";  $cuerpo.='&nbsp;</td>
                    <td class="celda_3">&nbsp;'; if ($costo_unitario4>0) $cuerpo.= number_format($costo_unitario4,0,'','.'); else $cuerpo.= "";  $cuerpo.='&nbsp;</td>
                    <td class="celda_3">&nbsp;'; if ($precio_total_4>0) $cuerpo.= number_format($precio_total_4,0,'','.'); else $cuerpo.= "";  $cuerpo.='&nbsp;</td>
                </tr>
                <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;'; $cuerpo.=ucwords(strtolower($acabado_5)); $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;'; $cuerpo.=$acabado_5UnidadVentaNombre; $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;';  if ($cantidad_5!="") $cuerpo.= $cantidad_5; $cuerpo.='&nbsp;</td>
                    <td class="celda_3">&nbsp;';  if ($acabado_5UnidadVentaNombre!="") $cuerpo.= $tamano1; else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;';  if ($acabado_5UnidadVentaNombre!="") $cuerpo.= $tamano2; else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;';  if ($acabado_5UnidadVentaNombre!="") $cuerpo.= (($tamano1*$tamano2)/10000); else $cuerpo.= ""; $cuerpo.='&nbsp;</td>												
                    <td class="celda_3">&nbsp;';  if ($acabado_5Valor>0) $cuerpo.= number_format($acabado_5Valor,0,'','.'); else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                    <td class="celda_3">&nbsp;';  if ($costo_unitario5>0) $cuerpo.= number_format($costo_unitario5,0,'','.'); else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                    <td class="celda_3">&nbsp;';  if ($precio_total_5>0) $cuerpo.= number_format($precio_total_5,0,'','.'); else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                </tr>
                <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;'; $cuerpo.=ucwords(strtolower($acabado_6)); $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;'; $cuerpo.=$acabado_6UnidadVentaNombre; $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;';  if ($cantidad_6!="") echo $cantidad_6; $cuerpo.='&nbsp;</td>
                    <td class="celda_3">&nbsp;';  if ($acabado_6UnidadVentaNombre!="") echo $tamano1; else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;';  if ($acabado_6UnidadVentaNombre!="") echo $tamano2; else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                    <td class="celda_5">&nbsp;';  if ($acabado_6UnidadVentaNombre!="") echo (($tamano1*$tamano2)/10000); else $cuerpo.= ""; $cuerpo.='&nbsp;</td>												
                    <td class="celda_3">&nbsp;';  if ($acabado_6Valor>0) echo number_format($acabado_6Valor,0,'','.'); else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                    <td class="celda_3">&nbsp;';  if ($costo_unitario6>0) echo number_format($costo_unitario6,0,'','.'); else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                    <td class="celda_3">&nbsp;';  if ($precio_total_6>0) echo number_format($precio_total_6,0,'','.'); else $cuerpo.= ""; $cuerpo.='&nbsp;</td>
                </tr>
                <tr>
                    <td class="celda_5" colspan="17"><strong>&nbsp;&nbsp;Total Precio de Trabajos Externos</strong></td>
                    <td>&nbsp;&nbsp;'; if($hoja->valor_externo!=0){ $externos_produccion=$externos_produccion+$hoja->valor_externo+$costo1+$costo2+$costo3+$costo4+$costo5+$costoa1+$costoa2+$costoa3+$costoa4+$costoa5; $cuerpo.= number_format($hoja->valor_externo,0,'','.');}else{  $externos_produccion=$precio_total_4+$precio_total_5+$precio_total_6+$costo1+$costo2+$costo3+$costo4+$costo5+$costoa1+$costoa2+$costoa3+$costoa4+$costoa5; $cuerpo.= number_format($externos_produccion,0,'','.');} $cuerpo.='</td>
                </tr>                   
                <tr>
                    <td class="celda_5" colspan="10"><strong>&nbsp;&nbsp;Piezas Adicionales</strong></td>
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>												
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>											
                    <td class="celda_5">&nbsp;</td>
                </tr>';

                if($ing->piezas_adicionales == 'NO LLEVA')
                {
                    $piezaAdacionalNom1 ="No Lleva";
                    $piezaAdacionalValor1="&nbsp;";
                    $piezaAdacionalTotal1="&nbsp;";
                    $piezaAdacionalEmpresa1="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales);
                    $piezaUnidadVentaNombre1=$piezasAdicionales->unv; //Nombre unidad de venta
                    $piezaAdacionalNom1 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor1= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal1 = $datos->cantidad_1 * $piezaAdacionalValor1;
                    $piezaAdacionalEmpresa1= $hoja->piezas_adicionales1;
                }
                if($ing->piezas_adicionales2 == 'NO LLEVA')
                {
                    $piezaAdacionalNom2 ="No Lleva";
                    $piezaAdacionalValor2="&nbsp;";
                    $piezaAdacionalTotal2="&nbsp;";
                    $piezaAdacionalEmpresa2="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales2);
                    $piezaUnidadVentaNombre2=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom2 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor2= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal2= $datos->cantidad_1 * $piezaAdacionalValor2;
                    $piezaAdacionalEmpresa2= $hoja->piezas_adicionales2;
                }
                if($ing->piezas_adicionales3 == 'NO LLEVA')
                {
                    $piezaAdacionalNom3 ="No Lleva";
                    $piezaAdacionalValor3="&nbsp;";
                    $piezaAdacionalTotal3="&nbsp;";
                    $piezaAdacionalEmpresa3="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales3);
                    $piezaUnidadVentaNombre3=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom3 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor3 =  $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal3= $datos->cantidad_1 * $piezaAdacionalValor3;;
                    $piezaAdacionalEmpresa3= $hoja->piezas_adicionales3;
                }
                $cuerpo.=' <tr>
                <td class="celda_5" colspan="10">&nbsp;&nbsp;'; $cuerpo.=ucwords(strtolower($piezaAdacionalNom1)); $cuerpo.='&nbsp;</td>
                <td class="celda_5" >&nbsp;'; $cuerpo.=$piezaUnidadVentaNombre1; $cuerpo.='&nbsp;</td>
                <td class="celda_5">&nbsp;';  if ($piezaUnidadVentaNombre1!="") $cuerpo.= $datos->cantidad_1; else $cuerpo.= "";  $cuerpo.='&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;'; if ($piezaUnidadVentaNombre1!="") $cuerpo.= $piezaAdacionalValor1; else $cuerpo.= "";  $cuerpo.='&nbsp;</td>					
                <td class="celda_3">&nbsp;&nbsp;'.number_format($piezaAdacionalTotal1,0,'','.').'&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td class="celda_5" colspan="10">&nbsp;&nbsp;'; $cuerpo.=ucwords(strtolower($piezaAdacionalNom2)); $cuerpo.='&nbsp;</td>
                <td class="celda_5" >&nbsp;'; $cuerpo.=$piezaUnidadVentaNombre2; $cuerpo.='&nbsp;</td>                                                
                <td class="celda_5">&nbsp;'; if ($piezaUnidadVentaNombre2!="") $cuerpo.= $datos->cantidad_1; else $cuerpo.= "";  $cuerpo.='&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;'; if ($piezaUnidadVentaNombre2!="") $cuerpo.= $piezaAdacionalValor2; else $cuerpo.= "";  $cuerpo.='&nbsp;</td>					
                <td class="celda_3">&nbsp;&nbsp;'; $cuerpo.=number_format($piezaAdacionalTotal2,0,'','.'); $cuerpo.='&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td class="celda_5" colspan="10">&nbsp;&nbsp;'; $cuerpo.=ucwords(strtolower($piezaAdacionalNom3)); $cuerpo.='&nbsp;</td>
                <td class="celda_5" >&nbsp;'; $cuerpo.=$piezaUnidadVentaNombre3; $cuerpo.='&nbsp;</td>                                                
                <td class="celda_5">&nbsp;'; if ($piezaUnidadVentaNombre3!="") $cuerpo.= $datos->cantidad_1; else $cuerpo.= "";  $cuerpo.='&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;'; if ($piezaUnidadVentaNombre3!="") $cuerpo.= $piezaAdacionalValor3; else $cuerpo.= "";  $cuerpo.='&nbsp;</td>					
                <td class="celda_3">&nbsp;&nbsp;'; $cuerpo.=number_format($piezaAdacionalTotal3,0,'','.'); $cuerpo.='&nbsp;&nbsp;</td>
            </tr>
                <tr>
                    <td class="celda_5" colspan="17"><strong>&nbsp;&nbsp;Total Precio de Piezas Adicionales</strong></td>
                    <td>&nbsp;&nbsp;'; if($hoja->valor_piezas!=0){ $piezas_produccion=$piezas_produccion+$hoja->valor_piezas;  $cuerpo.= number_format($hoja->valor_piezas,0,'','.');}else{  $piezas_produccion=$piezaAdacionalTotal1+$piezaAdacionalTotal2+$piezaAdacionalTotal3; $cuerpo.= number_format($piezas_produccion,0,'','.');}  $cuerpo.='</td>
                </tr>      
                <tr>
                    <td class="celda_5" colspan="17"><strong>&nbsp;&nbsp;Total Externos</strong></td>
                    <td class="celda_5" >&nbsp;'; $externos_produccion=$externos_produccion;//$externos_produccion=$externos_produccion+$piezas_produccion; 
                    $cuerpo.= number_format(($externos_produccion),0,'','.');   $cuerpo.='&nbsp;</td>
                </tr>                  
											
		
											
                </table>
                                    <!--/trabajos externos-->
                                </td>
                                </td>
                            </tr>
                        </table>
                        <!--/materialidad-->
                    </div>
                    ';
					
					
					
					
                     /**
                     * pre producción
                     * */ 
                    $cuerpo.='
                    <div class="separador_10"></div>
                    <div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">MAT.PRIMAS</td>
                                <td class="celda_3">CANT/PLIEGO</td>
                                <td class="celda_3">VALOR $</td>
                                <td class="celda_3">PRODUCCIÓN</td>
                                <td class="celda_3">UNITARIO</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="6"><hr class="hr_punteada" /></td>
                            </tr>';
                            //$costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            //$valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            //$totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
                            
							/*$costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							*/
							$costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
                        
						//<td class="celda_3">TAPA KILO '.number_format($valorPlacaKilo,0,'','.').'</td>
						

                            $cuerpo.='
                            <tr>
                                <td class="celda_3">TAPA KILO '.number_format($valorPlacaKilo,0,'','.').'</td>
                                <td class="celda_3">'.number_format($costoPlacaKilo,0,'','.').'</td>
                                <td class="celda_3">'.number_format($totalPlacaKilo,0,'','.').'</td>
                                <td class="celda_3 valign_top padding_left_10" colspan="3" rowspan="30">
                                    <!--producción-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td class="celda_33">TIRAJE</td>
                                            <td class="celda_33">'.$factor_rango.'</td>
                                            <td class="celda_33">'.number_format($tiraje,0,'','.').'</td>
                                        </tr>';
                                        $variableComplemento=$this->variables_cotizador_model->getVariablesCotizadorPorId(32);
                                        $valorTiraje=$variableComplemento->precio-$tiraje;
                                        if($valorTiraje>0)
                                        {
                                           		if($fotomecanica->colores == 0)
											{
												$complemento=0;
											}else{
											 $complemento=$valorTiraje;	
											}
                                        }else
                                        {
                                            $complemento=0;
                                        }
										
										//Total externo
										 if($hoja->valor_acabado_1 >= 1 )
								  {
									  $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_1;
								  }else
								  {
									  $externos_produccion = $externos_produccion +(($acabado_4Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
								  }
								  
						      	  if($hoja->valor_acabado_2 >= 1 )
								  {
									    $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_2;
								  }else
								  {
									  $externos_produccion = $externos_produccion + (($acabado_5Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
								  }
								  if($hoja->valor_acabado_3 >= 1 )
								  {
									  $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_3;
								  }else
								  {
									  $externos_produccion = $externos_produccion + (($acabado_6Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
								  }
								  
//                                        $costosporlacado=(35000+(52*($datos->cantidad_1/$ing->unidades_por_pliego)));
//                                        $costosporlacado2=(35000+(52*($datos->cantidad_2/$ing->unidades_por_pliego)));
//                                        $costosporlacado3=(35000+(52*($datos->cantidad_3/$ing->unidades_por_pliego)));
//                                        $costosporlacado4=(35000+(52*($datos->cantidad_4/$ing->unidades_por_pliego)));
                                         if($fotomecanica->fot_lleva_barniz=='Laca UV'){
        $costosporlacado=(35000+(52*($datos->cantidad_1/$ing->unidades_por_pliego)));
        $costosporlacado2=(35000+(52*($datos->cantidad_2/$ing->unidades_por_pliego)));
        $costosporlacado3=(35000+(52*($datos->cantidad_3/$ing->unidades_por_pliego)));
        $costosporlacado4=(35000+(52*($datos->cantidad_4/$ing->unidades_por_pliego)));
        }else{
        $costosporlacado=0;
        $costosporlacado2=0;
        $costosporlacado3=0;
        $costosporlacado4=0;
        }
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">COMPLEMENTO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($complemento,0,'','.').'</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">EXTERNOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($externos_produccion,0,'','.').'</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTOS POR LACADO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($costosporlacado,0,'','.').'</td>
                                        </tr>';
                                        if($maquina=="Máquina Roland 800")
                                            {
                                                $costoOndaKilo=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                                                
                                            }else
                                            {
                                                $costoOndaKilo=(($datos->cantidad_1/$ing->unidades_por_pliego)+100)+4;
                                                
                                            }
											
											
                                        /*
										    $valorOndaKilo=($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000;
                                            $totalOndaKilo=$valorOndaKilo*$costo_kilo;
                                            $valorCorte=$costoOndaKilo*4.5;
											
										*/
										if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
											{
												$costoOndaKilo=0;
												$valorOndaKilo=0;
												$totalOndaKilo=0;
												$valorCorte=0;
										
											}else{
                                            $valorOndaKilo=($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000;
                                            
                                            $totalOndaKilo=$valorOndaKilo*$costo_kilo;
                                            
//                                            $tres=$totalOndaKilo."=".$valorOndaKilo."*".$costo_kilo.'-------------------------------';
                                            
                                        $valorCorte=$costoOndaKilo*4.5;
											}
										
										
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">CORTE</td>
                                            <td class="celda_33">4.5</td>
                                            <td class="celda_33">'.number_format($valorCorte,0,'','.').'</td>
                                        </tr>';
                                        $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
                                        $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
                                        $totalEmplacado=$valorEmplacadado*$costoOndaKilo;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">EMPLACADO</td>
                                            <td class="celda_33">'.$valorEmplacadado.'</td>
                                            <td class="celda_33">'.number_format($totalEmplacado,0,'','.').'</td>
                                        </tr>';
						
                                        if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                                        {
                                            $variableMontajeMoldeTroquel=0;
                                            $totalMontajeMolde=0;
                                        }else
                                        {
                                            $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                                            $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                                            $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                                        }                                            

                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">MONTAJE MOLDE</td>
                                            <td class="celda_33">'.number_format($variableMontajeMoldeTroquel->precio,0,'','.').'</td>
                                            <td class="celda_33">'.number_format($totalMontajeMolde,0,'','.').'</td>
                                        </tr>';
						
                                        
                                                if($fotomecanica->estan_los_moldes == 'NO LLEVA')
						{
                                                    $variableTroquelado=0;
                                                    $totalTroquelado=0;
						}else
						{
                                                    $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                                                    $totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
						}                                          

                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">TROQUELADO</td>
                                            <td class="celda_33">'.$variableTroquelado->precio.'</td>
                                            <td class="celda_33">'.number_format($totalTroquelado,0,'','.').'</td>
                                        </tr>';
                                        
                                                
                                        $variableDesgajado=$this->variables_cotizador_model->getVariablesCotizadorPorId(12);
                                        $totalDesgajado=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOndaKilo;
                                        
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">DESGAJADO</td>
                                            <td class="celda_33">'.$variableDesgajado->precio.'</td>
                                            <td class="celda_33">'.number_format($totalDesgajado,0,'','.').'</td>
                                        </tr>';
                                        //$variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                        //$totalPegado=$datos->cantidad_1*$presupuesto->costo_pegado*$variablePegado->precio;
										
					$variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                        $totalPegado=$datos->cantidad_1*$hoja->pegado*$variablePegado->precio;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">PEGADO</td>
                                            <td class="celda_33">'.number_format($hoja->pegado,0,'','.').'</td>
                                            <td class="celda_33">'.number_format($totalPegado,0,'','.').'</td>
                                        </tr>';
                                     
										
										 if(sizeof($hoja->pegado)>=1)
										 {
											 $divisionPegado=$hoja->pegado/2;
															$totalDespacho=$divisionPegado*$datos->cantidad_1;
										 }
										 else
										 {
										$divisionPegado=$presupuesto->costo_pegado/2;
															$totalDespacho=$divisionPegado*$datos->cantidad_1;	 
										 }
										
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">DESPACHO</td>
                                            <td class="celda_33">'.$divisionPegado.'</td>
                                            <td class="celda_33">'.number_format($totalDespacho,0,'','.').'</td>
                                        </tr>
                                        ';
										
										
										 if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
											{
												 if($fotomecanica->estan_los_moldes == 'NO')
												{
														$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
														$moldeTroquel=$variableTroquel->precio;
												}elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
												{
														$moldeTroquel=0;
												}elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
												{
														$moldeTroquel=0;
												}
											}
											
											if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
                                                                                        {

                                                                                        if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                                                                                        {
                                                                                                $variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                                                                                //$moldeTroquel=$variableTroquel->precio;
                                                                                                $moldeTroquel=0;
                                                                                        }
                                                                                        }							
											
											if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
											{

														$moldeTroquel=0;
										
											}
											if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
											{
														$moldeTroquel=0;
											}
										
										
                                  
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">MOLDE TROQUEL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($moldeTroquel,0,'','.').'</td>
                                        </tr>
                                        ';
										$variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(39);
										 if($fotomecanica->lleva_barniz == 'SI' and $fotomecanica->reserva_barniz == 'SI')
										 {
											 $otrosCaucho = $variableEmplacado->precio; 
										 }else
										 {
											$otrosCaucho = 0;
										 }
										 if($fotomecanica->fot_cala_caucho== 'Si')
										 {
											 $otrosCaucho = 50000; 
										 }else
										 {
											$otrosCaucho = 0;
										 }
										 $cuerpo.='
                                        <tr>
                                            <td class="celda_33">CAUCHO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($otrosCaucho,0,'','.').'</td>
                                        </tr>
                                        ';
										if($piezaAdacionalEmpresa1 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa1;

					 }
					 else
					 {
						 	$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal1;
						 
					 }
					 
					  if($piezaAdacionalEmpresa2 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa2;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal2;
						 
					 }
					 
					 
					  if( $piezaAdacionalEmpresa3 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa3;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal3;
						 
					 }
					$cuerpo.='
                                        <tr>
                                            <td class="celda_33">PIEZAS ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($TotalPiezasAdicionales,0,'','.').'</td>
                                        </tr>';
                                        
                                        if($hoja->valor_bv_maquina == '')
                                            { 
                                            if ($datos->vb_maquina=="SI") {
                                                $valor_bv_maquina=50000; 
                                            }else{ $valor_bv_maquina=0; 
                                            $vbm= number_format($valor_bv_maquina,0,'','.');
                                            }
                                            }else{
                                                $vbm= number_format($hoja->valor_bv_maquina,0,'','.'); 
                                                $valor_bv_maquina=$hoja->valor_bv_maquina;
                                                $vbm= number_format($valor_bv_maquina,0,'','.');
                                            }
                                            
                                            
                                            if($hoja->valor_acepeta_exce == ''){ 
                                                if ($datos->acepta_excedentes=="SI"){ 
                                                    $valor_acepeta_exce=0; 
                                                }else{ 
                                                    $valor_acepeta_exce=100000; 
                                                    $acepta=number_format($valor_acepeta_exce,0,'','.');
                                                }
                                                }else{
                                                    $acepta=number_format($hoja->valor_acepeta_exce,0,'','.'); 
                                                    $valor_acepeta_exce=$hoja->valor_acepeta_exce;
                                                    
                                                }
                                            
                                           if($datos->acepta_excedentes=='NO')
                            {
                                $valorFinanciado=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado);
                                $valorFinanciado2=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado2);
                                $valorFinanciado3=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado3);
                                $valorFinanciado4=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado4);
                            } 
					$cuerpo.='
                                        <tr>
                                            <td class="celda_33">VISTO BUENO EN MAQUINA</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($valor_bv_maquina,0,'','.').'</td>
                                        </tr>';
					$cuerpo.='
                                        <tr>
                                            <td class="celda_33">NO ACEPTA EXCEDENTES</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.$valor_acepeta_exce.'</td>
                                        </tr>';
                                        
										
										
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33" colspan="3"><hr class="hr_punteada" /></td>
                                        </tr>';
                                        //$totalProduccion=$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel;
					//modificado por valores adicionales al final $totalProduccion=$costosporlacado+$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_bv_maquina;
                                        $totalProduccion=$costosporlacado+$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($totalProduccion,0,'','.').'</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33" colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33"><span class="subrayado">COSTOS VARIOS</span></td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                                        </tr>';
                                        //$totalMateriaPrima    
                                        $costoVentaValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;
//                                       
//                                        echo "------------<br>";
//                                         echo $totalOndaKilo."<br>";
//                                        echo $totalPlacaKilo."<br>";
//                                        echo $totalPreImpresion."<br>";
//                                        echo $totalProduccion."<br>";
//                                        echo $costoVenta->precio."<br>";
//                                        echo "------------<br>";
//                                        echo $totalOndaKilo."<br>";
//                                        echo $totalPlacaKilo."<br>";
//                                        echo $totalPreImpresion."<br>";
//                                        echo $totalProduccion."<br>";
//                                        echo $costoVenta->precio."<br>";
//                                        echo $costoVentaValor."<br>";
                                        //exit();

                                        
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">COSTO VENTA</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($costoVentaValor,0,'','.').'</td>
                                        </tr>';
                                         $costoAdministracionValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoAdministracion->precio)/100;
//                                         exit($costoAdministracionValor.'=(('.$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoAdministracion->precio.")/100");
                                         
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">COSTO ADMINISTRACIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($costoAdministracionValor,0,'','.').'</td>
                                        </tr>';
                                        $cuerpo.=' <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'; if ($hoja->valor_extra!='') { $cuerpo.=number_format($hoja->valor_extra,0,'','.'); $valor_extra=$hoja->valor_extra; } else {$valor_extra=0; $cuerpo.='0';} $cuerpo.='</td>
                                        </tr>';                                        
                                       // $totalCostosVarios=$costoAdministracionValor+$costoVentaValor;
                                       if ($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') {
            $costoPlacaKilo2 = ($datos->cantidad_1 / $ing->unidades_por_pliego);
            $cuatro_por_ciento = ($costoPlacaKilo2 / 100) * 4;
            if ($cuatro_por_ciento >= 1 and $cuatro_por_ciento <= 100) {
                $agregado_a_apliegos = 100;
            }
            if ($cuatro_por_ciento > 100) {
                $agregado_a_apliegos = $cuatro_por_ciento;
            }
            $costoPlacaKilo2 = $costoPlacaKilo2 + $agregado_a_apliegos;
            $valorPlacaKilo2 = ($costoPlacaKilo2 * $tamano1 * $tamano2 * $tapaGramaje3) / 10000000;
            $totalPlacaKilo2 = $valorPlacaKilo2 * $tapaPrecio3;
            $merma = $totalPlacaKilo2;
        } else {
            $merma = $totalOndaKilo;
        }
        echo $variable = ((($totalPlacaKilo*7)/100) + (($merma*10)/100))*0.17;
        
                                        
					$totalCostosVarios=$costoAdministracionValor+$costoVentaValor+$valor_extra+$variable;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">TOTAL COSTOS VARIOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($totalCostosVarios,0,'','.').'</td>
                                        </tr>
                                    </table>
                                    <!--/producción-->
                                </td>
                            </tr>';
                             $corte=$totalPlacaKilo;
                             $cuerpo.='
                            <tr>
                                <td class="celda_3">CORTE: 10 %</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'. number_format(($corte*7)/100,0,"",".").'</td>
                            </tr>';
                            $corteTotalPorcentaje=($corte*7)/100;
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
							{		
							$costoPlacaKilo2=($datos->cantidad_1/$ing->unidades_por_pliego);
									
							$cuatro_por_ciento = ($costoPlacaKilo2 / 100)* 4;
							
							//if($costoPlacaKilo2 >= 1 and $costoPlacaKilo2 <= 100)
							if($cuatro_por_ciento >= 1 and $cuatro_por_ciento <= 100)
							{
								$agregado_a_apliegos = 100;
							}
							
							if($cuatro_por_ciento > 100)
							{
								$agregado_a_apliegos = $cuatro_por_ciento;
							}
							$costoPlacaKilo2 = $costoPlacaKilo2 + $agregado_a_apliegos;
							$valorPlacaKilo2 = ($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje3)/10000000;
                                                        //$valorPlacaKilo2 = number_format($valorPlacaKilo2,0,'','.');
                                                        $totalPlacaKilo2 = $valorPlacaKilo2*$tapaPrecio3;
                                                        
							
//							$valorPlacaKilo2=($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje)/10000000;
//							$totalPlacaKilo2=$valorPlacaKilo2*$tapaPrecio2;
									
									 $cuerpo.='
										<tr>
										<td class="celda_3">KILO (RESPALDO):'.number_format($valorPlacaKilo2,0,'','.').'</td>
										<td class="celda_3">'.number_format($costoPlacaKilo2,0,'','.').'</td>
										<td class="celda_3">'.number_format($totalPlacaKilo2,0,'','.').'</td>
										</tr> ';
									$merma=$totalPlacaKilo2;
								}else								
								{
									 $cuerpo.='
										<tr>
										<td class="celda_3">ONDA KILO '.number_format($valorOndaKilo,0,'','.').'</td>
										<td class="celda_3">'.number_format($costoOndaKilo,0,'','.').'</td>
										<td class="celda_3">'.number_format($totalOndaKilo,0,'','.').'</td>
										</tr> ';
                                                                         $merma=$totalOndaKilo;
								}
							
							
                            $cuerpo.='
                            <tr>
                                <td class="celda_3">MERMA: 10 %</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'. number_format(($merma*10)/100,0,"",".").'</td>
                            </tr>';
                            $mermaTotalPorcentaje=($merma*10)/100;
                            $cuerpo.='

                            <!--
                            <tr>
                                <td class="celda_3">SEDAS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            -->
                            <tr>
                                <td class="celda_3">VARIOS</td>
                                <td class="celda_3">0</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>';
                            
							
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima= $totalPlacaKilo+$totalPlacaKilo2+$corteTotalPorcentaje+$mermaTotalPorcentaje;
								}else
								{
									$totalMateriaPrima= $totalOndaKilo+$totalPlacaKilo+$corteTotalPorcentaje+$mermaTotalPorcentaje;	
								}
							
							
                            $cuerpo.='
                            <tr>
                                <td class="celda_3"><span class="subrayado_top">TOTAL MATERIA PRIMA</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalMateriaPrima,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>';
                            
                            $cuerpo.='
                            <tr>
                                <td class="celda_3">PRE-IMPRESIÓN</td>
                                <td class="celda_3">CANTIDAD</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">ARTE '.$coloresArte.'</td>
                                <td class="celda_3">'.number_format($arte->precio,0,'','.').'</td>
                                <td class="celda_3">'.number_format($cantidadArte,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">PLANCHAMETAL '.$coloresPlanchaMetal.'</td>
                                <td class="celda_3">'.number_format($plancha_metal->precio,0,'','.').'</td>
                                <td class="celda_3">'.number_format($cantidadPlantaMetal,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">COPIADO '.$coloresCopiado.'</td>
                                <td class="celda_3">'.number_format($copiado->precio,0,'','.').'</td>
                                <td class="celda_3">'.number_format($cantidadCopiapo,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">PELÍCULAS '.$coloresPeliculas.'</td>
                                <td class="celda_3">'.number_format($peliculasPreImpresion->precio,0,'','.').'</td>
                                <td class="celda_3">'.number_format($cantidadPeliculas,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MONTAJE '.$coloresMontaje.'</td>
                                <td class="celda_3">'.$montajePreImpresion.'</td>
                                <td class="celda_3">'.number_format($cantidadMontaje,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">CROMALÍN '.$coloresCromalin.'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($cromalin,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRE-IMPRESIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalPreImpresion,0,'','.').'</td>
                            </tr>
                        </table>
                         <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6"><hr class="hr_punteada" /></td>
                            </tr>';
                            
							
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima2= $totalPlacaKilo+$totalPlacaKilo2+$corteTotalPorcentaje+$mermaTotalPorcentaje;
								}else
								{
									$totalMateriaPrima2= $totalOndaKilo+$totalPlacaKilo+$corteTotalPorcentaje+$mermaTotalPorcentaje;		
								}
							
                            $cuerpo.='
                             <tr>
                                <td class="celda_3">TOTAL MATERIA PRIMA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalMateriaPrima2,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRE-IMPRESIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalPreImpresion,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRODUCCIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalProduccion,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>';
							
							
                             /* $totalTotal=$totalMateriaPrima2+$totalPreImpresion+$totalProduccion+$totalCostosVarios;
                            $totalValorUnitario=$totalTotal/$datos->cantidad_1;
                              //$totalValorUnitario2=$totalTotal/$datos->cantidad_2;
                             //$totalValorUnitario3=$totalTotal/$datos->cantidad_3;
                            //$totalValorUnitario4=$totalTotal/$datos->cantidad_4;
                            $valorFinal=(($totalValorUnitario/(100-$presupuesto->margen))/100)*10000;
                           // $valorFinal2=(($totalValorUnitario2/(100-$presupuesto->margen))/100)*10000;
                           // $valorFinal3=(($totalValorUnitario3/(100-$presupuesto->margen))/100)*10000;
                          //  $valorFinal4=(($totalValorUnitario4/(100-$presupuesto->margen))/100)*10000;
						  */
						  
						  $totalTotal=$totalMateriaPrima2+$totalPreImpresion+$totalProduccion+$totalCostosVarios;
                          
                            $totalValorUnitario=$totalTotal/$datos->cantidad_1;
                            //$totalValorUnitario2=$totalTotal/$datos->cantidad_2;
                            //$totalValorUnitario3=$totalTotal/$datos->cantidad_3;
                            //$totalValorUnitario4=$totalTotal/$datos->cantidad_4;
							
                            $valorFinal=(($totalValorUnitario/(100-$hoja->margen))/100)*10000;
							

							 $valorFinal2xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_2,2);
							 $valorFinal3xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_3,3);
							 $valorFinal4xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_4,4);
						  
						  
						  
						  
						  
                            $cuerpo.='
                          <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><span class="subrayado">VALOR POR</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($datos->cantidad_1,0,'','.').'</td>
                            </tr>                                  
                            <tr>
                                <td class="celda_3">TOTAL COSTOS VARIOS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalCostosVarios,0,'','.').'</td>
                                <td class="celda_3"><span class="subrayado">VALOR FINAL</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($valorFinal,0,'','.').'</td>
                                <!--
<td class="celda_3" colspan="3" rowspan="30">PRODUCCIÓN</td>
-->
                            </tr>';
							
							
							
                            $vcostoFinanciero=$this->variables_cotizador_model->getVariablesCotizadorPorId(33);
                            $recargoPorCantidadJusta=$this->variables_cotizador_model->getVariablesCotizadorPorId(37);
							
                            $valorFinanciado=$valorFinal*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							
                             //$valorFinanciado=$this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_1);
							
							
							/* $valorFinal2xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_2);
							 $valorFinal3xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_3);
							 $valorFinal4xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_4);
							 */
							
							$valorFinanciado2=$valorFinal2xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							$valorFinanciado3=$valorFinal3xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							$valorFinanciado4=$valorFinal4xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                           /*
						   $valorFinanciado2=$valorFinal2*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                            $valorFinanciado3=$valorFinal3*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                            $valorFinanciado4=$valorFinal4*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							*/
                            if($datos->acepta_excedentes=='NO')
                            {
                                $valorFinanciado=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado);
                                $valorFinanciado2=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado2);
                                $valorFinanciado3=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado3);
                                $valorFinanciado4=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado4);
                            }
								
							$cuerpo.='
                              <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                                <td class="celda_3">VALOR FINANCIADO '.$forma_pago->forma_pago.'('.$forma_pago->dias.')</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($valorFinanciado,0,'','.').'</td>
								
                            </tr>
								';
                                                        
                              //  echo "<h1>".$hoja->valor_empresa."</h1>";exit();                        
				if($hoja->valor_empresa==0)
                                {
                                    $valorEmpresa=$valorFinanciado;
                                }else
                                {
                                    $valorEmpresa=$hoja->valor_empresa;
                                }
                                
                                 if(sizeof($hoja)==0)
                                {
                                    if(($fotomecanica->materialidad_datos_tecnicos=="Indefinido") or ($fotomecanica->materialidad_datos_tecnicos=="Microcorrugado") or ($fotomecanica->materialidad_datos_tecnicos=="Corrugado")  or ($fotomecanica->materialidad_datos_tecnicos=="Cartulina-cartulina"))
                                    {        
                                        $valorEmpresa=$datos->precio_migrado;
                                    }
                                    else {
                                        $valorEmpresa=$valorFinanciado;
                                    }                                    
                                }else
                                {
                                    //$valorEmpresa=$hoja->valor_empresa;
                                    if(($fotomecanica->materialidad_datos_tecnicos=="Indefinido") or ($fotomecanica->materialidad_datos_tecnicos=="Microcorrugado") or ($fotomecanica->materialidad_datos_tecnicos=="Corrugado")  or ($fotomecanica->materialidad_datos_tecnicos=="Cartulina-cartulina"))
                                    {        
                                        $valorEmpresa="888888888888888";//$datos->precio_migrado;
                                    }
                                    else {
                                        $valorEmpresa=$valorFinanciado;
                                    }      
                                }
                                
                                if(sizeof($hoja)==0){
                                if($valorEmpresa == 0){ 
                                    $valorEmpresa=$valorFinanciado; 
                                    $valorEmpresa=$valorFinanciado;
                                }else{
                                    $valorEmpresa=$valorEmpresa;}
                                }else{
                                    $valorEmpresa=$hoja->valor_empresa;
                                }
                               
                            $cuerpo.='
                            <tr>
                                <td class="celda_3">TOTAL</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalTotal,0,'','.').'</td>
                                <td class="celda_3">VALOR EMPRESA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($valorEmpresa,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">DÍAS DE ENTREGA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.$hoja->dias_de_entrega.'</td>
                            </tr>

                            ';
							
							   if($hoja->valor_empresa_2 == 0)
                                {
                                    $valorEmpresa2=number_format($valorFinanciado2,0,'','.');               
                                }else
                                {
                                    $valorEmpresa2=$hoja->valor_empresa_2;
                                }
								
								if($hoja->valor_empresa_3 ==0)
                                {                                    
                                    $valorEmpresa3=number_format($valorFinanciado3,0,'','.');                                   
                                }else
                                {                              
                                    $valorEmpresa3=$hoja->valor_empresa_3;
                                }
								
								if($hoja->valor_empresa_4 ==0)
                                {
                                    $valorEmpresa4=number_format($valorFinanciado4,0,'','.');
                                }else
                                {
                                    $valorEmpresa4=$hoja->valor_empresa_4;
                                }
							
                           // if( $valorEmpresa2 == 0){echo number_format($valorFinanciado2,0,'','.');}else{echo $valorEmpresa2;}
							//if( $valorEmpresa3 == 0){echo number_format($valorFinanciado3,0,'','.');}else{echo $valorEmpresa3;}
							//if( $valorEmpresa4 == 0){echo number_format($valorFinanciado4,0,'','.');}else{echo $valorEmpresa4;}
							if($datos->cantidad_2 == 1)
							{
								$cantidad_2cero = 0;
								$valor_final2cero = 0;
								$valor_financiado2cero = 0;
								$valorEmpresa2cero = 0;
								
							}else{
								$cantidad_2cero = number_format($datos->cantidad_2,0,"",".");
								$valor_final2cero = number_format($valorFinal2xxx,0,"",".");
								$valor_financiado2cero = number_format($valorFinanciado2,0,"",".");
								$valorEmpresa2cero = number_format($valorEmpresa2,0,"",".");
							}
							
							if($datos->cantidad_3 == 1)
							{
								$cantidad_3cero = 0;
								$valor_final3cero = 0;
								$valor_financiado3cero = 0;
								$valorEmpresa3cero = 0;
								
							}else{
								$cantidad_3cero = number_format($datos->cantidad_3,0,"",".");
								$valor_final3cero = number_format($valorFinal3xxx,0,"",".");
								$valor_financiado3cero = number_format($valorFinanciado3,0,"",".");
								$valorEmpresa3cero = number_format($valorEmpresa3,0,"",".");
							}
							
							if($datos->cantidad_4 == 1)
							{
								$cantidad_4cero = 0;
								$valor_final4cero = 0;
								$valor_financiado4cero = 0;
								$valorEmpresa4cero = 0;
								
							}else{
								$cantidad_4cero = number_format($datos->cantidad_4,0,"",".");
								$valor_final4cero = number_format($valorFinal4xxx,0,"",".");
								$valor_financiado4cero = number_format($valorFinanciado4,0,"",".");
								$valorEmpresa4cero = number_format($valorEmpresa4,0,"",".");
							}
							
                            $cuerpo.='
                            <tr>
                                <td class="celda_3">VALOR UNITARIO</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalValorUnitario,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MARGEN</td>
                                <td class="celda_3">'.$hoja->margen.'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                       </table>
                        <div class="separador_20">&nbsp;</div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">CANTIDAD 2</td>
                                <td class="celda_3">'.$cantidad_2cero.'</td>
                                <td class="celda_3">CANTIDAD 3</td>
                                <td class="celda_3">'.$cantidad_3cero.'</td>
                                <td class="celda_3">CANTIDAD 4</td>
                                <td class="celda_3">'.$cantidad_4cero.'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3">'.$valor_final2cero.'</td>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3">'.$valor_final3cero.'</td>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3">'.$valor_final4cero.'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">VALOR FINANCIERO 2</td>
                                <td class="celda_3">'.$valor_financiado2cero.'</td>
                                <td class="celda_3">VALOR FINANCIERO 3</td>
                                <td class="celda_3">'.$valor_financiado3cero.'</td>
                                <td class="celda_3">VALOR FINANCIERO 4</td>
                                <td class="celda_3">'.$valor_financiado4cero.'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">VALOR EMPRESA 2</td>
                                <td class="celda_3">'.$valorEmpresa2cero.'</td>
                                <td class="celda_3">VALOR EMPRESA 3</td>
                                <td class="celda_3">'.$valorEmpresa3cero.'</td>
                                <td class="celda_3">VALOR EMPRESA 4</td>
                                <td class="celda_3">'.$valorEmpresa4cero.'</td>
                            </tr>
                        </table>
                        <div class="separador_10">&nbsp;</div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MATERIAL</td>
                                <td class="celda_3">GRAMAJE</td>
                                <td class="celda_3">TOTAL PLIEGOS</td>
                                <td class="celda_3">EXTRA</td>
                                <td class="celda_3">TOTAL KILOS</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">'.$fotomecanica->materialidad_datos_tecnicos.'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
							';	
							
								if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
								$cuerpo.='

							<tr>
                                <td class="celda_3">TAPA</td>
                                <td class="celda_3">'.$tapaNombre.' ('.number_format($tapaPrecio,0,'','.').')</td>
                                <td class="celda_3">'.number_format($costoPlacaKilo,0,'','.').'</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'.number_format($valorPlacaKilo,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TAPA (RESPALDO) </td>
                                <td class="celda_3">'.$tapaNombre2.' ('.number_format($tapaPrecio2,0,'','.').')</td>
                                <td class="celda_3">'.number_format($costoPlacaKilo2,0,'','.').'</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'.number_format($valorPlacaKilo2,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
									';
								}else{
									
							$cuerpo.='
                            <tr>
                                <td class="celda_3">TAPA</td>
                                <td class="celda_3">'.$tapaNombre.' ('.number_format($tapaPrecio,0,'','.').')</td>
                                <td class="celda_3">1.600</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'.$hoja->kilos_placa.'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">ONDA</td>
                                <td class="celda_3">'.$ondaNombre.' ('.number_format($ondaPrecio,0,'','.').')</td>
                                <td class="celda_3">1.600</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'.$hoja->kilos_onda.'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">LINER</td>
                                <td class="celda_3">'.$linerNombre.' ('.number_format($linerPrecio,0,'','.').')</td>
                                <td class="celda_3">1.600</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.$hoja->kilos_liner.'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
							';
								}
							
							
							if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
							{
								$recargo150 = '150';
								}else{
								$recargo150 = '100';
							}
                                                        if($totalTrabajosInternos=='No'){$totalTrabajosInternos=0;}else{$totalTrabajosInternos=$totalTrabajosInternos*50;}
                                                        if($totalTrabajosExternos=='No'){$totalTrabajosExternos=0;}else{$totalTrabajosExternos=$totalTrabajosExternos*50;}
							$cuerpo.='
                            <tr>
                                <td class="celda_3">FECHA TAPA: '.fecha_con_slash($tapaFecha).'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA ONDA: '.fecha_con_slash($ondaFecha).'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA LINER: '.fecha_con_slash($linerFecha).'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">240</td>
                                <td class="celda_3">449.71</td>
                            </tr>
                        </table>    
                        <div class="separador_20"></div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_2">
                                   <!--
                                    CANTIDAD 0 : 3.000 TOTAL $400.247
                                    <br />
                                    CANTIDAD 1 : 3.000 TOTAL $393.782
                                    <br />
                                    CANTIDAD 2 : 3.000 TOTAL
                                    <br />
                                    CANTIDAD 3 : 3.000 TOTAL    
                                    -->
                                </td>
                                <td class="celda_1">&nbsp;</td>
                                <td class="celda_60 valign_top" rowspan="5">
                                    <!--mermas-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td colspan="4">Tabla de Patrón de MERMAS Micronda TIPO E + Tapa</td>
                                        </tr>
                                        <tr>
                                            <td>Imprenta</td>
                                            <td>Roland:800</td>
                                            <td>Roland:800</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Color 1-2-3</td>
                                            <td>300</td>
                                            <td>400</td>
                                            <td>&nbsp;</td>
                                            <td>'.$color1.'</td>
                                        </tr>
                                        <tr>
                                            <td>Color &gt; 3</td>
                                            <td>'.$recargo150.'</td>
                                            <td>'.$recargo150.'</td>
                                            <td>* Color</td>
                                            <td>'.$color2.'</td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td>'.$can1.'</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Barniz</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Primeros 1.000</td>
                                            <td>'.$bar1.'</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>01</td>
                                            <td>01</td>
                                            <td>por cada 1.000 extra</td>
                                            <td>'.$bar2.'</td>
                                        </tr>
                                        <tr>
                                            <td>Laca</td>
                                            <td>025</td>
                                           <td>025</td>
                                            <td>una sola vez</td>
                                            <td>'.$laca.'</td>
                                        </tr>
                                        <tr>
                                            <td>Folia</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td>'.$folia.'</td>
                                        </tr>
                                        <tr>
                                            <td>Trabajos Internos</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>
                                            <td>'.$totalTrabajosInternos.'</td>
                                        </tr>
                                        <tr>
                                            <td>Trabajo externo</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>
                                            <td>'.$totalTrabajosExternos.'</td>
                                        </tr>
                                        <tr>
                                            <td>Micro/Micro</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td>'.$micromicro.'</td>
                                        </tr>
                                        <tr>
                                            <td>Cart/Cart</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td>'.$cartulina.'</td>
                                        </tr>
                                        <tr>
                                            <td>Tamaños Normales</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Emplacado base</td>
                                            <td>50</td>
                                            <td>50</td>
                                            <td>primeros 1.000</td>
                                            <td>'.$emplacado_fijo.'</td>
                                        </tr>
                                        <tr>
                                            <td>Emplacado por cada 1000&nbsp;&nbsp;</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>por cada 1000</td>
                                            <td>'.$emplacado.'</td>
                                        </tr>
                                        <tr>
                                            <td>Troquelado base</td>
                                            <td>40</td>
                                            <td>40</td>
                                            <td>Los primeros 1.000</td>
                                            <td>'.$troquelado_fijo.'</td>
                                        </tr>
                                        <tr>
                                            <td>Troquelado por cada 1000&nbsp;&nbsp;</td>
                                            <td>'.$troquelado_merma.'</td>
                                            <td>'.$troquelado_merma.'</td>
                                            <td>por cada 1.000</td>
                                            <td>'.$troquelado.'</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><hr class="hr_punteada_corto" /></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>'.number_format($sum).'</td>
                                        </tr>
                                    </table>
                                    <!--/mermas-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2"></td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </header>
        </div>
        ';
        $cuerpo.='</body>
</html>';
		//echo $cuerpo;exit;
		//$mpdf=new mPDF('c'); 
        $this->mpdf->SetDisplayMode('fullpage');
        $css1 = file_get_contents('bootstrap/estilos.css');
        $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
    		exit;
        
        
	}

    public function add_sin_cambios($id=null)
    {
//        exit("hpla");
        if($this->session->userdata('id'))
        {
            $datos_cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $datos_producto=$this->productos_model->getProductosPorCotizacion($id);
            $datos_ingenieria=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);            
            $datos_fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);            
            $ValidarProducto=$this->productos_model->getProductosPorNombre($this->input->post("producto",true));
            $modulo="add_sin_cambios";
            if ( $this->input->post() )
 		{
                
//                    if(sizeof($ValidarProducto)==0)
//                    {
//                       exit("paso");
 		       if($this->input->post("cliente",true)==3000)
                       {
                         $valida='ad_cotizacion2';
                       }else
                       {
                         $valida='ad_cotizacion';
                       }
                       $file_name="";
                       if(!empty($_FILES["file"]["name"]))
                       {
                             $error=false;							   
                             $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                             $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                             //$config['max_size'] = '10240';
                             $config['max_size'] = '40960';
                             $config['encrypt_name'] = true; 
                             $this->load->library('upload', $config);
                             if (!$this->upload->do_upload('file'))
                             {
                                $error = true;
                             }
                             $ima = $this->upload->data();
                             $file_name = $ima['file_name'];
                       }
                       else $error=false;
                       if (($this->form_validation->run($valida)) and (!$error))
                        {
                        
                                if($this->input->post("colores") <= 3 and $this->input->post("hacer_cromalin") == 'SI') 
                                {									   
                                         $hacer_cromalin="SI";
                                }

                                if($this->input->post("colores") <= 3 and $this->input->post("hacer_cromalin") == 'NO') 
                                {									   
                                         $hacer_cromalin="NO";
                                }


                                if($this->input->post("hacer_cromalin") == 'NO') 
                                {									   
                                         $hacer_cromalin="NO";
                                }

                                if($this->input->post("colores") >= 4)
                                {
                                        $hacer_cromalin="SI";
                                }

                               $producto=$this->input->post("producto",true);
                               if($producto==2000)
                               {
                                  $producto=$this->input->post("producto2",true);
                               }else
                               {
                                 $producto=$producto;
                               }
                               
                               $matnombre1 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_1",true));
                               $matnombre2 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_2",true));
                               $matnombre3 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_3",true));
                               
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista (MicroCorrugado/Corrugado)";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '7':
                                        $datos_tecnicos="Se solicita proposición";
                                        $materialidad_1="No Aplica";
                                        $materialidad_2="No Aplica";
                                        $materialidad_3="No Aplica";
                                        $materialidad_4="No Aplica";
                                    break;
                                    case '9':
                                        $datos_tecnicos="Onda a la Vista (Corrugado/Corrugado)";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '10':
                                        $datos_tecnicos="Onda a la Vista (MicroCorrugado/MicroCorrugado)";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                               }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               $comprobacion= $this->orden_model->getCoprobarOrdenesPorCotizacion($datos_cotizacion->id);    
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        if(sizeof($comprobacion)>0){
                                        $condicion="Repetición Sin Cambios";
                                        }else{
                                        $condicion="Nuevo";    
                                        }
                                    break;
                                    case '2':
                                        if(sizeof($comprobacion)>0){
                                        $condicion="Repetición Con Cambios";
                                        }else{
                                        $condicion="Nuevo";    
                                        }
                                    break;
                                    case '3':
                                        if(sizeof($comprobacion)>0){
                                        $condicion="Producto Genérico";
                                        }else{
                                        $condicion="Nuevo";    
                                        }
                                    break;
                               }
//                               echo $condicion2=$this->input->post("condicion_del_producto",true);
//                               echo $condicion;
//                               exit();
                               
                               if($this->input->post("estado",true)==2)
                               {
                                 $glosa=$this->input->post("glosa",true);  
                                 $quien=$this->session->userdata('id');
                                 $cuando=date("Y-m-d"); 
                               }else
                               {
                                 $glosa="";  
                                 $quien=0;
                                 $cuando="0000-00-00"; 
                               }
                               if($this->input->post("can2",true)==0)
                               {
                                 $cantidad_2=1;
                               }else
                               {
                                 $cantidad_2=$this->input->post("can2",true);
                               }
                               if($this->input->post("can3",true)==0)
                               {
                                 $cantidad_3=1;
                               }else
                               {
                                 $cantidad_3=$this->input->post("can3",true);
                               }
                               if($this->input->post("can4",true)==0)
                               {
                                 $cantidad_4=1;
                               }else
                               {
                                 $cantidad_4=$this->input->post("can4",true);
                               }
//                               echo "<h1>".$this->input->post("select_estan_los_moldes",true)."</h1>";
//                               echo "<h1>".$this->input->post("molde_generico",true)."</h1>";
//                               echo "<h1>".$this->input->post("numero_molde",true)."</h1>";

                               //echo "<h1>".$numero_molde."</h1>";
                               
			       //Verificar tipo de molde seleccionado
                               $estanlosmoldes = 'NO';
                               if($this->input->post("select_estan_los_moldes",true)=='NO LLEVA')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO LLEVA';
                               }
							   
                               if($this->input->post("select_estan_los_moldes",true)=='CLIENTE LO APORTA')
                               {
                                    $numeroMolde = 2;
                                    $estanlosmoldes = 'CLIENTE LO APORTA';
                               }
						   
                               if($this->input->post("select_estan_los_moldes",true)=='NO')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO';
                               }
								
                               if (($this->input->post("molde_generico",true)>0) && ($this->input->post("select_estan_los_moldes_genericos",true)=='SI'))
                               {
                                    $numeroMolde = $this->input->post("molde_generico",true);
                                    $estanlosmoldes = 'MOLDE GENERICO';
                               }
                               elseif (($this->input->post("molde_registrado",true)>0) && ($this->input->post("select_estan_los_moldes_no_genericos_clientes",true)=='SI'))
                               {
                                    $numeroMolde = $this->input->post("molde_registrado",true);
                                    $estanlosmoldes = 'MOLDE REGISTRADOS DEL CLIENTE';
                               }       
								
								
                                if($this->input->post("cliente_entrega_1",true)== 'Información Digital')
                                {
                                        $cliente_entrega_1 = 'Información Digital';
                                }
                                if($this->input->post("cliente_entrega_2",true) == 'Muestra de Color')
                                {
                                        $cliente_entrega_2 = 'Muestra de Color';
                                }
                                if($this->input->post("cliente_entrega_3",true) == 'Producto a Contener')
                                {
                                        $cliente_entrega_3 = 'Producto a Contener';
                                }

                                if($this->input->post("cliente_entrega_4",true) == 'Muestra Producto a Fabricar')
                                {
                                        $cliente_entrega_4 = 'Muestra Producto a Fabricar';
                                }

                                if($this->input->post("cliente_entrega_6",true) == 'Nada')
                                {
                                        $cliente_entrega_6 = 'Nada';
                                }                                                                
                                
                                if($this->input->post("cliente_entrega_7",true) == 'Ficha Tecnica de Producto a Contener')
                                {
                                        $cliente_entrega_7 = 'Ficha Tecnica de Producto a Contener';
                                }                                                                

                                if($this->input->post("cantidad_a_empaquetar_a_criterio",true) == 'cantidad_a_empaquetar_a_criterio')
                                {
                                        $cantidad_a_empaquetar_a_criterio = 'cantidad_a_empaquetar_a_criterio';
                                }
								
                                 $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "nombre_cliente"=>'no aplica',
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>$this->input->post("can1",true),
                                    "cantidad_2"=>$cantidad_2,
                                    "cantidad_3"=>$cantidad_3,
                                    "cantidad_4"=>$cantidad_4,
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
                                    "precio_1"=>$this->input->post("precio_1",true),
                                    "precio_2"=>$this->input->post("precio_2",true),
                                    "precio_3"=>$this->input->post("precio_3",true),
                                    "precio_4"=>$this->input->post("precio_4",true),
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
                                    "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$materialidad_1,
                                    "materialidad_2"=>$materialidad_2,
                                    "materialidad_3"=>$materialidad_3,
                                    "materialidad_4"=>$materialidad_4,
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "folia1_proceso_seletec"=>$this->input->post("folia1_proceso_seletec",true), 
                                    "folia2_proceso_seletec"=>$this->input->post("folia2_proceso_seletec",true), 
                                    "folia3_proceso_seletec"=>$this->input->post("folia3_proceso_seletec",true), 
                                    "cuno1_proceso_seletec"=>$this->input->post("cuno1_proceso_seletec",true), 
                                    "cuno2_proceso_seletec"=>$this->input->post("cuno2_proceso_seletec",true),
                                    "folia1_molde_selected"=>$this->input->post("folia1_molde_selected",true), 
                                    "folia2_molde_selected"=>$this->input->post("folia2_molde_selected",true), 
                                    "folia3_molde_selected"=>$this->input->post("folia3_molde_selected",true), 
                                    "cuno1_molde_selected"=>$this->input->post("cuno1_molde_selected",true), 
                                    "cuno2_molde_selected"=>$this->input->post("cuno2_molde_selected",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "cantidad_especifica_sino"=>$this->input->post("cantidad_especifica_sino",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$cliente_entrega_1,
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>0,
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
                                    "id_antiguo"=>'0',
                                    "detalle_cambios"=>$this->input->post("detalle_cambios",true),
                                    "detalle_de_muestra"=>$this->input->post("detalle_de_muestra",true),
                                    "estan_los_moldes"=>$estanlosmoldes,
                                    "numero_molde"=>$numeroMolde,
                                    //"numero_molde"=>$this->input->post("molde",true),
                                    "glosa"=>$glosa,
                                    "quien_autoriza"=>$this->session->userdata('id'),
                                    "fecha_autoriza"=>$cuando,
                                    "producto_id"=>$this->input->post("producto_id",true),
                                    "lleva_barniz"=>$this->input->post("lleva_barniz",true),
                                    "reserva_barniz"=>$this->input->post("reserva_barniz",true),
                                    "vb_maquina"=>$this->input->post("vb_maquina",true),
                                    "cliente_entrega_2"=>$cliente_entrega_2,
                                    "cliente_entrega_3"=>$cliente_entrega_3,
                                    "cliente_entrega_4"=>$cliente_entrega_4,
                                    "cliente_entrega_5"=>$this->input->post("cliente_entrega_5",true),
                                    "cliente_entrega_6"=>$cliente_entrega_6,
                                    "cliente_entrega_7"=>$cliente_entrega_7,
                                    "cantidad_a_empaquetar_a_criterio"=>$cantidad_a_empaquetar_a_criterio,
                                    "tiene_fondo"=>$this->input->post("tiene_fondo",true),
                                    "proceso_fondo"=>$this->input->post("proceso_fondo",true), 
                                    "imagen_impresion"=>$this->input->post("imagen_impresion",true), 
                                    "precio_migrado"=>$this->input->post("precio_migrado",true),
                                    "cala_caucho"=>$this->input->post("cala_caucho",true),                
                                    "margen_migrado"=>$this->input->post("margen_migrado",true),                
                                    "pegado_migrado"=>$this->input->post("pegado_migrado",true),                
                                    "dias_de_entrega"=>$this->input->post("pegado_migrado",true),
                                    "id_mat_placa1"=>$id_mat_placa1,
                                    "id_mat_onda2"=>$id_mat_onda2,
                                    "id_mat_liner3"=>$id_mat_liner3,
                                    "distancia"=>$this->input->post("cuno2_molde_selected",true), 
                                    "cantidad_de_despachos"=>$this->input->post("cantidad_de_despachos",true),
                                    "fecha_registro"=> date('Y-m-d'), 
                                 );
                                 
                                 //print_r($consulta_id_max);print_r($hc); exit();
                                 
                                    $guardar=$this->cotizaciones_model->insertar($data);
                                    $consulta_id_max=$this->cotizaciones_model->obtenerMaximoId();
                                    $hc=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
                                    if(sizeof($hc)>0){
                                    $hc->id_cotizacion = $consulta_id_max->id_max;
                                    $hc->id = "";
                                    $hc->impreso = "";
                                    $this->db->insert("hoja_de_costos_datos",$hc);}
                                    //guardar auditoria materialidad
                                    if($guardar>0)
                                        {
                                        $auditoria_materialidad=$this->auditorias_model->getAuditoriasPorIdCotizacion($guardar);
                                           $materialidad_anterior_1="vacia"; 
                                        if(sizeof($auditoria_materialidad)>0){
                                            $materialidad_anterior_1=$auditoria_materialidad->materialidad_nueva_1;
                                            $materialidad_anterior_2=$auditoria_materialidad->materialidad_nueva_2;
                                            $materialidad_anterior_3=$auditoria_materialidad->materialidad_nueva_3;
                                        }else{
                                            $materialidad_anterior_1=$materialidad_1;
                                            $materialidad_anterior_2=$materialidad_2;
                                            $materialidad_anterior_3=$materialidad_3;
                                        }
                                        $dataAuditoria=array(
                                            "id_cotizacion"=>$guardar,
                                            "id_procedencia_cambio"=>'3',
                                            "materialidad_anterior_1"=>$materialidad_anterior_1,
                                            "materialidad_anterior_2"=>$materialidad_anterior_2,
                                            "materialidad_anterior_3"=>$materialidad_anterior_3,
                                            "materialidad_nueva_1"=>$materialidad_1,
                                            "materialidad_nueva_2"=>$materialidad_2,
                                            "materialidad_nueva_3"=>$materialidad_3,
                                            "descripcion_procedencia_cambio"=>'add_cotizacion_sin_cambios',
                                            "id_usuario"=>$this->session->userdata('id'),
                                        );
                                      
                                //        $this->auditorias_model->insertarAuditoria($dataAuditoria);
                                        }
                                    //fin de guardar auditoria materialidad
                                    
                                    $modulo="add";
                                    if ($guardar)
                                    { 
                                        if ($file_name!="")
                                        {
                                            $datos_archivo_cliente=array
                                            (
                                               "id_cotizacion"=>$guardar,
                                               "archivo"=>$file_name,
                                               "fecha"=>date('Y-m-d'),                        
                                            );
                                            $this->cotizaciones_model->insertarArchivoCliente_RevisionIngenieria($datos_archivo_cliente);  
                                        }
                                    }
                                    $usrId=$this->session->userdata('id');
//                                    if($this->input->post("estado",true)==0)
//                                     {
//                                             $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
//                                             $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
//                                             $config['mailtype'] = 'html';
//                                             $this->email->initialize($config);
//                                             $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
//                                             //$this->email->to($vendedor->correo); 
//                                             $this->email->to(array('contactos_fotomecanica@grauindus.cl' , 'contactos_ingenieria@grauindus.cl'));
//                                             $this->email->bcc('respaldocorreos@grauindus.cl');
//                                             $this->email->subject('Mensaje de Cartonajes Grau');
//                                             $html='<h2>Solicitud de Cotizacion:</h2>';
//                                             $html.='La cotización N°'.$guardar.' ha sido Liberada, con la descripcion: <br/>'.$this->input->post("producto",true);
//                                             $this->email->message($html);   
//
//                                          $this->email->send(); 
//                                     }
						   
						   
                                
                                    if($guardar>0)
                                    {
//                                        if($this->input->post("producto_id",true)>=1)
//                                        {
                                            $productoAsociado=$this->productos_model->getProductosPorId($this->input->post("producto_id",true));
                                            $datos=$this->cotizaciones_model->getCotizacionPorId($productoAsociado->id_cotizacion);
                                            if ($estanlosmoldes=='MOLDE REGISTRADOS DEL CLIENTE')
                                                $hacer_troquel = "NO";
                                            else 
                                                $hacer_troquel = "SI";
                                            
                                            $dataFotomecanica=array
                                            (
                                                "id_usuario"=>$this->session->userdata('id'),
                                                "id_cotizacion"=>$guardar,
                                                "hacer_troquel"=>$hacer_troquel,
                                                "lleva_troquelado"=>$datos_fotomecanica->lleva_troquelado,
                                                "colores"=>$datos_fotomecanica->colores,
                                                "condicion_del_producto"=>"Repetición Sin Cambios",
                                                "estan_las_peliculas"=>$datos_fotomecanica->estan_las_peliculas,
                                                
//                                                "estan_los_moldes"=>$datos_fotomecanica->estan_los_moldes,
//                                                "numero_molde"=>$datos_fotomecanica->numero_molde,
                                                "estan_los_moldes"=>$estanlosmoldes,
                                                "numero_molde"=>$numeroMolde,                                                
                                                
                                                
                                                "colores"=>$datos_fotomecanica->colores,
                                                "guardar_con_comentarios"=>$datos_fotomecanica->guardar_con_comentarios,                                                 
                                                "colores_metalicos"=>$datos_fotomecanica->colores_metalicos,
                                                "acabado_impresion_1"=>$datos_fotomecanica->acabado_impresion_1,
                                                "acabado_impresion_2"=>$datos_fotomecanica->acabado_impresion_2,
                                                "acabado_impresion_3"=>$datos_fotomecanica->acabado_impresion_3,
                                                "acabado_impresion_4"=>$datos_fotomecanica->acabado_impresion_4,
                                                "acabado_impresion_5"=>$datos_fotomecanica->acabado_impresion_5,
                                                "acabado_impresion_6"=>$datos_fotomecanica->acabado_impresion_6,
                                                "fot_lleva_barniz"=>$datos_fotomecanica->fot_lleva_barniz,
                                                "fot_reserva_barniz"=>$datos_fotomecanica->fot_reserva_barniz,
                                                "fot_cala_caucho"=>$datos_fotomecanica->fot_cala_caucho,
                                                "tamano_caja_corrugado"=>$datos_fotomecanica->tamano_caja_corrugado,
                                                "comentarios"=>$datos_fotomecanica->comentarios,
                                                "fecha"=>date("Y-m-d"),
                                                "desctec"=>$datos_fotomecanica->desctec,
                                                "archivo"=>$datos_fotomecanica->archivo,
                                                "materialidad_datos_tecnicos"=>$datos_fotomecanica->materialidad_datos_tecnicos,
                                                "materialidad_eleccion"=>$datos_fotomecanica->materialidad_eleccion,
                                                 // en la mayoria de los casos no esta la materialidad en fotomecanica del historial
                                                "materialidad_1"=>$datos_ingenieria->materialidad_1,
                                                "materialidad_2"=>$datos_ingenieria->materialidad_2,
                                                "materialidad_3"=>$datos_ingenieria->materialidad_3,
                                                "materialidad_4"=>$datos_ingenieria->materialidad_4,
//                                                "materialidad_1"=>$datos_fotomecanica->materialidad_1,
//                                                "materialidad_2"=>$datos_fotomecanica->materialidad_2,
//                                                "materialidad_3"=>$datos_fotomecanica->materialidad_2,
//                                                "materialidad_4"=>$datos_fotomecanica->materialidad_2,
                                                "estado"=>0,
                                                "procesos_especiales_folia"=>$datos_fotomecanica->procesos_especiales_folia,
                                                "procesos_especiales_folia_valor"=>$datos_fotomecanica->procesos_especiales_folia_valor,
                                                "procesos_especiales_folia_2"=>$datos_fotomecanica->procesos_especiales_folia_2,
                                                "procesos_especiales_folia_2_valor"=>$datos_fotomecanica->procesos_especiales_folia_2_valor,
                                                "procesos_especiales_folia_3"=>$datos_fotomecanica->procesos_especiales_folia_3,
                                                "procesos_especiales_folia_3_valor"=>$datos_fotomecanica->procesos_especiales_folia_3_valor,
                                                "procesos_especiales_cuno"=>$datos_fotomecanica->procesos_especiales_cuno,
                                                "procesos_especiales_cuno_valor"=>$datos_fotomecanica->procesos_especiales_cuno_valor,
                                                "procesos_especiales_cuno_2"=>$datos_fotomecanica->procesos_especiales_cuno_2,
                                                "procesos_especiales_cuno_2_valor"=>$datos_fotomecanica->procesos_especiales_cuno_2_valor,
                                                "quien"=>$this->session->userdata('id'),
                                                "cuando"=>$datos_fotomecanica->cuando,
                                                "glosa"=>$datos_fotomecanica->glosa,
                                                "impresion"=>$datos_fotomecanica->impresion,
                                                "id_mat_placa1"=>$datos_fotomecanica->id_mat_placa1,
                                                "id_mat_onda2"=>$datos_fotomecanica->id_mat_onda2,
                                                "id_mat_liner3"=>$datos_fotomecanica->id_mat_liner3,
                                            );
                                            $this->cotizaciones_model->insertarFotomecanica($dataFotomecanica);
                                            //creo ingeniería

                                              $dataIngenieria=array
                                              (
                                                 "id_usuario"=>$this->session->userdata('id'),
                                                 "id_cotizacion"=>$guardar,
                                                 "producto"=>$datos_ingenieria->producto,
                                                 "cantidad_ordenes"=>$datos_ingenieria->cantidad_ordenes,
                                                 "medidas_de_la_caja"=>$datos_ingenieria->medidas_de_la_caja,
                                                 "medidas_de_la_caja_2"=>$datos_ingenieria->medidas_de_la_caja_2,
                                                 "medidas_de_la_caja_3"=>$datos_ingenieria->medidas_de_la_caja_3,
                                                 "medidas_de_la_caja_4"=>$datos_ingenieria->medidas_de_la_caja_4,
                                                 "aleta_pegado"=>$datos_ingenieria->aleta_pegado,
                                                 "ancho_1"=>$datos_ingenieria->ancho_1,
                                                 "ancho_2"=>$datos_ingenieria->ancho_2,
                                                 "largo_1"=>$datos_ingenieria->largo_1,
                                                 "largo_2"=>$datos_ingenieria->largo_2,
                                                 "largo_total_de_la_caja"=>$datos_ingenieria->largo_total_de_la_caja,
                                                 "unidades_por_pliego"=>$datos_ingenieria->unidades_por_pliego,
                                                 "hacer_troquel"=>$hacer_troquel,
                                                 "lleva_troquelado"=>$datos_ingenieria->lleva_troquelado,
                                                 "piezas_totales_en_el_pliego"=>$datos_ingenieria->piezas_totales_en_el_pliego,
                                                 "metros_de_cuchillo"=>$datos_ingenieria->metros_de_cuchillo,
                                                 "tamano_a_imprimir_1"=>$datos_ingenieria->tamano_a_imprimir_1,
                                                 "tamano_a_imprimir_2"=>$datos_ingenieria->tamano_a_imprimir_2,
                                                 "tamano_cuchillo_1"=>$datos_ingenieria->tamano_cuchillo_1,
                                                 "tamano_cuchillo_2"=>$datos_ingenieria->tamano_cuchillo_2,
                                                 "ccac_1"=>$datos_ingenieria->ccac_1,
                                                 "ccac_2"=>$datos_ingenieria->ccac_2,
                                                 "materialidad_datos_tecnicos"=>$datos_ingenieria->materialidad_datos_tecnicos,
                                                 "materialidad_eleccion"=>$datos_ingenieria->materialidad_eleccion,
                                                 "materialidad_1"=>$datos_ingenieria->materialidad_1,
                                                 "materialidad_2"=>$datos_ingenieria->materialidad_2,
                                                 "materialidad_3"=>$datos_ingenieria->materialidad_3,
                                                 "materialidad_4"=>$datos_ingenieria->materialidad_4,
                                                 "piezas_adicionales"=>$datos_ingenieria->piezas_adicionales,
                                                 "detalle_piezas_adicionales"=>$datos_ingenieria->detalle_piezas_adicionales,
                                                 "tipo_de_pegado"=>$datos_ingenieria->tipo_de_pegado,
                                                 "lineas_pegado"=>$datos_ingenieria->lineas_pegado,
                                                 "detalle_lineas_pegado"=>$datos_ingenieria->detalle_lineas_pegado,
                                                 "es_una_maquina"=>$datos_ingenieria->es_una_maquina,
                                                 "impresion_compartida"=>$datos_ingenieria->impresion_compartida,
                                                 "contiene_otras_cotizaciones"=>$datos_ingenieria->contiene_otras_cotizaciones,
                                                 "numero_cotizacion"=>$datos_ingenieria->numero_cotizacion,
                                                 "archivo"=>$datos_ingenieria->archivo,
                                                 "fecha"=>date("Y-m-d"),
                                                 "trabajos_adicionales"=>$datos_ingenieria->trabajos_adicionales,
                                                 "trabajos_adicionales_glosa"=>$datos_ingenieria->trabajos_adicionales_glosa,
                                                 "estado"=>0,
                                                 "estan_los_moldes"=>$estanlosmoldes,
                                                 "numero_molde"=>$numeroMolde,     
                                                 "colores"=>$datos_fotomecanica->colores,//agregar
//                                                 "estan_los_moldes"=>$datos_ingenieria->estan_los_moldes,
//                                                 "numero_molde"=>$datos_ingenieria->numero_molde,
                                                 "nombre_molde"=>$datos_ingenieria->nombre_molde,
                                                 "id_adhesivo"=>$datos_ingenieria->id_adhesivo,
                                                 "quien"=>$this->session->userdata('id'),
                                                 "cuando"=>$datos_ingenieria->cuando,
                                                 "solo_pegado"=>$datos_ingenieria->solo_pegado,
                                                 "tamano_pieza_a_empaquetar_ancho"=>$datos_ingenieria->tamano_pieza_a_empaquetar_ancho,
                                                 "tamano_pieza_a_empaquetar_largo"=>$datos_ingenieria->tamano_pieza_a_empaquetar_largo,
                                                 "glosa"=>$datos_ingenieria->glosa,
                                                 "pegado"=>$datos_ingenieria->pegado,
                                                 "doblado"=>$datos_ingenieria->doblado,
                                                 "empaquetado"=>$datos_ingenieria->empaquetado,
                                                 "tipo_pegado"=>$datos_ingenieria->tipo_pegado,
                                                 "pegado_puntos"=>$datos_ingenieria->pegado_puntos,
                                                 "pegado_cantidad_puntos"=>$datos_ingenieria->pegado_cantidad_puntos,
                                                 "tipo_fondo"=>$datos_ingenieria->tipo_fondo,
                                                 "lleva_aletas"=>$datos_ingenieria->lleva_aletas,
                                                 "total_aplicaciones_adhesivo"=>$datos_ingenieria->total_aplicaciones_adhesivo,
                                                 "ing_lleva_barniz"=>$datos_ingenieria->ing_lleva_barniz,
                                                 "ing_reserva_barniz"=>$datos_ingenieria->ing_reserva_barniz,
                                                 "ing_cala_caucho"=>$datos_ingenieria->ing_cala_caucho,
                                                  "id_mat_placa1"=>$datos_ingenieria->id_mat_placa1,
                                                "id_mat_onda2"=>$datos_ingenieria->id_mat_onda2,
                                                "id_mat_liner3"=>$datos_ingenieria->id_mat_liner3,
                                              );
                                              $this->cotizaciones_model->insertarIngenieria($dataIngenieria);
//                                        }
                                        $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
                                                           redirect(base_url().'cotizaciones',  301); 
                                    }else
                                    {
                                       $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                                                           redirect(base_url().'cotizaciones/add_con_cambios',  301);
                                    }
                                }
                                else
                                {
                                   $msg_error='error de imagen';                                
                                }                                         
                                         
//                }
				 }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js",                    
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                    
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->usuarios_model->getVendedores();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
           $this->layout->view($modulo,compact("tipos","vendedores","acInternos","acExternos","internos","externos","datos_cotizacion","msg_error","datos_producto"));   
		  
    }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
                  

    public function add_con_cambios($id=null)
    {
//        exit("hpla");
        if($this->session->userdata('id'))
        {
            $datos_cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $datos_producto=$this->productos_model->getProductosPorCotizacion($id);
            //print_r($datos_producto);exit();
            $cliente=$this->clientes_model->getClientePorId($datos_cotizacion->id_cliente);
            $datos_ingenieria=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);            
            $datos_fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);                
            $ValidarProducto=$this->productos_model->getProductosPorNombre($this->input->post("producto",true));
            $modulo="add_con_cambios";
//            print_r($datos_fotomecanica);
//            exit();
            if ( $this->input->post() )
 		{
//                    if(sizeof($ValidarProducto)==0)
//                    {
//                       exit("paso");
 		       if($this->input->post("cliente",true)==3000)
                       {
                         $valida='ad_cotizacion2';
                       }else
                       {
                         $valida='ad_cotizacion';
                       }
                       $file_name="";
                       if(!empty($_FILES["file"]["name"]))
                       {
                             $error=false;							   
                             $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                             $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                             //$config['max_size'] = '10240';
                             $config['max_size'] = '40960';
                             $config['encrypt_name'] = true; 
                             $this->load->library('upload', $config);
                             if (!$this->upload->do_upload('file'))
                             {
                                $error = true;
                             }
                             $ima = $this->upload->data();
                             $file_name = $ima['file_name'];
                       }
                       else $error=false;
                       if (($this->form_validation->run($valida)) and (!$error))
                        {
                          
                                if($this->input->post("colores") <= 3 and $this->input->post("hacer_cromalin") == 'SI') 
                                {									   
                                         $hacer_cromalin="SI";
                                }

                                if($this->input->post("colores") <= 3 and $this->input->post("hacer_cromalin") == 'NO') 
                                {									   
                                         $hacer_cromalin="NO";
                                }


                                if($this->input->post("hacer_cromalin") == 'NO') 
                                {									   
                                         $hacer_cromalin="NO";
                                }

                                if($this->input->post("colores") >= 4)
                                {
                                        $hacer_cromalin="SI";
                                }

                               $producto=$this->input->post("producto",true);
                               if($producto==2000)
                               {
                                  $producto=$this->input->post("producto2",true);
                               }else
                               {
                                 $producto=$producto;
                               }
                               
                               $matnombre1 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_1",true));
                               $matnombre2 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_2",true));
                               $matnombre3 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_3",true));
                               
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista (MicroCorrugado/Corrugado)";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '7':
                                        $datos_tecnicos="Se solicita proposición";
                                        $materialidad_1="No Aplica";
                                        $materialidad_2="No Aplica";
                                        $materialidad_3="No Aplica";
                                        $materialidad_4="No Aplica";
                                    break;
                                    case '9':
                                        $datos_tecnicos="Onda a la Vista (Corrugado/Corrugado)";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '10':
                                        $datos_tecnicos="Onda a la Vista (MicroCorrugado/MicroCorrugado)";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                               }
                             //  $condicion=$this->input->post("condicion_del_producto",true);
                               $condicion=2;
                               $comprobacion= $this->orden_model->getCoprobarOrdenesPorCotizacion($datos_cotizacion->id);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        if(sizeof($comprobacion)>0){
                                        $condicion="Repetición Sin Cambios";
                                        }else{
                                        $condicion="Nuevo";    
                                        }
                                    break;
                                    case '2':
                                        if(sizeof($comprobacion)>0){
                                        $condicion="Repetición Con Cambios";
                                        }else{
                                        $condicion="Nuevo";    
                                        }
                                    break;
                                    case '3':
                                        if(sizeof($comprobacion)>0){
                                        $condicion="Producto Genérico";
                                        }else{
                                        $condicion="Nuevo";    
                                        }
                                    break;
                               }
                               echo $condicion2=$this->input->post("condicion_del_producto",true);
                               echo $condicion;
                            //   exit();
                               
                               if($this->input->post("estado",true)==2)
                               {
                                 $glosa=$this->input->post("glosa",true);  
                                 $quien=$this->session->userdata('id');
                                 $cuando=date("Y-m-d"); 
                               }else
                               {
                                 $glosa="";  
                                 $quien=0;
                                 $cuando="0000-00-00"; 
                               }
                               if($this->input->post("can2",true)==0)
                               {
                                 $cantidad_2=1;
                               }else
                               {
                                 $cantidad_2=$this->input->post("can2",true);
                               }
                               if($this->input->post("can3",true)==0)
                               {
                                 $cantidad_3=1;
                               }else
                               {
                                 $cantidad_3=$this->input->post("can3",true);
                               }
                               if($this->input->post("can4",true)==0)
                               {
                                 $cantidad_4=1;
                               }else
                               {
                                 $cantidad_4=$this->input->post("can4",true);
                               }
							   
			       //Verificar tipo de molde seleccionado
                               $estanlosmoldes = 'NO';
                               if($this->input->post("select_estan_los_moldes",true)=='NO LLEVA')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO LLEVA';
                               }
							   
                               if($this->input->post("select_estan_los_moldes",true)=='CLIENTE LO APORTA')
                               {
                                    $numeroMolde = 2;
                                    $estanlosmoldes = 'CLIENTE LO APORTA';
                                }
						   
                               if($this->input->post("select_estan_los_moldes",true)=='NO')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO';
				}
								
                               if (($this->input->post("molde_generico",true)>0) and ($this->input->post("select_estan_los_moldes_genericos",true)=='SI'))
                               {
                                    $numeroMolde = $this->input->post("molde_generico",true);
                                    $estanlosmoldes = 'MOLDE GENERICO';
                                }
                                elseif (($this->input->post("molde_registrado",true)>0) and ($this->input->post("select_estan_los_moldes_no_genericos_clientes",true)=='SI'))
                                {
                                    $numeroMolde = $this->input->post("molde_registrado",true);
                                    $estanlosmoldes = 'MOLDE REGISTRADOS DEL CLIENTE';
                                }       
								
                                if($this->input->post("cliente_entrega_1",true)== 'Información Digital')
                                {
                                        $cliente_entrega_1 = 'Información Digital';
                                }
                                if($this->input->post("cliente_entrega_2",true) == 'Muestra de Color')
                                {
                                        $cliente_entrega_2 = 'Muestra de Color';
                                }
                                if($this->input->post("cliente_entrega_3",true) == 'Producto a Contener')
                                {
                                        $cliente_entrega_3 = 'Producto a Contener';
                                }

                                if($this->input->post("cliente_entrega_4",true) == 'Muestra Producto a Fabricar')
                                {
                                        $cliente_entrega_4 = 'Muestra Producto a Fabricar';
                                }

                                if($this->input->post("cliente_entrega_6",true) == 'Nada')
                                {
                                        $cliente_entrega_6 = 'Nada';
                                }                                                                
                                
                                if($this->input->post("cliente_entrega_7",true) == 'Ficha Tecnica de Producto a Contener')
                                {
                                        $cliente_entrega_7 = 'Ficha Tecnica de Producto a Contener';
                                }                                                                

                                if($this->input->post("cantidad_a_empaquetar_a_criterio",true) == 'cantidad_a_empaquetar_a_criterio')
                                {
                                        $cantidad_a_empaquetar_a_criterio = 'cantidad_a_empaquetar_a_criterio';
                                }
								
                                 $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "nombre_cliente"=>'no aplica',
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>$this->input->post("can1",true),
                                    "cantidad_2"=>$cantidad_2,
                                    "cantidad_3"=>$cantidad_3,
                                    "cantidad_4"=>$cantidad_4,
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
                                    "precio_1"=>100,
                                    "precio_2"=>100,
                                    "precio_3"=>100,
                                    "precio_4"=>100,
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
                                    "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$materialidad_1,
                                    "materialidad_2"=>$materialidad_2,
                                    "materialidad_3"=>$materialidad_3,
                                    "materialidad_4"=>$materialidad_4,
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "cuno1_proceso_seletec"=>$this->input->post("cuno1_proceso_seletec",true), 
                                    "cuno2_proceso_seletec"=>$this->input->post("cuno2_proceso_seletec",true),
                                    "cuno1_molde_selected"=>$this->input->post("cuno1_molde_seleted",true), 
                                    "cuno2_molde_selected"=>$this->input->post("cuno2_molde_selected",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "cantidad_especifica_sino"=>$this->input->post("cantidad_especifica_sino",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$cliente_entrega_1,
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>0,
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
                                    "id_antiguo"=>'0',
                                    "detalle_cambios"=>$this->input->post("detalle_cambios",true),
                                    "detalle_de_muestra"=>$this->input->post("detalle_de_muestra",true),
                                    "estan_los_moldes"=>$estanlosmoldes,
                                    "numero_molde"=>$numeroMolde,
                                    //"numero_molde"=>$this->input->post("molde",true),
                                    "glosa"=>$glosa,
                                    "quien_autoriza"=>$quien,
                                    "fecha_autoriza"=>$cuando,
                                    "producto_id"=>$this->input->post("producto_id",true),
                                    "lleva_barniz"=>$this->input->post("lleva_barniz",true),
                                    "reserva_barniz"=>$this->input->post("reserva_barniz",true),
                                    "vb_maquina"=>$this->input->post("vb_maquina",true),
                                    "cliente_entrega_2"=>$cliente_entrega_2,
                                    "cliente_entrega_3"=>$cliente_entrega_3,
                                    "cliente_entrega_4"=>$cliente_entrega_4,
                                    "cliente_entrega_5"=>$this->input->post("cliente_entrega_5",true),
                                    "cliente_entrega_6"=>$cliente_entrega_6,
                                    "cliente_entrega_7"=>$cliente_entrega_7,
                                    "cantidad_a_empaquetar_a_criterio"=>$cantidad_a_empaquetar_a_criterio,
                                    "tiene_fondo"=>$this->input->post("tiene_fondo",true),
                                    "proceso_fondo"=>$this->input->post("proceso_fondo",true), 
                                    "imagen_impresion"=>$this->input->post("imagen_impresion",true), 
                                    "precio_migrado"=>$this->input->post("precio_migrado",true), 
                                    "cala_caucho"=>$this->input->post("cala_caucho",true), 
                                    "margen_migrado"=>$this->input->post("margen_migrado",true),                
                                    "pegado_migrado"=>$this->input->post("pegado_migrado",true),
                                    "tiene_color_modificado"=>$this->input->post("tiene_color_modificado",true),
                                    "numero_color_modificado"=>$this->input->post("numero_color_modificado",true),
                                    "id_mat_placa1"=>$id_mat_placa1,
                                    "id_mat_onda2"=>$id_mat_onda2,
                                    "id_mat_liner3"=>$id_mat_liner3,
                                    "distancia"=>$this->input->post("cuno2_molde_selected",true), 
                                    "cantidad_de_despachos"=>$this->input->post("cantidad_de_despachos",true),
                                    "fecha_registro"=> date('Y-m-d'), 
                                     );
            //print_r($data);exit();
                                    $guardar=$this->cotizaciones_model->insertar($data);
                                    
                                    $consulta_id_max=$this->cotizaciones_model->obtenerMaximoId();
                                    $hc=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
                                    if(sizeof($hc)>0){
                                    $hc->id_cotizacion = $consulta_id_max->id_max;
                                    $hc->id = "";
                                    $hc->impreso = "";
                                    $this->db->insert("hoja_de_costos_datos",$hc);}
                                    //guardar auditoria materialidad
                                    if($guardar>0)
                                        {
                                        $auditoria_materialidad=$this->auditorias_model->getAuditoriasPorIdCotizacion($guardar);
                                            
                                        if(sizeof($auditoria_materialidad)>0){
                                            $materialidad_anterior_1=$auditoria_materialidad->materialidad_nueva_1;
                                            $materialidad_anterior_2=$auditoria_materialidad->materialidad_nueva_2;
                                            $materialidad_anterior_3=$auditoria_materialidad->materialidad_nueva_3;
                                        }else{
                                            $materialidad_anterior_1=$materialidad_1;
                                            $materialidad_anterior_2=$materialidad_2;
                                            $materialidad_anterior_3=$materialidad_3;
                                        }
                                        $dataAuditoria=array(
                                            "id_cotizacion"=>$guardar,
                                            "id_procedencia_cambio"=>'2',
                                            "materialidad_anterior_1"=>$materialidad_anterior_1,
                                            "materialidad_anterior_2"=>$materialidad_anterior_2,
                                            "materialidad_anterior_3"=>$materialidad_anterior_3,
                                            "materialidad_nueva_1"=>$materialidad_1,
                                            "materialidad_nueva_2"=>$materialidad_2,
                                            "materialidad_nueva_3"=>$materialidad_3,
                                            "descripcion_procedencia_cambio"=>'add_cotizacion_con_cambios',
                                            "id_usuario"=>$this->session->userdata('id'),
                                        );
                                      
                                    //    $this->auditorias_model->insertarAuditoria($dataAuditoria);
                                        }
                                    //fin de guardar auditoria materialidad
                                    
                                    $modulo="add";
                                    if ($guardar)
                                    { 
                                        if ($file_name!="")
                                        {
                                            $datos_archivo_cliente=array
                                            (
                                               "id_cotizacion"=>$guardar,
                                               "archivo"=>$file_name,
                                               "fecha"=>date('Y-m-d'),                        
                                            );
                                            $this->cotizaciones_model->insertarArchivoCliente_RevisionIngenieria($datos_archivo_cliente);  
                                        }
                                    }
                                    $usrId=$this->session->userdata('id');
//                                    if($this->input->post("estado",true)==0)
//                                     {
//                                             $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
//                                             $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
//                                             $config['mailtype'] = 'html';
//                                             $this->email->initialize($config);
//                                             $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
//                                             //$this->email->to($vendedor->correo); 
//                                             $this->email->to(array('contactos_fotomecanica@grauindus.cl' , 'contactos_ingenieria@grauindus.cl'));
//                                             $this->email->bcc('respaldocorreos@grauindus.cl');
//                                             $this->email->subject('Mensaje de Cartonajes Grau');
//                                             $html='<h2>Solicitud de Cotizacion:</h2>';
//                                             $html.='La cotización N°'.$guardar.' ha sido Liberada, con la descripcion: <br/>'.$this->input->post("producto",true);
//                                             $this->email->message($html);   
//
//                                          $this->email->send(); 
//                                     }
						   
						   
                                
                                    if($guardar>0)
                                    {
//                                        if($this->input->post("producto_id",true)>=1)
//                                        {
                                            $productoAsociado=$this->productos_model->getProductosPorId($this->input->post("producto_id",true));
                                            $datos=$this->cotizaciones_model->getCotizacionPorId($productoAsociado->id_cotizacion);
//                                            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($productoAsociado->id_cotizacion);
//                                            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($productoAsociado->id_cotizacion);
//                                            print_r($fotomecanica);exit;

                                            if ($estanlosmoldes=='MOLDE REGISTRADOS DEL CLIENTE')
                                                $hacer_troquel = "NO";
                                            else 
                                                $hacer_troquel = "SI";
                                            
                                             $dataFotomecanica=array
                                            (
                                                "id_usuario"=>$this->session->userdata('id'),
                                                "id_cotizacion"=>$guardar,
                                                "hacer_troquel"=>$hacer_troquel,
                                                "lleva_troquelado"=>$datos_fotomecanica->lleva_troquelado,
                                                "colores"=>$this->input->post("colores",true),
                                                "condicion_del_producto"=>"Repetición Con Cambios",
                                                "estan_las_peliculas"=>$datos_fotomecanica->estan_las_peliculas,
                                                 
                                                "estan_los_moldes"=>$estanlosmoldes,
                                                "numero_molde"=>$numeroMolde,

                                                "colores"=>$this->input->post("colores",true),
                                                "guardar_con_comentarios"=>$datos_fotomecanica->guardar_con_comentarios,                                                 
                                                "colores_metalicos"=>$datos_fotomecanica->colores_metalicos,
                                                "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                                "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                                "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                                "acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                                "acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                                "acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),

                                                "fot_reserva_barniz"=>$datos_fotomecanica->reserva_barniz,
                                                "tamano_caja_corrugado"=>$datos_fotomecanica->tamano_caja_corrugado,
                                                "comentarios"=>$datos_fotomecanica->comentarios,
                                                "fecha"=>date("Y-m-d"),
                                                "desctec"=>$datos_fotomecanica->desctec,
                                                "archivo"=>$datos_fotomecanica->archivo,
                                                 
                                                "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                                "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                                "materialidad_1"=>$materialidad_1,
                                                "materialidad_2"=>$materialidad_2,
                                                "materialidad_3"=>$materialidad_3,
                                                "materialidad_4"=>$materialidad_4,                                                 

                                                "estado"=>0,
                                                "procesos_especiales_folia"=>$datos_fotomecanica->procesos_especiales_folia,
                                                "procesos_especiales_folia_valor"=>$datos_fotomecanica->procesos_especiales_folia_valor,
                                                "procesos_especiales_folia_2"=>$datos_fotomecanica->procesos_especiales_folia_2,
                                                "procesos_especiales_folia_2_valor"=>$datos_fotomecanica->procesos_especiales_folia_2_valor,
                                                "procesos_especiales_folia_3"=>$datos_fotomecanica->procesos_especiales_folia_3,
                                                "procesos_especiales_folia_3_valor"=>$datos_fotomecanica->procesos_especiales_folia_3_valor,
                                                "procesos_especiales_cuno"=>$datos_fotomecanica->procesos_especiales_cuno,
                                                "procesos_especiales_cuno_valor"=>$datos_fotomecanica->procesos_especiales_cuno_valor,
                                                "procesos_especiales_cuno_2"=>$datos_fotomecanica->procesos_especiales_cuno_2,
                                                "procesos_especiales_cuno_2_valor"=>$datos_fotomecanica->procesos_especiales_cuno_2_valor,
                                                "quien"=>$this->session->userdata('id'),
                                                "cuando"=>$datos_fotomecanica->cuando,
                                                "glosa"=>$datos_fotomecanica->glosa,
                                                "impresion"=>$datos_fotomecanica->impresion,
                                                 "fot_lleva_barniz"=>$datos_fotomecanica->fot_lleva_barniz,
                                                "fot_reserva_barniz"=>$datos_fotomecanica->fot_reserva_barniz,
                                                "fot_cala_caucho"=>$datos_fotomecanica->fot_cala_caucho,
                                                "id_mat_placa1"=>$datos_fotomecanica->id_mat_placa1,
                                                "id_mat_onda2"=>$datos_fotomecanica->id_mat_onda2,
                                                "id_mat_liner3"=>$datos_fotomecanica->id_mat_liner3,
                                                );
                                                $this->cotizaciones_model->insertarFotomecanica($dataFotomecanica);
                                            //creo ingeniería
//                                              print_r($data);
                                              $dataIngenieria=array
                                              (
                                                 "id_usuario"=>$this->session->userdata('id'),
                                                 "id_cotizacion"=>$guardar,
                                                 "producto"=>$datos_ingenieria->producto,
                                                 "cantidad_ordenes"=>$datos_ingenieria->cantidad_ordenes,
                                                 "medidas_de_la_caja"=>$datos_ingenieria->medidas_de_la_caja,
                                                 "medidas_de_la_caja_2"=>$datos_ingenieria->medidas_de_la_caja_2,
                                                 "medidas_de_la_caja_3"=>$datos_ingenieria->medidas_de_la_caja_3,
                                                 "medidas_de_la_caja_4"=>$datos_ingenieria->medidas_de_la_caja_4,
                                                 "aleta_pegado"=>$datos_ingenieria->aleta_pegado,
                                                 "ancho_1"=>$datos_ingenieria->ancho_1,
                                                 "ancho_2"=>$datos_ingenieria->ancho_2,
                                                 "largo_1"=>$datos_ingenieria->largo_1,
                                                 "largo_2"=>$datos_ingenieria->largo_2,
                                                 "largo_total_de_la_caja"=>$datos_ingenieria->largo_total_de_la_caja,
                                                 "unidades_por_pliego"=>$datos_ingenieria->unidades_por_pliego,
                                                 "hacer_troquel"=>$hacer_troquel,
                                                 "lleva_troquelado"=>$datos_ingenieria->lleva_troquelado,
                                                 "piezas_totales_en_el_pliego"=>$datos_ingenieria->piezas_totales_en_el_pliego,
                                                 "metros_de_cuchillo"=>$datos_ingenieria->metros_de_cuchillo,
                                                 "tamano_a_imprimir_1"=>$datos_ingenieria->tamano_a_imprimir_1,
                                                 "tamano_a_imprimir_2"=>$datos_ingenieria->tamano_a_imprimir_2,
                                                 "tamano_cuchillo_1"=>$datos_ingenieria->tamano_cuchillo_1,
                                                 "tamano_cuchillo_2"=>$datos_ingenieria->tamano_cuchillo_2,
                                                 "ccac_1"=>$datos_ingenieria->ccac_1,
                                                 "ccac_2"=>$datos_ingenieria->ccac_2,
                                                 "colores"=>$this->input->post("colores",true),//agregar
                                                 "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                                 "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                                 "materialidad_1"=>$materialidad_1,
                                                 "materialidad_2"=>$materialidad_2,
                                                 "materialidad_3"=>$materialidad_3,
                                                 "materialidad_4"=>$materialidad_4,   
                                                  
                                                 "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                                 "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                                 "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                                 "acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                                 "acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                                 "acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),                                                  
                                                  
                                                 "piezas_adicionales"=>$datos_ingenieria->piezas_adicionales,
                                                 "detalle_piezas_adicionales"=>$datos_ingenieria->detalle_piezas_adicionales,
                                                 "tipo_de_pegado"=>$datos_ingenieria->tipo_de_pegado,
                                                 "lineas_pegado"=>$datos_ingenieria->lineas_pegado,
                                                 "detalle_lineas_pegado"=>$datos_ingenieria->detalle_lineas_pegado,
                                                 "es_una_maquina"=>$datos_ingenieria->es_una_maquina,
                                                 "impresion_compartida"=>$datos_ingenieria->impresion_compartida,
                                                 "contiene_otras_cotizaciones"=>$datos_ingenieria->contiene_otras_cotizaciones,
                                                 "numero_cotizacion"=>$datos_ingenieria->numero_cotizacion,
                                                 "archivo"=>$datos_ingenieria->archivo,
                                                 "fecha"=>date("Y-m-d"),
                                                 "trabajos_adicionales"=>$datos_ingenieria->trabajos_adicionales,
                                                 "trabajos_adicionales_glosa"=>$datos_ingenieria->trabajos_adicionales_glosa,
                                                 "estado"=>0,
                                                  
                                                 "estan_los_moldes"=>$estanlosmoldes,
                                                 "numero_molde"=>$numeroMolde,

                                                 "nombre_molde"=>$datos_ingenieria->nombre_molde,
                                                 "id_adhesivo"=>$datos_ingenieria->id_adhesivo,
                                                 "quien"=>$this->session->userdata('id'),
                                                 "cuando"=>$datos_ingenieria->cuando,
                                                 "solo_pegado"=>$datos_ingenieria->solo_pegado,
                                                 "tamano_pieza_a_empaquetar_ancho"=>$datos_ingenieria->tamano_pieza_a_empaquetar_ancho,
                                                 "tamano_pieza_a_empaquetar_largo"=>$datos_ingenieria->tamano_pieza_a_empaquetar_largo,
                                                 "glosa"=>$datos_ingenieria->glosa,
                                                 "pegado"=>$datos_ingenieria->pegado,
                                                 "doblado"=>$datos_ingenieria->doblado,
                                                 "empaquetado"=>$datos_ingenieria->empaquetado,
                                                 "tipo_pegado"=>$datos_ingenieria->tipo_pegado,
                                                 "pegado_puntos"=>$datos_ingenieria->pegado_puntos,
                                                 "pegado_cantidad_puntos"=>$datos_ingenieria->pegado_cantidad_puntos,
                                                 "tipo_fondo"=>$datos_ingenieria->tipo_fondo,
                                                 "lleva_aletas"=>$datos_ingenieria->lleva_aletas,
                                                 "total_aplicaciones_adhesivo"=>$datos_ingenieria->total_aplicaciones_adhesivo,
                                                 "ing_lleva_barniz"=>$datos_ingenieria->ing_lleva_barniz,
                                                 "ing_reserva_barniz"=>$datos_ingenieria->ing_reserva_barniz,
                                                 "ing_cala_caucho"=>$datos_ingenieria->ing_cala_caucho,
                                                 "id_mat_placa1"=>$datos_ingenieria->id_mat_placa1,
                                                 "id_mat_onda2"=>$datos_ingenieria->id_mat_onda2,
                                                 "id_mat_liner3"=>$datos_ingenieria->id_mat_liner3,
                                              );
//                                              print_r($data);

                                              $this->cotizaciones_model->insertarIngenieria($dataIngenieria);
//                                        }
                                        $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
                                                           redirect(base_url().'cotizaciones',  301); 
                                    }else
                                    {
                                       $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                                                           redirect(base_url().'cotizaciones/add_con_cambios',  301);
                                    }
                                }
                                else
                                {
                                   $msg_error='error de imagen';                                
                                }                                         
                                         
//                }
				 }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js",                    
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                    
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->usuarios_model->getVendedores();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            //print_r($internos);exit;
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
           $this->layout->view($modulo,compact("tipos","vendedores","acInternos","acExternos","internos","externos","datos_cotizacion","msg_error","datos_producto"));   
		  
    }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
           
        
    public function add($id=null)
    {
        if($this->session->userdata('id'))
        {
            $error=false;
            $error_producto=false;
            $datos_cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $datos_ingenieria=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);            
            $datos_fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);             
            $ValidarProducto=$this->productos_model->getProductosPorNombre($this->input->post("producto",true));


            if ($this->input->post())
            {
                if($this->input->post("cliente_secundario",true)!="" && $this->input->post("cliente_secundario",true)!=0){
                    $cliente_sec = $this->input->post("cliente_secundario",true);
                }else{
                    $cliente_sec = "";
                }
                
 		       if($this->input->post("cliente",true)==3000)
                       {
                         $valida='ad_cotizacion2';
                       }else
                       {
                         $valida='ad_cotizacion';
                       }
                       $file_name="";
                       // validamos el rchivo pdf 
                       if(!empty($_FILES["file"]["name"]))
                       {
                             $error=false;							   
                             $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                             $config['allowed_types'] = 'pdf';
                             //$config['max_size'] = '10240';
                             $config['max_size'] = '20000';
                             $config['encrypt_name'] = true; 
                             $this->load->library('upload', $config);
                             if (!$this->upload->do_upload('file'))
                             {
                                $error = true;
                             }
                             $ima = $this->upload->data();
                             $file_name = $ima['file_name'];
                       }
                       else $error=false;
                       
                       //debemos saber si es un producto nuevo no exista en producto, si es repeticion buscamos el nombre del
                       //producto y lo guardamos como el que ya esta registrado en la tabla producto                       
                       if ($this->input->post("condicion_del_producto",true)==0)  // si es nuevo el producto no puede existir 
                       {
                            if(sizeof($ValidarProducto)>0)
                            {
                                $error_producto=true;
                            }
                            else
                            {
                               $producto=$this->input->post("producto",true);                    
                            }
                        }
                        else
                        {
                            $producto=$this->input->post("producto",true);
                        }    
                        
                       if (($this->form_validation->run($valida)) and (!$error) and (!$error_producto))
                       {
                            
                                if($this->input->post("colores") <= 3 and $this->input->post("hacer_cromalin") == 'SI') 
                                {									   
                                         $hacer_cromalin="SI";
                                }

                                if($this->input->post("colores") <= 3 and $this->input->post("hacer_cromalin") == 'NO') 
                                {									   
                                         $hacer_cromalin="NO";
                                }


                                if($this->input->post("hacer_cromalin") == 'NO') 
                                {									   
                                         $hacer_cromalin="NO";
                                }

                                if($this->input->post("colores") >= 4)
                                {
                                        $hacer_cromalin="SI";
                                }

                                $dirh = opendir($dirname);
                                if ($dirh) {
                                    while (($dirElement = readdir($dirh)) !== false) {
                                        //                               $producto=$this->input->post("producto",true);
//                               if($producto==2000)
//                               {
//                                  $producto=$this->input->post("producto2",true);
//                               }else
//                               {
//                                 $producto=$producto;
//                               }
                                    }
                                    closedir($dirh);
                                }
                                
                               $matnombre1 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_1",true));
                               $matnombre2 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_2",true));
                               $matnombre3 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_3",true)); 
                               
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                        
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista (MicroCorrugado/Corrugado)";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '7':
                                        $datos_tecnicos="Se solicita proposición";
                                        $materialidad_1="No Aplica";
                                        $materialidad_2="No Aplica";
                                        $materialidad_3="No Aplica";
                                        $materialidad_4="No Aplica";
                                    break;
                                    case '9':
                                        $datos_tecnicos="Onda a la Vista (Corrugado/Corrugado)";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                                    case '10':
                                        $datos_tecnicos="Onda a la Vista (MicroCorrugado/MicroCorrugado)";
                                        $materialidad_1=$matnombre1->nombre;
                                        $materialidad_2=$matnombre2->nombre;
                                        $materialidad_3=$matnombre3->nombre;
                                        $materialidad_4=$this->input->post("materialidad_4",true);
                                        $id_mat_placa1=$this->input->post("materialidad_1",true);
                                        $id_mat_onda2=$this->input->post("materialidad_2",true);
                                        $id_mat_liner3=$this->input->post("materialidad_3",true);
                                    break;
                               }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
                               }
                               if($this->input->post("estado",true)==2)
                               {
                                 $glosa=$this->input->post("glosa",true);  
                                 $quien=$this->session->userdata('id');
                                 $cuando=date("Y-m-d"); 
                               }else
                               {
                                 $glosa="";  
                                 $quien=0;
                                 $cuando="0000-00-00"; 
                               }
                               if($this->input->post("can2",true)==0)
                               {
                                 $cantidad_2=1;
                               }else
                               {
                                 $cantidad_2=$this->input->post("can2",true);
                               }
                               if($this->input->post("can3",true)==0)
                               {
                                 $cantidad_3=1;
                               }else
                               {
                                 $cantidad_3=$this->input->post("can3",true);
                               }
                               if($this->input->post("can4",true)==0)
                               {
                                 $cantidad_4=1;
                               }else
                               {
                                 $cantidad_4=$this->input->post("can4",true);
                               }
							   
			       //Verificar tipo de molde seleccionado
                               $estanlosmoldes = 'NO';
                               $hacer_troquel="NO";
                               $lleva_troquelado="NO";    
                               if($this->input->post("select_estan_los_moldes",true)=='SI')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'SI';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                    
                               }
                               if($this->input->post("select_estan_los_moldes",true)=='NO LLEVA')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO LLEVA';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="NO";                                    
                               }
							   
                               if($this->input->post("select_estan_los_moldes",true)=='CLIENTE LO APORTA')
                               {
                                    $numeroMolde = 2;
                                    $estanlosmoldes = 'CLIENTE LO APORTA';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                    
                                }
						   
                               if($this->input->post("select_estan_los_moldes",true)=='NO')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="NO";                                    
				}
								
                               if (($this->input->post("select_estan_los_moldes",true)=='MOLDE GENERICO') and ($this->input->post("select_estan_los_moldes_genericos",true)=='SI'))
                               {
                                    $numeroMolde = $this->input->post("molde_generico",true);
                                    $estanlosmoldes = 'MOLDE GENERICO';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";
                                }
                                elseif (($this->input->post("select_estan_los_moldes",true)=='MOLDE REGISTRADOS DEL CLIENTE') and ($this->input->post("select_estan_los_moldes_no_genericos_clientes",true)=='SI'))
                                {
                                    $numeroMolde = $this->input->post("molde_registrado",true);
                                    $estanlosmoldes = 'MOLDE REGISTRADOS DEL CLIENTE';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                    
                                }       
								
                                if($this->input->post("cliente_entrega_1",true)== 'Información Digital')
                                {
                                        $cliente_entrega_1 = 'Información Digital';
                                }
                                if($this->input->post("cliente_entrega_2",true) == 'Muestra de Color')
                                {
                                        $cliente_entrega_2 = 'Muestra de Color';
                                }
                                if($this->input->post("cliente_entrega_3",true) == 'Producto a Contener')
                                {
                                        $cliente_entrega_3 = 'Producto a Contener';
                                }

                                if($this->input->post("cliente_entrega_4",true) == 'Muestra Producto a Fabricar')
                                {
                                        $cliente_entrega_4 = 'Muestra Producto a Fabricar';
                                }

                                if($this->input->post("cliente_entrega_6",true) == 'Nada')
                                {
                                        $cliente_entrega_6 = 'Nada';
                                }                                                                
                                if($this->input->post("cliente_entrega_7",true) == 'Ficha Tecnica de Producto a Contener')
                                {
                                        $cliente_entrega_7 = 'Ficha Tecnica de Producto a Contener';
                                }                                                                

                                if($this->input->post("cantidad_a_empaquetar_a_criterio",true) == 'cantidad_a_empaquetar_a_criterio')
                                {
                                        $cantidad_a_empaquetar_a_criterio = 'cantidad_a_empaquetar_a_criterio';
                                }
                                    $matnombre1 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_1",true));
                                    $matnombre2 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_2",true));
                                    $matnombre3 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_3",true));
                                // echo "<h1>".$this->input->post('cliente',true).'</h1>';
                                 $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "id_cliente_sec"=>$cliente_sec,
                                    "nombre_cliente"=>'no aplica',
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>$this->input->post("can1",true),
                                    "cantidad_2"=>$cantidad_2,
                                    "cantidad_3"=>$cantidad_3,
                                    "cantidad_4"=>$cantidad_4,
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
                                    "precio_1"=>100,
                                    "precio_2"=>100,
                                    "precio_3"=>100,
                                    "precio_4"=>100,
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
                                    "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$materialidad_1,
                                    "materialidad_2"=>$materialidad_2,
                                    "materialidad_3"=>$materialidad_3,
                                    "materialidad_4"=>$materialidad_4,
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "folia1_proceso_seletec"=>$this->input->post("folia1_proceso_seletec",true),
                                    "folia2_proceso_seletec"=>$this->input->post("folia2_proceso_seletec",true),
                                    "folia3_proceso_seletec"=>$this->input->post("folia3_proceso_seletec",true),
                                    "cuno1_proceso_seletec"=>$this->input->post("cuno1_proceso_seletec",true),
                                    "cuno2_proceso_seletec"=>$this->input->post("cuno2_proceso_seletec",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "cantidad_especifica_sino"=>$this->input->post("cantidad_especifica_sino",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$cliente_entrega_1,
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>$this->input->post("estado",true),
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
                                    "id_antiguo"=>'0',
                                    "detalle_cambios"=>$this->input->post("detalle_cambios",true),
                                    "detalle_de_muestra"=>$this->input->post("detalle_de_muestra",true),
                                    "estan_los_moldes"=>$estanlosmoldes,
                                    "numero_molde"=>$numeroMolde,
                                    //"numero_molde"=>$this->input->post("molde",true),
                                    "glosa"=>$glosa,
                                    "quien_autoriza"=>$quien,
                                    "fecha_autoriza"=>$cuando,
                                    "producto_id"=>$this->input->post("producto_id",true),
                                    "lleva_barniz"=>$this->input->post("lleva_barniz",true),
                                    "reserva_barniz"=>$this->input->post("reserva_barniz",true),
                                    "vb_maquina"=>$this->input->post("vb_maquina",true),
                                    "cliente_entrega_2"=>$cliente_entrega_2,
                                    "cliente_entrega_3"=>$cliente_entrega_3,
                                    "cliente_entrega_4"=>$cliente_entrega_4,
                                    "cliente_entrega_5"=>$this->input->post("cliente_entrega_5",true),
                                    "cliente_entrega_6"=>$cliente_entrega_6,
                                    "cliente_entrega_7"=>$cliente_entrega_7,
                                    "cantidad_a_empaquetar_a_criterio"=>$cantidad_a_empaquetar_a_criterio,
                                    "tiene_fondo"=>$this->input->post("tiene_fondo",true),
                                    "proceso_fondo"=>$this->input->post("proceso_fondo",true), 
                                    "imagen_impresion"=>$this->input->post("imagen_impresion",true), 
                                    "cala_caucho"=>$this->input->post("cala_caucho",true), 
                                    "hay_que_troquelar"=>$this->input->post("hay_que_troquelar",true), 
                                    "folia1_molde_selected"=>$this->input->post("folia1_molde_selected",true), 
                                    "folia2_molde_selected"=>$this->input->post("folia2_molde_selected",true), 
                                    "folia3_molde_selected"=>$this->input->post("folia3_molde_selected",true), 
                                    "cuno1_molde_selected"=>$this->input->post("cuno1_molde_selected",true), 
                                    "cuno2_molde_selected"=>$this->input->post("cuno2_molde_selected",true), 
                                    "id_mat_placa1"=>$id_mat_placa1, 
                                    "id_mat_onda2"=>$id_mat_onda2, 
                                    "id_mat_liner3"=>$id_mat_liner3, 
                                    "distancia"=>$this->input->post("distancia",true), 
                                    "cantidad_de_despachos"=>$this->input->post("cantidad_de_despachos",true), 
                                    "fecha_registro"=> date('Y-m-d'), 
                                    "existe_trazado"=> $this->input->post('existe_trazado',true), 
                                    "trazado"=> $this->input->post('trazados',true), 
                                     );
                              //  exit(print_r($data));
                                    if (sizeof($datos_cotizacion)>0)
                                    {
//                                        exit("1");
                                        $guardar=$this->cotizaciones_model->update($data,$id);
                                    }
                                    else
                                    {    
                                     //   exit("2");                                        
                                        $guardar=$this->cotizaciones_model->insertar($data);
                                    }
                                    if ($guardar)
                                    { 
                                        if ($file_name!="")
                                        {
                                            $datos_archivo_cliente=array
                                            (
                                               "id_cotizacion"=>$guardar,
                                               "archivo"=>$file_name,
                                               "fecha"=>date('Y-m-d'),                        
                                            );
                                            $this->cotizaciones_model->insertarArchivoCliente_RevisionIngenieria($datos_archivo_cliente);  
                                        }
                                    }
                                        if($guardar>0)
                                        {
                                        $auditoria_materialidad=$this->auditorias_model->getAuditoriasPorIdCotizacion($guardar);
                                            
                                        if(sizeof($auditoria_materialidad)>0){
                                            $materialidad_anterior_1=$auditoria_materialidad->materialidad_nueva_1;
                                            $materialidad_anterior_2=$auditoria_materialidad->materialidad_nueva_2;
                                            $materialidad_anterior_3=$auditoria_materialidad->materialidad_nueva_3;
                                        }else{
                                            $materialidad_anterior_1=$materialidad_1;
                                            $materialidad_anterior_2=$materialidad_2;
                                            $materialidad_anterior_3=$materialidad_3;
                                        }
                                        $dataAuditoria=array(
                                            "id_cotizacion"=>$guardar,
                                            "id_procedencia_cambio"=>'1',
                                            "materialidad_anterior_1"=>$materialidad_anterior_1,
                                            "materialidad_anterior_2"=>$materialidad_anterior_2,
                                            "materialidad_anterior_3"=>$materialidad_anterior_3,
                                            "materialidad_nueva_1"=>$materialidad_1,
                                            "materialidad_nueva_2"=>$materialidad_2,
                                            "materialidad_nueva_3"=>$materialidad_3,
                                            "descripcion_procedencia_cambio"=>'add_cotizacion',
                                            "id_usuario"=>$this->session->userdata('id'),
                                        );
                                       
                                     //   $this->auditorias_model->insertarAuditoria($dataAuditoria);
                                        }
                                        
                                    $usrId=$this->session->userdata('id');
                                    if($this->input->post("estado",true)==0)
                                     {
                                             $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                             $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                                             $config['mailtype'] = 'html';
                                             $this->email->initialize($config);
                                             $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                             //$this->email->to($vendedor->correo); 
                                             $this->email->to(array('contactos_fotomecanica@grauindus.cl' , 'contactos_ingenieria@grauindus.cl'));
                                             $this->email->bcc('respaldocorreos@grauindus.cl');
                                             $this->email->subject('Mensaje de Cartonajes Grau');
                                             $html='<h2>Solicitud de Cotizacion:</h2>';
                                             $html.='La cotización N°'.$guardar.' ha sido Liberada, con la descripcion: <br/>'.$this->input->post("producto",true);
                                             $this->email->message($html);   

                                          $this->email->send(); 
                                     }
                                    
                                     
                                                               
                                    if($guardar>0)
                                    {
                                        
                                        if($this->input->post("producto_id",true)>=1)
                                        {
                                            $productoAsociado=$this->productos_model->getProductosPorId($this->input->post("producto_id",true));
                                            $datos=$this->cotizaciones_model->getCotizacionPorId($productoAsociado->id_cotizacion);
                                            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($productoAsociado->id_cotizacion);
                                            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($productoAsociado->id_cotizacion);
                                            //print_r($fotomecanica);exit;

                                             $dataFotomecanica=array
                                            (
                                                "id_usuario"=>$this->session->userdata('id'),
                                                "id_cotizacion"=>$guardar,
                                                "condicion_del_producto"=>$fotomecanica->condicion_del_producto,
                                                "estan_las_peliculas"=>$fotomecanica->estan_las_peliculas,
                                                "estan_los_moldes"=>$fotomecanica->estan_los_moldes,
                                                "numero_molde"=>$fotomecanica->numero_molde,
                                                "colores"=>$fotomecanica->colores,
                                                "colores_metalicos"=>$fotomecanica->colores_metalicos,
                                                "acabado_impresion_1"=>$fotomecanica->acabado_impresion_1,
                                                "acabado_impresion_2"=>$fotomecanica->acabado_impresion_2,
                                                "acabado_impresion_3"=>$fotomecanica->acabado_impresion_3,
                                                "acabado_impresion_4"=>$fotomecanica->acabado_impresion_4,
                                                "acabado_impresion_5"=>$fotomecanica->acabado_impresion_5,
                                                "acabado_impresion_6"=>$fotomecanica->acabado_impresion_6,
                                                "reserva_barniz"=>$fotomecanica->reserva_barniz,
                                                "tamano_caja_corrugado"=>$fotomecanica->tamano_caja_corrugado,
                                                "comentarios"=>$fotomecanica->comentarios,
                                                "fecha"=>date("Y-m-d"),
                                                "desctec"=>$fotomecanica->desctec,
                                                "archivo"=>$fotomecanica->archivo,
                                                "materialidad_datos_tecnicos"=>$fotomecanica->materialidad_datos_tecnicos,
                                                "materialidad_eleccion"=>$fotomecanica->materialidad_eleccion,
                                                "materialidad_1"=>$fotomecanica->materialidad_1,
                                                "materialidad_2"=>$fotomecanica->materialidad_2,
                                                "materialidad_3"=>$fotomecanica->materialidad_2,
                                                "materialidad_4"=>$fotomecanica->materialidad_2,
                                                "estado"=>$fotomecanica->estado,
                                                "procesos_especiales_folia"=>$fotomecanica->procesos_especiales_folia,
                                                "procesos_especiales_folia_valor"=>$fotomecanica->procesos_especiales_folia_valor,
                                                "procesos_especiales_folia_2"=>$fotomecanica->procesos_especiales_folia_2,
                                                "procesos_especiales_folia_2_valor"=>$fotomecanica->procesos_especiales_folia_2_valor,
                                                "procesos_especiales_folia_3"=>$fotomecanica->procesos_especiales_folia_3,
                                                "procesos_especiales_folia_3_valor"=>$fotomecanica->procesos_especiales_folia_3_valor,
                                                "procesos_especiales_cuno"=>$fotomecanica->procesos_especiales_cuno,
                                                "procesos_especiales_cuno_valor"=>$fotomecanica->procesos_especiales_cuno_valor,
                                                "procesos_especiales_cuno_2"=>$fotomecanica->procesos_especiales_cuno_2,
                                                "procesos_especiales_cuno_2_valor"=>$fotomecanica->procesos_especiales_cuno_2_valor,
                                                "folia1_proceso_seletec"=>$fotomecanica->folia1_proceso_seletec,
                                                "folia2_proceso_seletec"=>$fotomecanica->folia2_proceso_seletec,
                                                "folia3_proceso_seletec"=>$fotomecanica->folia3_proceso_seletec,
                                                "cuno_proceso_seletec"=>$fotomecanica->cuno_proceso_seletec,
                                                "cuno2_proceso_seletec"=>$fotomecanica->cuno2_proceso_seletec,
                                                "quien"=>$fotomecanica->quien,
                                                "cuando"=>$fotomecanica->cuando,
                                                "glosa"=>$fotomecanica->glosa,
                                                "impresion"=>$fotomecanica->impresion,
                                                "hacer_troquel"=>$hacer_troquel,
                                                "lleva_troquelado"=>$lleva_troquelado,
                                                "folia1_molde_selected"=>$this->$fotomecanica->folia1_molde_selected, 
                                                "folia2_molde_selected"=>$this->$fotomecanica->folia2_molde_selected, 
                                                "folia3_molde_selected"=>$this->$fotomecanica->folia3_molde_selected, 
                                                "cuno1_molde_selected"=>$this->$fotomecanica->cuno1_molde_selected, 
                                                "cuno2_molde_selected"=>$this->$fotomecanica->cuno2_molde_selected,  
                                                );
                                                $this->cotizaciones_model->insertarFotomecanica($dataFotomecanica);
                                            //creo ingeniería
                                        
                                              $dataIngenieria=array
                                              (
                                                 "id_usuario"=>$this->session->userdata('id'),
                                                 "id_cotizacion"=>$guardar,
                                                 "producto"=>$ing->producto,
                                                 "medidas_de_la_caja"=>$ing->medidas_de_la_caja,
                                                 "medidas_de_la_caja_2"=>$ing->medidas_de_la_caja_2,
                                                 "medidas_de_la_caja_3"=>$ing->medidas_de_la_caja_3,
                                                 "medidas_de_la_caja_4"=>$ing->medidas_de_la_caja_4,
                                                 "unidades_por_pliego"=>$ing->unidades_por_pliego,
                                                 "hacer_troquel"=>$ing->hacer_troquel,
                                                 "lleva_troquelado"=>$ing->lleva_troquelado,
                                                 "piezas_totales_en_el_pliego"=>$ing->piezas_totales_en_el_pliego,
                                                 "metros_de_cuchillo"=>$ing->metros_de_cuchillo,
                                                 "tamano_a_imprimir_1"=>$ing->tamano_a_imprimir_1,
                                                 "tamano_a_imprimir_2"=>$ing->tamano_a_imprimir_2,
                                                 "tamano_cuchillo_1"=>$ing->tamano_cuchillo_1,
                                                 "tamano_cuchillo_2"=>$ing->tamano_cuchillo_2,
                                                 "materialidad_datos_tecnicos"=>$ing->materialidad_datos_tecnicos,
                                                 "materialidad_eleccion"=>$ing->materialidad_eleccion,
                                                 "materialidad_1"=>$ing->materialidad_1,
                                                 "materialidad_2"=>$ing->materialidad_2,
                                                 "materialidad_3"=>$ing->materialidad_3,
                                                 "materialidad_4"=>$ing->materialidad_4,
                                                 "piezas_adicionales"=>$ing->piezas_adicionales,
                                                 "detalle_piezas_adicionales"=>$ing->detalle_piezas_adicionales,
                                                 "tipo_de_pegado"=>$ing->tipo_de_pegado,
                                                 "lineas_pegado"=>$ing->lineas_pegado,
                                                 "detalle_lineas_pegado"=>$ing->detalle_lineas_pegado,
                                                 "es_una_maquina"=>$ing->es_una_maquina,
                                                 "impresion_compartida"=>$ing->impresion_compartida,
                                                 "contiene_otras_cotizaciones"=>$ing->contiene_otras_cotizaciones,
                                                 "numero_cotizacion"=>$ing->numero_cotizacion,
                                                 "archivo"=>$ing->archivo,
                                                 "fecha"=>date("Y-m-d"),
                                                 "trabajos_adicionales"=>$ing->trabajos_adicionales,
                                                 "trabajos_adicionales_glosa"=>$ing->trabajos_adicionales_glosa,
                                                 "estado"=>$ing->estado,
                                                 "estan_los_moldes"=>$ing->estan_los_moldes,
                                                 "numero_molde"=>$ing->numero_molde,
                                                 "id_adhesivo"=>$ing->id_adhesivo,
                                                 "quien"=>$ing->quien,
                                                 "cuando"=>$ing->cuando,
                                                 "solo_pegado"=>$ing->solo_pegado,
                                                 "tamano_pieza_a_empaquetar_ancho"=>$ing->tamano_pieza_a_empaquetar_ancho,
                                                 "tamano_pieza_a_empaquetar_largo"=>$ing->tamano_pieza_a_empaquetar_largo,
                                                 "glosa"=>$ing->glosa,
                                                 "pegado"=>$ing->pegado,
                                                 "doblado"=>$ing->doblado,
                                                 "empaquetado"=>$ing->empaquetado,
                                                 "tipo_pegado"=>$ing->tipo_pegado,
                                                 "pegado_puntos"=>$ing->pegado_puntos,
                                                 "pegado_cantidad_puntos"=>$ing->pegado_cantidad_puntos,
                                                 "tipo_fondo"=>$ing->tipo_fondo,
                                                 "lleva_aletas"=>$ing->lleva_aletas,
                                                 "total_aplicaciones_adhesivo"=>$ing->total_aplicaciones_adhesivo,
                                                 "hacer_troquel"=>$hacer_troquel,
                                                 "lleva_troquelado"=>$lleva_troquelado,                                                       
                                              );
                                              
                                                   $this->cotizaciones_model->insertarIngenieria($dataIngenieria);
                                        }
                                        $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
                                                           redirect(base_url().'cotizaciones',  301); 
                                    }else
                                    {
                                       $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                                                           redirect(base_url().'cotizaciones/add',  301);
                                    }
                                }
                                else
                                {
                                    if ($error)
                                    {
                                       $msg_error=1;                                

                                    }
                                    if ($error_producto)
                                    {
                                       $msg_error=2;                                            
                                    }
                                }                                         
                                         
//                } del validarproducto
                    }

            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js",                    
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                    
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->usuarios_model->getVendedores();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            //print_r($internos);exit;
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
           $this->layout->view('add',compact("tipos","vendedores","acInternos","acExternos","internos","externos","datos_cotizacion","msg_error"));   
		  
    }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
   
   public function edit($id=null,$pagina=null)
    {

          if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_cotizacion') )
    			         {
    			
                               if(isset($_POST["hacer_cromalin"]))
                               {
                                 $hacer_cromalin="SI";
                               }else
                               {
                                 $hacer_cromalin="NO";
                               }
                                
                               $producto=$this->input->post("producto",true);
                               if($producto==2000)
                               {
                                  $producto=$this->input->post("producto2",true);
                               }else
                               {
                                 $producto=$producto;
                               }
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista";
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                    break;
                                    case '11':
                                        $datos_tecnicos="Indefinido";
                                    break;                                
                               }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
                               }
       
                               $data=array
                                 (
                                    "id"=>$id,
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "nombre_cliente"=>$this->input->post("nombre_cliente",true),
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>quitarPuntosNumero($this->input->post("can1",true)),
                                    "cantidad_2"=>quitarPuntosNumero($this->input->post("can2",true)),
                                    "cantidad_3"=>quitarPuntosNumero($this->input->post("can3",true)),
                                    "cantidad_4"=>quitarPuntosNumero($this->input->post("can4",true)),
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
                                    "precio_1"=>100,
                                    "precio_2"=>100,
                                    "precio_3"=>100,
                                    "precio_4"=>100,
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$this->input->post("materialidad_1",true),
                                    "materialidad_2"=>$this->input->post("materialidad_2",true),
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "comentarios_montaje_pieza_especial"=>$this->input->post("comentarios_montaje_pieza_especial",true),                                   
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>quitarPuntosNumero($this->input->post("cantidad_especifica",true)),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$this->input->post("cliente_entrega",true),
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>$this->input->post("estado",true),
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
                                    "id_antiguo"=>$this->input->post("id_antiguo",true),
                                    "detalle_cambios"=>$this->input->post("detalle_cambios",true),
                                    "detalle_de_muestra"=>$this->input->post("detalle_de_muestra",true),
                                 );
                               
                               
                               // print_r($data);exit();
                               
//                                 print_r($data);
                               
//                                                                   "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
//                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    //$guardar=$this->cotizaciones_model->update($data,$this->input->post("id",true));
                                    $guardar=$this->cotizaciones_model->update($data,$id);
                                    
                                    
                                
                            if($guardar>0)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.'.  $checks);
					           redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'cotizaciones/add',  301);
                            }
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->usuarios_model->getVendedores();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            //print_r($internos);exit;
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
           $this->layout->view('edit',compact("tipos","vendedores","acInternos","acExternos","internos","externos","pagina","datos","id","ing"));          
    }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
   public function editar_cotizacion($id=null,$pagina=null)
    {

          if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            $datos_cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
               
 		              if ( $this->form_validation->run('ad_cotizacion') )
    			         {
    			
                               if(isset($_POST["hacer_cromalin"]))
                               {
                                 $hacer_cromalin="SI";
                               }else
                               {
                                 $hacer_cromalin="NO";
                               }
                                
                               $estanlosmolde=$this->input->post("select_estan_los_moldes",true);
                               if($estanlosmolde=="MOLDE GENERICO")
                               {
                                  $numeromolde=$this->input->post("molde_generico",true);
                               }else
                               {
                                 if($estanlosmolde=="MOLDE REGISTRADO DEL CLIENTE")
                               {
                                  $numeromolde=$this->input->post("molde_registrado",true);
                               }else{
                                   if($estanlosmolde=="NO")
                               {
                                  $numeromolde=1;
                               }else{
                                   if($estanlosmolde=="NO LLEVA")
                               {
                                  $numeromolde=1;
                               }
                               }
                               }
                               }
                               
                               $producto=$this->input->post("producto",true);
                               if($producto==2000)
                               {
                                  $producto=$this->input->post("producto2",true);
                               }else
                               {
                                 $producto=$producto;
                               }
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista";
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                    break;
                                    case '11':
                                        $datos_tecnicos="Indefinido";
                                    break;                                
                               }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
                               }
                                if($this->input->post("cliente_entrega_1",true)== 'Información Digital')
                                {
                                        $cliente_entrega_1 = 'Información Digital';
                                }
                                if($this->input->post("cliente_entrega_2",true) == 'Muestra de Color')
                                {
                                        $cliente_entrega_2 = 'Muestra de Color';
                                }
                                if($this->input->post("cliente_entrega_3",true) == 'Producto a Contener')
                                {
                                        $cliente_entrega_3 = 'Producto a Contener';
                                }

                                if($this->input->post("cliente_entrega_4",true) == 'Muestra Producto a Fabricar')
                                {
                                        $cliente_entrega_4 = 'Muestra Producto a Fabricar';
                                }

                                if($this->input->post("cliente_entrega_6",true) == 'Nada')
                                {
                                        $cliente_entrega_6 = 'Nada';
                                }                                                                
                                if($this->input->post("cliente_entrega_7",true) == 'Ficha Tecnica de Producto a Contener')
                                {
                                        $cliente_entrega_7 = 'Ficha Tecnica de Producto a Contener';
                                }                                                    
                               $data=array
                                 (
                                    "id"=>$id,
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "nombre_cliente"=>$this->input->post("cliente",true),
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>quitarPuntosNumero($this->input->post("can1",true)),
                                    "cantidad_2"=>quitarPuntosNumero($this->input->post("can2",true)),
                                    "cantidad_3"=>quitarPuntosNumero($this->input->post("can3",true)),
                                    "cantidad_4"=>quitarPuntosNumero($this->input->post("can4",true)),
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
                                    "precio_1"=>100,
                                    "precio_2"=>100,
                                    "precio_3"=>100,
                                    "precio_4"=>100,
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
                                    "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$this->input->post("materialidad_1",true),
                                    "materialidad_2"=>$this->input->post("materialidad_2",true),
                                    "materialidad_3"=>$this->input->post("materialidad_3",true),
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "comentarios_montaje_pieza_especial"=>$this->input->post("comentarios_montaje_pieza_especial",true),                                   
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>quitarPuntosNumero($this->input->post("cantidad_especifica",true)),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$cliente_entrega_1,
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>$this->input->post("estado",true),
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
                                    "id_antiguo"=>$this->input->post("id_antiguo",true),
                                    "detalle_cambios"=>$this->input->post("detalle_cambios",true),
                                    "detalle_de_muestra"=>$this->input->post("detalle_de_muestra",true),
                                    "lleva_barniz"=>$this->input->post("lleva_barniz",true),
                                    "cala_caucho"=>$this->input->post("cala_caucho",true),
                                    "reserva_barniz"=>$this->input->post("reserva_barniz",true),
                                    "estan_los_moldes"=>$this->input->post("select_estan_los_moldes",true),
                                    "numero_molde"=>$numeromolde,
                                    "cliente_entrega_2"=>$cliente_entrega_2,
                                    "cliente_entrega_3"=>$cliente_entrega_3,
                                    "cliente_entrega_4"=>$cliente_entrega_4,
                                    "cliente_entrega_5"=>$cliente_entrega_5,
                                    "cliente_entrega_6"=>$cliente_entrega_6,
                                    "cliente_entrega_7"=>$cliente_entrega_7,
                                 );
                               
//                                echo "<pre>";
//                                print_r($data);echo "</pre>";exit();
                               
//                                 print_r($data);
                               
//                                                                   "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
//                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    //$guardar=$this->cotizaciones_model->update($data,$this->input->post("id",true));
                                    $guardar=$this->cotizaciones_model->update($data,$id);
                                    
                                    
                                
                            if($guardar>0)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.'.  $checks);
					           redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'cotizaciones/add',  301);
                            }
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->usuarios_model->getVendedores();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            //print_r($internos);exit;
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
           $this->layout->view('editar_normal',compact("datos_cotizacion","tipos","vendedores","acInternos","acExternos","internos","externos","pagina","datos","id","ing"));          
    }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
   public function view($id=null,$pagina=null)
    {

          if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_cotizacion') )
    			         {
    			
                               if(isset($_POST["hacer_cromalin"]))
                               {
                                 $hacer_cromalin="SI";
                               }else
                               {
                                 $hacer_cromalin="NO";
                               }
                                
                               $producto=$this->input->post("producto",true);
                               if($producto==2000)
                               {
                                  $producto=$this->input->post("producto2",true);
                               }else
                               {
                                 $producto=$producto;
                               }
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista";
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                    break;
                                    case '11':
                                        $datos_tecnicos="Indefinido";
                                    break;                                
                               }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
                               }
       
                               $data=array
                                 (
                                    "id"=>$id,
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "nombre_cliente"=>$this->input->post("nombre_cliente",true),
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>quitarPuntosNumero($this->input->post("can1",true)),
                                    "cantidad_2"=>quitarPuntosNumero($this->input->post("can2",true)),
                                    "cantidad_3"=>quitarPuntosNumero($this->input->post("can3",true)),
                                    "cantidad_4"=>quitarPuntosNumero($this->input->post("can4",true)),
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
                                    "precio_1"=>100,
                                    "precio_2"=>100,
                                    "precio_3"=>100,
                                    "precio_4"=>100,
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$this->input->post("materialidad_1",true),
                                    "materialidad_2"=>$this->input->post("materialidad_2",true),
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "comentarios_montaje_pieza_especial"=>$this->input->post("comentarios_montaje_pieza_especial",true),                                   
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>quitarPuntosNumero($this->input->post("cantidad_especifica",true)),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$this->input->post("cliente_entrega",true),
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>$this->input->post("estado",true),
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
                                    "id_antiguo"=>$this->input->post("id_antiguo",true),
                                    "detalle_cambios"=>$this->input->post("detalle_cambios",true),
                                    "detalle_de_muestra"=>$this->input->post("detalle_de_muestra",true),
                                 );
                               
                               
                               // print_r($data);exit();
                               
//                                 print_r($data);
                               
//                                                                   "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
//                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    //$guardar=$this->cotizaciones_model->update($data,$this->input->post("id",true));
                                    $guardar=$this->cotizaciones_model->update($data,$id);
                                    
                                    
                                
                            if($guardar>0)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.'.  $checks);
					           redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'cotizaciones/add',  301);
                            }
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->usuarios_model->getVendedores();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            //print_r($internos);exit;
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
           $this->layout->view('view',compact("tipos","vendedores","acInternos","acExternos","internos","externos","pagina","datos","id","ing"));          
    }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function retornaDatosEditar($id = null)
    {

	       $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                   // base_url()."public/frontend/css/bootstrap-chosen.less"
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   // "http://harvesthq.github.io/chosen/chosen.jquery.js"
                )
            );    
     
           
        // $this->layout->css
            // (
                // array
                // (
                    // base_url()."public/backend/css/calendario.css",
                    // base_url()."public/backend/fancybox/jquery.fancybox.css",
                   // // base_url()."public/frontend/css/bootstrap-chosen.less"
                // )
            // );        
            // $this->layout->js
            // (
                // array
                // (
                    // base_url()."public/backend/js/calendar.js",
                    // base_url()."public/backend/js/calendar-setup.js",
                    // base_url()."public/backend/js/calendar-es.js",
                    // base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    // base_url()."public/frontend/js/dar_formato.js",
                    // base_url()."public/backend/fancybox/jquery.fancybox.js",
                   // // "http://harvesthq.github.io/chosen/chosen.jquery.js"
                // )
            // );  
            
           $id=$this->uri->segment(3);
		   $datos['valores'] = $this->cotizaciones_model->getCotizacionPorId($id);
           $datos['tipos'] = $this->materiales_model->getMaterialesTipo();
           $datos['vendedores'] = $this->vendedores_model->getVendedoresSelect();
           $datos['acInternos'] = $this->acabados_model->getAcabadosInternos();
           $datos['acExternos'] = $this->acabados_model->getAcabadosExternos();
           $datos['actInternosReg'] = $this->cotizaciones_model->getAcabadosInternosCotizacionPorId($id);
           $datos['actExternosReg'] = $this->cotizaciones_model->getAcabadosExternosCotizacionPorId($id);
           $this->layout->view('CotizacionEditar',$datos); 
    }
    
    public function eliminar($id = null)
    {
         $datos = array("id"=>$this->uri->segment(3));
         $id=$this->uri->segment(3);
         $resultado = $this->cotizaciones_model->delete($id);

                            if($resultado)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
					           redirect(base_url().'cotizaciones',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'cotizaciones/add',  301);
                            }
                                           
        }
    
    //Solicita Muestra
    public function solicita_muestra($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            if(sizeof($datos)==0){show_404();}
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        
           if($this->input->post())
            {
                if($this->form_validation->run("solicita_muestra"))
                {
                            switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista";
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                    break;
                               }
                            $data=array
                                      (
                                         "id_cotizacion"=>$this->input->post('id',true),
                                         "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                         "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                         "materialidad_1"=>$this->input->post("materialidad_1",true),
                                         "materialidad_2"=>$this->input->post("materialidad_2",true),
                                         "descripcion"=>$this->input->post('des',true),
                                         "medidas_de_la_caja"=>$this->input->post('medidas_de_las_cajas',true),
                                         "medidas_de_la_caja_2"=>$this->input->post('medidas_de_las_cajas_2',true),
                                         "medidas_de_la_caja_3"=>$this->input->post('medidas_de_las_cajas_3',true),
                                         "medidas_de_la_caja_4"=>$this->input->post('medidas_de_las_cajas_4',true),
                                      );
                                      if(sizeof($ing)==0)
                                      {
                                        $this->db->insert("solicita_muestra",$data);
                                      }else
                                      {
                                         $this->db->where('id_cotizacion', $this->input->post('id',true));
                                        $this->db->update("solicita_muestra",$data);
                                      }
                                       $config['mailtype'] = 'html';
                                        $this->email->initialize($config);
                                        $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                        $this->email->to($this->input->post('vendedor_correo',true)); 
                                        $this->email->bcc('respaldocorreos@grauindus.cl');
                                        $this->email->subject('Mensaje de Cartonajes Grau');
                                        $html="<h2>Nuevo Mensaje:</h2>Se ha enviado la solicitud de muestra de la cotización N° ".$this->input->post("id",true)."<br />Se envía con el siguiente comentario :".$this->input->post("des",true)." ";
                                        $this->email->message($html);   
                    
                                        $this->email->send();
                                      
                                       $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301); 
                }
            }
             $this->layout->css
            (
                array
                (
                 
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
           
            $this->layout->js
            (
                array
                (
                   
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js"
                )
            );    
            $this->layout->view('solicita_muestra',compact("datos","id","pagina","ing","fotomecanica"));
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
    /*
     * 
     * 
     */
    
    //Revisión Ingeniería
    public function rechazar_cotizacion(){
       if($this->session->userdata('id'))
        {
         $id=$this->input->post("valor1",true);
         $estado=$this->input->post("valor2",true);
         $glosa=$this->input->post("valor3",true);
             
         if(!$id){show_404();}
            
                if($glosa!="")
                {   // Rechazo en cotizacion
                    if($this->input->post())
                    {
                     $data_rechazo=array
                    (
                    "estado"=>$estado,
                    "glosa"=>$glosa,
                    "id_cotizacion"=>$id,  

                    );
                    $this->db->where('id_cotizacion', $this->input->post('valor1',true));
                    $this->db->update("cotizacion_ingenieria",$data_rechazo);
                    
                    //Fin de Rechazo en cotizacion
                                
                
                }
                echo '<div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Se Rechazó la Cotización hacia Ingeniería</div>';
                
            }else{
                
                echo '<div class="well well-small"><button type="button" class="close" data-dismiss="alert">x</button><ul><li>El campo <strong>glosa</strong> no puede estar vacio es obligatorio.</li>
                </ul></div>';
            }
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    
            }
    public function revision_ingenieria($id=null,$pagina=null)
    {
            
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            if(sizeof($datos)==0){show_404();}
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $cotizaciones_grupales=$this->cotizaciones_model->getCotizacionesGrupalesPorId($id);
            $matenombre=$this->materiales_model->getMaterialesSelectCartulinaAudi($datos->materialidad_1);
            $moldes2=$this->moldes_model->getMoldesPorId($datos->numero_molde);
            $nombreProducto=$this->productos_model->getProductosPorNombre($datos->producto);
            // $matenombre2=$this->materiales_model->getMaterialesSelectCartulinaAudi($datos->materialidad_2);
            //$matenombre3=$this->materiales_model->getMaterialesSelectCartulinaAudi($datos->materialidad_3);
            //print_r($matenombre);
            
           // $materialidad_ant1="$matenombre->gramaje ( $matenombre->materiales_tipo - $ $matenombre->precio ) ( $matenombre->reverso )";
            //echo $materialidad_ant2="$matenombre2->gramaje ( $matenombre2->materiales_tipo - $ $matenombre2->precio ) ( $matenombre2->reverso )<br>";
            //echo $materialidad_ant3="$matenombre2->gramaje ( $matenombre3->materiales_tipo - $ $matenombre3->precio ) ( $matenombre3->reverso )<br>";
           // exit();
            if($this->input->post())
            {
//               echo $datos->numero_molde."<br />";
//               echo $this->input->post('nm',true)."<br />";
//               echo $condicion=$datos->condicion_del_producto."<br />";
                if($this->input->post("nm",true)!=11 && $this->input->post("nm",true)!=12 && $this->input->post("nm",true)!=13 && $this->input->post("nm",true)!=14 && $this->input->post("nm",true)!=15){
                if($datos->numero_molde!=$this->input->post("nm",true) && $datos->condicion_del_producto=='Nuevo'){
                    $condicion_del_producto='Repetición Con Cambios';
                }else{
                    $condicion_del_producto=$datos->condicion_del_producto;
                }}
            //   echo $condicion_del_producto;
              //  exit();
                $arreglo_archivo_cliente=$this->cotizaciones_model->getCampoArchivoClientePorId($id);
                $archivo_a_borrar_trazado=$ing->archivo;
                $archivo_a_borrar_cliente=$arreglo_archivo_cliente->archivo;
               
                if($condicion=="Nuevo")
                {
                    $valida="ad_cotizacion_ingenieria2";
                }else
                {
                    $valida="ad_cotizacion_ingenieria";
                }
                if($this->form_validation->run($valida))
                {
                     $fileerror=$this->input->post("fileerror",true);
                        if(empty($_FILES["file2"]["name"]))
                        {
                           if(sizeof($ing->archivo) > 0)
                           {
                               $file_name_dos=$ing->archivo;	
                           }else{
                               $file_name_dos="";	
                           }

                        }else
                        {
                           $error=NULL;
                           $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                           $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                           //$config['max_size'] = '10240';
                           $config['max_size'] = '2048';
                           $config['encrypt_name'] = true; 
                           $this->load->library('upload', $config);
                           if ( ! $this->upload->do_upload('file2'))
                           {
                               $this->session->set_flashdata('ControllerMessage', 'Error de archivo en la Información Digital (Cliente), no puede tener un tamaño mayor a 1 Megabyte (MB).');
                               $this->session->set_flashdata('css',"danger");                                   
                               $this->session->set_flashdata('post',"$_POST");                                   
                               redirect(base_url().'cotizaciones/revision_ingenieria/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                               $error = array('error' => $this->upload->display_errors());
                               $this->session->set_flashdata('mensaje', $error["error"]);
                               $this->session->set_flashdata('css',"danger");
                           }
                           $imagen2 = $this->upload->data();
                           $this->cotizaciones_model->delete_archivo_cliente($id);
                           unlink('./'.$this->config->item('direccion_pdf').$archivo_a_borrar_cliente);
                           $file_name_dos = $imagen2['file_name'];
                           $datos_archivo_cliente=array
                           (
                               "id_cotizacion"=>$id,
                               "archivo"=>$file_name_dos,
                               "fecha"=>date('Y-m-d'),                        
                           );
                           $this->cotizaciones_model->insertarArchivoCliente_RevisionIngenieria($datos_archivo_cliente);    
                           $this->upload->initialize($config);                           
                         }                    
                    
                    
                        if(empty($_FILES["file"]["name"]))
                        {
                             if(sizeof($ing->archivo) > 0)
                             {
                                 $file_name=$ing->archivo;	
                             }else{
                                 $file_name="";	
                             }
                        }else
                        {
                             $error=NULL;							   
                             $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                             $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                             //$config['max_size'] = '10240';
                             $config['max_size'] = '1024';
                             $config['encrypt_name'] = true; 
                             $this->load->library('upload', $config);
                             if (!$this->upload->do_upload('file'))
                             {
                                //print_r($_POST);exit();
                                $this->session->set_flashdata('ControllerMessage', 'Error de archivo en el PDF del trazado, no puede tener un tamaño mayor a 1 Megabyte (MB).');
                                $this->session->set_flashdata('css',"danger");                                   
                                //redirect(base_url().'cotizaciones/revision_ingenieria/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                                $error = array('error' => $this->upload->display_errors());
                                $this->session->set_flashdata('mensaje', $error["error"]);
                                $this->session->set_flashdata('css',"danger");
                                redirect(base_url().'cotizaciones/revision_ingenieria/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                             }
                             $ima = $this->upload->data();
                             unlink('./'.$this->config->item('direccion_pdf').$archivo_a_borrar_trazado);                             
                             $file_name = $ima['file_name'];
                         } 

                        switch($this->input->post("datos_tecnicos"))
                        {
                          case '1':
                                  $datos_tecnicos="Microcorrugado";
                                  break;
                          case '2':
                                  $datos_tecnicos="Corrugado";
                                  break;
                          case '3':
                                  $datos_tecnicos="Cartulina-cartulina";
                                  break;
                          case '4':
                                  $datos_tecnicos="Sólo Cartulina";
                                  break;
                          case '5':
                                  $datos_tecnicos="Onda a la Vista (MicroCorrugado/Corrugado)";
                                  break;
                          case '6':
                                  $datos_tecnicos="Otro";
                                  break;
                          case '7':
                                  $datos_tecnicos="Se solicita proposición";
                                  break;
                          case '9':
                                  $datos_tecnicos="Onda a la Vista (Corrugado/Corrugado)";
                                  break;
                          case '10':
                                  $datos_tecnicos="Onda a la Vista (MicroCorrugado/MicroCorrugado)";
                                  break;
                          case '11':
                                  $datos_tecnicos="Indefinido";
                                  break;                                 
                        }
//                        if($this->input->post('estado',true)==1)
//                        {
                              $quien=$this->session->userdata('id');
                              $cuando=date("Y-m-d");

							   
			       //Verificar tipo de molde seleccionado
                               $estanlosmoldes = 'NO';
                               $hacer_troquel="";
                               $lleva_troquelado="";     
                               if($this->input->post("select_estan_los_moldes",true)=='SI')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'SI';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                    
                               }
                               
                               if($this->input->post("select_estan_los_moldes",true)=='NO LLEVA')
                               {
                                    $numeroMolde = $this->input->post("molde_generico",true);
                                    $estanlosmoldes = 'NO LLEVA';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="NO";                                       
                               }
							   
                               if($this->input->post("select_estan_los_moldes",true)=='CLIENTE LO APORTA')
                               {
                                    $numeroMolde = 2;
                                    $estanlosmoldes = 'CLIENTE LO APORTA';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                      
                                }
						   
                               if($this->input->post("select_estan_los_moldes",true)=='NO' && $this->input->post("hay_que_troquelar",true)=='SI')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO';
                                    $hacer_troquel="SI";
                                    $lleva_troquelado="SI";                                      
				}
                               if($this->input->post("select_estan_los_moldes",true)=='NO' && $this->input->post("hay_que_troquelar",true)=='NO')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="NO";                                      
				}
//                                echo $this->input->post("select_estan_los_moldes",true)."holaaa";
								
                               if (($this->input->post("select_estan_los_moldes",true)=='MOLDE GENERICO') and ($this->input->post("select_estan_los_moldes_genericos",true)=='SI'))
                               {
                                    $numeroMolde = $this->input->post("molde_generico",true);
                                    $estanlosmoldes = 'MOLDE GENERICO';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                    
                                }
                                elseif (($this->input->post("select_estan_los_moldes",true)=='MOLDE REGISTRADOS DEL CLIENTE') and ($this->input->post("select_estan_los_moldes_no_genericos_clientes",true)=='SI'))
                                {
                                    $numeroMolde = $this->input->post("molde_registrado",true);
                                    $estanlosmoldes = 'MOLDE REGISTRADOS DEL CLIENTE';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                       
                                }       
                          
                        $suma_largo_aleta=$this->input->post("ancho_1",true)+$this->input->post("ancho_2",true)+$this->input->post("largo_1",true)+$this->input->post("largo_2",true)+$this->input->post("aleta_pegado",true);
                        
                        $matnombre1 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_1",true));
                        $matnombre2 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_2",true));
                        $matnombre3 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_3",true));
                        
                        if($moldes2->archivo!=""){
                            if($file_name==""){
                            $file_name = $moldes2->archivo;}else{
                                $file_name = $file_name;
                            }
                        }
                        /***************************************/
//                        if($this->input->post('numero_de_molde',true)!=""){
//                        $data_molde=array(
//                            "cuchillocuchillo"=>$this->input->post('cci1'),
//                            "cuchillocuchillo2"=>$this->input->post('cci2'),
//                            "ancho_bobina"=>$this->input->post('ancho_ing_1'),
//                            "largo_bobina"=>$this->input->post('largo_ing_2'),
//                            "unidades_productos_completos"=>$this->input->post('unidades_por_pliego_ing'),
//                            "piezas_totales"=>$this->input->post('piezas_totales_ing'),
//                            "medidas_de_las_cajas"=>$this->input->post('mci1'),
//                            "medidas_de_las_cajas_2"=>$this->input->post('mci2'),
//                            "medidas_de_las_cajas_3"=>$this->input->post('mci3'),
//                            "medidas_de_las_cajas_4"=>$this->input->post('mci4'),
//                        );
                        //echo $file_name."<br />"; 
                        $archivomolde=$this->moldes_model->getMoldesPorId($this->input->post('numero_de_molde',true));
                        if(sizeof($archivomolde)>0 && $archivomolde->id!=1){
                            if($archivomolde->archivo!=""){
                                if($file_name!=$archivomolde->archivo){  
                                $file_name=$archivomolde->archivo;
                                }
                            }
                        }
//                       echo $this->input->post('numero_de_molde',true)."<br />MN: ";
//                       echo $moldes2->archivo;echo "<br />MN: ";
//                        echo $file_name; 
//                       echo $archivomolde->archivo;exit();
                        //print_r($data_molde);exit();
//                        $this->db->where('id', $this->input->post('numero_de_molde',true));
//                        $this->db->update("moldes_grau",$data_molde);}
                        /***************************************/
                        if($datos->existe_trazado=='SI' && $datos->estan_los_moldes=='NO'){
                            $cuchillo1=$this->input->post('tamano_cuchillo_1',true);
                            $cuchillo2=$this->input->post('tamano_cuchillo_2',true);
                        }else{
                            $cuchillo1=$this->input->post('cci1',true);
                            $cuchillo2=$this->input->post('cci2',true);
                        }
                        
                        $trazadosing = $this->trazados_model->getTrazadosPorId($datos->id);
                        if($trazadosing>0){
                        $unidades_por_pliego = $this->input->post('unidades_por_pliego',true);
                        $piezas_totales=$this->input->post('piezas_totales_en_el_pliego',true);
                        }else{
                        $unidades_por_pliego = $this->input->post('unidades_por_pliego_ing',true);
                        $piezas_totales=$this->input->post('piezas_totales_ing',true);   
                        }
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post('id',true),
                            "producto"=>$this->input->post('producto',true),
                            "medidas_de_la_caja"=>$this->input->post('medidas_de_las_cajas',true),
                            "medidas_de_la_caja_2"=>$this->input->post('medidas_de_las_cajas_2',true),
                            "medidas_de_la_caja_3"=>$this->input->post('medidas_de_las_cajas_3',true),
                            "medidas_de_la_caja_4"=>$this->input->post('medidas_de_las_cajas_4',true),
//                            "unidades_por_pliego"=>$this->input->post('unidades_por_pliego',true),
                            "unidades_por_pliego"=>$unidades_por_pliego,
                            //"piezas_totales_en_el_pliego"=>$this->input->post('piezas_totales_en_el_pliego',true),
                            "piezas_totales_en_el_pliego"=>$piezas_totales,
                            "metros_de_cuchillo"=>$this->input->post('metros_de_cuchillo',true),
                            "tamano_a_imprimir_1"=>$this->input->post('tamano_1',true),
                            "tamano_a_imprimir_2"=>$this->input->post('tamano_2',true),
                            //"tamano_cuchillo_1"=>$this->input->post('tamano_cuchillo_1',true),
                            //"tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                            "tamano_cuchillo_1"=>$cuchillo1,
                            "tamano_cuchillo_2"=>$cuchillo2,
                            "materialidad_datos_tecnicos"=>$datos_tecnicos,
                            "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                            "materialidad_1"=>$matnombre1->nombre,
                            "materialidad_2"=>$matnombre2->nombre,
                            "materialidad_3"=>$matnombre3->nombre,
                            "materialidad_4"=>$this->input->post("materialidad_4",true),
                            "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                            "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
                            "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),
                            "detalle_piezas_adicionales"=>$this->input->post("detalle_piezas_adicionales",true),
                            "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                            "tipo_de_pegado"=>$this->input->post("tipo_de_pegado1",true),
                            "lineas_pegado"=>$this->input->post("lineas_pegado",true),
                            "detalle_lineas_pegado"=>$this->input->post("detalle_lineas_pegado",true),
                            "es_una_maquina"=>$this->input->post("es_una_maquina",true),
                            "impresion_compartida"=>$this->input->post("impresion_compartida",true),
                            "contiene_otras_cotizaciones"=>$this->input->post("contiene_otras_cotizaciones",true),
                            "numero_cotizacion"=>$this->input->post("numero_cotizacion",true),
                            "archivo"=>$file_name,
                            "fecha"=>date("Y-m-d"),
                            "trabajos_adicionales"=>$this->input->post("trabajos_adicionales",true),
                            "trabajos_adicionales_glosa"=>$this->input->post("trabajos_adicionales_glosa",true),
                            "estado"=>$this->input->post("estado",true),
                            "estan_los_moldes"=>$estanlosmoldes,
                            "numero_molde"=>$numeroMolde,
                            "id_adhesivo"=>$this->input->post("adhesivo",true),
                            "quien"=>$quien,
                            "cuando"=>$cuando,
                            "solo_pegado"=>$this->input->post("solo_pegado",true),
                            "tamano_pieza_a_empaquetar_ancho"=>$this->input->post("tamano_pieza_a_empaquetar_ancho",true),
                            "tamano_pieza_a_empaquetar_largo"=>$this->input->post("tamano_pieza_a_empaquetar_largo",true),
                            "glosa"=>$this->input->post("glosa",true),
                            "pegado"=>$this->input->post("pegado",true),
                            "doblado"=>$this->input->post("doblado",true),
                            "empaquetado"=>$this->input->post("empaquetado",true),
                            //   "tipo_pegado"=>$this->input->post("tipo_pegado",true),
                            "pegado_puntos"=>$this->input->post("pegado_puntos",true),
                            "pegado_cantidad_puntos"=>$this->input->post("pegado_cantidad_puntos",true),
                            "tipo_fondo"=>$this->input->post("tipo_fondo",true),
                            "lleva_aletas"=>$this->input->post("lleva_aletas",true),
                            "total_aplicaciones_adhesivo"=>$this->input->post("total_aplicaciones_adhesivo",true),
                            "id_molde"=>1,
                            "aleta_pegado"=>$this->input->post("aleta_pegado",true),
                            "ancho_1"=>$this->input->post("ancho_1",true),
                            "ancho_2"=>$this->input->post("ancho_2",true),
                            "largo_1"=>$this->input->post("largo_1",true),
                            "largo_2"=>$this->input->post("largo_2",true),
                            "largo_total_de_la_caja"=>$this->input->post("largo_total_de_la_caja",true),
                            "cantidad_ordenes"=>$this->input->post("cantidad_ordenes",true),
                            "suma_largo_aleta"=>$suma_largo_aleta,
                            "nombre_molde"=>$this->input->post("nombre_molde",true),
                            "troquel_por_atras"=>$this->input->post("troquel_por_atras",true),
                            "lleva_mica"=>$this->input->post("lleva_mica",true),
                            "largo_mica"=>$this->input->post("largo_mica",true),
                            "ancho_mica"=>$this->input->post("ancho_mica",true),  
                            "lleva_fondo_negro"=>$this->input->post("lleva_fondo_negro",true),
                            "fondo_otro_color"=>$this->input->post("fondo_otro_color",true),
                            "ccac_1"=>$this->input->post("ccac_1",true),
                            "ccac_2"=>$this->input->post("ccac_2",true),
                            "imagen_impresion"=>$this->input->post("imagen_impresion",true), 
                            "procesos_especiales_folia"=>$this->input->post("folia",true),
                            "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                            "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                            "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                            "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                            "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                            "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                            "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                            "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                            "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                            "folia1_proceso_seletec"=>$this->input->post("folia1_proceso_seletec",true),
                            "folia2_proceso_seletec"=>$this->input->post("folia2_proceso_seletec",true),
                            "folia3_proceso_seletec"=>$this->input->post("folia3_proceso_seletec",true),
                            "cuno1_proceso_seletec"=>$this->input->post("cuno1_proceso_seletec",true),
                            "cuno2_proceso_seletec"=>$this->input->post("cuno2_proceso_seletec",true),
                            "hacer_troquel"=>$hacer_troquel,
                            "lleva_troquelado"=>$lleva_troquelado,
                            // Trabajos internos
                            "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                            "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                            "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                            // Trabajos Externos
                            "acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                            "acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                            "acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),                             
                            "colores"=>$this->input->post("colores",true),                            
                            // agregado por ehndz campo: Imprimir_contra_la_fibra (si / no)
                            "imprimir_contra_la_fibra"=>$this->input->post("imprimir_contra_la_fibra",true),                             
                            //campos nuevos para barniz en revision ingenieria
                            "ing_lleva_barniz"=>$this->input->post("ing_lleva_barniz",true),                             
                            "ing_reserva_barniz"=>$this->input->post("ing_reserva_barniz",true),                             
                            "ing_cala_caucho"=>$this->input->post("ing_cala_caucho",true), 
                            "colores"=>$this->input->post("colores",true),                             
                            "hay_que_troquelar"=>$this->input->post("hay_que_troquelar",true),                             
                            "folia1_molde_selected"=>$this->input->post("folia1_molde_selected",true),                             
                            "folia2_molde_selected"=>$this->input->post("folia2_molde_selected",true),                             
                            "folia3_molde_selected"=>$this->input->post("folia3_molde_selected",true),                             
                            "cuno1_molde_selected"=>$this->input->post("cuno1_molde_selected",true),                             
                            "cuno2_molde_selected"=>$this->input->post("cuno2_molde_selected",true),                                                        
                            "tiene_color_modificado"=>$this->input->post("tiene_color_modificado_ing",true),                             
                            "numero_color_modificado"=>$this->input->post("numero_color_modificado_ing",true),
                            "id_mat_placa1"=>$this->input->post("materialidad_1",true),
                            "id_mat_onda2"=>$this->input->post("materialidad_2",true),
                            "id_mat_liner3"=>$this->input->post("materialidad_3",true),
                            );
                      // exit(print_r($data));
                        
                            //guardar auditoria materialidad
                                    
                                        $auditoria_materialidad=$this->auditorias_model->getAuditoriasPorIdCotizacion($this->input->post('id',true));
                                            
                                        if(sizeof($auditoria_materialidad)>0){
                                            $materialidad_anterior_1=$auditoria_materialidad->materialidad_nueva_1;
                                            $materialidad_anterior_2=$auditoria_materialidad->materialidad_nueva_2;
                                            $materialidad_anterior_3=$auditoria_materialidad->materialidad_nueva_3;
                                        }else{
                                            $materialidad_anterior_1=$materialidad_1;
                                            $materialidad_anterior_2=$materialidad_2;
                                            $materialidad_anterior_3=$materialidad_3;
                                        }
                                        $dataAuditoria=array(
                                            "id_cotizacion"=>$this->input->post('id',true),
                                            "id_procedencia_cambio"=>'4',
                                            "materialidad_anterior_1"=>$materialidad_anterior_1,
                                            "materialidad_anterior_2"=>$materialidad_anterior_2,
                                            "materialidad_anterior_3"=>$materialidad_anterior_3,
                                            "materialidad_nueva_1"=>$this->input->post("materialidad_1",true),
                                            "materialidad_nueva_2"=>$this->input->post("materialidad_2",true),
                                            "materialidad_nueva_3"=>$this->input->post("materialidad_3",true),
                                            "descripcion_procedencia_cambio"=>'revision_ingenieria',
                                            "id_usuario"=>$this->session->userdata('id'),
                                        );
                                          
                                        //$this->auditorias_model->insertarAuditoria($dataAuditoria);
                                        
                                    //fin de guardar auditoria materialidad
                        
                            if(sizeof($ing)==0)
                            {
                                   $guardar=$this->cotizaciones_model->insertarIngenieria($data);
                                   if($this->input->post("estado",true)==2)
                                   {
                                           $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                           $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                                           $config['mailtype'] = 'html';
                                           $this->email->initialize($config);
                                           $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                           $this->email->to(array($vendedor->correo, 'contactos_fotomecanica@grauindus.cl'));
                                           $this->email->bcc('respaldocorreos@grauindus.cl');
                                           $this->email->subject('Mensaje de Cartonajes Grau');
                                           $html='<h2>Revisión Ingeniería:</h2>';
                                           //$html.='La cotización N°'.$guardar.' ha sido rechazada, con la glosa:<br/>'.$this->input->post("glosa",true);
                                           $html.='La cotización N°'.$this->input->post('id',true).' ha sido rechazada, con la glosa:<br/>'.$this->input->post("glosa",true).'<br><br> Rechazado Por: '.$user->nombre;
                                           $this->email->message($html);   
                                           $this->email->send(); 
                                   }
                                   if($this->input->post("estado",true)==1)
                                   {
                                       $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                       $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                                       $config['mailtype'] = 'html';
                                       $this->email->initialize($config);
                                       $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                       //$this->email->to($vendedor->correo); 
                                       $this->email->to(array($vendedor->correo, 'contactos_fotomecanica@grauindus.cl'));
                                       $this->email->bcc('respaldocorreos@grauindus.cl');
                                       $this->email->subject('Mensaje de Cartonajes Grau');
                                       $html='<h2>Revisión Ingeniería:</h2>';
                                       $html.='La cotización N°'.$this->input->post('id',true).' ha sido Liberada, con la glosa:<br/>'.$this->input->post("glosa",true).'<br><br> Liberada Por: '.$user->nombre;
                                       $this->email->message($html);   
                                       $this->email->send(); 
                                        //Liberado
                                       if($this->input->post("contiene_otras_cotizaciones",true) == "Primera")
                                       {
                                            $data_grupales1=array
                                            (
                                               "cotizacion_1"=>$this->input->post("id",true),
                                               "nombre_grupo"=>$this->input->post("nombre_grupo",true),
                                               "fecha"=>date("Y-m-d")
                                            );
                                            $id_cotizaciones_grupales=$this->cotizaciones_model->insertarCotizacionesGrupales($data_grupales1);
                                            $data_grupales_en_revision_ingenieria=array
                                            (
                                                 "cotizacion_grupal"=>$id_cotizaciones_grupales,
                                            );	  
                                            //Se guarda Id del grupo de cotizaciones
                                            $this->db->where('id_cotizacion', $this->input->post('id',true));
                                            $this->db->update("cotizacion_ingenieria",$data_grupales_en_revision_ingenieria);
                                        }	
                                    }
                            }else
                            {
                               // print_r($data);exit();
                                $this->db->where('id_cotizacion', $this->input->post('id',true));
                                $this->db->update("cotizacion_ingenieria",$data);
                                if($this->input->post("estado",true)==2)
                                {
                                    $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                    $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                                    $config['mailtype'] = 'html';
                                    $this->email->initialize($config);
                                    $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                    //$this->email->to($vendedor->correo); 
                                    $this->email->to(array($vendedor->correo, 'contactos_fotomecanica@grauindus.cl'));
                                    $this->email->bcc('respaldocorreos@grauindus.cl');
                                    $this->email->subject('Mensaje de Cartonajes Grau');
                                    $html='<h2>Revisión Ingeniería:</h2>';
                                    $html.='La cotización N°'.$this->input->post('id',true).' ha sido rechazada, con la glosa:<br/>'.$this->input->post("glosa",true).'<br><br> Rechazado Por: '.$user->nombre;
                                    $this->email->message($html);   
                                    $this->email->send(); 
                                }
                                if($this->input->post("estado",true)==1)
                                {
                                    $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                    $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                                    $config['mailtype'] = 'html';
                                    $this->email->initialize($config);
                                    $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                    //$this->email->to($vendedor->correo); 
                                    $this->email->to(array($vendedor->correo, 'contactos_fotomecanica@grauindus.cl'));
                                    $this->email->bcc('respaldocorreos@grauindus.cl');
                                    $this->email->subject('Mensaje de Cartonajes Grau');
                                    $html='<h2>Revisión Ingeniería:</h2>';
                                    $html.='La cotización N°'.$this->input->post('id',true).' ha sido Liberada, con la glosa:<br/>'.$this->input->post("glosa",true).'<br><br> Liberado Por: '.$user->nombre;
                                    $this->email->message($html);   
                                    $this->email->send(); 
                                    //Liberado
                                    if($this->input->post("contiene_otras_cotizaciones",true) == "Primera")
                                    {
                                        $data_grupales1=array
                                        (
                                            //"cotizacion_1"=>$this->input->post("id",true),
                                            "nombre_grupo"=>$this->input->post("nombre_grupo",true),
                                            "fecha"=>date("Y-m-d")
                                        );
                                        $id_cotizaciones_grupales=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($this->input->post('id',true));
                                        $id_del_grupo = $id_cotizaciones_grupales->cotizacion_grupal;
                                        $this->db->where('id', $id_del_grupo);
                                        $this->db->update("cotizaciones_grupales",$data_grupales1);
                                        /*$data_grupales_en_revision_ingenieria=array
                                          (
                                             "cotizacion_grupal"=>$id_del_grupo,
                                          );	  
                                        //Se guarda Id del grupo de cotizaciones
                                        $this->db->where('id_cotizacion', $this->input->post('id',true));
                                        $this->db->update("cotizacion_ingenieria",$data_grupales_en_revision_ingenieria);
                                        */
                                    }
                                }
                            }

                            // actualizo los moldes en cotizacion
                            $data_cotizacion=array
                            (
                               // moldes
                                "estan_los_moldes"=>$estanlosmoldes,
                                "numero_molde"=>$numeroMolde,
                                "imagen_impresion"=>$this->input->post("imagen_impresion",true),  
                                // cantidades
                                "cantidad_1"=>$this->input->post("can1",true),  
                                "cantidad_2"=>$this->input->post("can2",true),  
                                "cantidad_3"=>$this->input->post("can3",true),  
                                "cantidad_4"=>$this->input->post("can4",true),  
                                // piezas
                                "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
                                "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),
                                // materialidad
                                "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                "materialidad_1"=>$matnombre1->nombre,
                                "materialidad_2"=>$matnombre2->nombre,
                                "materialidad_3"=>$matnombre3->nombre,
                                "materialidad_4"=>$this->input->post("materialidad_4",true),
                                // los procesos especiales
                                "procesos_especiales_folia"=>$this->input->post("folia",true),
                                "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                "folia1_proceso_seletec"=>$this->input->post("folia1_proceso_seletec",true),
                                "folia2_proceso_seletec"=>$this->input->post("folia2_proceso_seletec",true),
                                "folia3_proceso_seletec"=>$this->input->post("folia3_proceso_seletec",true),
                                "cuno1_proceso_seletec"=>$this->input->post("cuno1_proceso_seletec",true),
                                "cuno2_proceso_seletec"=>$this->input->post("cuno2_proceso_seletec",true),
                                "folia1_molde_selected"=>$this->input->post("folia1_molde_selected",true),
                                "folia2_molde_selected"=>$this->input->post("folia2_molde_selected",true),
                                "folia3_molde_selected"=>$this->input->post("folia3_molde_selected",true),
                                "cuno1_molde_selected"=>$this->input->post("cuno1_molde_selected",true),
                                "cuno2_molde_selected"=>$this->input->post("cuno2_molde_selected",true),
                                // Trabajos internos
                                "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                // Trabajos Externos
                                "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),  
                                "id_mat_placa1"=>$this->input->post("materialidad_1",true),
                                "id_mat_onda2"=>$this->input->post("materialidad_2",true),
                                "id_mat_liner3"=>$this->input->post("materialidad_3",true),
                                "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                "retira_cliente"=>$this->input->post("retira_cliente",true),
                                "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                "distancia"=>quitarPuntosNumero($this->input->post("distancia",true)),
                                "cantidad_de_despachos"=>quitarPuntosNumero($this->input->post("cantidad_de_despachos",true)),
                                "forma_pago"=>$this->input->post("forma_pago",true),
                                "trazado"=>$this->input->post("trazados",true),
                                "existe_trazado"=>$this->input->post("existe_trazado",true),
                                "id_cliente"=>$this->input->post("cliente",true),
                                "condicion_del_producto"=>$condicion_del_producto,
                            );
                            //print_r($data_cotizacion);exit();
                            $this->db->where('id', $this->input->post('id',true));
                            $this->db->update("cotizaciones",$data_cotizacion);
                            
                            $data_fotomecanica=array
                                 (
                                    // moldes
                                    "estan_los_moldes"=>$estanlosmoldes,
                                    "numero_molde"=>$numeroMolde,
                                    // materialidad
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$matnombre1->nombre,
                                    "materialidad_2"=>$matnombre2->nombre,
                                    "materialidad_3"=>$matnombre3->nombre,
                                    "materialidad_4"=>$this->input->post("materialidad_4",true),                                
                                    // Trabajos internos
                                    "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    // Trabajos Externos
                                    "acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),                                
                                    // los procesos especiales
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "folia1_proceso_seletec"=>$this->input->post("folia1_proceso_seletec",true),
                                    "folia2_proceso_seletec"=>$this->input->post("folia2_proceso_seletec",true),
                                    "folia3_proceso_seletec"=>$this->input->post("folia3_proceso_seletec",true),
                                    "cuno1_proceso_seletec"=>$this->input->post("cuno1_proceso_seletec",true),
                                    "cuno2_proceso_seletec"=>$this->input->post("cuno2_proceso_seletec",true),
                                    "folia1_molde_selected"=>$this->input->post("folia1_molde_selected",true),                             
                                    "folia2_molde_selected"=>$this->input->post("folia2_molde_selected",true),                             
                                    "folia3_molde_selected"=>$this->input->post("folia3_molde_selected",true),                             
                                    "cuno1_molde_selected"=>$this->input->post("cuno1_molde_selected",true),                             
                                    "cuno2_molde_selected"=>$this->input->post("cuno2_molde_selected",true),                             
                                    "tiene_color_modificado"=>$this->input->post("tiene_color_modificado_ing",true),                             
                                    "numero_color_modificado"=>$this->input->post("numero_color_modificado_ing",true),
                                    "colores"=>$this->input->post("colores",true),
                                    "id_mat_placa1"=>$this->input->post("materialidad_1",true),
                                    "id_mat_onda2"=>$this->input->post("materialidad_2",true),
                                    "id_mat_liner3"=>$this->input->post("materialidad_3",true),
                                    "producto"=>$this->input->post("producto",true),
                           
                                  );                            
                            $this->db->where('id_cotizacion', $this->input->post('id',true));
                            $this->db->update("cotizacion_fotomecanica",$data_fotomecanica);                            
                            
                                
                            $nombre_molde = $this->moldes_model->getMoldesPorId($numeroMolde);
                                $data_ing_nombre=array(
                                    "nombre_molde"=>$nombre_molde->nombre,
                                );
                            $this->db->where('id_cotizacion', $this->input->post('id',true));
                            $this->db->update("cotizacion_ingenieria",$data_ing_nombre); 
                                
                                $data_orden_compra=array(
                                    "tiene_molde"=>$estanlosmoldes,
                                    "id_molde"=>$numeroMolde,
                                );
                            $this->db->where('id_cotizacion', $this->input->post('id',true));
                            $this->db->update("cotizaciones_orden_de_compra",$data_orden_compra); 
                                
                                $data_orden_produccion=array(
                                    "estan_los_moldes"=>$estanlosmoldes,
                                    "tiene_molde"=>$estanlosmoldes,
                                    "id_molde"=>$numeroMolde,
                                    "nombre_molde"=>$nombre_molde->nombre,
                                );
                                
                            $this->db->where('id_cotizacion', $this->input->post('id',true));
                            $this->db->update("orden_de_produccion",$data_orden_produccion); 
                            
                            if($this->input->post("contiene_otras_cotizaciones",true) == 'SI')
                            {
                               if($this->input->post("numero_cotizacion",true) != '0')
                               {
                                    //Se busca por primera cotizacion 
                                    $cotizaciones_grupales=$this->cotizaciones_model->getCotizacionesGrupalesPorIdCotizacionPrimera($this->input->post('numero_cotizacion',true));
                                    $i2 = 0;
                                    for ($i = 2; $i <= 10; $i++) 
                                    {
                                        if('cotizacion_'.$i == '')
                                        {
                                            $i2 = $i;
                                            $i = 11;
                                        }
                                    }
                                    /*
                                    $data_grupales2=array
                                    (
                                     "cotizacion_1"=>$this->input->post('id',true),
                                     "nombre_grupal"=>$this->input->post('nombre_grupal',true),
                                    )

                                    $this->db->where('id', $id_del_grupo);
                                    $this->db->update("cotizaciones_grupales",$data_grupales1);		  
                                    */			  
                                }
                            }
                            
                            $fileerror = $this->input->post("fileerror",true);
                            //echo $fileerror;exit();
                            $this->session->set_flashdata('fileerror', $fileerror);
                            $this->session->set_flashdata('ControllerMessage', 'Se ha Guardado el registro exitosamente.');
                            redirect(base_url().'cotizaciones/revision_ingenieria/'.$this->input->post("id",true).'/'.$this->input->post("pagina",true),  301); 
//                            redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301);
                }
            }
            
             $this->layout->css
            (
                array
                (
                 
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                )
            );        
          
            $this->layout->js
            (
                array
                (
                   
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                )
            );    
            $fileerror=$this->input->post("fileerror",true);
            $adhesivos=$this->adhesivos_model->getAdhesivos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");             
            $this->layout->view('revision_ingenieria',compact("datos","id","pagina","ing","fotomecanica","adhesivos","hoja","internos","externos","cotizacion","fileerror","nombreProducto"));
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
    // Orden de Compra
    public function orden_de_compra($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        {
           if(!$id){show_404();}
           $datos=$this->cotizaciones_model->getCotizacionPorId($id);
           $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
           $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
           $orden=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
           
//           print_r($orden);
//           exit;
           $presupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($id);
           $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
           $archivo_cliente = $this->cotizaciones_model->getArchivoClientePorCotizacion($id);
           if(sizeof($datos)==0){show_404();}
           if(sizeof($orden)==0)
           {
                $nombre_molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
           }
           else 
           {    
                $nombre_molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
           }    

            if($this->input->post())
            {
                $archivo_a_borrar_cliente=$orden->archivo;
                $archivo_a_borrar_cliente2=$archivo_cliente->archivo;
                if($this->form_validation->run("ad_orden_de_compra"))
                {
                    if (empty($_FILES["file2"]["name"]))
                    {
                        if(sizeof($archivo_cliente->archivo) > 0)
                        {
                            $file_name2=$archivo_cliente->archivo;	
                        }else{
                            $file_name2="";	
                        }
                        
                    }else{
                        $file_name2=$_FILES["file2"]["name"];
                        $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                        $config['allowed_types'] = 'jpg|jpeg|png|pdf|xls|xlsx|csv|docx|doc';
                        //$config['max_size'] = '10240'; //550 x 138
                        $config['max_size'] = '81920'; //550 x 138
                        $config['encrypt_name'] = true; 
                        $this->load->library('upload', $config);
                        if ( ! $this->upload->do_upload('file2'))
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Error de archivo de Orden de Compra, no puede tener un tamaño mayor a 1 Megabyte (MB).');
                                $this->session->set_flashdata('css',"danger");                                   
                                redirect(base_url().'cotizaciones/orden_de_compra/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);                                         
                                $error = array('error' => $this->upload->display_errors());
                                $this->session->set_flashdata('ControllerMessage', $error["error"]);
                                redirect(base_url().'cotizaciones/orden_de_compra/'.$this->input->post("id",true)."/",$this->input->post("pagina",true),  301);
                            }else
                            {
                                $ima = $this->upload->data();
                                $file_name2 = $ima['file_name'];
                                unlink('./'.$this->config->item('direccion_pdf').$archivo_a_borrar_cliente2);
                                $datos_archivo_cliente=array
                        (
                           "id_cotizacion"=>$this->input->post('id',true),
                           "archivo"=>$file_name2,
                           "fecha"=>date('Y-m-d'),                        
                        );
                            }
                        //unlink('./'.$this->config->item('direccion_pdf').$archivo_a_borrar_cliente2);
                        
                        
                       // print_r($datos_archivo_cliente);exit();
                        $this->cotizaciones_model->insertarArchivoCliente_RevisionIngenieria($datos_archivo_cliente);  
                    }
                                        
                    if(empty($_FILES["file"]["name"]))
                    {
                        if(sizeof($ing->archivo) > 0)
                        {
                            $file_name=$orden->archivo;	
                        }else{
                            $file_name="";	
                        }                        
                    }else
                    {
                        $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                        $config['allowed_types'] = 'jpg|jpeg|png|pdf|xls|xlsx|csv|docx|doc';
                        //$config['max_size'] = '10240'; //550 x 138
                        $config['max_size'] = '81920'; //550 x 138
                        $config['encrypt_name'] = true; 
                        $this->load->library('upload', $config);
                         if ( ! $this->upload->do_upload('file'))
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Error de archivo de Orden de Compra, no puede tener un tamaño mayor a 1 Megabyte (MB).');
                                $this->session->set_flashdata('css',"danger");                                   
                                redirect(base_url().'cotizaciones/orden_de_compra/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);                                         
                                $error = array('error' => $this->upload->display_errors());
                                $this->session->set_flashdata('ControllerMessage', $error["error"]);
                                redirect(base_url().'cotizaciones/orden_de_compra/'.$this->input->post("id",true)."/",$this->input->post("pagina",true),  301);
                            }else
                            {
                                $ima = $this->upload->data();
                                $file_name = $ima['file_name'];
                                unlink('./'.$this->config->item('direccion_pdf').$archivo_a_borrar_cliente);
                            }
                    }
                    if($this->input->post('estado',true)==1)
                    {
                       $quien=$this->session->userdata('id');
                       $cuando=date("Y-m-d");
                    }else
                    {
                       $quien=0;
                       $cuando="0000-00-00"; 
                    }
		    //$fechaDespacho = date_format($this->input->post('fecha_despacho',true),'Y-m-d');
                    if(sizeof($orden)==0)
                    {
			$valorxx = $this->cotizaciones_model->CantidadPorXXX($this->input->post('id',true),$this->input->post('cantidad_de_cajas',true),1);
                        
                        //***********************************************************
                        $proveedores = array(
                                        'folia1'=>[
                                            'nfolia1'=>$this->input->post('nfolia1',true),
                                            'pfolia1'=>$this->input->post('pfolia1',true),
                                        ],
                                        'cffolia1'=>[
                                            'mnfolia1'=>$this->input->post('mnfolia1',true),
                                            'mpfolia1'=>$this->input->post('mpfolia1',true),
                                        ],
                                        'folia2'=>[
                                            'nfolia2'=>$this->input->post('nfolia2',true),
                                            'pfolia2'=>$this->input->post('pfolia2',true),
                                        ],
                                        'cffolia2'=>[
                                            'mnfolia2'=>$this->input->post('mnfolia2',true),
                                            'mpfolia2'=>$this->input->post('mpfolia2',true),
                                        ],
                                        'folia3'=>[
                                            'nfolia3'=>$this->input->post('nfolia3',true),
                                            'pfolia3'=>$this->input->post('pfolia3',true),
                                        ],
                                        'cffolia3'=>[
                                            'mnfolia3'=>$this->input->post('mnfolia3',true),
                                            'mpfolia3'=>$this->input->post('mpfolia3',true),
                                        ],
                                        'cuno1'=>[
                                            'ncuno1'=>$this->input->post('ncuno1',true),
                                            'pcuno1'=>$this->input->post('pcuno1',true),
                                        ],
                                        'cfcuno1'=>[
                                            'mncuno1'=>$this->input->post('mncuno1',true),
                                            'mpcuno1'=>$this->input->post('mpcuno1',true),
                                        ],
                                        'cuno2'=>[
                                            'ncuno2'=>$this->input->post('ncuno2',true),
                                            'pcuno2'=>$this->input->post('pcuno2',true),
                                        ],
                                        'cfcuno2'=>[
                                            'mncuno2'=>$this->input->post('mncuno2',true),
                                            'mpcuno2'=>$this->input->post('mpcuno2',true),
                                        ]);
                        
                        $proveedores = json_encode($proveedores);
                        //***********************************************************
                        
                        $fecha_orden_cliente = invertirFecha($this->input->post('fecha_orden_cliente'));
                        $fecha_despacho_solicitada_cliente = invertirFecha($this->input->post('fecha_despacho_solicitada_cliente'));
                      //  echo $fecha_despacho_solicitada_cliente;exit();
                        $data=array
                        (
                           "id_usuario"=>$this->session->userdata('id'),
                           "id_cotizacion"=>$this->input->post('id',true),
                           "estado"=>$this->input->post('estado',true),
                           "orden_de_compra_cliente"=>$this->input->post('orden_de_compra',true),
                           "precio"=>$this->input->post('precio',true),
                           "id_forma_pago"=>$this->input->post('forma_pago',true),
                           "fecha_despacho"=>$this->input->post('fecha_despacho',true),
//aÃ±adido por ehndz***********************************
                           //"fecha_orden_cliente"=>$this->input->post('fecha_orden_cliente',true),
                           "fecha_orden_cliente"=>$fecha_orden_cliente,
                           //"fecha_despacho_solicitado_cliente"=>$this->input->post('fecha_despacho_solicitada_cliente',true),
                           "fecha_despacho_solicitado_cliente"=>$fecha_despacho_solicitada_cliente,
                           //fin de aÃ±adido por ehndz***********************************
                            //echo date_format($date, 'Y-m-d H:i:s');
                           "forma_despacho"=>$this->input->post('forma_despacho',true),
                           //"forma_despacho"=>date_format($this->input->post('forma_despacho',true),'Y-m-d H:i:s'),
                           "horario_despacho"=>$this->input->post('horario_despacho',true),
                           "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                           "cantidad_1"=>$this->input->post('can_despacho_1',true),
                           "cantidad_2"=>$this->input->post('can_despacho_2',true),
                           "cantidad_3"=>$this->input->post('can_despacho_3',true),
                           "obs_facturar"=>$this->input->post('obs1',true),
                           "obs_condiciones_cobranza"=>$this->input->post('obs2',true),
                           "nota"=>$this->input->post('obs3',true),
                           "fecha"=>date("Y-m-d"),
                           "archivo"=>$file_name,
                           "cantidad_de_cajas"=>$this->input->post("cantidad_de_cajas",true),
                           "quien"=>$quien,
                           "cuando"=>$cuando,
                           "glosa"=>$this->input->post("glosa",true),
                           "nombre_producto"=>$this->input->post("nombre_producto",true),
                           "codigo_de_compra_cliente"=>$this->input->post("codigo_de_compra_cliente",true),
                           "tiene_molde"=>$this->input->post("tiene_molde",true),
                           "id_molde"=>$this->input->post("id_molde",true),
                           "proveedores"=>$proveedores,
                        );
                        $this->db->insert("cotizaciones_orden_de_compra",$data);    
                        
                         $datafot=array
                        ("producto"=>$this->input->post("nombre_producto",true),);
                         
                         $this->db->where('id_cotizacion', $this->input->post('id',true));
                        $this->db->update("cotizacion_fotomecanica",$datafot);
                         
                        $dataing=array
                        ("producto"=>$this->input->post("nombre_producto",true),);
                         
                         $this->db->where('id_cotizacion', $this->input->post('id',true));
                        $this->db->update("cotizacion_ingenieria",$dataing);
                        
                        $datacot=array
                        ("producto"=>$this->input->post("nombre_producto",true),);
                         
                         $this->db->where('id', $this->input->post('id',true));
                        $this->db->update("cotizaciones",$datacot);
                    }else
                    {
			$valorxx = $this->cotizaciones_model->CantidadPorXXX($this->input->post('id',true),$this->input->post('cantidad_de_cajas',true),1);
                        
                         //***********************************************************
                        $proveedores = array(
                                        'folia1'=>[
                                            'nfolia1'=>$this->input->post('nfolia1',true),
                                            'pfolia1'=>$this->input->post('pfolia1',true),
                                        ],
                                        'cffolia1'=>[
                                            'mnfolia1'=>$this->input->post('mnfolia1',true),
                                            'mpfolia1'=>$this->input->post('mpfolia1',true),
                                        ],
                                        'folia2'=>[
                                            'nfolia2'=>$this->input->post('nfolia2',true),
                                            'pfolia2'=>$this->input->post('pfolia2',true),
                                        ],
                                        'cffolia2'=>[
                                            'mnfolia2'=>$this->input->post('mnfolia2',true),
                                            'mpfolia2'=>$this->input->post('mpfolia2',true),
                                        ],
                                        'folia3'=>[
                                            'nfolia3'=>$this->input->post('nfolia3',true),
                                            'pfolia3'=>$this->input->post('pfolia3',true),
                                        ],
                                        'cffolia3'=>[
                                            'mnfolia3'=>$this->input->post('mnfolia3',true),
                                            'mpfolia3'=>$this->input->post('mpfolia3',true),
                                        ],
                                        'cuno1'=>[
                                            'ncuno1'=>$this->input->post('ncuno1',true),
                                            'pcuno1'=>$this->input->post('pcuno1',true),
                                        ],
                                        'cfcuno1'=>[
                                            'mncuno1'=>$this->input->post('mncuno1',true),
                                            'mpcuno1'=>$this->input->post('mpcuno1',true),
                                        ],
                                        'cuno2'=>[
                                            'ncuno2'=>$this->input->post('ncuno2',true),
                                            'pcuno2'=>$this->input->post('pcuno2',true),
                                        ],
                                        'cfcuno2'=>[
                                            'mncuno2'=>$this->input->post('mncuno2',true),
                                            'mpcuno2'=>$this->input->post('mpcuno2',true),
                                        ]);

                                         function printr($array){
                                        echo '<pre>';
                                        print_r($array);
                                        echo '</pre>';
                                        }
                                        $proveedores = json_encode($proveedores);
                                                
                                       // printr($proveedores);exit();
                        //***********************************************************
                         $fecha_orden_cliente = invertirFecha($this->input->post('fecha_orden_cliente'));
                         $fecha_despacho_solicitada_cliente = invertirFecha($this->input->post('fecha_despacho_solicitada_cliente'));
                        //echo $fecha_despacho_solicitada_cliente;exit();
                        $data=array
                        (
                           "id_usuario"=>$this->session->userdata('id'),
                           "id_cotizacion"=>$this->input->post('id',true),
                           "estado"=>$this->input->post('estado',true),
                           "orden_de_compra_cliente"=>$this->input->post('orden_de_compra',true),
                           "precio"=>$this->input->post('precio',true),
                           "id_forma_pago"=>$this->input->post('forma_pago',true),
                           "fecha_despacho"=>$this->input->post('fecha_despacho',true),
                               //aÃ±adido por ehndz***********************************
                           "fecha_orden_cliente"=>$fecha_orden_cliente,
                           //"fecha_despacho_solicitado_cliente"=>$this->input->post('fecha_despacho_solicitado_cliente',true),
                           "fecha_despacho_solicitado_cliente"=>$fecha_despacho_solicitada_cliente,
                           //fin de aÃ±adido por ehndz***********************************
                           "forma_despacho"=>$this->input->post('forma_despacho',true),
                           "horario_despacho"=>$this->input->post('horario_despacho',true),
                           "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                           "cantidad_1"=>$this->input->post('can_despacho_1',true),
                           "cantidad_2"=>$this->input->post('can_despacho_2',true),
                           "cantidad_3"=>$this->input->post('can_despacho_3',true),
                           "obs_facturar"=>$this->input->post('obs1',true),
                           "obs_condiciones_cobranza"=>$this->input->post('obs2',true),
                           "nota"=>$this->input->post('obs3',true),
                           "archivo"=>$file_name,
                           "nombre_producto"=>$this->input->post("nombre_producto",true),
                           "cantidad_de_cajas"=>$this->input->post("cantidad_de_cajas",true),
                           "codigo_de_compra_cliente"=>$this->input->post("codigo_de_compra_cliente",true),
                           "proveedores"=>$proveedores,
                        );
                      //  print_r($data);exit();
                        $this->db->where('id_cotizacion', $this->input->post('id',true));
                        $this->db->update("cotizaciones_orden_de_compra",$data);
                        
                         $datafot=array
                        ("producto"=>$this->input->post("nombre_producto",true),);
                         
                         $this->db->where('id_cotizacion', $this->input->post('id',true));
                        $this->db->update("cotizacion_fotomecanica",$datafot);
                         
                        $dataing=array
                        ("producto"=>$this->input->post("nombre_producto",true),);
                         
                         $this->db->where('id_cotizacion', $this->input->post('id',true));
                        $this->db->update("cotizacion_ingenieria",$dataing);
                        
                         $datacot=array
                        ("producto"=>$this->input->post("nombre_producto",true),);
                         
                         $this->db->where('id', $this->input->post('id',true));
                        $this->db->update("cotizaciones",$datacot);
                    }
                    $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
                    redirect(base_url().'cotizaciones/orden_de_compra/'.$this->input->post("id",true).'/'.$this->input->post("pagina",true),  301); 
//                    redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301);
                }
            }    
            $formas=$this->clientes_model->getFormasPago();
           
            $this->layout->js
            (
                array
                (
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/backend/js/bootstrap.file-input.js"
                )
            );   
            $this->layout->view('orden_de_compra',compact("archivo_cliente","formas","datos","id","pagina","ing","fotomecanica","orden","presupuesto","hoja","nombre_molde"));				
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
    //Revisión Fotomecánica
    public function revision_fotomecanica($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        {
//            exit($this->input->post("folia_se_2",true));
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $reving=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
          //  print_r($ing);
            $archivo_pro=$this->produccion_model->getFotomecanicaArchivo($id);
            if(sizeof($datos)==0){show_404();}
            if($this->input->post())
            {
                $archivo_a_borrar_cliente=$fotomecanica->archivo;
                if($this->form_validation->run("ad_cotizacion_fotomecanina"))
                {
                               if(empty($_FILES["file"]["name"]))
                                    {
                                            if(sizeof($ing->archivo) > 0)
                                            {
                                                    $file_name=$ing->archivo;	
                                            }else{
                                                    $file_name="";	
                                            }
                                    }else
                                    {
                                        $error=NULL;
                                       //valido la foto
                                        $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                                        $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                                       // $config['max_size'] = '10240'; //550 x 138
                                        $config['max_size'] = '40960'; //550 x 138
                                        $config['encrypt_name'] = true; 
                                        $this->load->library('upload', $config);
                                        if ( ! $this->upload->do_upload('file'))
                                            {
                                                $this->session->set_flashdata('ControllerMessage', 'Error de archivo de Fotomecánica no puede tener un tamaño mayor a 1 Megabyte (MB).');
                                                $this->session->set_flashdata('css',"danger");                                   
                                                redirect(base_url().'cotizaciones/revision_fotomecanica/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);                                            
                                                $error = array('error' => $this->upload->display_errors());
                                                $this->session->set_flashdata('mensaje', $error["error"]);
                                                $this->session->set_flashdata('css',"danger");
                                                redirect(base_url().'cotizaciones/revision_fotomecanica/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);

                                            }
                                          $ima = $this->upload->data();
                                          $file_name = $ima['file_name'];
                                          unlink('./'.$this->config->item('direccion_pdf').$archivo_a_borrar_cliente);
                                      }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
                               }
                                 switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista ( Micro/Micro )";
                                    break;
                                    case '6':
                                        $datos_tecnicos="Otro";
                                    break;
                                    case '7':
                                        $datos_tecnicos="Se solicita proposición";
                                    break;
                                    case '9':
                                        $datos_tecnicos="Onda a la Vista (Corrugado/Corrugado)";
                                    break;
                                    case '10':
                                        $datos_tecnicos="Onda a la Vista (MicroCorrugado/MicroCorrugado)";
                                    break;
                                    case '11':
                                        $datos_tecnicos="Indefinido";
                                    break;                                 
                               }
//                               if($this->input->post('estado',true)==1)
//                               {
                                  $quien=$this->session->userdata('id');
                                  $cuando=date("Y-m-d");
//                               }else
//                               {
//                                  $quien=0;
//                                  $cuando="0000-00-00"; 
//                               }
                               
                               
			       //Verificar tipo de molde seleccionado
                               $estanlosmoldes = 'NO';
                               $hacer_troquel="";
                               $lleva_troquelado="";                                 
                               if($this->input->post("select_estan_los_moldes",true)=='NO LLEVA')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO LLEVA';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="NO";                                      
                               }
							   
                               if($this->input->post("select_estan_los_moldes",true)=='CLIENTE LO APORTA')
                               {
                                    $numeroMolde = 2;
                                    $estanlosmoldes = 'CLIENTE LO APORTA';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                     
                                }
						   
                               if($this->input->post("select_estan_los_moldes",true)=='NO')
                               {
                                    $numeroMolde = 1;
                                    $estanlosmoldes = 'NO';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="NO";                                      
				}
//                                echo $this->input->post("select_estan_los_moldes",true)."holaaa";
								
                               if (($this->input->post("select_estan_los_moldes",true)=='MOLDE GENERICO') and ($this->input->post("select_estan_los_moldes_genericos",true)=='SI'))
                               {
//                                   exit('paso1');
                                    $numeroMolde = $this->input->post("molde_generico",true);
                                    $estanlosmoldes = 'MOLDE GENERICO';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                    
                                }
                                elseif (($this->input->post("select_estan_los_moldes",true)=='MOLDE REGISTRADOS DEL CLIENTE') and ($this->input->post("select_estan_los_moldes_no_genericos_clientes",true)=='SI'))
                                {
//                                   exit('paso2');                                    
                                    $numeroMolde = $this->input->post("molde_registrado",true);
                                    $estanlosmoldes = 'MOLDE REGISTRADOS DEL CLIENTE';
                                    $hacer_troquel="NO";
                                    $lleva_troquelado="SI";                                    
                                }       
//                                exit($numeroMolde.'---'.$estanlosmoldes);                                
                               
//                               exit($this->input->post("folia_se",true).'hola');
							   
                                $matnombre1 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_1",true));
                                $matnombre2 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_2",true));
                                $matnombre3 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_3",true));
							   
                               $data=array
                                    (
                                        "id_usuario"=>$this->session->userdata('id'),
                                        "id_cotizacion"=>$this->input->post('id',true),
                                        "producto"=>$this->input->post('producto',true),
                                        "condicion_del_producto"=>$condicion,
                                        "estan_las_peliculas"=>$this->input->post("estan_las_peliculas",true),
                                        "estan_los_moldes"=>$estanlosmoldes,
                                        "numero_molde"=>$numeroMolde,
                                        "colores"=>$this->input->post("colores",true),
                                        "colores_metalicos"=>$this->input->post("colores_metalicos",true),
                                        "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                        "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                        "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                        "acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                        "acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                        "acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
//                                        "reserva_barniz"=>$this->input->post("reserva_barniz",true),
  //                                      "lleva_barniz"=>$this->input->post("lleva_barniz",true),
                                        "tamano_caja_corrugado"=>$this->input->post("tamano_caja_corrugado",true),
                                        "comentarios"=>$this->input->post("obs",true),
                                        "fecha"=>date("Y-m-d"),
                                        "desctec"=>$this->input->post("desctec",true),
                                        //"archivo"=>$file_name,
                                        "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                        "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                        "materialidad_1"=>$matnombre1->nombre,
                                        "materialidad_2"=>$matnombre2->nombre,
                                        "materialidad_3"=>$matnombre3->nombre,
                                        "materialidad_4"=>$this->input->post("materialidad_4",true),
                                        "estado"=>$this->input->post("estado",true),
					"procesos_especiales_folia"=>$this->input->post("folia",true),
                                        "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                        "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                        "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                        "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                        "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                        "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                        "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                        "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                        "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                        "quien"=>$quien,
                                        "cuando"=>$cuando,
                                        "glosa"=>$this->input->post("glosa",true),
                                        "impresion"=>$this->input->post("impresion",true),
                                        "lleva_fondo_negro"=>$this->input->post("lleva_fondo_negro",true),
                                        "troquel_por_atras"=>$this->input->post("troquel_por_atras",true),
                                        "hacer_troquel"=>$hacer_troquel,
                                        "lleva_troquelado"=>$lleva_troquelado,
                                        "fondo_otro_color"=>$this->input->post('fondo_otro_color',true),
                                        "guardar_con_comentarios"=>$this->input->post('guardar_con_comentarios',true),
                                        "input_variable_externo_1"=>$this->input->post('input_variable_externo_1',true),
                                        "input_variable_externo_2"=>$this->input->post('input_variable_externo_2',true),
                                        "input_variable_externo_3"=>$this->input->post('input_variable_externo_3',true),                                   
                                        "input_variable_externo_4"=>$this->input->post('input_variable_externo_4',true),
                                        "input_variable_externo_5"=>$this->input->post('input_variable_externo_5',true),
                                        "input_variable_externo_6"=>$this->input->post('input_variable_externo_6',true),   
                                        "folia1_proceso_seletec"=>$this->input->post('folia1_proceso_seletec',true),
                                        "folia2_proceso_seletec"=>$this->input->post('folia2_proceso_seletec',true),
                                        "folia3_proceso_seletec"=>$this->input->post('folia3_proceso_seletec',true),                                   
                                        "cuno1_proceso_seletec"=>$this->input->post('cuno1_proceso_seletec',true),
                                        "cuno2_proceso_seletec"=>$this->input->post('cuno2_proceso_seletec',true),
                                        "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                        "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
                                        "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),                                   
                                        "detalle_piezas_adicionales"=>$this->input->post("detalle_piezas_adicionales",true),
                                        "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),                                                                      
                                        "tiene_color_modificado"=>$this->input->post("tiene_color_modificado",true),                                                                      
                                        "numero_color_modificado"=>$this->input->post("numero_color_modificado",true),                                                                      
                                        "fot_lleva_barniz"=>$this->input->post("fot_lleva_barniz",true),                                            
                                       "fot_reserva_barniz"=>$this->input->post("fot_reserva_barniz",true),                                            
                                       "fot_cala_caucho"=>$this->input->post("fot_cala_caucho",true),                                            
                                       "hay_que_troquelar"=>$this->input->post("hay_que_troquelar",true),                                            
                                       "conteo"=>$this->input->post("conteo",true),                                            
                                       "conteo2"=>$this->input->post("conteo2",true),
                                       "folia1_molde_selected"=>$this->input->post("folia1_molde_selected",true),                             
                                        "folia2_molde_selected"=>$this->input->post("folia2_molde_selected",true),                             
                                        "folia3_molde_selected"=>$this->input->post("folia3_molde_selected",true),                             
                                        "cuno1_molde_selected"=>$this->input->post("cuno1_molde_selected",true),                             
                                        "cuno2_molde_selected"=>$this->input->post("cuno2_molde_selected",true),
                                        "id_mat_placa1"=>$this->input->post("materialidad_1",true),
                                        "id_mat_onda2"=>$this->input->post("materialidad_2",true),
                                        "id_mat_liner3"=>$this->input->post("materialidad_3",true),
                                        "id_mat_liner3"=>$this->input->post("materialidad_3",true),
                                        "tamano_pliego"=>$this->input->post("tamano_pliego",true),
                                   );
									
				$data2=array
                                    (
                                         "producto"=>$this->input->post('producto',true),
                                    );
                                
                                //guardar auditoria materialidad
                                    
                                        $auditoria_materialidad=$this->auditorias_model->getAuditoriasPorIdCotizacion($this->input->post('id',true));
                                            
                                        if(sizeof($auditoria_materialidad)>0){
                                            $materialidad_anterior_1=$auditoria_materialidad->materialidad_nueva_1;
                                            $materialidad_anterior_2=$auditoria_materialidad->materialidad_nueva_2;
                                            $materialidad_anterior_3=$auditoria_materialidad->materialidad_nueva_3;
                                        }else{
                                            $materialidad_anterior_1=$materialidad_1;
                                            $materialidad_anterior_2=$materialidad_2;
                                            $materialidad_anterior_3=$materialidad_3;
                                        }
                                        $dataAuditoria=array(
                                            "id_cotizacion"=>$this->input->post('id',true),
                                            "id_procedencia_cambio"=>'4',
                                            "materialidad_anterior_1"=>$materialidad_anterior_1,
                                            "materialidad_anterior_2"=>$materialidad_anterior_2,
                                            "materialidad_anterior_3"=>$materialidad_anterior_3,
                                            "materialidad_nueva_1"=>$this->input->post("materialidad_1",true),
                                            "materialidad_nueva_2"=>$this->input->post("materialidad_2",true),
                                            "materialidad_nueva_3"=>$this->input->post("materialidad_3",true),
                                            "descripcion_procedencia_cambio"=>'revision_fotomecanica',
                                            "id_usuario"=>$this->session->userdata('id'),
                                        );
                                        
                                     //   $this->auditorias_model->insertarAuditoria($dataAuditoria);
                                        
                                    //fin de guardar auditoria materialidad
				           
//                                exit(print_r($data));
				if(sizeof($fotomecanica)==0)
                                    {
					//Esto es: cotizacion_fotomecanica
                                        $guardar=$this->cotizaciones_model->insertarFotomecanica($data);
					$this->db->where('id_cotizacion', $this->input->post('id',true));
                                        $this->db->update("cotizacion_ingenieria",$data2);
                                        if($this->input->post("estado",true)==2)
                                        {
                                           $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                           $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                                           $config['mailtype'] = 'html';
                                           $this->email->initialize($config);
                                           $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                           //$this->email->to($vendedor->correo); 
                                           $this->email->to(array($vendedor->correo, 'contactos_ingenieria@grauindus.cl'));
                                           $this->email->bcc('respaldocorreos@grauindus.cl');
                                           $this->email->subject('Mensaje de Cartonajes Grau');
                                           $html='<h2>Revisión Fotomecanica:</h2>';
                                           $html.='La cotización N°'.$this->input->post('id',true).' ha sido rechazada, con la glosa:<br/>'.$this->input->post("glosa",true).'<br><br> Rechazado Por: '.$user->nombre;
                                           $this->email->message($html);   
                                           $this->email->send();
                                        }
										
										
                                       if($this->input->post("estado",true)==1)
                                       {
                                           $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                           $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                                           $config['mailtype'] = 'html';
                                           $this->email->initialize($config);
                                           $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                           $this->email->to(array($vendedor->correo, 'contactos_ingenieria@grauindus.cl'));
                                           $this->email->bcc('respaldocorreos@grauindus.cl');
                                           $this->email->subject('Mensaje de Cartonajes Grau');
                                           $html='<h2>Revisión Fotomecanica:</h2>';
                                           $html.='La cotización N°'.$this->input->post('id',true).' ha sido Liberado, con la glosa:<br/>'.$this->input->post("glosa",true).'<br><br> Liberado Por: '.$user->nombre;
                                           $this->email->message($html);   
                                           $this->email->send();
                                        }
										
										
										
                                    }else
                                    {
					//Esto es: cotizacion_fotomecanica
                                        $this->db->where('id_cotizacion', $this->input->post('id',true));
                                        $this->db->update("cotizacion_fotomecanica",$data);
                                        
					$this->db->where('id_cotizacion', $this->input->post('id',true));
                                        $this->db->update("cotizacion_ingenieria",$data2);
										
                                         if($this->input->post("estado",true)==2)
                                       {
                                           $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                           $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                                           $config['mailtype'] = 'html';
                                           $this->email->initialize($config);
                                           $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                           //$this->email->to($vendedor->correo); 
                                           $this->email->to(array($vendedor->correo, 'contactos_ingenieria@grauindus.cl'));
                                           $this->email->bcc('respaldocorreos@grauindus.cl');
                                           $this->email->subject('Mensaje de Cartonajes Grau');
                                           $html='<h2>Revisión Fotomecanica:</h2>';
                                           $html.='La cotización N°'.$this->input->post('id',true).' ha sido rechazada, con la glosa:<br/>'.$this->input->post("glosa",true).'<br><br> Rechazado Por: '.$user->nombre;
                                           $this->email->message($html);   
                    
                                        $this->email->send(); 
                                       }
									   
                                       if($this->input->post("estado",true)==1)
                                       {
                                           $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
					   $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                                           $config['mailtype'] = 'html';
                                           $this->email->initialize($config);
                                           $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                           //$this->email->to($vendedor->correo); 
                                           $this->email->to(array($vendedor->correo, 'contactos_ingenieria@grauindus.cl'));
                                           $this->email->bcc('respaldocorreos@grauindus.cl');
                                           $this->email->subject('Mensaje de Cartonajes Grau');
                                           $html='<h2>Revisión Fotomecanica:</h2>';
                                           $html.='La cotización N°'.$this->input->post('id',true).' ha sido Liberado, con la glosa:<br/>'.$this->input->post("glosa",true).'<br><br> Liberado Por: '.$user->nombre;
                                           $this->email->message($html);   
                                           $this->email->send();
                                        }
									   
                                    }
                                    $matnombre1 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_1",true));
                                    $matnombre2 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_2",true));
                                    $matnombre3 = $this->materiales_model->getMaterialesNombrePorId($this->input->post("materialidad_3",true));
                                    // actualizo  en cotizacion
                                    $data_cotizacion=array
                                    (
                                       // moldes 
                                       "estan_los_moldes"=>$estanlosmoldes,
                                       "numero_molde"=>$numeroMolde,
                                       // materialidad
                                       "materialidad_datos_tecnicos"=>$datos_tecnicos,
//                                       "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                       "materialidad_1"=>$matnombre1->nombre,
                                       "materialidad_2"=>$matnombre2->nombre,
                                       "materialidad_3"=>$matnombre3->nombre,
                                       "materialidad_4"=>$this->input->post("materialidad_4",true),
                                       // Trabajos internos
                                       "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                       "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                       "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                       // Trabajos Externos
                                       "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                       "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                       "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true), 
                                       // procesos especiales
                                       "procesos_especiales_folia"=>$this->input->post("folia",true),
                                       "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                       "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                       "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                       "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                       "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                       "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                       "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                       "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                       "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                       "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                       "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
                                       "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),                                     
                                       "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),    
                                        "hay_que_troquelar"=>$this->input->post("hay_que_troquelar",true), 
                                        "estado"=>$this->input->post("estado",true),
                                        "id_mat_placa1"=>$this->input->post("materialidad_1",true),
                                        "id_mat_onda2"=>$this->input->post("materialidad_2",true),
                                        "id_mat_liner3"=>$this->input->post("materialidad_3",true),
                                    );
                                    $this->db->where('id', $this->input->post('id',true));
                                    $this->db->update("cotizaciones",$data_cotizacion);    
                                    
                                    // actualizo los moldes en revision ingenieria
                                    $data_cotizacion_revision=array
                                    (
                                        // moldes
                                       "estan_los_moldes"=>$estanlosmoldes,
                                       "numero_molde"=>$numeroMolde,
                                        // materialidad
//                                       "materialidad_datos_tecnicos"=>$datos_tecnicos,
//                                       "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
//                                       "materialidad_1"=>$this->input->post("materialidad_1",true),
//                                       "materialidad_2"=>$this->input->post("materialidad_2",true),
//                                       "materialidad_3"=>$this->input->post("materialidad_3",true),
//                                       "materialidad_4"=>$this->input->post("materialidad_4",true),   
                                       // procesos especiales
                                       "procesos_especiales_folia"=>$this->input->post("folia",true),
                                       "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                       "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                       "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                       "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                       "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                       "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                       "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                       "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                       "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),                                        
                                       "hacer_troquel"=>$hacer_troquel,
                                       "lleva_troquelado"=>$lleva_troquelado,   
                                       // Trabajos internos
                                       "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                       "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                       "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                       // Trabajos Externos
                                       "acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                       "acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                       "acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),                                        
                                       "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                       "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
                                       "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),                                        
                                       "detalle_piezas_adicionales"=>$this->input->post("detalle_piezas_adicionales",true),
                                       "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),                                            
                                       "tiene_color_modificado"=>$this->input->post("tiene_color_modificado",true),                                                                      
                                        "numero_color_modificado"=>$this->input->post("numero_color_modificado",true),  
                                       "colores"=>$this->input->post("colores",true),
                                        "hay_que_troquelar"=>$this->input->post("hay_que_troquelar",true),                                            
                                    );
                                   // print_r($data_cotizacion_revision);
                                   //exit();
                                    $this->db->where('id_cotizacion', $this->input->post('id',true));
                                    $this->db->update("cotizacion_ingenieria",$data_cotizacion_revision);                                    
                                   $this->session->set_flashdata('ControllerMessage', 'Se ha Guardado el registro exitosamente.');
                                   redirect(base_url().'cotizaciones/revision_fotomecanica/'.$this->input->post("id",true).'/'.$this->input->post("pagina",true),  301); 
//                                   redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301);
                }
            }
             $this->layout->css
            (
                array
                (
                 
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );   
            $this->layout->js
            (
                array
                (
                   
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js"
                )
            );   
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo"); 
            $this->layout->view('revision_fotomecanica',compact("datos","id","pagina","ing","fotomecanica","internos","externos","hoja","reving","archivo_pro"));
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
     public function presupuesto($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        {
             if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            if(sizeof($datos)==0){show_404();}
            $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
             if($this->input->post())
            {
                if($this->form_validation->run("ad_cotizacion_presupuesto"))
                {
                                if(sizeof($presupuesto)==0)
                                {
                                     $data=array
                                    (
                                        "id_usuario"=>$this->session->userdata('id'),
                                        "id_cotizacion"=>$this->input->post('id',true),
                                        "costo_pegado"=>$this->input->post('costo_pegado',true),
                                        "margen"=>$this->input->post('margen',true),
                                        "costos_adicionales"=>$this->input->post('costos_adicionales',true),
                                        "valor_costos_adicionales"=>$this->input->post('valor_costos_adicionales',true),
                                        "costos_adicionales2"=>$this->input->post('costos_adicionales2',true),
                                        "valor_costos_adicionales2"=>$this->input->post('valor_costos_adicionales2',true),
                                        "comentarios"=>$this->input->post('comentarios',true),
                                        "se_considera_repeticion_sin_costo"=>$this->input->post('se_considera_repeticion_sin_costo',true),
                                        "fecha"=>date("Y-m-d"),
                                        "identificacion_de_trabajo"=>$this->input->post("identificacion_de_trabajo",true)
                                    );
                                    $guardar=$this->cotizaciones_model->insertarCotizacionPrespuesto($data);
                                     $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
        					           redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301);
                                }else
                                {
                                     $data=array
                                    (
                                        "id_usuario"=>$this->session->userdata('id'),
                                        "id_cotizacion"=>$this->input->post('id',true),
                                        "costo_pegado"=>$this->input->post('costo_pegado',true),
                                        "margen"=>$this->input->post('margen',true),
                                        "costos_adicionales"=>$this->input->post('costos_adicionales',true),
                                        "valor_costos_adicionales"=>$this->input->post('valor_costos_adicionales',true),
                                        "costos_adicionales2"=>$this->input->post('costos_adicionales2',true),
                                        "valor_costos_adicionales2"=>$this->input->post('valor_costos_adicionales2',true),
                                        "comentarios"=>$this->input->post('comentarios',true),
                                        "se_considera_repeticion_sin_costo"=>$this->input->post('se_considera_repeticion_sin_costo',true),
                                        "fecha"=>date("Y-m-d")
                                    );
                                    $guardar=$this->cotizaciones_model->updateCotizacionPrespuesto($data,$this->input->post("id",true));
                                     $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
        					           redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301);
                                }
                                
                }
            }    
            $this->layout->js
            (
                array
                (
                   
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js"
                )
            );    
            
            $this->layout->view('presupuesto',compact("datos","id","pagina","presupuesto"));
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
      public function impresion_presupuesto($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $impresionPresupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run("ad_impresion_presupuesto"))
                {
                    
                    if(sizeof($impresionPresupuesto)==0)
                    {
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post('id',true),
                            "precio_final"=>$this->input->post("precio_real",true),
                            "dias_entrega"=>$this->input->post("dias_entrega",true),
                        );
                        $guardar=$this->cotizaciones_model->insertarImpresionPresupuesto($data);
                    }else
                    {
                        $data=array
                        (
                            "precio_final"=>$this->input->post("precio_real",true),
                            "dias_entrega"=>$this->input->post("dias_entrega",true),
                        );
                        $guardar=$this->cotizaciones_model->updateImpresionPresupuesto($data,$this->input->post("id",true));
                    }
                    
                    $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
	                redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301); 
                }
            }
            $this->layout->js
            (
                array
                (
                   
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js"
                )
            );    
            $this->layout->view('impresion_presupuesto',compact("tipos","vendedores","id","pagina","impresionPresupuesto","datos"));
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    /**
     * archivo cliente
     * */
      public function archivo_cliente($id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
         if(!$id){show_404();}
         $datos=$this->cotizaciones_model->getCotizacionPorId($id);
         $cliente=$this->clientes_model->getClientePorId($datos->id_cliente);
         if(sizeof($datos)==0){show_404();}
         if($this->input->post())
         {
            if($this->form_validation->run("add_archivo_cliente_cotizacion"))
            {
                
                                   //valido la foto
                                    $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                                    $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                                    //$config['max_size'] = '10240'; //550 x 138
                                    $config['max_size'] = '40960'; //550 x 138
                                    $config['encrypt_name'] = true; 
                                     $this->load->library('upload', $config);
                                     if ( ! $this->upload->do_upload('file'))
                                        {
                                            $this->session->set_flashdata('ControllerMessage', 'Error de archivo en la Información Digital (Cliente), no puede tener un tamaño mayor a 1 Megabyte (MB).');
                                            $this->session->set_flashdata('css',"danger");                                   
                                            redirect(base_url().'cotizaciones/archivo_cliente/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);                                         
                                        }else
                                        {
                                             $ima = $this->upload->data();
                                            $file_name = $ima['file_name'];
                                            $data=array
                                            (
                                                "id_cotizacion"=>$this->input->post("id",true),
                                                "archivo"=>$file_name,
                                                "fecha"=>date("Y-m-d")
                                            );
                                            $this->db->insert("cotizacion_archivo_cliente",$data);
                                            $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
                                            redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301);
                                        }
                                        
            }
         }
         
         $this->layout->js
         (
            array
            (
                base_url()."public/backend/js/bootstrap.file-input.js",
            )
         );
         $this->layout->view("archivo_cliente",compact("pagina","id","datos","cliente"));
         }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function edit_archivo_cliente($id=null,$ide=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
         if(!$id and !$ide){show_404();}
         $datos=$this->cotizaciones_model->getCotizacionPorId($id);
         $cliente=$this->clientes_model->getClientePorId($datos->id_cliente);
         $archivo=$this->cotizaciones_model->getArchivoClientePorId($ide);
         if(sizeof($datos)==0){show_404();}
         if($this->input->post())
         {
            if($this->form_validation->run("add_archivo_cliente_cotizacion"))
            {
                
                                    unlink('./'.$this->config->item('direccion_pdf').$archivo->archivo);
                                    $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                                    $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                                    //$config['max_size'] = '10240';
                                    $config['max_size'] = '40960';
                                     $this->load->library('upload', $config);
                                     if ( ! $this->upload->do_upload('file'))
                                        {
                                            $this->session->set_flashdata('ControllerMessage', 'Error de archivo en la Información Digital (Cliente), no puede tener un tamaño mayor a 1 Megabyte (MB).');
                                            $this->session->set_flashdata('css',"danger");                                   
                                            redirect(base_url().'cotizaciones/edit_archivo_cliente/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);                                         
                                        }else
                                        {
                                             $ima = $this->upload->data();
                                            $file_name = $ima['file_name'];
                                            $data=array
                                            (
                                                "archivo"=>$file_name,
                                            );
                                            //$this->db->insert("cotizacion_archivo_cliente",$data);
                                            $this->db->where("id", $this->input->post("ide",true));
                                            $this->db->update("cotizacion_archivo_cliente",$data);
                                            $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
                                            redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301);
                                        }
                                        
            }
         }
        
            
         $this->layout->js
         (
            array
            (
                base_url()."public/backend/js/bootstrap.file-input.js",
            )
         );
         $this->layout->view("edit_archivo_cliente",compact("pagina","id","datos","cliente","ide","archivo"));
         }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
 public function rep_ajax($id=null,$pagina=null)
    {
		
		 if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            //$id=$this->input->post("valor1",true);
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            //print_r($datos);exit;
            
            $data['id'] = $id;
 
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            
   
            $this->layout->view('rep_ajax',$data); 
        }else
        {
                redirect(base_url().'usuarios/login',  301);
        }
    }
    
    public function ajax_recotizar() {
        if ($this->session->userdata('id')) {
            $id=$this->input->post("num",true);
                      
            $cantidad1=$this->input->post("valor1",true);
            $cantidad2=$this->input->post("valor2",true);
            $cantidad3=$this->input->post("valor3",true);
            $cantidad4=$this->input->post("valor4",true);
            
            $datos = $this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $maximo=$this->cotizaciones_model->obtenerMaximoId();
            $idnuevo=$maximo->id_max+1;
          
            /****************Bloqueo por falta de materialidad*******************/
            if($ing->materialidad_datos_tecnicos=="Microcorrugado" || $ing->materialidad_datos_tecnicos=="Corrugado"){
                $m1=$ing->materialidad_1;$m2=$ing->materialidad_2;$m3=$ing->materialidad_3;
                $p1=$ing->id_mat_placa1;$o2=$ing->id_mat_onda2;$l3=$ing->id_mat_liner3;

                if($p1=="" || $o2=="" || $l3==""){
                   
                    if($p1=="" || $p1==0){$p1=",Placa";}else{$p1="";}
                    if($o2=="" || $o2==0){$o2=",Onda";}else{$o2="";}
                    if($l3=="" || $l3==0){$l3=",Liner";}else{$l3="";}
                    
                    echo "No se ha creado la cotizacion, por favor verifique las materialidades para la condicion de ".$ing->materialidad_datos_tecnicos."!!!";
                    echo " Verifique (".$p1.$o2.$l3.")";
                }else{
                    /********************************************************************/
            
            //Reasignacion de id para la recotizacion;
            $datos->id = $idnuevo;
            $datos->cantidad_1 = $cantidad1;
            $datos->cantidad_2 = $cantidad2;
            $datos->cantidad_3 = $cantidad3;
            $datos->cantidad_4 = $cantidad4;
            
            unset($ing->id);
            $ing->id_cotizacion = $idnuevo;
            unset($fotomecanica->id);
            $fotomecanica->id_cotizacion = $idnuevo;
            unset($hoja->id);
            $hoja->id_cotizacion = $idnuevo;
            $hoja->valor_empresa = "";
            $hoja->valor_empresa_2 = "";
            $hoja->valor_empresa_3 = "";
            $hoja->valor_empresa_4 = "";
            $hoja->codigo_duplicado = "";
            $hoja->impreso = "";
            
            
            //Creacion de registros en cotizacion;
            $guardar=$this->cotizaciones_model->insertar($datos);
            //Creacion de registros en ingenieria;
            $this->cotizaciones_model->insertarIngenieria($ing);
            //Creacion de registros en fotomecanica;
            $this->cotizaciones_model->insertarFotomecanica($fotomecanica);
            //Creacion de registros en hoja de costos;
            $this->db->insert("hoja_de_costos_datos",$hoja);
                       
            echo "Se ha creado la cotizacion ". $idnuevo." con exito!!!";
                }
             
            }else{
                if($ing->materialidad_datos_tecnicos=="Cartulina-cartulina"){
                $m1=$ing->materialidad_1;$m2=$ing->materialidad_2;$m3=$ing->materialidad_3;
                $p1=$ing->id_mat_placa1;$o2=$ing->id_mat_onda2;$l3=$ing->id_mat_liner3;

                if($p1=="" || $o2==""){
                   
                    if($p1=="" || $p1==0){$p1=",Placa";}else{$p1="";}
                    if($o2=="" || $o2==0){$o2=",Onda";}else{$o2="";}
                    
                    
                    echo "No se ha creado la cotizacion, por favor verifique las materialidades para la condicion de ".$ing->materialidad_datos_tecnicos."!!!";
                    echo " Verifique (".$p1.$o2.")";
                }else{
                    /********************************************************************/
            
            //Reasignacion de id para la recotizacion;
            $datos->id = $idnuevo;
            $datos->cantidad_1 = $cantidad1;
            $datos->cantidad_2 = $cantidad2;
            $datos->cantidad_3 = $cantidad3;
            $datos->cantidad_4 = $cantidad4;
            
            unset($ing->id);
            $ing->id_cotizacion = $idnuevo;
            unset($fotomecanica->id);
            $fotomecanica->id_cotizacion = $idnuevo;
            unset($hoja->id);
            $hoja->id_cotizacion = $idnuevo;
            $hoja->valor_empresa = "";
            $hoja->valor_empresa_2 = "";
            $hoja->valor_empresa_3 = "";
            $hoja->valor_empresa_4 = "";
            $hoja->codigo_duplicado = "";
            $hoja->impreso = "";
            
            
            //Creacion de registros en cotizacion;
            $guardar=$this->cotizaciones_model->insertar($datos);
            //Creacion de registros en ingenieria;
            $this->cotizaciones_model->insertarIngenieria($ing);
            //Creacion de registros en fotomecanica;
            $this->cotizaciones_model->insertarFotomecanica($fotomecanica);
            //Creacion de registros en hoja de costos;
            $this->db->insert("hoja_de_costos_datos",$hoja);
                       
            echo "Se ha creado la cotizacion ". $idnuevo." con exito!!!";
                }
                }
            }
            

        } 
    }

    public function buscar2_respuesta2SinCambio($id=null,$pagina=null)
    {
          if($this->session->userdata('id'))
        {

            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
//             exit(print_r($datos));              
            if(sizeof($datos)==0)
            {
                   $vacio="SI";
                   $this->load->library('javascript');
                   $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
                   $this->layout->setLayout('template_ajax');
                   $this->layout->view('no_existe_prducto_generico',$vacio); 
            }
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
//             exit('hola');              
            $HC=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $produccion=$this->orden_model->getOrdenesPorCotizacion($id);
            $cliente=$this->clientes_model->getClientePorId($datos->id_cliente);
              
            
            if ( $this->input->post() )
            {
 		if ( $this->form_validation->run('ad_cotizacion') )
    		{
//                               exit($this->input->post("vendedor",true));
			       //Verificar tipo de molde seleccionado
                               $estanMoldes = 'NO';
                               if($this->input->post("estan_los_moldes",true)=='NO LLEVA')
                               {
                                    $estanMoldes = 'NO LLEVA';
                                    $numero_molde=1;
                               }
                               elseif($this->input->post("estan_los_moldes",true)=='CLIENTE LO APORTA')
                               {
                                    $estanMoldes = 'CLIENTE LO APORTA';
                                    $numero_molde=2;                                    
                               }
                               elseif($this->input->post("estan_los_moldes",true)=='NO')
                               {
                                   $estanMoldes = 'NO';
                                    $numero_molde=1;                                   
			       }
                               elseif($this->input->post("estan_los_moldes",true)=='SI')
                               {
                                    if ($this->input->post("molde",true)!='')
                                    {           
                                        $molde_guardado=$this->moldes_model->getMoldesPorId($this->input->post("molde",true));
                                        if ($molde_guardado->tipo=='Normal')
                                         $estanMoldes = 'MOLDE REGISTRADOS DEL CLIENTE';
                                        elseif ($molde_guardado->tipo=='Generico')
                                         $estanMoldes = 'MOLDE GENERICO';
                                        $numero_molde=$this->input->post("molde",true);                                        
                                    }
			       }                               
                               elseif ($this->input->post("estan_los_moldes",true)=='MOLDE GENERICO')
                               {
                                    $estanMoldes = 'MOLDE GENERICO';
                                    $numero_molde=$this->input->post("molde",true);                                       
                               }
                               elseif ($this->input->post("estan_los_moldes",true)=='MOLDE REGISTRADOS DEL CLIENTE')
                               {
                                    $estanMoldes = 'MOLDE REGISTRADOS DEL CLIENTE';
                                    $numero_molde=$this->input->post("molde",true);                                       
                               }       
                                
							
                               //die("aa ".$acepta_excedentes);
                               //if(isset($_POST["hacer_cromalin"]))
								   
                               if($datos->impresion_hacer_cromalin == 'SI')
                               {
                                 $hacer_cromalin="SI";
                               }else
                               {
                                 $hacer_cromalin="NO";
                               }
                                
                               $producto=$this->input->post("producto",true);
                               if($producto==2000)
                               {
                                  $producto=$this->input->post("producto2",true);
                               }else
                               {
                                 $producto=$producto;
                               }
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista";
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                    break;
                               }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
                               }
                               if($this->input->post("can2",true)==0)
                               {
                                 $cantidad_2=1;
                               }else
                               {
                                 $cantidad_2=$this->input->post("can2",true);
                               }
                               if($this->input->post("can3",true)==0)
                               {
                                 $cantidad_3=1;
                               }else
                               {
                                 $cantidad_3=$this->input->post("can3",true);
                               }
                               if($this->input->post("can4",true)==0)
                               {
                                 $cantidad_4=1;
                               }else
                               {
                                 $cantidad_4=$this->input->post("can4",true);
                               }
							 
							   
                               $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$datos->id_cliente,
                                    "nombre_cliente"=>'no aplica',
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>$this->input->post("can1",true),
                                    "cantidad_2"=>$this->input->post("can2",true),
                                    "cantidad_3"=>$this->input->post("can3",true),
                                    "cantidad_4"=>$this->input->post("can4",true),
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
                                    "precio_1"=>100,
                                    "precio_2"=>100,
                                    "precio_3"=>100,
                                    "precio_4"=>100,
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
				    "materialidad_1"=>$fotomecanica->materialidad_1,
                                    "materialidad_2"=>$fotomecanica->materialidad_2,
                                    "materialidad_3"=>$fotomecanica->materialidad_3,
                                    "materialidad_4"=>$fotomecanica->materialidad_4,
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$fotomecanica->acabado_impresion_1,
                                    "impresion_acabado_impresion_2"=>$fotomecanica->acabado_impresion_2,
                                    "impresion_acabado_impresion_3"=>$fotomecanica->acabado_impresion_3,
                                    "impresion_acabado_impresion_4"=>$fotomecanica->acabado_impresion_4,
                                    "impresion_acabado_impresion_5"=>$fotomecanica->acabado_impresion_5,
                                    "impresion_acabado_impresion_6"=>$fotomecanica->acabado_impresion_6,
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "cantidad_especifica_sino"=>$this->input->post("cantidad_especifica_sino",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$this->input->post("cliente_entrega",true),
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>"1",
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
				    "id_antiguo"=>$this->input->post("id_antiguo",true),
                                    "detalle_cambios"=>$this->input->post("detalle_cambios",true),
				    "detalle_de_muestra"=>$this->input->post("detalle_de_muestra",true),
                                    "estan_los_moldes"=>$estanMoldes,
                                    "numero_molde"=>$numero_molde,
									
                                 );
                                    $guardar=$this->cotizaciones_model->insertar($data);
                                    //creo fotomecanica
                                    $dataFotomecanica=array
                                    (
                                        "id_usuario"=>$this->session->userdata('id'),
                                        "id_cotizacion"=>$guardar,
                                        //"id_cotizacion"=>$this->input->post("id",true),
                                        "condicion_del_producto"=>$condicion,
                                        "estan_las_peliculas"=>$fotomecanica->estan_las_peliculas,
                                        "estan_los_moldes"=>$estanMoldes,
                                        "numero_molde"=>$numero_molde,
                                        "colores"=>$fotomecanica->colores,
                                        "colores_metalicos"=>$fotomecanica->colores_metalicos,
                                        "acabado_impresion_1"=>$fotomecanica->acabado_impresion_1,
                                        "acabado_impresion_2"=>$fotomecanica->acabado_impresion_2,
                                        "acabado_impresion_3"=>$fotomecanica->acabado_impresion_3,
                                        "acabado_impresion_4"=>$fotomecanica->acabado_impresion_4,
                                        "acabado_impresion_5"=>$fotomecanica->acabado_impresion_5,
                                        "acabado_impresion_6"=>$fotomecanica->acabado_impresion_6,
                                        "reserva_barniz"=>$fotomecanica->reserva_barniz,
                                        "tamano_caja_corrugado"=>$fotomecanica->tamano_caja_corrugado,
                                        "comentarios"=>$fotomecanica->comentarios,
                                        "fecha"=>date("Y-m-d"),
                                        "desctec"=>$fotomecanica->desctec,
                                        "archivo"=>$fotomecanica->archivo,
                                        "materialidad_datos_tecnicos"=>$fotomecanica->materialidad_datos_tecnicos,
                                        "materialidad_eleccion"=>$fotomecanica->materialidad_eleccion,
                                        "materialidad_1"=>$fotomecanica->materialidad_1,
                                        "materialidad_2"=>$fotomecanica->materialidad_2,
                                        "materialidad_3"=>$fotomecanica->materialidad_3,
                                        "materialidad_4"=>$fotomecanica->materialidad_4,
                                        "estado"=>"1",
					"procesos_especiales_folia"=>$fotomecanica->procesos_especiales_folia,
                                        "procesos_especiales_folia_valor"=>$fotomecanica->procesos_especiales_folia_valor,
                                        "procesos_especiales_folia_2"=>$fotomecanica->procesos_especiales_folia_2,
                                        "procesos_especiales_folia_2_valor"=>$fotomecanica->procesos_especiales_folia_2_valor,
                                        "procesos_especiales_folia_3"=>$fotomecanica->procesos_especiales_folia_3,
                                        "procesos_especiales_folia_3_valor"=>$fotomecanica->procesos_especiales_folia_3_valor,
                                        "procesos_especiales_cuno"=>$fotomecanica->procesos_especiales_cuno,
                                        "procesos_especiales_cuno_valor"=>$fotomecanica->procesos_especiales_cuno_valor,
                                        "procesos_especiales_cuno_2"=>$fotomecanica->procesos_especiales_cuno_2,
                                        "procesos_especiales_cuno_2_valor"=>$fotomecanica->procesos_especiales_cuno_2_valor,
                                        "quien"=>$fotomecanica->quien,
                                        "cuando"=>$fotomecanica->cuando,
                                        "glosa"=>$fotomecanica->glosa,
                                        "impresion"=>$fotomecanica->impresion,
					"lleva_barniz"=>$fotomecanica->lleva_barniz,
					"reserva_barniz"=>$fotomecanica->reserva_barniz,
                                        );
                                        $this->cotizaciones_model->insertarFotomecanica($dataFotomecanica);
                                    //creo ingeniería
                                    
                                         $dataIngenieria=array
                                      (
                                         "id_usuario"=>$this->session->userdata('id'),
                                         "id_cotizacion"=>$guardar,
					 //"id_cotizacion"=>$this->input->post("id",true),
                                         "producto"=>$ing->producto,
                                         "medidas_de_la_caja"=>$ing->medidas_de_la_caja,
                                         "medidas_de_la_caja_2"=>$ing->medidas_de_la_caja_2,
                                         "medidas_de_la_caja_3"=>$ing->medidas_de_la_caja_3,
                                         "medidas_de_la_caja_4"=>$ing->medidas_de_la_caja_4,
                                         "unidades_por_pliego"=>$ing->unidades_por_pliego,
                                         "hacer_troquel"=>$ing->hacer_troquel,
                                         "lleva_troquelado"=>$ing->lleva_troquelado,
                                         "piezas_totales_en_el_pliego"=>$ing->piezas_totales_en_el_pliego,
                                         "metros_de_cuchillo"=>$ing->metros_de_cuchillo,
                                         "tamano_a_imprimir_1"=>$ing->tamano_a_imprimir_1,
                                         "tamano_a_imprimir_2"=>$ing->tamano_a_imprimir_2,
                                         "tamano_cuchillo_1"=>$ing->tamano_cuchillo_1,
                                         "tamano_cuchillo_2"=>$ing->tamano_cuchillo_2,
                                         "materialidad_datos_tecnicos"=>$ing->materialidad_datos_tecnicos,
                                         "materialidad_eleccion"=>$ing->materialidad_eleccion,
                                         "materialidad_1"=>$fotomecanica->materialidad_1,
                                         "materialidad_2"=>$fotomecanica->materialidad_2,
                                         "materialidad_3"=>$fotomecanica->materialidad_3,
                                         "materialidad_4"=>$fotomecanica->materialidad_4,
                                         "piezas_adicionales"=>$ing->piezas_adicionales,
                                         "detalle_piezas_adicionales"=>$ing->detalle_piezas_adicionales,
                                         "tipo_de_pegado"=>$ing->tipo_de_pegado,
                                         "lineas_pegado"=>$ing->lineas_pegado,
                                         "detalle_lineas_pegado"=>$ing->detalle_lineas_pegado,
                                         "es_una_maquina"=>$ing->es_una_maquina,
                                         "impresion_compartida"=>$ing->impresion_compartida,
                                         "contiene_otras_cotizaciones"=>$ing->contiene_otras_cotizaciones,
                                         "numero_cotizacion"=>$ing->numero_cotizacion,
                                         "archivo"=>$ing->archivo,
                                         "fecha"=>date("Y-m-d"),
                                         "trabajos_adicionales"=>$ing->trabajos_adicionales,
                                         "trabajos_adicionales_glosa"=>$ing->trabajos_adicionales_glosa,
                                         "estado"=>"1",
                                         "estan_los_moldes"=>$estanMoldes,
                                         "numero_molde"=>$numero_molde,
                                         "id_adhesivo"=>$ing->id_adhesivo,
                                         "quien"=>$ing->quien,
                                         "cuando"=>$ing->cuando,
                                         "solo_pegado"=>$ing->solo_pegado,
                                         "tamano_pieza_a_empaquetar_ancho"=>$ing->tamano_pieza_a_empaquetar_ancho,
                                         "tamano_pieza_a_empaquetar_largo"=>$ing->tamano_pieza_a_empaquetar_largo,
                                         "glosa"=>$ing->glosa,
                                         "pegado"=>$ing->pegado,
                                         "doblado"=>$ing->doblado,
                                         "empaquetado"=>$ing->empaquetado,
                                         "tipo_pegado"=>$ing->tipo_pegado,
                                         "pegado_puntos"=>$ing->pegado_puntos,
                                         "pegado_cantidad_puntos"=>$ing->pegado_cantidad_puntos,
                                         "tipo_fondo"=>$ing->tipo_fondo,
                                         "lleva_aletas"=>$ing->lleva_aletas,
                                         "total_aplicaciones_adhesivo"=>$ing->total_aplicaciones_adhesivo,
                                      );
                                           $this->cotizaciones_model->insertarIngenieria($dataIngenieria);
										   
                                        $Hoja=array
                                        (
                                                "id_usuario"=>$this->session->userdata('id'),
                                                "id_cotizacion"=>$guardar,
                                                "valor_empresa"=>$HC->valor_empresa,
                                                "pegado"=>$HC->pegado,
                                                "costo_adicional"=>$HC->costo_adicional,
                                                "dias_de_entrega"=>$HC->dias_de_entrega,
                                                "margen"=>$HC->margen,
                                                "valor_acabado_1"=>$HC->valor_acabado_1,
                                                "valor_acabado_2"=>$HC->valor_acabado_2,
                                                "valor_acabado_3"=>$HC->valor_acabado_3,
                                                "valor_empresa_2"=>$HC->valor_acabado_2,
                                                "valor_empresa_3"=>$HC->valor_acabado_3,
                                                "valor_empresa_4"=>$HC->valor_acabado_4,
                                                "placa_kilo"=>$HC->placa_kilo,
                                                "onda_kilo"=>$HC->onda_kilo,
                                                "gramos_metro_cuadrado"=>$HC->gramos_metro_cuadrado,
                                                "total_pliegos"=>$HC->total_pliegos,
                                                "total_merma"=>$HC->total_merma,
                                                "fecha"=>'0000-00-00',
                                                "piezas_adicionales1"=>$HC->piezas_adicionales1,
                                                "piezas_adicionales2"=>$HC->piezas_adicionales2,
                                                "piezas_adicionales3"=>$HC->piezas_adicionales3,
                                                "kilos_placa"=>$HC->kilos_placa,
                                                "kilos_onda"=>$HC->kilos_onda,
                                                "kilos_liner"=>$HC->kilos_liner,

                                        );
//                                                                                        exit($Hoja);
                                           $this->cotizaciones_model->insertarHojaDeCosto($Hoja);
													 
													 
                                    //sigo
                                    $usrId=$this->session->userdata('id');
                                    $dataEstado = array("cotizaciones_id"=>$guardar,"id_estado"=>1,"fecha"=>date("Y-m-d"),"usuarios_id"=>$usrId);
                                    $this->cotizaciones_model->insertarEstadoCotizacion($dataEstado);
                                    
                                    $this->load->library('email');

                                    $this->email->from('sistemagrau@seleccionprofesional.cl', 'Cartonajes Grau');
                                    $this->email->to('ega@grauindus.cl'); 
                                    
                                    //$this->email->cc('otro@otro-ejemplo.com'); 
                                    //$this->email->bcc('ellos@su-ejemplo.com'); 
                                    $ven=$this->vendedores_model->getVendedorPorId($this->input->post("vendedor",true));
                                   // $cliente=$this->input->post("cliente",true);
                                    $cliente=$datos->id_cliente;
                                    if($cliente==3000)
                                    {
                                        $cli=$this->input->post("nombre_cliente",true);
                                    }else
                                    {
                                        $clienteBD=$this->clientes_model->getClientePorId($cliente);
                                        $cli=$clienteBD->razon_social;
                                    }
                                    $this->email->subject('Se genero Cotizacion Nro '.$guardar);
                                    $msg="Se Generó Cotización para ".$cli." (Vendedor : ".$ven->nombre.")";
                                    $msg.="\n Producto:$producto";
                                    $msg.="\n Condición del Producto:$condicion";
                                    $msg.="\n Cantidad 1:".quitarPuntosNumero($this->input->post("can1",true));
                                    $msg.="\n Cantidad 2:".quitarPuntosNumero($this->input->post("can2",true));
                                    $msg.="\n Cantidad 3:".quitarPuntosNumero($this->input->post("can3",true));
                                    $msg.="\n Cantidad 4:".quitarPuntosNumero($this->input->post("can4",true));
                                   // $msg.="\n\n para mas detalle revise el sistema en http://www.seleccionprofesional.cl/grau";
                                    //echo $msg;exit;
                                    $this->email->message($msg);	

                                    $this->email->send();
                                    
                                    
                              
                              
                                //    $checkInternos['checks'] = $this->input->post("acInternos");
                              //                                    $checks = 1;
								if($_POST['acInternos']!="")
								{
									foreach($_POST['acInternos'] as $check)
									{
										$data = array("cotizaciones_id"=>$guardar,"acabados_id_acabado"=>$check);
										$this->cotizaciones_model->insertarCotizacionesAcabados($data);
									}
								}
								
								$check = "";
									
								if($_POST['acExternos']!="")
								{
									
									foreach($_POST['acExternos'] as $check)
									{
										$data = array("cotizaciones_id"=>$guardar,"acabados_id_acabado"=>$check);
										$this->cotizaciones_model->insertarCotizacionesAcabados($data);
									}
                                }
                            // print_r(substr(implode(', ', $this->input->post('acInternos')), 0));
                                
                            if($guardar>0)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
					           redirect(base_url().'cotizaciones',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'cotizaciones/add',  301);
                            }   
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->vendedores_model->getVendedoresSelect();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            //print_r($internos);exit;
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
           $this->layout->view('buscar2_respuesta2SinCambio',compact("tipos","vendedores","acInternos","acExternos","internos","externos","pagina","datos","id","cliente","orden","fotomecanica","ing","HC","produccion"));          
    }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	 public function SinOp($id=null,$pagina=null)
    {
		
		 if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            //$id=$this->input->post("valor1",true);
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            //print_r($datos);exit;
            
            $data['id'] = $id;
 
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            
   
            $this->layout->view('SinOp',$data); 
        }else
				{
					redirect(base_url().'usuarios/login',  301);
				}
    }
	
	
	
	
	        public function validarCantidadesMargen()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
						//print_r($nombreProducto);exit;
						$this->layout->view('ajaxValidarCantidadesMargen',compact('valor1','valor2')); 
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
	        public function validarValoresMargen()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
						//print_r($nombreProducto);exit;
						$this->layout->view('ajaxValidarValoresMargen',compact('valor1','valor2','valor3')); 
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
		
	public function buscar2_respuesta2ConCambio($id=null,$pagina=null)
    {
          if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            if(sizeof($datos)==0){show_404();}
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
			$HC=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
			
			$produccion=$this->orden_model->getOrdenesPorCotizacion($id);
			
            $cliente=$this->clientes_model->getClientePorId($datos->id_cliente);
			
            if ( $this->input->post() )
 		        {
 		              if ( $this->form_validation->run('ad_cotizacion') )
    			        {
//				if ($this->input->post("molde",true)!='')
//                                {
//                                    $molde_guardado=$this->moldes_model->getMoldesPorId($this->input->post("molde",true));
//                                    exit(print_r($molde_guardado));
//                                }
                                 
                                if($this->input->post("estan_los_moldes",true) == 'SI' or $this->input->post("estan_los_moldes",true) == 'NO')
                                {
                                        $estanMoldes = 'SI';
                                }
                                if($this->input->post("estan_los_moldes",true) == 'NO LLEVA')
                                {
                                        $estanMoldes = 'NO LLEVA';
                                }
                                if($this->input->post("estan_los_moldes",true) == 'CLIENTE LO APORTA')
                                {
                                        $estanMoldes = 'CLIENTE LO APORTA';
                                }
							
							
                               //die("aa ".$acepta_excedentes);
                               if($this->input->post("hacer_cromalin",true) == true)   
                               {
                                 $hacer_cromalin="SI";
                               }else
                               {
                                 $hacer_cromalin="NO";
                               }
                                
                               $producto=$this->input->post("producto",true);
                               if($producto==2000)
                               {
                                  $producto=$this->input->post("producto2",true);
                               }else
                               {
                                 $producto=$producto;
                               }
                               switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista";
                                    break;
                                    case '6':
                                        $datos_tecnicos="otro";
                                    break;
                               }
                               $condicion=$this->input->post("condicion_del_producto",true);
                               switch($condicion)
                               {
                                    case '0':
                                        $condicion="Nuevo";
                                    break;
                                    case '1':
                                        $condicion="Repetición Sin Cambios";
                                    break;
                                    case '2':
                                        $condicion="Repetición Con Cambios";
                                    break;
                                    case '3':
                                        $condicion="Producto Genérico";
                                    break;
                               }
                               if($this->input->post("can2",true)==0)
                               {
                                 $cantidad_2=1;
                               }else
                               {
                                 $cantidad_2=$this->input->post("can2",true);
                               }
                               if($this->input->post("can3",true)==0)
                               {
                                 $cantidad_3=1;
                               }else
                               {
                                 $cantidad_3=$this->input->post("can3",true);
                               }
                               if($this->input->post("can4",true)==0)
                               {
                                 $cantidad_4=1;
                               }else
                               {
                                 $cantidad_4=$this->input->post("can4",true);
                               }
                               $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                    "id_cliente"=>$datos->id_cliente,
                                    "nombre_cliente"=>$this->input->post("nombre_cliente",true),
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$condicion,
                                    "producto"=>$producto,
                                    "cantidad_1"=>$this->input->post("can1",true),
                                    "cantidad_2"=>$this->input->post("can2",true),
                                    "cantidad_3"=>$this->input->post("can3",true),
                                    "cantidad_4"=>$this->input->post("can4",true),
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
                                    "precio_1"=>100,
                                    "precio_2"=>100,
                                    "precio_3"=>100,
                                    "precio_4"=>100,
                                    "comentario_medidas"=>$this->input->post("obs",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "materialidad_1"=>$this->input->post("materialidad_1",true),
                                    "materialidad_2"=>$this->input->post("materialidad_2",true),
                                    "materialidad_3"=>$this->input->post("materialidad_3",true),
                                    "materialidad_solicita_muestra"=>$this->input->post("solicita_muestra",true),
                                    "impresion_colores"=>$this->input->post("colores",true),
                                    "impresion_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "impresion_acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "impresion_acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "impresion_acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "impresion_acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "impresion_acabado_impresion_5"=>$this->input->post("acabado_impresion_5",true),
                                    "impresion_acabado_impresion_6"=>$this->input->post("acabado_impresion_6",true),
                                    "impresion_hacer_cromalin"=>$hacer_cromalin,
                                    "procesos_especiales_folia"=>$this->input->post("folia",true),
                                    "procesos_especiales_folia_valor"=>$this->input->post("folia_se",true),
                                    "procesos_especiales_folia_2"=>$this->input->post("folia_2",true),
                                    "procesos_especiales_folia_2_valor"=>$this->input->post("folia_se_2",true),
                                    "procesos_especiales_folia_3"=>$this->input->post("folia_3",true),
                                    "procesos_especiales_folia_3_valor"=>$this->input->post("folia_se_3",true),
                                    "procesos_especiales_cuno"=>$this->input->post("cuno",true),
                                    "procesos_especiales_cuno_valor"=>$this->input->post("cuno_se",true),
                                    "procesos_especiales_cuno_2"=>$this->input->post("cuno_2",true),
                                    "procesos_especiales_cuno_2_valor"=>$this->input->post("cuno_se_2",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "cantidad_especifica_sino"=>$this->input->post("cantidad_especifica_sino",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "tota_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>quitarPuntosNumero($this->input->post("can_despacho_1",true)),
                                    "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>quitarPuntosNumero($this->input->post("costo_comercial",true)),
                                    "cliente_entrega_1"=>$this->input->post("cliente_entrega",true),
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>"0",
                                    "fecha_de_liberacion_de_producto_ingenieria"=>date("Y-m-d"),
                                    "fecha_de_liberacion_de_producto_fotomecanica"=>date("Y-m-d"),
				    "id_antiguo"=>$this->input->post("id_antiguo",true),
                                    "detalle_cambios"=>$this->input->post("detalle_cambios",true),
				    "detalle_de_muestra"=>$this->input->post("detalle_de_muestra",true),
                                    "estan_los_moldes"=>$this->input->post("estan_los_moldes",true),
                                    "numero_molde"=>$this->input->post("molde",true),
                                 );
                               
//                                                                   "can_despacho_2"=>quitarPuntosNumero($this->input->post("can_despacho_2",true)),
//                                    "can_despacho_3"=>quitarPuntosNumero($this->input->post("can_despacho_3",true)),
                                    $guardar=$this->cotizaciones_model->insertar($data);
                                    //creo fotomecanica
                                    $dataFotomecanica=array
                                    (
                                        "id_usuario"=>$this->session->userdata('id'),
                                        "id_cotizacion"=>$guardar,
					//"id_cotizacion"=>$this->input->post("id",true),
                                        "condicion_del_producto"=>$condicion,
                                        "estan_las_peliculas"=>$fotomecanica->estan_las_peliculas,
                                        "estan_los_moldes"=>$estanMoldes,
                                        "numero_molde"=>$ing->numero_molde,
                                        "colores"=>$fotomecanica->colores,
                                        "colores_metalicos"=>$fotomecanica->colores_metalicos,
                                        "acabado_impresion_1"=>$fotomecanica->acabado_impresion_1,
                                        "acabado_impresion_2"=>$fotomecanica->acabado_impresion_2,
                                        "acabado_impresion_3"=>$fotomecanica->acabado_impresion_3,
                                        "acabado_impresion_4"=>$fotomecanica->acabado_impresion_4,
                                        "acabado_impresion_5"=>$fotomecanica->acabado_impresion_5,
                                        "acabado_impresion_6"=>$fotomecanica->acabado_impresion_6,
                                        "reserva_barniz"=>$fotomecanica->reserva_barniz,
                                        "tamano_caja_corrugado"=>$fotomecanica->tamano_caja_corrugado,
                                        "comentarios"=>$fotomecanica->comentarios,
                                        "fecha"=>date("Y-m-d"),
                                        "desctec"=>$fotomecanica->desctec,
                                        "archivo"=>$fotomecanica->archivo,
                                        "materialidad_datos_tecnicos"=>$fotomecanica->materialidad_datos_tecnicos,
                                        "materialidad_eleccion"=>$fotomecanica->materialidad_eleccion,
                                        "materialidad_1"=>$fotomecanica->materialidad_1,
                                        "materialidad_2"=>$fotomecanica->materialidad_2,
                                        "materialidad_3"=>$fotomecanica->materialidad_2,
                                        "materialidad_4"=>$fotomecanica->materialidad_2,
                                        "estado"=>"0",
					"procesos_especiales_folia"=>$fotomecanica->procesos_especiales_folia,
                                        "procesos_especiales_folia_valor"=>$fotomecanica->procesos_especiales_folia_valor,
                                        "procesos_especiales_folia_2"=>$fotomecanica->procesos_especiales_folia_2,
                                        "procesos_especiales_folia_2_valor"=>$fotomecanica->procesos_especiales_folia_2_valor,
                                        "procesos_especiales_folia_3"=>$fotomecanica->procesos_especiales_folia_3,
                                        "procesos_especiales_folia_3_valor"=>$fotomecanica->procesos_especiales_folia_3_valor,
                                        "procesos_especiales_cuno"=>$fotomecanica->procesos_especiales_cuno,
                                        "procesos_especiales_cuno_valor"=>$fotomecanica->procesos_especiales_cuno_valor,
                                        "procesos_especiales_cuno_2"=>$fotomecanica->procesos_especiales_cuno_2,
                                        "procesos_especiales_cuno_2_valor"=>$fotomecanica->procesos_especiales_cuno_2_valor,
                                        "quien"=>$fotomecanica->quien,
                                        "cuando"=>$fotomecanica->cuando,
                                        "glosa"=>$fotomecanica->glosa,
                                        "impresion"=>$fotomecanica->impresion,
                                        );
                                        $this->cotizaciones_model->insertarFotomecanica($dataFotomecanica);
                                    //creo ingeniería
                                    
                                         $dataIngenieria=array
                                      (
                                         "id_usuario"=>$this->session->userdata('id'),
                                         "id_cotizacion"=>$guardar,
										 //"id_cotizacion"=>$this->input->post("id",true),
                                         "producto"=>$producto,
                                         "medidas_de_la_caja"=>$ing->medidas_de_la_caja,
                                         "medidas_de_la_caja_2"=>$ing->medidas_de_la_caja_2,
                                         "medidas_de_la_caja_3"=>$ing->medidas_de_la_caja_3,
                                         "medidas_de_la_caja_4"=>$ing->medidas_de_la_caja_4,
                                         "unidades_por_pliego"=>$ing->unidades_por_pliego,
                                         "hacer_troquel"=>$ing->hacer_troquel,
                                         "lleva_troquelado"=>$ing->lleva_troquelado,
                                         "piezas_totales_en_el_pliego"=>$ing->piezas_totales_en_el_pliego,
                                         "metros_de_cuchillo"=>$ing->metros_de_cuchillo,
                                         "tamano_a_imprimir_1"=>$ing->tamano_a_imprimir_1,
                                         "tamano_a_imprimir_2"=>$ing->tamano_a_imprimir_2,
                                         "tamano_cuchillo_1"=>$ing->tamano_cuchillo_1,
                                         "tamano_cuchillo_2"=>$ing->tamano_cuchillo_2,
                                         "materialidad_datos_tecnicos"=>$ing->materialidad_datos_tecnicos,
                                         "materialidad_eleccion"=>$ing->materialidad_eleccion,
                                         "materialidad_1"=>$ing->materialidad_1,
                                         "materialidad_2"=>$ing->materialidad_2,
                                         "materialidad_3"=>$ing->materialidad_3,
                                         "materialidad_4"=>$ing->materialidad_4,
                                         "piezas_adicionales"=>$ing->piezas_adicionales,
										 "piezas_adicionales2"=>$ing->piezas_adicionales2,
										 "piezas_adicionales3"=>$ing->piezas_adicionales3,
                                         "detalle_piezas_adicionales"=>$ing->detalle_piezas_adicionales,
                                         "tipo_de_pegado"=>$ing->tipo_de_pegado,
                                         "lineas_pegado"=>$ing->lineas_pegado,
                                         "detalle_lineas_pegado"=>$ing->detalle_lineas_pegado,
                                         "es_una_maquina"=>$ing->es_una_maquina,
                                         "impresion_compartida"=>$ing->impresion_compartida,
                                         "contiene_otras_cotizaciones"=>$ing->contiene_otras_cotizaciones,
                                         "numero_cotizacion"=>$ing->numero_cotizacion,
                                         "archivo"=>$ing->archivo,
                                         "fecha"=>date("Y-m-d"),
                                         "trabajos_adicionales"=>$ing->trabajos_adicionales,
                                         "trabajos_adicionales_glosa"=>$ing->trabajos_adicionales_glosa,
                                         "estado"=>"0",
                                         "estan_los_moldes"=>$estanMoldes,
                                         "numero_molde"=>$ing->numero_molde,
                                         "id_adhesivo"=>$ing->id_adhesivo,
                                         "quien"=>$ing->quien,
                                         "cuando"=>$ing->cuando,
                                         "solo_pegado"=>$ing->solo_pegado,
                                         "tamano_pieza_a_empaquetar_ancho"=>$ing->tamano_pieza_a_empaquetar_ancho,
                                         "tamano_pieza_a_empaquetar_largo"=>$ing->tamano_pieza_a_empaquetar_largo,
                                         "glosa"=>$ing->glosa,
                                         "pegado"=>$ing->pegado,
                                         "doblado"=>$ing->doblado,
                                         "empaquetado"=>$ing->empaquetado,
                                         "tipo_pegado"=>$ing->tipo_pegado,
                                         "pegado_puntos"=>$ing->pegado_puntos,
                                         "pegado_cantidad_puntos"=>$ing->pegado_cantidad_puntos,
                                         "tipo_fondo"=>$ing->tipo_fondo,
                                         "lleva_aletas"=>$ing->lleva_aletas,
                                         "total_aplicaciones_adhesivo"=>$ing->total_aplicaciones_adhesivo,
										 "largo_total_de_la_caja"=>$ing->largo_total_de_la_caja,
										 "ancho_1"=>$ing->ancho_1,
                                         "ancho_2"=>$ing->ancho_2,
                                         "largo_1"=>$ing->largo_1,
                                         "largo_2"=>$ing->largo_2,
                                         "aleta_pegado"=>$ing->aleta_pegado,
										 "comentario_piezas_adicionales"=>$ing->comentario_piezas_adicionales,
                                      );
                                           $this->cotizaciones_model->insertarIngenieria($dataIngenieria);
										   
									 $Hoja=array
											(
												"id_usuario"=>$this->session->userdata('id'),
												"id_cotizacion"=>$guardar,
												"valor_empresa"=>$HC->valor_empresa,
												"pegado"=>$HC->pegado,
												"costo_adicional"=>$HC->costo_adicional,
												"dias_de_entrega"=>$HC->dias_de_entrega,
												"margen"=>$HC->margen,
												"valor_acabado_1"=>$HC->valor_acabado_1,
												"valor_acabado_2"=>$HC->valor_acabado_2,
												"valor_acabado_3"=>$HC->valor_acabado_3,
												"valor_empresa_2"=>$HC->valor_acabado_2,
												"valor_empresa_3"=>$HC->valor_acabado_3,
												"valor_empresa_4"=>$HC->valor_acabado_4,
												"placa_kilo"=>$HC->placa_kilo,
												"onda_kilo"=>$HC->onda_kilo,
												"gramos_metro_cuadrado"=>$HC->gramos_metro_cuadrado,
												"total_pliegos"=>$HC->total_pliegos,
												"total_merma"=>$HC->total_merma,
												"fecha"=>'0000-00-00',
												"piezas_adicionales1"=>$HC->piezas_adicionales1,
												"piezas_adicionales2"=>$HC->piezas_adicionales2,
												"piezas_adicionales3"=>$HC->piezas_adicionales3,
												"kilos_placa"=>$HC->kilos_placa,
												"kilos_onda"=>$HC->kilos_onda,
												"kilos_liner"=>$HC->kilos_liner,
											);
//											exit($Hoja);

                                           $this->cotizaciones_model->insertarHojaDeCosto($Hoja);
													 
													 
                                    //sigo
                                    $usrId=$this->session->userdata('id');
                                    $dataEstado = array("cotizaciones_id"=>$guardar,"id_estado"=>1,"fecha"=>date("Y-m-d"),"usuarios_id"=>$usrId);
                                    $this->cotizaciones_model->insertarEstadoCotizacion($dataEstado);
                                    
                                    $this->load->library('email');

                                    $this->email->from('sistemagrau@seleccionprofesional.cl', 'Cartonajes Grau');
                                    $this->email->to('ega@grauindus.cl'); 
                                    
                                    //$this->email->cc('otro@otro-ejemplo.com'); 
                                    //$this->email->bcc('ellos@su-ejemplo.com'); 
                                    $ven=$this->vendedores_model->getVendedorPorId($this->input->post("vendedor",true));
                                    $cliente=$datos->id_cliente;
                                    if($cliente==3000)
                                    {
                                        $cli=$this->input->post("nombre_cliente",true);
                                    }else
                                    {
                                        $clienteBD=$this->clientes_model->getClientePorId($cliente);
                                        $cli=$clienteBD->razon_social;
                                    }
                                    $this->email->subject('Se genero Cotizacion Nro '.$guardar);
                                    $msg="Se Generó Cotización para ".$cli." (Vendedor : ".$ven->nombre.")";
                                    $msg.="\n Producto:$producto";
                                    $msg.="\n Condición del Producto:$condicion";
                                    $msg.="\n Cantidad 1:".quitarPuntosNumero($this->input->post("can1",true));
                                    $msg.="\n Cantidad 2:".quitarPuntosNumero($this->input->post("can2",true));
                                    $msg.="\n Cantidad 3:".quitarPuntosNumero($this->input->post("can3",true));
                                    $msg.="\n Cantidad 4:".quitarPuntosNumero($this->input->post("can4",true));
                                   // $msg.="\n\n para mas detalle revise el sistema en http://www.seleccionprofesional.cl/grau";
                                    //echo $msg;exit;
                                    $this->email->message($msg);	

                                    $this->email->send();
                                    
                                    
                              
                              
                                //    $checkInternos['checks'] = $this->input->post("acInternos");
                              //                                    $checks = 1;
								if($_POST['acInternos']!="")
								{
									foreach($_POST['acInternos'] as $check)
									{
										$data = array("cotizaciones_id"=>$guardar,"acabados_id_acabado"=>$check);
										$this->cotizaciones_model->insertarCotizacionesAcabados($data);
									}
								}
								
								$check = "";
									
								if($_POST['acExternos']!="")
								{
									
									foreach($_POST['acExternos'] as $check)
									{
										$data = array("cotizaciones_id"=>$guardar,"acabados_id_acabado"=>$check);
										$this->cotizaciones_model->insertarCotizacionesAcabados($data);
									}
                                }
                            // print_r(substr(implode(', ', $this->input->post('acInternos')), 0));
                                
                            if($guardar>0)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
					           redirect(base_url().'cotizaciones',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'cotizaciones/add',  301);
                            }   
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->vendedores_model->getVendedoresSelect();
            $acInternos= $this->acabados_model->getAcabadosInternos();
            $acExternos= $this->acabados_model->getAcabadosExternos();
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            //print_r($internos);exit;
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
           $this->layout->view('buscar2_respuesta2ConCambio',compact("tipos","vendedores","acInternos","acExternos","internos","externos","pagina","datos","id","cliente","orden","fotomecanica","ing","HC","produccion"));          
    }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }	
	
	 public function revision_ingenieriaConCambio($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            if(sizeof($datos)==0){show_404();}
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            if($this->input->post())
            {
                $condicion=$datos->condicion_del_producto;
                if($condicion=="Nuevo")
                {
                    $valida="ad_cotizacion_ingenieria2";
                }else
                {
                    $valida="ad_cotizacion_ingenieria";
                }
                if($this->form_validation->run($valida))
                {
                         if(empty($_FILES["file"]["name"]))
                                    {
                                       	if(sizeof($ing->archivo) > 0)
										{
											$file_name=$ing->archivo;	
										}else{
											$file_name="";	
										}

                                    }else
                                    {
                                    $error=NULL;
                                   //valido la foto
                                    $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                                    $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                                    $config['max_size'] = '40960';
                                    $config['encrypt_name'] = true; 
                                     $this->load->library('upload', $config);
                                     if ( ! $this->upload->do_upload('file'))
                                        {
                                            $this->session->set_flashdata('ControllerMessage', 'Error de archivo en la Información Digital (Cliente), no puede tener un tamaño mayor a 1 Megabyte (MB).');
                                            $this->session->set_flashdata('css',"danger");                                   
                                            redirect(base_url().'cotizaciones/revision_ingenieria/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);                                         
                                            $error = array('error' => $this->upload->display_errors());
                                        }
                                        
                                            $ima = $this->upload->data();
                                            $file_name = $ima['file_name'];
                                      } 
                                      
                                       switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista ( Micro/Micro )";
                                    break;
                                    case '6':
                                        $datos_tecnicos="Otro";
                                    break;
                                    case '7':
                                        $datos_tecnicos="Se solicita proposición";
                                    break;
                                    
                               }
                               if($this->input->post('estado',true)==1)
                               {
                                  $quien=$this->session->userdata('id');
                                  $cuando=date("Y-m-d");
                               }else
                               {
                                  $quien=0;
                                  $cuando="0000-00-00"; 
                               }
                               /*
                               if($this->input->post('hacer_troquel',true)=='SI' and $this->input->post("estan_los_moldes",true)!='SI')
                               {
                                    $array=array
                                  (
                                    "nombre"=>$this->input->post("molde_nombre",true),
                                    "tipo"=>"Genérico",
                                  );
                                  $id_molde=$this->moldes_model->insertar($array);
                                  $array2=array
                                  (
                                    "numero"=>$id_molde,
                                    
                                  );
                                  $this->db->where('id', $id_molde);
                                  $this->db->update("moldes_grau",$array2);              
                               }else
                               {
                                $id_molde=0;
                               }
                               */
                                      $suma_largo_aleta=$this->input->post("ancho_1",true)+$this->input->post("ancho_2",true)+$this->input->post("largo_1",true)+$this->input->post("largo_2",true)+$this->input->post("aleta_pegado",true);
                                      $data=array
                                      (
                                         "id_usuario"=>$this->session->userdata('id'),
                                         "id_cotizacion"=>$this->input->post('id',true),
                                         "producto"=>$this->input->post('producto',true),
                                         "medidas_de_la_caja"=>$this->input->post('medidas_de_las_cajas',true),
                                         "medidas_de_la_caja_2"=>$this->input->post('medidas_de_las_cajas_2',true),
                                         "medidas_de_la_caja_3"=>$this->input->post('medidas_de_las_cajas_3',true),
                                         "medidas_de_la_caja_4"=>$this->input->post('medidas_de_las_cajas_4',true),
                                         "unidades_por_pliego"=>$this->input->post('unidades_por_pliego',true),
                                         "hacer_troquel"=>$this->input->post('hacer_troquel',true),
                                         "lleva_troquelado"=>$this->input->post('lleva_troquelado',true),
                                         "piezas_totales_en_el_pliego"=>$this->input->post('piezas_totales_en_el_pliego',true),
                                         "metros_de_cuchillo"=>$this->input->post('metros_de_cuchillo',true),
                                         "tamano_a_imprimir_1"=>$this->input->post('tamano_1',true),
                                         "tamano_a_imprimir_2"=>$this->input->post('tamano_2',true),
                                         "tamano_cuchillo_1"=>$this->input->post('tamano_cuchillo_1',true),
                                         "tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                                         "materialidad_datos_tecnicos"=>$datos_tecnicos,
                                         "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                         "materialidad_1"=>$this->input->post("materialidad_1",true),
                                         "materialidad_2"=>$this->input->post("materialidad_2",true),
                                         "materialidad_3"=>$this->input->post("materialidad_3",true),
                                         "materialidad_4"=>$this->input->post("materialidad_4",true),
                                         "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                         "detalle_piezas_adicionales"=>$this->input->post("detalle_piezas_adicionales",true),
                                         "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
                                         "tipo_de_pegado"=>$this->input->post("tipo_de_pegado1",true),
                                         "lineas_pegado"=>$this->input->post("lineas_pegado",true),
                                         "detalle_lineas_pegado"=>$this->input->post("detalle_lineas_pegado",true),
                                         "es_una_maquina"=>$this->input->post("es_una_maquina",true),
                                         "impresion_compartida"=>$this->input->post("impresion_compartida",true),
                                         "contiene_otras_cotizaciones"=>$this->input->post("contiene_otras_cotizaciones",true),
                                         "numero_cotizacion"=>$this->input->post("numero_cotizacion",true),
                                         "archivo"=>$file_name,
                                         "fecha"=>date("Y-m-d"),
                                         "trabajos_adicionales"=>$this->input->post("trabajos_adicionales",true),
                                         "trabajos_adicionales_glosa"=>$this->input->post("trabajos_adicionales_glosa",true),
                                         "estado"=>$this->input->post("estado",true),
                                         "estan_los_moldes"=>$this->input->post("estan_los_moldes",true),
                                         "numero_molde"=>$this->input->post("molde",true),
                                         "id_adhesivo"=>$this->input->post("adhesivo",true),
                                         "quien"=>$quien,
                                         "cuando"=>$cuando,
                                         "solo_pegado"=>$this->input->post("solo_pegado",true),
                                         "tamano_pieza_a_empaquetar_ancho"=>$this->input->post("tamano_pieza_a_empaquetar_ancho",true),
                                         "tamano_pieza_a_empaquetar_largo"=>$this->input->post("tamano_pieza_a_empaquetar_largo",true),
                                         "glosa"=>$this->input->post("glosa",true),
                                         "pegado"=>$this->input->post("pegado",true),
                                         "doblado"=>$this->input->post("doblado",true),
                                         "empaquetado"=>$this->input->post("empaquetado",true),
                                         "tipo_pegado"=>$this->input->post("tipo_pegado",true),
                                         "pegado_puntos"=>$this->input->post("pegado_puntos",true),
                                         "pegado_cantidad_puntos"=>$this->input->post("pegado_cantidad_puntos",true),
                                         "tipo_fondo"=>$this->input->post("tipo_fondo",true),
                                         "lleva_aletas"=>$this->input->post("lleva_aletas",true),
                                         "total_aplicaciones_adhesivo"=>$this->input->post("total_aplicaciones_adhesivo",true),
                                         "id_molde"=>1,
                                         "aleta_pegado"=>$this->input->post("aleta_pegado",true),
                                         "ancho_1"=>$this->input->post("ancho_1",true),
                                         "ancho_2"=>$this->input->post("ancho_2",true),
                                         "largo_1"=>$this->input->post("largo_1",true),
                                         "largo_2"=>$this->input->post("largo_2",true),
                                         "largo_total_de_la_caja"=>$this->input->post("largo_total_de_la_caja",true),
                                         "cantidad_ordenes"=>$this->input->post("cantidad_ordenes",true),
                                         "suma_largo_aleta"=>$suma_largo_aleta,
                                         "nombre_molde"=>$this->input->post("nombre_molde",true),
                                      );
                                      if(sizeof($ing)==0)
                                      {
                                       $guardar=$this->cotizaciones_model->insertarIngenieria($data);
                                       if($this->input->post("estado",true)==2)
                                       {
                                           $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                           $config['mailtype'] = 'html';
                                           $this->email->initialize($config);
                                           $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                           $this->email->to($vendedor->correo); 
                                           $this->email->bcc('respaldocorreos@grauindus.cl');
                                           $this->email->subject('Mensaje de Cartonajes Grau');
                                           $html='<h2>Nuevo Mensaje:</h2>';
                                           $html.='La cotización N°'.$guardar.' ha sido rechazada, con la glosa:<br/>'.$this->input->post("glosa",true);
                                           $this->email->message($html);   
                    
                                        $this->email->send(); 
                                       }
                                      }else
                                      {
                                        $this->db->where('id_cotizacion', $this->input->post('id',true));
                                        $this->db->update("cotizacion_ingenieria",$data);
                                        if($this->input->post("estado",true)==2)
                                       {
                                           $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                                           $config['mailtype'] = 'html';
                                           $this->email->initialize($config);
                                           $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                                           $this->email->to($vendedor->correo); 
                                           $this->email->bcc('respaldocorreos@grauindus.cl');
                                           $this->email->subject('Mensaje de Cartonajes Grau');
                                           $html='<h2>Nuevo Mensaje:</h2>';
                                           $html.='La cotización N°'.$this->input->post('id',true).' ha sido rechazada, con la glosa:<br/>'.$this->input->post("glosa",true);
                                           $this->email->message($html);   
                    
                                        $this->email->send(); 
                                       }
                                      }
                                       
                                     $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
        					           redirect(base_url().'cotizaciones/index/'.$this->input->post("pagina",true),  301);
                }
            }
             $this->layout->css
            (
                array
                (
                 
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                )
            );        
          
            $this->layout->js
            (
                array
                (
                   
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                )
            );    
            $adhesivos=$this->adhesivos_model->getAdhesivos();
            $this->layout->view('revision_ingenieriaConCambio',compact("datos","id","pagina","ing","fotomecanica","adhesivos","hoja"));
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
/*Busca los moldes registrados del cliente  Ing Jaime Suarez*/    
    
    public function BuscarMoldesRegistradosCliente()
    {
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $id_cliente=$this->input->post("valor",true);
        $datos_basicos_clientes=$this->clientes_model->getClientePorIdBasico($id_cliente);
        $rut_repetidos=$this->clientes_model->getBuscarRutRepetidoCliente($datos_basicos_clientes->rut);        
//        exit(print_r($rut_repetidos));
        $moldes=$this->moldes_model->getMoldesClientes($id_cliente);
        $this->layout->view('moldes_clientes',compact("moldes","rut_repetidos")); 
    }      
     
/*Busca la forma de pago del cliente  Ing Jaime Suarez*/    
    
    public function BuscarFormaPagoCliente()
    {
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        
        
        $id_cliente=$this->input->post("valor",true);
        $datos=$this->clientes_model->getBuscarFormaPagoCliente($id_cliente);
        $this->layout->view('forma_pago',compact("datos")); 
    }    
    
/*Busca el vendedor asignado al cliente  Ing Jaime Suarez*/        
	
    public function BuscarBuscarVendedorCliente()
    {
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $id_cliente=$this->input->post("valor",true);
        $vendedores=$this->usuarios_model->getVendedores();        
        $datos=$this->clientes_model->getBuscarBuscarVendedorCliente($id_cliente);
        $this->layout->view('vendedor_asignado',compact("datos","vendedores")); 
    }    
	
	
    public function ajax_obtenerInfoProcesos()
    {
        $div=$this->input->post("div",true);
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $datos=$this->procesosespeciales_model->getDetalleProcesosPorId($this->input->post("valor",true));
        $this->layout->view('ajax_obtenerInfoProcesos',compact("datos","div")); 
    } 	
    
    public function ajax_obtenerInfo()
    {
        $div=$this->input->post("div",true);
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $datos=$this->acabados_model->getAcabadosPorId($this->input->post("valor",true));
        $this->layout->view('ajax_obtenerInfo',compact("datos","div")); 
    } 	
    
    public function ajax_obtenerInfoTrabajosInternos()
    {
        //echo $this->input->post("valor",true);
        $div=$this->input->post("div",true);
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $datos=$this->acabados_model->getAcabadosInternosPrecioPorNombre($this->input->post("valor",true));
        $this->layout->view('ajax_obtenerInfoTrabajosInternos',compact("datos","div")); 
    } 	
    
    public function ajax_obtenerInfoPiezas()
    {
        $div=$this->input->post("div",true);
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $datos=$this->piezas_adicionales_model->getValorPiezasPorNombre($this->input->post("valor",true));
        $this->layout->view('ajax_obtenerInfoPiezas',compact("datos","div")); 
    } 	
	
    
  public function pdf2($id=null)
	{
	if(!$id){show_404();}      
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $cotizacionPresupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $user=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        if (is_numeric($datos->forma_pago)) $forma_pago=$this->clientes_model->getFormasPagoPorId($datos->forma_pago); 
        else $forma_pago=$this->clientes_model->getFormasPagoPorNombre($datos->forma_pago);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $orden=$this->orden_model->getOrdenesPorCotizacion($id);      
        if(sizeof($datos)==0){show_404();}
        
        
        
       
        
        
        
        $cuerpo=' <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        
<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/estilos.css" />
    </head>
    <body>';
        /* header ==========================*/
        
    $tamano1=$ing->tamano_a_imprimir_1;
    $tamano2=$ing->tamano_a_imprimir_2;
 
    if($tamano1==60 and $tamano2>100)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==70 and $tamano2>120)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==80 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==90 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1>90 and $tamano2>60)
    {
        $maquina="Máquina Roland 800";
    }else
    {
        $maquina="Máquina Roland 800";
    }
    /**	
       * validaciones mermas
       * */
       
       if($fotomecanica->colores>3)
        {
            if($maquina=="Máquina Roland 800")
            {
                if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
                {
                    $color1=0;
                    $color2= $fotomecanica->colores*150;				
                }else{			
                    $color1=0;
                    $color2= $fotomecanica->colores*100;
                }
            }else
            {
                if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
                {
                    $color1=0;
                    $color2= $fotomecanica->colores*150;				
                }else{			
                $color1=0;
                $color2= $fotomecanica->colores*100;
                }
            }
        }else
        {
            if($fotomecanica->colores == 0)
            {
              $color1=0;
              $color2=0;
            }elseif($fotomecanica->colores >= 1 and $fotomecanica->colores <= 3)
            {	
              if($maquina=="Máquina Roland 800")
              {
                 $color1= 400;
                 $color2=0;
              }else
              {
                      //ultra
                 $color1= 300;
                 $color2=0;
              }
            }
        }
         
         $canTotal=number_format($datos->cantidad_1/5000,0,"","")-1;//6000 1
         //echo $canTotal;exit;
         if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
            $cantidad_1=$datos->cantidad_1/$ing->unidades_por_pliego;
         else 
             $cantidad_1=0;
         //echo $cantidad_1;exit;

         if($cantidad_1>5000)
         {
            $vecescan1 = ($cantidad_1) / 5000;
            if($vecescan1 >1)
            {
               $can1= 100 * $vecescan1;
            }else{
               $can1=100;
            }
            if($vecescan1 >1)
            {
                //$entero=number_format(($cantidad_1/5000)+0.5,0,'','');
                $can2= 50 * $vecescan1;
            }else
            {
                $can2=50;
            }
         }else
         {
            $can1=0;
            $can2=0;
         }
        
        
        $barniz=substr($fotomecanica->acabado_impresion_1,0,6);
        //echo $barniz;exit;
         if($fotomecanica->fot_lleva_barniz!='' || $fotomecanica->fot_lleva_barniz!='Nada')
         {
            $cantidadBarniz=$datos->cantidad_1-1000;
            if($cantidadBarniz<1000)
            {
                if($maquina=="Máquina Roland 800")
                {
                    //$bar1=150;
                    $bar1=100;
                    $bar2=0;
                }else
                {
                    $bar1=100;
                    $bar2=0;
                }
            }else
            {
			
               //echo $datos->cantidad_1/$ing->unidades_por_pliego;exit;
               $enteroBarniz=($datos->cantidad_1/$ing->unidades_por_pliego);
                if($enteroBarniz < 2000)
                {
                     //$bar1=150;
                     $bar1=100;
                     $bar2=0;   
                }else
                {
                 $enteroBarniz=(((number_format($enteroBarniz,0,'','')/1000)+0.5)-2)*10;
                 //echo $enteroBarniz;exit;   
                 //$bar1=150;
                 $bar1=100;
                 $bar2=$enteroBarniz;
                }
            }
            
            
         }else
         {
                $bar1=0;
                $bar2=0;
         }
		 

		
		
		
        if($datos->procesos_especiales_folia=="SI")
        {
            $folia=25;
        }else
        {
            $folia=0;
        }
 
        $acabado_nombre4=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
        $acabado_nombre5=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
        $acabado_nombre6=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
		
		
	if(strstr($acabado_nombre4->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }

	if(strstr($acabado_nombre5->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
	if(strstr($acabado_nombre6->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
        if($laca == null)
        {
                $laca=0;
        }
		
		
	if(strstr($acabado_nombre4->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        } 
		
	if(strstr($acabado_nombre5->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        }
		
         if(strstr($acabado_nombre6->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        }
		
	
	if($acabado_nombre4->tipo == 'Externo' and $acabado_nombre4->id != 17)
        {
            $numeros_de_acabados=1;			
        }

		
	if($acabado_nombre5->tipo == 'Externo' and $acabado_nombre5->id != 17)
        {
            $numeros_de_acabados=2;		
        }
		
         if($acabado_nombre6->tipo == 'Externo' and $acabado_nombre6->id != 17)
        {
            $numeros_de_acabados=3;	
        }
		
	if($numeros_de_acabados >= 2)
        {
            $termolaminado=0;
        }
		
	if($fotomecanica->acabado_impresion_4!="17" or $fotomecanica->acabado_impresion_5!="17" or $fotomecanica->acabado_impresion_6!="17")
        {
            $externo=50;
			
        }else
        {
            $externo=0;
        }
		
        if($ing->materialidad_datos_tecnicos=="Onda a la Vista")
        {
            $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
            if($canTotal2>=1)
            {
                $micromicro=30*$canTotal2;
            }else
            {
                $micromicro=0;
            }
        }else
        {
            $micromicro=0;
        }
         if($ing->materialidad_datos_tecnicos=="Cartulina-cartulina")
        {
            $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
            //if($canTotal2>=1)
            //{
              //  $cartulina=30*$canTotal2;
                $cartulina=30;
            //}else
           // {
             //   $cartulina=0;
            //}
        }else
        {
            $cartulina=0;
        }
        if($ing->materialidad_datos_tecnicos=="Sólo Cartulina")
        {
           $emplacado=0;
        }else
        {
            $mermaEmplacadoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(35);
            $emplacado= $cantidad_1; /*Valor x dividido por Unidad por pliego*/
            $emplacado= $emplacado / 1000; /*Resultado de emplacado dividido por 1000*/                                       
            $emplacado= ($emplacado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                                  
            $emplacado= $emplacado/ 1000; /*emplacado dividido por 1000*/                   
            $emplacado = $emplacado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
            $Entero = number_format($emplacado,0,'',''); /* Guardar entero del emplacado*/                         
            $emplacado = $Entero * $mermaEmplacadoArray->precio; /*Multiplicar entero del emplacado por 15*/
           
        }
        if($fotomecanica->estan_los_moldes=="NO LLEVA" or $fotomecanica->estan_los_moldes=="CLIENTE LO APORTA" or $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
        {
            $troquelado=0;
        }else
        {

            $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                $troquelado=$datos->cantidad_1/$ing->unidades_por_pliego;
            else 
                $troquelado=0;
                $troquelado= $troquelado / 1000; /*Resultado de emplacado dividido por 1000*/                                                              
                $troquelado= ($troquelado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          
                $troquelado= $troquelado/ 1000; /*emplacado dividido por 1000*/                      
                $troquelado = $troquelado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
                $EnteroTroquelado = number_format($troquelado,0,'',''); /* Guardar entero del emplacado*/                          
                $troquelado = $EnteroTroquelado * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        //$sum=$color1+$color2+$can1+$can2+$bar1+$bar2+$laca+$folia+$termolaminado+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
        $sum=$color1+$color2+$can1+$bar1+$bar2+$laca+$folia+$termolaminado+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
        if(sizeof($hoja)>=1)
        {
            $arreglo55=array
                (
                    "total_merma"=>$sum,
                );
                $this->db->where('id', $hoja->id);
                $this->db->update("hoja_de_costos_datos",$arreglo55);
        }
       /**
        * fin validaciones mermas
        * */ 
       if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
       {    
           $tiraje=$datos->cantidad_1/$ing->unidades_por_pliego;
       }
       else 
            $tiraje=0;
       if($tiraje<4000)
       {
         $tiraje2="Menos de 4.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(17);
         $factor_rango=$factor_rangos->precio;
       }elseif($tiraje>4000 and $tiraje<10000)
       {
         $tiraje2="4.001 a 10.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(18);
         $factor_rango=$factor_rangos->precio;
       }else
       {
        $tiraje2="Más de 10.000";
        $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(19);
        $factor_rango=$factor_rangos->precio;
       }
       /**
        * pre impresión
        * */
        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz3=0;
                                        }else
                                        {
                                            $barniz3=1;
                                        }
        //echo $barniz3;exit;
        if($maquina=="Máquina Roland 800")
        {
            $recargoPlanchaArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(26);
            $recargoPlancha=$recargoPlanchaArray->precio;
            $valorParaPlanchaMetal=1;
        }else
        {
            $recargoPlancha=0;
            $valorParaPlanchaMetal=0;
        }
        $arte=$this->variables_cotizador_model->getVariablesCotizadorPorId(1);
        $cantidadArte=$fotomecanica->colores*$arte->precio;
        $plancha_metal=$this->variables_cotizador_model->getVariablesCotizadorPorId(2);
        $cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))+(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
        $copiado=$this->variables_cotizador_model->getVariablesCotizadorPorId(3);
        $cantidadCopiapo=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))+(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
        $peliculasPreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(4);
        $peliculasVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(28);
        $cantidadPeliculas=$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$fotomecanica->colores*$peliculasVariable->precio;
        $montajePreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(5);
        $cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->colores;
        if($datos->impresion_hacer_cromalin=='SI')
        {
           $cromalinVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(22);
           $cromalin=$cromalinVariable->precio;
           $coloresCromalin=1;
        }else
        {
           $cromalin=0;
           $coloresCromalin=0;
        }
                             
        if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
        {
            $coloresArte= $barniz3 + $fotomecanica->colores;
            $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
            $coloresCopiado=$fotomecanica->colores;
            $coloresPeliculas=$barniz3 +$fotomecanica->colores;
            $coloresMontaje=$barniz3 +$fotomecanica->colores;
        }
					
        if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
        {
            $coloresArte= 0;
            $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
            $coloresCopiado=$fotomecanica->colores;
            $coloresPeliculas=0;
            $coloresMontaje=0;
            $cantidadArte = 0;
            // se cobra $cantidadPlantaMetal = 0;
            // se cobra $cantidadCopiapo = 0;
            $cantidadPeliculas = 0;
            // se cobra $cantidadMontaje = 0;
        }					

        if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
        {
            //ver cambio de peliculas con fotomecanicas y validar
            $coloresArte= 0;
            $coloresPlanchaMetal= 0;
            $coloresCopiado=0;
            $coloresPeliculas=0;
            $coloresMontaje=0;
        }
        if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
        {
            $coloresArte= 0;
            $coloresPlanchaMetal= 0;
            $coloresCopiado=0;
            $coloresPeliculas=0;
            $coloresMontaje=0;
        }
        $costoVenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(15);
        $costoAdministracion=$this->variables_cotizador_model->getVariablesCotizadorPorId(16);
        if ($datos->condicion_del_producto=='Repetición Sin Cambios')
           $totalPreImpresion=$cantidadArte+$cantidadPlantaMetal+$cantidadCopiapo+$cantidadPeliculas+$cromalin;
        else
           $totalPreImpresion=$cantidadArte+$cantidadPlantaMetal+$cantidadCopiapo+$cantidadPeliculas+$cantidadMontaje+$cromalin;

                             
                             /* fin header*/
 		$cuerpo.='
       <div class="container fuente">
            <header>
                <div>
                <h1><span id="titulo">Cartonajes Grau LTDA.</span> &nbsp;&nbsp;&nbsp; Hoja de Costos
               
                </h1>
                </div>
                <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                <div id="numero_de_costo">                
                Número de Costo : '.$id.'|| Orden de Producción :'.$orden->id_antiguo.' Número de Costo Antigua '.$datos->ot_antigua.'
                </div>
                <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                <div id="datos_basicos">
                    <!--tabla HTML-->
                    <table>';
                        if ($datos->ot_antigua!='') { 
                        $cuerpo.='<tr>
                            <td class="celda_1"><strong>NºC. Antigua<span class="derecha"> : </strong></span></td>
                            <td class="celda_2"><strong>'.$datos->ot_antigua.'</strong></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4"></td>
                            <td class="celda_5"></td>
                        </tr>';                        
                         }             
                 $cuerpo.=' <tr>
                            <td class="celda_1">Fecha <span class="derecha">:</span></td>
                            <td class="celda_2">'.fecha($datos->fecha).'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">Costeo <span class="derecha">:</span></td>
                            <td class="celda_5">'.$user->nombre.'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">Nombre <span class="derecha">:</span></td>
                            <td class="celda_2">'.$cli->razon_social.'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">E-Mail <span class="derecha">:</span></td>
                            <td class="celda_5">'.$cli->correo.'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">Dirección <span class="derecha">:</span></td>
                            <td class="celda_2">'.$cli->direccion.'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">RUT <span class="derecha">:</span></td>
                            <td class="celda_5">'.esRut($cli->rut).'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">Teléfono <span class="derecha">:</span></td>
                            <td class="celda_2">'.$cli->telefono.'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">Ciudad <span class="derecha">:</span></td>
                            <td class="celda_5">'.$cli->ciudad.'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">Vendedor <span class="derecha">:</span></td>
                            <td class="celda_2">'.$vendedor->nombre.'</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">Comuna <span class="derecha">:</span></td>
                            <td class="celda_5">'.$cli->comuna.'</td>
                        </tr>
                        <tr>
                            <td class="celda_1">&nbsp;</td>
                            <td class="celda_2">&nbsp;</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">AT <span class="derecha">:</span></td>
                            <td class="celda_5">'.$cli->contacto.'</td>
                        </tr>
                    </table>
                    <!--/fin tabla HTML-->
                    <!--separador 20-->
                    
                    ';
                    $acabado_1=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_1);
                    
                    $cuerpo.='
                    <!--/separador 20-->
                    <div id="numero_de_costo">
                    Descripción del trabajo
                    </div>
                    
                    <div>
                        '.$ing->producto.', Impreso a '.$fotomecanica->colores.' colores, Barniz:'.$fotomecanica->lleva_barniz.', En Placa'.$fotomecanica->materialidad_1.' onda: '.$fotomecanica->materialidad_2.' liner: '.$fotomecanica->materialidad_3.' Tamaño: '.$ing->medidas_de_la_caja.'X'.$ing->medidas_de_la_caja_2.'X'.$ing->medidas_de_la_caja_3.'X'.$ing->medidas_de_la_caja_4.'
                    </div>
                    <div class="separador_10"></div>
                    <div id="maquina">
                        <strong>Estado del producto: '.$fotomecanica->condicion_del_producto.'</strong>
                    </div>
               
                    <div>
                    <hr class="hr_punteada" />
                    Ancho : '.$tamano1.' Cm, Largo : '.$tamano2.' Cm, UNIDAD/PLIEGO : '.$ing->unidades_por_pliego.', COLORES : '.$fotomecanica->colores.', PIEZAS TOTALES EN EL PLIEGO(Desgajado) : '.$ing->piezas_totales_en_el_pliego.', TERMINACIÓN : '.$acabado_1->caracteristicas.', LLeva Barniz: '.$fotomecanica->fot_lleva_barniz.', Trabajo_Externo: '.$descripcion_trabajo_externo.'
                    <hr class="hr_punteada" />
                    </div>
                    <div id="cantidad">
                    <strong>Valor por :</strong> '.number_format($datos->cantidad_1,0,"",".").'
                    </div>
                
                    <div>
                        <!--materialidad-->
                        <table >
                            <tr>
                                <td class="celda_66 izquierda">
                                    ';
                                  switch($fotomecanica->materialidad_datos_tecnicos)
                                  {
									  //border="1"
                                    case 'Microcorrugado':
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
//					exit($costo_kilo."=(((".$materialidad_2->gramaje."*(".$materialidad_2->precio."/1000)+((".$materialidad_2->gramaje."*(".$variable_cotizador->precio."/100)*".$materialidad_2->precio."/1000))+".$materialidad_3->gramaje."*".$materialidad_3->precio."/1000)/(".$materialidad_2->gramaje."+(".$materialidad_2->gramaje."*(".$variable_cotizador->precio."/100))+".$materialidad_3->gramaje.")))*1000==========================================");           					
                                        if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                                 $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                        }

                                        elseif($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                                 $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                                 
                                        }


                                        elseif($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                                 $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                                 
                                        }


                                        elseif($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                                 
                                        }

                                        elseif($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                                 
                                        }


                                        elseif($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                                 $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                                 
                                        }
                                        else
                                        {  
                                                 $costo_kilo=$costo_kilo+140;
                                        }

                                        //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
										
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
//                                        $cuatro=$costo_kilo."=".$costo_kilo."+".$recargoCostoKilo->precio."**************************";
//					$cuerpo.=$cuatro;			
                                        
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        /*
                                        if($maquina=="Máquina Roland 800")
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(30/100);   
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                        }else
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(0/100);   
                                            //$valorParaPlanchaMetal
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$BASE_imprenta->precio)*($fotomecanica->colores+$barniz2)*($valorParaPlanchaMetal*$recargor800/100);
                                        }
                                          */
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                                       /*
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                       */
                                        switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'SI':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO LLEVA MOLDE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }
                                       
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        $ondaGramaje=$materialidad_2->gramaje;
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;
                                        $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
										
										
										
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Microcorrugado
                                        <br />
                                        <span>Tapa: </span> '.$tapa->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_1->reverso.'
                                        <br />
                                        <span>Onda: </span> '.$monda->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_2->reverso.'
                                        <br />
                                        <span>Liner: </span> '.$mliner->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_3->gramaje.' / <strong>Precio:</strong> '.$materialidad_3->precio.'
									    <br />
										<strong>Reverso :</strong>'.$materialidad_3->reverso.'
                                        <br />
                                        COSTO MONOTAPA POR KILO: '.number_format($costo_kilo,0,'','.').' &nbsp; 
										<br />
										GRAMOS ONDA M2 '.$GramosMetroCuadrado.' &nbsp; 
										 <br />
										COSTO MONOTAPA POR M2 '.$costoMonotapaPorMetro2.'
										<br />
										Forma de Pago :'.$forma_pago->forma_pago.'
                                        <br />
                                        IMPRESIÓN : '.$fotomecanica->impresion.'
                                        <br >
                                        Molde : '.$moldeNombre.'
                                        ';
                                    break;
                                    case 'Corrugado'://la misma
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
										
										if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
										}
										
										if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
										}
										
										
										if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
										}
										
										
										if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
										}
										
										if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
										}
										
										
										if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
										}
										
                                        //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
										
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
										
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        /*
                                        if($maquina=="Máquina Roland 800")
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(30/100);   
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                        }else
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(0/100);   
                                            //$valorParaPlanchaMetal
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$BASE_imprenta->precio)*($fotomecanica->colores+$barniz2)*($valorParaPlanchaMetal*$recargor800/100);
                                        }
                                          */
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                                       /*
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                       */
									switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'SI':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO LLEVA MOLDE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        $ondaGramaje=$materialidad_2->gramaje;
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;
										
										
                                        $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
										
										
										
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Corrugado
                                        <br />
                                        <span>Tapa: </span> '.$tapa->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_1->reverso.'
                                        <br />
                                        <span>Onda: </span> '.$monda->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_2->reverso.'
                                        <br />
                                        <span>Liner: </span> '.$mliner->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_3->gramaje.' / <strong>Precio:</strong> '.$materialidad_3->precio.'
									    <br />
										<strong>Reverso :</strong>'.$materialidad_3->reverso.'
                                        <br />
                                        COSTO MONOTAPA POR KILO: '.number_format($costo_kilo,0,'','.').' &nbsp; 
										<br />
										GRAMOS ONDA M2 '.$GramosMetroCuadrado.' &nbsp; 
										 <br />
										COSTO MONOTAPA POR M2 '.$costoMonotapaPorMetro2.'
										<br />
										Forma de Pago :'.$forma_pago->forma_pago.'
                                        <br />
                                        IMPRESIÓN : '.$fotomecanica->impresion.'
                                        <br >
                                        Molde : '.$moldeNombre.'
                                        ';
                                    break;
                                    case 'Cartulina-cartulina':
									
									//-----------
									 $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3="No Aplica";;
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
										
                                        //$formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+0*0/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0)))*1000;           
                                       //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
                                        $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+0*0/1000);
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje; //$materialidad_1->gramaje.
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
										
                                        $tapaNombre2=$materialidad_2->nombre;
                                        $tapaGramaje2=$materialidad_2->gramaje;
                                        $tapaFecha2=$materialidad_2->fecha_ultima_actualizacion;
                                        $tapaPrecio2=$materialidad_2->precio;
                     
                                        $cuerpo.=
                                        '
                                        <span><strong>Datos técnicos: </strong> </span> Cartulina - Cartulina
                                        <br />
                                        <span><strong>Tapa: </strong> </span>'.$fotomecanica->materialidad_1.' / <strong>Gramaje:</strong> '. $materialidad_1->gramaje .' / <strong>Precio:</strong> '.$materialidad_1->precio.' / <strong>Reverso:</strong> '.$materialidad_1->reverso.'
                                        <br />
                                        <span><strong>Tapa (Respaldo): </strong> </span> '. $fotomecanica->materialidad_2.' / <strong>Gramaje:</strong> '. $materialidad_2->gramaje.' / <strong>Precio:</strong> '. $materialidad_2->precio.' / <strong>Reverso:</strong> '. $materialidad_2->reverso.'
                                        
                                        <br />
                                        IMPRESIÓN : '. $fotomecanica->impresion.'
                                        <br >
                                        Molde : '. $moldeNombre;
									//-----------
									
									
									
                                     
                                    break;
                                    case 'Sólo Cartulina':
									
									$materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        //$materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        //$materialidad_3="No Aplica";;
                                        //$materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
										
                                        //$formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        //$costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+0*0/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0)))*1000;           
                                       //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
                                        $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $costo_kilo=0;
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+0*0/1000);
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
										
                                        $tapaNombre2=$materialidad_2->nombre;
                                        $tapaGramaje2=$materialidad_2->gramaje;
                                        $tapaFecha2=$materialidad_2->fecha_ultima_actualizacion;
                                        $tapaPrecio2=$materialidad_2->precio;
									
									
                                     $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2="No Aplica";
                                        $materialidad_3="No Aplica";
                                        $materialidad_4="No Aplica";
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Sólo Cartulina
                                        <br />
                                        <span>Tapa: </span> '.$fotomecanica->materialidad_1.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
                                        <br />
                                        
                                        ';
                                    break;
                                    case 'Onda a la Vista ( Micro/Micro )':
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_4);
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Onda a la Vista ( Micro/Micro )
                                        <br />
                                        <span>Liner: </span> '.$fotomecanica->materialidad_1.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
                                        <br />
                                        <span>Onda: </span> '.$fotomecanica->materialidad_2.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
                                        <br />
                                        <span>Liner 2: </span> '.$fotomecanica->materialidad_3.' / <strong>Gramaje:</strong> '.$materialidad_3->gramaje.' / <strong>Precio:</strong> '.$materialidad_3->precio.'
                                        <br />
                                        <span>Onda 2: </span> '.$fotomecanica->materialidad_4.' / <strong>Gramaje:</strong> '.$materialidad_4->gramaje.' / <strong>Precio:</strong> '.$materialidad_4->precio.'
                                        <br />
                                        
                                        ';
                                    break;
                                    case 'Otro':
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3="No Aplica";
                                        $materialidad_4="No Aplica";
                                        $cuerpo.=
                                        '
                                        <strong>Datos técnicos:<strong> Otro
                                        <br />
                                        <strong>Tapa: </strong> '.$fotomecanica->materialidad_1.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
                                        <br />
                                        <span>Tapas: </span> '.$fotomecanica->materialidad_2.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
                                        <br />
                                        
                                        ';
                                    break;
                                    case 'Se solicita proposición':
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Se solicita proposición
                                        <br />
                                        <span>Tapa: </span> '.$fotomecanica->materialidad_1.'
                                        <br />
                                        <span>Tapas: </span> '.$fotomecanica->materialidad_2.'
                                        <br />
                                        
                                        ';
                                    break;
                                //ojo borrar este case
                                    case 'Indefinido':
//                                        exit("paso");
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
										
										if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
										}
										
										if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
										}
										
										
										if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
										}
										
										
										if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
										}
										
										if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
										}
										
										
										if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
										{
											 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
										}
										
                                        //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
										
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
										
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        /*
                                        if($maquina=="Máquina Roland 800")
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(30/100);   
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                        }else
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(0/100);   
                                            //$valorParaPlanchaMetal
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$BASE_imprenta->precio)*($fotomecanica->colores+$barniz2)*($valorParaPlanchaMetal*$recargor800/100);
                                        }
                                          */
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                                       /*
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                       */
									switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'SI':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO LLEVA MOLDE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        $ondaGramaje=$materialidad_2->gramaje;
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;
                                        $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
										
										
										
                                        $cuerpo.=
                                        '
                                        <span>Datos técnicos: </span> Indefinido
                                        <br />
                                        <span>Tapa: </span> '.$tapa->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_1->gramaje.' / <strong>Precio:</strong> '.$materialidad_1->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_1->reverso.'
                                        <br />
                                        <span>Onda: </span> '.$monda->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_2->gramaje.' / <strong>Precio:</strong> '.$materialidad_2->precio.'
										<br />
										<strong>Reverso :</strong>'.$materialidad_2->reverso.'
                                        <br />
                                        <span>Liner: </span> '.$mliner->materiales_tipo.' / <strong>Gramaje:</strong> '.$materialidad_3->gramaje.' / <strong>Precio:</strong> '.$materialidad_3->precio.'
									    <br />
										<strong>Reverso :</strong>'.$materialidad_3->reverso.'
                                        <br />
                                        COSTO MONOTAPA POR KILO: '.number_format($costo_kilo,0,'','.').' &nbsp; 
										<br />
										GRAMOS ONDA M2 '.$GramosMetroCuadrado.' &nbsp; 
										 <br />
										COSTO MONOTAPA POR M2 '.$costoMonotapaPorMetro2.'
										<br />
										Forma de Pago :'.$forma_pago->forma_pago.'
                                        <br />
                                        IMPRESIÓN : '.$fotomecanica->impresion.'
                                        <br >
                                        Molde : '.$moldeNombre.'
                                        ';
                                    break;                                
                                  }  
                               //valign_top border="1"
                                $cuerpo.='</td>';
								
                                $cuerpo.='<td class="celda_5  izquierda">';
                                $cuerpo.='<!--trabajos externos-->';
                                $cuerpo.='<table border="0">
                                            <tr>
                                                <td class="celda_5" colspan="9"><strong>&nbsp;&nbsp;Externos</strong></td>
                                                <td class="celda_5" >&nbsp;Unidad&nbsp;</td>                                                
                                                <td class="celda_5" >&nbsp;Cantidad&nbsp;</td>
                                                <td class="celda_5" >&nbsp;Ancho&nbsp;</td>
                                                <td class="celda_5" >&nbsp;Largo&nbsp;</td>
                                                <td class="celda_5" >&nbsp;M2&nbsp;</td>
                                                <td class="celda_5" >&nbsp;V.Unit.&nbsp;</td>												
                                                <td class="celda_5" >&nbsp;C.Unit.&nbsp;</td>
                                                <td class="celda_5" >&nbsp;Total&nbsp;</td>                                                
                                            </tr>';
                                                
                               if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
                                    if ($acabado_4Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //mt2
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datos->cantidad_1*$acabado_4Valor);
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Molde troquel 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=$acabado_4Valor;
                                    }  								
                                }
                                 if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                    if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);                                      
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }  
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datos->cantidad_1*$acabado_5Valor);
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Molde troquel 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=$acabado_5Valor;
                                    } 
                                }    
                              if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datos->cantidad_1*$acabado_5Valor);
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Molde troquel 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=$acabado_6Valor;
                                    }  
                                }  
       

                                //Valores EMPRESA

                                if($hoja->valor_acabado_1 != '0')
                                {
                                        $valor_acabado_1hc = $hoja->valor_acabado_1;
                                }
                                else
                                {
                                        $valor_acabado_1hc = $acabado_4Unitario;	
                                }

                                if($hoja->valor_acabado_2 != '0')
                                {
                                        $valor_acabado_2hc = $hoja->valor_acabado_2;
                                }
                                else
                                {
                                        $valor_acabado_2hc = $acabado_5Unitario;	
                                }

                                if($hoja->valor_acabado_3 != '0')
                                {
                                        $valor_acabado_3hc = $hoja->valor_acabado_3;
                                } 
                                else
                                {
                                        $valor_acabado_3hc = $acabado_6Unitario;	
                                }
	   
                                $cuerpo.='
                                        <tr>
                                             <td class="celda_3" colspan="9">&nbsp;&nbsp;'.str_replace("�", "ñ", ucwords(strtolower($acabado_4))); $cuerpo.='&nbsp;</td>
                                             <td class="celda_3">&nbsp;'.$acabado_4UnidadVentaNombre.'&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_4UnidadVentaNombre!="") $cuerpo.=$datos->cantidad_1; $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_4UnidadVentaNombre!="") $cuerpo.=$tamano1; $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_4UnidadVentaNombre!="") $cuerpo.=$tamano2; $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_4UnidadVentaNombre!="") $cuerpo.=(($tamano1*$tamano2)/10000); $cuerpo.='&nbsp;</td>';												
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_4Valor>0) $cuerpo.= number_format($acabado_4Valor,0,'','.'); $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($costo_unitario4>0) $cuerpo.= number_format($costo_unitario4,0,'','.'); $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($precio_total_4>0) $cuerpo.= number_format($precio_total_4,0,'','.'); $cuerpo.='&nbsp;</td>';
                                $cuerpo.='
                                        <tr>
                                             <td class="celda_3" colspan="9">&nbsp;&nbsp;'.str_replace("�", "ñ", ucwords(strtolower($acabado_5))); $cuerpo.='&nbsp;</td>
                                             <td class="celda_3">&nbsp;'.$acabado_5UnidadVentaNombre.'&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_5UnidadVentaNombre!="") $cuerpo.=$datos->cantidad_1; $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_5UnidadVentaNombre!="") $cuerpo.=$tamano1; $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_5UnidadVentaNombre!="") $cuerpo.=$tamano2; $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_5UnidadVentaNombre!="") $cuerpo.=(($tamano1*$tamano2)/10000); $cuerpo.='&nbsp;</td>';												
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_5Valor>0) $cuerpo.= number_format($acabado_5Valor,0,'','.'); $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($costo_unitario5>0) $cuerpo.= number_format($costo_unitario5,0,'','.'); $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($precio_total_5>0) $cuerpo.= number_format($precio_total_5,0,'','.'); $cuerpo.='&nbsp;</td>';
                                $cuerpo.='
                                        <tr>
                                             <td class="celda_3" colspan="9">&nbsp;&nbsp;'.str_replace("�", "ñ", ucwords(strtolower($acabado_6))); $cuerpo.='&nbsp;</td>
                                             <td class="celda_3">&nbsp;'.$acabado_6UnidadVentaNombre.'&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_6UnidadVentaNombre!="") $cuerpo.=$datos->cantidad_1; $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_6UnidadVentaNombre!="") $cuerpo.=$tamano1; $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_6UnidadVentaNombre!="") $cuerpo.=$tamano2; $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_6UnidadVentaNombre!="") $cuerpo.=(($tamano1*$tamano2)/10000); $cuerpo.='&nbsp;</td>';												
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($acabado_6Valor>0) $cuerpo.= number_format($acabado_6Valor,0,'','.'); $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($costo_unitario6>0) $cuerpo.= number_format($costo_unitario6,0,'','.'); $cuerpo.='&nbsp;</td>';
                                             $cuerpo.='<td class="celda_3">&nbsp;';  if ($precio_total_6>0) $cuerpo.= number_format($precio_total_6,0,'','.'); $cuerpo.='&nbsp;</td>';
                                $externos_produccion=$precio_total_4+$precio_total_5+$precio_total_6;                                             
                                $cuerpo.='<tr>
                                                <td class="celda_3" colspan="16"><strong>&nbsp;&nbsp;Total Precio de Trabajos Externos</strong></td>
                                                <td class="celda_3" >&nbsp;<strong>'; if ($hoja->valor_externo>0) $cuerpo.=number_format($hoja->valor_externo,0,'','.'); $cuerpo.='</strong>&nbsp;</td>
                                            </tr>';
                                $cuerpo.='<tr>
                                            <td class="celda_3" colspan="9"><strong>&nbsp;&nbsp;Piezas</strong></td>
                                            <td class="celda_3">&nbsp;</td>
                                            <td class="celda_3">&nbsp;</td>
                                            <td class="celda_3">&nbsp;</td>
                                            <td class="celda_3">&nbsp;</td>
                                            <td class="celda_3">&nbsp;</td>												
                                            <td class="celda_3">&nbsp;</td>
                                            <td class="celda_3">&nbsp;</td>											
                                            <td class="celda_3">&nbsp;</td>
                                        </tr>';                
           										
                                    if($ing->piezas_adicionales == 'NO LLEVA')
                                    {
                                        $piezaAdacionalNom1 ="No Lleva";
                                        $piezaAdacionalValor1="&nbsp;";
                                        $piezaAdacionalTotal1="&nbsp;";
                                        $piezaAdacionalEmpresa1="&nbsp;";
                                    }else
                                    {
                                        $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales);
                                        $piezaUnidadVentaNombre1=$piezasAdicionales->unv; //Nombre unidad de venta
                                        $piezaAdacionalNom1 = $piezasAdicionales->piezas_adicionales;
                                        $piezaAdacionalValor1= $piezasAdicionales->valor_venta;
                                        $piezaAdacionalTotal1 = $datos->cantidad_1 * $piezaAdacionalValor1;
                                        $piezaAdacionalEmpresa1= $hoja->piezas_adicionales1;
                                    }
                                    if($ing->piezas_adicionales2 == 'NO LLEVA')
                                    {
                                        $piezaAdacionalNom2 ="No Lleva";
                                        $piezaAdacionalValor2="&nbsp;";
                                        $piezaAdacionalTotal2="&nbsp;";
                                        $piezaAdacionalEmpresa2="&nbsp;";
                                    }else
                                    {
                                        $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales2);
                                        $piezaUnidadVentaNombre2=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                                        $piezaAdacionalNom2 = $piezasAdicionales->piezas_adicionales;
                                        $piezaAdacionalValor2= $piezasAdicionales->valor_venta;
                                        $piezaAdacionalTotal2= $datos->cantidad_1 * $piezaAdacionalValor2;
                                        $piezaAdacionalEmpresa2= $hoja->piezas_adicionales2;
                                    }
                                    if($ing->piezas_adicionales3 == 'NO LLEVA')
                                    {
                                        $piezaAdacionalNom3 ="No Lleva";
                                        $piezaAdacionalValor3="&nbsp;";
                                        $piezaAdacionalTotal3="&nbsp;";
                                        $piezaAdacionalEmpresa3="&nbsp;";
                                    }else
                                    {
                                        $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales3);
                                        $piezaUnidadVentaNombre3=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                                        $piezaAdacionalNom3 = $piezasAdicionales->piezas_adicionales;
                                        $piezaAdacionalValor3 =  $piezasAdicionales->valor_venta;
                                        $piezaAdacionalTotal3= $datos->cantidad_1 * $piezaAdacionalValor3;;
                                        $piezaAdacionalEmpresa3= $hoja->piezas_adicionales3;
                                    }
                                    
                        $cuerpo.='<tr>';
                                    $cuerpo.='<td class="celda_5" colspan="9">&nbsp;&nbsp;'; $cuerpo.=ucwords(strtolower($piezaAdacionalNom1)); $cuerpo.='&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;'; $cuerpo.=$piezaUnidadVentaNombre1; $cuerpo.='&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5">&nbsp;'; if ($piezaUnidadVentaNombre1!="") $cuerpo.=$datos->cantidad_1; $cuerpo.='&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';												
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;'; if ($piezaUnidadVentaNombre1!="") $cuerpo.=$piezaAdacionalValor1; $cuerpo.='&nbsp;</td>';					
                                    $cuerpo.='<td class="celda_5">'; $cuerpo.=number_format($piezaAdacionalTotal1,0,'','.'); $cuerpo.='</td>';                                       
                                    
                                    
                        $cuerpo.='</tr>';   
                        
                        $cuerpo.='<tr>';
                                    $cuerpo.='<td class="celda_5" colspan="9">&nbsp;&nbsp;'; $cuerpo.=ucwords(strtolower($piezaAdacionalNom2)); $cuerpo.='&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;'; $cuerpo.=$piezaUnidadVentaNombre2; $cuerpo.='&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5">&nbsp;'; if ($piezaUnidadVentaNombre2!="") $cuerpo.=$datos->cantidad_1; $cuerpo.='&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';												
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;'; if ($piezaUnidadVentaNombre2!="") $cuerpo.=$piezaAdacionalValor2; $cuerpo.='&nbsp;</td>';					
                                    $cuerpo.='<td class="celda_5">'; $cuerpo.=number_format($piezaAdacionalTotal2,0,'','.'); $cuerpo.='</td>';                                    
                                     
                        $cuerpo.='</tr>';  

                        $cuerpo.='<tr>';
                                    $cuerpo.='<td class="celda_5" colspan="9">&nbsp;&nbsp;'; $cuerpo.=ucwords(strtolower($piezaAdacionalNom3)); $cuerpo.='&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;'; $cuerpo.=$piezaUnidadVentaNombre3; $cuerpo.='&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5">&nbsp;'; if ($piezaUnidadVentaNombre3!="") $cuerpo.=$datos->cantidad_1; $cuerpo.='&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;</td>';
                                    $cuerpo.='<td class="celda_5" >&nbsp;'; if ($piezaUnidadVentaNombre3!="") $cuerpo.=$piezaAdacionalValor3; $cuerpo.='&nbsp;</td>';					
                                    $cuerpo.='<td class="celda_5">'; $cuerpo.=number_format($piezaAdacionalTotal3,0,'','.'); $cuerpo.='</td>';                                    
                                    
                        $cuerpo.='</tr>';  
                        $cuerpo.='<tr>';
                        $cuerpo.='<td class="celda_5" colspan="16"><strong>&nbsp;&nbsp;Total Precio de Piezas Adicionales</strong></td>';
                        $cuerpo.='<td class="celda_5" >&nbsp;<strong>'; $cuerpo.=number_format($hoja->valor_piezas,0,'','.'); $cuerpo.='</strong>&nbsp;</td>';
                        $cuerpo.='</tr>';
                        $cuerpo.='<tr>';
                        $cuerpo.='<td class="celda_5" colspan="16"><strong>&nbsp;&nbsp;Total Externos</strong></td>';
                        $cuerpo.='<td class="celda_5" >&nbsp;<strong>'; $cuerpo.=number_format(($hoja->valor_externo+$hoja->valor_piezas),0,'','.'); $cuerpo.='</strong>&nbsp;</td>';
                        $cuerpo.='</tr>';                          

				
								
                                    if($piezaAdacionalTotal1 != '0')
                                    {
                                            $piezaAdacionalTotal1 = $piezaAdacionalTotal1;
                                    }else
                                    {
                                            $piezaAdacionalTotal1 = '';
                                    }
                                    if($piezaAdacionalTotal2 != '0')
                                    {
                                            $piezaAdacionalTotal2 = $piezaAdacionalTotal2;
                                    }else
                                    {
                                            $piezaAdacionalTotal2 = '';
                                    }
                                    if($piezaAdacionalTotal3 != '0')
                                    {
                                            $piezaAdacionalTotal3 = $piezaAdacionalTotal3;
                                    }else
                                    {
                                            $piezaAdacionalTotal3 = '';
                                    }
								
//                                    $cuerpo.='
//					<tr>
//						<td class="celda_5" colspan="22">'. $piezaAdacionalNom1 .'</td>													
//                                                <td class="celda_5">'.$piezaAdacionalValor1.'</td>
//						<td class="celda_5"> </td> 
//                                                <td class="celda_5">'.$piezaAdacionalTotal1.'</td>
//                                                <td class="celda_5">'.$piezaAdacionalTotal1.'</td>
//					</tr>	
//                                        <tr>
//						<td class="celda_5" colspan="22">'. $piezaAdacionalNom2 .'</td> 
//						<td class="celda_5"> '.$piezaAdacionalValor2.'</td>     
//						<td class="celda_5"> </td> 												
//                                                <td class="celda_5">'.$piezaAdacionalTotal2.'</td>												
//                                                <td class="celda_5">'.$piezaAdacionalTotal2.'</td>												
//                                        </tr>	
//					<tr>
//						<td class="celda_5" colspan="22">'. $piezaAdacionalNom3.'</td> 
//                                                <td class="celda_5"> '.$piezaAdacionalValor3.'</td>     
//                                                <td class="celda_5"> </td>     
//                                                <td class="celda_5">'.$piezaAdacionalTotal3.'</td>												
//                                                <td class="celda_5">'.$piezaAdacionalTotal3.'</td>												
//					</tr>';
                                $cuerpo.='         
                                        </table>
                                    <!--/trabajos externos-->
									';
									
					$cuerpo.=' 
                                </td>
                            </tr>
                        </table>
                        <!--/materialidad-->
                    </div>
                    ';
					
					
					
					
                     /**
                     * pre producción
                     * */ 
                    $cuerpo.='
                    <div class="separador_10"></div>
                    <div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">MAT.PRIMAS</td>
                                <td class="celda_3">CANT/PLIEGO</td>
                                <td class="celda_3">VALOR $</td>
                                <td class="celda_3">PRODUCCIÓN</td>
                                <td class="celda_3">UNITARIO</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="6"><hr class="hr_punteada" /></td>
                            </tr>';
                            //$costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            //$valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            //$totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
                            
							/*$costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							*/
							$costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
                        
						//<td class="celda_3">TAPA KILO '.number_format($valorPlacaKilo,0,'','.').'</td>
						

                            $cuerpo.='
                            <tr>
                                <td class="celda_3">TAPA KILO '.number_format($valorPlacaKilo,0,'','.').'</td>
                                <td class="celda_3">'.number_format($costoPlacaKilo,0,'','.').'</td>
                                <td class="celda_3">'.number_format($totalPlacaKilo,0,'','.').'</td>
                                <td class="celda_3 valign_top padding_left_10" colspan="3" rowspan="30">
                                    <!--producción-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td class="celda_33">TIRAJE</td>
                                            <td class="celda_33">'.$factor_rango.'</td>
                                            <td class="celda_33">'.number_format($tiraje,0,'','.').'</td>
                                        </tr>';
                                        $variableComplemento=$this->variables_cotizador_model->getVariablesCotizadorPorId(32);
                                        $valorTiraje=$variableComplemento->precio-$tiraje;
                                        if($valorTiraje>0)
                                        {
                                           		if($fotomecanica->colores == 0)
											{
												$complemento=0;
											}else{
											 $complemento=$valorTiraje;	
											}
                                        }else
                                        {
                                            $complemento=0;
                                        }
										
										//Total externo
//                                                                  if($hoja->valor_acabado_1 >= 1 )
//								  {
//									  $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_1;
//								  }else
//								  {
//									  $externos_produccion = $externos_produccion +(($acabado_4Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
//								  }
//								  
//						      	  if($hoja->valor_acabado_2 >= 1 )
//								  {
//									    $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_2;
//								  }else
//								  {
//									  $externos_produccion = $externos_produccion + (($acabado_5Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
//								  }
//								  if($hoja->valor_acabado_3 >= 1 )
//								  {
//									  $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_3;
//								  }else
//								  {
//									  $externos_produccion = $externos_produccion + (($acabado_6Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
//								  }
//								  
                                       $externos_produccion=$hoja->valor_externo+$hoja->valor_piezas;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">COMPLEMENTO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($complemento,0,'','.').'</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">EXTERNOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format(($externos_produccion),0,'','.').'</td>
                                        </tr>';
                                        if($maquina=="Máquina Roland 800")
                                            {
                                                $costoOndaKilo=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                                                
                                            }else
                                            {
                                                $costoOndaKilo=(($datos->cantidad_1/$ing->unidades_por_pliego)+100)+4;
                                                
                                            }
											
											
                                        /*
										    $valorOndaKilo=($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000;
                                            $totalOndaKilo=$valorOndaKilo*$costo_kilo;
                                            $valorCorte=$costoOndaKilo*4.5;
											
										*/
										if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
											{
												$costoOndaKilo=0;
												$valorOndaKilo=0;
												$totalOndaKilo=0;
												$valorCorte=0;
										
											}else{
                                            $valorOndaKilo=($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000;
                                            $totalOndaKilo=$valorOndaKilo*$costo_kilo;
//                                            $tres=$totalOndaKilo."=".$valorOndaKilo."*".$costo_kilo.'----------------------------------';
                                        $valorCorte=$costoOndaKilo*4.5;
											}
										
										
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">CORTE</td>
                                            <td class="celda_33">4.5</td>
                                            <td class="celda_33">'.number_format($valorCorte,0,'','.').'</td>
                                        </tr>';
                                        $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
                                        $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
                                        $totalEmplacado=$valorEmplacadado*$costoOndaKilo;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">EMPLACADO</td>
                                            <td class="celda_33">'.$valorEmplacadado.'</td>
                                            <td class="celda_33">'.number_format($totalEmplacado,0,'','.').'</td>
                                        </tr>';
										
                                        if($fotomecanica->estan_los_moldes == 'NO' or $fotomecanica->estan_los_moldes == 'SI')
                                        {
                                                                        $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                                                                        $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                                                                        $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                                        }elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
                                        {
                                                                        $variableMontajeMoldeTroquel=0;
                                                                        $totalMontajeMolde=0;
                                        }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
                                        {
                                                                        $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                                                                        $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                                                                        $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                                        }

										
										
                                        //$variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                                        //$variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                                        //$totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">MONTAJE MOLDE</td>
                                            <td class="celda_33">'.number_format($variableMontajeMoldeTroquel->precio,0,'','.').'</td>
                                            <td class="celda_33">'.number_format($totalMontajeMolde,0,'','.').'</td>
                                        </tr>';
										
														if($fotomecanica->estan_los_moldes == 'NO' or $fotomecanica->estan_los_moldes == 'SI')
														{
														   $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
														   $totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
														}elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
														{
															$variableTroquelado=0;
															$totalTroquelado=0;
														}elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
														{
														   $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
														   $totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
														}elseif($fotomecanica->estan_los_moldes == 'SI')
														{
														   $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
														   $totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
														}
										
                                        //$variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                                        //$totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">TROQUELADO</td>
                                            <td class="celda_33">'.$variableTroquelado->precio.'</td>
                                            <td class="celda_33">'.number_format($totalTroquelado,0,'','.').'</td>
                                        </tr>';
                                        $variableDesgajado=$this->variables_cotizador_model->getVariablesCotizadorPorId(12);
                                        $totalDesgajado=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOndaKilo;
                                        
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">DESGAJADO</td>
                                            <td class="celda_33">'.$variableDesgajado->precio.'</td>
                                            <td class="celda_33">'.number_format($totalDesgajado,0,'','.').'</td>
                                        </tr>';
                                        //$variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                        //$totalPegado=$datos->cantidad_1*$presupuesto->costo_pegado*$variablePegado->precio;
										
										$variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                        $totalPegado=$datos->cantidad_1*$hoja->pegado*$variablePegado->precio;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">PEGADO</td>
                                            <td class="celda_33">'.number_format($hoja->pegado,0,'','.').'</td>
                                            <td class="celda_33">'.number_format($totalPegado,0,'','.').'</td>
                                        </tr>';
                                        //$divisionPegado=$presupuesto->costo_pegado/2;
                                        //$totalDespacho=$divisionPegado*$datos->cantidad_1;
										
										 if(sizeof($hoja->pegado)>=1)
										 {
											 $divisionPegado=$hoja->pegado/2;
															$totalDespacho=$divisionPegado*$datos->cantidad_1;
										 }
										 else
										 {
										$divisionPegado=$presupuesto->costo_pegado/2;
															$totalDespacho=$divisionPegado*$datos->cantidad_1;	 
										 }
										
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">DESPACHO</td>
                                            <td class="celda_33">'.$divisionPegado.'</td>
                                            <td class="celda_33">'.number_format($totalDespacho,0,'','.').'</td>
                                        </tr>
                                        ';
										
										
                                        if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
                                               {
                                                        if($fotomecanica->estan_los_moldes == 'NO')
                                                       {
                                                                       $variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                                                       $moldeTroquel=$variableTroquel->precio;
                                                       }elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
                                                       {
                                                                       $moldeTroquel=0;
                                                       }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
                                                       {
                                                                       $moldeTroquel=0;
                                                       }
                                               }

                                               if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
                                               {

                                                                       $moldeTroquel=0;

                                               }					

                                               if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
                                               {

                                                                       $moldeTroquel=0;

                                               }
                                               if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
                                               {
                                                                       $moldeTroquel=0;
                                               }
										
										
                                      /*  if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $moldeTroquel=0;
                                       }else
                                       {
                                            $variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                            $moldeTroquel=$variableTroquel->precio;
                                            
                                       }*/
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">MOLDE TROQUEL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($moldeTroquel,0,'','.').'</td>
                                        </tr>
                                        ';
										$variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(39);
										 if($fotomecanica->lleva_barniz == 'SI' and $fotomecanica->reserva_barniz == 'SI')
										 {
											 $otrosCaucho = $variableEmplacado->precio; 
										 }else
										 {
											$otrosCaucho = 0;
										 }
										 $cuerpo.='
                                        <tr>
                                            <td class="celda_33">CAUCHO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($otrosCaucho,0,'','.').'</td>
                                        </tr>
                                        ';
										if($piezaAdacionalEmpresa1 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa1;

					 }
					 else
					 {
						 	$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal1;
						 
					 }
					 
					  if($piezaAdacionalEmpresa2 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa2;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal2;
						 
					 }
					 
					 
					  if( $piezaAdacionalEmpresa3 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa3;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal3;
						 
					 }
										 $cuerpo.='
                                        <tr>
                                            <td class="celda_33">PIEZAS ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($TotalPiezasAdicionales,0,'','.').'</td>
                                        </tr>
                                        ';
										
										
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33" colspan="3"><hr class="hr_punteada" /></td>
                                        </tr>';
                                        //$totalProduccion=$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel;
					$totalProduccion=$costosporlacado+$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($totalProduccion,0,'','.').'</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33" colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33"><span class="subrayado">COSTOS VARIOS</span></td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                                        </tr>';
                                        //$totalMateriaPrima    
                                        $costoVentaValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;
//                                        $dos=$costoVentaValor."=((".$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoVenta->precio.")/100=======================";
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">COSTO VENTA</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($costoVentaValor,0,'','.').'</td>
                                        </tr>';
                                         $costoAdministracionValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoAdministracion->precio)/100;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">COSTO ADMINISTRACIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($costoAdministracionValor,0,'','.').'</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($hoja->valor_extra,0,'','.').'</td>
                                        </tr>';
                                       // $totalCostosVarios=$costoAdministracionValor+$costoVentaValor;
					$totalCostosVarios=$costoAdministracionValor+$costoVentaValor+$hoja->costo_adicional;
                                        $cuerpo.='
                                        <tr>
                                            <td class="celda_33">TOTAL COSTOS VARIOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">'.number_format($totalCostosVarios,0,'','.').'</td>
                                        </tr>
                                    </table>
                                    <!--/producción-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>';
                            
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									
									
									$costoPlacaKilo2=($datos->cantidad_1/$ing->unidades_por_pliego);
									
							$dos_por_ciento = ($costoPlacaKilo2 / 100)* 2;
							
							if($costoPlacaKilo2 >= 1 and $costoPlacaKilo2 <= 100)
							{
								$agregado_a_apliegos = 100;
							}
							
							if($costoPlacaKilo2 > 100)
							{
								$agregado_a_apliegos = $dos_por_ciento;
							}
							$costoPlacaKilo2 = $costoPlacaKilo2 + $agregado_a_apliegos;
							$valorPlacaKilo2 = ($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje2)/10000000;
                            $totalPlacaKilo2 = $valorPlacaKilo2*$tapaPrecio2;
							
									$valorPlacaKilo2=($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje2)/10000000;
									$totalPlacaKilo2=$valorPlacaKilo2*$tapaPrecio2;
									
									 $cuerpo.='
										<tr>
										<td class="celda_3">KILO (RESPALDO):'.number_format($valorPlacaKilo2,0,'','.').'</td>
										<td class="celda_3">'.number_format($costoPlacaKilo2,0,'','.').'</td>
										<td class="celda_3">'.number_format($totalPlacaKilo2,0,'','.').'</td>
										</tr> ';
									
								}else								
								{
									 $cuerpo.='
										<tr>
										<td class="celda_3">ONDA KILO '.number_format($valorOndaKilo,0,'','.').'</td>
										<td class="celda_3">'.number_format($costoOndaKilo,0,'','.').'</td>
										<td class="celda_3">'.number_format($totalOndaKilo,0,'','.').'</td>
										</tr> ';
								}
							
							
							
                            $cuerpo.='

                            <!--
                            <tr>
                                <td class="celda_3">SEDAS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            -->
                            <tr>
                                <td class="celda_3">VARIOS</td>
                                <td class="celda_3">0</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>';
                            
							
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima= $totalPlacaKilo+$totalPlacaKilo2;
								}else
								{
									$totalMateriaPrima= $totalOndaKilo+$totalPlacaKilo;	
								}
							
                            $cuerpo.='
                            <tr>
                                <td class="celda_3"><span class="subrayado_top">TOTAL MATERIA PRIMA</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalMateriaPrima,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>';
                            
                            $cuerpo.='
                            <tr>
                                <td class="celda_3">PRE-IMPRESIÓN</td>
                                <td class="celda_3">CANTIDAD</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">ARTE '.$coloresArte.'</td>
                                <td class="celda_3">'.number_format($arte->precio,0,'','.').'</td>
                                <td class="celda_3">'.number_format($cantidadArte,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">PLANCHAMETAL '.$coloresPlanchaMetal.'</td>
                                <td class="celda_3">'.number_format($plancha_metal->precio,0,'','.').'</td>
                                <td class="celda_3">'.number_format($cantidadPlantaMetal,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">COPIADO '.$coloresCopiado.'</td>
                                <td class="celda_3">'.number_format($copiado->precio,0,'','.').'</td>
                                <td class="celda_3">'.number_format($cantidadCopiapo,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">PELÍCULAS '.$coloresPeliculas.'</td>
                                <td class="celda_3">'.number_format($peliculasPreImpresion->precio,0,'','.').'</td>
                                <td class="celda_3">'.number_format($cantidadPeliculas,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MONTAJE '.$coloresMontaje.'</td>
                                <td class="celda_3">'.number_format($montajePreImpresion->precio,0,'','.').'</td>
                                <td class="celda_3">'.number_format($cantidadMontaje,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">CROMALÍN '.$coloresCromalin.'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($cromalin,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRE-IMPRESIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalPreImpresion,0,'','.').'</td>
                            </tr>
                        </table>
                         <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6"><hr class="hr_punteada" /></td>
                            </tr>';
                            
							
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima2= $totalPlacaKilo+$totalPlacaKilo2;
								}else
								{
									$totalMateriaPrima2= $totalOndaKilo+$totalPlacaKilo;	
								}
							
                            $cuerpo.='
                             <tr>
                                <td class="celda_3">TOTAL MATERIA PRIMA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalMateriaPrima2,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRE-IMPRESIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalPreImpresion,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRODUCCIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalProduccion,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>';
							
							
                             /* $totalTotal=$totalMateriaPrima2+$totalPreImpresion+$totalProduccion+$totalCostosVarios;
                            $totalValorUnitario=$totalTotal/$datos->cantidad_1;
                              //$totalValorUnitario2=$totalTotal/$datos->cantidad_2;
                             //$totalValorUnitario3=$totalTotal/$datos->cantidad_3;
                            //$totalValorUnitario4=$totalTotal/$datos->cantidad_4;
                            $valorFinal=(($totalValorUnitario/(100-$presupuesto->margen))/100)*10000;
                           // $valorFinal2=(($totalValorUnitario2/(100-$presupuesto->margen))/100)*10000;
                           // $valorFinal3=(($totalValorUnitario3/(100-$presupuesto->margen))/100)*10000;
                          //  $valorFinal4=(($totalValorUnitario4/(100-$presupuesto->margen))/100)*10000;
						  */
						  
						  $totalTotal=$totalMateriaPrima2+$totalPreImpresion+$totalProduccion+$totalCostosVarios;
                          
                            $totalValorUnitario=$totalTotal/$datos->cantidad_1;
                            //$totalValorUnitario2=$totalTotal/$datos->cantidad_2;
                            //$totalValorUnitario3=$totalTotal/$datos->cantidad_3;
                            //$totalValorUnitario4=$totalTotal/$datos->cantidad_4;
							
                            $valorFinal=(($totalValorUnitario/(100-$hoja->margen))/100)*10000;
							

							 $valorFinal2xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_2,2);
							 $valorFinal3xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_3,3);
							 $valorFinal4xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_4,4);
						  
						  
						  
						  
						  
                            $cuerpo.='
                            <tr>
                                <td class="celda_3">TOTAL COSTOS VARIOS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalCostosVarios,0,'','.').'</td>
                                <td class="celda_3"><span class="subrayado">VALOR FINAL</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($valorFinal,0,'','.').'</td>
                                <!--
<td class="celda_3" colspan="3" rowspan="30">PRODUCCIÓN</td>
-->
                            </tr>';
							
							
							
                            $vcostoFinanciero=$this->variables_cotizador_model->getVariablesCotizadorPorId(33);
                            $recargoPorCantidadJusta=$this->variables_cotizador_model->getVariablesCotizadorPorId(37);
							
                            $valorFinanciado=$valorFinal*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							
                             //$valorFinanciado=$this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_1);
							
							
							/* $valorFinal2xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_2);
							 $valorFinal3xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_3);
							 $valorFinal4xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_4);
							 */
							
							$valorFinanciado2=$valorFinal2xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							$valorFinanciado3=$valorFinal3xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							$valorFinanciado4=$valorFinal4xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                           /*
						   $valorFinanciado2=$valorFinal2*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                            $valorFinanciado3=$valorFinal3*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                            $valorFinanciado4=$valorFinal4*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							*/
                            if($datos->acepta_excedentes=='NO')
                            {
                                $valorFinanciado=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado);
                                $valorFinanciado2=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado2);
                                $valorFinanciado3=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado3);
                                $valorFinanciado4=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado4);
                            }
								
							$cuerpo.='
                              <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                                <td class="celda_3">VALOR FINANCIADO '.$forma_pago->forma_pago.'('.$forma_pago->dias.')</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($valorFinanciado,0,'','.').'</td>
								
                            </tr>
								';
								if($hoja->valor_empresa==0)
                                {
                                    $valorEmpresa=$valorFinanciado;
                                }else
                                {
                                    $valorEmpresa=$hoja->valor_empresa;
                                }
                            $cuerpo.='
                            <tr>
                                <td class="celda_3">TOTAL</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalTotal,0,'','.').'</td>
                                <td class="celda_3">VALOR EMPRESA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($valorEmpresa,0,'','.').'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">DÍAS DE ENTREGA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.$hoja->dias_de_entrega.'</td>
                            </tr>

                            ';
							
							   if($hoja->valor_empresa_2 == 0)
                                {
                                    $valorEmpresa2=number_format($valorFinanciado2,0,'','.');               
                                }else
                                {
                                    $valorEmpresa2=$hoja->valor_empresa_2;
                                }
								
								if($hoja->valor_empresa_3 ==0)
                                {                                    
                                    $valorEmpresa3=number_format($valorFinanciado3,0,'','.');                                   
                                }else
                                {                              
                                    $valorEmpresa3=$hoja->valor_empresa_3;
                                }
								
								if($hoja->valor_empresa_4 ==0)
                                {
                                    $valorEmpresa4=number_format($valorFinanciado4,0,'','.');
                                }else
                                {
                                    $valorEmpresa4=$hoja->valor_empresa_4;
                                }
							
                           // if( $valorEmpresa2 == 0){echo number_format($valorFinanciado2,0,'','.');}else{echo $valorEmpresa2;}
							//if( $valorEmpresa3 == 0){echo number_format($valorFinanciado3,0,'','.');}else{echo $valorEmpresa3;}
							//if( $valorEmpresa4 == 0){echo number_format($valorFinanciado4,0,'','.');}else{echo $valorEmpresa4;}
							if($datos->cantidad_2 == 1)
							{
								$cantidad_2cero = 0;
								$valor_final2cero = 0;
								$valor_financiado2cero = 0;
								$valorEmpresa2cero = 0;
								
							}else{
								$cantidad_2cero = number_format($datos->cantidad_2,0,"",".");
								$valor_final2cero = number_format($valorFinal2xxx,0,"",".");
								$valor_financiado2cero = number_format($valorFinanciado2,0,"",".");
								$valorEmpresa2cero = number_format($valorEmpresa2,0,"",".");
							}
							
							if($datos->cantidad_3 == 1)
							{
								$cantidad_3cero = 0;
								$valor_final3cero = 0;
								$valor_financiado3cero = 0;
								$valorEmpresa3cero = 0;
								
							}else{
								$cantidad_3cero = number_format($$datos->cantidad_3,0,"",".");
								$valor_final3cero = number_format($valorFinal3xxx,0,"",".");
								$valor_financiado3cero = number_format($valorFinanciado3,0,"",".");
								$valorEmpresa3cero = number_format($valorEmpresa3,0,"",".");
							}
							
							if($datos->cantidad_4 == 1)
							{
								$cantidad_4cero = 0;
								$valor_final4cero = 0;
								$valor_financiado4cero = 0;
								$valorEmpresa4cero = 0;
								
							}else{
								$cantidad_4cero = number_format($$datos->cantidad_4,0,"",".");
								$valor_final4cero = number_format($valorFinal4xxx,0,"",".");
								$valor_financiado4cero = number_format($valorFinanciado4,0,"",".");
								$valorEmpresa4cero = number_format($valorEmpresa4,0,"",".");
							}
							
                            $cuerpo.='
                            <tr>
                                <td class="celda_3">VALOR UNITARIO</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.number_format($totalValorUnitario,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MARGEN</td>
                                <td class="celda_3">'.$hoja->margen.'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                       </table>
                        <div class="separador_20">&nbsp;</div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">CANTIDAD 2</td>
                                <td class="celda_3">'.$cantidad_2cero.'</td>
                                <td class="celda_3">CANTIDAD 3</td>
                                <td class="celda_3">'.$cantidad_3cero.'</td>
                                <td class="celda_3">CANTIDAD 4</td>
                                <td class="celda_3">'.$cantidad_4cero.'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3">'.$valor_final2cero.'</td>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3">'.$valor_final3cero.'</td>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3">'.$valor_final4cero.'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">VALOR FINANCIERO 2</td>
                                <td class="celda_3">'.$valor_financiado2cero.'</td>
                                <td class="celda_3">VALOR FINANCIERO 3</td>
                                <td class="celda_3">'.$valor_financiado3cero.'</td>
                                <td class="celda_3">VALOR FINANCIERO 4</td>
                                <td class="celda_3">'.$valor_financiado4cero.'</td>
                            </tr>
                            <tr>
                                <td class="celda_3">VALOR EMPRESA 2</td>
                                <td class="celda_3">'.$valorEmpresa2cero.'</td>
                                <td class="celda_3">VALOR EMPRESA 3</td>
                                <td class="celda_3">'.$valorEmpresa3cero.'</td>
                                <td class="celda_3">VALOR EMPRESA 4</td>
                                <td class="celda_3">'.$valorEmpresa4cero.'</td>
                            </tr>
                        </table>
                        <div class="separador_10">&nbsp;</div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MATERIAL</td>
                                <td class="celda_3">GRAMAJE</td>
                                <td class="celda_3">TOTAL PLIEGOS</td>
                                <td class="celda_3">EXTRA</td>
                                <td class="celda_3">TOTAL KILOS</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">'.$fotomecanica->materialidad_datos_tecnicos.'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
							';	
							
								if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
								$cuerpo.='

							<tr>
                                <td class="celda_3">TAPA</td>
                                <td class="celda_3">'.$tapaNombre.' ('.number_format($tapaPrecio,0,'','.').')</td>
                                <td class="celda_3">'.number_format($costoPlacaKilo,0,'','.').'</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'.number_format($valorPlacaKilo,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TAPA (RESPALDO) </td>
                                <td class="celda_3">'.$tapaNombre2.' ('.number_format($tapaPrecio2,0,'','.').')</td>
                                <td class="celda_3">'.number_format($costoPlacaKilo2,0,'','.').'</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'.number_format($valorPlacaKilo2,0,'','.').'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
									';
								}else{
									
							$cuerpo.='
                            <tr>
                                <td class="celda_3">TAPA</td>
                                <td class="celda_3">'.$tapaNombre.' ('.number_format($tapaPrecio,0,'','.').')</td>
                                <td class="celda_3">1.600</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'.$hoja->kilos_placa.'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">ONDA</td>
                                <td class="celda_3">'.$ondaNombre.' ('.number_format($ondaPrecio,0,'','.').')</td>
                                <td class="celda_3">1.600</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">'.$hoja->kilos_onda.'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">LINER</td>
                                <td class="celda_3">'.$linerNombre.' ('.number_format($linerPrecio,0,'','.').')</td>
                                <td class="celda_3">1.600</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">'.$hoja->kilos_liner.'</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
							';
								}
							
							
							if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
							{
								$recargo150 = '150';
								}else{
								$recargo150 = '100';
							}
							
							$cuerpo.='
                            <tr>
                                <td class="celda_3">FECHA TAPA: '.fecha_con_slash($tapaFecha).'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA ONDA: '.fecha_con_slash($ondaFecha).'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA LINER: '.fecha_con_slash($linerFecha).'</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">240</td>
                                <td class="celda_3">449.71</td>
                            </tr>
                        </table>    
                        <div class="separador_20"></div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_2">
                                   <!--
                                    CANTIDAD 0 : 3.000 TOTAL $400.247
                                    <br />
                                    CANTIDAD 1 : 3.000 TOTAL $393.782
                                    <br />
                                    CANTIDAD 2 : 3.000 TOTAL
                                    <br />
                                    CANTIDAD 3 : 3.000 TOTAL    
                                    -->
                                </td>
                                <td class="celda_1">&nbsp;</td>
                                <td class="celda_60 valign_top" rowspan="5">
                                    <!--mermas-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td colspan="4">Tabla de Patrón de MERMAS Micronda TIPO E + Tapa</td>
                                        </tr>
                                        <tr>
                                            <td>Imprenta</td>
                                            <td>Roland:800</td>
                                            <td>Roland:800</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Color 1-2-3</td>
                                            <td>300</td>
                                            <td>400</td>
                                            <td>&nbsp;</td>
                                            <td>'.$color1.'</td>
                                        </tr>
                                        <tr>
                                            <td>Color &gt; 3</td>
                                            <td>'.$recargo150.'</td>
                                            <td>'.$recargo150.'</td>
                                            <td>* Color</td>
                                            <td>'.$color2.'</td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td>'.$can1.'</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>050</td>
                                            <td>075</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td>'.$can2.'</td>
                                        </tr>
                                        <tr>
                                            <td>Barniz</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Primeros 1.000</td>
                                            <td>'.$bar1.'</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000 extra</td>
                                            <td>'.$bar2.'</td>
                                        </tr>
                                        <tr>
                                            <td>Laca</td>
                                            <td>025</td>
                                           <td>025</td>
                                            <td>una sola vez</td>
                                            <td>'.$laca.'</td>
                                        </tr>
                                        <tr>
                                            <td>Folia</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td>'.$folia.'</td>
                                        </tr>
                                        <tr>
                                            <td>Termolaminado</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>
                                            <td>'.$termolaminado.'</td>
                                        </tr>
                                        <tr>
                                            <td>Trabajo externo</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>
                                            <td>'.$externo.'</td>
                                        </tr>
                                        <tr>
                                            <td>Micro/Micro</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td>'.$micromicro.'</td>
                                        </tr>
                                        <tr>
                                            <td>Cart/Cart</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td>'.$cartulina.'</td>
                                        </tr>
                                        <tr>
                                            <td>Tamaños Normales</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Emplacado</td>
                                            <td>015</td>
                                            <td>015</td>
                                            <td>por cada 1.000</td>
                                            <td>'.$emplacado.'</td>
                                        </tr>
                                        <tr>
                                            <td>Troquelado</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000</td>
                                            <td>'.$troquelado.'</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><hr class="hr_punteada_corto" /></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>'.number_format($sum).'</td>
                                        </tr>
                                    </table>
                                    <!--/mermas-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2"></td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </header>
        </div>
        ';
        $cuerpo.='</body>
</html>';
		//echo $cuerpo;exit;
		//$mpdf=new mPDF('c'); 
        $this->mpdf->SetDisplayMode('fullpage');
        $css1 = file_get_contents('bootstrap/estilos.css');
        $css2 = file_get_contents('bootstrap/bootstrap.css');
        $this->mpdf->WriteHTML($css2,1);
        $this->mpdf->WriteHTML($css1,1);
        $this->mpdf->WriteHTML($cuerpo);
        $this->mpdf->Output();
    	exit;
        
        
	}    
	
	
	
	
	
	
	
	
}

