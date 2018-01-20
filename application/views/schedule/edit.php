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
                    <h2>แก้ไขตารางตรวจงาน <i class="fa fa-info-circle"></i><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
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

                    <!-- <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" >โครงการ <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-9 col-xs-12 text-left">
                            <input type="text" id="project"  name="project" class="form-control" placeholder="ตัวอย่างเช่น ไฟเบอร์ หรือ อุปกรณ์" value="<?=$val['schedule_project'];?>" required>
                        </div>
                    </div> -->
                    
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" >โครงการ <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-9 col-xs-12 text-left">
                        <?
                              echo "<select name=\"project\" id=\"project\" class=\"form-control selectpicker show-tick\" title=\"ปีสัญญา\" \"data-live-search=\"false\" data-size=\"10\" data-width=\"css-width\" required>";
                              foreach($project as $pro_key => $pro_val):
                                  if($pro_val['project'] == $val['schedule_project']){ $selected = 'selected'; }else{ $selected = NULL; }
                                  echo "<option value=\"".$pro_val['project']."\"".$selected.">".$pro_val['project']."</option>\"";
                              endforeach;
                              echo "</select>";
                          ?>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" >งวดงาน/ปีสัญญา <span class="required">*</span></label>
                        <div class="col-md-4 col-sm-4 col-xs-6 text-left">
                          <?
                              echo "<select name=\"period\" id=\"period\" class=\"form-control selectpicker show-tick\" title=\"งวดงาน\" \"data-live-search=\"false\" data-size=\"10\" data-width=\"css-width\" required>";
                              foreach($period as $per_key => $per_val):
                                  if($per_key == explode('/',$val['schedule_period'])[0] ){ $selected = 'selected'; }else{ $selected = NULL; }
                                  echo "<option value=\"".$per_key."\"".$selected.">".$per_key."</option>\"";
                              endforeach;
                              echo "</select>";
                          ?>                           
                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-6 text-left">
                          <?
                              echo "<select name=\"year\" id=\"year\" class=\"form-control selectpicker show-tick\" title=\"ปีสัญญา\" \"data-live-search=\"false\" data-size=\"10\" data-width=\"css-width\" required>";
                              foreach($year as $year_key => $year_val):
                                  if($year_key == explode('/',$val['schedule_period'])[1] ){ $selected = 'selected'; }else{ $selected = NULL; }
                                  echo "<option value=\"".$year_key."\"".$selected.">".$year_key."</option>\"";
                              endforeach;
                              echo "</select>";
                          ?>                           
                        </div>
                    </div>                                    

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">วันที่ออกตรวจ <span class="required">*</span></label>
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">ระยะเวลาของ Ticket <span class="required">*</span></label>
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
                              $region = null; 
                              $region_array = explode("," , $val['region']); 
                              foreach($region_array as $region_key => $region_val):
                                $region = $region.$region_list[$region_val]."<BR>";
                              endforeach;

                               $region_array = explode("," , $val['region']);
                                echo "<select name=\"region[]\" id=\"region\" class=\"form-control selectpicker show-tick\" title=\"select \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                                foreach($region_list as $reg_key => $reg_val):
                                    // if($reg_key == $val['region']){
                                      if( in_array( $reg_key , $region_array) ) {  
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

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="textarea">รายละเอียด </label>
                        <div class="col-md-8 col-sm-9 col-xs-12 text-left">
                            <textarea id="description"  name="description" class="form-control"><?=$val['schedule_description'];?></textarea>
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
                        <? if($permission->schedule_view) {?>
                          <!-- <a href="#" class="btn btn-round btn-success pull-right" id='joinSchedulebtn' name='joinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#joinScheduleModal"  ><span class="fa fa-plus" aria-hidden="true"></span> เข้าร่วม</a> -->
                          <a href="#" class="btn btn-round btn-success pull-right" id='joinSchedulebtn' name='joinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_project="<?=$schedule[0]['schedule_project'];?>" data-schedule_period="<?=$schedule[0]['schedule_period'];?>" data-region="<?=$region;?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#joinScheduleModal"  ><span class="fa fa-plus" aria-hidden="true"></span> เข้าร่วม</a>
                        <? } ?>
                      <?  
                          }
                        }else{ 
                      ?>
                        <? if($permission->schedule_view) {?>
                          <!-- <a href="#" class="btn btn-round btn-success pull-right" id='joinSchedulebtn' name='joinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#joinScheduleModal"  ><span class="fa fa-plus" aria-hidden="true"></span> เข้าร่วม</a> -->
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
                            <td class="text-left"><a href="#"><?=$val;?></a></td>
                            <? if($val == $this->session->userdata('name')." ".$this->session->userdata('surname')){ ?>
                              <td class="text-left">
                                <? if($permission->schedule_view) {?>
                                  <!-- <a href="#" class="btn btn-round btn-danger btn-xs" id='disjoinSchedulebtn' name='disjoinSchedulebtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-schedule_description="<?=$schedule[0]['schedule_description'];?>" data-schedule_name="<?=$schedule[0]['schedule_name'];?>" data-name="<?=$this->session->userdata('name')." ".$this->session->userdata('surname');?>"  data-toggle="modal" data-target="#disjoinScheduleModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ยกเลิก</a>                                 -->
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
                        <? if($permission->schedule_edit) {?>
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
                                  if(in_array($this->session->userdata('name')." ".$this->session->userdata('surname'), $committee_list) || ($this->session->userdata('role') == "Admin") ){
                                    if( !$flag ) {  
                                      if( $permission->eform_add) {?>
                                        <a href="<?=site_url('eform/create/'.$schedule[0]['schedule_id']).'/'.$val['site_id'].'/'.$val['form_id'];?>" class="btn btn-round btn-success btn-xs"><i class="fa fa-file-text"></i> ตรวจ </a>
                                      <? } 
                                    } 
                                  if( $permission->schedule_delete) {?>  
                                        <a href="#" class="btn btn-round btn-danger btn-xs" id='cancelTaskbtn' name='cancelTaskbtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-site_id="<?=$val['site_id'];?>" data-site_name="<?=$val['site_name'];?>" data-schedule_project="<?=$schedule[0]['schedule_project'];?>" data-schedule_period="<?=$schedule[0]['schedule_period'];?>" data-form_id="<?=$val['ticket_id'];?>" data-asset_type="<?=$val['asset_type'];?>" data-ma_type="<?=$val['ma_type'];?>" data-toggle="modal" data-target="#cancelTaskModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ลบ</a>                                
                              <? 
                                    } 
                                  }
                                }elseif(($this->session->userdata('role') == "Admin")){
                              ?>
                                <a href="#" class="btn btn-round btn-danger btn-xs" id='cancelTaskbtn' name='cancelTaskbtn' data-schedule_id="<?=$schedule[0]['schedule_id'];?>" data-site_id="<?=$val['site_id'];?>" data-site_name="<?=$val['site_name'];?>" data-schedule_project="<?=$schedule[0]['schedule_project'];?>" data-schedule_period="<?=$schedule[0]['schedule_period'];?>" data-form_id="<?=$val['ticket_id'];?>" data-asset_type="<?=$val['asset_type'];?>" data-ma_type="<?=$val['ma_type'];?>" data-toggle="modal" data-target="#cancelTaskModal"  ><span class="fa fa-trash-o" aria-hidden="true"></span> ลบ</a>                                
                              <?    
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
                              <th class="text-center">วันที่ตรวจสอบ</th>
                              <th class="text-center"></th>
                            </tr>
                          </thead>
                        
                        <tbody>
                        <? 
                          $pass_eform = $notpass_eform = $fix_eform = array();
                                              
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

                          if(!empty($fixed_eform_list)){ 
                            foreach($fixed_eform_list as $fix_val):
                              $fix_eform[]=$fix_val['eform_id'];
                            endforeach;                        
                          } 

                          if(!empty($eform_list)){ 
                            foreach($eform_list as $eform_key => $eform_val):

                              if( in_array($eform_val['eform_id'], $pass_eform) ){
                                $tr_class = NULL; 
                              }elseif( (in_array($eform_val['eform_id'], $notpass_eform) ) && !(in_array($eform_val['eform_id'], $fix_eform)) ){
                                $tr_class = 'danger';                          
                              }elseif( ( in_array($eform_val['eform_id'], $notpass_eform)) && (in_array($eform_val['eform_id'], $fix_eform)) ){      
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
                              <td class="text-left"><?=$eform_val['site_name'];?></td>
                              <td class="text-center"><?=$eform_val['province'];?></td>
                              <td class="text-center"><?=$eform_val['asset_type'];?> [<?=$eform_val['ma_type']?>]</td>
                              <td class="text-left"><? echo !empty($not_passed_cause_list[$eform_val['eform_id']]) ? $cause: '' ; ?></td>
                              <td class="text-center"><?=$eform_val['created_by'];?></td>
                              <td class="text-center"><?=$eform_val['created_date'];?></td>
                              <td class="text-center">
                                <? 
                                  if( in_array($eform_val['eform_id'], $pass_eform) ){
                                    echo "<span class=\"hidden\">Passed</span>";
                                  }elseif( (in_array($eform_val['eform_id'], $notpass_eform) ) && !(in_array($eform_val['eform_id'], $fix_eform)) ){
                                    echo "<span class=\"hidden\">not</span>";                          
                                  }elseif( ( in_array($eform_val['eform_id'], $notpass_eform)) && (in_array($eform_val['eform_id'], $fix_eform)) ){
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

    //Once project changed, re-query period
    $('#project').change(function(){
        $("#period").html('');
    
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?=site_url('/Schedule/list_period_by_project');?>",
            data: "project="+ $('#project').val(),
            success: function(result)
            {   
                var opt = '';
                for(i = 1; i <= result; i++) {
                    opt += '<option value="'+i+'">'+i+'</option>';                       
                }
                $("#period").append(opt);
                $('#period').selectpicker('refresh');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });

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
      var form_id = $(e.relatedTarget).data('form_id')
      var asset_type = $(e.relatedTarget).data('asset_type')
      var ma_type = $(e.relatedTarget).data('ma_type')
      var schedule_project = $(e.relatedTarget).data('schedule_project')
      var schedule_period = $(e.relatedTarget).data('schedule_period')

      $("#cancelTaskModal .modal-header .modal-title").html('ยกเลิกการตรวจ');
      $("#cancelTaskModal .modal-body .panel-body .message").html('<div class="text-center">ต้องการยกเลิกการตรวจ<BR><BR><b>'+schedule_project+' '+schedule_period+'<BR>'+site_name+'<BR>'+asset_type+' ['+ma_type+']</b><BR><BR>ใช่หรือไม่ ?</div>');

      $(e.currentTarget).find('input[name="schedule_id"]').val(schedule_id);
      $(e.currentTarget).find('input[name="site_id"]').val(site_id);
      $(e.currentTarget).find('input[name="form_id"]').val(form_id);
      $(e.currentTarget).find('input[name="asset_type"]').val(asset_type);
      $(e.currentTarget).find('input[name="ma_type"]').val(ma_type);
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