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
	// 	$this->data['region'] = $this->Site_model->list_region();

	// 	//Load province
	// 	$this->data['province'] = $this->Site_model->list_province();

	// 	$this->load->view('schedule/create',$this->data);
    // }   

    //JSON
    function list_province_by_region()
	{
		// Solution I //
		// $region = null;
		// $i = 0;		
		// $post = explode(',',$_POST['region']);

		// foreach($post as $key => $val):	
		// 	if($i == 0){
		// 		$region = "'".$val."'";
		// 	}else{
		// 		$region = $region.",'".$val."'";
		// 	}

		// 	$i++;
		// endforeach;

		// Solution II //
		$region = str_replace("," , "','" , $_POST['region']);

        $this->load->model( array('Site_model'));
		echo(json_encode($this->Site_model->list_province_by_region($region)));
	}

}