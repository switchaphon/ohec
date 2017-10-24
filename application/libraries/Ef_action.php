<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ef_action {

    public function __construct(){
        // $CI->load->helper(array('datetime'));
    }
    
    public function load_checklist($form_category = null, $form_type = null){   
    
        //Assign the CodeIgniter object to a variable for using instead "$this"
        $CI =& get_instance();
        
        //Load model
        $CI->load->model('ef_model');
        
        $form = $CI->ef_model->get_form($form_category,$form_type);
        $form_section = $CI->ef_model->get_form_section($form_category,$form_type);
        $form_checklist = $CI->ef_model->get_form_checklist($form_category,$form_type);
        
        // echo "<pre>"; print_r($form); ecxho "</pre>";
        // echo "<pre>"; print_r($form_section); echo "</pre>";
        // echo "<pre>"; print_r($form_checklist); echo "</pre>";

        $form_item = array();
        foreach($form_checklist as $key => $value):
            if( empty( $form_item[$value['form_id']][$value['section_id']] ) ){
                $form_item[$value['form_id']][$value['section_id']] = array(
                    'section_name' => $form_section[$value['section_id']]['section_name']
                    ,'checklist' => array(
                        $value['checklist_id'] => array(
                            'checklist_name' => $value['checklist_name']
                            ,'checklist_type' => $value['checklist_type']
                        )
                    )
                );
            }else{
                $form_item[$value['form_id']][$value['section_id']]['checklist'][] = array(
                    'checklist_name' => $value['checklist_name']
                    ,'checklist_type' => $value['checklist_type']                   
                );
            }
        endforeach;

        echo "<pre>"; print_r($form_item); echo "</pre>";

        return;
    }    

}

?>