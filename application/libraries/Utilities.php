<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Utilities {

    public function __construct(){

    }
    
    function upload($uploadedFile = null , $config = null) {

        //Assign the CodeIgniter object to a variable for using instead "$this"
        $CI =& get_instance();
        
        $CI->load->library('upload', $config);
        $CI->load->library('image_lib');
        $CI->upload->initialize($config);

        $massage = array();

        if ( ! $CI->upload->do_upload($uploadedFile))
        {   
            // log_error("Upload file to ".$config['upload_path']." failed");
            $massage[] = array('cmd'=>'Import', 'state'=>'danger', 'result'=> $CI->upload->display_errors() );
        } else {
            // log_info("Upload file to ".$config['upload_path']." success");
            $massage[] = array('cmd'=>'Import', 'state'=>'success', 'result'=> $CI->upload->data() );
        }
        return $massage;
     
    }
}

?>