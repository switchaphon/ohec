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
		$this->output->set_title('ตารางตรวจงาน');

		//Fixed value
		$customdata = array(
			'username' => 'witchaphon.sa'
			,'cn' => 'อารีย์พรรณ จันทรทิณ'
			,'role' => 'User'
			,'logged_in' => TRUE
		);                            
		$this->session->set_userdata($customdata);		
	}

	public function index(){
		$this->_init();
		$this->_init_assets( array('datatables') );
		$this->load->model( array('Schedule_model'));

		//Get schedule
		$this->data['opened_schedule'] = $this->Schedule_model->list_opened_schedule();
		$this->data['joined_schedule'] = $this->Schedule_model->list_joined_schedule($this->session->userdata('cn'));

        $this->load->view('schedule/index',$this->data);
	}
	
	public function create(){
		$this->_init();
		$this->_init_assets( array('icheck','bootstrap-daterangepicker','bootstrap_validator','bootstrap_select') );
		
		// $this->load->library( array('Eform_action') );
		$this->load->model( array('Site_model'));
		
		//Get region
		$this->data['region'] = $this->Site_model->list_region();

		$this->load->view('schedule/create',$this->data);
	}  
	
	public function create_ops(){
		$this->load->model( array('Utilities_model','Schedule_model'));

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
			// ,'created_date' => date("Y-m-d H:i:s",time())
			,'created_by' => $this->session->userdata('cn')
			,'status' => '1'
		);
		
		$res = $this->Utilities_model->_insert_array('tb_schedule',$data);
		
		//Log

		//Redirect
		redirect( site_url('/schedule/view/'.$schedule_id) );
	}

	public function view($schedule_id = null){
		$this->_init();
		$this->_init_assets( array('datatables','bootstrap_validator','bootstrap_select') );
		$this->load->model( array('Schedule_model','Site_model','Eform_model'));

		//Get schedule
		$this->data['schedule'] = $this->Schedule_model->view_schedule($schedule_id);
		
		$province_list = str_replace("," , "','" , $this->data['schedule'][0]['province']);
		$this->data['ticket_start_date'] = $ticket_start_date = $this->data['schedule'] [0]['ticket_start_date'];
		$this->data['ticket_end_date'] = $ticket_end_date = $this->data['schedule'] [0]['ticket_end_date'];

		$this->data['form_list'] = $this->Eform_model->list_form();		
		$this->data['site_list'] = $this->Site_model->list_site_by_province($province_list,$ticket_start_date,$ticket_end_date,$schedule_id);
		$this->data['task_list'] = $this->Schedule_model->get_schedule_task($schedule_id);
		$this->data['committee_list'] = $this->Schedule_model->get_schedule_committee($schedule_id);
		$this->data['eform_list'] = $this->Eform_model->get_schedule_eform($schedule_id);
		

        $this->load->view('schedule/view',$this->data);
	}

	public function edit($schedule_id = null){
		$this->_init();
		$this->_init_assets( array('datatables','bootstrap_validator','bootstrap_select','bootstrap-daterangepicker') );
		$this->load->model( array('Schedule_model','Site_model','Eform_model'));

		//Get schedule
		$this->data['schedule'] = $this->Schedule_model->view_schedule($schedule_id);

		//Get region
		$this->data['region_list'] = $this->Site_model->list_region();

		//Get province
		$region = str_replace("," , "','" , $this->data['schedule'][0]['region']);
		$this->data['province_list'] = $this->Site_model->list_province_by_region($region);

		$province_list = str_replace("," , "','" , $this->data['schedule'][0]['province']);
		$this->data['ticket_start_date'] = $ticket_start_date = $this->data['schedule'] [0]['ticket_start_date'];
		$this->data['ticket_end_date'] = $ticket_end_date = $this->data['schedule'] [0]['ticket_end_date'];

		// $this->data['site_list'] = $this->Site_model->list_site_by_province($province_list);
		$this->data['site_list'] = $this->Site_model->list_site_by_province($province_list,$ticket_start_date,$ticket_end_date,$schedule_id);
		$this->data['task_list'] = $this->Schedule_model->get_schedule_task($schedule_id);
		$this->data['committee_list'] = $this->Schedule_model->get_schedule_committee($schedule_id);
		$this->data['eform_list'] = $this->Eform_model->get_schedule_eform($schedule_id);

        $this->load->view('schedule/edit',$this->data);
	}	

	public function edit_ops(){
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

		// $schedule_id = $this->Schedule_model->get_schedule_id(date("Ymd",time()));

		// if(!$schedule_id){
		// 	$schedule_id = date("Ymd",time())."01";
		// }else{
		// 	$schedule_id = $schedule_id + 1;
		// }

		$data = array(
			'schedule_id' => $_POST['schedule_id']
			,'schedule_name' => $_POST['name']
			,'schedule_description' => $_POST['description']
			,'region' => $region
			,'province' => $province
			,'start_date' => $start_date
			,'end_date' => $end_date
			,'ticket_start_date' => $ticket_start_date
			,'ticket_end_date' => $ticket_end_date
			,'updated_date' => date("Y-m-d H:i:s",time())
			// ,'updated_date' => date("Y-m-d H:i:s",time())
			,'updated_by' => $this->session->userdata('cn')
			// ,'status' => '1'
		);

		// echo "<pre>"; print_r($data); echo "</pre>";
		$res = $this->Schedule_model->_update_array('tb_schedule',$data);
		
		//Log

		//Redirect
		redirect( site_url('/schedule/view/'.$_POST['schedule_id']) );
	}	

	public function add_task_ops(){
		// echo "<pre>"; print_r($_POST); echo "</pre>";
		$this->load->model( array('Utilities_model','Ticket_model','Site_model','Schedule_model','Eform_model'));

		foreach($_POST['site'] as $key => $val):

			//Get site detail
			$site = $this->Site_model->view_site($_POST['site'][$key]);
			
			//Get ticket detail
			// $ticket = $this->Ticket_model->view_ticket($_POST['ticket'][$key]);
			
			//Validate contact name
			if( empty($site[0]['name']) AND empty($site[0]['surname']) ){
				$contact = NULL;
			}else{
				$contact = $site[0]['name']." ".$site[0]['surname'];
			}
			
			if(!empty($_POST['schedule_id'])){
				$schedule_id = $_POST['schedule_id'];
			}else{
				$schedule_id = $_POST['schedule'];
			}
			//Prepare data
			$destination = array(
				'schedule_id' => $schedule_id
				,'site_id' => $site[0]['site_id']
				,'province' => $site[0]['province']
				,'region' => $site[0]['region']
				,'contact_name' => $contact //what is contact more than 1
				,'contact_tel' => $site[0]['tel_no']
				,'contact_mobile' => $site[0]['mobile_no']
				,'contact_email' => $site[0]['email'] 
				// ,'created_date' => date(time())
				,'created_by' => $this->session->userdata('cn')
			);
			// echo "<pre>"; print_r($destination); echo "</pre>";

			for($task_no = 0; $task_no < count($_POST['task']); $task_no ++){

				//Check $schedule_id, $site[0]['site_id'] and $task[0]['form_id'] already exist or not. if not, it will be added
				$data = array(
					'schedule_id' => $schedule_id
					,'site_id' => $site[0]['site_id']
					,'ticket_id' => $_POST['task'][$task_no]
				);
				$row = $this->Utilities_model->_count_row('tb_schedule_task',$data);
				
				if($row == 0){				
					//Get form's detail
					$task = $this->Eform_model->view_form($_POST['task'][$task_no]);

					//Prepare $task_data
					$task_data = array(
						'schedule_id' => $schedule_id
						,'site_id' => $site[0]['site_id']
						// ,'ma_project' => $task[0]['asset_type']
						,'ticket_id' => $task[0]['form_id']
						// ,'ma_type' => $task[0]['ma_type']
						// ,'created_date' => date(time())
						,'created_by' => $this->session->userdata('cn')
					);

					//Insert DB
					$res = $this->Utilities_model->_insert_array('tb_schedule_task',$task_data);							
				}
			}

			//Check destination of this schedule
			$destination_list = $this->Schedule_model->get_schedule_destination($schedule_id);
			
			if(!empty($destination_list )){
				if ( !in_array($site[0]['site_id'], $destination_list) ) {
					//Insert destination
					$this->Utilities_model->_insert_array('tb_schedule_destination',$destination);
				}
			}else{
				//Insert destination
				$this->Utilities_model->_insert_array('tb_schedule_destination',$destination);
			}

		// 	//Insert DB
		// 	$res = $this->Utilities_model->_insert_array('tb_schedule_task',$task);

		// 	// echo $res;

		endforeach;
		
		//Log

		//Redirect
		redirect( site_url('/schedule/view/'.$schedule_id) );
		
	}

	public function join_schedule_ops(){
		
		$this->load->model( array('Utilities_model'));
		// echo "<pre>"; print_r($_POST); echo "</pre>";
		//Prepare data
		$committee = array(
			'schedule_id' => $_POST['schedule_id']
			,'name' => $_POST['name']
		);

		//Insert DB
		$res = $this->Utilities_model->_insert_array('tb_schedule_member',$committee);
		
		// echo $res;
				
		//Log

		//Redirect
		redirect( site_url('/schedule/view/'.$_POST['schedule_id']) );
	}

	public function disjoin_schedule_ops(){
		
		$this->load->model( array('Utilities_model'));
		// echo "<pre>"; print_r($_POST); echo "</pre>";
		//Prepare data
		$committee = array(
			'schedule_id' => $_POST['schedule_id']
			,'name' => $_POST['name']
		);

		//Insert DB
		$res = $this->Utilities_model->_delete('tb_schedule_member',$committee);
		
		// echo $res;
				
		//Log

		//Redirect
		redirect( site_url('/schedule/view/'.$_POST['schedule_id']) );
	}

	public function cancel_task_ops(){
		
		$this->load->model( array('Utilities_model'));

		//Prepare data
		$task = array(
			'schedule_id' => $_POST['schedule_id']
			,'site_id' => $_POST['site_id']
			,'ticket_id' => $_POST['ticket_id']
		);

		$site = array(
			'schedule_id' => $_POST['schedule_id']
			,'site_id' => $_POST['site_id']
		);

		//Count row for selected value 
		$row = $this->Utilities_model->_count_row('tb_schedule_task',$site);	

		//if 'schedule_id' + 'site_id' in tb_schedule_task = 1 then delete 'site_id' from tb_schedule_destination as well
		if($row == 1){
			// echo "Delete both tb_schedule_destination & tb_schedule_task";
			$this->Utilities_model->_delete('tb_schedule_destination',$site);
			$this->Utilities_model->_delete('tb_schedule_task',$task);
		}else{
			// echo "Delete only tb_schedule_task";
			$this->Utilities_model->_delete('tb_schedule_task',$task);
		}

		// echo $res;
				
		//Log

		//Redirect
		redirect( site_url('/schedule/view/'.$_POST['schedule_id']) );
	}
}
?>