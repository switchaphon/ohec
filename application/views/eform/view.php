<!-- page content -->
<article>
    <div class="right_col" role="main">
        <div class="">
        <div class="page-title">
            <div class="title_left">
            <h3></h3>
            </div>

            <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
                </div>
            </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                <h2>แบบตรวจสอบออนไลน์</h2>
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
                <? echo "<pre>"; print_r($eform); echo "</pre>"; ?>
                <section class="content invoice">
                    <!-- title row -->
                    <center><img src="<?=base_url('assets/img/uninet.png');?>" alt="uninet" height="150px"></center>
                    <div class="row">
                        <div class="col-xs-12 invoice-header">
                            <h2>แบบตรวจสอบผลการบำรุงรักษาเชิงป้องกัน (Preventive Maintenance)</h2>
                        </div>
                    <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-7 invoice-col">
                            <address>
                                <strong>โครงการจ้างบำรุงรักษา ซ่อมแซม แก้ไข และปรับเปลี่ยนอุปกรณ์ ระบบเครือข่ายสารสนเทศเพื่อพัฒนาการศึกษา ปีงบประมาณ 2560</strong>
                                <br><br>
                                <strong>มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี</strong>
                                <br><b>เจ้าหน้าที่ประจำสถานที่</b> สุรศักดิ์ สุภาสุธากุล
                                <br><b>หมายเลขโทรศัพท์</b> 089-540-4357
                                <br><b>อีเมล</b> s.witchaphon@abc.com
                                
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 invoice-col">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col">
                            <b>หมายเลข : equip-cm-2017080100</b>
                            <br><br><b>ผู้ตรวจสอบ</b> วิชญ์พล แสงอร่าม
                            <br><b>วันที่ตรวจสอบ</b> 2017-10-01
                            <br><br><button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> พิมพ์</button> 
                            <button class="btn btn-success pull-right"><i class="fa fa-edit"></i> แก้ไข</button>
                            <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6 col-xs-6 col-xs-12">
                            <p class="lead">ผลการตรวจสอบ</p>
                            
                        <!-- Router -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12"><span class="section">Router</span></div>
                            </div>
                        <!-- /Router -->


                        </div>

                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                    <div class="col-sm-9 invoice-col"></div>
                    <div class="col-xs-3">
                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> พิมพ์</button>
                        <button class="btn btn-success pull-right"><i class="fa fa-edit"></i> แก้ไข</button>
                        <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> PDF</button>
                    </div>
                    </div>
                </section>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</artical>
<!-- /page content -->