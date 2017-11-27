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
		$this->load->helper(array('form', 'url','file'));
		$this->output->set_title('OHEC : eForm');
	}

	public function index()
	{
		$this->_init();
		$this->_init_assets( array('datatables') );
		$this->load->model( array('Eform_model'));

		$this->data['eform_list'] = $this->Eform_model->get_eform();	
        $this->load->view('eform/index',$this->data);
	}
	
	public function view($eform_id = null)
	{
		$this->_init();
		$this->_init_assets( array('datatables', 'icheck', 'pdfmake') );
		$this->load->library( array('Eform_action') );
		$this->load->model( array('Eform_model','Ticket_model'));
		
		//Get schedule
		$this->data['eform'] = $this->Eform_model->view_eform($eform_id);
		$this->data['eform_checklist'] = $this->Eform_model->view_eform_checklist($eform_id);
		$this->data['eform_checklist_answer'] = $this->Eform_model->view_eform_checklist_answer($eform_id);

		$this->load->view('eform/view',$this->data);
	}

	public function create($schedule_id = null,$ticket_id = null)
	{
		$this->_init();
		$this->_init_assets( array('icheck','dropzone','bootstrap-fileinput') );
		$this->load->library( array('Eform_action') );
		$this->load->model( array('Eform_model','Ticket_model','Schedule_model'));
		
		//Get ticket's detail
		$ticket = $this->Ticket_model->view_ticket($ticket_id);
		
		//Get schedule's detail
		$schedule = $this->Schedule_model->view_schedule($schedule_id);

		$this->data['schedule_id'] = $schedule[0]['schedule_id'];
		$this->data['schedule_name'] = $schedule[0]['schedule_name'];
		$this->data['site_id'] = $ticket[0]['site_id'];
		$this->data['site_name'] = $ticket[0]['site_Name'];
		$this->data['contact'] = $ticket[0]['contact'];
		$this->data['ticket_id'] = $ticket_id;
		$this->data['case_category'] = $ticket[0]['case_category'];
		$this->data['case_sub_category'] = $ticket[0]['case_sub_category'];
		$this->data['ma_type'] = 'pm'; //Should be get from ticket database
		$this->data['ma_contract'] = $ticket[0]['contract'];

		switch (true) {
			
			case strpos($this->data['case_category'], 'Equipment') !== false:
			case strpos($this->data['case_category'], 'equipment') !== false:
			case strpos($this->data['case_category'], 'Equip') !== false:
			case strpos($this->data['case_category'], 'equip') !== false:
				$asset_group = "equipment";
				// echo $this->data['case_sub_category'];
				switch(true){
					case strpos($this->data['case_sub_category'], 'Router') !== false:
						$asset_type = "Router";
						break;
					case strpos($this->data['case_sub_category'], 'Switch') !== false:
						$asset_type = "Switch";
						break;	
					case strpos($this->data['case_sub_category'], 'UPS') !== false:
						$asset_type = "UPS";
						break;	
					case strpos($this->data['case_sub_category'], 'CCTV') !== false:
						$asset_type = "CCTV";
						break;	
					case strpos($this->data['case_sub_category'], 'DWDM') !== false:
						$asset_type = "DWDM";
						break;	
					case strpos($this->data['case_sub_category'], 'เครื่องบริการแม่ข่าย') !== false:
					case strpos($this->data['case_sub_category'], 'Server') !== false:
						$asset_type = "Server";
						break;																	
				}
				break;
			case strpos($this->data['case_category'], 'Fiber') !== false:
			case strpos($this->data['case_category'], 'fiber') !== false:
				$asset_group = "fiber";
				switch(true){
					case strpos($this->data['case_sub_category'], 'เครือข่ายแกนหลัก') !== false:
						$asset_type = "P1";
						break;
					case strpos($this->data['case_sub_category'], 'เครือข่ายกระจาย') !== false:
						$asset_type = "P2";
						break;	
					case strpos($this->data['case_sub_category'], 'เครือข่ายปลายทาง') !== false:
						$asset_type = "P3";
						break;																	
				}
				break;
		}	

		//Load checklist by asset_type and ma_type
		$this->data['checklist'] = $this->eform_action->load_form($asset_group,$asset_type, $this->data['ma_type']);
		
		$this->load->view('eform/create',$this->data);
	}   
	
	public function create_ops(){
		echo "<pre>"; print_r($_POST); echo "</pre>";
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
			,'ticket_id' => $_POST['ticket_id']
			,'form_id' => $_POST['form_id']
			,'created_by' => $this->session->userdata('cn')
		);

		// echo "<pre>"; print_r($eform); echo "</pre>";
		// $res = $this->Utilities_model->_insert_array('tb_eform',$eform);

		$question = $this->Eform_model->load_question($_POST['form_id'],$_POST['panel_name']);
		
		foreach($question as $key => $val):
			if($val['question_type'] != 'dropbox'){
				if(isset($_POST[$val['question_name']])){
					//Prepate date for insert to tb_eform_checklist
					$eform_checklist = array(
						'eform_id' => $eform_id
						,'form_id' => $_POST['form_id']
						,'page_no' => $_POST['page_no']
						,'panel_no' => $val['panel_no']
						,'question_no' => $val['question_no']
						,'answer_value' => $_POST[$val['question_name']]
					);

					// echo "<pre>"; print_r($eform_checklist); echo "</pre>";
					// $res = $this->Utilities_model->_insert_array('tb_eform_checklist',$eform_checklist);
				}
			}else{
				//Upload file to folder
				// echo "<pre>"; print_r($_POST[$val['question_name']]); echo "</pre>";
				// foreach($_POST[$val['question_name']] as $attach_key => $attach_val):
				// foreach($_POST['file'] as $attach_key => $attach_val):

					//Read uploaded file
					// $uploadedFile = $_POST[$val['question_name']];
					$uploadedFile = 'file';
					
					//Prepare upload config
					$config['upload_path'] = 'files';
					// $config['allowed_types'] = 'xls|xlsx';
					$config['file_name'] = $eform_id;
					$config['overwrite'] = FALSE;
					$config['max_size'] = 0;

					//Upload file
					$alert_msg = $this->utilities->upload($uploadedFile,$config);

					$eform_attachment = array(
						'eform_id' => $eform_id
						,'form_id' => $_POST['form_id']
						,'page_no' => $_POST['page_no']
						,'panel_no' => $val['panel_no']
						,'question_no' => $val['question_no']
						// ,'attachment_no' => 
						// ,'attachment_type' => 
						// ,'attachment_path' => 
					);

					// echo "<pre>"; print_r($eform_attachment); echo "</pre>";
					// // $res = $this->Schedule_model->_insert_array('tb_eform_attachment',$eform_attachment);
				// endforeach;
			}
		endforeach;

		//Log

		//Redirect
		// redirect( site_url('/schedule/view/'.$_POST['schedule_id']) );


	}

}