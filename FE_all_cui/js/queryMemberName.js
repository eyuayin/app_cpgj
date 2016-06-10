$(function(){
               console.log("ddddddddddddddddddd");
               //关闭异步
                $.ajaxSetup (
                {
                    async: false
                });
              
                var availableTags = new Array();//定义一个函数内的数组，用于存放姓名
                
                //请求后台数据
                $.post("../queryMemberNameBankend.php",
                function(data,status)
                {
                      console.log("data is:",data);
                      data = JSON.parse(data);
                        //将数组对象转换成数组
                        var i = 0; 
                        for(i=0;i<data.length;i++)
                        {
                          
                          availableTags.push(data[i]);
                        }      
                });       
                 
                //console.log("availableTags outside is:",availableTags);
                $( "#name" ).autocomplete(
                    {
                      source: availableTags
                    });
          

});
 