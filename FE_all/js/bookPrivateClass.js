function bookConfirm(){
    
     //获取界面值
     var date = $("#date").val();
     var member_name = $("#memeber_name").val();
     var teacher = $("#teacher").val();
     var classroom = $("#classroom").val();
     console.log("classroom is:",classroom);
     var begin = $("#begin").val();
     var end = $("#end").val();
     
     
     $.post("booking_class_private_be.php",
            {          
                date: date,
                member_name: member_name,
                teacher: teacher,
                classroom: classroom,
                begin: begin,
                end: end                
            },
            function (data, status) {
               // console.log("indata",data);
                alert("数据：" + data);
            });
    
    
    
}