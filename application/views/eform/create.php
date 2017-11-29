<!-- page content -->
<article>
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left"> <h3></h3></div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-sm-12 col-sm-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>
                        <!-- <ul class="nav navbar-right panel_toolbox">
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
                        </ul> -->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <section class="content invoice">

                            <!-- title row -->
                            <center><img src="<?=base_url('assets/img/uninet.png');?>" alt="uninet" height="80px"></center>
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <h2><?=$site_name;?></h2>
                                </div>
                            </div>

                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <address>
                                        <b>ตารางตรวจงาน :</b> <a href="<?=site_url('schedule/view/'.$schedule_id)?>"><?=$schedule_name;?></a>
                                        <br><b>สัญญา :</b> <?=$ma_contract;?>
                                        <br><b>หมายเลขเคส :</b> <a href="#" target="_blank"><?=$ticket_id;?></a>
                                        <br><b>ทรัพย์สิน :</b> <?=$case_sub_category;?>
                                        <br><b>เจ้าหน้าที่ประจำสถานที่ :</b> <?=$contact;?>
                                    </address>
                                </div>
                            </div>
                  
                            <div class="ln_solid"></div>
                            
                            <form role="form" id="createEform" name="createEform" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('eform/create_ops');?>" enctype="multipart/form-data" method="post">
                                
                                <!-- passing hidden data -->
                                <input type="hidden" id="schedule_id" name="schedule_id" value="<?=$schedule_id;?>" />
                                <input type="hidden" id="site_id" name="site_id" value="<?=$site_id;?>" />
                                <input type="hidden" id="ticket_id" name="ticket_id" value="<?=$ticket_id;?>" />
                                <input type="hidden" id="form_id" name="form_id" value="<?=$checklist['form_id'];?>" />
                                <!-- /passing hidden data -->
                                
                                <?
                                    //--/Get form properties

                                    //--Get page's properties
                                    for($page_no = 1; $page_no <= count($checklist['page']); $page_no++){
                                        
                                        echo "<input type=\"hidden\" id=\"page_no\" name=\"page_no\" value=\"".$page_no."\" />";
                                        
                                        //--Get panel's properties
                                        foreach($checklist['page'][$page_no]['panel'] as $panel_key => $panel_val):
                                            echo "<input type=\"hidden\" id=\"panel_name\" name=\"panel_name\" value=\"".$panel_val['panel_name']."\" />";
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
                                                            <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                                <input type=\"text\" class=\"form-control\" name=\"".$question_name."\" id=\"".$question_name."\">
                                                            </div>";
                                                        break;
                                                    case "textarea":
                                                        $answer = null;
                                                        $answer = "
                                                            <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
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

                                                            $answer = $answer."
                                                                <div class=\"col-lg-2 col-lg-offset-0 col-md-2 col-md-offset-0 col-sm-2 col-sm-offset-0 col-xs-5 col-xs-offset-1\">
                                                                    <div class=\"radio-inline\">
                                                                        <label><input type=\"radio\" class=\"flat\" name=\"".$question_name."\" id=\"".$question_name."\" value=\"".$answer_value."\" ".$checked."> ".$answer_text."</label>
                                                                    </div>
                                                                </div>";  
                                                        endforeach;
                                                        break;
                                                    case "checkbox":
                                                        $answer = null;
                                                        
                                                        break;
                                                    case "selectbox":
                                                        $answer = null;
                                                        break;
                                                    case "dropbox":
                                                        $answer = null;
                                                        $answer = "
                                                            <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                                <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control file\" multiple data-show-upload=\"false\" data-show-caption=\"true\" multiple>
                                                            </div>";
                                                        // $answer = "
                                                        //     <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                        //         <input name=\"file\" id=\"file\" type=\"file\" class=\"form-control\">
                                                        //     </div>";                                                            
                                                        break;    
                                                }

                                                //--Renfer question--//
                                                switch( $question_type ){
                                                    case "textbox":
                                                        echo "
                                                        <div class=\"form-group \">
                                                            <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                        </div>";                                                    
                                                        break;
                                                    case "textarea":
                                                        echo "
                                                        <div class=\"form-group \">
                                                            <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                        </div>";                                                    
                                                        break;
                                                    case "radiobox":
                                                        echo "
                                                        <div class=\"form-group \">
                                                            <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer."
                                                        </div>";
                                                        break;
                                                    case "checkbox":
                                                        break;
                                                    case "selectbox":
                                                        break;       
                                                    case "dropbox":
                                                        echo "
                                                        <div class=\"form-group \">
                                                            <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                        </div>";
                                                        break;                                                                                                             
                                                }

                                            }                                            
                                        endforeach;  
                                    }                    
                                
                                ?>

                                <div class="ln_solid"></div>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <!-- <span class="text-center"> -->
                                        <button type="submit" class="btn btn-round btn-default">ยกเลิก</button>
                                        <button id="submit" type="submit" class="btn btn-round btn-primary">บันทึก</button>
                                    <!-- </span> -->
                                    </div>
                                </div>
                            </form>
                            
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</artical>
<!-- /page content -->