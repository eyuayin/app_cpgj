
function insertConfirm(){
    
    //获取界面值
     var date = $("#date").val();
     var teacher = $("#teacher").val();
     var classroom = $("#classroom").val();
     var begin = $("#begin").val();
     var end = $("#end").val();
     
     
    $.post("booking_class_min_be.php",
        {
                date: date,
                teacher: teacher,
                classroom: classroom,
                begin: begin,
                end: end 
        },function(data,status)
        {
            alert(data);
            if (data == "新课程添加成功！")
            {
                //alert(data);
                //console.log("data is:",data);
                $(".modal").attr("data-dismiss",modal);                 
            }
            
        })
}

function addMoreMeb(){
        //var parent1 = document.getElementById("mebname");
        //var child = document.getElementById("addMeb");
        //parent1.removeChild(child);
        
        var form1= document.getElementById("memberNameModel");  
        var div=document.createElement("div");  
        var label=document.createElement("label");                 
        var input=document.createElement("input");                 
        div.appendChild(label);
        div.appendChild(input);
        input.setAttribute("class", "abc"); 
        form1.appendChild(div);
        //var a=document.createElement("a");
        //a.innerHTML = "添加会员";
        //a.id = "addMeb";
        //form1.appendChild(a);  
       // document.getElementById("addMeb").onclick=function(){
        //        addMoreMeb();
         //       console.log("why");
    
}   

//发请求给后台插入预约小班课会员
function insertMebConfirm(){
    //所有 class 为 abc的 input 数量
    var $elements = $('.abc');
    var len = $elements.length;
    var begin =  $("#begin_time").val();
    //var end =  $("#end_time").val();
    //var teacher = $("#teacher_invisible").val();
    //var classroom = $("#classroom_invisible").val();
    var class_id = $("#class_id").val();
    //console.log("class_id is；",class_id);
    
    //每个input post一次
    for(var i=0;i<len;i++){
        var tmp = $("input.abc").eq(i).val();
        console.log("tmp is:",tmp);
         $.post("./new_member_min_be.php",
        {       
                //classroom: classroom,
                begin: begin,  //为了check 会员卡是否过期
                //end: end,
                //teacher: teacher,
                class_id: class_id,
                meb: tmp
        },function(data,status){
            alert(data);
            console.log("data is:",data);
        })
    }
}   
//获取原始表格上的显示值
 function get_booking_info(v){
     
           var dv = v;
		   var $v = $(dv);
		   
            //获取原始表格上的显示值
            // var rowNumber = $("#table tr").index($v.closest("tr"));
           var begin = $v.closest("tr").find("td:eq(1)").text();
           var class_id = $v.closest("tr").find("td:eq(0)").text();
           console.log("class_id is:",class_id);
             //console.log("begin is:",begin);
          // var end = $v.closest("tr").find("td:eq(2)").text();
              //console.log("end is:",end);
          // var teacher = $v.closest("tr").find("td:eq(3)").text();
               //console.log("begin is:",teacher);
          // var classroom = $v.closest("tr").find("td:eq(4)").text();
                //console.log("classroom is:",classroom);
            
            //将原始表格上的值赋给modal框
            $("#begin_time").val(begin);
            $("#class_id").val(class_id);
            //$("#teacher_invisible").val(teacher);
           // $("#classroom_invisible").val(classroom);
            
            
 }


    