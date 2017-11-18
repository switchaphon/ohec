<!-- page content -->
<article>
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>ตารางการตรวจงาน</h3>
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
                    <h4>รายละเอียด <i class="fa fa-info-circle"></i> </h4>
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
                    <? echo "<pre>"; print_r($schedule); echo "</pre>"; ?>
                    
                      <div class="ln_solid"></div>

                      <!-- <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary">Cancel</button>
                          <button type="reset" class="btn btn-primary">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div> -->

                    </form>
                  </div>
                </div>
              </div>
            <!-- /left card -->

            <!-- right card -->
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>สถานที่ <i class="fa fa-university"></i></h4>
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
                    <span id="controlPanel">
                      <a href="#" class="btn btn-round btn-default pull-right" name='addTaskbtn' data-toggle="modal" data-target="#addTaskModal" ><span class="fa fa-plus-circle" aria-hidden="true"></span> เพิ่ม</a>
                    </span>
                    <table id="scheduleTask" name="scheduleTask" class="table table-striped">
                        <thead>
                            <tr>
                            <th>สถานที่</th>
                            <th>ทรัพย์สิน</th>
                            <th>หมายเลขเคส</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>        
                        <?
                        foreach($task_list as $row):
                        ?>
                          <tr>
                              <td class="text-center"><a href="#"><?=$row['site_name'];?></a></td>
                              <td class="text-center"><a href="#"><?=$row['ma_type'];?></a></td>
                              <td class="text-center"><a href="#"><?=$row['ticket_id'];?></a></td>
                              <td class="text-center"><a href="#"></td>
                          </tr>

                        <?
                          endforeach;
                        ?>       
                        </tbody>
                      </table>             
                    <!-- end form for validations -->
                  </div>

                  <!-- addTaskModal -->
                  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="addTaskModal">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                            <? $this->load->view('schedule/add_task_modal'); ?>
                      </div>
                    </div>
                  </div>
                  <!-- /addTaskModal -->
                
                </div>

                <div class="x_panel">
                  <div class="x_title">
                    <h4>กรรมการ <i class="fa fa-users"></i></h4>
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
                    
                    <!-- end form for validations -->

                  </div>
                </div>

              </div>
            <!-- /right card -->




        </div>
        <!-- /top row -->
        
        <!-- bottom row -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <!-- <h2><small>รายการแบบตรวจสอบออนไลน์</small></h2> -->
                        <h2>App Versions</h2>
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
                        <table id="scheduleEform" name="scheduleEform" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th>หมายเลข</th>
                            <th>ชื่อหน่วยงาน</th>
                            <th>จังหวัด</th>
                            <th>ทรัพย์สิน</th>
                            <th>ประเภทการตรวจสอบ</th>
                            <th>ผู้ตรวจสอบ</th>
                            <th>วันที่ตรวจสอบ</th>
                            <th></th>
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

<!-- page script -->
<script type="text/javascript">
 $(document).ready(function(){

    $('#scheduleTask').DataTable({
          // "pageLength": 50,
          "paging":   true,
          "ordering": true,
          language: { search: "_INPUT_" , searchPlaceholder: "ค้นหา..." }, //remove "search" label and put in placeholder
          "dom": '<"toolbar">frtip'
         });

    $("div.toolbar").html('<span id="scheduleTask_filter2" class="dataTables_filter"></span>');
    //Search box
    $('#scheduleTask_filter').css('float','left');
    $('#scheduleTask_filter').css('text-align','left');

    $('#scheduleTask_filter2').css('float','right');
    $('#scheduleTask_filter2').append($('#controlPanel'));
    $("div.toolbar").append($('#scheduleTask_filter'));

    $('#scheduleTask').removeClass('hidden');

 });



</script>
<!-- /page script -->