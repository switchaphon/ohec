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
                    <!-- <h2>ตารางตรวจงาน <? echo $schedule[0]['schedule_project']." ".$schedule[0]['schedule_period']." (".$schedule[0]['region'].")"; ?> <i class="fa fa-info-circle"></i><small></small></h2> -->
                    <h2>รายละเอียดตารางตรวจงาน <i class="fa fa-info-circle"></i><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
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
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">โครงการ</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$val['schedule_project'];?></div>
                    </div>

                    <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">งวดงาน/ปีสัญญา</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$val['schedule_period'];?></div>
                    </div>

                    <!-- <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">ชื่อ</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$val['schedule_name'];?></div>
                    </div> -->
          
                    <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">วันที่ออกตรวจ</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=convert_to_yyyymmdd( $val['start_date'] );?> ถึง <?=convert_to_yyyymmdd( $val['end_date'] );?></div>
                    </div>

                    <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">ระยะเวลาของ Ticket</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=convert_to_yyyymmdd( $val['ticket_start_date'] );?> ถึง <?=convert_to_yyyymmdd( $val['ticket_end_date'] );?></div>
                    </div>

                    <div class="row">
                      <?
                        $region = null; 
                        $region_array = explode("," , $val['region']); 
                        foreach($region_array as $region_key => $region_val):
                          $region = $region.$region_list[$region_val]."<BR>";
                        endforeach;
                      ?>
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">พื้นที่</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$region;?></div>
                    </div>

                    <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">จังหวัด</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$val['province'];?></div>
                    </div>
                    
                    <? if(!empty($val['schedule_description'])) { ?>
                    <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">รายละเอียด</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$val['schedule_description'];?></div>
                    </div>
                    <? } ?>

                    <div class="ln_solid"></div>    
                    
                    <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">สร้างเมื่อ</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$val['created_date'];?></div>
                    </div>

                    <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">สร้างโดย</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$val['created_by'];?></div>
                    </div>
                    
                    <? if($val['updated_date'] != NULL){?>

                    <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">แก้ไขเมื่อ</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$val['updated_date'];?></div>
                    </div>

                    <div class="row">
                      <label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-5 text-right">แก้ไขโดย</label>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><?=$val['updated_by'];?></div>
                    </div>

                    <? } ?>
                    <? endforeach; ?>

                    <!-- <div id="map-canvas" style="width: 100%; height: 100%">xxx</div> -->

                    <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                          <? if($permission->schedule_view){ ?>
                            <a href="<?=site_url('schedule')?>" class="btn btn-round btn-default" id='backSchedulebtn' name='backSchedulebtn' ><span class="fa fa-edit" aria-hidden="true"></span> ย้อนกลับ</a>
                          <? } ?>
                          <? if($permission->schedule_edit){ ?>
                            <a href="<?=site_url('schedule/edit')?>/<?=$val['schedule_id'];?>" class="btn btn-round btn-success" id='editSchedulebtn' name='editSchedulebtn' ><span class="fa fa-edit" aria-hidden="true"></span> แก้ไข</a>
                          <? } ?>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>

              <!-- committee card -->  
                <div class="x_panel">
                  <div class="x_title">
                    <h2>กรรมการ <i class="fa fa-users"></i><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
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
                        <? if( $permission->schedule_view){ ?>
                          <a href="#" class="btn btn-round btn-success pull-right" id='joinSchedulebtn' name='joinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_project="<?=$schedule[0]['schedule_project'];?>" data-schedule_period="<?=$schedule[0]['schedule_period'];?>" data-region="<?=$region;?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#joinScheduleModal"  ><span class="fa fa-plus" aria-hidden="true"></span> เข้าร่วม</a>
                        <? } ?>
                      <?  
                          }
                        }else{ 
                      ?>
                        <? if( $permission->schedule_view){ ?>
                          <a href="#" class="btn btn-round btn-success pull-right" id='joinSchedulebtn' name='joinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_project="<?=$schedule[0]['schedule_project'];?>" data-schedule_period="<?=$schedule[0]['schedule_period'];?>" data-region="<?=$region;?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#joinScheduleModal"  ><span class="fa fa-plus" aria-hidden="true"></span> เข้าร่วม</a>
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
                            <td class="text-left"><?=$val;?></td>
                            <? if($val == $this->session->userdata('name')." ".$this->session->userdata('surname')) { ?>
                              <td class="text-left">
                                <? if( $permission->schedule_view){ ?>
                                  <a href="#" class="btn btn-round btn-danger btn-xs" id='disjoinSchedulebtn' name='disjoinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_project="<?=$schedule[0]['schedule_project'];?>" data-schedule_period="<?=$schedule[0]['schedule_period'];?>" data-region="<?=$region;?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#disjoinScheduleModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                
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
                      <h2>รายการงานตรวจ <i class="fa fa-university"></i><small></small></h2>
                      <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <!-- <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <span id="panelTask">
                        <? if($permission->schedule_edit) { ?>
                          <a href="#" class="btn btn-round btn-success pull-right" name='addTaskbtn' data-toggle="modal" data-target="#addTaskModal" ><span class="fa fa-plus" aria-hidden="true"></span> เพิ่มงานตรวจ</a>
                        <? } ?>
                      </span>
                      <table id="tbTask" name="tbTask" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline">
                          <thead>
                              <tr>
                              <th class="text-center">ชื่อหน่วยงาน</th>
                              <th class="text-center">ประเภทงานตรวจ</th>
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
                                <td class="text-center"><?=$val['asset_type'];?> [<?=$val['ma_type'];?>]</td>
                                <td class="text-left">
                                <? 
                                  if( !empty($committee_list) ){
                                    if(in_array($this->session->userdata('name')." ".$this->session->userdata('surname'), $committee_list) ){
                                      if( !$flag ) {
                                ?>
                                  <? if( $permission->eform_add){?>
                                  <a href="<?=site_url('eform/create/'.$schedule[0]['schedule_id']).'/'.$val['site_id'].'/'.$val['form_id'];?>" class="btn btn-round btn-success btn-xs"><i class="fa fa-file-text"></i> ตรวจ </a>
                                  <? } ?>
                                <?  } 
                                    if( $permission->schedule_delete){?>  
                                  <a href="#" class="btn btn-round btn-danger btn-xs" id='cancelTaskbtn' name='cancelTaskbtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-site_id="<?=$val['site_id'];?>" data-site_name="<?=$val['site_name'];?>" data-schedule_project="<?=$schedule[0]['schedule_project'];?>" data-schedule_period="<?=$schedule[0]['schedule_period'];?>"data-toggle="modal" data-target="#cancelTaskModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ลบ</a>                                
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
                        <h2>รายการใบตรวจงาน <i class="fa fa-file-text"></i><small></small></h2>
                        <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                          <!-- <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- /Dashboard --> 
                        <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                            <h2></h2>
                            <div class="x_content" style="padding-bottom: 0px; margin-top:0px">
                              <div class="row tile_count">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 tile_stats_count">
                                  <a href="#" onclick="select_EformStatus('All')">
                                  <div class="pull-left" style="padding-top: 8px;">
                                  <i class="fa fa-file-text" style="font-size:20px;"></i>
                                  </div>
                                  <span class="pull-right count " style="margin-top: 0px;" id="Amount_UP"><?=$total_eform;?></span>
                                  <div class="clearfix"></div>
                                  <p class="pull-right">ทั้งหมด</p></a>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 tile_stats_count">
                                  <a href="#" onclick="select_EformStatus('Passed')">
                                  <div class="pull-left" style="padding-top: 8px;">
                                  <i class="fa fa-check-circle green" style="font-size:20px;"></i>
                                  </div>
                                  <span class="pull-right count green " style="margin-top: 0px;" id="Amount_DOWN"><?=$passed_eform;?></span>
                                  <div class="clearfix"></div>
                                  <p class="pull-right">ผ่าน</p></a>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 tile_stats_count">
                                  <a href="#" onclick="select_EformStatus('notPassed')">
                                  <div class="pull-left" style="padding-top: 8px;">
                                  <i class="fa fa-times-circle red" style="font-size:20px;"></i>
                                  </div>
                                  <span class="pull-right count red" style="margin-top: 0px;" id="Amount_UNREACHABLE"><?=$not_passed_eform;?></span>
                                  <div class="clearfix"></div>
                                  <p class="pull-right">ไม่ผ่าน</p></a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 tile_stats_count">
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

                        <table id="tbEform" name="tbEform" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline">
                        <thead>
                            <tr>
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
                          // echo "<pre>"; print_r($not_passed_cause_list); echo "</pre>";
                          if(!empty($eform_list)){ 
                            
                            foreach($eform_list as $eform_key => $eform_val):

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
                              <td class="text-left"><?=$eform_val['site_name'];?></td>
                              <td class="text-center"><?=$eform_val['province'];?></td>
                              <td class="text-center"><?=$eform_val['asset_type'];?> [<?=$eform_val['ma_type']?>]</td>
                              <td class="text-left">
                                <? 
                                  echo !empty($not_passed_cause_list[$eform_val['eform_id']]) ? $cause: '' ; 
                                  echo in_array($eform_val['eform_id'], $fixed_eform) ? '<span class="label label-primary">แก้ไขแล้ว</span>' : '' ; 
                                ?>
                              </td>
                              <td class="text-center"><?=$eform_val['created_by'];?></td>
                              <td class="text-center"><?=$eform_val['created_date'];?></td>
                              <td class="text-center">
                                <? 
                                  if( in_array($eform_val['eform_id'], $passed_eform) ){
                                    echo "<span class=\"hidden\">Passed</span>";
                                  }elseif( (in_array($eform_val['eform_id'], $notpassed_eform) ) && !(in_array($eform_val['eform_id'], $fixed_eform)) ){
                                    echo "<span class=\"hidden\">not</span>";                          
                                  }elseif( ( in_array($eform_val['eform_id'], $notpassed_eform)) && (in_array($eform_val['eform_id'], $fixed_eform)) ){
                                    echo "<span class=\"hidden\">NotFixed</span>";                           
                                  }
                                ?>                                 
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

    table = $('#tbEform').DataTable({
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
      var schedule_project = $(e.relatedTarget).data('schedule_project')
      var schedule_period = $(e.relatedTarget).data('schedule_period')
      var region = $(e.relatedTarget).data('region')      
      var name = $(e.relatedTarget).data('name')

      $("#joinScheduleModal .modal-header .modal-title").html('เข้าร่วมการตรวจงานนี้');
      $("#joinScheduleModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการเข้าร่วมเป็นกรรมการการตรวจงาน<BR><BR><b>'+schedule_project+' '+schedule_period+'<BR>'+region+'</b><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="name"]').val(name);
    });

    $('#disjoinScheduleModal').on('show.bs.modal', function(e) {
      var schedule_id = $(e.relatedTarget).data('schedule_id')
      var schedule_project = $(e.relatedTarget).data('schedule_project')
      var schedule_period = $(e.relatedTarget).data('schedule_period')
      var region = $(e.relatedTarget).data('region')
      var name = $(e.relatedTarget).data('name')

      $("#disjoinScheduleModal .modal-header .modal-title").html('ยกเลิกเข้าร่วมการตรวจงานนี้');
      $("#disjoinScheduleModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกเป็นกรรมการการตรวจงาน<BR><BR><b>'+schedule_project+' '+schedule_period+'<BR>'+region+'</b><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="name"]').val(name);
    });

    $('#cancelTaskModal').on('show.bs.modal', function(e) {
      var schedule_id = $(e.relatedTarget).data('schedule_id')
      var site_id = $(e.relatedTarget).data('site_id')
      var site_name = $(e.relatedTarget).data('site_name')
      // var ticket_id = $(e.relatedTarget).data('ticket_id')
      var schedule_project = $(e.relatedTarget).data('schedule_project')
      var schedule_period = $(e.relatedTarget).data('schedule_period')

      $("#cancelTaskModal .modal-header .modal-title").html('ยกเลิกการตรวจ');
      $("#cancelTaskModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกการตรวจ<BR><BR><b>'+schedule_project+' '+schedule_period+'<BR>'+site_name+'</b><BR><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="site_id"]').val(site_id);
      $(e.currentTarget).find('input[name="ticket_id"]').val(ticket_id);
    });

    $('#disableEformModal').on('show.bs.modal', function(e) {
      var eform_id = $(e.relatedTarget).data('eform_id')
      var schedule_id = $(e.relatedTarget).data('schedule_id')
      var site_name = $(e.relatedTarget).data('site_name')
      var committee = $(e.relatedTarget).data('committee')
      var called_page = "schedule";

      $("#disableEformModal .modal-header .modal-title").html('ยกเลิกใบตรวจงาน');
      $("#disableEformModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกใบตรวจงาน<BR><BR>หมายเลข: <b>'+eform_id+'</b><BR>สถานที่: <b>'+site_name+'</b><BR>สร้างโดย: <b>'+committee+'</b><BR><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="eform_id"]').val(eform_id);
      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="called_page"]').val(called_page);
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