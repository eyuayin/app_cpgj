function cancel_class(v) {
    
      var truthBeTold = window.confirm("确定取消？");
            if (truthBeTold) 
            {
     
                var dv = v;
                var $v = $(dv);
                 
                   var class_id = $v.find("td:eq(6)").text();
                   
                            
                    console.log("in");  
            
               
                //场馆
                  var open_id = $v.find("td:eq(7)").text();
                  
                  var begin_date = $v.find("td:eq(7)").text();
                  
                  var begin_time = $v.find("td:eq(7)").text();
                
                // var begin_time = $v.find("td:eq(7)").text();
                  
                  
                console.log("class_id",class_id);

                
                console.log("open_id",open_id);
                
                $.post("../cancel_booking_weixin_new.php",
                    {
                        openId: open_id,
                    //    day: select_day,
                    //   selectClass: select_class,
                    //    whetherWait: whether_wait,
                        class_id: class_id,
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