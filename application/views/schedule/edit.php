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
                <h3></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- top row -->
        <div class="row">

            <!-- left card -->
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>รายละเอียดตารางตรวจงาน <i class="fa fa-info-circle"></i><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" >ชื่อ <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-9 col-xs-12 text-left">
                            <input type="text" id="name"  name="name" class="form-control" value="<?=$val['schedule_name'];?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="textarea">รายละเอียด <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-9 col-xs-12 text-left">
                            <textarea id="description"  name="description" class="form-control" required><?=$val['schedule_description'];?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">กำหนดการ <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-9 col-xs-12 text-left">
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">Ticket <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-9 col-xs-12 text-left">
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">พื้นที่ <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-9 col-xs-12 text-left">
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">จังหวัด <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-9 col-xs-12 text-left">
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <? if($permission->schedule_view) { ?>
                              <a href="<?=site_url('schedule/view')?>/<?=$val['schedule_id'];?>" class="btn btn-round btn-default" id='backSchedulebtn' name='backSchedulebtn' ><span class="fa fa-edit" aria-hidden="true"></span> ย้อนกลับ</a>
                            <? } ?>
                            <? if($permission->schedule_edit) { ?>
                              <button id="submit" type="submit" class="btn btn-round btn-primary">บันทึก</button>
                            <? } ?>
                        </div>
                      </div>
                      <input type="hidden" name="schedule_id" id="schedule_id" value="<?=$val['schedule_id'];?>" />              
                    </form>
                  </div>
                </div>

                <!-- committee card -->  
                <div class="x_panel">
                  <div class="x_title">
                    <h2>กรรมการ <i class="fa fa-users"></i><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content"><?
                          // echo $this->session->userdata('name')." ".$this->session->userdata('surname');
                          // echo "<pre>"; print_r($committee_list); echo "</pre>";
                          ?>
                  <!-- start form for validation -->
                    <span id="panelCommittee">
                      <? 
                        if(!empty($committee_list)){  

                          if( !in_array($this->session->userdata('name')." ".$this->session->userdata('surname'), $committee_list, true) ) {
                      ?>
                        <? if($permission->schedule_view) {?>
                          <a href="#" class="btn btn-round btn-success pull-right" id='joinSchedulebtn' name='joinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#joinScheduleModal"  ><span class="fa fa-plus" aria-hidden="true"></span> เข้าร่วม</a>
                        <? } ?>
                      <?  
                          }
                        }else{ 
                      ?>
                        <? if($permission->schedule_view) {?>
                          <a href="#" class="btn btn-round btn-success pull-right" id='joinSchedulebtn' name='joinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#joinScheduleModal"  ><span class="fa fa-plus" aria-hidden="true"></span> เข้าร่วม</a>
                        <? } ?>
                      <?  
                        }
                      ?>
                    </span>
                    <table id="tbCommittee" name="tbCommittee" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline">
                      <thead>
                          <tr>
                          <th class="text-left">ชือ - นามสกุล</th>
                          <th></th>
                          </tr>
                      </thead>
                      <tbody>        
                      <? 
                        // echo "<pre>"; print_r($committee_list); echo "</pre>";
                        if(!empty($committee_list)){ 
                          foreach($committee_list as $key => $val): 
                      ?>
                        <tr>
                            <td class="text-left"><a href="#"><?=$val;?></a></td>
                            <? if($val == $this->session->userdata('name')." ".$this->session->userdata('surname')){ ?>
                              <td class="text-left">
                                <? if($permission->schedule_view) {?>
                                  <a href="#" class="btn btn-round btn-danger btn-xs" id='disjoinSchedulebtn' name='disjoinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#disjoinScheduleModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                
                                <? } ?>
                              </td>
                              
                            <? }else{ ?>
                              <td class="text-left"></td>
                            <?}?>
                        </tr>
                      <? 
                          endforeach; 
                        }
                      ?>       
                      </tbody>
                    </table>       
                  <!-- end form for validations -->

                  </div>
                </div>
                <!-- /committee card -->

              </div>
            <!-- /left card -->

            <!-- right card -->
              <div class="col-md-6 col-xs-12">

                <!-- destination card -->
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>สถานที่ <i class="fa fa-university"></i><small></small></h2>
                      <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <span id="panelTask">
                        <? if($permission->schedule_edit) {?>
                          <a href="#" class="btn btn-round btn-success pull-right" name='addTaskbtn' data-toggle="modal" data-target="#addTaskModal" ><span class="fa fa-plus" aria-hidden="true"></span> เพิ่มสถานที่</a>
                        <? } ?>
                      </span>
                      <table id="tbTask" name="tbTask" class="table table-hover">
                        <thead>
                          <tr>
                            <th class="text-center">สถานที่</th>
                            <th class="text-center">งานตรวจ</th>
                            <th class="text-center"></th>
                          </tr>
                        </thead>
                          <tbody>        
                          <?
                            if(!empty($task_list)){ 
                              foreach($task_list as $key => $val):
                                $flag = false;
                                for($i = 0; $i < count($eform_list); $i++){
                                  if( ($eform_list[$i]['site_id'] == $val['site_id']) && ($eform_list[$i]['asset_type'] == $val['asset_type']) && ($eform_list[$i]['ma_type'] == $val['ma_type']) && ($eform_list[$i]['created_by'] == $this->session->userdata('name')." ".$this->session->userdata('surname')) ){
                                    $flag = true;
                                  }
                                }
                          ?>
                            <tr>
                              <td class="text-left"><?=$val['site_name'];?></td>
                              <td class="text-left"><?=$val['asset_type'];?> [<?=$val['ma_type'];?>]</td>
                              <td class="text-left">
                                <? 
                                  if( !empty($committee_list) ){
                                    if(in_array($this->session->userdata('name')." ".$this->session->userdata('surname'), $committee_list) ){
                                      if( !$flag ) {
                                ?>
                                  <a href="<?=site_url('eform/create/'.$schedule[0]['schedule_id']).'/'.$val['ticket_id'];?>" class="btn btn-round btn-success btn-xs"><i class="fa fa-file-text"></i> ตรวจ </a>
                                <?  } 
                                    if($permission->schedule_edit) {?>
                                  <a href="#" class="btn btn-round btn-danger btn-xs" id='cancelTaskbtn' name='cancelTaskbtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-site_id="<?=$val['site_id'];?>" data-site_name="<?=$val['site_name'];?>" data-ticket_id="<?=$val['ticket_id'];?>" data-toggle="modal" data-target="#cancelTaskModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                
                                <? 
                                      } 
                                    }
                                  }
                                ?>
                                </td>
                            </tr>

                          <?
                              endforeach;
                            }
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
                        <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="tbEform" name="tbEform" class="table table-striped">
                          <thead>
                            <tr>
                              <th class="text-center">ชื่อหน่วยงาน</th>
                              <th class="text-center">จังหวัด</th>
                              <th class="text-center">ประเภทการตรวจสอบ</th>
                              <th class="text-center">ผู้ตรวจสอบ</th>
                              <th class="text-center">วันที่ตรวจสอบ</th>
                              <th class="text-center"></th>
                            </tr>
                          </thead>
                        
                        <tbody>
                        <? 
                          
                          if(!empty($eform_list)){ 
                            foreach($eform_list as $eform_key => $eform_val):
                        ?>
                            <tr>
                              <td class="text-left"><?=$eform_val['site_name'];?></td>
                              <td class="text-center"><?=$eform_val['province'];?></td>
                              <td class="text-center"><?=$eform_val['asset_type'];?> [<?=$eform_val['ma_type']?>]</td>
                              <td class="text-center"><?=$eform_val['created_by'];?></td>
                              <td class="text-center"><?=$eform_val['created_date'];?></td>
                              <td class="text-center">
                                <? if( $permission->eform_view){?>
                                  <a href="<?=site_url('eform/view')?>/<?=$eform_val['eform_id'];?>" class="btn btn-round btn-default btn-xs"><i class="fa fa-folder-open"></i> เรียกดู</a>
                                <? } ?>
                                <? if( $permission->eform_delete){?>
                                  <a href="#" class="btn btn-round btn-danger btn-xs" id='disableEformbtn' name='disableEformbtn' data-eform_id="<?=$eform_val['eform_id'];?>" data-site_name="<?=$eform_val['site_name'];?>" data-schedule_id="<?=$eform_val['schedule_id'];?>" data-committee="<?=$eform_val['created_by'];?>" data-toggle="modal" data-target="#disableEformModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                
                                <? } ?>
                              </td>
                            </tr>  
                        <?      
                            endforeach;
                          }
                        ?>                            
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