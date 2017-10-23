<!-- <h4>รายการอุปกรณ์</h4> -->
<!-- <p class="font-gray-dark">
    For making labels vertical you have two options, either use the apropiate grid <b>.col-</b> class or wrap the form in the <b>form-vertical</b> class.
</p> -->
<!-- <span class="section">รายการอุปกรณ์</span> -->
<div class="row">
    <div class="col-md-1 col-sm-1 col-xs-12 "></div>
    <div class="col-md-9 col-sm-9 col-xs-12 "><span class="section">รายการอุปกรณ์</span></div>    
</div>

<form class="form-horizontal form-label-left input_mask">
    <div class="col-md-2 col-sm-2 col-xs-12 form-group"></div>
    <div class="col-md-1 col-sm-1 col-xs-12 form-group">
            <select class="form-control">
                <option>ประเภท</option>
                <option>Router</option>
                <option>Switch</option>
                <option>DWDM</option>
                <option>Server</option>
                <option>UPS</option>
                <option>อื่น ๆ</option>
            </select>
    </div>   

    <div class="col-md-1 col-sm-1 col-xs-12 form-group"> 
        <select class="form-control">
            <option>ยี่ห้อ</option>
            <option>Cisco</option>
            <option>Huawei</option>
            <option>Dell</option>
            <option>IBM</option>
            <option>APC</option>
        </select>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-12 form-group">    
        <input type="text" class="form-control" id="inputSuccess5" placeholder="รุ่น">
    </div>

    <div class="col-md-3 col-sm-3 col-xs-12 form-group">    
        <input type="text" class="form-control" id="inputSuccess5" placeholder="หมายเลขประจำเครื่อง">  
    </div>

    <div class="col-md-1 col-sm-1 col-xs-12 form-group">    
        <button type="button" class="btn btn-round btn-info btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
    </div> 
</form>