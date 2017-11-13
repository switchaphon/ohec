<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ef_model extends CI_Model {

    //private $name_table = 'Service_Action';
    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }

    // function get_form($form_category = null, $form_type = null) {
    //     $sql = "SELECT form_id,form_name,form_category,form_type
    //         FROM form
    //         WHERE form_category = '$form_category' AND form_type = '$form_type' AND form_status = '1'";
        
    //     $query = $this->db->query($sql);

    //     if($query->result()){
    //       return $query->result_array();
    //     }else{
    //       return FALSE;
    //     }
    // }

    // function get_form_section($form_category = null, $form_type = null) {
    //     $sql = "SELECT section.form_id,section.section_id,section_name
    //         FROM form_section section
    //         LEFT JOIN form ON form.form_id = section.form_id
    //         WHERE form_category = '$form_category' AND form_type = '$form_type' AND section_status = '1' ";
        
    //     $query = $this->db->query($sql);

    //     if($query->result()){
    //         $form_section = array();
    //         foreach($query->result_array() as $key => $value):
    //             $form_section[$value['section_id']] = array(
    //                 'section_name' => $value['section_name']
    //             );
    //         endforeach;
    //         return $form_section;            
    //     }else{
    //       return FALSE;
    //     }
    // }

    // function get_form_checklist($form_category = null, $form_type = null) {
    //     $sql = "SELECT form.form_id,section.section_id,checklist_id,checklist_name,checklist_type
    //         FROM form
    //         LEFT JOIN form_section section ON form.form_id = section.form_id
    //         LEFT JOIN form_checklist checklist ON form.form_id = section.form_id AND section.section_id = checklist.section_id
    //         WHERE form_category = '$form_category' AND form_type = '$form_type' AND section_status = '1' AND checklist_status = '1'
    //         GROUP BY form.form_id,section.section_id,checklist_id,checklist_name,checklist_type";
        
    //     $query = $this->db->query($sql);
  
    //     if($query->result()){
    //       return $query->result_array();
    //     }else{
    //       return FALSE;
    //     }
    // }

    function load_eform($asset_type = null, $ma_type = null) {
        $sql ="
            SELECT form_id,form_name
            FROM tb_form form
            WHERE form.asset_type = '$asset_type' AND form.ma_type = '$ma_type' AND form.form_status = '1'
            ";

        $query = $this->db->query($sql);

        if($query->result()){
            
            $form = array();
            
            foreach($query->result_array() as $key => $value):
                if( empty( $form[$value['form_id']] ) ){
                    $form[$value['form_id']] = array(
                        'form_name' => $value['form_name']
                    );
                // }else{
                //     $form[$value['form_id']][$value['page_no']] = array(
                //         'page_name' => $value['page_name']
                //         ,'page_title' => $value['page_title']
                //     );
                }
            endforeach;

            return $form;            
        }else{
            return FALSE;
        }
    }

    function load_eform_page() {
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
                // }else{
                //     $form_page[$value['form_id']][$value['page_no']] = array(
                //         'page_name' => $value['page_name']
                //         ,'page_title' => $value['page_title']
                //     );
                }
            endforeach;

            return $form_page;            
        }else{
          return FALSE;
        }

    }

    function load_eform_panel() {
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
                        'panel_no' => $value['panel_no']
                        ,'panel_name' => $value['panel_name']
                        ,'panel_title' => $value['panel_title']
                    );
                }else{
                    $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']] = array(
                        'panel_no' => $value['panel_no']
                        ,'panel_name' => $value['panel_name']
                        ,'panel_title' => $value['panel_title']
                    );
                }
            }
                return $form_panel;
            }else{
                return FALSE;
            }
    }

    function load_eform_element() {
        $sql ="
            SELECT form_id,page_no,panel_no,element_no,element_name,element_title,element_type
            FROM tb_form_element
            WHERE element_status = '1'
            ";

        $query = $this->db->query($sql);

        $form_panel = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {

                if( empty( $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] ) ){
                    $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] = array(
                        'element_name' => $value['element_name']
                        ,'element_title' => $value['element_title']
                        ,'element_type' => $value['element_type']
                    );
                }else{
                    $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] = array(
                        'element_name' => $value['element_name']
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
    
    function load_eform_question() {
        $sql ="
            SELECT form_id,page_no,panel_no,element_no,question_no,question_name,question_text,question_value
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
                    );
                }else{
                    $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']] = array(
                        'question_name' => $value['question_name']
                        ,'question_text' => $value['question_text']
                        ,'question_value' => $value['question_value']
                        ,'element_no' => $value['element_no']
                    );
                }
            }
                return $form_question;
            }else{
                return FALSE;
            }
    } 

    function load_eform_answer() {
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
                return $form_answer;
            }else{
                return FALSE;
            }
    }    
}
?>