<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Utilities {

    public function __construct(){

    }
    
    // function upload($uploadedFile = null , $config = null) {

    //     //Assign the CodeIgniter object to a variable for using instead "$this"
    //     $CI =& get_instance();
        
    //     $CI->load->library('upload', $config);
    //     $CI->upload->initialize($config);

    //     $massage = array();

    //     if ( ! $CI->upload->do_upload($uploadedFile))
    //     {   
    //         // log_error("Upload file to ".$config['upload_path']." failed");
    //         $massage[] = array('cmd'=>'Import', 'state'=>'danger', 'result'=> $CI->upload->display_errors() );
    //     } else {
    //         // log_info("Upload file to ".$config['upload_path']." success");
    //         $massage[] = array('cmd'=>'Import', 'state'=>'success', 'result'=> $CI->upload->data() );
    //     }
    //     return $massage;
     
    // }

    function upload($uploadedFile = null , $config = null) {

        //Assign the CodeIgniter object to a variable for using instead "$this"
        $CI =& get_instance();
        
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);

        $massage = array();

        if ( ! $CI->upload->do_upload($uploadedFile))
        {   
            // log_error("Upload file to ".$config['upload_path']." failed");
            $massage[] = array('cmd'=>'Import', 'state'=>'danger', 'result'=> $CI->upload->display_errors() );
        } else {
            // log_info("Upload file to ".$config['upload_path']." success");
            $data = $CI->upload->data();  
            // echo $data['full_path']."<BR>";
            $config['image_library'] = 'gd2';  
            $config['source_image'] = $data['full_path'];  
            // $config['create_thumb'] = FALSE;  
            $config['maintain_ratio'] = TRUE;  
            $config['quality'] = '100%';  
            $config['width'] = 2048;  
            $config['height'] = 1024;  
            $config['x_axis'] = 2048;  
            $config['y_axis'] = 1024;  

            $CI->load->library('image_lib', $config);  

            if ( ! $CI->image_lib->resize())
            {
                echo $CI->image_lib->display_errors();
            }
            // echo "xxx";
            // $massage[] = array('cmd'=>'Import', 'state'=>'success', 'result'=> $CI->upload->data() );
            $massage[] = array('cmd'=>'Import', 'state'=>'success', 'result'=> $CI->image_lib->resize() );
        }
        return $massage;
     
    }    
}

?>