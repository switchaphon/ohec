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
		$this->load->helper(array('form', 'url' , 'datetime_helper'));
		$this->output->set_title('OHEC : Schedule');
	}

	public function index()
	{
		$this->_init();
		$this->_init_assets( array('datatables') );
		$this->load->model( array('Schedule_model'));

		//Get schedule
		$this->data['schedule'] = $this->Schedule_model->list_open_schedule();

        $this->load->view('schedule/index',$this->data);
	}
	
	public function view($id = null)
	{
		$this->_init();
		$this->_init_assets( array('datatables','bootstrap_validator','bootstrap_select') );
		$this->load->model( array('Schedule_model','Site_model'));

		//Get schedule
		$this->data['schedule'] = $this->Schedule_model->view_schedule($id);
		
		$province_list = str_replace("," , "','" , $this->data['schedule'][0]['province']);

		$this->data['site_list'] = $this->Site_model->list_site_by_province($province_list);
		$this->data['task_list'] = $this->Schedule_model->get_schedule_task($id);

        $this->load->view('schedule/view',$this->data);
	}

	public function create()
	{
		$this->_init();
		$this->_init_assets( array('icheck','smartwizard','bootstrap-daterangepicker','bootstrap_validator','bootstrap_select') );
		
		// $this->load->library( array('Eform_action') );
		$this->load->model( array('Site_model'));
		
		//Get region
		$this->data['region'] = $this->Site_model->list_region();

		//Load checklist by asset_type and ma_type
		// $this->data['checklist'] = $this->eform_action->load_eform('equipment', 'pm');
		

		$this->load->view('schedule/create',$this->data);
	}  
	
	public function create_ops()
	{
		$this->load->model( array('Schedule_model'));

		// echo "<pre>"; print_r($_POST); echo "</pre>";
		$region = $provice = null;
		
		//Region
		foreach($_POST['region'] as $r_key => $r_val):
			if(empty($region)){
				$region = $r_val;
			}else{
				$region = $region.",".$r_val;
			}
		endforeach;

		//Province
		foreach($_POST['province'] as $p_key => $p_val):
			if(empty($province)){
				$province = $p_val;
			}else{
				$province = $province.",".$p_val;
			}
		endforeach;		

		//Schedule date
		$start_date = explode(" - ",$_POST['schedule-time'])[0];
		$end_date = explode(" - ",$_POST['schedule-time'])[1];

		//Ticket date
		$ticket_start_date = explode(" - ",$_POST['ticket-time'])[0];
		$ticket_end_date = explode(" - ",$_POST['ticket-time'])[1];

		$schedule_id = $this->Schedule_model->get_schedule_id(date("Ymd",time()));

		if(!$schedule_id){
			$schedule_id = date("Ymd",time())."01";
		}else{
			$schedule_id = $schedule_id + 1;
		}

		$data = array(
			'schedule_id' => $schedule_id
			,'schedule_name' => $_POST['name']
			,'schedule_description' => $_POST['description']
			,'region' => $region
			,'province' => $province
			,'start_date' => $start_date
			,'end_date' => $end_date
			,'ticket_start_date' => $ticket_start_date
			,'ticket_end_date' => $ticket_end_date
			,'created_date' => date("Y-m-d H:i:s",time())
			,'created_by' => 'wichaphon.sa'
			,'status' => '1'
		);
		
		$res = $this->Schedule_model->_insert_array('tb_schedule',$data);
		
		//Log

		//Redirect
		$x = '/schedule/view/'.$schedule_id;
		// redirect('schedule/view');
		redirect($x,'refresh');	
	}

	public function add_task( $id = null)
	{
		$this->_init('modal');
		// $this->_init_assets( array('bootstrap_validator','bootstrap_select') );
		$this->load->model( array('Schedule_model','Site_model'));
		
		//Get schedule
		$schedule = $this->Schedule_model->view_schedule($id);

		//Get provice list
		$province_list = str_replace("," , "','" , $schedule[0]['province']);
		$this->data['site_list'] = $this->Site_model->list_site_by_province($province_list);

		$this->load->view('schedule/add_task_modal',$this->data);
		
		//Log

		//Redirect
	}


}