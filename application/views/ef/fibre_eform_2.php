
<!-- page content -->
<div id="surveyContainer"></div>

<!-- /page content -->
<script>


Survey.Survey.cssType = "bootstrap";

var surveyJSON = {pages:[{elements:[{type:"matrix",columns:[{value:"Column 1",text:"เรียบร้อย"},{value:"Column 2",text:"ไม่เรียบร้อย"}],isRequired:true,name:"section01",rows:[{value:"question1",text:"ความเรียบร้อยและความสะอาดในการดำเนินงาน"},{value:"question2",text:"วัสดุอุปกรณ์ที่ใช้ในการซ่อมแซมเป็นไปตามข้อกำหนด"},{value:"question3",text:"การแก้ไขปรับปรุง/ปรับเปลี่ยน/โยกย้าย ไปตามความเหมาะสม"},{value:"question4",text:"การติดตั้ง Closure"},{value:"question5",text:"การติดตั้ง FDF (ถ้ามี)"}],title:"การตรวจสถานที่ดำเนินการแก้ไขปรับปรุง/ปรับเปลี่ยน/โยกย้าย"},{type:"matrix",columns:[{value:"Column 1",text:"เรียบร้อย"},{value:"Column 2",text:"ไม่เรียบร้อย"}],name:"question4",rows:[{value:"Row 1",text:"เจ้าหน้าที่เข้าใจถึงขั้นตอนการทำงานและคุณภาพของการให้บริการ"},{value:"Row 2",text:"เจ้าหน้าที่แต่งกายเรียบร้อย (บัตรประจำตัว/ชุดยูนิฟอร์ม)"}],title:"เจ้าหน้าที่และบุคคลากร"},{type:"panel",elements:[{type:"panel",elements:[{type:"matrix",columns:[{value:"Column 1",text:"เรียบร้อย"},{value:"Column 2",text:"ไม่เรียบร้อย"}],name:"question2",rows:[{value:"Row 1",text:"ภาพถ่าย"},{value:"Row 2",text:"พิกัด"}],title:"ภาพถ่ายก่อนปฏิบัติงาน และพิกัด"},{type:"file",name:"question3",title:"ภาพถ่ายก่อนปฏิบัติงาน"}],name:"panel1",title:"ก่อนปฏิบัติงาน"},{type:"panel",elements:[{type:"matrix",columns:[{value:"Column 1",text:"เรียบร้อย"},{value:"Column 2",text:"ไม่เรียบร้อย"}],name:"question1",rows:[{value:"Row 1",text:"ภาพถ่าย"},{value:"Row 2",text:"พิกัด"}],title:"ภาพถ่ายหลังปฏิบัติงาน และพิกัด"}],name:"panel2",title:"หลักปฏิบัติงาน"},{type:"file",name:"question7",title:"ภาพถ่ายหลังปฏิบัติงาน"}],name:"section2",title:"เอกสารรายงานการดำเนินการแก้ไขปรับปรุง/ปรับเปลี่ยน/โยกย้าย"}],name:"page1"}]}

function sendDataToServer(survey) {
    //send Ajax request to your web server.
    alert("The results are:" + JSON.stringify(s.data));
}

var survey = new Survey.Model(surveyJSON);
$("#surveyContainer").Survey({
    model: survey,
    onComplete: sendDataToServer
});
</script>