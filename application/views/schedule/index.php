<!-- page content -->
<article>
<div class="right_col" role="main">
  <div class="">
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

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>รายการตารางการตรวจงาน</h2>
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
                      <a class="btn btn-round btn-default pull-right" href="<?=site_url('schedule/create')?>" name='create'><span class="fa fa-edit" aria-hidden="true"></span> สร้างใหม่</a>
                    </span>
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>หมายเลข</th>
                          <th>ชื่อ</th>
                          <th>รายละเอียด</th>
                          <th>วันเดินทาง</th>
                          <th>พื้นที่</th>
                          <th>จังหวัด</th>
                          <th></th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?
                        foreach($schedule as $row):
                      ?>
                        <tr>
                            <td class="text-center"><a href="<?=site_url('schedule/view')?>/<?=$row['schedule_id'];?>"><?=$row['schedule_id'];?></a></td>
                            <td class="text-center"><a href="<?=site_url('schedule/view')?>/<?=$row['schedule_id'];?>"><?=$row['schedule_name'];?></a></td>
                            <td class="text-center"><a href="<?=site_url('schedule/view')?>/<?=$row['schedule_id'];?>"><?=$row['schedule_description'];?></a></td>
                            <td class="text-center"><a href="<?=site_url('schedule/view')?>/<?=$row['schedule_id'];?>"><?=convert_to_yyyymmdd($row['start_date']);?> ถึง <?=convert_to_yyyymmdd($row['end_date']);?></a></td>
                            <td class="text-center"><a href="<?=site_url('schedule/view')?>/<?=$row['schedule_id'];?>"><?=$row['region'];?></a></td>
                            <td class="text-center"><a href="<?=site_url('schedule/view')?>/<?=$row['schedule_id'];?>"><?=$row['province'];?></a></td>
                            <td class="text-center"><a href="<?=site_url('schedule/view')?>/<?=$row['schedule_id'];?>"></td>
                        </tr>

                      <?
                        endforeach;
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
        $('#datatable-responsive').DataTable({
          // "pageLength": 50,
          "paging":   true,
          "ordering": false,
          "dom": '<"toolbar">frtip'
         });
         $("div.toolbar").html('<span id="datatable-responsive_filter2" class="dataTables_filter"></span>');
         $('#datatable-responsive_filter').css('float','left','form-inline');
         $('#datatable-responsive_filter2').css('float','right');
         $('#datatable-responsive_filter2').append($('#controlPanel'));
         $("div.toolbar").append($('#datatable-responsive_filter'));

         $('#datatable-responsive').removeClass('hidden');
    });
</script>