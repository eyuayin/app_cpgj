<?php

$member_name = $_POST['meb'];

//$classroom =$_POST['classroom'];
$begin =$_POST['begin'];  //为了check会员卡是否过期
//$end =$_POST['end'];
//$teacher =$_POST['teacher'];


$class_id =$_POST['class_id'];

$date = substr($begin,0,10);
echo "begin tims is:".$begin;
//echo "end tims is:".$end;
//echo "teacher is:".$teacher;
//echo "classroom is:".$classroom;

echo "begin tims is:".$date;
echo "class_id is:".$class_id;

 require("../constant_var_define.php");

    //连接数据库的参数
    $conn = db_connect();
        
     
    $st = $conn->query("select card_type,card_id,member_id from member_info_table_cui where member_name='".$member_name."'");
    //debug_output("select card_type,card_id,member_id from member_info_table_cui where member_name='".$member_name."' ");
    $rs = $st->fetchAll();
 
    if(!$rs)
        {
           echo "该会员不存在，请检查会员姓名是否输入正确！";       
        }
    else 
		{
			 foreach($rs as $value)
			{
				if($value[0] == 1)
				{
					echo "时间卡会员无权预约此课程！";
					continue;
				}
				else if($value[0] == 2)
				{
					 $st = $conn->query("select concrete_card_type,card_status,valid_begin_date,valid_end_date,pause_begin_date,pause_end_date,used_times,max_times from measured_card_table_cui where card_id=$value[1]");
					 
					 //debug_output("select concrete_card_type,card_status,valid_begin_date,valid_end_date,pause_begin_date,pause_end_date,used_times,max_times from measured_card_table_cui where card_id=$value[1]"); 
					 $st = $st->fetchAll();
					 if ($st[0][0] != 10)
					 {
						 echo "该会员卡卡号".$value[1]."不是精品课卡！";
						 continue;
					 }
					 else if($st[0][1] != 1)
					 {
						 echo "该会员卡没有激活！";
						 continue;
					 }
					 else if($st[0][2] > $date || $st[0][3] < $date)
					 {
						 echo "begin is:".$st[0][2];
                         echo "date is:".$date;	
                         echo "end is:".$st[0][3];						 
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
                        //判断该会员是否约过课
                         $query_result = $conn->query("select member_id from min_class_booking_table_cui where class_id=$class_id");
                         //debug_output("select member_id from min_class_booking_table_cui where class_id=$class_id");
                         $st = $query_result->fetch();
                         foreach($st as $id)
                         {
                             if($id != $value[2])
                             {
                                 continue;   
                             }
                             else
                             {
                                 echo "此会员已约过此课，无需重复预约！";
                                 return;
                             } 
                             
                         }
                         
						 $query_result = $conn->query("insert into min_class_booking_table_cui(member_id,class_id) values('".$value[2]."',$class_id)");
							//debug_output("insert into min_class_booking_table_cui(member_id,class_id) values('".$value[2]."',$class_id)");
							if(!$query_result)
							{
								echo "数据库错误！新增课程失败！请重试！";
								continue;
							}
							echo "卡号为".$value[1]."的卡预约成功！"; 
                     }
						 
				}
				
				   
				
			}
			
		}
	   
    
            
            

    //关闭数据库
    unset($result);
    unset($query_result);
    



?>