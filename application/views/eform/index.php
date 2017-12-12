<!-- page content -->
<article>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3></h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>รายการแบบตรวจสอบออนไลน์</h2>
                    <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <!-- /Dashboard -->
                    <!-- <div class="row tile_count text-center">
                      <div class="col-lg-5 col-md-5 col-sm-4 col-xs-4 tile_stats_count">
                        <form class="form-inline">
                        <fieldset>
                            <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text" name="eform-time" id="eform-time" class="form-control" value="01/01/2016 - 01/25/2016" required/>
                                </div>
                            </div>
                            </div>
                        </fieldset>
                        <button id="submit" type="submit" class="btn btn-round btn-primary">ค้นหา</button>

                        </form>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <span class="count_top"><i class="fa fa-file-text"></i> Total eForm</span>
                        <div class="count">150</div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <span class="count_top"><i class="fa fa-check-circle-o"></i> Passed eForm</span>
                        <div class="count green">147</div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <span class="count_top"><i class="fa fa-times-circle-o"></i> Not Passed eFrom</span>
                        <div class="count red">3</div>
                      </div>

                    </div> -->
                  <!-- /Dashboard -->

                    <span id="controlPanel"></span>
                    <table id="tbEform" name="tbEform" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
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
                              <!-- <td class="text-left"><a href="<?=site_url('eform/view/'.$eform_val['eform_id'])?>"><?=$eform_val['site_name'];?></a></td> -->
                              <td class="text-left"><?=$eform_val['site_name'];?></td>
                              <td class="text-center"><?=$eform_val['province'];?></td>
                              <td class="text-center"><?=$eform_val['case_category'];?> [PM]</td>
                              <td class="text-center"><?=$eform_val['created_by'];?></td>
                              <td class="text-center"><?=$eform_val['created_date'];?></td>
                              <td class="text-center">
                              <? if($permission->eform_view){ ?>
                                <a href="<?=site_url('eform/view')?>/<?=$eform_val['eform_id'];?>" class="btn btn-round btn-default btn-xs"><i class="fa fa-folder-open"></i> เรียกดู</a>
                              <? } ?> 
                               <? if($permission->eform_delete) {?> 
                                <a href="#" class="btn btn-round btn-danger btn-xs" id='disableEformbtn' name='disableEformbtn' data-eform_id="<?=$eform_val['eform_id'];?>" data-schedule_id="<?=$eform_val['schedule_id'];?>" data-site_name="<?=$eform_val['site_name'];?>" data-committee="<?=$eform_val['created_by'];?>" data-toggle="modal" data-target="#disableEformModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                
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
    </div>
  </div>
</div>
</article>
<!-- /page content -->

<!-- modal content -->  

  <!-- disableEformModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="disableEformModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <? $this->load->view('eform/disable_eform_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /disableEformModal -->

<!-- /modal content -->  

<script>

  $(document).ready(function(){
    $('input[name="eform-time"]').daterangepicker({
        timePicker: false,
        locale: {
            format: 'YYYY-MM-DD'
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    });

    $('#tbEform').DataTable({
      // "pageLength": 50,
      "paging":   true,
      "ordering": true,
      language: { search: "_INPUT_" , searchPlaceholder: "ค้นหา..." },
      "dom": '<"toolbar">frtip'
      });
      $("div.toolbar").html('<span id="tbEform_filter2" class="dataTables_filter"></span>');
      //Search box
      $('#tbEform_filter').css('float','left');
      $('#tbEform_filter').css('text-align','left');

      $('#tbEform_filter').css('float','left','form-inline');
      $('#tbEform_filter2').css('float','right');
      $('#tbEform_filter2').append($('#controlPanel'));
      $("div.toolbar").append($('#tbEform_filter'));

      $('#tbEform').removeClass('hidden');

      $('#disableEformModal').on('show.bs.modal', function(e) {
      var eform_id = $(e.relatedTarget).data('eform_id')
      var schedule_id = $(e.relatedTarget).data('schedule_id')
      var site_name = $(e.relatedTarget).data('site_name')
      var committee = $(e.relatedTarget).data('committee')
      var called_page = "eform";

      $("#disableEformModal .modal-header .modal-title").html('ยกเลิกแบบตรวจออนไลน์');
      $("#disableEformModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกแบบตรวจออนไลน์<BR><BR>หมายเลข: <b>'+eform_id+'</b><BR>สถานที่: <b>'+site_name+'</b><BR>สร้างโดย: <b>'+committee+'</b><BR><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="eform_id"]').val(eform_id);
      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="called_page"]').val(called_page);
    });
  });
</script>