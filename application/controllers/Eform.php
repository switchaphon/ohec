<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eform extends MY_Controller {

	/*
	 *
     * e-Form 
	 *
	 */
    
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->output->set_title('OHEC : eForm');
	}

	public function index()
	{
		$this->_init();
        $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
        $this->load->view('eform/index');
	}
	
	public function view()
	{
		$this->_init();
        $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
        $this->load->view('eform/view');
	}

	public function create($schedule_id = null,$ticket_id = null)
	{
		$this->_init();
		$this->_init_assets( array('icheck','smartwizard') );
		$this->load->library( array('Eform_action') );
		$this->load->model( array('Eform_model','Ticket_model'));
		
		//Get ticket's detail
		$ticket = $this->Ticket_model->view_ticket($ticket_id);
		
		$this->data['schedule_id'] = $schedule_id;
		$this->data['site_id'] = $ticket[0]['site_id'];
		$this->data['ticket_id'] = $ticket_id;
		$this->data['case_category'] = $ticket[0]['case_category'];
		$this->data['case_sub_category'] = $ticket[0]['case_sub_category'];
		$this->data['ma_type'] = 'pm'; //Should be get from ticket database
		$this->data['ma_contract'] = $ticket[0]['contract'];
		// echo $this->data['case_category'].$this->data['case_sub_category'];
		// echo $this->data['case_category']; echo strpos($this->data['case_category'], 'Equipment');
		switch (true) {
			
			case strpos($this->data['case_category'], 'Equipment') !== false:
			case strpos($this->data['case_category'], 'equipment') !== false:
			case strpos($this->data['case_category'], 'Equip') !== false:
			case strpos($this->data['case_category'], 'equip') !== false:
				$asset_group = "equipment";
				echo $this->data['case_sub_category'];
				switch(true){
					case strpos($this->data['case_sub_category'], 'Router') !== false:
						$asset_type = "Router";
						break;
					case strpos($this->data['case_sub_category'], 'Switch') !== false:
						$asset_type = "Switch";
						break;	
					case strpos($this->data['case_sub_category'], 'UPS') !== false:
						$asset_type = "UPS";
						break;	
					case strpos($this->data['case_sub_category'], 'CCTV') !== false:
						$asset_type = "CCTV";
						break;	
					case strpos($this->data['case_sub_category'], 'DWDM') !== false:
						$asset_type = "DWDM";
						break;	
					case strpos($this->data['case_sub_category'], 'เครื่องบริการแม่ข่าย') !== false:
					case strpos($this->data['case_sub_category'], 'Server') !== false:
						$asset_type = "Server";
						break;																	
				}
				break;
			case strpos($this->data['case_category'], 'Fiber') !== false:
			case strpos($this->data['case_category'], 'fiber') !== false:
				$asset_group = "fiber";
				switch(true){
					case strpos($this->data['case_sub_category'], 'เครือข่ายแกนหลัก') !== false:
						$asset_type = "P1";
						break;
					case strpos($this->data['case_sub_category'], 'เครือข่ายกระจาย') !== false:
						$asset_type = "P2";
						break;	
					case strpos($this->data['case_sub_category'], 'เครือข่ายปลายทาง') !== false:
						$asset_type = "P3";
						break;																	
				}
				break;
		}	
		echo $asset_group.$asset_type;
		
		//Load checklist by asset_type and ma_type
		$this->data['checklist'] = $this->eform_action->load_eform($asset_group,$asset_type, $this->data['ma_type']);
		
		$this->load->view('eform/create',$this->data);
	}   
	
	public function create_ops(){
		echo "<pre>"; print_r($_POST); echo "</pre>";
	}

}