<!-- modal content -->
<form role="form" id="addEformNote" name="addEformNote" class="form" data-toggle="validator" action="<?=site_url('eform/add_note_ops');?>" method="POST">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">เพิ่มบันทึกข้อความ</h4>
    </div>
    <div class="modal-body">

        <div class="panel panel-default text-center">
        <!-- <div class="panel-heading">Dynamic Form Fields - Add & Remove Multiple fields</div> -->
            <div class="panel-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <textarea id="note" name="note" class="form-control" placeholder="ข้อความ..." required></textarea>
                </div>
                <input type="hidden" id="eform_id" name="eform_id" value="<?=$eform[0]['eform_id']?>" />      
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

</script>