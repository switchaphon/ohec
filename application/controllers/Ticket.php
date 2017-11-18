<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends MY_Controller {

	/*
	 *
     * Ticket
	 *
	 */
    
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->output->set_title('OHEC : Site');
	}

    //JSON
    function list_ticket_by_site()
	{   
        $this->load->model( array('Ticket_model'));
		echo(json_encode($this->Ticket_model->list_ticket_by_site($_POST['site'],$_POST['ticket_start_date'],$_POST['ticket_end_date'])));
	}

}