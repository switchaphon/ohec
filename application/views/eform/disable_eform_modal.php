<!-- modal content -->
<form role="form" id="joinSchedule" name="joinSchedule" class="form-inline" data-toggle="validator" action="<?=site_url('eform/disable_eform_ops');?>" method="POST">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
    </div>
    <div class="modal-body">

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="message"></div>
                <input type="hidden" name="eform_id" id="eform_id" value="" />
                <input type="hidden" name="schedule_id" id="schedule_id" value="" />
                <input type="hidden" name="called_page" id="called_page" value="" />
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">ยกเลิก</button>
        <button id="send" type="submit" class="btn btn-round btn-primary">ยืนยัน</button>
    </div>
</form>
<!-- /modal content -->