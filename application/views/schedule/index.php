<!-- page content -->
<article>
  <div class="right_col" role="main">

      <div class="page-title">
        <div class="title_left">
          <h3></h3>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>รายการตารางตรวจงาน</h2>
                      <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <!-- <p class="text-muted font-13 m-b-30">
                        The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                      </p> -->
                      <span id="controlPanel">
                      <? if($permission->schedule_add){?>
                        <a class="btn btn-round btn-success pull-right" href="<?=site_url('schedule/create')?>" name='create'><span class="fa fa-edit" aria-hidden="true"></span> สร้างใหม่</a>
                      <? } ?>
                      </span>
                      <table id="tbSchedule" name="tbSchedule" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
                        <thead>
                          <tr>
                            <th class="text-center">หมายเลข</th>
                            <th class="text-center">รายละเอียด</th>
                            <th class="text-center">จังหวัด</th>
                            <th class="text-center">วันเดินทาง</th>
                            <th class="text-center"></th>
                          </tr>
                        </thead>
                        
                        <tbody>
                        <?
                          // echo "<pre>"; print_r($joined_schedule); echo "</pre>";
                          foreach($opened_schedule as $row):
                            if($row['schedule_id'])
                              $joined = null;
                              if( !empty($joined_schedule) ){
                                if(in_array($row['schedule_id'], $joined_schedule) ){ $joined = "<i class=\"fa fa-user green\"></i>"; }
                              }
                        ?>
                          <tr>
                              <td class="text-left"><?=$row['schedule_name'];?> <?=$joined;?></td>
                              <td class="text-left"><?=$row['schedule_description'];?></td>
                              <td class="text-left"><?=$row['province'];?></td>
                              <td class="text-center"><?=convert_to_yyyymmdd($row['start_date']);?> - <?=convert_to_yyyymmdd($row['end_date']);?></td>
                              <td class="text-center">
                                <? if( $permission->schedule_view){?> 
                                  <a href="<?=site_url('schedule/view')?>/<?=$row['schedule_id'];?>" class="btn btn-round btn-default btn-xs"><i class="fa fa-folder-open"></i> เรียกดู</a>
                                <? } ?>
                                <? if( $permission->schedule_edit){?>   
                                  <a href="<?=site_url('schedule/edit')?>/<?=$row['schedule_id'];?>" class="btn btn-round btn-default btn-xs"><i class="fa fa-pencil"></i> แก้ไข </a>
                                <? } ?>
                                <? if( $permission->schedule_delete){?> 
                                  <a href="#" class="btn btn-round btn-danger btn-xs" id='disableScheduleBtn' name='disableScheduleBtn' data-schedule_id="<?=$row['schedule_id'];?>"  data-schedule_name="<?=$row['schedule_name'];?>" data-schedule_desc="<?=$row['schedule_description'];?>" data-toggle="modal" data-target="#disableScheduleModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                
                                <? } ?>
                              </td>
                          </tr>

                        <?
                          endforeach;
                        ?>                                         
                        </tbody>
                      
                      </table>
                    </div>
                    <i class="fa fa-user green"></i> = ตารางงานที่คุณเป็นกรรมการ
                  </div>
                </div>
        </div>
      </div>

  </div>
</article>
<!-- /page content -->

<!-- modal content -->  

  <!-- disableScheduleModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="disableScheduleModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <? $this->load->view('schedule/disable_schedule_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /disableScheduleModal -->

<!-- /modal content -->  

<script>
    $(document).ready(function(){
        $('#tbSchedule').DataTable({
          // "pageLength": 50,
          "paging":   true,
          "ordering": false,
          language: { search: "_INPUT_" , searchPlaceholder: "ค้นหา..." },
          "dom": '<"toolbar">frtip'
         });
         $("div.toolbar").html('<span id="tbSchedule_filter2" class="dataTables_filter"></span>');
          //Search box
          $('#tbSchedule_filter').css('float','left');
          $('#tbSchedule_filter').css('text-align','left');

          $('#tbSchedule_filter').css('float','left','form-inline');
          $('#tbSchedule_filter2').css('float','right');
          $('#tbSchedule_filter2').append($('#controlPanel'));
          $("div.toolbar").append($('#tbSchedule_filter'));

          $('#tbSchedule').removeClass('hidden');

        $('#disableScheduleModal').on('show.bs.modal', function(e) {
          // var eform_id = $(e.relatedTarget).data('eform_id')
          var schedule_id = $(e.relatedTarget).data('schedule_id')
          var schedule_name = $(e.relatedTarget).data('schedule_name')
          var schedule_desc = $(e.relatedTarget).data('schedule_desc')

          var called_page = "schedule";

          $("#disableScheduleModal .modal-header .modal-title").html('ยกเลิกแบบตารางการตรวจงาน');
          $("#disableScheduleModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกตารางตรวจงานรตรวจงาน<BR><BR>หมายเลข: <b>'+schedule_id+'</b><BR>ชื่อ: <b>'+schedule_name+'</b><BR>รายละเอียด: <b>'+schedule_desc+'</b><BR><BR>ใช่หรือไม่ ?</div>');

          // $(e.currentTarget).find('input[name="eform_id"]').val(eform_id);
          $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
          $(e.currentTarget).find('input[name="called_page"]').val(called_page);
        });  
    });
</script>