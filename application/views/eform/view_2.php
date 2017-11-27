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
                            <h2><?=$eform[0]['form_name']?></h2>
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <h1><?=$eform[0]['site_name']?></h1>
                                    </div>
                                <!-- /.col -->
                                </div>

                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                                        <address>
                                            <b>สัญญา :</b> <?=$eform[0]['contract']?>
                                            <br><b>เจ้าหน้าที่ประจำสถานที่ :</b> <?=$eform[0]['contact']?>
                                            <br><b>หมายเลขเคส :</b> <a href="#" target="_blank"><?=$eform[0]['case_id']?></a>
                                            <br><b>ทรัพย์สิน :</b> <?=$eform[0]['case_sub_category']?>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <!-- /.col -->
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                                        <b>หมายเลขการตรวจ : <?=$eform[0]['eform_id']?></b>
                                        <br><b>ตารางงาน : <a href="#"><?=$eform[0]['schedule_name']?></a></b>
                                        <br><b>ผู้ตรวจสอบ</b> <?=$eform[0]['created_by']?></b>
                                        <br><b>วันที่ตรวจสอบ</b> <?=$eform[0]['created_date']?></b>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                
                                <!-- .row -->
                                <div class="row no-print">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <button class="btn btn-round btn-default" onclick="window.print();"><i class="fa fa-print"></i> พิมพ์</button> 
                                        <button class="btn btn-round btn-success" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF</button>
                                    </div>
                                </div>                    
                                <!-- /.row -->

                                <div class="ln_solid"></div>

                                <div class="row">

                                    <!-- Checklist -->
                                    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                        
                                            <? 
                                                // echo "<pre>"; print_r($eform_checklist); echo "</pre>";
                                                // echo "<pre>"; print_r($eform_checklist_answer); echo "</pre>";
                                                foreach($eform_checklist as $key => $val):
                                                    echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\"><span class=\"section\">".$val['panel_name']."</span></div>";  
                                                    
                                                    // echo "<pre>"; print_r($val['question']); echo "</pre>";
                                                    // echo count($val['question']);
                                                    for($question = 0; $question < count($val['question']); $question++){
                                                        // echo $question;
                                                        $question_no = $val['question'][$question]['question_no'];
                                                        $question_name = $val['question'][$question]['question_name'];
                                                        $question_text = $val['question'][$question]['question_text'];
                                                        $question_value = $val['question'][$question]['question_value'];
                                                        $question_type = $val['question'][$question]['question_type'];
                                                        $answer_value = $val['question'][$question]['answer_value'];
                                                        
                                                        // echo "<pre>"; print_r($val['question'][$question]); echo "</pre>";
                                                        switch( $question_type ){
                                                            case "textbox":
                                                                $answer = null;
                                                                $answer = "
                                                                    <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\">".$answer_value."</div>";
                                                                break;
                                                            case "textarea":
                                                                $answer = null;
                                                                $answer = "
                                                                    <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\">".$answer_value."</div>";
                                                                break;
                                                            case "radiobox":
                                                                $answer = null;
                                                                // echo "<pre>"; print_r($eform_checklist_answer[$key][$question_no]); echo "</pre>";
                                                                foreach($eform_checklist_answer[$key][$question_no] as $ans_key => $ans_val):
                                                                    $ans_no = $ans_val['answer_no'];
                                                                    $ans_name = $ans_val['answer_name'];
                                                                    $ans_text = $ans_val['answer_text'];
                                                                    $ans_value = $ans_val['answer_value'];
        
                                                                    // if($ans_value  == $answer_value){$checked = "<i class=\"fa fa-check-square-o\"></i>"; }else{$checked = "<i class=\"fa fa-square-o\"></i>";}
                                                                    if($ans_value  == $answer_value){$checked = "<i class=\"fa fa-check-circle-o\"></i>"; }else{$checked = "<i class=\"fa fa-circle-o\"></i>";}
        
                                                                    $answer = $answer."
                                                                        <div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-5\">
                                                                            <div class=\"radio-inline\">
                                                                                <label>".$checked." ".$ans_text."</label>
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
                                                                    <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\">
                                                                        <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control file\" multiple data-show-upload=\"false\" data-show-caption=\"false\" data-msg-placeholder=\"เลือกภาพที่ต้องการแนบ...\">
                                                                    </div>";
                                                                break;    
                                                        }
                                                        
                                                        //--Renfer question--//
                                                        echo "
                                                        <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
                                                            <label class=\"control-label col-lg-5 col-md-6 col-sm-6 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer."
                                                        </div>";
                                                    }
                                                endforeach;
                                            ?>
                                        </div>
                                                                      
                                    </div>
                                    <!-- /Checklist --> 
                                           
                                    <!-- /Attachment-->
                                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                                    <!-- echo "<div class=\"col-md-12 col-sm-12 col-xs-12\"><span class=\"section\">".$val['panel_name']."</span></div>";   -->
                                        <span class="section">ภาพประกอบ</span>
                                        <div class="row">    
                                            <div class="col-xs-6 col-xs-6 col-xs-12">
                                                <!-- <div class="thumbnail"> -->
                                                    <div class="image view view-first">
                                                        <img style="width: 100%; display: block;" src="<?=base_url('assets/img/media.jpg');?>" alt="image" />
                                                        <div class="mask no-caption">
                                                            <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="caption">
                                                        <!-- <p><strong>ภาพด้านหน้า</strong></p> -->
                                                    </div>
                                                <!-- </div> -->
                                            </div>

                                            <div class="col-xs-6 col-xs-6 col-xs-12">
                                                <!-- <div class="thumbnail"> -->
                                                    <div class="image view view-first">
                                                        <img style="width: 100%; display: block;" src="<?=base_url('assets/img/media.jpg');?>" alt="image" />
                                                        <div class="mask no-caption">
                                                            <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="caption">
                                                        <p><strong>ภาพข้างซ้าย</strong></p>
                                                    </div> -->
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <div class="row">  
                                            <div class="col-xs-6 col-xs-6 col-xs-12">
                                                <!-- <div class="thumbnail"> -->
                                                    <div class="image view view-first">
                                                        <img style="width: 100%; display: block;" src="<?=base_url('assets/img/media.jpg');?>" alt="image" />
                                                        <div class="mask no-caption">
                                                            <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="caption">
                                                        <!-- <p><strong>ภาพด้านหน้า</strong></p> -->
                                                    </div>
                                                <!-- </div> -->
                                            </div>
                                            
                                            <div class="col-xs-6 col-xs-6 col-xs-12">
                                                <!-- <div class="thumbnail"> -->
                                                    <div class="image view view-first">
                                                        <img style="width: 100%; display: block;" src="<?=base_url('assets/img/media.jpg');?>" alt="image" />
                                                        <div class="mask no-caption">
                                                            <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="caption">
                                                        <!-- <p><strong>ภาพด้านหน้า</strong></p> -->
                                                    </div>
                                                <!-- </div> -->
                                            </div>                            

                                        </div>
                                    </div>
                                    <!-- /Attachment--> 
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</artical>
<!-- /page content -->