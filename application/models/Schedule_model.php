<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Schedule_model extends CI_Model {

    //private $name_table = 'Service_Action';
    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }
    

    function list_opened_schedule() {
        $sql ="
        SELECT schedule.`schedule_id`,`schedule_name`,`schedule_description`,`region`,`province`,`start_date`,`end_date`
        FROM tb_schedule schedule
        WHERE status = '1'
        ORDER BY created_date DESC
            ";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }

    function list_joined_schedule($name = null) {
        $sql ="
        SELECT schedule_id
        FROM tb_schedule_member member
        WHERE name = '$name'
            ";
        $query = $this->db->query($sql);
        
        $joined_schedule = array();
        
        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                $joined_schedule[] = $value['schedule_id'];
            }
            return $joined_schedule;
        }else{
            return FALSE;
        }
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
            SELECT destination.site_id AS site_id,site_name,task.ma_project,task.ma_type,ticket_id,form.*
            FROM ohec.tb_schedule_destination destination
                LEFT JOIN ohec.tb_site site ON destination.site_id = site.site_id
                LEFT JOIN ohec.tb_schedule_task task ON destination.schedule_id = task.schedule_id AND destination.site_id = task.site_id
                LEFT JOIN ohec.tb_form form ON form.form_id = task.ticket_id
            WHERE destination.schedule_id = '$schedule_id'
            ORDER BY site_name ASC
            ";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }

    //_update_array
    function _update_array($table = null, $data=null) {
        
        // $this->db->insert($table, $data);
        $this->db->where('schedule_id', $data['schedule_id']);
        $this->db->update($table, $data); 

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

    function get_schedule_committee($schedule_id = null) {
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

    function disable_schedule($schedule_id = null){
        $data = array(
            'status' => '0'
         );
        $this->db->where('schedule_id', $schedule_id);
        $this->db->update('tb_schedule', $data); 
    }
}
?>