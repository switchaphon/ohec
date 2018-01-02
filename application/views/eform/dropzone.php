<!-- page content -->
<article>
    <div class="right_col" role="main">
        
        <div class="page-title">
            <div class="title_left"> <h3></h3></div>
        </div>

        <div class="clearfix"></div>

        <form role="form" id="createEform" name="createEform" class="form-horizontal form-label-left" data-toggle="validator" action="<?=site_url('eform/create_ops');?>" enctype="multipart/form-data" method="post">
           
        <div class="dropzone" id="my-awesome-dropzone">	
            <div class="fallback">
                <input name="file" type="file" multiple class="form-control file" />
            </div>
        </div>
        </form>        
    
    </div>
</artical>
<!-- /page content -->

<!-- Modal -->
  <!-- loadingModal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="waiting_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <? $this->load->view('loading_modal'); ?>
      </div>
    </div>
  </div>
  <!-- /loadingModal -->
<!-- /Modal -->

<!-- page script -->
<script type="text/javascript">
    // Dropzone.options.myAwesomeDropzone = false;
    // Dropzone.autoDiscover = false;
    var myDropzone = {};
	Dropzone.options.myAwesomeDropzone = {
        // autoDiscover:false,
		url : 'xxxxxx',
		paramName : "fileOther", // ชื่อไฟล์ปลายทางเมื่อ upload แบบ mutiple จะเป็น array
		autoProcessQueue : false,// ใส่เพื่อไม่ให้อัพโหลดทันที หลังจากเลือกไฟล์
		uploadMultiple : true, // อัพโหลดไฟล์หลายไฟล์
		parallelUploads : 1, // ให้ทำงานพร้อมกัน 10 ไฟล์
		maxFiles : 2, // ไฟล์สูงสุด 5 ไฟล์
		addRemoveLinks : true, // อนุญาตให้ลบไฟล์ก่อนการอัพโหลด
		// maxFilesize: 2, // MB
		previewsContainer : ".dropzone", // ระบุ element เป้าหลาย
		dictRemoveFile : "ลบ", // ชื่อ ปุ่ม remove
		dictCancelUpload : "Cancel", // ชื่อ ปุ่ม ยกเลิก
		dictDefaultMessage : "เลือกรูปภาพ", // ข้อความบนพื้นที่แสดงรูปจะแสดงหลังจากโหลดเพจเสร็จ
		dictFileTooBig : "ไม่อนุญาตให้อัพโหลดไฟล์เกิน 2 MB", //ข้อความแสดงเมื่อเลือกไฟล์ขนาดเกินที่กำหนด		
		acceptedFiles : "image/*", // อนุญาตให้เลือกไฟล์ประเภทรูปภาพได้
        resizeWidth : "500px"

		// The setting up of the dropzone
		// init : function() {
		// 	myDropzone = this;
		// 	this.on("addedfile", function(file) {
				
		// 	}).on("removedfile", function(file) {
				
		// 	}).on("thumbnail", function(file) {
				
		// 	}).on("error", function(file) {
				
		// 	}).on("processing", function(file) {
				
		// 	}).on("uploadprogress", function(file) {
				
		// 	});
		// }
	}
    $(document).ready(function(){
        $('#tbEformTicket').DataTable({
            "pageLength": 5,
            "paging":   false,
            "ordering": false,
            "info":     false,
            searching: false, 
            "dom": '<"toolbartbEformTicket">frtip'
        });
    
        $('.collapsed').css('height', 'auto');
        $('.collapsed').find('.x_content').css('display', 'none');
        $('.collapsed').find('a .collapse-link').toggleClass('fa-chevron-up fa-chevron-down');

        // $("input[type=file]").fileinput({
        //     showUpload: false
        //     ,msgPlaceholder: '\'jpg\',\'jpeg\', \'gif\', \'png\' มากสุด 6 ภาพ'
        //     ,browseLabel: 'แนบภาพ'
        //     ,removeLabel: 'ลบ'
        //     ,removeTitle: 'ล้างช่องแนบภาพ'
        //     ,allowedFileExtensions: ['jpg','jpeg', 'gif', 'png']
        //     ,maxFileCount: 6
        //     ,autoOrientImage: false
        //     // ,previewSettings: {
        //     //     image: {width: "50%", height: "auto", 'max-width': "100%", 'max-height': "100%"},
        //     //     other: {width: "213px", height: "160px"}
        //     // }
        //     // ,previewSettingsSmall: {
        //     //     image: {width: "auto", height: "auto", 'max-width': "100%", 'max-height': "100%"},
        //     //     other: {width: "100%", height: "160px"}
        //     // }
        //     // ,resizeImage: true
        //     // ,maxImageWidth: 200
        //     // ,maxImageHeight: 200
        //     // ,resizePreference: 'width'
        // })

        $("form").on('submit', function(){
        $('#waiting_modal').modal({
            backdrop: 'static',
            keyboard: false
        })
      })

    });

    $(function(){
//   Dropzone.options.myAwesomeDropzone = {
//     maxFilesize: 5,
//     addRemoveLinks: true,
//     dictResponseError: 'Server not Configured',
//     acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
//     init:function(){
//       var self = this;
//       // config
//       self.options.addRemoveLinks = true;
//       self.options.dictRemoveFile = "Delete";
//       //New file added
//       self.on("addedfile", function (file) {
//         console.log('new file added ', file);
//       });
//       // Send file starts
//       self.on("sending", function (file) {
//         console.log('upload started', file);
//         $('.meter').show();
//       });
      
//       // File upload Progress
//       self.on("totaluploadprogress", function (progress) {
//         console.log("progress ", progress);
//         $('.roller').width(progress + '%');
//       });

//       self.on("queuecomplete", function (progress) {
//         $('.meter').delay(999).slideUp(999);
//       });
      
//       // On removing file
//       self.on("removedfile", function (file) {
//         console.log(file);
//       });
//     }
//   };

})
    
</script>        