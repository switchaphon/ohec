<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ticket_model extends CI_Model {

    //private $name_table = 'Service_Action';
    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }

    function list_ticket_by_site($schedule_id = null , $site_id = null , $ticket_start_date = null , $ticket_end_date = null) {

        $sql="
        SELECT case_sub_category,contract,case_id
        FROM tb_ticket
        WHERE site_id = '$site_id' AND created_date BETWEEN '$ticket_start_date' AND '$ticket_end_date' AND (case_id LIKE 'NT-Fiber%' OR case_id LIKE 'NT-Equip%' ) AND case_status = 'Closed' 
        AND case_id NOT IN (
        	SELECT ticket_id
            FROM tb_schedule_task
            WHERE schedule_id = '$schedule_id' AND site_id = '$site_id'
        )
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
    function list_ticket_by_eform($site_id = null , $asset_type = null, $ticket_start_date = null , $ticket_end_date = null) {
        $sql="
            SELECT case_id,case_category,case_sub_category,contract,case_type
            FROM tb_ticket
            WHERE site_id = '$site_id' AND created_date BETWEEN '$ticket_start_date' AND '$ticket_end_date' AND case_category LIKE '%$asset_type%' AND case_status = 'Closed' 
            GROUP BY case_id,case_category,case_sub_category,contract,case_type
            ORDER BY case_id ASC        
        ";

        $query = $this->db->query($sql);
        
        $ticket = array();
        
        if($query->result()){
                return $query->result_array() ;
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