function cancel_class(v) {
    
      var truthBeTold = window.confirm("确定取消？");
            if (truthBeTold) 
            {
     
                var dv = v;
                var $v = $(dv);
                 
                   var class_id = $v.find("td:eq(6)").text();
                   
                   console.log("class_id is",class_id)       
                    console.log("in");  
            
               
                //场馆
                  var open_id = $v.find("td:eq(8)").text();
                  console.log("open_id is",open_id)       
                  
                //  var begin_date = $v.find("td:eq()").text();
                  
                  var begin_time = $v.find("td:eq(2)").text();
                  console.log("begin_time is",begin_time)       
                  
                  var card_id = $v.find("td:eq(7)").text();
                  console.log("card_id is",card_id)       
                
                // var begin_time = $v.find("td:eq(7)").text();
                  
                  
                $.post("../cancel_booking_weixin_new.php",
                    {
                        open_id: open_id,
                        card_id: card_id,
                        begin_time:begin_time,
                        class_id: class_id
                    //    day: select_day,
                    //   selectClass: select_class,
                    //    whetherWait: whether_wait,
                       
                    //    select_location: location
                   //     classroom: class_room
                    },
                    function (data, status) {
                        alert("数据：" + data);

                    });
                    
            }   

            else
            {
                return;
            }                
    };