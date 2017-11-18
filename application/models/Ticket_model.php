<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ticket_model extends CI_Model {

    //private $name_table = 'Service_Action';
    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }

    function list_ticket_by_site($site = null , $ticket_start_date = null , $ticket_end_date = null) {
        $sql ="
        SELECT case_sub_category,contract,case_id
        FROM tb_ticket
        WHERE site_id = '$site' AND created_date BETWEEN '$ticket_start_date' AND '$ticket_end_date' AND (case_id LIKE 'NT-Fibre%' OR case_id LIKE 'NT-Equip%' ) AND case_status = 'Closed'
        GROUP BY case_sub_category,contract,case_id
        ORDER BY case_id ASC
            ";

        $query = $this->db->query($sql);

        $ticket = array();
        
        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                if(!isset($ticket[$value['case_sub_category']])){
                    $ticket[$value['case_sub_category']][] = array(
                        'case_id' => $value['case_id']
                        ,'contract' => $value['contract']
                    );
                }else{
                    $ticket[$value['case_sub_category']][] = array(
                        'case_id' => $value['case_id']
                        ,'contract' => $value['contract']
                    );
                }
            }
                return $ticket;
            }else{
                return FALSE;
            }        

    }  

    function view_ticket($ticket_id = null){
        $sql = "
        SELECT *
        FROM tb_ticket ticket
        WHERE ticket.case_id = '$ticket_id'
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