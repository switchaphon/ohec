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
                            <h2>แบบตรวจออนไลน์</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                                </li> -->
                                <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li> -->
                            </ul>
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
                                            <br>ประเภทการตรวจ : <b><?=$eform[0]['ma_name']?> (<?=$eform[0]['ma_type']?>)</b>
                                        </address>
                                    </div>
                                    <!-- /left col -->
                                    <!-- right col -->
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                                        ตารางงาน : <b><a href="<?=site_url('schedule/view/'.$eform[0]['schedule_id']);?>"><?=$eform[0]['schedule_name']?></a></b>
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
                                            <th class="text-center">หมายเลขเคส</th>
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
                                                <td class="text-left"><?=$ticket_val['case_id'];?></td>
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

                                <!-- .row no-print-->
                                <div class="row no-print">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <button class="btn btn-round btn-default" onclick="window.print();"><i class="fa fa-print"></i> พิมพ์</button> 
                                        <button class="btn btn-round btn-success" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF</button>
                                    </div>
                                </div>                    
                                <!-- /.row no-print -->

                                <div class="ln_solid"></div>
                                <? //echo "<pre>"; print_r($eform_checklist); echo "</pre>"; ?>
                                <? foreach($eform_checklist as $key => $val): ?>

                                <div class="row">
                                    <? 
                                        //--Checklist section--/
                                        echo "<div class=\"col-lg-7 col-md-12 col-sm-12 col-xs-12\"><span class=\"section\">".$val['panel_title']."</span>"; //Header
                                        for($question = 0; $question < count($val['question']); $question++){

                                            $question_no = $val['question'][$question]['question_no'];
                                            $question_name = $val['question'][$question]['question_name'];
                                            $question_text = $val['question'][$question]['question_text'];
                                            $question_value = $val['question'][$question]['question_value'];
                                            $question_type = $val['question'][$question]['question_type'];
                                            $answer_value = $val['question'][$question]['answer_value'];

                                            switch( $question_type ){
                                                case "textbox":
                                                    $answer = null;
                                                    switch( $eform[0]['form_id'] ) {
                                                        case "00001":
                                                            break;
                                                        case "00002":
                                                            break;
                                                        case "00003":
                                                            $answer = "
                                                            <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
                                                        
                                                            break;
                                                        case "00004":
                                                            break;
                                                        case "00005":
                                                            break;
                                                        case "00006":
                                                            break;
                                                    }
                                                    break;
                                                case "textarea":
                                                    $answer = null;
                                                    $answer = "
                                                        <div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12\" style=\"padding-left: 30px;\">".$answer_value."</div>";
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

                                            //--Render question and its answer--//
                                            if( ($question_type != 'textbox') && ($question_type != 'textarea') ){ 
                                                echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-6 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                            }else{
                                                if( !empty($answer_value) ){
                                                    echo "<label class=\"control-label col-lg-5 col-md-6 col-sm-6 col-xs-12 \" for=\"".$question_name."\">".$question_text."</label>".$answer;
                                                }
                                            }
                                        }
                                        echo "</div>";
                                        //--/Checklist section--/

                                        //--Attachment section--/
                                        if(!empty($eform_attachment[$key])){
                                            echo "<div class=\"col-lg-5 col-xs-12\"><span class=\"section\">ภาพประกอบ</span>"; //Header
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
                                            <a href="#" class="btn btn-round btn-success btn-xs pull-right" id='addEformNote' name='addEformNote' data-toggle="modal" data-target="#addEformNoteModal"  ><span class="fa fa-plus" aria-hidden="true"></span> บันทึก</a>
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
</script>