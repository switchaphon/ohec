<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Eform_model extends CI_Model {

    //private $name_table = 'Service_Action';
    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }

    function load_form($asset_category = null, $ma_type = null) {
        $sql ="
            SELECT form_id,form_name
            FROM tb_form form
            WHERE form.asset_type = '$asset_category' AND form.ma_type = '$ma_type' AND form.form_status = '1'
            ";

        $query = $this->db->query($sql);

        if($query->result()){
            
            $form = array();
            
            foreach($query->result_array() as $key => $value):
                if( empty( $form[$value['form_id']] ) ){
                    $form[$value['form_id']] = array(
                        'form_name' => $value['form_name']
                    );
                }
            endforeach;
            // foreach($query->result_array() as $key => $value):
            //     if( empty( $form[$value['form_id']] ) ){
            //         $form[] = array(
            //             'form_no' => $value['form_id']
            //             ,'form_name' => $value['form_name']
            //         );
            //     }
            // endforeach;

            return $form;            
        }else{
            return FALSE;
        }
    }

    function load_form_page() {
        $sql ="
            SELECT form_id,page_no,page_name,page_title
            FROM tb_form_page page
            WHERE page_status = '1'
            ";

        $query = $this->db->query($sql);

        if($query->result()){

            $form_page = array();
            
            foreach($query->result_array() as $key => $value):
                if( empty( $form_page[$value['form_id']][$value['page_no']] ) ){
                    $form_page[$value['form_id']][$value['page_no']] = array(
                        'page_name' => $value['page_name']
                        ,'page_title' => $value['page_title']
                    );
                }
            endforeach;
            // foreach($query->result_array() as $key => $value):
            //     if( empty( $form_page[$value['form_id']] ) ){
            //         $form_page[$value['form_id']][] = array(
            //             'page_no' => $value['page_no']
            //             ,'page_name' => $value['page_name']
            //             ,'page_title' => $value['page_title']
            //         );
            //     }
            // endforeach;
            return $form_page;            
        }else{
          return FALSE;
        }

    }

    function load_form_panel() {
        $sql ="
            SELECT form_id,page_no,panel_no,panel_name,panel_title
            FROM tb_form_panel panel
            WHERE panel.panel_status = '1'
            GROUP BY form_id,page_no,panel_no,panel_name,panel_title
            ";

        $query = $this->db->query($sql);

        $form_panel = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {

                if( empty( $form_panel[$value['form_id']][$value['page_no']] ) ){
                    $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']] = array(
                        'panel_name' => $value['panel_name']
                        ,'panel_title' => $value['panel_title']
                    );
                }else{
                    $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']] = array(
                        'panel_name' => $value['panel_name']
                        ,'panel_title' => $value['panel_title']
                    );
                }
                // if( empty( $form_panel[$value['form_id']][$value['page_no']] ) ){
                //     $form_panel[$value['form_id']][$value['page_no']][] = array(
                //         'panel_no' => $value['panel_no']
                //         ,'panel_name' => $value['panel_name']
                //         ,'panel_title' => $value['panel_title']
                //     );
                // }else{
                //     $form_panel[$value['form_id']][$value['page_no']][] = array(
                //         'panel_no' => $value['panel_no']
                //         ,'panel_name' => $value['panel_name']
                //         ,'panel_title' => $value['panel_title']
                //     );
                // }                
            }
                return $form_panel;
            }else{
                return FALSE;
            }
    }

    function load_form_element() {
        $sql ="
            SELECT form_id,page_no,panel_no,element_no,element_name,element_title,element_type
            FROM tb_form_element
            WHERE element_status = '1'
            ";

        $query = $this->db->query($sql);

        $form_panel = array();

        if($query->result()){
            // foreach ($query->result_array() as $key => $value) {

            //     if( empty( $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] ) ){
            //         $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] = array(
            //             'element_name' => $value['element_name']
            //             ,'element_title' => $value['element_title']
            //             ,'element_type' => $value['element_type']
            //         );
            //     }else{
            //         $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] = array(
            //             'element_name' => $value['element_name']
            //             ,'element_title' => $value['element_title']
            //             ,'element_type' => $value['element_type']
            //         );
            //     }
            // }
            foreach ($query->result_array() as $key => $value) {
                
                if( empty( $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] ) ){
                    $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][] = array(
                        'element_no' => $value['element_no']
                        ,'element_name' => $value['element_name']
                        ,'element_title' => $value['element_title']
                        ,'element_type' => $value['element_type']
                    );
                }else{
                    $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][] = array(
                        'element_no' => $value['element_no']
                        ,'element_name' => $value['element_name']
                        ,'element_title' => $value['element_title']
                        ,'element_type' => $value['element_type']
                    );
                }
            }            
                return $form_panel;
            }else{
                return FALSE;
            }
    } 
    
    function load_form_question() {
        $sql ="
            SELECT form_id,page_no,panel_no,element_no,question_no,question_name,question_text,question_value,question_type
            FROM tb_form_question
            WHERE question_status = '1'
            ORDER BY panel_no,question_order ASC
            ";

        $query = $this->db->query($sql);

        $form_question = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {

                if( empty( $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']] ) ){
                    $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']] = array(
                        'question_name' => $value['question_name']
                        ,'question_text' => $value['question_text']
                        ,'question_value' => $value['question_value']
                        ,'element_no' => $value['element_no']
                        ,'question_type' => $value['question_type']
                    );
                }else{
                    $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']] = array(
                        'question_name' => $value['question_name']
                        ,'question_text' => $value['question_text']
                        ,'question_value' => $value['question_value']
                        ,'element_no' => $value['element_no']
                        ,'question_type' => $value['question_type']
                    );
                }
            }
            // foreach ($query->result_array() as $key => $value) {
                
            //     if( empty( $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']] ) ){
            //         $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][] = array(
            //             'question_no' => $value['question_no']
            //             ,'question_name' => $value['question_name']
            //             ,'question_text' => $value['question_text']
            //             ,'question_value' => $value['question_value']
            //             ,'element_no' => $value['element_no']
            //             ,'question_type' => $value['question_type']
            //         );
            //     }else{
            //         $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][] = array(
            //             'question_no' => $value['question_no']
            //             ,'question_name' => $value['question_name']
            //             ,'question_text' => $value['question_text']
            //             ,'question_value' => $value['question_value']
            //             ,'element_no' => $value['element_no']
            //             ,'question_type' => $value['question_type']
            //         );
            //     }
            // }            
                return $form_question;
            }else{
                return FALSE;
            }
    } 

    function load_form_answer() {
        $sql ="
            SELECT form_id,page_no,panel_no,element_no,question_no,answer_no,answer_name,answer_text,answer_value
            FROM tb_form_answer answer
            WHERE answer_status = '1'
            ORDER BY panel_no,question_no,answer_no ASC
            ";

        $query = $this->db->query($sql);

        $form_answer = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                if( empty( $form_answer[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']][$value['answer_no']] ) ){
                    $form_answer[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']][$value['answer_no']] = array(
                        'answer_name' => $value['answer_name']
                        ,'answer_text' => $value['answer_text']
                        ,'answer_value' => $value['answer_value']
                    );
                }else{
                    $form_answer[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']][$value['answer_no']] = array(
                        'answer_name' => $value['answer_name']
                        ,'answer_text' => $value['answer_text']
                        ,'answer_value' => $value['answer_value']
                    );
                }
            }  
            // foreach ($query->result_array() as $key => $value) {
            //     if( empty( $form_answer[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']][$value['answer_no']] ) ){
            //         $form_answer[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']][] = array(
            //             'answer_no' => $value['answer_no']
            //             ,'answer_name' => $value['answer_name']
            //             ,'answer_text' => $value['answer_text']
            //             ,'answer_value' => $value['answer_value']
            //         );
            //     }else{
            //         $form_answer[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']][] = array(
            //             'answer_no' => $value['answer_no']
            //             ,'answer_name' => $value['answer_name']
            //             ,'answer_text' => $value['answer_text']
            //             ,'answer_value' => $value['answer_value']
            //         );
            //     }
            // }           
                return $form_answer;
            }else{
                return FALSE;
            }
    }
    
    function get_eform_id($keyword) {
        $sql ="
            Select MAX(eform_id) AS eform_id
            FROM ohec.tb_eform
            WHERE eform_id LIKE '$keyword%'
            ";

        $query = $this->db->query($sql);

        $row = $query->row();

        // print_r($row->eform_id);
        if(!empty($row->eform_id)){
            return $row->eform_id;
        }else{
            return FALSE;
        }
    }

    function load_question($form_id = null, $panel_name = null) {
        $sql ="
            SELECT panel.form_id,panel.page_no,panel.panel_no,question_no,question_name,question_text,question_value,question_type
            FROM tb_form_panel panel
            LEFT JOIN tb_form_question question ON question.form_id = panel.form_id AND panel.panel_no = question.panel_no
            WHERE panel.form_id = '$form_id' AND panel.panel_name = '$panel_name' AND question_status = '1'
            ORDER BY panel.panel_no,question_order ASC
            ";

        $query = $this->db->query($sql);

        if($query->result()){   
                return $query->result_array();
            }else{
                return FALSE;
            }
    }  
    
    function get_schedule_eform($schedule_id = null){
        $sql ="
            SELECT eform.eform_id,site.site_id,site.site_name,site.province,ticket.case_id,ticket.case_category,eform.created_by,eform.created_date
            FROM `tb_eform` eform
            LEFT JOIN `tb_site` site ON site.site_id = eform.site_id
            LEFT JOIN `tb_ticket` ticket ON ticket.case_id = eform.ticket_id
            WHERE `schedule_id` = '$schedule_id'
        ";

        $query = $this->db->query($sql);
        
        if($query->result()){   
            return $query->result_array();
        }else{
            return FALSE;
        }
    }

    function get_eform(){
        $sql ="
            SELECT eform.eform_id,site.site_id,site.site_name,site.province,ticket.case_id,ticket.case_category,eform.created_by,eform.created_date
            FROM `tb_eform` eform
            LEFT JOIN `tb_site` site ON site.site_id = eform.site_id
            LEFT JOIN `tb_ticket` ticket ON ticket.case_id = eform.ticket_id
        ";

        $query = $this->db->query($sql);
        
        if($query->result()){   
            return $query->result_array();
        }else{
            return FALSE;
        }
    }

    function view_eform($eform_id = null){
        $sql ="
            SELECT *
            FROM `tb_eform` eform
            LEFT JOIN `tb_form` form ON form.form_id = eform.form_id
            LEFT JOIN `tb_schedule` schedule ON schedule.schedule_id = eform.schedule_id
            LEFT JOIN `tb_site` site ON site.site_id = eform.site_id
            LEFT JOIN `tb_ticket` ticket ON ticket.case_id = eform.ticket_id
            WHERE `eform_id` = '$eform_id'
        ";

        $query = $this->db->query($sql);
        
        if($query->result()){   
            return $query->result_array();
        }else{
            return FALSE;
        }
    }

    function view_eform_checklist($eform_id = null){
        $sql ="
            SELECT checklist.panel_no,checklist.question_no,panel.panel_name,panel.panel_title,question.question_no,question.question_name,question.question_text,question.question_value,question.question_type,answer_value
            FROM `tb_eform_checklist` checklist
            LEFT JOIN `tb_form_panel` panel ON panel.panel_no = checklist.panel_no
            LEFT JOIN `tb_form_question` question ON checklist.question_no = question.question_no AND checklist.panel_no = question.panel_no
            WHERE checklist.eform_id = '$eform_id'
            AND question.panel_no IN (SELECT panel_no FROM `tb_eform_checklist` checklist WHERE checklist.eform_id = '$eform_id' GROUP BY panel_no ORDER BY checklist.panel_no ASC) 
            AND question.form_id = (SELECT form_id FROM tb_eform eform WHERE eform.eform_id = '$eform_id' )
            ORDER BY panel.panel_no ASC
        ";

        $query = $this->db->query($sql);

        $eform_checklist = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $val) {

                if( empty( $eform_checklist[$val['panel_no']]  ) ){
                    $eform_checklist[$val['panel_no']] = array(
                        'panel_name' => $val['panel_name']
                        ,'panel_title' => $val['panel_title']
                    );
                    
                    if( empty( $eform_checklist[$val['panel_no']]['question'] ) ){
                        $eform_checklist[$val['panel_no']]['question'][] = array(
                            'question_no' => $val['question_no']
                            ,'question_name' => $val['question_name']
                            ,'question_text' => $val['question_text']
                            ,'question_value' => $val['question_value']
                            ,'question_type' => $val['question_type']
                            ,'answer_value' => $val['answer_value']
                        );
                    }else{
                        $eform_checklist[$val['panel_no']]['question'][] = array(
                            'question_no' => $val['question_no']
                            ,'question_name' => $val['question_name']
                            ,'question_text' => $val['question_text']
                            ,'question_value' => $val['question_value']
                            ,'question_type' => $val['question_type']
                            ,'answer_value' => $val['answer_value']
                        );
                    }
                }else{
                    $eform_checklist[$val['panel_no']]['question'][] = array(
                        'question_no' => $val['question_no']
                        ,'question_name' => $val['question_name']
                        ,'question_text' => $val['question_text']
                        ,'question_value' => $val['question_value']
                        ,'question_type' => $val['question_type']
                        ,'answer_value' => $val['answer_value']
                    );
                }    
            }                   
                return $eform_checklist;
            }else{
                return FALSE;
            }
    } 

    function view_eform_checklist_answer($eform_id = null){
        $sql ="
        SELECT answer.panel_no,answer.question_no,answer.answer_no,answer.answer_name,answer.answer_text,answer.answer_value
        FROM `tb_form_answer` answer
        WHERE answer.answer_status = '1' 
        AND answer.form_id = (SELECT form_id FROM `tb_eform` eform WHERE eform.eform_id = '$eform_id')
        AND answer.panel_no IN (SELECT panel_no FROM `tb_eform_checklist` checklist WHERE checklist.eform_id = '$eform_id' GROUP BY panel_no ORDER BY checklist.panel_no ASC)
        ORDER BY answer.panel_no,answer.question_no,answer.answer_no,answer.answer_order
        ";

        $query = $this->db->query($sql);
        
        $eform_checklist_answer = array();
        
        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                if( empty( $eform_checklist_answer[$value['panel_no']][$value['question_no']][$value['answer_no']] ) ){
                    $eform_checklist_answer[$value['panel_no']][$value['question_no']][$value['answer_no']] = array(
                        'answer_no' => $value['answer_no']
                        ,'answer_name' => $value['answer_name']
                        ,'answer_text' => $value['answer_text']
                        ,'answer_value' => $value['answer_value']
                    );
                }else{
                    $eform_checklist_answer[$value['panel_no']][$value['question_no']][$value['answer_no']] = array(
                        'answer_no' => $value['answer_no']
                        ,'answer_name' => $value['answer_name']
                        ,'answer_text' => $value['answer_text']
                        ,'answer_value' => $value['answer_value']
                    );
                }
            }        
                return $eform_checklist_answer;
            }else{
                return FALSE;
            }
    }

    function view_eform_attachment($eform_id = null){
        $sql = "
            SELECT * 
            FROM `tb_eform_attachment` 
            WHERE `eform_id` = '$eform_id'
        ";
        
        $query = $this->db->query($sql);
        
        if($query->result()){   
            return $query->result_array();
        }else{
            return FALSE;
        }
    }
}
?>