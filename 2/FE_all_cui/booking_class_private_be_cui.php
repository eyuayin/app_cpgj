<?PHP
   $teacher = $_POST["teacher"];
   $begin = $_POST["begin"];
   $end = $_POST["end"];
   $date = $_POST["date"];
   $classroom = $_POST["classroom"];
   $member_name = $_POST["member_name"];
   $begin_time = $date." ".$begin;
   $end_time = $date." ".$end;
   
   echo $teacher;
   echo $begin_time;
   echo $end_time;
   echo $date;
   echo $classroom;
   echo $member_name;
   
   
   require("../constant_var_define.php");

    //连接数据库的参数
    $conn = db_connect();
    
    $st = $conn->query("select member_id from member_info_table where member_name='".$member_name."' and card_type='".PERSONAL_COACH_CARD_TYPE."'");
    debug_output("select member_id from member_info_table where member_name='".$member_name."' and card_type='".PERSONAL_COACH_CARD_TYPE."'");
    $rs = $st->fetchAll();
    
    if(!$rs)
        {
           echo "没有该会员或者该会员没有预约私教的权限，请检查会员姓名是否输入正确！";       
        }
    else
        { //显示所有记录
         foreach ($rs as $value) 
          {
                $query_result = $conn->query("insert into personal_class_booking_table(member_id,classroom,begin,end,teacher) values('".$value[0]."','".$classroom."','$begin_time','$end_time','".$teacher."')");
                debug_output("insert into personal_class_booking_table(member_id,classroom,begin,end,teacher) values('".$value[0]."','".$classroom."','$begin_time','$end_time','".$teacher."')");
                if(!$query_result)
                {
                    echo "数据库错误！新增课程失败！请重试！";
                    return;
                }
                echo "私教预约成功！";
          }
        }
            
            

    //关闭数据库
    unset($result);
    unset($query_result);
    
?>