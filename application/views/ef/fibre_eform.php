<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
      <div class="title_left">
        <h3>Plain Page</h3>
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
      <div class="col-md-12 col-sm-12 col-xs-12">
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


            <!-- Smart Wizard -->
            <!-- <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p> -->
            <div id="wizard" class="form_wizard wizard_horizontal">
              <ul class="wizard_steps">
                <li>
                  <a href="#step-1">
                      <span class="step_no">1</span>
                      <!-- <span class="step_descr"> -->
                          <!-- <small>เลือกสถานที่/หมายเลขเคส</small> -->
                      <!-- </span> -->
                  </a>
                </li>

                <li>
                  <a href="#step-2">
                      <span class="step_no">2</span>
                      <!-- <span class="step_descr"> -->
                          <!-- <small>เลือกสถานที่/หมายเลขเคส</small> -->
                      <!-- </span> -->
                  </a>
                </li>

                <li>
                  <a href="#step-3">
                      <span class="step_no">3</span>
                      <!-- <span class="step_descr"> -->
                          <!-- <small>เลือกสถานที่/หมายเลขเคส</small> -->
                      <!-- </span> -->
                  </a>
                </li>

                <li>
                  <a href="#step-4">
                      <span class="step_no">4</span>
                      <!-- <span class="step_descr"> -->
                          <!-- <small>เลือกสถานที่/หมายเลขเคส</small> -->
                      <!-- </span> -->
                  </a>
                </li>             

              </ul>
              
              <div id="step-1">

                <form class="form-horizontal form-label-left">

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">สถานที่</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="select2_group form-control">
                            <option>เลือก</option>
                          <optgroup label="ภาคเหนือ">
                              <option value="1450100400">มหาวิทยาลัยเชียงใหม่</option>
                              <option value="1456102700">มหาวิทยาลัยพะเยา</option>
                              <option value="1454101301">มหายวิทยาลัยแม่โจ้ วิทยาเขตแพร่</option>
                          </optgroup>
                          <optgroup label="ภาคกลาง">
                              <option value="1410100200">มหาวิทยาลัยเกษตรศาสตร์</option>
                              <option value="1410100100">จุฬาลงกรณ์มหาวิทยาลัย</option>
                              <option value="1410101400">มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี</option>
                              <option value="1410100500">มหาวิทยาลัยธรรมศาสตร์ (ท่าพระจันทร์)</option>
                          </optgroup>
                          </select>
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">หมายเลขเคส</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control">
                          <option>เลือก</option>
                          <option value="NT-Fiber-2017-10-0001">NT-Fiber-2017-10-0001</option>
                          <option value="NT-Fiber-2017-10-0100">NT-Fiber-2017-10-0100</option>
                          <option value="NT-Fiber-2017-10-0040">NT-Fiber-2017-10-0040</option>
                          <option value="NT-Fiber-2017-10-0124">NT-Fiber-2017-10-0124</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">ประเภทงาน</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control">
                          <option>เลือก</option>
                          <option value="AM">ตรวจสอบการแก้ไขปรับปรุง/ปรับเปลี่ยน/โยกย้าย (AM)</option>
                          <option value="CM">ตรวจสอบการบำรุงรักษาแบบกะทันหัน (CM)</option>
                          <option value="PM">ตรวจสอบการบำรุงรักษาเชิงป้องกัน (PM)</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">พิกัด:
                      </label>
                      <label class="control-label col-md-3" style="text-align: left">13.651736,100.493667</label>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">เจ้าหน้าที่ประจำหน่วยงาน:
                      </label>
                      <label class="control-label col-md-3" style="text-align: left">คุณเกษม วงศ์แสน</label>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">หมายเลขโทรศัพท์:
                      </label>
                      <label class="control-label col-md-3" style="text-align: left">02-354-5678#5005</label>
                  </div>
                  
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">อีเมล:
                      </label>
                      <label class="control-label col-md-3" style="text-align: left">-</label>
                  </div>

                </form>

              </div>

              <div id="step-2">
                <? $this->load->view('ef/equip_cm1'); ?>
              </div>
              
              <div id="step-3">
                <? $this->load->view('ef/equip_am2'); ?>
              </div>

              <div id="step-4">
                <? $this->load->view('ef/equip_am3'); ?>
              </div>

            </div>
            <!-- End SmartWizard Content -->
          </div>
        </div>
      </div>
    </div>

</div>
<!-- /page content -->