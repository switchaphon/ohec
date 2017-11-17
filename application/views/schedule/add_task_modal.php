<!-- modal content -->
    
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
</div>
<div class="modal-body">

<div class="panel panel-default">
  <!-- <div class="panel-heading">Dynamic Form Fields - Add & Remove Multiple fields</div>
  <div class="panel-heading">Education Experience</div> -->
  <div class="panel-body">


  <form role="form" id="addTask" name="addTask" class="form-inline" data-toggle="validator" action="<?=site_url('schedule/add_task_ops');?>" method="POST">
    <div class="form-group col-md-5 col-sm-5 col-xs-12">
    <!-- <div class="col-md-5 col-sm-5 col-xs-12"> -->
        <?  //echo "<pre>"; print_r($site_list); echo "</pre>";
            
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
    <!-- </div> -->
    </div>
    <div class="form-group col-md-4 col-sm-4 col-xs-12">
    <!-- <div class="col-md-4 col-sm-4 col-xs-12"> -->
        <select class="form-control selectpicker show-tick" id="ticketID" name="educatioticketIDnDate[]">
        
            <option value="">Date</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
        </select>
    <!-- </div> -->
    </div>
    <div class="form-group col-md-2 col-sm-2 col-xs-12">
        <!-- <div class="col-md-2 col-sm-2 col-xs-12"> -->
                <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
        <!-- </div> -->
    </div>
    <div class="clear"></div>
    <div id="education_fields"></div>
  </form>
  <div class="clear"></div>
  <div class="panel-footer"><small>กด <span class="glyphicon glyphicon-plus gs"></span> เพื่อเพิ่มแถว</small>, <small>กด <span class="glyphicon glyphicon-minus gs"></span> เพื่อลบแถว</small></div>
</div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div>

<!-- /modal content -->

<script>

    var room = 1;

    function education_fields() {
    
        room++;
        var objTo = document.getElementById('education_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass"+room);
        var rdiv = 'removeclass'+room;
        divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="School name"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"> <select class="form-control" id="educationDate" name="educationDate[]"><option value="">Date</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option> </select><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';
        
        objTo.appendChild(divtest)
    }

    function remove_education_fields(rid) {
        $('.removeclass'+rid).remove();
    }
    // $(document).ready(function(){
    
    // });
</script>