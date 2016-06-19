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
<script type="text/javascript" src="FE_all_cui/js/jquery.min.js"></script> 
<script src="JS_weixin/cancel_book.js" charset='gbk'></script>

<title>已约课程</title>
</head>
<body style="margin:0">
  <!-- Table markup-->  
  <div class="div-title" style="line-height:40px;">我的课程</div>

EOT;

require("./constant_var_define.php");

    
   
    
   // $input_open_id = $_GET['openid'];
    

    $input_open_id = "oqUOZwUXs9YeUF0uMyWr9-M8cH3U";
    debug_output("输入的open_id是：".$input_open_id);
    
    if(empty($input_open_id))
    {
        page_output("black", 15, "未获取微信ID，请联系管理员！");
        //echo "此微信号尚未绑定！";
        return;
    }

    //连接数据库的参数
    $conn = db_connect();
    $today =  date('y-m-d',time());
    
    //根据open_id查出card_id,member_id和member_name
    $query_result = $conn->query("select * from member_booked_class_detail_view where open_id='".$input_open_id."' ORDER BY date desc");
    debug_output("select * from member_booked_class_detail_view where open_id='".$input_open_id."' ORDER BY date desc");
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
         switch ($value[9])
                {
                case 1:
                  $value[9] = "星期 日 ";
                  break;
                case 2:
                  $value[9] =  " 星期 一 ";
                  break;
                case 3:
                  $value[9] =  " 星期 二 ";
                  break;
                case 4:
                  $value[9] =  " 星期 三 ";
                  break;
                case 5:
                  $value[9] =  " 星期 四 ";
                  break;
                case 6:
                  $value[9] =  " 星期 五 ";
                  break;
                case 7:
                  $value[9] =  " 星期 六 ";
                  break;
                }
                
         switch ($value[2])
                {
                case 0:
                  $value[2] = "已预约";
                  break;
                case 1:
                  $value[2] =  "已取消";
                  break;
                }
                
          print <<<EOT
          <div class="div-class-header"> {$value[9]} / {$value[8]} </div>
          <table id="day1" cellpadding="6" cellspacing="0" width="100%">  
            <tbody>
              <volist name="data1" id="vo1">
                <tr style="height: 60px;" onclick="cancel_class(this);" id="class_id">
                  <td class="class-status"><input value="{$value[1]}"></td>
                  <td class="hide-input"><input value="canceled"></td>
                  <td class="td-class-time-valid">{$value[5]}</td>  
                  <td class="td-class-info-valid"><div>{$value[6]}</div><div class="inner-small">{$value[7]}</div></td>
                  <td class="td-right-valid1"><span>{$value[2]}</span></td>
                  <td class="td-right-valid2"><img src="wx_image/right-arrow.jpg" style="height: 40%;"></td>
                  <td style='DISPLAY:none'>{$value[4]}</td>
                  <td style='DISPLAY:none'>{$input_open_id}</td>
                  <td></td>
                </tr>
              </volist>
            </tbody>
          </table>
EOT;
    }



?>