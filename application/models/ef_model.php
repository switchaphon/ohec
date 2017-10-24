<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ef_model extends CI_Model {

    //private $name_table = 'Service_Action';
    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }

    function get_form($form_category = null, $form_type = null) {
        $sql = "SELECT form_id,form_name,form_category,form_type
            FROM form
            WHERE form_category = '$form_category' AND form_type = '$form_type' AND form_status = '1'";
        
        $query = $this->db->query($sql);

        if($query->result()){
          return $query->result_array();
        }else{
          return FALSE;
        }
    }

    function get_form_section($form_category = null, $form_type = null) {
        $sql = "SELECT section.form_id,section.section_id,section_name
            FROM form_section section
            LEFT JOIN form ON form.form_id = section.form_id
            WHERE form_category = '$form_category' AND form_type = '$form_type' AND section_status = '1' ";
        
        $query = $this->db->query($sql);

        if($query->result()){
            $form_section = array();
            foreach($query->result_array() as $key => $value):
                $form_section[$value['section_id']] = array(
                    'section_name' => $value['section_name']
                );
            endforeach;
            return $form_section;            
        }else{
          return FALSE;
        }
    }

    function get_form_checklist($form_category = null, $form_type = null) {
        $sql = "SELECT form.form_id,section.section_id,checklist_id,checklist_name,checklist_type
            FROM form
            LEFT JOIN form_section section ON form.form_id = section.form_id
            LEFT JOIN form_checklist checklist ON form.form_id = section.form_id AND section.section_id = checklist.section_id
            WHERE form_category = '$form_category' AND form_type = '$form_type' AND section_status = '1' AND checklist_status = '1'
            GROUP BY form.form_id,section.section_id,checklist_id,checklist_name,checklist_type";
        
        $query = $this->db->query($sql);
  
        if($query->result()){
          return $query->result_array();
        }else{
          return FALSE;
        }
    }
}
?>