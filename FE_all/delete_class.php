<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    require("../constant_var_define.php");

    //$input_begin_time = $_GET['begin_time'];
    //debug_output("输入的begin_time是：".$input_begin_time);
    //$input_location = $_GET['location'];
    //debug_output("输入的location是：".$input_location);
    //$input_classroom = $_GET['classroom'];
    //debug_output("输入的classroom是：".$input_classroom);
    $input_class_id = $_GET['class_id'];
    debug_output("输入的class_id是：".$input_class_id);

    $conn = db_connect();

    //先根据begin_time,location,classroom查询是否有相应课程信息
    //$query_result = $conn->query("select class_id from class_info_table where //class_begin_time='".$input_begin_time."' and location=$input_location and classroom=$input_classroom");
    //debug_output("select class_id from class_info_table where class_begin_time='".$input_begin_time."' and //location=$input_location and classroom=$input_classroom");
    //$result = $query_result->fetch();
    //if(empty($result))
    //{
    //    echo "没有查到相应课程信息！";
    //    return;
    //}
    //$db_class_id = $input_class_id;
    //debug_output("要删除的class_id是：".$db_class_id);

    //删除课程信息
    $query_result = $conn->query("delete from class_info_table where class_id=$input_class_id");
    debug_output("delete from class_info_table where class_id=$input_class_id");
    if($conn->errorCode() != '00000')
    {
        echo "数据库错误！删除课程失败！请重试！";
        return;
    }

    $query_result = $conn->query("delete from class_booking_table where class_id=$input_class_id");
    debug_output("delete from class_booking_table where class_id=$input_class_id");

    echo "删除课程成功！";

    //关闭数据库
    unset($result);
    unset($query_result);
?>