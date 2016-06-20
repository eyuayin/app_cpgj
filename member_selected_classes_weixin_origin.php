<!DOCTYPE html>
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


<?php
    require("./constant_var_define.php");

   // $input_open_id = $_GET['openid'];
     $input_open_id = "oqUOZwUXs9YeUF0uMyWr9-M8cH3U";
     
    debug_output("输入的open_id是：".$input_open_id);

    if(empty($input_open_id))
    {
        page_output("black", 15, "此微信号尚未绑定！");
        //echo "此微信号尚未绑定！";
        return;
    }

    //连接数据库的参数
    $conn = db_connect();
    
    //根据open_id查出card_id,member_id和member_name
    $query_result = $conn->query("select member_id,card_id,member_name from member_info_table where open_id='".$input_open_id."' UNION select member_id,card_id,member_name from member_info_table_cui where open_id='".$input_open_id."'");
    debug_output("select member_id,card_id,member_name from member_info_table where open_id='".$input_open_id."' UNION select member_id,card_id,member_name from member_info_table_cui where open_id='".$input_open_id."'");
    $result = $query_result->fetchAll();
    var_dump($result);
    if(empty($result))
    {
        page_output("#ffffff", 15, "此微信号尚未绑定，无法查询！");
        echo "此微信号尚未绑定，无法查询！";
        return;
    }
    
    //循环将所有输入的会员名字的课程列出来
    foreach($result as $value)  //member_info_table 0:member_id 1:card_id 2:member_name
    {
        echo "in foreach";
        //根据查出的member_id到class_booking_table中查出此用户已选的课程
        $query = $conn->query("select * from class_booking_table where member_id=$value[0] UNION select * from class_booking_table_cui where member_id=$value[0] order by class_id");
        debug_output("select * from class_booking_table where member_id=$value[0] UNION select * from class_booking_table_cui where member_id=$value[0] order by class_id");
        $class_booking_result = $query->fetchAll();

        foreach($class_booking_result as $class_booking_value)  //class_booking_table 0:class_id 1:member_id 2:waiting_No
        {
            //到class_info_table表中查找出课程名称和课程时间
            $query = $conn->query("select * from class_info_table where class_id=$class_booking_value[0] UNION select * from class_info_table_cui where class_id=$class_booking_value[0]");
            debug_output("select * from class_info_table where class_id=$class_booking_value[0] UNION select * from class_info_table_cui where class_id=$class_booking_value[0]");
            $class_info_result = $query->fetchAll();

            foreach($class_info_result as $class_info_value)    //class_info_table 1:class_name 2:begin_time 
            {
                debug_output("查出来的课程开始时间是：".$class_info_value[2]);
                //debug_output("时间转换：".strtotime('2015-06-03 12:15:00'));
                //debug_output(date('Y-m-d', strtotime('2015-06-03 12:15:00')));
                //debug_output(date('Y-m-d', strtotime($class_info_value[2])));
                //if(date('Y-m-d', strtotime($class_info_value[2])) >= NOW_TIME)    //列出当前时间之后的所有已约课程
                if($class_info_value[2] >= NOW_TIME)
                {
                 switch($class_booking_value[4])
                 {
                     case 0:
                      $class_booking_value[4] = "已预约";
                      break;
                     case 1:
                      $class_booking_value[4] = "已取消";
                      break;
                    
                 }
                 
                $date_only = strstr($class_info_value[2]," ",true); //获取课程开始日期
                debug_output("booked date is；".$date_only);
                $time_only = strstr($class_info_value[2]," "); //获取课程开始时间
                debug_output("booked time is；".$time_only);
              
                $weekday = get_week($date_only); //获取课程开始星期
                debug_output("weekday is；".$weekday);
print <<<EOT
                
                 <div class="div-class-header"> {$weekday}/{$date_only} </div>
                  <table id="day1" cellpadding="6" cellspacing="0" width="100%">  
                    <tbody>
                      <volist name="data1" id="vo1">
                        <tr style="height: 60px;" onclick="cancel_class(this);" id="class_id">
                          <td class="class-status"><input value="{$class_booking_value[0]}"></td>
                          <td class="hide-input"><input value="canceled"></td>
                          <td class="td-class-time-valid">{$time_only}</td>  
                          <td class="td-class-info-valid"><div>{$class_info_value[1]}</div><div class="inner-small">{$class_info_value[6]}</div></td>
                          <td class="td-right-valid1"><span>{$class_booking_value[4]}</span></td>
                          <td class="td-right-valid2"><img src="wx_image/right-arrow.jpg" style="height: 40%;"></td>
                          <td style='DISPLAY:none' class="class_id">{$class_booking_value[0]}</td>  
                          <td style='DISPLAY:none' class="card_id">{$value[1]}</td>  
                          <td style='DISPLAY:none' class=open_id>{$input_open_id}</td>
                          <td></td>
                        </tr>
                      </volist>
                    </tbody>
                  </table>                   
EOT;

               }
            }
        }
    }
?>
                        </table>
                        
                   
            
           
       
    </body>
</html>

