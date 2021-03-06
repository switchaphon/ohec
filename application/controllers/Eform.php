<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eform extends MY_Controller {

	/*
	 *
     * e-Form 
	 *
	 */
	private $_uploaded;
	
	public function __construct() {
		parent::__construct();
		$this->_only_authen_success();
		$this->load->helper(array('form','url','file','log4php'));
		$this->output->set_title('ใบตรวจงาน');
		$this->data['permission'] = $this->get_permission();
	}

	public function index($schedule = null){
		$this->_init();
		$this->_init_assets( array('datatables','bootstrap-daterangepicker','bootstrap_select','pdfmake','jszip') );
		$this->load->model( array('Eform_model','Schedule_model'));
		
		$this->data['total_eform'] = $this->data['passed_eform'] = $this->data['not_passed_eform'] = 0;
		
		// echo "<pre>"; print_r($_POST); echo "</pre>";
		
		if( !empty($schedule) ){
			$this->data['all_eform_list'] = $this->Eform_model->get_all_eform_by_schedule(urldecode($schedule));	
			$this->data['passed_eform_list'] = $this->Eform_model->get_passed_eform_by_schedule(urldecode($schedule));	
			$this->data['not_passed_eform_list'] = $this->Eform_model->get_not_passed_eform_by_schedule(urldecode($schedule));
			$this->data['fixed_eform_list'] = $this->Eform_model->get_fixed_eform_by_schedule(urldecode($schedule));
			// $this->data['not_passed_cause_list'] = $this->Eform_model->get_not_passed_cause(urldecode($schedule));
			$this->data['schedule_title'] = str_replace('.','/',$schedule);	
		}else{
			$this->data['all_eform_list'] = $this->Eform_model->get_all_eform();
			$this->data['passed_eform_list'] = $this->Eform_model->get_passed_eform();
			$this->data['not_passed_eform_list'] = $this->Eform_model->get_not_passed_eform();
			$this->data['fixed_eform_list'] = $this->Eform_model->get_fixed_eform();
			
			$this->data['schedule_title'] = "ทั้งหมด";
		}
		$this->output->set_title('ใบตรวจงาน'.urldecode($this->data['schedule_title']) );
		$this->data['total_eform'] = count($this->data['all_eform_list']);
		$this->data['passed_eform'] = count($this->data['passed_eform_list']);
		$this->data['not_passed_eform'] = count($this->data['not_passed_eform_list']);
		$this->data['fixed_eform'] = count($this->data['fixed_eform_list']);

		$schedule_list = $this->Schedule_model->list_opened_schedule();
		$this->data['not_passed_cause_list'] = $this->Eform_model->get_not_passed_cause();
		$this->data['schedule_list'] = array();

		//---//Select e-form list by schedule's start_date and end_date//--//
		// foreach( $schedule_list as $key => $val):
		// 	$start_date = date("Y-m-d",strtotime($val['start_date']));
		// 	$end_date = date("Y-m-d",strtotime($val['end_date']));
		// 	if( empty( $this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ]  ) ){
		// 		$this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date] = array($start_date." ".$end_date);
		// 	}else{
		// 		$this->data['schedule_list'][ $val['schedule_project']." - ".$val['schedule_period'] ][$start_date." ".$end_date] = array($start_date." ".$end_date);			
		// 	}
		// endforeach;
		
		//---//Select e-form list by schedule_project and schedule_period//--//		//str_replace("world","Peter","Hello world!");
		foreach( $schedule_list as $key => $val):

			if( empty( $this->data['schedule_list'][ $val['schedule_project']]  ) ){
				$this->data['schedule_list'][ $val['schedule_project']][$val['schedule_project']." - ".$val['schedule_period']] = array($val['schedule_project']." - ".$val['schedule_period']);
			}else{
				$this->data['schedule_list'][ $val['schedule_project']][$val['schedule_project']." - ".$val['schedule_period']] = array($val['schedule_project']." - ".$val['schedule_period']);			
			}

		endforeach;

		//Logging
		log_info('[Eform] '.$this->session->userdata('name')." ".$this->session->userdata('surname').' access index page');

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
		$this->data['eform_checklist_dynamic'] = $this->Eform_model->view_eform_checklist_dynamic($eform_id);
		$this->data['eform_checklist_answer'] = $this->Eform_model->view_eform_checklist_answer($eform_id);
		$this->data['eform_attachment'] = $this->Eform_model->view_eform_attachment($eform_id);
		$this->data['eform_note'] = $this->Eform_model->view_eform_note($eform_id);

		//--Get schedule
		$this->data['schedule'] = $this->Schedule_model->view_schedule($this->data['eform'][0]['schedule_id']);
		$this->data['ticket'] = $this->Ticket_model->list_ticket_by_eform($this->data['eform'][0]['site_id'],$this->data['eform'][0]['asset_type'],$this->data['schedule'][0]['ticket_start_date'],$this->data['schedule'][0]['ticket_end_date']);

		//Logging
		log_info('[Eform] '.$this->session->userdata('name')." ".$this->session->userdata('surname').' views eform #'.$eform_id);

		$this->load->view('eform/view',$this->data);
	}

	public function create($schedule_id = null, $site_id = null, $form_id = null){
		$this->_init();
		$this->_init_assets( array('icheck','bootstrap-fileinput','datatables','bootstrap_select') );
		// $this->_init_assets( array('icheck','dropzone','datatables') );
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

		//Logging
		log_info('[Eform] '.$this->session->userdata('name')." ".$this->session->userdata('surname').' access create page.');

		$this->load->view('eform/create',$this->data);
	}   
	
	public function create_ops(){
		
		$this->load->library('upload');

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
		$answer = $this->Eform_model->load_form_answer();

		foreach($question as $key => $val):
			if($val['question_type'] == 'dynamictextbox'){

				// echo "<pre>"; print_r($answer[$_POST['form_id']][$val['page_no']][$val['panel_no']][$val['question_no']]); echo "</pre>";
				$item = $answer[$_POST['form_id']][$val['page_no']][$val['panel_no']][$val['question_no']];
				$item_no = count( $answer[$_POST['form_id']][$val['page_no']][$val['panel_no']][$val['question_no']] )."<BR>";
				// echo $val['question_no']."<BR>";
				// echo count( $answer[$_POST['form_id']][$val['page_no']][$val['panel_no']][$val['question_no']] )."<BR>";
				// echo "<pre>"; print_r($_POST); echo "</pre>";
				for($i=1; $i <= $item_no; $i++ ){
					// echo $item[$i]['answer_name']."<BR>";
					for( $p = 0; $p < count($_POST[$item[$i]['answer_name']]); $p++){
						// echo $eform_id." | ".$val['question_no']." | ".$item[$i]['answer_name']." | ".(int)($p + 1)." | ".$_POST[$item[$i]['answer_name']][$p]."<BR>";

						//Prepate date for insert to tb_eform_checklist
						$eform_checklist_dynamic = array(
							'eform_id' => $eform_id
							,'question_no' => $val['question_no']
							,'item_no' => (int)($p + 1)
							,'item_name' => $item[$i]['answer_name']							
							,'item_val' => $_POST[$item[$i]['answer_name']][$p]
						);

						// echo "<pre>"; print_r($eform_checklist_dynamic); echo "</pre>";
						$res = $this->Utilities_model->_insert_array('tb_eform_checklist_dynamic',$eform_checklist_dynamic);
					}
				}

				//Prepate date for insert to tb_eform_checklist
				$eform_checklist = array(
					'eform_id' => $eform_id
					// ,'form_id' => $_POST['form_id']
					// ,'page_no' => $_POST['page_no']
					,'question_no' => $val['question_no']
					,'answer_value' => NULL
				);

				// echo "<pre>"; print_r($eform_checklist); echo "</pre>";
				$res = $this->Utilities_model->_insert_array('tb_eform_checklist',$eform_checklist);
				
			}elseif($val['question_type'] == 'dropbox'){
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

						//Upload file
						$alert_msg = $this->utilities->upload($uploadedFile,$config);

						$eform_attachment = array(
							'eform_id' => $eform_id
							,'form_id' => $_POST['form_id']
							,'page_no' => $_POST['page_no']
							// ,'panel_no' => $val['panel_no']
							,'question_no' => $val['question_no']
							,'attachment_type' => $alert_msg[0]['result']['image_type']
							,'attachment_path' => $alert_msg[0]['result']['file_name']
						);

						        
						//Logging
						log_info('[Eform] '.$this->session->userdata('name')." ".$this->session->userdata('surname').' uploaded '.$alert_msg[0]['result']['file_name']);

						// echo "<pre>"; print_r($eform_attachment); echo "</pre>";
						$res = $this->Utilities_model->_insert_array('tb_eform_attachment',$eform_attachment);

					}
				}
			}elseif( ($val['question_type'] != 'dynamictextbox') && ($val['question_type'] != 'dropbox') ){
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
			}

		endforeach;

		//Logging
		log_info('[Eform] '.$this->session->userdata('name')." ".$this->session->userdata('surname').' created eform #'.$eform_id.' of schedule #'.$_POST['schedule_id']);

		// Redirect
		redirect( site_url('/schedule/view/'.$_POST['schedule_id']));
	}

	public function add_note_ops(){

		$this->load->model( array('Utilities_model'));

		//Prepate date for insert to tb_eform
		$eform_note = array(
			'eform_id' => $_POST['eform_id']
			,'action' => $_POST['action']
			,'note_detail' => $_POST['note']
			,'created_by' => $this->session->userdata('name')." ".$this->session->userdata('surname')
		);

		// echo "<pre>"; print_r($eform); echo "</pre>";
		$res = $this->Utilities_model->_insert_array('tb_eform_note',$eform_note);

		//Logging
		log_info('[Eform] '.$this->session->userdata('name')." ".$this->session->userdata('surname').' added noted to eform #'.$_POST['eform_id']);

		redirect( site_url('/eform/view/'.$_POST['eform_id']));
	}

	public function disable_eform_ops(){
		
		// print_r($_POST);

		$this->load->model( array('Eform_model'));

		$res = $this->Eform_model->disable_eform($_POST['eform_id']);

		//Logging
		log_info('[Eform] '.$this->session->userdata('name')." ".$this->session->userdata('surname').' disabled eform #'.$_POST['eform_id']);

		if($_POST['called_page'] == "schedule"){
			redirect( site_url('/schedule/view/'.$_POST['schedule_id']));
			
		}elseif($_POST['called_page'] == "eform"){
			redirect( site_url('/eform/index/'));
		}
	}

}