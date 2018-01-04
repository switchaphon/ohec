<!-- page content -->
<article>
    <div class="right_col" role="main">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>สร้างตารางตรวจงาน<small></small></h2>
                        <!-- <ul class="nav navbar-right panel_toolbox" style="padding-left: 50px;">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul> -->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form role="form" id="createSchedule" name="createSchedule" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('schedule/create_ops');?>" method="POST">

                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="project">ตารางตรวจงาน <span class="required">*</span></label>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                    <?
                                        echo "<select name=\"project\" id=\"project\" class=\"form-control selectpicker show-tick\" title=\"โครงการ\" \"data-live-search=\"false\" data-size=\"10\" data-width=\"css-width\" required>";
                                        foreach($project as $pro_key => $pro_val):
                                            echo "<option value=\"".$pro_val['project']."\">".$pro_val['project']."</option>\"";
                                        endforeach;
                                        echo "</select>";
                                    ?>    
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <?
                                        echo "<select name=\"period\" id=\"period\" class=\"form-control selectpicker show-tick\" title=\"งวดงาน\" \"data-live-search=\"false\" data-size=\"10\" data-width=\"css-width\" required></select>";
                                    ?>    
                                </div>
                                
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <?
                                        echo "<select name=\"year\" id=\"year\" class=\"form-control selectpicker show-tick\" title=\"ปีสัญญา\" \"data-live-search=\"false\" data-size=\"10\" data-width=\"css-width\" required>";
                                        foreach($year as $year_key => $year_val):
                                            if($year_key == $this_year){ $selected = 'selected'; }else{ $selected = NULL; }
                                            echo "<option value=\"".$year_key."\"".$selected.">".$year_key."</option>\"";
                                        endforeach;
                                        echo "</select>";
                                    ?>    
                                </div>                                
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="schedule-time">วันที่ออกตรวจ <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
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
                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="ticket-time">ระยะเวลาของ Ticket <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
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
                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="region">พื้นที่ <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?
                                        echo "<select name=\"region[]\" id=\"region\" class=\"form-control selectpicker show-tick\" title=\"เลือกได้มากกว่าหนึ่งพื้นที่ \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                                        foreach($region as $reg_key => $reg_val):
                                            echo "<option value=\"".$reg_key."\">".$reg_val."</option>\"";
                                        endforeach;
                                        echo "</select>";
                                    ?>                      
                                </div>
                            </div>                        

                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="province">จังหวัด <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?
                                        echo "<select name=\"province[]\" id=\"province\" class=\"form-control selectpicker show-tick\" title=\"เลือกได้มากกว่าหนึ่งจังหวัด \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required></select>";
                                    ?>        
                                </div>
                            </div>        
                            
                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="description">รายละเอียด </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="description"  name="description" class="form-control col-md-7 col-xs-12" ></textarea>
                                </div>
                            </div>

                            <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12 text-center">
                                    <button type="submit" class="btn btn-round btn-default">ยกเลิก</button>
                                    <button id="submit" type="submit" class="btn btn-round btn-primary">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</artical>
<!-- /page content -->

<!-- page script -->
<script type="text/javascript">

    $('input[name="schedule-time"]').daterangepicker({
        timePicker: false,
        locale: {
            format: 'YYYY-MM-DD'
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    });

    $('input[name="ticket-time"]').daterangepicker({
        timePicker: false,
        locale: {
            format: 'YYYY-MM-DD'
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    });

    $(document).ready(function(){
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
                            opt += '<option value="'+province[i]+'">'+province[i]+'</option>';                       
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

    });

</script>
<!-- /page script -->