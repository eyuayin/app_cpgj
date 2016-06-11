<?php

print <<<EOT
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link href="__PUBLIC__/Css/style.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/Css/Wx.css" rel="stylesheet" type="text/css" />

<title>已约课程</title>
</head>
<body style="margin:0">
  <!-- Table markup-->  
  <div class="div-title" style="line-height:40px;">我的课程</div>
  
  <div class="div-class-header">{$week1} / {$month1} {$date1}</div>
  <table id="day1" cellpadding="6" cellspacing="0" width="100%">  
    <tbody>
      <volist name="data1" id="vo1">
        <tr style="height: 60px;" onclick="cancel_class(this);" id="{$vo1['class_id']}">
          <td class="class-status"><input value="{$vo1['class_status']}"></td>
          <td class="hide-input"><input value="{$vo1['canceled']}"></td>
          <td class="td-class-time-valid">{$vo1['class_begin_time']}</td>  
          <td class="td-class-info-valid"><div>{$vo1['class_name']}</div><div class="inner-small">{$vo1['teacher_name']}</div></td>
          <td class="td-right-valid1"><span>{$vo1['your_status']}</span></td>
          <td class="td-right-valid2"><img src="__PUBLIC__/Images/wx/right-arrow.jpg" style="height: 40%;"></td>
        </tr>
      </volist>
    </tbody>
  </table>

  <div style="height:10px;"></div>
  <div class="div-class-header">{$week2} / {$month2} {$date2}</div>
  <table id="day2" cellpadding="6" cellspacing="0" width="100%">  
    <tbody>
      <volist name="data2" id="vo2">
        <tr style="height: 60px;" onclick="cancel_class(this);" id="{$vo2['class_id']}">
          <td class="class-status"><input value="{$vo2['class_status']}"></td>
          <td class="hide-input"><input value="{$vo2['canceled']}"></td>
          <td class="td-class-time-valid">{$vo2['class_begin_time']}</td>  
          <td class="td-class-info-valid"><div>{$vo2['class_name']}</div><div class="inner-small">{$vo2['teacher_name']}</div></td>
          <td class="td-right-valid1"><span>{$vo2['your_status']}</span></td>
          <td class="td-right-valid2"><img src="__PUBLIC__/Images/wx/right-arrow.jpg" style="height: 40%;"></td>
        </tr>
      </volist>
    </tbody>
  </table>
  
  <div style="height:10px;"></div>
  <div class="div-class-header">{$week3} / {$month3} {$date3}</div>
  <table id="day3" cellpadding="6" cellspacing="0" width="100%">  
    <tbody>
      <volist name="data3" id="vo3">
        <tr style="height: 60px;" onclick="cancel_class(this);" id="{$vo3['class_id']}">
          <td class="class-status"><input value="{$vo3['class_status']}"></td>
          <td class="hide-input"><input value="{$vo3['canceled']}"></td>
          <td class="td-class-time-valid">{$vo3['class_begin_time']}</td>  
          <td class="td-class-info-valid"><div>{$vo3['class_name']}</div><div class="inner-small">{$vo3['teacher_name']}</div></td>
          <td class="td-right-valid1"><span>{$vo3['your_status']}</span></td>
          <td class="td-right-valid2"><img src="__PUBLIC__/Images/wx/right-arrow.jpg" style="height: 40%;"></td>
        </tr>
      </volist>
    </tbody>
  </table>
  
<script type="text/javascript" src="__PUBLIC__/Lib/jquery/1.9.1/jquery.min.js"></script> 
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