<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="css/bootstrap.css" rel="stylesheet"></link>
        <link href="css/site.css" rel="stylesheet"></link>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"></link>
        <link href="css/bootstrap.css" rel="stylesheet"/>
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
                                    <th>课程号</th> 
                                    <th>姓名</th>
                                    <th>手机号</th>
                                    <th>会员卡号</th>
                                    <th>签到</th>
                                </tr>
                            </thead>

<?php
    require("../constant_var_define.php");

    $input_class_location = $_GET['location'];
    debug_output("输入的上课地点是：".$input_class_location);
    $input_classroom = $_GET['classroom'];
    debug_output("输入的教室是：".$input_classroom);
    $input_class_begin_time = $_GET['begin_time'];
    debug_output("输入的上课时间是：".$input_class_begin_time);
    $class_id = $_GET['class_id'];
    //连接数据库的参数
    $conn = db_connect();

    //从class_info_table_cui中查出class_id
    $query_result = $conn->query("select class_id from class_info_table_cui where class_begin_time='".$input_class_begin_time."' and location='".$input_class_location."' and classroom='".$input_classroom."'");
    debug_output("select class_id from class_info_table_cui where class_begin_time='".$input_class_begin_time."' and location='".$input_class_location."' and classroom='".$input_classroom."'");
    $result = $query_result->fetch();
    if(empty($result))
    {
        echo "无此课程信息！";
        return;
    }
    $db_class_id = $result[0];
    debug_output("查出的class_id是：".$db_class_id);

    $query_result = $conn->query("select member_id,sign_in from class_booking_table_cui where class_id=$db_class_id and canceled=0");
    debug_output("select member_id from class_booking_table_cui where class_id=$db_class_id and canceled=0");
    $result = $query_result->fetchAll();
    if(empty($result))
    {
        echo "此节课没有已选会员";
        return;
    }

    //列出所有member_id对应的会员信息，包括会员姓名、卡号、手机号
    foreach($result as $value)
    {
        $query_result = $conn->query("select member_name,phone,card_id from member_info_table_cui where member_id=$value[0]");
        debug_output("select member_name,phone,card_id from member_info_table_cui where member_id=$value[0]");
        $member_result = $query_result->fetch();
       
print <<<EOT
       <tbody>
        <tr>
             <td >{$class_id}</td>
             <td >{$member_result[0]}</td>
             <td >{$member_result[1]}</td>
             <td >{$member_result[2]}</td>
             <td ><input type="checkbox" class="sign_in_checked" id="$member_result[2]"/></td>
        </tr>
        </tbody>
        <script>
        $(document).ready(function ()
        {
           console.log("in ready");           
            console.log("value is :",$value[1]); 
            if($value[1] == 0)
            {
                console.log("in false");
                $("#$member_result[2]").attr("checked",false);
            }
            else if($value[1] == 1)
            {
                console.log("in true");
                $("#$member_result[2]").attr("checked",true);
            }
           
            
    });
        </script>
EOT;
    }
?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
         <script src="js/sign-in.js"></script>
    </body>
</html>
