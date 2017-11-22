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
            FROM ohec.tb_schedule schedule
            LEFT JOIN ohec.tb_region region ON region.region_id = schedule.region
            WHERE schedule_id = '$id'
            ";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }

    function get_schedule_task($schedule_id = null) {
        $sql ="
            SELECT destination.site_id AS site_id,site_name,ma_project,ma_type,ticket_id
            FROM ohec.tb_schedule_destination destination
                LEFT JOIN ohec.tb_site site ON destination.site_id = site.site_id
                LEFT JOIN ohec.tb_schedule_task task ON destination.schedule_id = task.schedule_id AND destination.site_id = task.site_id
            WHERE destination.schedule_id = '$schedule_id'
            ORDER BY site_name ASC
            ";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }

    function _insert_array($table = null, $data=null) {
        
        $this->db->insert($table, $data);

        return $this->db->affected_rows();
    }
    //_update_array
    function _update_array($table = null, $data=null) {
        
        // $this->db->insert($table, $data);
        $this->db->where('schedule_id', $data['schedule_id']);
        $this->db->update($table, $data); 

        return $this->db->affected_rows();
    }    
/*

*/
    function _count_row($table = null, $data=null) {
    
            foreach($data as $key => $val):
                $this->db->where($key, $val);
            endforeach;

            $this->db->from($table);

            return $this->db->count_all_results();;
    }

    function _delete($table = null, $data=null) {

        foreach($data as $key => $val):
            $this->db->where($key, $val);
        endforeach;

        $this->db->delete($table); 

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
    
    function get_schedule_destination($schedule_id = null) {
        $sql ="
            Select site_id
            FROM ohec.tb_schedule_destination
            WHERE schedule_id = '$schedule_id'
            ORDER BY site_id ASC
            ";

        $query = $this->db->query($sql);
            
        $destination = array();
            
        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                $destination[] = $value['site_id'];
            }
                return $destination;
            }else{
                return FALSE;
            }
    }

    function get_committee($schedule_id = null) {
        $sql ="
            Select name
            FROM ohec.tb_schedule_member
            WHERE schedule_id = '$schedule_id'
            ORDER BY name ASC
            ";

        $query = $this->db->query($sql);

        // return $query->result_array();        
        $member = array();
        
        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                $member[] = $value['name'];
            }
                return $member;
            }else{
                return FALSE;
            }
        }

}
?>