<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Cache-Control" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="FE_all/css/bootstrap.css" rel="stylesheet"></link>
        <link href="FE_all/css/site.css" rel="stylesheet"></link>
        <link href="FE_all/css/bootstrap-responsive.css" rel="stylesheet"></link>
        <script src="FE_all/js/jquery.js"></script>
    </head>
    <body style="width:1800px;height:1994px;margin-top:0px;margin-left:20px;transform:rotate(90deg);-ms-transform:rotate(90deg);-moz-transform:rotate(90deg);-webkit-transform:rotate(90deg);">

        
           
               
                   
                        <div class="page-header">
                            <h1>Selected class <small>已约课程列表</small></h1>
                        </div>
                        <table style="font-size: 45px;width:2500px">
                            <thead>
                                <tr style="height:300px;">
                                    <!--<th>会员号</th> -->
                                    <th style="border:1px solid #BAB3B3;">姓名</th>
                                    <th style="border:1px solid #BAB3B3;">卡号</th>
                                    <th style="border:1px solid #BAB3B3;">课程名</th>
                                    <th style="border:1px solid #BAB3B3;">时间</th>
                                    <th style="border:1px solid #BAB3B3;">取消</th>
                                    <th style="border:1px solid #BAB3B3;">id</th>
                                </tr>
                            </thead>
<?php
    require("./constant_var_define.php");

    $input_open_id = $_GET['openid'];
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
    $query_result = $conn->query("select member_id,card_id,member_name from member_info_table where open_id='".$input_open_id."'");
    debug_output("select member_id,card_id,member_name from member_info_table where open_id='".$input_open_id."'");
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
        //根据查出的member_id到class_booking_table中查出此用户已选的课程
        $query = $conn->query("select * from class_booking_table where member_id=$value[0] order by class_id");
        debug_output("select * from class_booking_table where member_id=$value[0] order by class_id");
        $class_booking_result = $query->fetchAll();

        foreach($class_booking_result as $class_booking_value)  //class_booking_table 0:class_id 1:member_id 2:waiting_No
        {
            //到class_info_table表中查找出课程名称和课程时间
            $query = $conn->query("select * from class_info_table where class_id=$class_booking_value[0]");
            debug_output("select * from class_info_table where class_id=$class_booking_value[0]");
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
print <<<EOT
                    <tbody>
                    <tr class="$class_booking_value[4]" style="height:300px;">
                    <td style="border:1px solid #BAB3B3;">{$value[2]}</td>
                    <td style="border:1px solid #BAB3B3;">{$value[1]}</td>
                    <td style="border:1px solid #BAB3B3;">{$class_info_value[1]}</td>
                    <td style="border:1px solid #BAB3B3;">{$class_info_value[2]}</td>
                    <td style="border:1px solid #BAB3B3;">
                    <a href="cancel_booking_weixin.php?card_id=$value[1]&begin_time=$class_info_value[2]&class_id=$class_booking_value[0]">取消</a>
                    </td>
                    <td style="border:1px solid #BAB3B3;">$class_booking_value[0]</td>
                    </tr>
                     <script>
                        $(document).ready(function () {
                            console.log("dffr");
                            if($class_booking_value[4] == 1){
                                
                                $(".1 a").attr('href','#'); 
                                $(".1 a").removeAttr("onclick");
                                $(".1 a").text('已取消');
                                $(".1 td").css({'background-color':'#B3B3B3'});
                            }

                        });
                    </script>
EOT;

               }
            }
        }
    }
?>
                        </table>
                        
                   
            
           
       
    </body>
</html>

