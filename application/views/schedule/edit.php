<!-- page style -->
  <style>
  .modal-sm {
      width: 350px;
  }
  </style>
<!-- /page style -->

<!-- page content -->
<article>
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>แก้ไขตารางตรวจงาน</h3>
            </div>

            <!-- <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
                </div>
            </div>
            </div> -->

        </div>

        <div class="clearfix"></div>

        <!-- top row -->
        <div class="row">

            <!-- left card -->
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>รายละเอียด <i class="fa fa-info-circle"></i><small></small></h2>
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
                  <form role="form" id="editSchedule" name="editSchedule" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('schedule/edit_ops');?>" method="POST">
                        
                    <? //echo "<pre>"; print_r($schedule); echo "</pre>"; 
                      foreach($schedule as $key => $val):
                    ?>

                    <!-- <div class="row">
                      <label class="col-md-3 control-label text-left"><span class='label label-default'>Far Side Info.</span></label>
                    </div> -->

                    <div class="form-group">
                        <label class="col-md-4 control-label text-right" >ชื่อ <span class="required">*</span></label>
                        <div class="col-md-8 text-left">
                            <input type="text" id="name"  name="name" class="form-control" value="<?=$val['schedule_name'];?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-4 control-label text-right" for="textarea">รายละเอียด <span class="required">*</span></label>
                        <div class="col-md-8 text-left">
                            <textarea id="description"  name="description" class="form-control" required><?=$val['schedule_description'];?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label text-right" for="name">กำหนดการเดินทาง <span class="required">*</span></label>
                        <div class="col-md-8 text-left">
                            <input type="hidden" name="start_date" id="start_date" value="<?=convert_to_yyyymmdd( $val['start_date'] );?>" />  
                            <input type="hidden" name="end_date" id="end_date" value="<?=convert_to_yyyymmdd( $val['end_date'] );?>" />                          
                            <fieldset>
                                <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" name="schedule-time" id="schedule-time" class="form-control" value="01/01/2016 - 01/25/2016" required/>
                                    </div>
                                </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label text-right" for="name">Ticket <span class="required">*</span></label>
                        <div class="col-md-8 text-left">
                            <input type="hidden" name="ticket_start_date" id="ticket_start_date" value="<?=convert_to_yyyymmdd( $val['ticket_start_date'] );?>" />  
                            <input type="hidden" name="ticket_end_date" id="ticket_end_date" value="<?=convert_to_yyyymmdd( $val['ticket_end_date'] );?>" />  
                            <fieldset>
                                <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" name="ticket-time" id="ticket-time" class="form-control" value="01/01/2016 - 01/25/2016" />
                                    </div>
                                </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label text-right" for="name">พื้นที่ <span class="required">*</span></label>
                        <div class="col-md-8 text-left">
                            <?
                                echo "<select name=\"region[]\" id=\"region\" class=\"form-control selectpicker show-tick\" title=\"select \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                                foreach($region_list as $reg_key => $reg_val):
                                    if($reg_key == $val['region']){
                                        echo "<option value=\"".$reg_key."\" selected>".$reg_val."</option>\"";
                                    }else{
                                        echo "<option value=\"".$reg_key."\">".$reg_val."</option>\"";
                                    }
                                endforeach;
                                echo "</select>";
                            ?>                      
                        </div>
                    </div>         

                    <div class="form-group">
                        <label class="col-md-4 control-label text-right" for="name">จังหวัด <span class="required">*</span></label>
                        <div class="col-md-8 text-left">
                            <input type="hidden" name="province_list" id="province_list" value="<?=$val['province'];?>" />        
                            <?
                                $province_array = explode("," , $val['province']);

                                echo "<select name=\"province[]\" id=\"province\" class=\"form-control selectpicker show-tick\" title=\"select \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                                foreach($province_list as $key => $pval):

                                    $opt = '';
                                    for($i = 0; $i < count($pval); $i++) {
                                        if( in_array($pval[$i], $province_array) ){
                                            $opt = $opt."<option value=\"".$pval[$i]."\" selected>".$pval[$i]."</option>"; 
                                        }else{
                                            $opt = $opt."<option value=\"".$pval[$i]."\">".$pval[$i]."</option>";     
                                        }
                                    }
                                    echo '<optgroup label="'.$key.'">'.$key.$opt.'</optgroup>';

                                endforeach;
                                echo "</select>";
                            ?>                                  
                        </div>
                    </div>   

                    <? endforeach; ?>

                    <!-- <div id="map-canvas" style="width: 100%; height: 100%">xxx</div> -->

                    <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-12 text-right">
                            <a href="<?=site_url('schedule/view')?>/<?=$val['schedule_id'];?>" class="btn btn-round btn-default" id='backSchedulebtn' name='backSchedulebtn' ><span class="fa fa-edit" aria-hidden="true"></span> ย้อนกลับ</a>
                            <button id="submit" type="submit" class="btn btn-round btn-primary">บันทึก</button>
                            <!-- <a href="<?=site_url('schedule/edit')?>/<?=$val['schedule_id'];?>" class="btn btn-round btn-primary" id='editSchedulebtn' name='editSchedulebtn' ><span class="fa fa-edit" aria-hidden="true"></span> บันทึก</a> -->
                        </div>
                      </div>
                      <input type="hidden" name="schedule_id" id="schedule_id" value="<?=$val['schedule_id'];?>" />              
                    </form>
                  </div>
                </div>
              </div>
            <!-- /left card -->

            <!-- right card -->
              <div class="col-md-6 col-xs-12">

                <!-- committee card -->  
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>กรรมการ <i class="fa fa-users"></i><small></small></h2>
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

                    <!-- start form for validation -->
                      <span id="panelCommittee">
                        <? 
                          if(!empty($committee_list)){  
                            if( !in_array($this->session->userdata('cn'), $committee_list) ) {
                        ?>
                          <!-- <a href="<?=site_url('schedule/join_schedule_ops?schedule_id='.$schedule[0]['schedule_id'])."&name=".$this->session->userdata('cn');?>" class="btn btn-round btn-info pull-right" id='joinSchedulebtn' name='joinSchedulebtn' ><span class="fa fa-plus-circle" aria-hidden="true"></span> เข้าร่วม</a> -->
                          <a href="#" class="btn btn-round btn-success pull-right" id='joinSchedulebtn' name='joinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('cn');?>"  data-toggle="modal" data-target="#joinScheduleModal"  ><span class="fa fa-plus" aria-hidden="true"></span> เข้าร่วม</a>
                        <?  
                            }
                          }else{ 
                        ?>
                          <a href="#" class="btn btn-round btn-success pull-right" id='joinSchedulebtn' name='joinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('cn');?>"  data-toggle="modal" data-target="#joinScheduleModal"  ><span class="fa fa-plus" aria-hidden="true"></span> เข้าร่วม</a>
                        <?  
                          }
                        ?>
                      </span>
                      <table id="tbCommittee" name="tbCommittee" class="table table-hover">
                        <thead>
                            <tr>
                            <th class="text-left">ชือ - นามสกุล</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>        
                        <? 
                          // if(!empty($committee_list)){ 
                            foreach($committee_list as $key => $val): 
                        ?>
                          <tr>
                              <td class="text-left"><a href="#"><?=$val;?></a></td>
                              <? if($val == $this->session->userdata('cn')){ ?>
                                <td class="text-left">
                                  <!-- <a href="<?=site_url('schedule/disjoin_schedule_ops')."?schedule_id=".$schedule[0]['schedule_id']."&name=".$this->session->userdata('cn') ?>" class="btn btn-round btn-warning btn-xs pull-right" id="cancelSchedulebtn" name="cancelSchedulebtn"><span class="fa fa-minus-circle" aria-hidden="true"></span> ยกเลิก</a> -->
                                  <a href="#" class="btn btn-round btn-danger btn-xs" id='disjoinSchedulebtn' name='disjoinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('cn');?>"  data-toggle="modal" data-target="#disjoinScheduleModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                
                                  <!-- <a href="#" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-o"></i>  </a> -->
                                </td>
                                
                              <? }else{ ?>
                                <td class="text-left"></td>
                              <?}?>
                          </tr>
                        <? 
                            endforeach; 
                          // }
                        ?>       
                        </tbody>
                      </table>       
                    <!-- end form for validations -->

                    </div>
                  </div>
                <!-- /committee card -->

                <!-- destination card -->
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>สถานที่ <i class="fa fa-university"></i><small></small></h2>
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
                      <span id="panelTask">
                        <a href="#" class="btn btn-round btn-success pull-right" name='addTaskbtn' data-toggle="modal" data-target="#addTaskModal" ><span class="fa fa-plus" aria-hidden="true"></span> เพิ่มสถานที่</a>
                      </span>
                      <table id="tbTask" name="tbTask" class="table table-hover">
                          <thead>
                              <tr>
                              <th class="text-center">สถานที่</th>
                              <th class="text-center">ทรัพย์สิน</th>
                              <th class="text-center">หมายเลขเคส</th>
                              <th class="text-center"></th>
                              </tr>
                          </thead>
                          <tbody>        
                          <?
                          foreach($task_list as $key => $val):
                          ?>
                            <tr>
                                <td class="text-left"><a href="#"><?=$val['site_name'];?></a></td>
                                <td class="text-left"><a href="#"><?=$val['ma_type'];?></a></td>
                                <td class="text-left"><a href="#"><?=$val['ticket_id'];?></a></td>
                                <td class="text-left">
                                  <!-- <a href="#" class="btn btn-round btn-primary btn-xs"><i class="fa fa-folder"></i>  </a> -->
                                  <a href="#" class="btn btn-round btn-success btn-xs"><i class="fa fa-pencil"></i> ตรวจ </a>
                                  <a href="#" class="btn btn-round btn-danger btn-xs" id='cancelTaskbtn' name='cancelTaskbtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-site_id="<?=$val['site_id'];?>" data-site_name="<?=$val['site_name'];?>" data-ticket_id="<?=$val['ticket_id'];?>" data-toggle="modal" data-target="#cancelTaskModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                
                                  
                                  <!-- <a href="#" class="btn btn-round btn-info btn-xs pull-right" name='addTaskbtn'><span class="fa fa-plus-circle" aria-hidden="true"></span> แบบตรวจ</a> -->
                                </td>
                            </tr>

                          <?
                            endforeach;
                          ?>       
                          </tbody>
                        </table>             
                    </div>


                  
                  </div>
                <!-- /destination card -->
              
              </div>
            <!-- /right card -->

        </div>
        <!-- /top row -->
        
        <!-- bottom row -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>รายการแบบตรวจสอบออนไลน์ <i class="fa fa-file-text"></i><small></small></h2>
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
                        <table id="scheduleEform" name="scheduleEform" class="table table-striped">
                        <thead>
                            <tr>
                            <th class="text-center">หมายเลข</th>
                            <th class="text-center">ชื่อหน่วยงาน</th>
                            <th class="text-center">จังหวัด</th>
                            <th class="text-center">ทรัพย์สิน</th>
                            <th class="text-center">ประเภทการตรวจสอบ</th>
                            <th class="text-center">ผู้ตรวจสอบ</th>
                            <th class="text-center">วันที่ตรวจสอบ</th>
                            <th class="text-center"></th>
                            </tr>
                        </thead>
                        
                        <tbody>                            
                        </tbody>
                        
                        </table>
                    </div>
                </div>
            </div>

        </div>         
        <!-- /bottom row -->
        
    </div>
</artical>
<!-- /page content -->

<!-- modal content -->
  <!-- addTaskModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="addTaskModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <? $this->load->view('schedule/add_task_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /addTaskModal -->

  <!-- joinScheduleModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="joinScheduleModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <? $this->load->view('schedule/join_schedule_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /joinScheduleModal -->

  <!-- disjoinScheduleModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="disjoinScheduleModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <? $this->load->view('schedule/disjoin_schedule_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /disjoinScheduleModal -->

  <!-- cancelTaskModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="cancelTaskModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <? $this->load->view('schedule/cancel_task_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /cancelTaskModal -->

<!-- /modal content -->  

<!-- page script -->
<script type="text/javascript">
 $(document).ready(function(){

    //Check element of array
    function isInArray(value, array) {
        return array.indexOf(value) > -1;
    }

    $('input[name="schedule-time"]').daterangepicker({
        timePicker: false,
        locale: {
            format: 'YYYY-MM-DD'
        },
        startDate: $('#start_date').val(),
        endDate: $('#end_date').val()
    });

    $('input[name="ticket-time"]').daterangepicker({
        timePicker: false,
        locale: {
            format: 'YYYY-MM-DD'
        },
        startDate: $('#ticket_start_date').val(),
        endDate: $('#ticket_end_date').val()
    });

    //Once region changed, re-query province
    $('#region').change(function(){

        var province_list = $('#province_list').val().split(",");

        $("#province").html('');
    
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?=site_url('/Site/list_province_by_region');?>",
            data: "region="+ $('#region').val(),
            success: function(result)
            {
                $.each(result,function(region,province){
                    var str = '';
                    var opt = '';
                    for(i = 0; i<province.length; i++) {
                        if(isInArray(province[i], province_list)){
                            opt += '<option value="'+province[i]+'" selected>'+province[i]+'</option>';    
                        }else{
                            opt += '<option value="'+province[i]+'">'+province[i]+'</option>';         
                        }              
                    }
                    str += '<optgroup label="'+region+'">'+opt+'</optgroup>';
                    $("#province").append(str);
                });//end each

                $('#province').selectpicker('refresh');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });

    });

    $('#tbTask').DataTable({
      "pageLength": 10,
      "paging":   true,
      "ordering": true,
      language: { search: "_INPUT_" , searchPlaceholder: "ค้นหา..." }, //remove "search" label and put in placeholder
      "dom": '<"toolbarTask">frtip'
    });

    $("div.toolbarTask").html('<span id="tbTask_filter2" class="dataTables_filter"></span>');
    //Search box
    $('#tbTask_filter').css('float','left');
    $('#tbTask_filter').css('text-align','left');

    $('#tbTask_filter2').css('float','right');
    $('#tbTask_filter2').append($('#panelTask'));
    $("div.toolbarTask").append($('#tbTask_filter'));

    $('#tbTask').removeClass('hidden');

    $('#tbCommittee').DataTable({
      searching: false,
      "paging":   false,
      "ordering": false,
      language: { search: "_INPUT_" , searchPlaceholder: "ค้นหา..." }, //remove "search" label and put in placeholder
      "dom": '<"toolbarCommittee">frtip'
    });

    $("div.toolbarCommittee").html('<span id="tbCommittee_filter2" class="dataTables_filter"></span>');
    //Search box
    $('#tbCommittee_filter').css('float','left');
    $('#tbCommittee_filter').css('text-align','left');

    $('#tbCommittee_filter2').css('float','right');
    $('#tbCommittee_filter2').append($('#panelCommittee'));
    $("div.toolbarCommittee").append($('#tbCommittee_filter'));

    $('#tbCommittee').removeClass('hidden');


    $('#joinScheduleModal').on('show.bs.modal', function(e) {
      var schedule_id = $(e.relatedTarget).data('schedule_id')
      var schedule_name = $(e.relatedTarget).data('schedule_name')
      var schedule_description = $(e.relatedTarget).data('schedule_description')
      var name = $(e.relatedTarget).data('name')

      $("#joinScheduleModal .modal-header .modal-title").html('เข้าร่วมการตรวจงานนี้');
      $("#joinScheduleModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการเข้าร่วมเป็นกรรมการการตรวจงาน<BR><BR><b>'+schedule_description+'</b><BR><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="name"]').val(name);
    });

    $('#disjoinScheduleModal').on('show.bs.modal', function(e) {
      var schedule_id = $(e.relatedTarget).data('schedule_id')
      var schedule_name = $(e.relatedTarget).data('schedule_name')
      var schedule_description = $(e.relatedTarget).data('schedule_description')
      var name = $(e.relatedTarget).data('name')

      $("#disjoinScheduleModal .modal-header .modal-title").html('ยกเลิกเข้าร่วมการตรวจงานนี้');
      $("#disjoinScheduleModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกเป็นกรรมการการตรวจงาน<BR><BR><b>'+schedule_description+'</b><BR><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="name"]').val(name);
    });

    $('#cancelTaskModal').on('show.bs.modal', function(e) {
      var schedule_id = $(e.relatedTarget).data('schedule_id')
      var site_id = $(e.relatedTarget).data('site_id')
      var site_name = $(e.relatedTarget).data('site_name')
      var ticket_id = $(e.relatedTarget).data('ticket_id')

      $("#cancelTaskModal .modal-header .modal-title").html('ยกเลิกรายการตรวจงานนี้');
      $("#cancelTaskModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกรายการการตรวจงาน<BR><BR><b>'+ticket_id+'</b><BR>ของ<BR><b>'+site_name+'</b><BR><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="site_id"]').val(site_id);
      $(e.currentTarget).find('input[name="ticket_id"]').val(ticket_id);
    });

    // $('#addTaskModal').on('hidden.bs.modal', '.modal', function () {
    //  $(this).removeData('bs.modal');
    // });

    // $('#joinScheduleModal').on('hidden.bs.modal', '.modal', function () {
    //  $(this).removeData('bs.modal');
    // });

    // $('#disjoinScheduleModal').on('hidden.bs.modal', '.modal', function () {
    //  $(this).removeData('bs.modal');
    // });
 });

</script>


<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTumdnMNt9AoCnkbx-YlfTHJYTj7iV6UI&sensor=TRUE"></script>

<script type="text/javascript">
    function initialize() {
      var mapOptions = {
        center: new google.maps.LatLng(-34.397, 150.644),
        zoom: 8
      };
      var map = new google.maps.Map(document.getElementById("map-canvas"),
          mapOptions);
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script> -->
<!-- /page script -->