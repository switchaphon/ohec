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

                        <form class="form-horizontal form-label-left" novalidate="">

                        <!-- <span class="section"><small>ข้อมูลตารางตรวจงาน</small></span> -->

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Schdule <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <div class="control-group">
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                        <input type="text" name="schedule-time" id="schedule-time" class="form-control" value="01/01/2016 - 01/25/2016" />
                                        </div>
                                    </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Detail <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="textarea" required="required" name="textarea" class="form-control col-md-7 col-xs-12"></textarea>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Region <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?
                                    echo "<select name=\"region\" id=\"region\" class=\"form-control selectpicker show-tick\" title=\"select \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                                    foreach($region as $reg_key => $reg_val):
                                        echo "<option value=\"".$reg_key."\">".$reg_val."</option>\"";
                                    endforeach;
                                    echo "</select>";
                                ?>                      
                            </div>
                        </div>                        

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Province <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <!-- <select class="selectpicker form-control" data-live-search="true" multiple title="กรุณาเลือกจังหวัดที่ต้องการลงตรวจ (เลือกได้มากกว่าหนึ่ง)">
                            <optgroup label="Picnic">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </optgroup>
                            <optgroup label="Camping">
                                <option>Tent</option>
                                <option>Flashlight</option>
                                <option>Toilet Paper</option>
                            </optgroup>
                            </select> -->
                            <?
                                echo "<select name=\"province\" id=\"province\" class=\"form-control selectpicker show-tick\" title=\"select \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                                // foreach($region as $reg_key => $reg_val):
                                //     echo "<option value=\"".$reg_key."\">".$reg_val."</option>\"";
                                // endforeach;
                                echo "</select>";
                            ?>        
                        </div>
                    </div>        

                        <? //echo "<pre>"; print_r($province); echo "</pre>"; ?>


                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
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

<!-- script content -->


    



<script type="text/javascript">

    $('input[name="schedule-time"]').daterangepicker();
    $('input[name="ticket-time"]').daterangepicker();

    $(document).ready(function(){
        //Once region changed, re-query province
        $('#region').change(function(){
            $("#province").html('');
            
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?=site_url('/Site/get_province_by_region');?>",
                data: "region="+ $('#region').val(),
                success: function(province)
                {
                    console.log(province);
                    // var i=0;
                    // $.each(serviceType,function(index,name)
                    // {
                    //     $("#mrtgServType").append('<option value='+serviceType[''+i+'']['serviceType_value']+'>'+serviceType[''+i+'']['serviceType_name']+'</option>');
                    // i=i+1;
                    // });//end each
                    // $('#mrtgServType').selectpicker('refresh');
                }
            });
        });
    });

</script>
<!-- /script content -->