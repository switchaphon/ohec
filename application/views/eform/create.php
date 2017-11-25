<!-- page content -->
<article>
    <div class="right_col" role="main">
        <!-- <div class="page-title">
            <div class="title_left">
            <h3>xxx</h3>
            </div>

            <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
                </div>
            </div>
            </div>
        </div> -->

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>สร้างแบบตรวจออนไลน์ <small>(<?=$case_category;?>)</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?
                            echo $schedule_id."<BR>";
                            echo $site_id."<BR>";
                            echo $ticket_id."<BR>";
                            echo $case_category."<BR>";
                            echo $case_sub_category."<BR>";
                            echo $ma_type."<BR>";
                            echo $ma_contract."<BR>"; 
                        ?>
                        <form role="form" id="createEform" name="createEform" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('eform/create_ops');?>" method="POST">

                            <BR><BR>
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div> -->
                            <?
                                //--/Get form properties
                                echo $checklist['form_name']."<BR>";
                                
                                //--Get page's properties
                                for($page_no = 1; $page_no <= count($checklist['page']); $page_no++){
                                    // echo "page_name: ".$checklist['page'][$page_no]['page_name']."page_title: ".$checklist['page'][$page_no]['page_title']."<BR>";
                                    // echo "<pre>"; print_r($checklist['page'][$page_no]['panel']); echo "</pre>";
                                    
                                    //--Get panel's properties
                                    foreach($checklist['page'][$page_no]['panel'] as $panel_key => $panel_val):
                                        for($question_no = 1; $question_no <= count($panel_val['question']); $question_no++){

                                            $question_no = $panel_val['question'][$question_no]['question_no'];
                                            $question_name = $panel_val['question'][$question_no]['question_name'];
                                            $question_text = $panel_val['question'][$question_no]['question_text'];
                                            $question_value = $panel_val['question'][$question_no]['question_value'];
                                            $question_type = $panel_val['question'][$question_no]['question_type'];

                                            // echo " ".$question_no." ".$question_name." ".$question_text." ".$question_value." ".$question_type."<BR>";

                                            switch( $question_type ){
                                                case "textbox":
                                                    $answer = null;
                                                    $answer = "
                                                    <div class=\"col-md-4 col-sm-4 col-xs-12 \">
                                                        <input type=\"text\" class=\"form-control col-md-7 col-xs-12\" name=\"".$question_name."\" id=\"".$question_name."\">
                                                    </div>";
                                                    break;
                                                case "textarea":
                                                    $answer = null;
                                                    $answer = "
                                                    <div class=\"col-md-4 col-sm-4 col-xs-12 \">
                                                        <textarea name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control\" rows=\"3\"></textarea>
                                                    </div>";
                                                    break;
                                                case "radiobox":
                                                    $answer = null;
                                                    foreach($panel_val['question'][$question_no]['answer'] as $ans_key => $ans_val):
                                                        $answer_no = $ans_val['answer_no'];
                                                        $answer_name = $ans_val['answer_name'];
                                                        $answer_text = $ans_val['answer_text'];
                                                        $answer_value = $ans_val['answer_value'];

                                                        if($answer_name  == 'passed'){$checked = 'checked'; }else{$checked = null;}

                                                        // echo " ".$answer_no." ".$answer_name." ".$answer_text." ".$answer_value."<BR>";

                                                        $answer = $answer."
                                                            <div class=\"col-md-2 col-sm-2 col-xs-12\">
                                                                <div class=\"radio-inline\">
                                                                    <label><input type=\"radio\" class=\"flat\" name=\"".$question_name."\" id=\"".$question_name."\" value=\"".$answer_value."\" ".$checked."> ".$answer_text."</label>
                                                                </div>
                                                            </div>";  
                                                    endforeach;
                                                    break;
                                                case "checkbox":
                                                    break;
                                                case "selectbox":
                                                    break;
                                                case "dropbox":
                                                    break;    
                                            }
                                            echo "
                                            <div class=\"form-group\">
                                                <label class=\"control-label col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer."
                                            </div>";
                                        }                                            
                                    endforeach;  
                                }                    
                            ?>

                            <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-md-9 text-right">
                                <button type="submit" class="btn btn-round btn-default">ยกเลิก</button>
                                <button id="submit" type="submit" class="btn btn-round btn-primary">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</artical>
<!-- /page content -->