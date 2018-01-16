<!-- page content -->
<article>
    <div class="right_col" role="main">
        
        <div class="page-title">
            <div class="title_left"> <h3></h3></div>
        </div>

        <div class="clearfix"></div>

        <form role="form" id="createEform" name="createEform" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('eform/create_ops');?>" enctype="multipart/form-data" method="post">
           
            <!-- Header -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <section class="content invoice">

                                <!-- title row -->
                                <center><img src="<?=base_url('assets/img/uninet.png');?>" alt="uninet" height="80px"></center>
                                
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <h2><?=$site_name;?></h2>
                                        <h6>จังหวัด<?=$province?></h6>
                                    </div>
                                </div>

                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <address>
                                            <!-- <b>ตารางตรวจงาน :</b> <a href="<?=site_url('schedule/view/'.$schedule_id)?>"><?=$schedule_name;?></a> -->
                                            <b>ประเภทงานตรวจ :</b> <?=$ma_name;?> (<?=$ma_type;?>)
                                            <br><b>ทรัพย์สิน :</b> <?=$asset_type;?>
                                            <!--<br><b>สัญญา :</b> <?=$ma_contract;?>
                                            <br><b>หมายเลขเคส :</b> <a href="#" target="_blank"><?=$ticket_id;?></a>-->
                                            <!--<br><b>เจ้าหน้าที่ประจำสถานที่ :</b> <?=$contact;?> -->
                                        </address>
                                    </div>
                                    <!-- Ticket table -->
                                    <? if(!empty($ticket)){?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center>
                                        <table id="tbEformTicket" name="tbEformTicket" width="90%" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                <th class="text-center">หมายเลข Ticket</th>
                                                <th class="text-center">ประเภทอุปกรณ์</th>
                                                <th class="text-center">สัญญา</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            <? 
                                            if(!empty($ticket)){ 
                                                foreach($ticket as $ticket_key => $ticket_val):
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?=$ticket_val['case_id'];?></td>                                                                                                
                                                    <td class="text-center"><?=$ticket_val['case_sub_category'];?></td>
                                                    <td class="text-center"><?=$ticket_val['contract'];?></td>
                                                </tr>  
                                            <?      
                                                endforeach;
                                            }
                                            ?>                            
                                            </tbody>                   
                                        </table></center>
                                    </div>
                                    <?}?>
                                    <!-- /Ticket table-->
                                </div>

                            </section>
                        </div>
                    </div>
                </div>  
            </div>      

    
            <!-- passing hidden data -->
            <input type="hidden" id="schedule_id" name="schedule_id" value="<?=$schedule_id;?>" />
            <input type="hidden" id="site_id" name="site_id" value="<?=$site_id;?>" />
            <input type="hidden" id="form_id" name="form_id" value="<?=$checklist['form_id'];?>" />
            <!-- /passing hidden data -->
            
            <?
                //--Get page's properties
                for($page_no = 1; $page_no <= count($checklist['page']); $page_no++){
                    
                    echo "<input type=\"hidden\" id=\"page_no\" name=\"page_no\" value=\"".$page_no."\" />";
                    
                    //--Get panel's properties
                    foreach($checklist['page'][$page_no]['panel'] as $panel_key => $panel_val):
                        echo "
                        <div class=\"row\">
                            <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
                                <div class=\"x_panel collapsed\">
                                    <div class=\"x_title\">
                                        <h2>".$panel_val['panel_name']."</h2>
                                        <ul class=\"nav navbar-right panel_toolbox\" style=\"padding-left: 50px;\"> 
                                            <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-up\"></i></a></li>
                                            <li><a class=\"close-link\"><i class=\"fa fa-close\"></i></a></li>
                                        </ul>
                                        <div class=\"clearfix\"></div>
                                    </div>
                                    <div class=\"x_content\">";
                        // echo "<pre>"; print_r($panel_val['question']); echo "</pre>";
                        foreach($panel_val['question'] as $question_no => $question_val):
                            $question_no = $question_no ;
                            $question_name = $question_val['question_name'];
                            $question_text = $question_val['question_text'];
                            $question_value = $question_val['question_value'];
                            $question_type = $question_val['question_type'];
                            
                            $answer = null;
                            switch( $checklist['form_id'] ) {
                                //--Equipment-AM--//
                                case "00001":       
                                    //--/Question type--//
                                    switch( $question_type ){
                                        case "textbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <input type=\"text\" class=\"form-control\" name=\"".$question_name."\" id=\"".$question_name."\" placeholder=\"".$question_text."\" required>
                                                </div>";
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";                                           
                                            break;
                                        case "textarea":  
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <textarea name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control\" rows=\"3\" placeholder=\"".$question_text."\"></textarea>
                                                </div>";    
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";  
                                            break;
                                        case "radiobox":
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
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer."
                                                </div>";                                                                              
                                            break;
                                        case "checkbox":
                                            break;
                                        case "selectbox":
                                            foreach($panel_val['question'][$question_no]['answer'] as $ans_key => $ans_val):
                                                $answer_no = $ans_val['answer_no'];
                                                $answer_name = $ans_val['answer_name'];
                                                $answer_text = $ans_val['answer_text'];
                                                $answer_value = $ans_val['answer_value'];
        
                                                if($answer_no  == '1'){ $selected = 'selected'; }else{ $selected = null; }
                                                $answer = $answer."<option value=\"".$answer_value."\"".$selected.">".$answer_text."</option>";

                                            endforeach;  
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>
                                                    <div class=\"col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-12\">
                                                        <select name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control selectpicker show-tick\" title=\" \"data-live-search=\"false\" data-size=\"5\" data-width=\"css-width\" required>.$answer.</select>
                                                    </div>
                                                </div>";                                                                              
                                            break;
                                        case "dropbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-9 col-sm-9 col-xs-12\">
                                                    <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control\" multiple>
                                                </div>";      
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-2 col-sm-2 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";
                                            break;
                                    }
                                break;

                                //--Equipment-CM--//
                                case "00002":       
                                //--/Question type--//
                                    switch( $question_type ){
                                        case "textbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <input type=\"text\" class=\"form-control\" name=\"".$question_name."\" id=\"".$question_name."\" placeholder=\"".$question_text."\" required>
                                                </div>";
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";     
                                            break;
                                        case "textarea":  
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <textarea name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control\" rows=\"3\" placeholder=\"".$question_text."\"></textarea>
                                                </div>";    
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";     
                                            break;
                                        case "radiobox":  
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
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer."
                                                </div>";                                                                             
                                            break;
                                        case "checkbox":
                                            break;
                                        case "selectbox":
                                            foreach($panel_val['question'][$question_no]['answer'] as $ans_key => $ans_val):
                                                $answer_no = $ans_val['answer_no'];
                                                $answer_name = $ans_val['answer_name'];
                                                $answer_text = $ans_val['answer_text'];
                                                $answer_value = $ans_val['answer_value'];
        
                                                if($answer_no  == '1'){ $selected = 'selected'; }else{ $selected = null; }
                                                $answer = $answer."<option value=\"".$answer_value."\"".$selected.">".$answer_text."</option>";

                                            endforeach;  
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>
                                                    <div class=\"col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-12\">
                                                        <select name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control selectpicker show-tick\" title=\" \"data-live-search=\"false\" data-size=\"5\" data-width=\"css-width\" required>.$answer.</select>
                                                    </div>
                                                </div>";                                                                              
                                            break;
                                        case "dropbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-9 col-sm-9 col-xs-12\">
                                                    <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control\" multiple>
                                                </div>";      
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-2 col-sm-2 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";
                                            break;
                                    }
                                break;

                                //--Equipment-PM--//
                                case "00003":       
                                //--/Question type--//
                                    switch( $question_type ){
                                        case "textbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-9 col-sm-9 col-xs-12\">
                                                    <input type=\"text\" class=\"form-control\" name=\"".$question_name."\" id=\"".$question_name."\" placeholder=\"".$question_text."\" required>
                                                </div>";
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-1 col-sm-1 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";     
                                            break;
                                        case "textarea":  
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-9 col-sm-9 col-xs-12\">
                                                    <textarea name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control\" rows=\"3\" placeholder=\"".$question_text."\"></textarea>
                                                </div>";    
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-1 col-sm-1 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";                                     
                                            break;
                                        case "radiobox":  
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
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer."
                                                </div>";                                      
                                            break;
                                        case "checkbox":
                                            break;
                                        case "selectbox":
                                            foreach($panel_val['question'][$question_no]['answer'] as $ans_key => $ans_val):
                                                $answer_no = $ans_val['answer_no'];
                                                $answer_name = $ans_val['answer_name'];
                                                $answer_text = $ans_val['answer_text'];
                                                $answer_value = $ans_val['answer_value'];
        
                                                if($answer_no  == '1'){ $selected = 'selected'; }else{ $selected = null; }
                                                $answer = $answer."<option value=\"".$answer_value."\"".$selected.">".$answer_text."</option>";

                                            endforeach;  
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>
                                                    <div class=\"col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-12\">
                                                        <select name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control selectpicker show-tick\" title=\" \"data-live-search=\"false\" data-size=\"5\" data-width=\"css-width\" required>.$answer.</select>
                                                    </div>
                                                </div>";                                                                              
                                            break;
                                        case "dropbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-9 col-sm-9 col-xs-12\">
                                                    <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control\" multiple>
                                                </div>";      
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-2 col-sm-2 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";
                                            break;
                                    }
                                break;  

                                //--Fibre-AM--//
                                case "00004":       
                                    //--/Question type--//
                                    switch( $question_type ){
                                        case "dynamictextbox":

                                            foreach($panel_val['question'][$question_no]['answer'] as $ans_key => $ans_val):
                                                $answer_no = $ans_val['answer_no'];
                                                $answer_name = $ans_val['answer_name'];
                                                $answer_text = $ans_val['answer_text'];
                                                $answer_value = $ans_val['answer_value'];
        
                                                $answer = $answer."
                                                    <div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-3\">
                                                        <input type=\"text\" class=\"form-control\" name=\"".$answer_name."[]\" id=\"".$answer_name."\" placeholder=\"".$answer_text."\" required>
                                                    </div>";
                                            endforeach;  
                                            echo "
                                                    <div class=\"form-group \">
                                                        <label class=\"control-label col-lg-3 col-md-3 col-sm-3\" for=\"".$question_name."\"></label>".$answer."                                                    
                                                        <button name=\"".$question_name."_addbtn\" id=\"".$question_name."_addbtn\" type=\"button\" class=\"btn btn-round btn-primary\"><span class=\"fa fa-plus\" aria-hidden=\"true\"></span></button>
                                                    </div>
                                                <span id=\"".$question_name."_field\"></span>";             

                                            break;
                                        case "textbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <input type=\"text\" class=\"form-control\" name=\"".$question_name."\" id=\"".$question_name."\" placeholder=\"".$question_text."\" required>
                                                </div>";
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";                                           
                                            break;
                                        case "textarea":  
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <textarea name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control\" rows=\"3\" placeholder=\"".$question_text."\"></textarea>
                                                </div>";    
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";  
                                            break;
                                        case "radiobox":
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
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer."
                                                </div>";                                                                              
                                            break;
                                        case "checkbox":
                                            break;
                                        case "selectbox":
                                            foreach($panel_val['question'][$question_no]['answer'] as $ans_key => $ans_val):
                                                $answer_no = $ans_val['answer_no'];
                                                $answer_name = $ans_val['answer_name'];
                                                $answer_text = $ans_val['answer_text'];
                                                $answer_value = $ans_val['answer_value'];
        
                                                if($answer_no  == '1'){ $selected = 'selected'; }else{ $selected = null; }
                                                $answer = $answer."<option value=\"".$answer_value."\"".$selected.">".$answer_text."</option>";

                                            endforeach;  
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>
                                                    <div class=\"col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-12\">
                                                        <select name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control selectpicker show-tick\" title=\" \"data-live-search=\"false\" data-size=\"5\" data-width=\"css-width\" required>.$answer.</select>
                                                    </div>
                                                </div>";                                                                              
                                            break;
                                        case "dropbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-9 col-sm-9 col-xs-12\">
                                                    <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control\" multiple>
                                                </div>";      
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-2 col-sm-2 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";
                                            break;
                                    }
                                break;  

                                //--Fibre-CM--//
                                case "00005":       
                                    //--/Question type--//
                                    switch( $question_type ){
                                        case "textbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <input type=\"text\" class=\"form-control\" name=\"".$question_name."\" id=\"".$question_name."\" placeholder=\"".$question_text."\" required>
                                                </div>";
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";                                           
                                            break;
                                        case "textarea":  
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <textarea name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control\" rows=\"3\" placeholder=\"".$question_text."\"></textarea>
                                                </div>";    
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";  
                                            break;
                                        case "radiobox":
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
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer."
                                                </div>";                                                                              
                                            break;
                                        case "checkbox":
                                            break;
                                        case "selectbox":
                                        // echo "<pre>"; print_r($panel_val['question'][$question_no]['answer']); echo "</pre>";
                                            foreach($panel_val['question'][$question_no]['answer'] as $ans_key => $ans_val):
                                                $answer_no = $ans_val['answer_no'];
                                                $answer_name = $ans_val['answer_name'];
                                                $answer_text = $ans_val['answer_text'];
                                                $answer_value = $ans_val['answer_value'];
        
                                                if($answer_no  == '1'){ $selected = 'selected'; }else{ $selected = null; }
                                                $answer = $answer."<option value=\"".$answer_value."\"".$selected.">".$answer_text."</option>";

                                            endforeach;  
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>
                                                    <div class=\"col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-12\">
                                                        <select name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control selectpicker show-tick\" title=\" \"data-live-search=\"false\" data-size=\"5\" data-width=\"css-width\" required>.$answer.</select>
                                                    </div>
                                                </div>";                                                                              
                                            break;
                                        case "dropbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-9 col-sm-9 col-xs-12\">
                                                    <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control\" multiple>
                                                </div>";      
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-2 col-sm-2 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";
                                            break;
                                    }
                                break;  
                                
                                //--Fibre-PM--//
                                case "00006":       
                                    //--/Question type--//
                                    switch( $question_type ){
                                        case "dynamictextbox":

                                            foreach($panel_val['question'][$question_no]['answer'] as $ans_key => $ans_val):
                                                $answer_no = $ans_val['answer_no'];
                                                $answer_name = $ans_val['answer_name'];
                                                $answer_text = $ans_val['answer_text'];
                                                $answer_value = $ans_val['answer_value'];
        
                                                $answer = $answer."
                                                    <div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-3\">
                                                        <input type=\"text\" class=\"form-control\" name=\"".$answer_name."[]\" id=\"".$answer_name."\" placeholder=\"".$answer_text."\" required>
                                                    </div>";
                                            endforeach;  
                                            echo "
                                                    <div class=\"form-group \">
                                                        <label class=\"control-label col-lg-3 col-md-3 col-sm-3\" for=\"".$question_name."\"></label>".$answer."                                                    
                                                        <button name=\"".$question_name."_addbtn\" id=\"".$question_name."_addbtn\" type=\"button\" class=\"btn btn-round btn-primary\"><span class=\"fa fa-plus\" aria-hidden=\"true\"></span></button>
                                                    </div>
                                                <span id=\"".$question_name."_field\"></span>";             

                                            break;
                                        case "textbox":
                                                $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <input type=\"text\" class=\"form-control\" name=\"".$question_name."\" id=\"".$question_name."\" placeholder=\"".$question_text."\" required>
                                                </div>";
                                                echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";  
                                            break;
                                        case "textarea":  
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
                                                    <textarea name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control\" rows=\"3\" placeholder=\"".$question_text."\"></textarea>
                                                </div>";    
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";  
                                            break;
                                        case "radiobox":
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
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer."
                                                </div>";                                                                              
                                            break;
                                        case "checkbox":
                                            break;
                                        case "selectbox":
                                            foreach($panel_val['question'][$question_no]['answer'] as $ans_key => $ans_val):
                                                $answer_no = $ans_val['answer_no'];
                                                $answer_name = $ans_val['answer_name'];
                                                $answer_text = $ans_val['answer_text'];
                                                $answer_value = $ans_val['answer_value'];
        
                                                if($answer_no  == '1'){ $selected = 'selected'; }else{ $selected = null; }
                                                $answer = $answer."<option value=\"".$answer_value."\"".$selected.">".$answer_text."</option>";

                                            endforeach;  
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-5 col-md-5 col-sm-5 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>
                                                    <div class=\"col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-12\">
                                                        <select name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control selectpicker show-tick\" title=\" \"data-live-search=\"false\" data-size=\"5\" data-width=\"css-width\" required>.$answer.</select>
                                                    </div>
                                                </div>";                                                                              
                                            break;
                                        case "dropbox":
                                            $answer = "
                                                <div class=\"col-lg-6 col-md-9 col-sm-9 col-xs-12\">
                                                    <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control\" multiple>
                                                </div>";      
                                            echo "
                                                <div class=\"form-group \">
                                                    <label class=\"control-label col-lg-3 col-md-2 col-sm-2 col-xs-1\" for=\"".$question_name."\"></label>".$answer."
                                                </div>";
                                            break;
                                    }
                                break;                                 
                            }
                                               
                        endforeach;

                        echo "            
                                    </div>
                                </div>
                            </div>  
                        </div>";                                          
                    endforeach;  
                }                    
                                
            ?>
            <!-- Footer -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <section class="content invoice">
                                <div class="ln_solid"></div>

                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-round btn-default">ยกเลิก</button>
                                            <button id="submit" type="submit" class="btn btn-round btn-primary">บันทึก</button>
                                        </div>
                                    </div>
                            </section>
                        </div>
                    </div>
                </div>  
            </div>  

        </form>        
    
    </div>
</artical>
<!-- /page content -->

<!-- Modal -->
  <!-- loadingModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="waiting_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <? $this->load->view('loading_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /loadingModal -->
<!-- /Modal -->

<!-- page script -->
<script type="text/javascript">

    $(document).ready(function(){
    
    //------Card properties--------//
        
        $('.collapsed').css('height', 'auto');

        // if( ($('#form_id').val() == '00001') || ($('#form_id').val() == '00002') || ($('#form_id').val() == '00003') ){
            $('.collapsed').find('.x_content').css('display', 'none');
        // }

        $('.collapsed').find('a .collapse-link').toggleClass('fa-chevron-up fa-chevron-down');
    //------Card properties--------//

    //------tbEformTicket properties--------//
        $('#tbEformTicket').DataTable({
            "pageLength": 5,
            "paging":   false,
            "ordering": false,
            "info":     false,
            searching: false, 
            "dom": '<"toolbartbEformTicket">frtip'
        });
    //------tbEformTicket properties--------//

    //------dropbox configuration--------//
        $("input[type=file]").fileinput({
            showUpload: false
            ,msgPlaceholder: 'เฉพาะ jpg , jpeg , gif , png ไม่เกิน 6 ภาพ'
            // ,msgPlaceholder: '\'jpg\',\'jpeg\', \'gif\', \'png\' มากสุด 6 ภาพ'
            ,browseLabel: 'แนบภาพ'
            ,removeLabel: 'ลบ'
            ,removeTitle: 'ล้างช่องแนบภาพ'
            ,allowedFileExtensions: ['jpg','jpeg', 'gif', 'png']
            ,maxFileCount: 6
            ,autoOrientImage: true
            // ,previewSettings: {
            //     image: {width: "50%", height: "auto", 'max-width': "100%", 'max-height': "100%"},
            //     other: {width: "213px", height: "160px"}
            // }
            // ,previewSettingsSmall: {
            //     image: {width: "auto", height: "auto", 'max-width': "100%", 'max-height': "100%"},
            //     other: {width: "100%", height: "160px"}
            // }
            ,resizeImage: true
            ,maxImageWidth: 1024
            ,maxImageHeight: 1024
            ,resizePreference: 'width'
        })
    //------dropbox configuration--------//

    //------Dynamic textbox for question294--------//
        var max_fields      = 8; //maximum input boxes allowed
        var wrapper         = $("#question294_field"); //Fields wrapper
        var add_button      = $("#question294_addbtn"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(' \
                    <div class="form-group"> \
                        <label class="control-label col-lg-3 col-md-3 col-sm-3" for="question294"></label> \
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"> \
                            <input type="text" class="form-control" name="core[]" id="core" placeholder="Core No." required> \
                        </div> \
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"> \
                            <input type="text" class="form-control" name="distance[]" id="distance" placeholder="ระยะ (กม.)" required> \
                        </div> \
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"> \
                            <input type="text" class="form-control" name="loss[]" id="loss" placeholder="Loss (dB)" required> \
                        </div> \
                        <button name="question294_removebtn" id="question294_removebtn" type="button" class="btn btn-round btn-danger"><span class="fa fa-minus" aria-hidden="true"></span></button> \
                    </div> \
                ');
            }
        });
        
        $(wrapper).on("click","#question294_removebtn", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    //------Dynamic textbox for question294--------//

    //------Dynamic textbox for question295--------//
    var max_fields      = 8; //maximum input boxes allowed
        var wrapper         = $("#question295_field"); //Fields wrapper
        var add_button      = $("#question295_addbtn"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(' \
                    <div class="form-group"> \
                        <label class="control-label col-lg-3 col-md-3 col-sm-3" for="question295"></label> \
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"> \
                            <input type="text" class="form-control" name="core[]" id="core" placeholder="Core No." required> \
                        </div> \
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"> \
                            <input type="text" class="form-control" name="distance[]" id="distance" placeholder="ระยะ (กม.)" required> \
                        </div> \
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"> \
                            <input type="text" class="form-control" name="loss[]" id="loss" placeholder="Loss (dB)" required> \
                        </div> \
                        <button name="question295_removebtn" id="question295_removebtn" type="button" class="btn btn-round btn-danger"><span class="fa fa-minus" aria-hidden="true"></span></button> \
                    </div> \
                ');
            }
        });
        
        $(wrapper).on("click","#question295_removebtn", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    //------Dynamic textbox for question295--------//

    //------Waiting Modal--------//
        $("form").on('submit', function(){
        $('#waiting_modal').modal({
            backdrop: 'static',
            keyboard: false
        })
      })
    //------Waiting Modal--------//
      
    });
    
</script>        