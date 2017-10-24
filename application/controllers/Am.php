<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Am extends MY_Controller {

	/*
	 *
     * e-Form 
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->output->set_title('OHEC : Asset Management');
	}

	// public function index()
	// {
	// 	$this->_init();
    //     $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
    //     $this->load->view('am/index');
    // }

	public function equip()
	{
		$this->_init();
        $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
        $this->load->view('am/equip_index');
    }
	
	public function fibre()
	{
		$this->_init();
        $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
        $this->load->view('am/fibre_index');
	}
	

}