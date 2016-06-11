 function book_class(v) {
     
        var dv = v;
	    var $v = $(dv);
         
           var class_id = $v.find("td:eq(4)").text();
                    
            console.log("in");  
    
       
        //³¡¹Ý
          var location = $v.find("td:eq(5)").text();
        
          var open_id = $("#openid_input").val();
       
        console.log("class_id",class_id);

        console.log("location",location);
        
        console.log("open_id",open_id);
        
        $.post("../book_class_weinxin.php",
            {
                openId: open_id,
            //    day: select_day,
             //   selectClass: select_class,
            //    whetherWait: whether_wait,
                class_id: class_id,
                select_location: location
           //     classroom: class_room
            },
            function (data, status) {
                alert("Êý¾Ý£º" + data);

            });
            
           
    };