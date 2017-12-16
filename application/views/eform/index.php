<style>
</style>
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
              <div class="row text-center col-lg-12 col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <h2>รายงานสรุป <span id="Host_amount" class="badge"></span></h2>
                  <div class="x_content" style="padding-bottom: 0px; margin-top:0px">
                    <div class="row tile_count">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <BR>
                        <form role="form" id="searchEform" name="searchEform" class="form-inline form-label-left" data-toggle="validator" action="<?=site_url('eform');?>" method="post">
                          <div class="form-group col-lg-9 col-md-6 col-sm-8 col-xs-8">
                            <fieldset>
                                <div class="control-group">
                                  <div class="controls">
                                      <div class="input-prepend input-group col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                      <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                      <input type="text" name="eform-time" id="eform-time" class="form-control" value="01/01/2016 - 01/25/2016" required/>
                                      </div>
                                  </div>
                                </div>
                            </fieldset>
                          </div>
                          <div class="form-group col-lg-3 col-md-6 col-sm-4 col-xs-4">
                            <button id="submit" type="submit" class="btn btn-round btn-primary">ค้นหา</button>
                          </div>
                        </form>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <a href="#" onclick="select_EformStatus('All')">
                        <div class="pull-left" style="padding-top: 8px;">
                        <i class="fa fa-file-text" style="font-size:25px;"></i>
                        </div>
                        <span class="pull-right count " style="margin-top: 0px;" id="Amount_UP"><?=$total_eform;?></span>
                        <div class="clearfix"></div>
                        <p class="pull-right">ทั้งหมด</p></a>
                      </div>

                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <a href="#" onclick="select_EformStatus('Passed')">
                        <div class="pull-left" style="padding-top: 8px;">
                        <i class="fa fa-check-circle green" style="font-size:30px;"></i>
                        </div>
                        <span class="pull-right count green " style="margin-top: 0px;" id="Amount_DOWN"><?=$passed_eform;?></span>
                        <div class="clearfix"></div>
                        <p class="pull-right">ผ่าน</p></a>
                      </div>

                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <a href="#" onclick="select_EformStatus('notPassed')">
                        <div class="pull-left" style="padding-top: 8px;">
                        <i class="fa fa-times-circle red" style="font-size:30px;"></i>
                        </div>
                        <span class="pull-right count red" style="margin-top: 0px;" id="Amount_UNREACHABLE"><?=$not_passed_eform;?></span>
                        <div class="clearfix"></div>
                        <p class="pull-right">ไม่ผ่าน</p></a>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <!-- /Dashboard -->
              
              <!-- <div class="ln_solid"></div> -->

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
                    // echo "<pre>"; print_r($all_eform_list); echo "</pre>";
                    $pass_eform = $notpass_eform = array();
                    
                    if(!empty($passed_eform_list)){ 
                      foreach($passed_eform_list as $pass_val):
                        $pass_eform[]=$pass_val['eform_id'];
                      endforeach;                        
                    }

                    if(!empty($not_passed_eform_list)){ 
                      foreach($not_passed_eform_list as $notpass_val):
                        $notpass_eform[]=$notpass_val['eform_id'];
                      endforeach;                        
                    } 
                    
                    if(!empty($all_eform_list)){ 

                      foreach($all_eform_list as $eform_key => $eform_val):
                  ?>
                      <tr>
                        <!-- <td class="text-left"><a href="<?=site_url('eform/view/'.$eform_val['eform_id'])?>"><?=$eform_val['site_name'];?></a></td> -->
                        <td class="text-left"><?=$eform_val['site_name'];?></td>
                        <td class="text-center"><?=$eform_val['province'];?></td>
                        <td class="text-center"><?=$eform_val['asset_type'];?> [<?=$eform_val['ma_type'];?>]</td>
                        <td class="text-center"><?=$eform_val['created_by'];?></td>
                        <td class="text-center"><?=$eform_val['created_date'];?></td>
                        <td class="text-center">
                        <? 
                          if( in_array($eform_val['eform_id'], $pass_eform) ){
                            echo "<span class=\"hidden\">Passed</span>";
                          }elseif( in_array($eform_val['eform_id'], $notpass_eform) ){
                            echo "<span class=\"hidden\">Not</span>";                            
                          }
                        ?>
                          
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
  var table;
  $(document).ready(function(){
    $('input[name="eform-time"]').daterangepicker({
        timePicker: false,
        locale: {
            format: 'YYYY-MM-DD'
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    });

    table = $('#tbEform').DataTable({
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

  function select_EformStatus (state)
  {
    if (state=='All')
    {
      result_state = '';
    }
    else if (state=='Passed')
    {
      result_state = 'Passed';
    }
    else if (state=='notPassed')
    {
      result_state = 'Not';
    }
    table
        .search( result_state )
        .draw();
  }
</script>