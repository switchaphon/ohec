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

    public function load_eform($asset_type = null, $ma_type = null){   
        
            //Assign the CodeIgniter object to a variable for using instead "$this"
            $CI =& get_instance();
            
            //Load model
            $CI->load->model('ef_model');
            
            $form = $CI->ef_model->load_eform($asset_type,$ma_type);
            $form_page = $CI->ef_model->load_eform_page();
            $form_panel = $CI->ef_model->load_eform_panel();
            $form_element = $CI->ef_model->load_eform_element();
            $form_question = $CI->ef_model->load_eform_question();
            $form_answer = $CI->ef_model->load_eform_answer();

            // echo "Form";
            // echo "<pre>"; print_r($form); echo "</pre>";
            // echo "Form_page";
            // echo "<pre>"; print_r($form_page); echo "</pre>";
            // echo "Form_panel";
            // echo "<pre>"; print_r($form_panel); echo "</pre>";
            // echo "Form_element";
            // echo "<pre>"; print_r($form_element); echo "</pre>";
            // echo "Form_question";
            // echo "<pre>"; print_r($form_question); echo "</pre>";
            // echo "Form_answer";
            // echo "<pre>"; print_r($form_answer); echo "</pre>";

            $eform = array();

            // endforeach;
            $eform['form_id'] = key($form);
            $eform['form_name'] = $form[key($form)]['form_name'];

            //Load page
            foreach($form_page[key($form)] as $page_no => $page_value):
                
                $eform['page'][$page_no] = array(
                    "page_name" => $page_value['page_name']
                    ,"page_title" => $page_value['page_title']
                );

                //Load panel
                for($panel=1 ; $panel<=count($form_panel[key($form)][$page_no]); $panel++){
                    $eform['page'][$page_no]['panel'][$panel] = array(
                        "panel_no" => $panel
                        ,"panel_name" => $form_panel[key($form)][$page_no][$panel]['panel_name']
                        ,"panel_title" => $form_panel[key($form)][$page_no][$panel]['panel_title']
                    );

                    //Load question
                    for($question=1; $question<=count($form_question[key($form)][$page_no][$panel]); $question++){
                        $eform['page'][$page_no]['panel'][$panel]['question'][$question] = array(
                            "question_no" => $question
                            ,"question_name" => $form_question[key($form)][$page_no][$panel][$question]['question_name']
                            ,"question_text" => $form_question[key($form)][$page_no][$panel][$question]['question_text']
                            ,"question_value" => $form_question[key($form)][$page_no][$panel][$question]['question_value']
                        );

                        //If the question need an answer,load answer
                        if($form_question[key($form)][$page_no][$panel][$question]['element_no'] != "2"){
                            for($answer=1; $answer <= count($form_answer[key($form)][$page_no][$panel][$question]); $answer++ ){
                                $eform['page'][$page_no]['panel'][$panel]['question'][$question]['answer'][$answer] = array(
                                    'answer_no' => $answer
                                    ,'answer_name' => $form_answer[key($form)][$page_no][$panel][$question][$answer]['answer_name']
                                    ,'answer_text' => $form_answer[key($form)][$page_no][$panel][$question][$answer]['answer_text']
                                    ,'answer_value' => $form_answer[key($form)][$page_no][$panel][$question][$answer]['answer_value']
                                );
                                
                            }
                        }

                    }

                }

            endforeach;

            echo "<pre>"; print_r($eform); echo "</pre>";

            return;
        }
}

?>