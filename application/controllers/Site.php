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

    //JSON
    function list_province_by_region()
	{
		$region = str_replace("," , "','" , $_POST['region']);

        $this->load->model( array('Site_model'));
		echo(json_encode($this->Site_model->list_province_by_region($region)));
	}

}