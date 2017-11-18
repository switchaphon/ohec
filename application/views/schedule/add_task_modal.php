<!-- modal content -->
<form role="form" id="addTask" name="addTask" class="form-inline" data-toggle="validator" action="<?=site_url('schedule/add_task_ops');?>" method="POST">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
    </div>
    <div class="modal-body">

        <div class="panel panel-default">
        <!-- <div class="panel-heading">Dynamic Form Fields - Add & Remove Multiple fields</div> -->
            <div class="panel-body">
        

                    <div class="form-group col-md-5 col-sm-5 col-xs-12">
                        <?  //print_r($site_list);
                            $str = $opt = null;

                            echo "<select id=\"site\" name=\"site[]\" class=\"form-control selectpicker show-tick\" title=\"select \"data-live-search=\"true\" data-size=\"10\" data-width=\"css-width\" required>";
                            foreach($site_list as $provice => $site):
                                echo '<optgroup label="'.$provice.'">';
                                for($i = 0; $i < count($site); $i++){
                                    echo '<option value="'.$site[$i]['site_id'].'">'.$site[$i]['site_name'].'</option>';
                                }
                                echo '</optgroup>';
                            endforeach;
                            echo "</select>";
                    
                        ?>
                    </div>

                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <select id="ticket" name="ticket[]" class="form-control selectpicker show-tick" title="select" data-live-search="true" data-size="10" data-width="css-width" required></select>
                    </div>

                    <div class="form-group col-md-2 col-sm-2 col-xs-12">
                        <button class="btn btn-success" type="button"  onclick="add_task_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                    </div>

                    <div class="clear"></div>

                    <div id="task_fields"></div>

                    <input type="hidden" id="schedule_id" name="schedule_id" value="<?=$schedule[0]['schedule_id'];?>" />
                    <input type="hidden" id="ticket_start_date" name="ticket_start_date" value="<?=$ticket_start_date;?>" />
                    <input type="hidden" id="ticket_end_date" name="ticket_end_date" value="<?=$ticket_end_date;?>" />
                
                    <div class="clear"></div>
                
                    <div class="panel-footer"><small>กด <span class="glyphicon glyphicon-plus gs"></span> เพื่อเพิ่มแถว</small>, <small>กด <span class="glyphicon glyphicon-minus gs"></span> เพื่อลบแถว</small></div>
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

    var row = 1;

    function add_task_fields() {
        row++;
        var objTo = document.getElementById('task_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "removeclass"+row);
        var rdiv = 'removeclass'+row;

        var site = document.getElementById( 'site' ).cloneNode( true );
        document.getElementById( 'addTask' ).appendChild( site );
        // divtest.innerHTML = ' <div class="form-group col-md-5 col-sm-5 col-xs-12"><select id="site" name="site[]" class="form-control show-tick" title="select "data-live-search="true" data-size="10" data-width="css-width" required ><option value="">Date</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option></select></div><div class="form-group col-md-4 col-sm-4 col-xs-12"> <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="School name"></div><div class="form-group col-md-2 col-sm-2 col-xs-12"><button class="btn btn-danger" type="button" onclick="remove_task_fields('+ row +');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></div></div><div class="clear"></div>';
        divtest.innerHTML = ' <div class="form-group col-md-5 col-sm-5 col-xs-12"></div><div class="form-group col-md-4 col-sm-4 col-xs-12"> <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="School name"></div><div class="form-group col-md-2 col-sm-2 col-xs-12"><button class="btn btn-danger" type="button" onclick="remove_task_fields('+ row +');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></div></div><div class="clear"></div>';
        
        objTo.appendChild(divtest)

        $('#site').selectpicker('refresh');
        // console.log(site);
    }

    function remove_task_fields(rid) {
        $('.removeclass'+rid).remove();
    }

    $(document).ready(function(){
        //Once site changed, re-query ticket
        $('#site').change(function(){
            $("#ticket").html('');
        
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?=site_url('/Ticket/list_ticket_by_site');?>",
                data: "site="+ $('#site').val()+"&ticket_start_date="+$('#ticket_start_date').val()+"&ticket_end_date="+$('#ticket_end_date').val(),
                success: function(result)
                {
                    $.each(result,function(index,val){
                        var str = '';
                        var opt = '';
                        for(i = 0; i<val.length; i++) {
                            opt += '<option value="'+val[i]['case_id']+'"> ['+val[i]['contract']+'] '+val[i]['case_id']+'</option>';                       
                        }

                        str += '<optgroup label="'+index+'">'+opt+'</optgroup>';

                        $("#ticket").append(str);
                    });//end each
                    $('#ticket').selectpicker('refresh');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });

        });
    });
</script>