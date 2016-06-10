<html lang="en" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="/FE_all/css/bootstrap.css" rel="stylesheet"></link>
        <link href="/FE_all/css/site.css" rel="stylesheet"></link>
        <link href="/FE_all/css/bootstrap-responsive.css" rel="stylesheet"></link>

<?php
    require("./constant_var_define.php");

    $begin_date = $_POST['begin_date'];
    $end_date = $_POST['end_date'];
    $class_name = $_POST['class_name'];
    $priority = $_POST['priority'];
    $locatioin = $_POST['class_location'];
    $classroom = $_POST['class_room'];
    $teacher = $_POST['teacher_name'];
    $num_limit = $_POST['num_limit'];
    $former_begin_date = $_POST['former_begin_date'];
    $former_classroom = $_POST['former_classroom'];
    $former_location = $_POST['former_location'];

    $locatioin = $location_name_to_num[$locatioin];
    $classroom = $classroom_name_to_num_cui[$classroom];
    $former_location = $location_name_to_num[$former_location];
    $former_classroom = $classroom_name_to_num_cui[$former_classroom];

    debug_output("上课时间是：".$begin_date);
    debug_output("下课时间是：".$end_date );
    debug_output("课程名称是：".$class_name);
    debug_output("课程优先级：".$priority);
    debug_output("上课地点：".$locatioin);
    debug_output("上课教室：".$classroom);
    debug_output("老师：".$teacher);
    debug_output("最多上课人数：".$num_limit);
    debug_output("之前上课时间：".$former_begin_date);
    debug_output("之前地点：".$former_location);
    debug_output("之前教室：".$former_classroom);

    if(empty($begin_date) || empty($end_date) || empty($class_name) || empty($priority) || empty($locatioin) || empty($classroom) || empty($teacher) || empty($num_limit) || empty($former_begin_date) || empty($former_classroom) || empty($former_location))
    {
        page_output("black", 15, "请输入相关信息！");
        //echo "网络传输错误！请稍后重试！";
        return;
    }

    $conn = db_connect();
    
    //先根据根据原有的上课时间、地点、教室，查出class_id
    $query_result = $conn->query("select class_id from class_info_table_cui where class_begin_time='".$former_begin_date."' and location=$former_location and classroom=$former_classroom");
    debug_output("select class_id from class_info_table_cui where class_begin_time='".$former_begin_date."' and location=$former_location and classroom=$former_classroom");
    $result = $query_result->fetch();
    $db_class_id = $result[0];
    debug_output("查出来的class_id是：".$db_class_id);
    if(empty($db_class_id))
    {
        page_output("black", 15, "查询不到该课程信息！");
        //echo "查询不到该课程信息！";
        return;
    }

    //从class_booking_table_cui中查出已经预约的人数，更新到新的课程信息中，可以有助于恢复错误
    $query_result = $conn->query("select count(*) from class_booking_table_cui where class_id=$db_class_id");
    debug_output("select count(*) from class_booking_table_cui where class_id=$db_class_id");
    $result = $query_result->fetch();
    $db_selected_num = $result[0];
    debug_output("本节课已选人数为：".$db_selected_num);
    if(empty($db_selected_num))
    {
        $db_selected_num = 0;
    }

    //将新的数据全部更新到数据库中
    $affect_rows = $conn->exec("update class_info_table_cui set class_name='".$class_name."',class_begin_time='".$begin_date."',class_end_time='".$end_date."',location=$locatioin,classroom=$classroom,teacher='".$teacher."',max_user_number=$num_limit,selected_user_number=$db_selected_num,class_priority=$priority where class_id=$db_class_id");
    debug_output("update class_info_table_cui set class_name='".$class_name."',class_begin_time='".$begin_date."',class_end_time='".$end_date."',location=$locatioin,classroom=$classroom,teacher='".$teacher."',max_user_number=$num_limit,selected_user_number=$db_selected_num,class_priority=$priority where class_id=$db_class_id");

    debug_output("修改的行数为：".$affect_rows);
    debug_output("errorCode=".$conn->errorCode());
    if($conn->errorCode() != '00000')
    {
        page_output("black", 15, "课程信息修改失败！请保存截图并发给瑜伽馆工作人员，谢谢！");
        //echo "课程信息修改失败！请保存截图并发给瑜伽馆工作人员，谢谢！";
        print_r($conn->errorInfo());
        return;
    }
    page_output("black", 15, "课程信息修改成功！");
    //echo '课程信息修改成功！';
?>