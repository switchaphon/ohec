<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Site_model extends CI_Model {

    //private $name_table = 'Service_Action';
    public function __construct() {
        $this->db = $this->load->database('default', TRUE);
        $this->db->trans_strict(FALSE);
        parent::__construct();
    }

    function list_region() {
        $sql = "
            SELECT region,region_name
            FROM ohec.tb_site site
            LEFT JOIN ohec.tb_region region ON region.region_id = site.region
            WHERE site_status = '1'
            GROUP BY region,region_name
            ORDER BY region_name ASC        
        ";

        $query = $this->db->query($sql);

        $region = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                $region[$value['region']] = "[".$value['region']."] ".$value['region_name'];
            }
                return $region;
            }else{
                return FALSE;
            }
    }

    function list_province() {
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
 
    function list_province_by_region($region = null) {
        $sql ="
            SELECT region,region_name,province
            FROM ohec.tb_site site
            LEFT JOIN ohec.tb_region region ON region.region_id = site.region
            WHERE region IN ('$region') AND site_status = '1'
            GROUP BY region,province
            ORDER BY region,province ASC
            ";

        $query = $this->db->query($sql);

        $province = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                $province['['.$value['region'].'] '.$value['region_name']][] = $value['province'];
            }
                return $province;
            }else{
                return FALSE;
            }
    }    

    function list_site_by_province($province = null, $ticket_start_date = null , $ticket_end_date = null) {

        // //-- Select all site in the province list
        // $sql ="
        // Select province,site_id,site_name
        // FROM ohec.tb_site
        // WHERE province IN ('$province') AND site_status = '1'
        // GROUP BY province,site_id,site_name
        // ORDER BY province,site_name ASC
        //     ";
    
        //-- Select all site in the province list where the ticket created during ticket_period
        $sql = "
        SELECT province,site_id,site_name
        FROM ohec.tb_site
        WHERE province IN ('$province') AND site_status = '1'AND site_id IN (
                SELECT site_id
                FROM tb_ticket
                WHERE created_date BETWEEN '$ticket_start_date' AND '$ticket_end_date'
                AND (case_id LIKE 'NT-Fibre%' OR case_id LIKE 'NT-Equip%' ) AND case_status = 'Closed'
        )
        GROUP BY province,site_id,site_name
        ORDER BY province,site_name ASC";

        $query = $this->db->query($sql);

        $site = array();

        if($query->result()){
            foreach ($query->result_array() as $key => $value) {
                if(!isset($site[$value['province']])){
                    $site[$value['province']][] = array(
                        'site_id' => $value['site_id']
                        ,'site_name' => $value['site_name']
                    );
                }else{
                    $site[$value['province']][] = array(
                        'site_id' => $value['site_id']
                        ,'site_name' => $value['site_name']
                    );
                }
            }
                return $site;
            }else{
                return FALSE;
            }
    }        

    function view_site($site_id = null){
        $sql = "
        SELECT site.site_id,site_name,site_group,site_address,region,province,site_type,longitude,latitude,contact_no,name,surname,tel_no,mobile_no,email
        FROM tb_site site
        LEFT JOIN tb_contact contact ON contact.site_id = site.site_id
        WHERE site.site_id = '$site_id'
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