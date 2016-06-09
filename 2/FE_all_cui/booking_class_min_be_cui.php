<?PHP
   $teacher = $_POST["teacher"];
   $begin = $_POST["begin"];
   $end = $_POST["end"];
   $date = $_POST["date"];
   $classroom = $_POST["classroom"];
   $begin_time = $date." ".$begin;
   $end_time = $date." ".$end;
   
    require("../constant_var_define.php");
   
   $classroom = $classroom_name_to_num[$classroom];
   
   
   echo $teacher;
   echo $begin_time;
   echo $end_time;
   echo $date;
   echo "Classroom is:";
   echo $classroom;
   echo $member_name;
   
   
  

    //连接数据库的参数
    $conn = db_connect();
    
    $st = $conn->query("INSERT INTO personal_class_info_table (class_begin_time, class_end_time, classroom,teacher) VALUES ('".$begin_time."','".$end_time."',$classroom,'".$teacher."')");
    debug_output("INSERT INTO personal_class_info_table (class_begin_time, class_end_time, classroom,teacher) VALUES ('".$begin_time."','".$end_time."',$classroom,'".$teacher."')");
              

    //关闭数据库
    unset($result);
    unset($query_result);
    
?>