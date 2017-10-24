<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ef extends MY_Controller {

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
        $this->load->view('ef/index');
    }
    
    // public function create()
	// {
	// 	$this->_init();
    //     // $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
    //     $this->load->view('ef/create');
    // }
    
    // public function create2()
	// {
	// 	$this->_init();
    //     $this->_init_assets( array('smartwizard') );
    //     $this->load->view('ef/create2');
    // }
    
    // public function create3()
	// {
	// 	$this->_init();
    //     $this->_init_assets( array('smartwizard') );
    //     $this->load->view('ef/create3');
	// }
	
	public function equip()
	{
		$this->_init();
        $this->_init_assets( array('icheck','smartwizard') );
        $this->load->view('ef/equip_eform');
    }
	
	public function fibre()
	{
		$this->_init();
        $this->_init_assets( array('icheck','smartwizard') );
        $this->load->view('ef/fibre_eform');
	}
	
	public function fibre_cm()
	{
		// $this->_init();
		$this->_init_assets( array('icheck','smartwizard') );
		$this->load->library( array('Ef_action') );
		$this->load->model('Ef_model');
		
		$this->ef_action->load_checklist('fibre', 'cm');
		$this->data['form'] = $this->ef_model->get_form();
		
		$this->load->view('ef/fibre_cm',$this->data);
	}

}