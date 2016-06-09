function showTip(tipTxt) {
    var div = document.createElement('div');
    div.innerHTML = '<div class="deploy_ctype_tip"><p>' + tipTxt + '</p></div>';
    var tipNode = div.firstChild;
    $("#wrap").after(tipNode);
    setTimeout(function () {
        $(tipNode).remove();
    }, 1500);
}

function tgSumbit(){
        var bookexpert=$("#select_class").val();
        if($.trim(bookexpert) == ""){
            showTip('请输入预约课程！');
            return false;

        }

    return true;

}

//用户点提交后执行的请求
    function send_info() {
    //判断输入是否为空
     var whether_go_back =   tgSumbit();
        if(!whether_go_back){
           return;
        }
    //用户输入值的获取

        var open_id = $("#openid_input").val();
        var select_class = $("#select_class").val();
        var class_id = select_class.substr(-3,3);
        var whether_wait = $("#whetherWait").val();
        var select_day =$("#select_day").val();
        //场馆
        var location =$("#location").val();
        //教室
        var class_room =$("#classroom").val();
        console.log("openid",open_id);
        console.log("class",select_class);
        console.log("day",select_day);
        console.log("classroom",class_room);

        console.log("location",location);
        $.post("../book_class_weinxin.php",
            {
                openId: open_id,
            //    day: select_day,
             //   selectClass: select_class,
                whetherWait: whether_wait,
                class_id: class_id,
                select_location: location
           //     classroom: class_room
            },
            function (data, status) {
                alert("数据：" + data);

            });
    };

    //用户选择日期变化后执行的请求
    function check_class_change() {
        //获取用户选择的日期
         var select_day =$("#select_day").val();
		 var location = $("#location").val();
		 
		 console.log("location is:",location);

        $.post("../search_db_class_info.php",
            {
                day: select_day,
				location: location
            },
            function (data, status) {
                alert("数据：" + data + "\n状态：" + status);
                // console.log("data------->",data);
                var result = JSON.parse(data);
                //console.log("result--------------->", result);
                $('#select_class').empty();
                result.forEach(function (e) {
                    //console.log("in---------------------->");
                    $('#select_class').append("<option >" + e + "</option>");
                });

                //success:function(data){
                //    $.each( data,function(){
                //        $('#select').append("<option value='"+ this.id+"'>"+ this.name +"</option>");
                //    });
                //}
            });
		/*	
	    $.post("../search_db_class_info_cui.php",
            {
                day: select_day,
				location: location
            },
            function (data, status) {
                alert("数据cui：" + data + "\n状态：" + status);
                // console.log("data------->",data);
                var result = JSON.parse(data);
                //console.log("result--------------->", result);
                $('#select_class').empty();
                result.forEach(function (e) {
                    //console.log("in---------------------->");
                    $('#select_class').append("<option >" + e + "</option>");
                });

                //success:function(data){
                //    $.each( data,function(){
                //        $('#select').append("<option value='"+ this.id+"'>"+ this.name +"</option>");
                //    });
                //}
            });
			
			*/
			
    }

    //  页面加载好后执行的请求
    $(document).ready(function () {
        console.log("____>in document ready");
        //获取近三天时间
        function GetDateStr(AddDayCount) {

            var dd = new Date();

            dd.setDate(dd.getDate() + AddDayCount);//获取AddDayCount天后的日期

            var y = dd.getFullYear();

            var m = dd.getMonth() + 1;//获取当前月份的日期

            var d = dd.getDate();

            return y + "-" + m + "-" + d;
        }
		
		console.log("today date is:",GetDateStr(0));

        //时间选项
        $("#select_day").prepend("<option>" + GetDateStr(0) + "</option>");//今天日期
        $("#select_day").append("<option>" + GetDateStr(1) + "</option>"); //明天日期
        $("#select_day").append("<option>" + GetDateStr(2) + "</option>"); //后天日期
        $("#select_day").append("<option>" + GetDateStr(3) + "</option>"); //大后天日期

        //获取用户选择的日期
        var select_day =$("#select_day").val();
        console.log("select_day",select_day);
        //给服务器发请求并处理json文件
        $.post("../search_db_class_info.php",
            {
                day: select_day
            },
            function (data, status) {
                //alert("数据：" + data + "\n状态：" + status);
                // console.log("data------->",data);
                var result = JSON.parse(data);
                //console.log("result--------------->", result);
                result.forEach(function (e) {
                    //  console.log("in---------------------->");
                    $('#select_class').append("<option >" + e + "</option>");
                });

                //success:function(data){
                //    $.each( data,function(){
                //        $('#select').append("<option value='"+ this.id+"'>"+ this.name +"</option>");
                //    });
                //}
            });

    });

