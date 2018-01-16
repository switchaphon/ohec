<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Utilities {

    public function __construct(){

    }
    
    function upload($uploadedFile = null , $config = null) {

        //Assign the CodeIgniter object to a variable for using instead "$this"
        $CI =& get_instance();
        
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);

        $massage = array();

        if ( ! $CI->upload->do_upload($uploadedFile))
        {   
            // log_error("Upload file to ".$config['upload_path']." failed");
            $massage[] = array('cmd'=>'Upload', 'state'=>'danger', 'result'=> $CI->upload->display_errors() );
        } else {
            // log_info("Upload file to ".$config['upload_path']." success");

            //store the file info
            // $image_data = $CI->upload->data();

            // $config['image_library'] = 'gd2';
            // $config['source_image'] = $image_data['full_path']; //get original image
            // $config['maintain_ratio'] = TRUE;
            // $config['width'] = 1024;
            // $config['height'] = 1024;

            // // -- Load library to resize the photo
            // $CI->load->library('image_lib', $config);
            // $CI->image_lib->initialize($config);
            
            // if (!$CI->image_lib->resize()) {
            //     $CI->handle_error($CI->image_lib->display_errors());
            // }else{
            //     // log_info("Resized file ".$image_data['full_path']." success");                
            //     $massage[] = array('cmd'=>'Import', 'state'=>'success', 'result'=> $CI->upload->data() );
            // }
            // echo "<pre>"; print_r($CI->upload->data()); echo "</pre>";
            $res = $this->_image_resize($CI->upload->data());
            
            // echo "<pre>"; print_r($res); echo "</pre>";

            if($res[0]['state'] == "success"){
                $massage[] = array('cmd'=>'Upload', 'state'=>'success', 'result'=> $CI->upload->data() );
            }else{
                $massage[] = array('cmd'=>'Upload', 'state'=>'danger', 'result'=> $CI->image_lib->display_errors() );                
            }
        }

        return $massage;
     
    }

    private function _image_resize($image = null) {
        
        //Assign the CodeIgniter object to a variable for using instead "$this"
        $CI =& get_instance();

        $config['image_library'] = 'gd2';
        $config['source_image'] = $image['full_path']; //get original image
        $config['maintain_ratio'] = TRUE;
        // $config['width'] = 800;
        // $config['height'] = 600;

        if($image['image_width'] > $image['image_height']){
            $config['width'] = 800;
            $config['height'] = 600;
                
        }else{
            $config['height'] = 800;
            $config['width'] = 600;
        }

        // -- Load library to resize the photo
        $CI->load->library('image_lib', $config);
        $CI->image_lib->initialize($config);
        
        if (!$CI->image_lib->resize()) {
            // $CI->handle_error($CI->image_lib->display_errors());
            $massage[] = array('cmd'=>'Resize', 'state'=>'danger', 'result'=> $CI->image_lib->display_errors() );
            
        }else{
            // log_info("Resized file ".$image_data['full_path']." success");                
            $massage[] = array('cmd'=>'Resize', 'state'=>'success', 'result'=> $CI->upload->data() );
        }

        return $massage;

    }

    // function pdf_generate(){

    //     require_once APPPATH.'third_party/dompdf/autoload.inc.php';
    //     // echo APPPATH;
    //     // reference the Dompdf namespace
    //     use Dompdf\Dompdf;

    //     // instantiate and use the dompdf class
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml('hello world');

    //     // (Optional) Setup the paper size and orientation
    //     $dompdf->setPaper('A4', 'landscape');

    //     // Render the HTML as PDF
    //     $dompdf->render();

    //     // Output the generated PDF to Browser
    //     $dompdf->stream();
    // }

}

?>