<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Cache-Control" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="FE_all/css/bootstrap.css" rel="stylesheet"></link>
        <link href="FE_all/css/site.css" rel="stylesheet"></link>
        <link href="FE_all/css/bootstrap-responsive.css" rel="stylesheet"></link>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span9">
                    <div class="row-fluid">
                        <div class="page-header">
                            <h1>Selected class <small>已约课程列表</small></h1>

                        </div>
                        <div class="table-responsive">
                        <table  style="font-size:17px;" class="table table-bordered">
                            <thead>
                                <tr>
                                    <!--<th>会员号</th> -->
                                    <th>姓名</th>
                                    <th>会员卡号</th>
                                    <th>课程名称</th>
                                    <th>上课时间</th>
                                    <th>取消操作</th>
                                    <th>class_id</th>
                                </tr>
                            </thead>
<?php
    require("../constant_var_define.php");

    $name = '元英';//$_POST['name'];
    debug_output("姓名:".$name);

    $conn = db_connect();

    //根据姓名从member_info_table中查出member_id,card_id和card_type
    $query_result = $conn->query("select member_id,card_id,card_type from member_info_table where member_name='".$name."'");
    debug_output("select member_id,card_id,card_type from member_info_table where member_name='".$name."'");

    if($conn->errorCode() != '00000')
    {
        echo "数据库错误！查询失败！请重试！";
        return;
    }
    $result = $query_result->fetchAll();

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
                    <tr>
                    <td>{$value[2]}</td>
                    <td>{$value[1]}</td>
                    <td>{$class_info_value[1]}</td>
                    <td>{$class_info_value[2]}</td>
                    <td>
                    <a href="cancel_booking_weixin.php?card_id=$value[1]&begin_time=$class_info_value[2]&class_id=$class_booking_value[0]">取消</a>
                    </td>
                    <td>$class_booking_value[0]</td>
                    </tr>
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
        </div>
    </body>
</html>
