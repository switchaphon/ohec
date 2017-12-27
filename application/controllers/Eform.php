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
		$this->_only_authen_success();
		$this->load->helper(array('form','url','file'));
		$this->output->set_title('แบบตรวจสอบออนไลน์');
		$this->data['permission'] = $this->get_permission();
	}

	public function index(){
		$this->_init();
		$this->_init_assets( array('datatables','bootstrap-daterangepicker','bootstrap_select') );
		$this->load->model( array('Eform_model','Schedule_model'));
		
		$this->data['total_eform'] = $this->data['passed_eform'] = $this->data['not_passed_eform'] = 0;
		
		// echo "<pre>"; print_r($_POST); echo "</pre>";
		if( !empty($_POST) ){
			$this->data['all_eform_list'] = $this->Eform_model->get_all_eform_by_period($_POST['eform-time']);	
			$this->data['passed_eform_list'] = $this->Eform_model->get_passed_eform_by_period($_POST['eform-time']);	
			$this->data['not_passed_eform_list'] = $this->Eform_model->get_not_passed_eform_by_period($_POST['eform-time']);	
		}else{
			$this->data['all_eform_list'] = $this->Eform_model->get_all_eform();
			$this->data['passed_eform_list'] = $this->Eform_model->get_passed_eform();
			$this->data['not_passed_eform_list'] = $this->Eform_model->get_not_passed_eform();
		}
		// print_r($this->data['all_eform_list']);
		// print_r($this->data['passed_eform_list']);
		// print_r($this->data['not_passed_eform_list']);

		// echo $this->data['total_eform']." ".$this->data['passed_eform']." ".$this->data['not_passed_eform']."<BR>"; 
		
		$this->data['total_eform'] = count($this->data['all_eform_list']);
		$this->data['passed_eform'] = count($this->data['passed_eform_list']);
		$this->data['not_passed_eform'] = count($this->data['not_passed_eform_list']);

		// echo $this->data['total_eform']." ".$this->data['passed_eform']." ".$this->data['not_passed_eform']."<BR>"; 
		$schedule_list = $this->Schedule_model->list_opened_schedule();
		// echo "<pre>"; print_r($schedule_list ); echo "</pre>";
		$this->data['schedule_list'] = array();
		foreach( $schedule_list as $key => $val):
			$start_date = date("Y-m-d",strtotime($val['start_date']));
			$end_date = date("Y-m-d",strtotime($val['end_date']));

			if( empty( $this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ]  ) ){
				// if( empty( $this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date]  ) ){
					// $this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date] = $start_date." ".$end_date;
				// }else{
					$this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date] = array($start_date." ".$end_date);
					// $this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date];
					// );				
				// }
			}else{
				// if( empty( $this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date]  ) ){
					// $this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date] = array( 
					// 	'xxx' => $start_date." ".$end_date
					// );
				// }else{
					$this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date] = array($start_date." ".$end_date);			
					// $this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date];			
				// }
			}

		endforeach;

		// echo "<pre>"; print_r($this->data['schedule_list']); echo "</pre>";
		$this->load->view('eform/index',$this->data);
	}
	
	public function view($eform_id = null){
		$this->_init();
		$this->_init_assets( array('datatables', 'icheck', 'pdfmake') );
		$this->load->library( array('Eform_action') );
		$this->load->model( array('Schedule_model','Eform_model','Ticket_model'));
		


		//--Get eform
		$this->data['eform'] = $this->Eform_model->view_eform($eform_id);
		$this->data['eform_checklist'] = $this->Eform_model->view_eform_checklist($eform_id);
		$this->data['eform_checklist_answer'] = $this->Eform_model->view_eform_checklist_answer($eform_id);
		$this->data['eform_attachment'] = $this->Eform_model->view_eform_attachment($eform_id);
		$this->data['eform_note'] = $this->Eform_model->view_eform_note($eform_id);

		//--Get schedule
		$this->data['schedule'] = $this->Schedule_model->view_schedule($this->data['eform'][0]['schedule_id']);
		$this->data['ticket'] = $this->Ticket_model->list_ticket_by_eform($this->data['eform'][0]['site_id'],$this->data['eform'][0]['asset_type'],$this->data['schedule'][0]['ticket_start_date'],$this->data['schedule'][0]['ticket_end_date']);


		$this->load->view('eform/view',$this->data);
	}

	public function create($schedule_id = null, $site_id = null, $form_id = null){
		$this->_init();
		$this->_init_assets( array('icheck','bootstrap-fileinput','datatables') );
		$this->load->library( array('Eform_action') );
		$this->load->model( array('Eform_model','Site_model','Schedule_model','Ticket_model'));
		
		//Get schedule's detail
		$schedule = $this->Schedule_model->view_schedule($schedule_id);

		//Get site detail
		$site = $this->Site_model->view_site($site_id);

		//Get form's detail
		$form = $this->Eform_model->view_form($form_id);



		$this->data['schedule_id'] = $schedule[0]['schedule_id'];
		$this->data['schedule_name'] = $schedule[0]['schedule_name'];
		$this->data['site_id'] = $site[0]['site_id'];
		$this->data['site_name'] = $site[0]['site_name'];
		$this->data['province'] = $site[0]['province'];
		$this->data['contact'] = $site[0]['name']." ".$site[0]['surname'];
		// $this->data['ticket_id'] = $ticket_id;
		// $this->data['case_category'] = $ticket[0]['case_category'];
		// $this->data['case_sub_category'] = $ticket[0]['case_sub_category'];
		$this->data['asset_type'] = $form[0]['asset_type'];
		$this->data['ma_type'] = $form[0]['ma_type'];
		$this->data['ma_name'] = $form[0]['ma_name'];

		//Get ticket
		$this->data['ticket'] = $this->Ticket_model->list_ticket_by_eform($site[0]['site_id'],$this->data['asset_type'],$schedule[0]['ticket_start_date'],$schedule[0]['ticket_end_date']);
				
		// $this->data['ma_contract'] = $ticket[0]['contract'];

		// switch (true) {
			
		// 	case strpos($this->data['case_category'], 'Equipment') !== false:
		// 	case strpos($this->data['case_category'], 'equipment') !== false:
		// 	case strpos($this->data['case_category'], 'Equip') !== false:
		// 	case strpos($this->data['case_category'], 'equip') !== false:
		// 		$asset_group = "equipment";
		// 		// echo $this->data['case_sub_category'];
		// 		switch(true){
		// 			case strpos($this->data['case_sub_category'], 'Router') !== false:
		// 				$asset_type = "Router";
		// 				break;
		// 			case strpos($this->data['case_sub_category'], 'Switch') !== false:
		// 				$asset_type = "Switch";
		// 				break;	
		// 			case strpos($this->data['case_sub_category'], 'UPS') !== false:
		// 				$asset_type = "UPS";
		// 				break;	
		// 			case strpos($this->data['case_sub_category'], 'CCTV') !== false:
		// 				$asset_type = "CCTV";
		// 				break;	
		// 			case strpos($this->data['case_sub_category'], 'DWDM') !== false:
		// 				$asset_type = "DWDM";
		// 				break;	
		// 			case strpos($this->data['case_sub_category'], 'เครื่องบริการแม่ข่าย') !== false:
		// 			case strpos($this->data['case_sub_category'], 'Server') !== false:
		// 				$asset_type = "Server";
		// 				break;																	
		// 		}
		// 		break;
		// 	case strpos($this->data['case_category'], 'Fiber') !== false:
		// 	case strpos($this->data['case_category'], 'fiber') !== false:
		// 		$asset_group = "fiber";
		// 		switch(true){
		// 			case strpos($this->data['case_sub_category'], 'เครือข่ายแกนหลัก') !== false:
		// 				$asset_type = "P1";
		// 				break;
		// 			case strpos($this->data['case_sub_category'], 'เครือข่ายกระจาย') !== false:
		// 				$asset_type = "P2";
		// 				break;	
		// 			case strpos($this->data['case_sub_category'], 'เครือข่ายปลายทาง') !== false:
		// 				$asset_type = "P3";
		// 				break;																	
		// 		}
		// 		break;
		// }	

		//Load checklist by asset_type and ma_type
		$this->data['checklist'] = $this->eform_action->load_form($this->data['asset_type'], $this->data['ma_type']);
		
		$this->load->view('eform/create',$this->data);
	}   
	
	public function create_ops(){
		
		$this->load->library('upload');

		// echo "<pre>"; print_r($_POST); echo "</pre>";
		// echo "<pre>"; print_r($_FILES); echo "</pre>";

		$this->load->library( array('Utilities') );
		$this->load->model( array('Utilities_model','Eform_model'));

		//Initiate eform_id
		$eform_id = $this->Eform_model->get_eform_id(date("Ymd",time()));
		
		if(!$eform_id){
			$eform_id = date("Ymd",time())."01";
		}else{
			$eform_id = $eform_id + 1;
		}

		//Prepate date for insert to tb_eform
		$eform = array(
			'eform_id' => $eform_id
			,'schedule_id' => $_POST['schedule_id']
			,'site_id' => $_POST['site_id']
			// ,'ticket_id' => $_POST['ticket_id']
			,'form_id' => $_POST['form_id']
			,'created_by' => $this->session->userdata('name')." ".$this->session->userdata('surname')
			,'status' => '1'
		);

		// echo "<pre>"; print_r($eform); echo "</pre>";
		$res = $this->Utilities_model->_insert_array('tb_eform',$eform);

		$question = $this->Eform_model->load_question($_POST['form_id']);
		
		foreach($question as $key => $val):
			if($val['question_type'] != 'dropbox'){
				if(isset($_POST[$val['question_name']])){
					//Prepate date for insert to tb_eform_checklist
					$eform_checklist = array(
						'eform_id' => $eform_id
						,'form_id' => $_POST['form_id']
						,'page_no' => $_POST['page_no']
						// ,'panel_no' => $val['panel_no']
						,'question_no' => $val['question_no']
						,'answer_value' => $_POST[$val['question_name']]
					);

					// echo "<pre>"; print_r($eform_checklist); echo "</pre>";
					$res = $this->Utilities_model->_insert_array('tb_eform_checklist',$eform_checklist);
				}
			}else{
				//Read each file and upload file to folder
				if( !empty($_FILES[$val['question_name']]['name'][0]) ){
					for($i = 0; $i < count($_FILES[$val['question_name']]['name']); $i++){
						// echo $i;

						$_FILES['uploadfile']['name'] = $_FILES[$val['question_name']]['name'][$i];
						$_FILES['uploadfile']['type'] = $_FILES[$val['question_name']]['type'][$i];
						$_FILES['uploadfile']['tmp_name'] = $_FILES[$val['question_name']]['tmp_name'][$i];
						$_FILES['uploadfile']['error'] = $_FILES[$val['question_name']]['error'][$i];
						$_FILES['uploadfile']['size'] = $_FILES[$val['question_name']]['size'][$i];

						//Read uploaded file
						$uploadedFile = 'uploadfile';

						//Prepare upload config
						$config['upload_path'] = 'files/eform';
						$config['allowed_types'] = 'jpg|jpeg|png|gif';
						$config['file_name'] = $eform_id;
						$config['overwrite'] = FALSE;
						$config['encrypt_name'] = TRUE;
						// $config['max_size'] = '5120';
						$config['width'] = 75;
						$config['height'] = 50;

						//Upload file
						$alert_msg = $this->utilities->upload($uploadedFile,$config);
						// echo "<pre>"; print_r($alert_msg); echo "</pre>";
						$eform_attachment = array(
							'eform_id' => $eform_id
							,'form_id' => $_POST['form_id']
							,'page_no' => $_POST['page_no']
							// ,'panel_no' => $val['panel_no']
							,'question_no' => $val['question_no']
							,'attachment_type' => $alert_msg[0]['result']['image_type']
							,'attachment_path' => $alert_msg[0]['result']['file_name']
						);

						// echo "<pre>"; print_r($eform_attachment); echo "</pre>";
						$res = $this->Utilities_model->_insert_array('tb_eform_attachment',$eform_attachment);

					}
				}
			}
		endforeach;

		//Log

		// Redirect
		redirect( site_url('/schedule/view/'.$_POST['schedule_id']));


	}

	public function add_note_ops(){

		$this->load->model( array('Utilities_model'));

		//Prepate date for insert to tb_eform
		$eform_note = array(
			'eform_id' => $_POST['eform_id']
			,'note_detail' => $_POST['note']
			,'created_by' => $this->session->userdata('name')." ".$this->session->userdata('surname')
		);

		// echo "<pre>"; print_r($eform); echo "</pre>";
		$res = $this->Utilities_model->_insert_array('tb_eform_note',$eform_note);

		redirect( site_url('/eform/view/'.$_POST['eform_id']));
	}

	public function disable_eform_ops(){
		
		// print_r($_POST);

		$this->load->model( array('Eform_model'));

		$res = $this->Eform_model->disable_eform($_POST['eform_id']);

		if($_POST['called_page'] == "schedule"){
			redirect( site_url('/schedule/view/'.$_POST['schedule_id']));
			
		}elseif($_POST['called_page'] == "eform"){
			redirect( site_url('/eform/index/'));
		}
	}

}