<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Cache-Control" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="css/bootstrap.css" rel="stylesheet"></link>
        <link href="css/site.css" rel="stylesheet"></link>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"></link>
        <script src="js/jquery.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span9">
                    <div class="row-fluid">
                        <div class="page-header">
                            <h1>Selected class <small>已约课程列表</small></h1>

                        </div>
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>序号</th> 
                                    <th>姓名</th>
                                    <th>会员卡号</th>
                                    <th>课程编号</th>
                                    <th>课程名称</th>
                                    <th>上课时间</th>
                                    <th>取消操作</th>
                                </tr>
                            </thead>
<?php
    require("../constant_var_define.php");

    $input_name = $_POST['name'];
    $input_begin_time = $_POST['begin_time'];

    debug_output("输入的会员名字是：".$input_name);
    debug_output("输入的起始日期是：".$input_begin_time);

    if(empty($input_name))
    {
        echo "请输入要查询的会员名字！";
        return;
    }
    if(empty($input_begin_time))
    {
        echo "请输入要查询的起始日期！";
        return;
    }

    $conn = db_connect();

    //根据open_id查出card_id,member_id
    $query_result = $conn->query("select member_id,card_id from member_info_table where member_name='".$input_name."'");
    debug_output("select member_id,card_id from member_info_table where member_name='".$input_name."'");
    $result = $query_result->fetchAll();
    
    //循环将所有输入的会员名字的课程列出来
    foreach($result as $value)
    {
        //根据查出的member_id到class_booking_table中查出此用户已选的课程
        $query = $conn->query("select class_id,canceled from class_booking_table where member_id=$value[0] order by class_id");
        debug_output("select class_id,canceled from class_booking_table where member_id=$value[0] order by class_id");
        $class_booking_result = $query->fetchAll();
        GLOBAL $i;
        $i=0;
        foreach($class_booking_result as $class_booking_value)
        {
            //到class_info_table表中查找出课程名称和课程时间
            $query = $conn->query("select class_name,class_begin_time from class_info_table where class_id=$class_booking_value[0]");
            debug_output("select class_name,class_begin_time from class_info_table where class_id=$class_booking_value[0]");
            $class_info_result = $query->fetchAll();
            
            foreach($class_info_result as $class_info_value)
            {   $i=$i+1;
                //echo "i is:";
                //echo $i;
                debug_output("查出来的课程开始时间是：".$class_info_value[1]);
                //debug_output("时间转换：".strtotime('2015-06-03 12:15:00'));
                //debug_output(date('Y-m-d', strtotime('2015-06-03 12:15:00')));
                debug_output(date('Y-m-d', strtotime($class_info_value[1])));
                if(date('Y-m-d', strtotime($class_info_value[1])) >= $input_begin_time)    //列出给定时间之后的所有已约课程
                {
print <<<EOT
                    <tbody>
                    <tr class="$class_booking_value[1]">
                    <td>$i</td>
                    <td >$input_name</td>
                    <td >{$value[1]}</td>
                    <td >{$class_booking_value[0]}</td>
                    <td >{$class_info_value[0]}</td>
                    <td >{$class_info_value[1]}</td>
                    <td >
                    <a  href="cancel_booking.php?card_id=$value[1]&class_id=$class_booking_value[0]&begin_time=$class_info_value[1]&" onClick="return confirm('确认要取消？')">取消</a>
                    </td>
                    </tr>
                    <script>
                        $(document).ready(function () {
                            console.log("dffr");
                            if($class_booking_value[1] == 1){
                                
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
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

