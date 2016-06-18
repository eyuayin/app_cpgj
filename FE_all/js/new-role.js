function showTip(tipTxt) {
    console.log("ru can",tipTxt);
    console.log("_______>in show tips");
    var div = document.createElement('div');
    div.innerHTML = '<div style="border: dotted; color:red"><p>' + tipTxt + '</p></div>';
    console.log("div",div);
    var tipNode = div.firstChild;
    $("#wrap").after(tipNode);
    setTimeout(function () {
        $(tipNode).remove();
    }, 1500);
}

function book_type_change() {
    var select_keyword_type=$('#search_type').val();
    var name=$('#name').val();
    //var phone=$('#phone').val();
    var card_no=$('#cardNo').val();

    //console.log("selected_card_type",select_keyword_type);
    if(select_keyword_type == 1)
    {
        //console.log("按姓名");
        $('#name_div').show();
        //$('#phone_div').hide();
        $('#cardNo_div').hide();


    }
    else if( select_keyword_type == 2){
        //console.log("按卡号");

        $('#name_div').hide();
        $('#phone_div').hide();
        $('#cardNo_div').show();

    }
    else
      alert ("请选择一个输入类型");
}

function tgSumbit(){
        var bookexpert=$("#select_class").val();
        var name = $("#name").val();
        var card_id = $("#cardNo").val();
        //console.log("bookexpert",bookexpert);
        if($.trim(bookexpert) == ""){
            console.log("------->in 请输入");
            alert("请输入预约课程！");
            return false;
        }
    if( ($.trim(card_id) == "" )&& ($.trim(name) == "" )){
        console.log("------->in 请输入card",$.trim(card_id));
        console.log("------->in 请输入name",$.trim(name));
        
        
        alert('卡号或姓名至少输入一个！');
        return false;
    }

    return true;

}

//用户点提交后执行的请求
    function send_info() {
    //判断输入是否为空
     var whether_go_back =   tgSumbit();
    console.log("whether_go_back",whether_go_back);
        if(!whether_go_back){
           return;
        }
    //用户输入值的获取

        var name = $("#name").val();
        var card_id = $("#cardNo").val();
        var select_class = $("#select_class").val();
        
        //寻找 * 的index
        console.log("index of * is:",select_class.indexOf('*'));
        
        var class_id = select_class.substr(select_class.indexOf('*')+1);
        var whether_wait = $("#whetherWait").val();
       // var select_day =$("#select_day").val();
       // var classroom = $("#classroom").val();
       // var location = $("#location").val();
        console.log("select_class",select_class);
        console.log("class_id",class_id);

        //发请求给后台插入
        $.post("booking_class.php",
            {          
                card_id: card_id,
                name: name,
                whetherWait: whether_wait,
                class_id: class_id
            },
            function (data, status) {
                console.log("indata",data);
                alert("数据：" + data);
            });
    };

    //用户选择日期变化后执行的请求
    function check_class_change() {
        //获取用户选择的日期
       // console.log("--------->in");
         var select_day =$("#select_day").val();

        $.post("../search_db_class_info.php",
            {
                day: select_day
            },
            function (data, status) {
                //alert("数据：" + data + "\n状态：" + status);
                 console.log("data------->",data);
                var result = JSON.parse(data);
                //console.log("result--------------->", result);
                $('#select_class').empty();
                result.forEach(function (e) {
                    console.log("in---------------------->");
                  $('#select_class').append("<option >" + e + "</option>");
                });

                //success:function(data){
                //    $.each( data,function(){
                //        $('#select').append("<option value='"+ this.id+"'>"+ this.name +"</option>");
                //    });
                //}
            });
    }

    //  页面加载好后执行的请求
    $(document).ready(function () {
         $('#name_div').show();
        //$('#phone_div').hide();
        $('#cardNo_div').hide();
        // var day = myData.getDay();获取星期
        //switch (day) {
        //    case 1:
        //        $("#select_day").prepend("<option value='1'>星期一</option>");
        //        $("#select_day").append("<option value='2'>星期二</option>");
        //        $("#select_day").append("<option value='3'>星期三</option>");
        //        break;
        //
        //    case 2:
        //        $("#select_day").prepend("<option>星期二</option>");
        //        $("#select_day").append("<option value='2'>星期三</option>");
        //        $("#select_day").append("<option value='3'>星期四</option>");
        //        break;
        //    case 3:
        //        $("#select_day").prepend("<option value='6'>星期三</option>");
        //        $("#select_day").append("<option value='1'>星期四</option>");
        //        $("#select_day").append("<option value='1'>星期五</option>");
        //        break;
        //    case 4:
        //        $("#select_day").prepend("<option value='6'>星期四</option>");
        //        $("#select_day").append("<option value='1'>星期五</option>");
        //        $("#select_day").append("<option value='1'>星期六</option>");
        //        break;
        //    case 5:
        //        $("#select_day").prepend("<option value='6'>星期五</option>");
        //        $("#select_day").append("<option value='1'>星期六</option>");
        //        $("#select_day").append("<option value='1'>星期日</option>");
        //        break;
        //    case 6:
        //        $("#select_day").prepend("<option value='6'>星期六</option>");
        //        $("#select_day").append("<option value='1'>星期日</option>");
        //        $("#select_day").append("<option value='1'>星期一</option>");
        //        break;
        //    case 0:
        //        $("#select_day").prepend("<option value='6'>星期日</option>");
        //        $("#select_day").append("<option value='1'>星期一</option>");
        //        $("#select_day").append("<option value='1'>星期二</option>");
        //        break;
        //};

        //console.log("____>in document ready");
        //获取近三天时间
        function GetDateStr(AddDayCount) {

            var dd = new Date();

            dd.setDate(dd.getDate() + AddDayCount);//获取AddDayCount天后的日期

            var y = dd.getFullYear();

            var m = dd.getMonth() + 1;//获取当前月份的日期

            var d = dd.getDate();

            return y + "-" + m + "-" + d;
        }

        //时间选项
        $("#select_day").prepend("<option>" + GetDateStr(0) + "</option>");//今天日期
        $("#select_day").append("<option>" + GetDateStr(1) + "</option>"); //明天日期
        $("#select_day").append("<option>" + GetDateStr(2) + "</option>"); //后天日期
        $("#select_day").append("<option>" + GetDateStr(3) + "</option>"); //大后天日期


        //获取用户选择的日期
        var select_day =$("#select_day").val();
        //console.log("select_day",select_day);
        //给服务器发请求并处理json文件
        $.post("../search_db_class_info.php",
            {
                day: select_day
            },
            function (data, status) {
                //alert("数据：" + data + "\n状态：" + status);
                 console.log("data1234------->",data);
                //var result = JSON.parse(data);
                //console.log("result--------------->", result);
                //result.forEach(function (e) {
                    //  console.log("in---------------------->");
                //    $('#select_class').append("<option >" + e + "</option>");
               // });

                //success:function(data){
                //    $.each( data,function(){
                //        $('#select').append("<option value='"+ this.id+"'>"+ this.name +"</option>");
                //    });
                //}
            });

    });

