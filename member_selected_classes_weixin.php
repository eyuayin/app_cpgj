<?php

print <<<EOT
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link href="wx_css/style.css" rel="stylesheet" type="text/css" />
<link href="wx_css/Wx.css" rel="stylesheet" type="text/css" />

<title>已约课程</title>
</head>
<body style="margin:0">
  <!-- Table markup-->  
  <div class="div-title" style="line-height:40px;">我的课程</div>

EOT;

require("./constant_var_define.php");

    $input_open_id = $_GET['openid'];
    debug_output("输入的open_id是：".$input_open_id);

    if(empty($input_open_id))
    {
        page_output("black", 15, "未获取微信ID，请联系管理员！");
        //echo "此微信号尚未绑定！";
        return;
    }

    //连接数据库的参数
    $conn = db_connect();
    
    //根据open_id查出card_id,member_id和member_name
    $query_result = $conn->query("select * from member_booked_class_view where open_id='".$input_open_id."'");
    debug_output("select * from member_booked_class_view where open_id='".$input_open_id."'");
    $result = $query_result->fetchAll();
    if(empty($result))
    {
        page_output("black", 15, "此微信号尚未绑定，无法查询！");
        //echo "此微信号尚未绑定，无法查询！";
        return;
    }
    
    //循环将所有输入的会员名字的课程列出来
    foreach($result as $value)  //member_info_table 0:member_id 1:card_id 2:member_name
    {
          print <<<EOT
          <div class="div-class-header"> / month1 date1</div>
          <table id="day1" cellpadding="6" cellspacing="0" width="100%">  
            <tbody>
              <volist name="data1" id="vo1">
                <tr style="height: 60px;" onclick="cancel_class(this);" id="class_id">
                  <td class="class-status"><input value=2></td>
                  <td class="hide-input"><input value="canceled"></td>
                  <td class="td-class-time-valid">class_begin_time</td>  
                  <td class="td-class-info-valid"><div>class_name</div><div class="inner-small">teacher_name</div></td>
                  <td class="td-right-valid1"><span>your_status</span></td>
                  <td class="td-right-valid2"><img src="wx_image/right-arrow.jpg" style="height: 40%;"></td>
                </tr>
              </volist>
            </tbody>
          </table>
EOT;
    }


  
<script type="text/javascript" src="FE_all_cui/js/jquery.min.js"></script> 
<script>
$(document).ready(function(){
   $("#day1 tr").each(function(index, element){
      var s = $(element).find(".class-status").children().val();
      if(s == 0){
        $(element).find(".td-class-time-valid").attr("class","td-class-time-invalid");
        $(element).find(".td-class-info-valid").attr("class","td-class-info-invalid");
        $(element).find(".td-right-valid1").children().remove();
        $(element).find(".td-right-valid1").attr("class","td-right-invalid1");
        $(element).find(".td-right-valid2").children().remove();
        $(element).find(".td-right-valid2").attr("class","td-right-invalid2");
      }else if(s == 2){
        $(element).find(".td-class-time-valid").attr("class","td-class-time-invalid");
        $(element).find(".td-class-info-valid").attr("class","td-class-info-invalid");
        //$(element).find(".td-right-valid1").children().remove();
        $(element).find(".td-right-valid1").attr("class","td-right-invalid1");
        $(element).find(".td-right-valid2").children().remove();
        $(element).find(".td-right-valid2").attr("class","td-right-invalid2");
      }
    });
    $("#day2 tr").each(function(index, element){
      var s = $(element).find(".class-status").children().val();
      if(s == 0){
        $(element).find(".td-class-time-valid").attr("class","td-class-time-invalid");
        $(element).find(".td-class-info-valid").attr("class","td-class-info-invalid");
        $(element).find(".td-right-valid1").children().remove();
        $(element).find(".td-right-valid1").attr("class","td-right-invalid1");
        $(element).find(".td-right-valid2").children().remove();
        $(element).find(".td-right-valid2").attr("class","td-right-invalid2");
      }else if(s == 2){
        $(element).find(".td-class-time-valid").attr("class","td-class-time-invalid");
        $(element).find(".td-class-info-valid").attr("class","td-class-info-invalid");
        //$(element).find(".td-right-valid1").children().remove();
        $(element).find(".td-right-valid1").attr("class","td-right-invalid1");
        $(element).find(".td-right-valid2").children().remove();
        $(element).find(".td-right-valid2").attr("class","td-right-invalid2");
      }
    });
    $("#day3 tr").each(function(index, element){
      var s = $(element).find(".class-status").children().val();
      if(s == 0){
        $(element).find(".td-class-time-valid").attr("class","td-class-time-invalid");
        $(element).find(".td-class-info-valid").attr("class","td-class-info-invalid");
        $(element).find(".td-right-valid1").children().remove();
        $(element).find(".td-right-valid1").attr("class","td-right-invalid1");
        $(element).find(".td-right-valid2").children().remove();
        $(element).find(".td-right-valid2").attr("class","td-right-invalid2");
      }else if(s == 2){
        $(element).find(".td-class-time-valid").attr("class","td-class-time-invalid");
        $(element).find(".td-class-info-valid").attr("class","td-class-info-invalid");
        //$(element).find(".td-right-valid1").children().remove();
        $(element).find(".td-right-valid1").attr("class","td-right-invalid1");
        $(element).find(".td-right-valid2").children().remove();
        $(element).find(".td-right-valid2").attr("class","td-right-invalid2");
      }
    });
});

function cancel_class(obj){
  var id = $(obj).attr("id");
  var status = $(obj).find(".hide-input").children().val();
  location.href="__ROOT__/wx.php/Selectedclassinfo/Index/index/cid/"+id+"/status/"+status;
}
</script>
</body>
</html>

EOT;

?>