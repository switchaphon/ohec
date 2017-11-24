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
                        <h2>สร้างแบบตรวจออนไลน์ <small>(Eform)</small></h2>
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
                    <form role="form" id="createSchedule" name="createSchedule" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('schedule/create_ops');?>" method="POST">
                            <!-- <span class="section"><small>ข้อมูลตารางตรวจงาน</small></span> -->
                            <!-- <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">ชื่อ <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="name"  name="name" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">รายละเอียด <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="description"  name="description" class="form-control col-md-7 col-xs-12" required></textarea>
                                </div>
                            </div>
  -->

                            <!-- <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-md-9 text-right">
                                <button type="submit" class="btn btn-round btn-default">ยกเลิก</button>
                                <button id="submit" type="submit" class="btn btn-round btn-primary">บันทึก</button>
                                </div>
                            </div>
                        </form> -->
                    <?
                        echo $schedule_id;
                        echo $site_id;
                        echo $ticket_id;
                        echo $case_category;
                        echo $case_sub_category;
                        echo $ma_type;
                        echo $ma_contract; 
                        echo "<BR>";
                        
                        //--/Get form properties
                        echo $checklist['form_id']." : ".$checklist['form_name']."<BR>";
                        // echo count($checklist['page']);
                        
                        //--Get page's properties
                        for($page_no = 1; $page_no <= count($checklist['page']); $page_no++){
                            echo "page_name: ".$checklist['page'][$page_no]['page_name']."page_title: ".$checklist['page'][$page_no]['page_title']."<BR>";
                            
                            //--Get panel's properties
                            for($panel_no = 1; $panel_no <= count($checklist['page'][$page_no]['panel']); $panel_no++){
                                echo $panel_no.": ".$checklist['page'][$page_no]['panel'][$panel_no]['panel_name']."<BR>";
                            
                                //--Get panel's questions
                                for($question_no = 1; $question_no <= count($checklist['page'][$page_no]['panel'][$panel_no]['question']); $question_no++){
                                    echo "<pre>"; print_r($checklist['page'][$page_no]['panel'][$panel_no]['question'][$question_no]); echo "</pre>";
                                    foreach($checklist['page'][$page_no]['panel'][$panel_no]['question'][$question_no] as $question):
                                        // if(!$question['answer']){
                                        echo $question."<BR>";
                                        // echo "<div class=\"form-group\"> <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"".$question['question_name']."\">".$question['question_text']."<span class=\"required\"></span></label></div>";
                                        // }else{
                                        //     for($answer_no = 1; $answer_no <= count($checklist['page'][$page_no]['panel'][$panel_no]['question'][$question_no]['answer']); $answer_no++ ){
                                        //         $answer_name = $checklist['page'][$page_no]['panel'][$panel_no]['question'][$question_no]['answer'][$answer_no]['answer_name'];
                                        //         $answer_text = $checklist['page'][$page_no]['panel'][$panel_no]['question'][$question_no]['answer'][$answer_no]['answer_text'];
                                        //         $answer_value = $checklist['page'][$page_no]['panel'][$panel_no]['question'][$question_no]['answer'][$answer_no]['answer_value'];
                                                
                                        //         echo "
                                        //         <div class=\"radio\">
                                        //             <label class=\">
                                        //             <div class=\"iradio_flat-green\" style=\"position: relative;\"><input type=\"radio\" class=\"flat\" checked=\" name=\"".$answer_name."\" value=\"".$answer_value."\" >
                                                        
                                        //             </div> ".$answer_text."
                                        //             </label>
                                        //         </div>";
                                        //     }
                                            // print_r($question_val);

                                        // }
                                    endforeach;
                                    echo "<BR><BR>";
                                }
                                // echo "<BR><BR>";
                            }
                            // echo "<pre>"; print_r($checklist['page'][$page_no]); echo "</pre>"; 

                            // echo $checklist['page'][$page_no];
                        }

                        // foreach($checklist['page'] as $form):
                        //     echo $form."<BR>";
                        // endforeach;

                        // echo "<pre>"; print_r($checklist); echo "</pre>"; 
                        
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