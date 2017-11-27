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
                    <h2>รายละเอียดตารางตรวจงาน <i class="fa fa-info-circle"></i><small></small></h2>
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
                    <? //echo "<pre>"; print_r($schedule); echo "</pre>"; 
                      foreach($schedule as $key => $val):
                    ?>

                    <!-- <div class="row">
                      <label class="col-md-3 control-label text-left"><span class='label label-default'>Far Side Info.</span></label>
                    </div> -->

                    <div class="row">
                      <label class="col-md-4 control-label text-right">ชื่อ</label>
                      <div class="col-md-8 text-left"><?=$val['schedule_name'];?></div>
                    </div>

                    <div class="row">
                      <label class="col-md-4 control-label text-right">รายละเอียด</label>
                      <div class="col-md-8 text-left"><?=$val['schedule_description'];?></div>
                    </div>
          
                    <div class="row">
                      <label class="col-md-4 control-label text-right">กำหนดการเดินทาง</label>
                      <div class="col-md-8 text-left"><?=convert_to_yyyymmdd( $val['start_date'] );?> ถึง <?=convert_to_yyyymmdd( $val['end_date'] );?></div>
                    </div>

                    <div class="row">
                      <label class="col-md-4 control-label text-right">Ticket</label>
                      <div class="col-md-8 text-left"><?=convert_to_yyyymmdd( $val['ticket_start_date'] );?> ถึง <?=convert_to_yyyymmdd( $val['ticket_end_date'] );?></div>
                    </div>

                    <div class="row">
                      <label class="col-md-4 control-label text-right">พื้นที่</label>
                      <div class="col-md-8 text-left"><?=$val['region_name'];?></div>
                    </div>

                    <div class="row">
                      <label class="col-md-4 control-label text-right">จังหวัด</label>
                      <div class="col-md-8 text-left"><?=$val['province'];?></div>
                    </div>
                    <div class="ln_solid"></div>    
                    <div class="row">
                      <label class="col-md-4 control-label text-right">สร้างเมื่อ</label>
                      <div class="col-md-8 text-left"><?=$val['created_date'];?></div>
                    </div>

                    <div class="row">
                      <label class="col-md-4 control-label text-right">สร้างโดย</label>
                      <div class="col-md-8 text-left"><?=$val['created_by'];?></div>
                    </div>
                    
                    <? if($val['updated_date'] != NULL){?>

                    <div class="row">
                      <label class="col-md-4 control-label text-right">แก้ไขเมื่อ</label>
                      <div class="col-md-8 text-left"><?=$val['updated_date'];?></div>
                    </div>

                    <div class="row">
                      <label class="col-md-4 control-label text-right">แก้ไขโดย</label>
                      <div class="col-md-8 text-left"><?=$val['updated_by'];?></div>
                    </div>

                    <? } ?>
                    <? endforeach; ?>

                    <!-- <div id="map-canvas" style="width: 100%; height: 100%">xxx</div> -->

                    <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-12 text-right">
                          <!-- <button type="reset" class="btn btn-round btn-primary">ย้อนกลับ</button> -->
                          <!-- <button type="submit" class="btn btn-round btn btn-success">แก้ไข</button> -->
                          <a href="<?=site_url('schedule')?>" class="btn btn-round btn-default" id='backSchedulebtn' name='backSchedulebtn' ><span class="fa fa-edit" aria-hidden="true"></span> ย้อนกลับ</a>
                          <a href="<?=site_url('schedule/edit')?>/<?=$val['schedule_id'];?>" class="btn btn-round btn-success" id='editSchedulebtn' name='editSchedulebtn' ><span class="fa fa-edit" aria-hidden="true"></span> แก้ไข</a>
                        </div>
                      </div>

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
                    <div class="x_content"><?
                            // echo $this->session->userdata('cn');
                            // echo "<pre>"; print_r($committee_list); echo "</pre>";
                            ?>
                    <!-- start form for validation -->
                      <span id="panelCommittee">
                        <? 
                          if(!empty($committee_list)){  

                            if( !in_array($this->session->userdata('cn'), $committee_list, true) ) {
                        ?>
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
                          // echo "<pre>"; print_r($committee_list); echo "</pre>";
                          if(!empty($committee_list)){ 
                            foreach($committee_list as $key => $val): 
                        ?>
                          <tr>
                              <td class="text-left"><a href="#"><?=$val;?></a></td>
                              <? if($val == $this->session->userdata('cn')){ ?>
                                <td class="text-left">
                                  <a href="#" class="btn btn-round btn-danger btn-xs" id='disjoinSchedulebtn' name='disjoinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('cn');?>"  data-toggle="modal" data-target="#disjoinScheduleModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                
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
                        <a href="#" class="btn btn-round btn-info pull-right" name='addTaskbtn' data-toggle="modal" data-target="#addTaskModal" ><span class="fa fa-plus" aria-hidden="true"></span> เพิ่มสถานที่</a>
                      </span>
                      <table id="tbTask" name="tbTask" class="table table-hover">
                          <thead>
                              <tr>
                              <th class="text-center">สถานที่</th>
                              <th class="text-center">หมายเลขเคส</th>
                              <th class="text-center"></th>
                              </tr>
                          </thead>
                          <tbody>        
                          <?
                            // echo "<pre>"; print_r($task_list); echo "</pre>";
                            if(!empty($task_list)){ 
                              foreach($task_list as $key => $val):
                                $flag = false;
                                for($i = 0; $i < count($eform_list); $i++){
                                  if( ($eform_list[$i]['site_id'] == $val['site_id']) && ($eform_list[$i]['case_id'] == $val['ticket_id']) && ($eform_list[$i]['created_by'] == $this->session->userdata('cn')) ){
                                    $flag = true;
                                  }
                                }
                          ?>
                            <tr>
                                <td class="text-left"><a href="#"><?=$val['site_name'];?></a></td>
                                <td class="text-left"><a href="#"><?=$val['ticket_id'];?></a></td>
                                <td class="text-left">
                                <? 
                                  if( !empty($committee_list) ){
                                    if(in_array($this->session->userdata('cn'), $committee_list) ){
                                      if( !$flag ) {
                                ?>
                                  <a href="<?=site_url('eform/create/'.$schedule[0]['schedule_id']).'/'.$val['ticket_id'];?>" class="btn btn-round btn-success btn-xs"><i class="fa fa-file-text"></i> ตรวจ </a>
                                <?  } 
                                    if( $this->session->userdata('role') == 'Administrator'){?>  
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
                          // echo "<pre>"; print_r($eform_list); echo "</pre>";
                          if(!empty($eform_list)){ 
                            foreach($eform_list as $eform_key => $eform_val):
                        ?>
                            <tr>
                              <td class="text-left"><a href="<?=site_url('eform/view/'.$eform_val['eform_id'])?>"><?=$eform_val['site_name'];?></a></td>
                              <td class="text-center"><a href="<?=site_url('eform/view/'.$eform_val['eform_id'])?>"><?=$eform_val['province'];?></a></td>
                              <td class="text-center"><a href="<?=site_url('eform/view/'.$eform_val['eform_id'])?>"><?=$eform_val['case_category'];?> [PM]</a></td>
                              <td class="text-center"><a href="<?=site_url('eform/view/'.$eform_val['eform_id'])?>"><?=$eform_val['created_by'];?></a></td>
                              <td class="text-center"><a href="<?=site_url('eform/view/'.$eform_val['eform_id'])?>"><?=$eform_val['created_date'];?></a></td>
                              <td class="text-center"></td>
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

  <!-- addTaskModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="addTaskModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <? $this->load->view('schedule/add_task_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /addTaskModal -->

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

    $('#tbEform').DataTable({
      searching: true,
      "paging":   true,
      "ordering": true,
      language: { search: "_INPUT_" , searchPlaceholder: "ค้นหา..." }, //remove "search" label and put in placeholder
      "dom": '<"toolbarEform">frtip'
    });

    $("div.toolbarEform").html('<span id="tbEform_filter2" class="dataTables_filter"></span>');
    //Search box
    $('#tbEform_filter').css('float','left');
    $('#tbEform_filter').css('text-align','left');

    $('#tbEform_filter2').css('float','right');
    $('#tbEform_filter2').append($('#panelEform'));
    $("div.toolbarEform").append($('#tbEform_filter'));

    $('#tbEform').removeClass('hidden');

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