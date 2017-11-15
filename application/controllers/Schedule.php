<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends MY_Controller {

	/*
	 *
     * Schedule
	 *
	 */
    
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->output->set_title('OHEC : Schedule');
	}

	public function index()
	{
		$this->_init();
        $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
        $this->load->view('schedule/index');
	}
	
	public function view()
	{
		$this->_init();
        $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
        $this->load->view('schedule/view');
	}

	public function create()
	{
		$this->_init();
		$this->_init_assets( array('icheck','smartwizard','bootstrap-daterangepicker','bootstrap_validator','bootstrap_select') );
		
		// $this->load->library( array('Eform_action') );
		$this->load->model( array('Site_model'));
		
		//Load region
		$this->data['region'] = $this->Site_model->get_region();

		//Load checklist by asset_type and ma_type
		// $this->data['checklist'] = $this->eform_action->load_eform('equipment', 'pm');
		

		$this->load->view('schedule/create',$this->data);
	}  
	
	public function create_ops()
	{
		echo "<pre>"; print_r($_POST); echo "</pre>";
		$region = $provice = null;

		foreach($_POST['region'] as $r_key => $r_val):
			if(empty($region)){
				$region = $r_val;
			}else{
				$region = $region.",".$r_val;
			}
		endforeach;

		foreach($_POST['province'] as $p_key => $p_val):
			if(empty($province)){
				$province = $p_val;
			}else{
				$province = $province.",".$p_val;
			}
		endforeach;		
		
		$new = array(
			'id' => '1'
			,'description' => $_POST['description']
			,'region' => $region
			,'province' => $province
			// ,'start_date' => $start_date
			// ,'end_date' => $end_date
			// ,'ticket_start_date' => $ticket_start_date
			// ,'ticket_end_date' => $ticket_end_date
			,'created_date' => date("Y-m-d H:i:s",time())
			,'created_by' => 'wichaphon.sa'
			,'status' => '1'
		);
		
		echo "<pre>"; print_r($new); echo "</pre>";
	}

}