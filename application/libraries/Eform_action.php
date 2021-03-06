<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Eform_action {

    public function __construct(){

    }
    
    public function load_form($asset_type = null,$ma_type = null){   
        
            //Assign the CodeIgniter object to a variable for using instead "$this"
            $CI =& get_instance();
            
            //Load model
            $CI->load->model('Eform_model');
            
            //Query eForm
            $form = $CI->Eform_model->load_form($asset_type,$ma_type);
            $form_page = $CI->Eform_model->load_form_page();
            $form_panel = $CI->Eform_model->load_form_panel();
            // $form_element = $CI->Eform_model->load_form_element();
            $form_question = $CI->Eform_model->load_form_question();
            $form_answer = $CI->Eform_model->load_form_answer();

            // echo "Form";
            // echo "<pre>"; print_r($form); echo "</pre>";
            // echo "Form_page";
            // echo "<pre>"; print_r($form_page); echo "</pre>";
            // echo "Form_panel";
            // echo "<pre>"; print_r($form_panel); echo "</pre>";
            // // echo "Form_element";
            // // echo "<pre>"; print_r($form_element); echo "</pre>";
            // echo "Form_question";
            // echo "<pre>"; print_r($form_question); echo "</pre>";
            // echo "Form_answer";
            // echo "<pre>"; print_r($form_answer); echo "</pre>";

            //Create eForm 
            $eform = array();

            $eform['form_id'] = key($form);
            $eform['form_name'] = $form[key($form)]['form_name'];
            // echo $eform['form_id'].":".$eform['form_name'];
            //Load page
            foreach($form_page[key($form)] as $page_no => $page_value):
                
                $eform['page'][$page_no] = array(
                    "page_name" => $page_value['page_name']
                    ,"page_title" => $page_value['page_title']
                );

                // echo "<pre>"; print_r($form_panel[key($form)][$page_no]); echo "</pre>";
                // foreach($form_panel[key($form)][$page_no] as $x):
                //     echo "<pre>"; print_r($x); echo "</pre>";
                // endforeach;
                // echo count($form_panel[key($form)][$page_no]);
                
                for($panel = 1 ; $panel <= count($form_panel[key($form)][$page_no]); $panel++){
                    //--select only related $asset_typ panel--//
                    // if($form_panel[key($form)][$page_no][$panel]['panel_name'] == $asset_type){
                        $eform['page'][$page_no]['panel'][$panel] = array(
                            "panel_no" => $panel
                            ,"panel_name" => $form_panel[key($form)][$page_no][$panel]['panel_name']
                            ,"panel_title" => $form_panel[key($form)][$page_no][$panel]['panel_title']
                        );
                        // echo "<pre>"; print_r($eform['page'][$page_no]['panel'][$panel]); echo "</pre>";
                        //Load question
                        // echo count($form_question[key($form)][$page_no][$panel]);
                        // for($question = 1; $question <= count($form_question[key($form)][$page_no][$panel]); $question++){
                        foreach($form_question[key($form)][$page_no][$panel] as $question_no => $question_detail):
                            $eform['page'][$page_no]['panel'][$panel]['question'][$question_no] = array(
                                "question_no" => $question_no
                                ,"question_name" => $form_question[key($form)][$page_no][$panel][$question_no]['question_name']
                                ,"question_text" => $form_question[key($form)][$page_no][$panel][$question_no]['question_text']
                                ,"question_value" => $form_question[key($form)][$page_no][$panel][$question_no]['question_value']
                                ,"question_type" => $form_question[key($form)][$page_no][$panel][$question_no]['question_type']
                            );
                            // echo $form_question[key($form)][$page_no][$panel][$question_no]['question_name']." : ".$form_question[key($form)][$page_no][$panel][$question_no]['question_type'];
                            
                            //If the question need an answer,load answer
                            // if( ($form_question[key($form)][$page_no][$panel][$question_no]['question_type'] == "radiobox") || ($form_question[key($form)][$page_no][$panel][$question_no]['question_type'] == "select") || ($form_question[key($form)][$page_no][$panel][$question_no]['question_type'] == "checkbox") ){
                            if(  ($form_question[key($form)][$page_no][$panel][$question_no]['question_type'] == "radiobox") || ($form_question[key($form)][$page_no][$panel][$question_no]['question_type'] == "selectbox") || ($form_question[key($form)][$page_no][$panel][$question_no]['question_type'] == "dynamictextbox") ){
                                // echo "<pre>"; print_r($form_answer[key($form)][$page_no][$panel][$question_no]); echo "</pre>";
                                for($answer = 1; $answer <= count($form_answer[key($form)][$page_no][$panel][$question_no]); $answer++ ){

                                    $eform['page'][$page_no]['panel'][$panel]['question'][$question_no]['answer'][$answer] = array(
                                        'answer_no' => $answer
                                        ,'answer_name' => $form_answer[key($form)][$page_no][$panel][$question_no][$answer]['answer_name']
                                        ,'answer_text' => $form_answer[key($form)][$page_no][$panel][$question_no][$answer]['answer_text']
                                        ,'answer_value' => $form_answer[key($form)][$page_no][$panel][$question_no][$answer]['answer_value']
                                    );
                                }
                            }
                        endforeach;
                        //}//forloop
                    // }
                    //--/select only related panel--//
                }

            endforeach;

            // echo "<pre>"; print_r($eform); echo "</pre>";

            return $eform;
        }
        
}

?>