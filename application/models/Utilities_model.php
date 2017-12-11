<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Utilities_model extends CI_Model {

    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }
    
    function _insert_array($table = null, $data=null) {
        
        $this->db->insert($table, $data);

        return $this->db->affected_rows();
    }

    function _delete($table = null, $data=null) {
        
        foreach($data as $key => $val):
            $this->db->where($key, $val);
        endforeach;

        $this->db->delete($table); 

        return $this->db->affected_rows();
    }


    function _count_row($table = null, $data=null) {
    
        foreach($data as $key => $val):
            $this->db->where($key, $val);
        endforeach;

        $this->db->from($table);

        return $this->db->count_all_results();;
    }



}
?>