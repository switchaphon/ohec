<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Site_model extends CI_Model {

    //private $name_table = 'Service_Action';
    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }

    function get_region() {
        $sql ="
            SELECT region
            FROM ohec.tb_site
            WHERE site_status = '1'
            GROUP BY region
            ORDER BY region ASC
            ";

        $query = $this->db->query($sql);

        $region = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                $region[$value['region']] = $value['region'];
            }
                return $region;
            }else{
                return FALSE;
            }
    }

    function get_province() {
        $sql ="
            SELECT region,province
            FROM ohec.tb_site
            WHERE site_status = '1'
            GROUP BY region,province
            ORDER BY region,province ASC
            ";

        $query = $this->db->query($sql);

        $province = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                $province[$value['region']]['province'][] = $value['province'];
            }
                return $province;
            }else{
                return FALSE;
            }
    } 
 
    function get_province_by_region($region = null) {
        $sql ="
            SELECT region,province
            FROM ohec.tb_site
            WHERE region IN ($region) AND site_status = '1'
            GROUP BY region,province
            ORDER BY region,province ASC
            ";

        $query = $this->db->query($sql);

        $province = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                $province[$value['region']][] = $value['province'];
            }
                return $province;
            }else{
                return FALSE;
            }
    }    
/*
SELECT region,province
FROM ohec.tb_site
WHERE region IN ('C','E') AND site_status = '1'
GROUP BY region,province
ORDER BY region,province ASC
*/       
    // function load_eform_element() {
    //     $sql ="
    //         SELECT form_id,page_no,panel_no,element_no,element_name,element_title,element_type
    //         FROM tb_form_element
    //         WHERE element_status = '1'
    //         ";

    //     $query = $this->db->query($sql);

    //     $form_panel = array();

    //     if($query->result()){
    //         foreach ($query->result_array() as $key => $value) {

    //             if( empty( $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] ) ){
    //                 $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] = array(
    //                     'element_name' => $value['element_name']
    //                     ,'element_title' => $value['element_title']
    //                     ,'element_type' => $value['element_type']
    //                 );
    //             }else{
    //                 $form_panel[$value['form_id']][$value['page_no']][$value['panel_no']][$value['element_no']] = array(
    //                     'element_name' => $value['element_name']
    //                     ,'element_title' => $value['element_title']
    //                     ,'element_type' => $value['element_type']
    //                 );
    //             }
    //         }
    //             return $form_panel;
    //         }else{
    //             return FALSE;
    //         }
    // } 
    
    // function load_eform_question() {
    //     $sql ="
    //         SELECT form_id,page_no,panel_no,element_no,question_no,question_name,question_text,question_value
    //         FROM tb_form_question
    //         WHERE question_status = '1'
    //         ORDER BY panel_no,question_order ASC
    //         ";

    //     $query = $this->db->query($sql);

    //     $form_question = array();

    //     if($query->result()){
    //         foreach ($query->result_array() as $key => $value) {

    //             if( empty( $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']] ) ){
    //                 $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']] = array(
    //                     'question_name' => $value['question_name']
    //                     ,'question_text' => $value['question_text']
    //                     ,'question_value' => $value['question_value']
    //                     ,'element_no' => $value['element_no']
    //                 );
    //             }else{
    //                 $form_question[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']] = array(
    //                     'question_name' => $value['question_name']
    //                     ,'question_text' => $value['question_text']
    //                     ,'question_value' => $value['question_value']
    //                     ,'element_no' => $value['element_no']
    //                 );
    //             }
    //         }
    //             return $form_question;
    //         }else{
    //             return FALSE;
    //         }
    // } 

    // function load_eform_answer() {
    //     $sql ="
    //         SELECT form_id,page_no,panel_no,element_no,question_no,answer_no,answer_name,answer_text,answer_value
    //         FROM tb_form_answer answer
    //         WHERE answer_status = '1'
    //         ORDER BY panel_no,question_no,answer_no ASC
    //         ";

    //     $query = $this->db->query($sql);

    //     $form_answer = array();

    //     if($query->result()){
    //         foreach ($query->result_array() as $key => $value) {

    //             if( empty( $form_answer[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']][$value['answer_no']] ) ){
    //                 $form_answer[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']][$value['answer_no']] = array(
    //                     'answer_name' => $value['answer_name']
    //                     ,'answer_text' => $value['answer_text']
    //                     ,'answer_value' => $value['answer_value']
    //                 );
    //             }else{
    //                 $form_answer[$value['form_id']][$value['page_no']][$value['panel_no']][$value['question_no']][$value['answer_no']] = array(
    //                     'answer_name' => $value['answer_name']
    //                     ,'answer_text' => $value['answer_text']
    //                     ,'answer_value' => $value['answer_value']
    //                 );
    //             }
    //         }
    //             return $form_answer;
    //         }else{
    //             return FALSE;
    //         }
    // }    
}
?>