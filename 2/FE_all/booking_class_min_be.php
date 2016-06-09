<?PHP
   $teacher = $_POST["teacher"];
   $begin = $_POST["begin"];
   $end = $_POST["end"];
   $date = $_POST["date"];
   $classroom = $_POST["classroom"];
   $begin_time = $date." ".$begin;
   $end_time = $date." ".$end;
   
   
    require("../constant_var_define.php");
   
   
   
   
   /*
   echo $teacher;
   echo $begin_time;
   echo $end_time;
   echo $date;
   echo "Classroom is:";
   echo $classroom;
   echo $member_name;
   */
   
   
   if(!$teacher)
   {
       echo "请输入教师信息！";
       exit();
   }
    else if(!$date)
    {
        echo "请输入预约日期";
        exit();
    }
    else if(!preg_match("/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/",$begin))
    {
        echo "请填写完整的起始日期格式！";
        exit();           
    }
    else if(!preg_match("/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/",$end))
    {
        echo "请填写完整的截止日期格式！";
        exit();           
    }

    //连接数据库的参数
    $conn = db_connect();
    
    //判断是否和已预约的教室冲突
    $sr = $conn->query("select class_id from personal_class_info_table where classroom=$classroom and (('".$begin_time."'>= class_begin_time and '".$end_time."' <= class_end_time) or ('".$begin_time."' <= class_begin_time and '".$end_time."' >= class_begin_time) or ('".$begin_time."' <= class_end_time and '".$end_time."' >= class_end_time) or ('".$begin_time."' <= class_begin_time and '".$end_time."' >= class_end_time))");
    debug_output("select class_id from personal_class_info_table where classroom=$classroom and (('".$begin_time."'>= class_begin_time and '".$end_time."' <= class_end_time) or ('".$begin_time."' <= class_begin_time and '".$end_time."' >= class_end_time) or ('".$begin_time."' <= class_end_time and '".$end_time."' >= class_end_time) or ('".$begin_time."' <= class_begin_time and '".$end_time."' >= class_end_time))");
    
    $rt = $sr->fetch();
    if($rt)
    {
        echo "此教室在此时段忙，请选择其它教室！";
        exit();
    }
    
    //插入数据库
    $st = $conn->query("INSERT INTO personal_class_info_table (class_begin_time, class_end_time, classroom,teacher) VALUES ('".$begin_time."','".$end_time."',$classroom,'".$teacher."')");
    //debug_output("INSERT INTO personal_class_info_table (class_begin_time, class_end_time, classroom,teacher) VALUES ('".$begin_time."','".$end_time."',$classroom,'".$teacher."')");
    if(!$st)
    {
        echo "数据库错误！新增课程失败！请重试！";
        return;
    }
    echo "新课程添加成功！";
              

    //关闭数据库
    unset($result);
    unset($query_result);
    
?>