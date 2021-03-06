<style>
.mask.no-caption .tools {
    margin: 0px 0 0;
}
</style>

<!-- page content -->
<article>
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left"> <h3></h3></div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <!-- <h2>ใบตรวจงาน</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul> -->
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <section class="content invoice">
                                
                                <center><img src="<?=base_url('assets/img/uninet.png');?>" alt="uninet" height="80px"></center>
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <h2><?=$eform[0]['site_name']?></h2>
                                        <h6>จังหวัด<?=$eform[0]['province']?></h6>
                                    </div>
                                </div>
                                <!-- /title row -->

                                <!-- row invoice-info -->
                                <div class="row invoice-info">
                                    <!-- left col -->
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                                        <address>
                                            หมายเลขการตรวจ : <b><?=$eform[0]['eform_id']?><?=$eform[0]['form_id']?></b>
                                            <br>ทรัพย์สิน : <b><?=$eform[0]['asset_type']?></b>
                                            <br>ประเภทงานตรวจ : <b><?=$eform[0]['ma_name']?> (<?=$eform[0]['ma_type']?>)</b>
                                        </address>
                                    </div>
                                    <!-- /left col -->
                                    <!-- right col -->
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                                        ตารางตรวจงาน : <b><a href="<?=site_url('schedule/view/'.$eform[0]['schedule_id']);?>"><?=$eform[0]['schedule_project']." ".$eform[0]['schedule_period']." (".$eform[0]['region'].")"?></a></b>
                                        <br>ผู้ตรวจสอบ : <b><?=$eform[0]['created_by']?></b>
                                        <br>วันที่ตรวจสอบ : <b><?=$eform[0]['created_date']?></b>
                                    </div>
                                    <!-- /right col -->
                                </div>
                                <!-- /row invoice-info -->

                                <!-- Ticket table -->
                                <? if(!empty($ticket)){?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center>
                                    <table id="tbEformTicket" name="tbEformTicket" width="90%" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline">
                                        <thead>
                                            <tr>
                                            <th class="text-center">หมายเลข Ticket</th>
                                            <th class="text-center">ประเภทอุปกรณ์</th>
                                            <th class="text-center">สัญญา</th>
                                            <!-- <th class="text-center">ประเภทงานตรวจ</th> -->
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
                                                <!-- <td class="text-center"><?=$ticket_val['case_type'];?></td> -->
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

                                <!-- .row no-print-->
                                <div class="row no-print">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <!-- <button class="btn btn-round btn-default" onclick="window.print();"><i class="fa fa-print"></i> พิมพ์</button>  -->
                                        <button class="btn btn-round btn-success" onclick="pdfmaker()" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF</button>
                                        <!-- <button class="btn btn-round btn-success" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF2</button> -->
                                        <!-- <a class="btn btn-round btn-success" href="<?=site_url('eform/pdfmaker')?>" name='pdfmaker'><span class="fa fa-download" aria-hidden="true"></span> PDF2</a> -->

                                    </div>
                                </div>                    
                                <!-- /.row no-print -->

                                <div class="ln_solid"></div>
                                <? //echo "<pre>"; print_r($eform_checklist); echo "</pre>"; ?>
                                <? foreach($eform_checklist as $key => $val): ?>

                                <div class="row">
                                    <? 
                                        //--Checklist section--/
                                        echo "<div class=\"col-lg-7 col-md-7 col-sm-8 col-xs-12\"><span class=\"section\">".$val['panel_title']."</span>"; //Header
                                        for($question = 0; $question < count($val['question']); $question++){

                                            $question_no = $val['question'][$question]['question_no'];
                                            $question_name = $val['question'][$question]['question_name'];
                                            $question_text = $val['question'][$question]['question_text'];
                                            $question_value = $val['question'][$question]['question_value'];
                                            $question_type = $val['question'][$question]['question_type'];
                                            $answer_value = $val['question'][$question]['answer_value'];

                                            //--Prepare an answer for each form type--//
                                            $answer = null;
                                            switch( $eform[0]['form_id'] ) {

                                                //--Equipment-AM--//    
                                                case "00001":       
                                                    //--/Question type--//
                                                    switch( $question_type ){
                                                        case "textbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "textarea":  
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "radiobox":  
                                                            foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val):
                                                                $ans_no = $ans_val['answer_no'];
                                                                $ans_name = $ans_val['answer_name'];
                                                                $ans_text = $ans_val['answer_text'];
                                                                $ans_value = $ans_val['answer_value'];
        
                                                                if($ans_value  == $answer_value){$checked = "<i class=\"fa fa-check-circle-o green\" style=\"font-size:20px;\"></i>"; }else{$checked = "<i class=\"fa fa-circle-o\" style=\"font-size:20px;\"></i>";}
        
                                                                $answer = $answer."
                                                                    <div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-5\">
                                                                        <div class=\"radio-inline\">
                                                                            <label>".$checked." ".$ans_text."</label>
                                                                        </div>
                                                                    </div>";  
                                                            endforeach;
                                                            break;
                                                        case "checkbox":
                                                            break;
                                                        case "selectbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                        case "dropbox":
                                                            break;
                                                    }

                                                    //--Render question and its answer--//
                                                    if( ($question_type != 'textbox') && ($question_type != 'textarea') && ($question_type != 'dropbox') && ($question_type != 'dynamictextbox') ){  
                                                        echo "<div class=\"row\">";
                                                        echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                        echo "</div>";
                                                    }else{
                                                        if( !empty($answer_value) ){
                                                            echo "<div class=\"row\">";
                                                            echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                            echo "</div>";
                                                        }
                                                    }
                                                    break;
                                                //--Equipment-AM--//   

                                                //--Equipment-CM--//    
                                                case "00002":       
                                                    //--/Question type--//
                                                    switch( $question_type ){
                                                        case "textbox":
                                                            $answer = "
                                                            <div class=\"col-lg-9 col-md-9 col-sm-9 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "textarea":  
                                                            $answer = "
                                                            <div class=\"col-lg-9 col-md-9 col-sm-9 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "radiobox":  
                                                            break;
                                                        case "checkbox":
                                                            break;
                                                        case "selectbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                        case "dropbox":
                                                            break;
                                                    }

                                                    //--Render question and its answer--//
                                                    if( ($question_type != 'textbox') && ($question_type != 'textarea') && ($question_type != 'dropbox') && ($question_type != 'dynamictextbox') ){  
                                                        echo "<div class=\"row\">";
                                                        echo "<label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                        echo "</div>";
                                                    }else{
                                                        // if( !empty($answer_value) ){
                                                            echo "<div class=\"row\">";
                                                            echo "<label class=\"control-label col-lg-3 col-md-3 col-sm-3 col-xs-12\" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                            echo "</div>";                                                   
                                                        // }
                                                    }
                                                    break;

                                                //--Equipment-PM--//    
                                                
                                                case "00003":       
                                                    //--/Question type--//
                                                    switch( $question_type ){
                                                        case "textbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "textarea":  
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "radiobox":  
                                                            foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val):
                                                                $ans_no = $ans_val['answer_no'];
                                                                $ans_name = $ans_val['answer_name'];
                                                                $ans_text = $ans_val['answer_text'];
                                                                $ans_value = $ans_val['answer_value'];
        
                                                                if($ans_value  == $answer_value){$checked = "<i class=\"fa fa-check-circle-o green\" style=\"font-size:20px;\"></i>"; }else{$checked = "<i class=\"fa fa-circle-o\" style=\"font-size:20px;\"></i>";}
        
                                                                $answer = $answer."
                                                                    <div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-5\">
                                                                        <div class=\"radio-inline\">
                                                                            <label>".$checked." ".$ans_text."</label>
                                                                        </div>
                                                                    </div>";  
                                                            endforeach;
                                                            break;
                                                        case "checkbox":
                                                            break;
                                                        case "selectbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                        case "dropbox":
                                                            break;
                                                    }

                                                    //--Render question and its answer--//
                                                    if( ($question_type != 'textbox') && ($question_type != 'textarea') && ($question_type != 'dropbox') && ($question_type != 'dynamictextbox') ){ 
                                                        echo "<div class=\"row\">";
                                                        echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                        echo "</div>";
                                                    }else{
                                                        if( !empty($answer_value) ){
                                                            echo "<div class=\"row\">";
                                                            echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                            echo "</div>";
                                                        }
                                                    }
                                                    break;
                                                //--Equipment-PM--//    

                                                //--Fibre-AM--//    
                                                case "00004":       
                                                    //--/Question type--//
                                                    switch( $question_type ){
                                                        case "textbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "dynamictextbox":
                                                            if( !empty($eform_checklist_dynamic[$question_no]) ){ 
                                                                echo "
                                                                    <table id=\"".$question_name."\" name=\"".$question_name."\" class=\"table table-striped dt-responsive nowrap dataTable no-footer dtr-inline\">
                                                                    <thead>
                                                                        <tr>
                                                                    ";
                                                                    foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val):
                                                                        echo "<th class=\"text-center\">".$ans_val['answer_text']."</th>";
                                                                    endforeach;
                                                                echo "
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    ";
                                                                    foreach($eform_checklist_dynamic[$question_no] as $item_key => $item_val):
                                                                        echo "<tr>";
                                                                            for($i = 0; $i < count($item_val); $i++ ){
                                                                                echo "<td class=\"text-center\">".$item_val[$i]['item_value']."</td>";
                                                                            }
                                                                        echo "</tr>";
                                                                    endforeach;
                                                                echo "
                                                                    </tbody>
                                                                    </table>
                                                                    ";
                                                            }
                                                            break;                                                            
                                                        case "textarea":  
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "radiobox":  
                                                            foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val):
                                                                $ans_no = $ans_val['answer_no'];
                                                                $ans_name = $ans_val['answer_name'];
                                                                $ans_text = $ans_val['answer_text'];
                                                                $ans_value = $ans_val['answer_value'];
        
                                                                if($ans_value  == $answer_value){$checked = "<i class=\"fa fa-check-circle-o green\" style=\"font-size:20px;\"></i>"; }else{$checked = "<i class=\"fa fa-circle-o\" style=\"font-size:20px;\"></i>";}
        
                                                                $answer = $answer."
                                                                    <div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-5\">
                                                                        <div class=\"radio-inline\">
                                                                            <label>".$checked." ".$ans_text."</label>
                                                                        </div>
                                                                    </div>";  
                                                            endforeach;
                                                            break;
                                                        case "checkbox":
                                                            break;
                                                        case "selectbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "dropbox":
                                                            break;
                                                    }

                                                    //--Render question and its answer--//
                                                    if( ($question_type != 'textbox') && ($question_type != 'textarea') && ($question_type != 'dropbox') && ($question_type != 'dynamictextbox') ){ 
                                                        echo "<div class=\"row\">";
                                                        echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                        echo "</div>";
                                                    }else{
                                                        if( !empty($answer_value) ){
                                                            echo "<div class=\"row\">";
                                                            echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                            echo "</div>";
                                                        }
                                                    }
                                                    break;
                                                //--Fibre-AM--//     

                                                //--Fibre-CM--//    
                                                case "00005":       
                                                    //--/Question type--//
                                                    switch( $question_type ){
                                                        case "textbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "textarea":  
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "radiobox":  
                                                            foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val):
                                                                $ans_no = $ans_val['answer_no'];
                                                                $ans_name = $ans_val['answer_name'];
                                                                $ans_text = $ans_val['answer_text'];
                                                                $ans_value = $ans_val['answer_value'];
        
                                                                if($ans_value  == $answer_value){$checked = "<i class=\"fa fa-check-circle-o green\" style=\"font-size:20px;\"></i>"; }else{$checked = "<i class=\"fa fa-circle-o\" style=\"font-size:20px;\"></i>";}
        
                                                                $answer = $answer."
                                                                    <div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-5\">
                                                                        <div class=\"radio-inline\">
                                                                            <label>".$checked." ".$ans_text."</label>
                                                                        </div>
                                                                    </div>";  
                                                            endforeach;
                                                            break;
                                                        case "checkbox":
                                                            break;
                                                        case "selectbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "dropbox":
                                                            break;
                                                    }

                                                    //--Render question and its answer--//
                                                    if( ($question_type != 'textbox') && ($question_type != 'textarea') && ($question_type != 'dropbox') && ($question_type != 'dynamictextbox') ){ 
                                                        echo "<div class=\"row\">";
                                                        echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                        echo "</div>";
                                                    }else{
                                                        if( !empty($answer_value) ){
                                                            echo "<div class=\"row\">";
                                                            echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                            echo "</div>";
                                                        }
                                                    }
                                                    break;
                                                //--Fibre-CM--//       
                                                
                                                //--Fibre-PM--//    
                                                case "00006":       
                                                    //--/Question type--//
                                                    switch( $question_type ){
                                                        case "textbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        
                                                        case "dynamictextbox":
                                                            if( !empty($eform_checklist_dynamic[$question_no]) ){ 
                                                                echo "
                                                                    <table id=\"".$question_name."\" name=\"".$question_name."\" class=\"table table-striped dt-responsive nowrap dataTable no-footer dtr-inline\">
                                                                    <thead>
                                                                        <tr>
                                                                    ";
                                                                    foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val):
                                                                        echo "<th class=\"text-center\">".$ans_val['answer_text']."</th>";
                                                                    endforeach;
                                                                echo "
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    ";
                                                                    foreach($eform_checklist_dynamic[$question_no] as $item_key => $item_val):
                                                                        echo "<tr>";
                                                                            for($i = 0; $i < count($item_val); $i++ ){
                                                                                echo "<td class=\"text-center\">".$item_val[$i]['item_value']."</td>";
                                                                            }
                                                                        echo "</tr>";
                                                                    endforeach;
                                                                echo "
                                                                    </tbody>
                                                                    </table>
                                                                    ";
                                                            }
                                                            break;
                                                        case "textarea":  
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "radiobox":  
                                                            foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val):
                                                                $ans_no = $ans_val['answer_no'];
                                                                $ans_name = $ans_val['answer_name'];
                                                                $ans_text = $ans_val['answer_text'];
                                                                $ans_value = $ans_val['answer_value'];
        
                                                                if($ans_value  == $answer_value){$checked = "<i class=\"fa fa-check-circle-o green\" style=\"font-size:20px;\"></i>"; }else{$checked = "<i class=\"fa fa-circle-o\" style=\"font-size:20px;\"></i>";}
        
                                                                $answer = $answer."
                                                                    <div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-5\">
                                                                        <div class=\"radio-inline\">
                                                                            <label>".$checked." ".$ans_text."</label>
                                                                        </div>
                                                                    </div>";  
                                                            endforeach;
                                                            break;
                                                        case "checkbox":
                                                            break;
                                                        case "selectbox":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                            break;
                                                        case "dropbox":
                                                            break;
                                                    }

                                                    //--Render question and its answer--//
                                                    if( ($question_type != 'textbox') && ($question_type != 'textarea') && ($question_type != 'dropbox') && ($question_type != 'dynamictextbox') ){ 
                                                        echo "<div class=\"row\">";
                                                        echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                        echo "</div>";
                                                    }else{
                                                        if( !empty($answer_value) ){
                                                            echo "<div class=\"row\">";
                                                            echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-4 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                            echo "</div>";
                                                        }
                                                    }
                                                    break;
                                                //--Fibre-PM--//                                                  
                                            }

                                        }
                                        echo "</div>";
                                        //--/Checklist section--/

                                        //--Attachment section--/
                                        if(!empty($eform_attachment[$key])){
                                            echo "<div class=\"col-lg-5 col-md-5 col-sm-4 col-xs-12\"><span class=\"section\">ภาพประกอบ</span>"; //Header
                                            for($attachment = 0; $attachment < count($eform_attachment[$key]); $attachment++){
                                            echo "  <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
                                                        <div class=\"image view view-first\">
                                                            <center><img style=\"width: 50%; display: block;\" src=\"".base_url('files/eform/'.$eform_attachment[$key][$attachment]['attachment_path'])."\" alt=\"ภาพประกอบ\" /></center>
                                                            <div class=\"mask no-caption\">
                                                                <div class=\"tools tools-bottom\">
                                                                <a href=\"".base_url('files/eform/'.$eform_attachment[$key][$attachment]['attachment_path'])."\"><i class=\"fa fa-arrows-alt\"></i> ขยาย</a> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "</div>";
                                        }
                                        //--/Attachment section--/
                                    ?>

                                </div> <!--/end row-->

                                <? endforeach; ?>
                                <!-- /Eform note -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="section">บันทึกข้อความ</span>
                                        <span id="panelEformNote">
                                        <? if($permission->eform_add){ ?>
                                            <a href="#" class="btn btn-round btn-success btn-xs pull-right" id='addEformNote' name='addEformNote' data-toggle="modal" data-target="#addEformNoteModal"  ><span class="fa fa-plus" aria-hidden="true"></span> บันทึก</a>
                                        <? } ?>
                                        </span>
                                        <table id="tbEformNote" name="tbEformNote" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                <th class="text-center">วันที่</th>
                                                <th class="text-center">ข้อความ</th>
                                                <th class="text-center">ผู้บันทึก</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            <? 
                                            // echo "<pre>"; print_r($eform_note); echo "</pre>";
                                            if(!empty($eform_note)){ 
                                                foreach($eform_note as $note_key => $note_val):
                                            ?>
                                                <tr>
                                                    <td class="text-left"><?=$note_val['created_date'];?></td>
                                                    <td class="text-center"><?=$note_val['note_detail'];?></td>
                                                    <td class="text-center"><?=$note_val['created_by'];?></td>
                                                </tr>  
                                            <?      
                                                endforeach;
                                            }
                                            ?>                            
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                </div>
                                <!--/Eform note-->
                            </section>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</artical>
<!-- /page content -->

<!-- modal content -->
  <!-- addEformNoteModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="addEformNoteModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <? $this->load->view('eform/add_note_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /addEformNoteModal -->
<!-- /modal content -->  

<!-- page script -->
<script type="text/javascript">
$(document).ready(function(){

    $('#tbEformTicket').DataTable({
        "pageLength": 5,
        "paging":   false,
        "ordering": false,
        "info":     false,
        searching: false, 
        "dom": '<"toolbartbEformTicket">frtip'
        });

    $('#tbEformNote').DataTable({
        "pageLength": 10,
        "paging":   false,
        "ordering": true,
        "info":     false,
        language: { search: "_INPUT_" , searchPlaceholder: "ค้นหา..." }, //remove "search" label and put in placeholder
        "dom": '<"toolbartbEformNote">frtip'
        });

    $("div.toolbartbEformNote").html('<span id="tbEformNote_filter2" class="dataTables_filter"></span>');
    //Search box
    $('#tbEformNote_filter').css('display','none');
    $('#tbEformNote_filter').css('text-align','left');

    $('#tbEformNote_filter2').css('float','right');
    $('#tbEformNote_filter2').append($('#panelEformNote'));
    $("div.toolbartbEformNote").append($('#tbEformNote_filter'));

    $('#tbEformNote').removeClass('hidden');

    $('#addEformNoteModal').on('show.bs.modal', function(e) {
      var schedule_id = $(e.relatedTarget).data('schedule_id')
      var schedule_name = $(e.relatedTarget).data('schedule_name')
      var schedule_description = $(e.relatedTarget).data('schedule_description')
      var name = $(e.relatedTarget).data('name')

      $("#addEformNoteModal .modal-header .modal-title").html('เพิ่มบันทึกข้อความ');
      $("#addEformNoteModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกเป็นกรรมการการตรวจงาน<BR><BR><b>'+schedule_description+'</b><BR><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="name"]').val(name);
    });

});

function pdfmaker() {

    pdfMake.fonts = {
        THSarabun: {
            normal: 'THSarabun.ttf',
            bold: 'THSarabun-Bold.ttf',
            italics: 'THSarabun-Italic.ttf',
            bolditalics: 'THSarabun-BoldItalic.ttf'
        }
    }

    var docDefinition = { 
        
        defaultStyle: {
            font: 'THSarabun'
        },

        content: [
            //--- Header ---//

                {
                    <? 
                        $contents = file_get_contents( base_url('assets/img/uninet.png'), true);
                        $img = base64_encode($contents);
                    ?>
                    image :  'data:image/jpeg;base64,<?=$img;?>',
                    fit: [80, 80],
                    alignment: 'center',
                    margin: [0, -30, 0, 0]
                },

                {
                    text: '<?=$eform[0]['site_name']?>',
                    style: 'header',
                    alignment: 'center'
                },

                {
                    text: 'จังหวัด<?=$eform[0]['province']?>\n\n',
                    style: 'subheader',
                    alignment: 'center'
                },
            //--- /Header ---//

            //--- Subheader ---//
                {
                    columns: [
                        {
                            text: [
                                'หมายเลขการตรวจ : ',
                                {text: '<?=$eform[0]['eform_id']?><?=$eform[0]['form_id']?>', bold: true},
                                '\nประเภททรัพย์สิน : ',
                                {text: '<?=$eform[0]['asset_type']?>', bold: true},
                                '\nประเภทงานตรวจ : ',
                                {text: '<?=$eform[0]['ma_name']?> (<?=$eform[0]['ma_type']?>)', bold: true}
                            ],
                            style: 'subheader',
                            alignment: 'center'
                        },
                        {
                            text: [
                                'ตารางตรวจงาน : ',
                                {text: '<?=$eform[0]['schedule_project']." ".$eform[0]['schedule_period']." (".$eform[0]['region'].")"?>', bold: true},
                                '\nผู้ตรวจสอบ  : ',
                                {text: '<?=$eform[0]['created_by']?>', bold: true},
                                '\nวันที่ตรวจสอบ : ',
                                {text: '<?=$eform[0]['created_date']?>', bold: true}
                            ],
                            style: 'subheader',
                            alignment: 'center'
                        }
                    ]
                },
                {
                    text: '\n',
                },

            //--- /Subheader ---//

            // --- Add horizon line --//
                // '\n',
                {
                    canvas: [
                        {
                            type: 'line',
                            x1: 0,
                            y1: 5,
                            x2: 535,
                            y2: 5,
                            lineWidth: 1.0
                        }
                    ]
                },
                '\n',
            // --- /Add horizon line --//

            // --- Ticket table ---//
                <? if(!empty($ticket)){ ?>
                    {
                        text: 'ข้อมูล Ticket',
                        style: 'header',
                    },
                    {
                        // columns: [
                            // {
                                style: 'tableExample',
                                table: {
                                    widths: ['*', '*', '*'],
                                    headerRows: 1,
                                    body: [
                                        [{text: 'หมายเลข Ticket', style: 'tableHeader'}, {text: 'ประเภทอุปกรณ์', style: 'tableHeader'}, {text: 'สัญญา', style: 'tableHeader'}],
					
                                        <? if(!empty($ticket)){ ?>
                                            <? foreach($ticket as $ticket_key => $ticket_val): ?>
                                                ['<?=$ticket_val['case_id'];?>' , '<?=$ticket_val['case_sub_category'];?>' , '<?=$ticket_val['contract'];?>'],
                                            <? endforeach; ?>
                                        <? } ?>
                                    ]
                                },
                                alignment: 'center',
                                layout: 'headerLineOnly',
                                margin: [10, 0, 0, 0],
                            // },
                        // ],
                        
                    },
                    {
                        text: '\n',
                    },
                <? } ?>   
            // --- /Ticket table ---//

            // --- Add horizon line --//
                // {
                //     canvas: [
                //         {
                //             type: 'line',
                //             x1: 0,
                //             y1: 5,
                //             x2: 535,
                //             y2: 5,
                //             lineWidth: 1.0
                //         }
                //     ]
                // },
                // '\n',
            // --- /Add horizon line --//

            // --- Panel ---//
                <? 
                    $panel = 1; 
                    foreach($eform_checklist as $key => $val): 
                ?>
                                
                    { text: '<?=$val['panel_title']?>', style: 'header' },

                //--- Checklist---//    
                    {
                        style: 'tableExample',
                        table: {
                            headerRows: 0,
                            body: [

                        <?
                            for($question = 0; $question < count($val['question']); $question++){

                            $question_no = $val['question'][$question]['question_no'];
                            $question_text = $val['question'][$question]['question_text'];
                            $question_type = $val['question'][$question]['question_type'];
                            $answer_value = $val['question'][$question]['answer_value'];
                            
                            if( $question_type != 'dynamictextbox'){
                                if( $answer_value != NULL ){
                        ?>    
                                [ '','','<?=$question_text;?> :','','<?=$answer_value;?>' ],

                        <?     
                                }
                            }elseif( $question_type == 'dynamictextbox'){
                                if( !empty($eform_checklist_dynamic[$question_no]) ){ 
                        ?>  
                                [ '','',
                                    [
                                        {   //colSpan: 3,
                                            style: 'tableExample',
                                            table: {
                                                // widths: ['*', '*', '*'],
                                                widths: [
                                                    <? foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val): ?>
                                                            '*',
                                                    <? endforeach; ?>
                                                    ],
                                                headerRows: 1,
                                                body: [
                                                    [
                                                        <? foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val): ?>
                                                            '<?=$ans_val['answer_text'];?>',
                                                        <? endforeach; ?>
                                                    ],
                                                    <? foreach($eform_checklist_dynamic[$question_no] as $item_key => $item_val): ?>
                                                    [
                                                        <? for($i = 0; $i < count($item_val); $i++ ){?>
                                                            '<?=$item_val[$i]['item_value'];?>',
                                                        <? } ?>
                                                    ],
                                                    <? endforeach; ?>
                                                ]
                                            },
                                            layout: 'headerLineOnly'
                                        }
                                    ], 
                                '','' ],
                        <?
                                }
                            }
                            }
                        ?>
                            ]
                        },
                        layout: 'headerLineOnly'
                    
                    },
                    '\n',
                //--- /Checklist---//    

                //--- Attached photo---//
                    <? if(!empty($eform_attachment[$key])){ ?>
                        { text: 'ภาพประกอบ', style: 'header' },

                    //--Picture row 1 --//
                        <? if( !empty($eform_attachment[$key][0]['attachment_path']) ){ ?>
                            {   
                                columns: [
                                    
                                    <? if( !empty($eform_attachment[$key][0]['attachment_path']) ){ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/files/eform/'.$eform_attachment[$key][0]['attachment_path'], true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                        },
                                    <? }else{ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/img/white_bg.jpg', true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                        },                           
                                    <? } ?>
                                    <? if( !empty($eform_attachment[$key][1]['attachment_path']) ){ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/files/eform/'.$eform_attachment[$key][1]['attachment_path'], true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                            // pageBreak: 'after',
                                        },
                                    <? }else{ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/img/white_bg.jpg', true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                            // pageBreak: 'after', 
                                        },                           
                                    <? } ?>
                                    
                                ],
                                
                            },
                            
                            {
                                text :'\n',
                            },
                        <? } ?>

                    //--Picture row 2 --//
                        <? if( !empty($eform_attachment[$key][2]['attachment_path']) ){ ?>
                            {   
                                columns: [
                                    <? if( !empty($eform_attachment[$key][2]['attachment_path']) ){ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/files/eform/'.$eform_attachment[$key][2]['attachment_path'], true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                        },
                                    <? }else{ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/img/white_bg.jpg', true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                            // pageBreak: 'after', 
                                        },                           
                                    <? } ?>
                                    <? if( !empty($eform_attachment[$key][3]['attachment_path']) ){ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/files/eform/'.$eform_attachment[$key][3]['attachment_path'], true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                            // pageBreak: 'after', 
                                        },
                                    <? }else{ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/img/white_bg.jpg', true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                            // pageBreak: 'after', 
                                        },                           
                                    <? } ?>
                                    
                                ],
                            },
                            {
                                text :'\n',
                            },
                        <? } ?>

                    //--Picture row 3 --//
                        <? if( !empty($eform_attachment[$key][4]['attachment_path']) ){ ?>
                            {
                                columns: [
                                    <? if( !empty($eform_attachment[$key][4]['attachment_path']) ){ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/files/eform/'.$eform_attachment[$key][4]['attachment_path'], true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                        },

                                    <? }else{ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/img/white_bg.jpg', true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                        },   
                        
                                    <? } ?>
                                    <? if( !empty($eform_attachment[$key][5]['attachment_path']) ){ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/files/eform/'.$eform_attachment[$key][5]['attachment_path'], true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                            // pageBreak: 'after',
                                        },
                                    <? }else{ ?>
                                        {
                                            <? 
                                                $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/img/white_bg.jpg', true);
                                                $img = base64_encode($contents);
                                            ?>
                                            image :  'data:image/jpeg;base64,<?=$img;?>',
                                            fit: [250, 250],
                                            alignment: 'center',
                                            pageBreak: 'after', 
                                        },                           
                                    <? } ?>
                                ],
                                
                            },
                            {
                                text :'\n',
                            },
                        <? } ?>
                    <? } ?>
                //--- /Attached photo---/

                // --- Pagebreak ---//    
                    <? if($panel < count($eform_checklist) ){ ?>
                    {
                        text: '',
                        pageBreak: "after" // or after
                    },
                    <? } ?>
                // --- /Pagebreak ---//    
                <? 
                    $panel++;
                    endforeach; 
                ?>
            //--- /Panel ---/    
                 
            //--- Note ---//
                <? if(!empty($eform_note)){ ?>
                    {text: 'บันทึกข้อความ', style: 'header'},
                    {
                        style: 'tableExample',
                        table: {
                            headerRows: 1,
                            widths: ['*', '*', '*'],
                            body: [
                                [{text: 'วันที่', style: 'tableHeader'}, {text: 'ข้อความบันทึก', style: 'tableHeader'}, {text: 'ผู้บันทึก', style: 'tableHeader'}],
                                <? foreach($eform_note as $note_key => $note_val): ?>
                                [ '<?=$note_val['created_date'];?>' , '<?=$note_val['note_detail'];?>' , '<?=$note_val['created_by'];?>' ],
                                <? endforeach; ?>
                                ]
                        },
                        alignment: 'center',
                        layout: 'headerLineOnly',
                        margin: [10, 0, 0, 0],
                    },
                <? } ?>
            //--- /Note ---//
        ],

    // --- Style --- //
        styles: {
            header: {
                fontSize: 18,
                bold: true
            },
            subheader: {
                fontSize: 12,
                // bold: true
            },
            quote: {
                italics: true
            },
            small: {
                fontSize: 8
            }
	    }
        
    // --- /Style ---//
    };


    // open the PDF in a new window
    pdfMake.createPdf(docDefinition).open();

    // print the PDF
    pdfMake.createPdf(docDefinition).print();

    // download the PDF
    pdfMake.createPdf(docDefinition).download('optionalName.pdf');

}

</script>