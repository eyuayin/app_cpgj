 $(document).ready(function () {    

    $.post("class_info_for_next_7_days_be.php",
            {
                open_id: "fhrufhrugttklgjkjhl"
            },
            function (data, status) {
                console.log("innnnnn");
                alert("数据：" + data + "\n状态：" + status);
                 console.log("data------->",data);
               // var result = JSON.parse(data);
                //console.log("result--------------->", result);
                //$('#select_class').empty();
                //result.forEach(function (e) {
                    //console.log("in---------------------->");
                  //  $('#select_class').append("<option >" + e + "</option>");
                //});

                //success:function(data){
                //    $.each( data,function(){
                //        $('#select').append("<option value='"+ this.id+"'>"+ this.name +"</option>");
                //    });
                //}
            });
 })