<!-- page content -->
<article>
    <div class="right_col" role="main">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Create<small></small></h2>
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
                        <form role="form" id="createSchedule" name="createSchedule" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('schedule/create_ops');?>" method="POST">
                            <!-- <span class="section"><small>ข้อมูลตารางตรวจงาน</small></span> -->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">ชื่อ <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="name"  name="name" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">รายละเอียด <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="description"  name="description" class="form-control col-md-7 col-xs-12" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">กำหนดการ <span class="required">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ticket <span class="required">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">พื้นที่ <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?
                                        echo "<select name=\"region[]\" id=\"region\" class=\"form-control selectpicker show-tick\" title=\"select \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                                        foreach($region as $reg_key => $reg_val):
                                            echo "<option value=\"".$reg_key."\">".$reg_val."</option>\"";
                                        endforeach;
                                        echo "</select>";
                                    ?>                      
                                </div>
                            </div>                        

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">จังหวัด <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?
                                        echo "<select name=\"province[]\" id=\"province\" class=\"form-control selectpicker show-tick\" title=\"select \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required></select>";
                                    ?>        
                                </div>
                            </div>        

                            <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-md-9 text-right">
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
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