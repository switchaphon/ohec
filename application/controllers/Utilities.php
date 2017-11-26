<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends MY_Controller {

	/*
	 *
     * Utilities
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
	
	public function upload()
	{

	}

	


}