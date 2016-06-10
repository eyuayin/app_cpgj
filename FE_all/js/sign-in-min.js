$(".sign_in_checked").click(function(){
        var classID = $(this).parent().parent().children("td:eq(0)").text();
        var cardNo = $(this).parent().parent().children("td:eq(3)").text();
        //console.log("classId",classID);
        //console.log("cardNo",cardNo);
        var whetherChecked = $(this).prop('checked');
        console.log("whetherchecked",whetherChecked);              
  
         $.post("sign_in_backend_min.php",
            {   
                class_id: classID,
                card_No: cardNo,              
                whether_checked: whetherChecked
            },
            function (data, status) {
                console.log("indata",data);
                alert(data);
            });
    
})
