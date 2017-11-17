<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Schedule_model extends CI_Model {

    //private $name_table = 'Service_Action';
    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }
    

    function list_open_schedule($table = null, $data=null) {
        $sql ="
            Select *
            FROM ohec.tb_schedule
            WHERE status = '1'
            ORDER BY created_date DESC
            ";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }

    function view_schedule($id = null) {
        $sql ="
            Select *
            FROM ohec.tb_schedule
            WHERE schedule_id = '$id'
            ";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }

    function get_schedule_task($schedule_id = null) {
        $sql ="
            SELECT no,destination.site_id AS site_id,site_name,ma_project,ma_type,ticket_id
            FROM ohec.tb_schedule_destination destination
                LEFT JOIN ohec.tb_site site ON destination.site_id = site.site_id
                LEFT JOIN ohec.tb_schedule_task task ON destination.schedule_id = task.schedule_id AND destination.site_id = task.site_id
            WHERE destination.schedule_id = '$schedule_id'
            ";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    /*
    SELECT no,destination.site_id AS site_id,site_name,ma_project,ma_type,ticket_id
FROM ohec.tb_schedule_destination destination
  LEFT JOIN ohec.tb_site site ON destination.site_id = site.site_id
  LEFT JOIN ohec.tb_schedule_task task ON destination.schedule_id = task.schedule_id AND destination.site_id = task.site_id
WHERE destination.schedule_id = '2017111601'
    */
    function _insert_array($table = null, $data=null) {
        // echo $table;
        // echo "<pre>"; print_r($data); echo "</pre>";
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    function get_schedule_id($keyword) {
        $sql ="
            Select MAX(schedule_id) AS schedule_id
            FROM ohec.tb_schedule
            WHERE schedule_id LIKE '$keyword%'
            ";

        $query = $this->db->query($sql);
        $row = $query->row();

        // print_r($row->schedule_id);
        if(!empty($row->schedule_id)){
            return $row->schedule_id;
        }else{
            return FALSE;
        }
    }   
}
?>