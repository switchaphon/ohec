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

		switch (true) {
			case strpos($this->data['case_category'], 'Equipment') >= 0:
			case strpos($this->data['case_category'], 'equipment') >= 0:
			case strpos($this->data['case_category'], 'Equip') >= 0:
			case strpos($this->data['case_category'], 'equip') >= 0:
				$asset = "equipment";
				break;
			case strpos($this->data['case_category'], 'Fiber') >= 0:
			case strpos($this->data['case_category'], 'fiber') >= 0:
				$asset = "fiber";
				break;
		}	

		//Load checklist by asset_type and ma_type
		$this->data['checklist'] = $this->eform_action->load_eform($asset, $this->data['ma_type']);
		
		$this->load->view('eform/create',$this->data);
    }   

}