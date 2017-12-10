<!-- top navigation -->
<div class="nav_menu">
  <nav>
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>

    <ul class="nav navbar-nav navbar-right">
      <li class="">
        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <!-- <img src="<?=base_url('assets/img/img.jpg');?>" alt="">--><?=$this->session->userdata('name');?> <?=$this->session->userdata('surname');?> (<?=$this->session->userdata('role');?> )
          <span class=" fa fa-angle-down"></span>
        </a>
        <ul class="dropdown-menu dropdown-usermenu pull-right">
          <li><a href="<?=site_url('user/logout');?>"><i class="fa fa-sign-out pull-right"></i> ออกจากระบบ</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</div>
<!-- /top navigation -->