<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    require("../constant_var_define.php");

    $input_class_name = $_POST['class_name'];
    debug_output("输入的class_name是：".$input_class_name);
    $input_begin_time = $_POST['begin_date'];
    $input_begin_time = $input_begin_time.":00";
    $input_begin_time = strtr($input_begin_time, "T", " ");
    debug_output("输入的begin_time是：".$input_begin_time);
    $input_end_time = $_POST['end_date'];
    $input_end_time = $input_end_time.":00";
    $input_end_time = strtr($input_end_time, "T", " ");
    debug_output("输入的end_time是：".$input_end_time);
    $input_location = $_POST['location'];
    debug_output("输入的location是：".$input_location);
    $input_classroom = $_POST['classroom'];
    debug_output("输入的classroom是：".$input_classroom);
    $input_teacher = $_POST['teacher'];
    debug_output("输入的teacher_id是：".$input_teacher);
    $input_max_user = $_POST['num_limit'];
    debug_output("输入的max_user是：".$input_max_user);
    //$input_class_priority = $_POST['priority'];
    //debug_output("输入的class_priority是：".$input_class_priority);

    if(empty($input_class_name))
    {
        echo "请输入课程名称！";
        return;
    }
    if(empty($input_begin_time))
    {
        echo "请输入上课时间！";
        return;
    }
    if(empty($input_end_time))
    {
        echo "请输入下课时间！";
        return;
    }
    if(empty($input_location))
    {
        echo "请输入上课地点！";
        return;
    }
    if(empty($input_classroom))
    {
        echo "请输入教室！";
        return;
    }
    if(empty($input_teacher))
    {
        echo "请输入老师姓名！";
        return;
    }
    if(empty($input_max_user))
    {
        echo "请输入上课人数限制！";
        return;
    }
    if(empty($input_class_priority))
    {
        echo "请输入高温/常温课程！";
        return;
    }

    //连接数据库的参数
    $conn = db_connect();

    //计算出新增课程的日期
    $new_class_date = substr($input_begin_time, 0, 10);
    //从class_info_table中查出新增课程当天的所有课程
    $query_result = $conn->query("select class_name,class_begin_time,class_end_time,location,classroom from class_info_table where class_begin_time like '".$new_class_date."%'");
    debug_output("select class_name,class_begin_time,class_end_time,location,classroom from class_info_table where class_begin_time like '".$new_class_date."%'");
    $result = $query_result->fetch();
    foreach($result as $value)
    {
        debug_output("课程名是：".$value[0]);
        debug_output("开始时间：".$value[1]);
        debug_output("结束时间：".$value[2]);
        debug_output("地点：".$value[3]);
        debug_output("教室：".$value[4]);
        //先过滤出地点一致的
        if(($input_location == $value[3]) && ($input_classroom == $value[4]))
        {
            //课程开始时间、结束时间，如果和其中一节课程的起始、结束时间有重叠，则不能新增课程
            if(($input_begin_time > $value[1]) && ($input_begin_time < $value[2]))
            {
                echo "此教室在本时段已被: ".$class_num_to_name[$value[0]]." 课程占用！请确认！";
                return;
            }
            else if(($input_end_time > $value[1]) && ($input_end_time < $value[2]))
            {
                echo "此教室在本时段已被: ".$class_num_to_name[$value[0]]." 课程占用！请确认！";
                return;
            }
        }
    }

    //如果没有冲突，则加入到personal_class_info_table
    $query_result = $conn->query("insert into personal_class_info_table(class_name,class_begin_time,class_end_time,location,classroom,teacher,max_user_number,class_priority) values('".$input_class_name."','".$input_begin_time."','".$input_end_time."',$input_location,$input_classroom,'".$input_teacher."',$input_max_user,3)");
    debug_output("insert into personal_class_info_table(class_name,class_begin_time,class_end_time,location,classroom,teacher,max_user_number,class_priority) values('".$input_class_name."','".$input_begin_time."','".$input_end_time."',$input_location,$input_classroom,'".$input_teacher."',$input_max_user,3)");
    if(!$query_result)
    {
        echo "数据库错误！新增课程失败！请重试！";
        return;
    }
    echo "新的私教课程添加成功！";

    //关闭数据库
    unset($result);
    unset($query_result);
?>