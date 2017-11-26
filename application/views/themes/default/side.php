<style type="text/css">
  .site_title2 {
    font-weight: 400;
    width: 100%;
    line-height: 59px;
    display: block;
    height: 55px;
    margin: 0;

  a, .site_title2 {
    color: #ECF0F1!important;
    margin-left: 0!important;
}
}
</style>
<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    <a href="http://www.mua.go.th" class="site_title2 text-center"> <span>สำนักงานคณะกรรมการการอุดมศึกษา</span></a>
  </div>

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <!-- <div class="profile clearfix">
    <div class="profile_pic">
      <img src="<?=base_url('assets/img/img.jpg');?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
      <span></span>
      <h2><?=$this->session->userdata('cn');?></h2>
    </div>
    <div class="clearfix"></div>
  </div> -->
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <!-- <h3>General</h3> -->
      <ul class="nav side-menu">
        <!-- <li><a><i class="fa fa-home"></i> หน้าหลัก </a></li>  -->
        <li><a href="<?=site_url('/schedule');?>"><i class="fa fa-calendar"></i> ตารางตรวจงาน </a></li> 
        <li><a href="<?=site_url('/eform');?>"><i class="fa fa-file-text"></i> แบบตรวจออนไลน์ </a></li> 
        <!-- <li><a><i class="fa fa-desktop"></i> Assets <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?=site_url('/asset/equip');?>">Fibre</a></li>
            <li><a href="<?=site_url('/asset/fibre');?>">Equipment</a></li>
          </ul>
        </li> -->
      </ul>
    </div>
  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
  </div>
  <!-- /menu footer buttons -->
</div>