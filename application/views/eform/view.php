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
                            <h2>แบบตรวจสอบออนไลน์</h2>
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
                            <section class="content invoice">
                                <!-- title row -->
                                <center><img src="<?=base_url('assets/img/uninet.png');?>" alt="uninet" height="100px"></center>
                                <div class="row">
                                    <div class="col-xs-12 invoice-header">
                                        <h2><?=$eform[0]['form_name']?></h2>
                                    </div>
                                <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-7 invoice-col">
                                        <address>
                                            <h2><?=$eform[0]['site_name']?></h2>
            
                                            <b>สัญญา :</b> <?=$eform[0]['contract']?>
                                            <br><b>เจ้าหน้าที่ประจำสถานที่ :</b> <?=$eform[0]['contact']?>
                                            <br><b>หมายเลขเคส :</b> <a href="#" target="_blank"><?=$eform[0]['case_id']?></a>
                                            <br><b>ทรัพย์สิน :</b> <?=$eform[0]['case_sub_category']?>
                                            
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 invoice-col">
                    
                                    </div>
                                    <!-- /.col -->
                                    <div class="<col-sm-4 invoice-col">
                                        <br><br><b>หมายเลขการตรวจ : <?=$eform[0]['eform_id']?></b>
                                        <br><b>ตารางงาน : <a href="<?=site_url('schedule/view/'.$eform[0]['schedule_id'])?>"><?=$eform[0]['schedule_name']?></a></b>
                                        <br><b>ผู้ตรวจสอบ</b> <?=$eform[0]['created_by']?></b>
                                        <br><b>วันที่ตรวจสอบ</b> <?=$eform[0]['created_date']?></b>
                                        <!-- <button class="btn btn-round btn-default pull-right" onclick="window.print();"><i class="fa fa-print"></i> พิมพ์</button>  -->
                                        <!-- <button class="btn btn-round  btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF</button> -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <div class="row no-print">
                                    <div class="<col-sm-12 invoice-col">
                                        <button class="btn btn-round btn-default pull-right" onclick="window.print();"><i class="fa fa-print"></i> พิมพ์</button> 
                                        <button class="btn btn-round  btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF</button>
                                    </div>
                                    <!-- /.col -->
                                </div>                    
                                <!-- /.row -->
                                <div class="ln_solid"></div>

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-md-7 col-md-7 col-md-12">
                                    <!-- Router -->
                                        <div class="row">
                                        
                                            <? 
                                                // echo "<pre>"; print_r($eform_checklist); echo "</pre>";
                                                foreach($eform_checklist as $key => $val):
                                                    echo "<div class=\"col-md-12 col-md-12 col-md-12\"><span class=\"section\">".$val['panel_name']."</span></div>";  
                                                    
                                                    // echo "<pre>"; print_r($val['question']); echo "</pre>";
                                                    // echo count($val['question']);
                                                    for($question = 0; $question < count($val['question']); $question++){
                                                        // echo $question;
                                                        $question_no = $val['question'][$question]['question_no'];
                                                        $question_name = $val['question'][$question]['question_name'];
                                                        $question_text = $val['question'][$question]['question_text'];
                                                        $question_value = $val['question'][$question]['question_value'];
                                                        $question_type = $val['question'][$question]['question_type'];

                                                        // echo "<pre>"; print_r($val['question'][$question]); echo "</pre>";
                                                        // switch( $question_type ){
                                                        //     case "textbox":
                                                        //         $answer = null;
                                                        //         $answer = "
                                                        //             <div class=\"col-md-4 col-sm-4 col-xs-12 \">
                                                        //                 <input type=\"text\" class=\"form-control col-md-7 col-xs-12\" name=\"".$question_name."\" id=\"".$question_name."\">
                                                        //             </div>";
                                                        //         break;
                                                        //     case "textarea":
                                                        //         $answer = null;
                                                        //         $answer = "
                                                        //             <div class=\"col-md-4 col-sm-4 col-xs-12 \">
                                                        //                 <textarea name=\"".$question_name."\" id=\"".$question_name."\" class=\"form-control\" rows=\"3\"></textarea>
                                                        //             </div>";
                                                        //         break;
                                                        //     case "radiobox":
                                                        //         $answer = null;
                                                        //         foreach($val['question'][$question]['answer'] as $ans_key => $ans_val):
                                                        //             $answer_no = $ans_val['answer_no'];
                                                        //             $answer_name = $ans_val['answer_name'];
                                                        //             $answer_text = $ans_val['answer_text'];
                                                        //             $answer_value = $ans_val['answer_value'];
        
                                                        //             if($answer_name  == 'passed'){$checked = 'checked'; }else{$checked = null;}
        
                                                        //             $answer = $answer."
                                                        //                 <div class=\"col-md-2 col-sm-2 col-xs-12\">
                                                        //                     <div class=\"radio-inline\">
                                                        //                         <label><input type=\"radio\" class=\"flat\" name=\"".$question_name."\" id=\"".$question_name."\" value=\"".$answer_value."\" ".$checked."> ".$answer_text."</label>
                                                        //                     </div>
                                                        //                 </div>";  
                                                        //         endforeach;
                                                        //         break;
                                                        //     case "checkbox":
                                                        //         $answer = null;
                                                                
                                                        //         break;
                                                        //     case "selectbox":
                                                        //         $answer = null;
                                                        //         break;
                                                        //     case "dropbox":
                                                        //         $answer = null;
                                                        //         $answer = "
                                                        //             <div class=\"col-md-4 col-sm-4 col-xs-12 \">
                                                        //                 <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control file\" multiple data-show-upload=\"false\" data-show-caption=\"false\" data-msg-placeholder=\"เลือกภาพที่ต้องการแนบ...\">
                                                        //             </div>";
                                                        //         break;    
                                                        // }
                                                        
                                                        //--Renfer question--//
                                                        echo "
                                                        <div class=\"col-md-12 col-md-12 col-md-12 \">
                                                            <label class=\"control-label col-md-7 col-md-7 col-md-12\" for=\"".$question_name."\">".$question_text."</label>
                                                            <div class=\"col-sm-2 col-sm-2 col-xs-12\">
                                                                <div class=\"radio-inline\">
                                                                <label><input type=\"radio\" class=\"flat\" name=\"".$question_name."\" id=\"".$question_name."\" value=\"\"> ผ่าน</label>
                                                                </div>
                                                            </div>
                                                            <div class=\"col-sm-3 col-sm-3 col-xs-12\">
                                                                <div class=\"radio-inline\">
                                                                <label><input type=\"radio\" class=\"flat\" name=\"".$question_name."\" id=\"".$question_name."\" value=\"\"> ไม่ผ่าน</label>
                                                                </div>
                                                            </div>
                                                        </div>";
                                                    }
                                                endforeach;
                                            ?>
                                        </div>
                                    <!-- /Router -->
                                    </div>

                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <!-- <div class="row no-print">
                                    <div class="col-sm-9 invoice-col"></div>
                                    <div class="col-xs-3">
                                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> พิมพ์</button>
                                        <button class="btn btn-success pull-right"><i class="fa fa-edit"></i> แก้ไข</button>
                                        <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF</button>
                                    </div>
                                </div> -->

                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</artical>
<!-- /page content -->