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

	public function create()
	{
		$this->_init();
		$this->_init_assets( array('icheck','smartwizard') );
		$this->load->library( array('Eform_action') );
		$this->load->model('Eform_model');
		
		//Load checklist by asset_type and ma_type
		$this->data['checklist'] = $this->eform_action->load_eform('equipment', 'pm');
		
		$this->load->view('eform/create',$this->data);
    }   

}