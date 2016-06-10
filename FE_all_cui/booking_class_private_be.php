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
        
     
    $st = $conn->query("select card_type,card_id,member_id from member_info_table_cui where member_name='".$member_name."' ");
    debug_output("select card_type,card_id,member_id from member_info_table_cui where member_name='".$member_name."' ");
    $rs = $st->fetchAll();
    
    if(!$rs)
        {
           echo "该会员不存在，请检查会员姓名是否输入正确！";       
        }
    else 
		{
			 foreach($rs as $value)
			{
				if($value[0] == 1) //卡类型为时间卡
				{
					echo "时间卡会员无权预约此课程！";
					continue;
				}
				else if($value[0] == 2) //卡类型为次卡
				{
					 $st = $conn->query("select concrete_card_type,card_status,valid_begin_date,valid_end_date,pause_begin_date,pause_end_date,used_times,max_times from measured_card_table_cui where card_id=$value[1]");
					 
					 debug_output("select concrete_card_type,card_status,valid_begin_date,valid_end_date,pause_begin_date,pause_end_date,used_times,max_times from measured_card_table_cui where card_id=$value[1]"); 
					 $st = $st->fetchAll();
					 if ($st[0][0] != 9) //具体卡类型不为私教卡
					 {
						 echo $st[0][0]."该会员卡不是私教卡！";
						 continue;
					 }
					 else if($st[0][1] != 1)
					 {
						 echo "该会员卡没有激活！";
						 continue;
					 }
					 else if($st[0][2] > $date || $st[0][3] < $date)
					 {
						 echo $st[0][2];
                         echo $date;	
                         echo $st[0][3];						 
						 echo "此会员卡过期！";
						 continue;
					 }
					 else if($st[0][4] < $date && $st[0][5] > $date)
					 {
						 echo "该会员卡已停卡！";
						 continue;
					 }
					 else if($st[0][6] >= $st[0][7] )
					 {
						 echo "该会员卡次数已用完！";
						 continue;
					 }
					 else
					 {
                         //确认预约时段和教室是否空闲
                          $sr = $conn->query("select * from personal_class_booking_table_cui where classroom='".$classroom."' and (('".$begin_time."'>= class_begin_time and '".$end_time."' <= class_end_time) or ('".$begin_time."' <= class_begin_time and '".$end_time."' >= class_begin_time) or ('".$begin_time."' <= class_end_time and '".$end_time."' >= class_end_time) or ('".$begin_time."' <= class_begin_time and '".$end_time."' >= class_end_time))");
                          
                          debug_output("select * from personal_class_booking_table_cui where classroom='".$classroom."' and (('".$begin_time."'>= class_begin_time and '".$end_time."' <= class_end_time) or ('".$begin_time."' <= class_begin_time and '".$end_time."' >= class_end_time) or ('".$begin_time."' <= class_end_time and '".$end_time."' >= class_end_time) or ('".$begin_time."' <= class_begin_time and '".$end_time."' >= class_end_time))");
                            
                          $rt = $sr->fetch();
                          
                            if($rt) //如果该教室在该时段被占用
                            {
                                echo "此教室在此时段忙，请选择其它教室！";
                                break;
                            }
                            
                            
                            $query_result = $conn->query("insert into personal_class_booking_table_cui(member_id,classroom,class_begin_time,class_end_time,teacher) values('".$value[2]."','".$classroom."','$begin_time','$end_time','".$teacher."')");
							debug_output("insert into personal_class_booking_table_cui(member_id,classroom,begin,end,teacher) values('".$value[2]."','".$classroom."','$begin_time','$end_time','".$teacher."')");
							if(!$query_result)
							{
								echo "数据库错误！新增课程失败！请重试！";
								return;
							}
							echo "私教预约成功！"; 
								 }
						 
				}
				
				   
				
			}
			
		}
	   
    
            
            

    //关闭数据库
    unset($result);
    unset($query_result);
    
?>