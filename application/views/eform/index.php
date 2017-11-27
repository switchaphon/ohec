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
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a></li>
                          <li><a href="#">Settings 2</a></li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- <p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p> -->
                    <span id="controlPanel">
                    <!-- <a class="btn btn-app pull-right" href="<?=site_url('ef/equip')?>" name='create'>
                      <i class="fa fa-edit"></i> สร้างใหม่
                    </a> -->
                      <!-- <a class="btn btn-round btn-success pull-right" href="<?=site_url('ef/equip')?>" name='create'><span class="fa fa-edit" aria-hidden="true"></span> สร้างใหม่</a> -->
                    </span>
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
                                <a href="<?=site_url('eform/view')?>/<?=$eform_val['eform_id'];?>" class="btn btn-round btn-default btn-xs"><i class="fa fa-folder-open"></i> เรียกดู</a>
                               <? if( $this->session->userdata('role') == 'Administrator'){?> 
                                <a href="#" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-o"> ยกเลิก</i>  </a>
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

<script>

  $(document).ready(function(){
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
  });
</script>