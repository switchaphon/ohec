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
		
		$this->load->library( array('Eform_action') );
		// $this->load->model('Site_model');
		$this->load->model( array('Site_model','Eform_model'));
		
		//Load region
		$this->data['region'] = $this->Site_model->get_region();

		//Load province
		$this->data['province'] = $this->Site_model->get_province();

		//Load checklist by asset_type and ma_type
		// $this->data['checklist'] = $this->eform_action->load_eform('equipment', 'pm');
		
		$this->load->view('schedule/create',$this->data);
    }   

}