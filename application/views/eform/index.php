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
              <h2>รายการใบตรวจงาน</h2>
              <!-- <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
              </ul> -->
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <!-- /Dashboard --> 
              <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <h2>รายงานสรุปการตรวจงาน<?=urldecode($schedule_title);?> </h2>
                  <div class="x_content" style="padding-bottom: 0px; margin-top:0px">
                    <div class="row tile_count">
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                     
                        <!-- <form role="form" id="searchEform" name="searchEform" class="form-inline form-label-left" data-toggle="validator" action="<?=site_url('eform');?>" method="post"> -->
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <BR>
                            <!-- <fieldset>
                                <div class="control-group">
                                  <div class="controls">
                                      <div class="input-prepend input-group col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                      <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                      <input type="text" name="eform-time" id="eform-time" class="form-control" value="01/01/2016 - 01/25/2016" required/>
                                      </div>
                                  </div>
                                </div>
                            </fieldset> -->
                            <?  

                                if( !empty($schedule_list) ){
                                    echo "<select id=\"schedule\" name=\"schedule\" class=\"form-control selectpicker show-tick\" title=\" เลือกตารางตรวจงาน \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" >";
                                    foreach($schedule_list as $index => $value):
                                        echo '<optgroup label="งานตรวจ'.$index.'">';
                                        foreach($value as $key=>$val): 
                                          if($key == urldecode($schedule_title) ){
                                           echo '<option value="'.str_replace('/','.',$key).'" selected>'.$key.'</option>'; 
                                          }else{
                                           echo '<option value="'.str_replace('/','.',$key).'">'.$key.'</option>';                                             
                                          }
                                        endforeach;
                                        echo '</optgroup>';
                                    endforeach;
                                    echo "</select>";
                                }
                            ?>             
                          </div>
                          <!-- <div class="form-group col-lg-3 col-md-6 col-sm-4 col-xs-4">
                            <button id="submit" type="submit" class="btn btn-round btn-primary">ค้นหา</button>
                          </div> -->
                        <!-- </form> -->
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                        <a href="#" onclick="select_EformStatus('All')">
                        <div class="pull-left" style="padding-top: 8px;">
                        <i class="fa fa-file-text" style="font-size:20px;"></i>
                        </div>
                        <span class="pull-right count " style="margin-top: 0px;" id="Amount_UP"><?=$total_eform;?></span>
                        <div class="clearfix"></div>
                        <p class="pull-right">ทั้งหมด</p></a>
                      </div>

                      <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                        <a href="#" onclick="select_EformStatus('Passed')">
                        <div class="pull-left" style="padding-top: 8px;">
                        <i class="fa fa-check-circle green" style="font-size:20px;"></i>
                        </div>
                        <span class="pull-right count green " style="margin-top: 0px;" id="Amount_DOWN"><?=$passed_eform;?></span>
                        <div class="clearfix"></div>
                        <p class="pull-right">ผ่าน</p></a>
                      </div>

                      <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                        <a href="#" onclick="select_EformStatus('notPassed')">
                        <div class="pull-left" style="padding-top: 8px;">
                        <i class="fa fa-times-circle red" style="font-size:20px;"></i>
                        </div>
                        <span class="pull-right count red" style="margin-top: 0px;" id="Amount_UNREACHABLE"><?=$not_passed_eform;?></span>
                        <div class="clearfix"></div>
                        <p class="pull-right">ไม่ผ่าน</p></a>
                      </div>
                      
                      <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                        <a href="#" onclick="select_EformStatus('notFixed')">
                        <div class="pull-left" style="padding-top: 8px;">
                        <i class="fa fa-dot-circle-o blue" style="font-size:20px;"></i>
                        </div>
                        <span class="pull-right count blue" style="margin-top: 0px;" id="Amount_UNREACHABLE"><?=$fixed_eform;?></span>
                        <div class="clearfix"></div>
                        <p class="pull-right">แก้ไข</p></a>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <!-- /Dashboard -->
              
              <!-- <div class="ln_solid"></div> -->
              <? //echo "<pre>"; print_r($fixed_eform_list); echo "</pre>"; ?>
              <span id="controlPanel"></span>
              <table id="tbEform" name="tbEform" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
                <thead>
                  <tr>
                    <th class="text-center">ตารางตรวจงาน</th>
                    <th class="text-center">ชื่อหน่วยงาน</th>
                    <th class="text-center">จังหวัด</th>
                    <th class="text-center">ประเภทงานตรวจ</th>
                    <th class="text-center">สาเหตุ</th>
                    <th class="text-center">ผู้ตรวจสอบ</th>
                    <th class="text-center">วันที่ตรวจ</th>
                    <th class="text-center"></th>
                  </tr>
                </thead>
                
                <tbody>
                <? 
                    // echo "<pre>"; print_r($not_passed_cause_list); echo "</pre>";
                    $passed_eform = $notpassed_eform = $fixed_eform = array();
                    
                    if(!empty($passed_eform_list)){ 
                      foreach($passed_eform_list as $pass_val):
                        $passed_eform[]=$pass_val['eform_id'];
                      endforeach;                        
                    }

                    if(!empty($not_passed_eform_list)){ 
                      foreach($not_passed_eform_list as $notpass_val):
                        $notpassed_eform[]=$notpass_val['eform_id'];
                      endforeach;                        
                    } 
                    
                    if(!empty($fixed_eform_list)){ 
                      foreach($fixed_eform_list as $fix_val):
                        $fixed_eform[]=$fix_val['eform_id'];
                      endforeach;                        
                    } 

                    if(!empty($all_eform_list)){ 

                      foreach($all_eform_list as $eform_key => $eform_val):

                      if( in_array($eform_val['eform_id'], $passed_eform) ){
                        $tr_class = NULL; 
                      }elseif( (in_array($eform_val['eform_id'], $notpassed_eform) ) && !(in_array($eform_val['eform_id'], $fixed_eform)) ){
                        $tr_class = 'danger';                          
                      }elseif( ( in_array($eform_val['eform_id'], $notpassed_eform)) && (in_array($eform_val['eform_id'], $fixed_eform)) ){      
                        $tr_class = NULL;                   
                      }else{
                        $tr_class = NULL;                                           
                      }

                      if( !empty($not_passed_cause_list[$eform_val['eform_id']]) ){
                        $cause = NULL;
                        // for($i=0; $i < count($not_passed_cause_list[$eform_val['eform_id']]); $i++){
                          foreach( $not_passed_cause_list[$eform_val['eform_id']] as $cause_key => $cause_val ):
                            $cause = $cause.$cause_val."<BR>";
                          endforeach;
                        // }
                      }

                  ?>
                      <tr class="<?=$tr_class;?>">
                        <!-- <td class="text-left"><a href="<?=site_url('eform/view/'.$eform_val['eform_id'])?>"><?=$eform_val['site_name'];?></a></td> -->
                        <td class="text-left"><?=$eform_val['schedule_project']." - ".$eform_val['schedule_period']." [".$eform_val['region']."]";?></td>
                        <td class="text-left"><?=$eform_val['site_name'];?></td>
                        <td class="text-center"><?=$eform_val['province'];?></td>
                        <td class="text-center"><?=$eform_val['asset_type'];?> [<?=$eform_val['ma_type'];?>]</td>
                        <td class="text-left">
                          <? 
                            echo !empty($not_passed_cause_list[$eform_val['eform_id']]) ? $cause: '' ; 
                            // echo in_array($eform_val['eform_id'], $fixed_eform) ? '<span class="label label-primary">แก้ไขแล้ว</span>' : '' ; 
                          ?>
                        </td>
                        <td class="text-center"><?=$eform_val['created_by'];?></td>
                        <td class="text-center"><?=$eform_val['created_date'];?></td>
                        <td class="text-left">
                        <? 
                          if( in_array($eform_val['eform_id'], $passed_eform) ){
                            echo "<span class=\"hidden\">Passed</span>";
                          }elseif( (in_array($eform_val['eform_id'], $notpassed_eform) ) && !(in_array($eform_val['eform_id'], $fixed_eform)) ){
                            echo "<span class=\"hidden\">not</span>";                          
                          }elseif( ( in_array($eform_val['eform_id'], $notpassed_eform)) && (in_array($eform_val['eform_id'], $fixed_eform)) ){
                            echo "<span class=\"hidden\">NotFixed</span>";                           
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
  pdfMake.fonts = {
   THSarabun: {
     normal: 'THSarabun.ttf',
     bold: 'THSarabun-Bold.ttf',
     italics: 'THSarabun-Italic.ttf',
     bolditalics: 'THSarabun-BoldItalic.ttf'
   }
  }
  var table;
  $(document).ready(function(){
    // $('input[name="eform-time"]').daterangepicker({
    //     timePicker: false,
    //     locale: {
    //         format: 'YYYY-MM-DD'
    //     },
    //     startDate: moment().subtract(29, 'days'),
    //     endDate: moment()
    // });

    //Once region changed, re-query province
    $('#schedule').change(function(){
      // alert($('#schedule').val());
      window.location = '<?=site_url('/Eform/index/');?>' + this.value;
    // $.ajax({
    //     type: "POST",
    //     dataType: 'json',
    //     url: "<?=site_url('/Eform/index');?>",
    //     data: "schedule="+ $('#schedule').val(),
    // //     success: function(result)
    // //     {
    // //         $.each(result,function(region,province){
    // //             var str = '';
    // //             var opt = '';
    // //             for(i = 0; i<province.length; i++) {
    // //                 opt += '<option value="'+province[i]+'">'+province[i]+'</option>';                       
    // //             }

    // //             str += '<optgroup label="'+region+'">'+opt+'</optgroup>';

    // //             $("#province").append(str);
    // //         });//end each

    // //         $('#province').selectpicker('refresh');
    // //     },
    // //     error: function (xhr, ajaxOptions, thrownError) {
    // //         console.log(xhr.status);
    // //         console.log(thrownError);
    // //     }
    // });

    });

    table = $('#tbEform').DataTable({
      // "pageLength": 50,
      "processing": true,
      "paging":   true,
      "ordering": true,
      language: { search: "_INPUT_" , searchPlaceholder: "ค้นหา..." },
      // "dom": '<"toolbar">frtip',
      dom: 'Bfrtip',
      buttons: [
            {
              "extend": 'excel', // ปุ่มสร้าง pdf ไฟล์
              "text": '<span class="fa fa-cloud-download" aria-hidden="true"></span> Excel', // ข้อความที่แสดง
            },     
            { // กำหนดพิเศษเฉพาะปุ่ม pdf
              "extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
              "text": '<span class="fa fa-cloud-download" aria-hidden="true"></span> PDF', // ข้อความที่แสดง
              "pageSize": 'A3',   // ขนาดหน้ากระดาษเป็น A3     
              "customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
                  // กำหนด style หลัก
                  doc.defaultStyle = {
                      font:'THSarabun',
                      pageOrientation: 'landscape', 
                      fontSize: 10,                                
                  };
                  // // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
                  doc.content[1].table.widths = [ 80 , 200 , 'auto', 'auto' , 150 , 100 , 80, 'auto' ];
                  doc.styles.tableHeader.fontSize = 12; // กำหนดขนาด font ของ header
                  doc.styles.tableHeader.alignment = 'center'; // กำหนดขนาด font ของ header
                  var rowCount = doc.content[1].table.body.length; // หาจำนวนแะวทั้งหมดในตาราง
                  // // วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
                  for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
                      doc.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
                      doc.content[1].table.body[i][1].alignment = 'center';
                      doc.content[1].table.body[i][2].alignment = 'center';
                      doc.content[1].table.body[i][3].alignment = 'center';
                      doc.content[1].table.body[i][4].alignment = 'left';
                      doc.content[1].table.body[i][5].alignment = 'center';
                      doc.content[1].table.body[i][6].alignment = 'center';
                      doc.content[1].table.body[i][7] = ''; // ไม่แสดง column ที่ 7 ใน PDF
                  };                                  
              }
          }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
        ]
      });

      $("div.toolbar").html('<span id="tbEform_filter2" class="dataTables_filter"></span>');
      
      
      //Search box
      $('#tbEform_filter').css('float','left');
      $('#tbEform_filter').css('text-align','left');

      $('#tbEform_filter').css('float','left','form-inline');
      $('#tbEform_filter2').css('float','right');
      $('#tbEform_wrapper .dt-buttons').css('float','right');
      $('#tbEform_filter2').append($('#controlPanel'));
      $("div.toolbar").append($('#tbEform_filter'));

      $('#tbEform').removeClass('hidden');

      $('#disableEformModal').on('show.bs.modal', function(e) {
      var eform_id = $(e.relatedTarget).data('eform_id')
      var schedule_id = $(e.relatedTarget).data('schedule_id')
      var site_name = $(e.relatedTarget).data('site_name')
      var committee = $(e.relatedTarget).data('committee')
      var called_page = "eform";

      $("#disableEformModal .modal-header .modal-title").html('ยกเลิกใบตรวจงาน');
      $("#disableEformModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกใบตรวจงาน<BR><BR>หมายเลข: <b>'+eform_id+'</b><BR>ชื่อหน่วยงาน: <b>'+site_name+'</b><BR>สร้างโดย: <b>'+committee+'</b><BR><BR>ใช่หรือไม่ ?</div>');

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
    else if (state=='notFixed')
    {
      result_state = 'notFixed';
    }
    table
        .search( result_state )
        .draw();
  }
</script>