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
                        <section class="content invoice">
                            <!-- title row -->
                            <center><img src="<?=base_url('assets/img/uninet.png');?>" alt="uninet" height="150px"></center>
                            <div class="row">
                                <div class="col-xs-12 invoice-header">
                                    <h2><?=$checklist['form_name'];?></h2>
                                </div>
                            <!-- /.col -->
                            </div>

                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-7 invoice-col">
                                    <address>
                                        <!-- <strong>โครงการจ้างบำรุงรักษา ซ่อมแซม แก้ไข และปรับเปลี่ยนอุปกรณ์ ระบบเครือข่ายสารสนเทศเพื่อพัฒนาการศึกษา ปีงบประมาณ 2560</strong> -->
                                        <br><br>
                                        <strong>สภานที่: <?=$site_id;?></strong>
                                        <br><b>หมายเลขเคส: </b><?=$ticket_id;?>
                                        <br><b>ทรัพย์สิน: </b> <?=$case_category;?>
                                        <br><b>ประเภท: </b> <?=$case_sub_category;?> 
                                        <br><b>สัญญา: </b> <?=$ma_contract;?>
                                        
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-2 invoice-col">
                                </div>
                                <!-- /.col -->
                                <!-- <div class="col-sm-3 invoice-col">
                                    <b>หมายเลข : equip-cm-2017080100</b>
                                    <br><br><b>ผู้ตรวจสอบ</b> วิชญ์พล แสงอร่าม
                                    <br><b>วันที่ตรวจสอบ</b> 2017-10-01
                                    <br><br><button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> พิมพ์</button> 
                                    <button class="btn btn-success pull-right"><i class="fa fa-edit"></i> แก้ไข</button>
                                    <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF</button>
                                </div> -->
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->                            

                            <form role="form" id="createEform" name="createEform" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('eform/create_ops');?>" method="POST">
                            <input type="hidden" id="schedule_id" name="schedule_id" value="<?=$schedule_id;?>" />
                            <input type="hidden" id="site_id" name="site_id" value="<?=$site_id;?>" />
                            <input type="hidden" id="ticket_id" name="ticket_id" value="<?=$ticket_id;?>" />
                            <input type="hidden" id="form_id" name="form_id" value="<?=$checklist['form_id'];?>" />
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

                                                            $answer = $answer."
                                                                <div class=\"col-md-2 col-sm-2 col-xs-12\">
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
                                                            <div class=\"col-md-4 col-sm-4 col-xs-12 \">
                                                                <input name=\"".$question_name."[]\" id=\"".$question_name."\" type=\"file\" class=\"form-control file\" multiple data-show-upload=\"false\" data-show-caption=\"false\" data-msg-placeholder=\"เลือกภาพที่ต้องการแนบ...\">
                                                            </div>";
                                                        break;    
                                                }

                                                //--Renfer question--//
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
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</artical>
<!-- /page content -->