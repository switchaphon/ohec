<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

	/*
	 *
     * Site
	 *
	 */
    
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->output->set_title('OHEC : Site');
	}

	// public function index()
	// {
	// 	$this->_init();
    //     $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
    //     $this->load->view('schedule/index');
	// }
	
	// public function view()
	// {
	// 	$this->_init();
    //     $this->_init_assets( array('datatables', 'icheck', 'jszip', 'pdfmake') );
    //     $this->load->view('schedule/view');
	// }

	// public function create()
	// {
	// 	$this->_init();
	// 	$this->_init_assets( array('icheck','smartwizard','bootstrap-daterangepicker','bootstrap_validator','bootstrap_select') );
	// 	$this->load->library( array('Eform_action') );
	// 	$this->load->model( array('Site_model','Eform_model'));
		
	// 	//Load region
	// 	$this->data['region'] = $this->Site_model->get_region();

	// 	//Load province
	// 	$this->data['province'] = $this->Site_model->get_province();

	// 	$this->load->view('schedule/create',$this->data);
    // }   

    //JSON
    function get_province_by_region()
	{
        // echo $_POST['region'];
        $this->load->model( array('Site_model'));
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->Site_model->get_province_by_region($_POST['region'])));
	}

}