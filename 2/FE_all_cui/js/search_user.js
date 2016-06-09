function search_type_change(){
    var select_keyword_type=$('#search_type').val();
    var name=$('#name').val();
    var phone=$('#phone').val();
    var card_no=$('#cardNo').val();

    //console.log("selected_card_type",select_keyword_type);
    if(select_keyword_type == 1)
    {
        //console.log("按姓名");
        $('#name_div').show();
        $('#phone_div').hide();
        $('#cardNo_div').hide();


    }

    else if ( select_keyword_type == 2)
    {
        //console.log("俺手机号");

        $('#name_div').hide();
        $('#phone_div').show();
        $('#cardNo_div').hide();

    }
    else if( select_keyword_type == 3){
        //console.log("按卡号");

        $('#name_div').hide();
        $('#phone_div').hide();
        $('#cardNo_div').show();

    }
    else
      alert ("请选择一个输入类型");
}
//function submit_form(){
//    var select_keyword_type=$('#search_type').val();
//    //console.log("select_key",select_keyword_type);
//   // var name=$('#name').val();
//    var phone=$('#phone').val();
//    var card_no=$('#cardNo').val();
//    if( select_keyword_type == 1)
//    {
//        alert("抱歉，暂时不支持按姓名搜索用户");
//        //$.post("../../search_user.php",
//        //    {
//        //        type: 1,
//        //        search_value: name
//        //    },
//        //    function (data, status) {
//        //        alert("数据：" + data + "\n状态：" + status);
//        //        console.log(data);
//        //    });
//    }
//    else if ( select_keyword_type == 2)
//    {
//       $.post("../../search_user.php",
//            {
//                type: 2,
//                search_value: phone
//            },
//            function (data, status) {
//                console.log(data);
//               alert("数据：" + data + "\n状态：" + status);
//               var result = JSON.parse(data);
//                console.log("shouji",result);
//            });
//    }
//    else if( select_keyword_type == 3){
//        $.post("/search_user.php",
//            {
//                type: 3,
//                search_value: card_no
//            },
//            function (data, status) {
//                console.log("in--------------->",data);
//                alert("数据：" + data + "\n状态：" + status);
//                var obj = JSON.parse(data);
//                obj.forEach(function (e) {
//                     console.log("ineach---------------------->");
//                    var  obj = $("<input type='text' id='txt' value='e' />");
//                });
//
//                //alert( obj.name === "John" );
//                //var result = JSON.parse(data);
//               // console.log("result--------------->", result);
//                //result.forEach(function (e) {
//                //      console.log("in---------------------->");
//                //
//                //});
//
//                //console.log("kahao",data);
//                $("#form").remove();
//                //var  obj = $("<input type='text' id='txt' value='someValue' />");
//               // var th_id = "th_id";
//               //  result.forEach(function(e){
//               //     console.log(e);
//               // });
//                //console.log("会员卡类型",data("会员卡类型"));
//                //if(data("会员卡类型") == "5" || data("会员卡类型") == "7" ) {
//                //
//                 //   var str = "<tr id = '" + th_id + "'><th width='30%'>姓名</th><th width='30%'>性别</th><th width='30%'>身份证号</th><th width='30%'>生日</th><th width='30%'>手机号码</th><th width='30%'>会员卡号</th><th width='30%'>微信号码</th><th width='30%'>会员卡类型</th><th width='30%'>常温/高温</th><th width='30%'>会员卡状态</th><th width='30%'>会员卡开卡日期</th><th width='30%'>会员卡失效日期</th><th width='30%'>冻结开始日期</th><th width='30%'>冻结结束日期</th><th width='30%'>可使用次数</th><th width='30%'>已使用次数</th></tr>";
//                //}
//                //$(function() {
//                //    $('<thead />', {
//                //        id: 'thead'
//                //        }
//                //    ).appendTo($('#tab'));
//                //});
//                $("#thead").append(obj);
//            });
//    }
//    else
//        alert ("选择类型有误");
//
//
//}


$(document).ready(function () {
    $('#phone_div').hide();
    //$('#name_div').hide();
    $('#cardNo_div').hide();
});
