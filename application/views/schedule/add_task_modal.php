<!-- modal content -->
<form role="form" id="addTask" name="addTask" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('schedule/add_task_ops');?>" method="POST">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">เพิ่มงานตรวจ</h4>
    </div>
    <div class="modal-body">

        <div class="panel panel-default text-center">
        <!-- <div class="panel-heading">Dynamic Form Fields - Add & Remove Multiple fields</div> -->
            <div class="panel-body">
                <!-- <div class="form-group col-lg-2 col-md-2 col-sm-1 col-xs-1"></div> -->
                <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ชื่อหน่วยงาน<span class="required">*</span></label>
                                
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <?  
                        $str = $opt = null;

                        if( !empty($site_list) ){
                        echo "<select id=\"site\" name=\"site[]\" class=\"form-control selectpicker show-tick\" title=\"เลือกได้มากกว่าหนึ่งหน่วยงาน \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                        foreach($site_list as $provice => $site):
                            echo '<optgroup label="'.$provice.'">';
                            for($i = 0; $i < count($site); $i++){
                                echo '<option value="'.$site[$i]['site_id'].'">'.$site[$i]['site_name'].'</option>';
                            }
                            echo '</optgroup>';
                        endforeach;
                        echo "</select>";
                        }else{
                            echo "<select id=\"site\" name=\"site[]\" class=\"form-control selectpicker show-tick\" title=\"ไม่มีข้อมูล \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                            echo "</select>";                            
                        }
                    ?>
                </div>
                </div>
       
                <div class="form-group">
                    
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ประเภทงานตรวจ<span class="required">*</span></label>
                
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <?  
                    $str = $opt = null;

                    if( !empty($form_list) ){
                        
                        echo "<select id=\"task\" name=\"task[]\" class=\"form-control selectpicker show-tick\" title=\"เลือกได้มากกว่าหนึ่งประเภท \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" multiple required>";
                        foreach($form_list as $asset_type => $ma_type):
                            echo '<optgroup label="งานตรวจ '.$asset_type.'">';
                            for($i = 0; $i < count($ma_type); $i++){
                                echo '<option value="'.$ma_type[$i]['form_id'].'">'.$asset_type." - ".$ma_type[$i]['ma_name_en'].'</option>';
                            }
                            echo '</optgroup>';
                        endforeach;
                        echo "</select>";
                    }
                ?>
            </div>
            </div>


                <div class="clear"></div>

                <!-- <div id="task_fields"></div> -->

                <!-- <input type="hidden" id="ticket_start_date" name="ticket_start_date" value="<?=$ticket_start_date;?>" /> -->
                <!-- <input type="hidden" id="ticket_end_date" name="ticket_end_date" value="<?=$ticket_end_date;?>" /> -->
                <input type="hidden" id="schedule" name="schedule" value="<?=$schedule[0]['schedule_id'];?>" />
            
                <div class="clear"></div>
                <BR>
                <!-- <div class="panel-footer"><small>กด <span class="glyphicon glyphicon-plus gs"></span> เพื่อเพิ่มแถว</small>, <small>กด <span class="glyphicon glyphicon-minus gs"></span> เพื่อลบแถว</small></div> -->
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        <button id="send" type="submit" class="btn btn-success">บันทึก</button>
    </div>
</form>
<!-- /modal content -->

<script>

    // var row = 1;

    // function add_task_fields() {
    //     row++;
    //     var objTo = document.getElementById('task_fields')
    //     var divtest = document.createElement("div");
    //     divtest.setAttribute("class", "removeclass"+row);
    //     var rdiv = 'removeclass'+row;

    //     var site = document.getElementById( 'site' ).cloneNode( true );
    //     document.getElementById( 'addTask' ).appendChild( site );
    //         divtest.innerHTML = ' <div class="form-group col-md-1 col-md-1 col-md-12"></div><div class="form-group col-md-5 col-md-5 col-md-12"></div><div class="form-group col-md-4 col-md-4 col-md-12"> <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="School name"></div><div class="form-group col-md-2 col-md-2 col-md-12"><button class="btn btn-danger" type="button" onclick="remove_task_fields('+ row +');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></div></div><div class="clear"></div>';
    //     objTo.appendChild(divtest)

    //     $('#site').selectpicker('refresh');
    //     // console.log(site);
    // }

    // function remove_task_fields(rid) {
    //     $('.removeclass'+rid).remove();
    // }

    $(document).ready(function(){
        //Once site changed, re-query ticket
        // $('#site').change(function(){
        //     // alert($('#schedule').val());
        //     $("#ticket").html('');
        
        //     $.ajax({
        //         type: "POST",
        //         dataType: 'json',
        //         url: "<?=site_url('/Ticket/list_ticket_by_site');?>",
        //         data: "site="+ $('#site').val()+"&schedule_id="+$('#schedule').val()+"&ticket_start_date="+$('#ticket_start_date').val()+"&ticket_end_date="+$('#ticket_end_date').val(),
        //         success: function(result)
        //         {
        //             // console.log(result);
        //             $.each(result,function(index,val){
        //                 var str = '';
        //                 var opt = '';
        //                 for(i = 0; i<val.length; i++) {
        //                     opt += '<option value="'+val[i]['case_id']+'">['+val[i]['contract']+'] '+val[i]['case_id']+'</option>';                       
        //                 }

        //                 str += '<optgroup label="'+index+'">'+opt+'</optgroup>';

        //                 $("#ticket").append(str);
        //             });//end each
        //             $('#ticket').selectpicker('refresh');
        //         },
        //         error: function (xhr, ajaxOptions, thrownError) {
        //             console.log(xhr.status);
        //             console.log(thrownError);
        //         }
        //     });

        // });
    });
</script>