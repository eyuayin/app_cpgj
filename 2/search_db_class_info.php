<?php
    require("./constant_var_define.php");

    //用户输入时间和会馆
    $get_day=$_POST['day'];
	$get_location=$_POST['location'];
	
	if($get_location == 1)
	{
		return;
	}
	
	else
	{
			
			//echo $get_day;
			if(empty($get_day))
			{      
				return;
			}
			 /*
			$current_date = date("Y-m-d",strtotime('0 day')); //当前日期
			$current_time = date("Y-m-d H:i:s",strtotime('0 day'));//当前时间
			$tomorrow_date= date('Y-m-d',strtotime("1 day"));//明天日期
			$tomorrow_begin_time = date('Y-m-d 00:00:00',strtotime("1 day"));//明天开始时间
			$after_tomorrow_date = date('Y-m-d',strtotime("2 day"));//后天日期
			$after_after_tomorrow_date = date('Y-m-d',strtotime("3 day"));//大后天日期
			$after_tomorrow_begin_time = date('Y-m-d 00:00:00',strtotime("2 day"));//后天开始时间
			$after_tomorrow_over_time = date('Y-m-d 23:59:59',strtotime("2 day"));//后天结束时间
			$after_after_tomorrow_begin_time = date('Y-m-d 00:00:00',strtotime("3 day"));//大后天开始时间
			$after_after_tomorrow_over_time = date('Y-m-d 23:59:59',strtotime("3 day"));//大后天结束时间
			*/
			
			//连接数据库
			try
			{
				$conn =  db_connect();
			}
			catch(Exception $e)
			{
				return;
			}
			
			/*
			if(strtotime($current_date)==strtotime($get_day))
			{
				$st = $conn->query("select class_begin_time,class_name,class_id from class_info_table where class_begin_time between '".$current_time."' and '".$tomorrow_begin_time."'");
				//echo $current_time,$tomorrow_begin_time;
			}
			else if(strtotime($tomorrow_date)==strtotime($get_day))
			{
				$st = $conn->query("select class_begin_time,class_name,class_id from class_info_table where class_begin_time between '".$tomorrow_begin_time."' and '".$after_tomorrow_begin_time."'");
			}
			else if(strtotime($after_tomorrow_date)==strtotime($get_day))
			{
				$st = $conn->query("select class_begin_time,class_name,class_id from class_info_table where class_begin_time between '".$after_tomorrow_begin_time."' and '".$after_tomorrow_over_time."'");
			}
			else if(strtotime($after_after_tomorrow_date)==strtotime($get_day))
			{
				$st = $conn->query("select class_begin_time,class_name,class_id from class_info_table where class_begin_time between '".$after_after_tomorrow_begin_time."' and '".$after_after_tomorrow_over_time."'");
			}
			else
			{
				return;
			}
			
			*/
			
			//用户输入天0点
			$get_day_begin_time = $get_day." "."00:00:00";
			//echo "begin:".$get_day_begin_time;
			//用户输入天12点
			$get_day_end_time = $get_day." "."23:59:59";
			//echo "end time:".$get_day_end_time;
			$st = $conn->query("select class_begin_time,class_name,class_id from class_info_table where class_begin_time between '".$get_day_begin_time."' and '".$get_day_end_time."'");


			//获得结果集，结果集就是一个二维数组
			$rs = $st->fetchAll();
			
			$info = array();
			$userinfo = array();

			$i=0;

			foreach($rs as $value)
			{
				//组成时间：课程编号键值对数组
				$info[$value[0]]=$value[1]." ".$value[2];
			}
			//var_dump($info);
			foreach($info as $key => $value)
			{
				// 组成编号：课程时间 课程名的键值对
				//$userinfo[$i]=$key." ".$class_num_to_name[$value];
				$key=substr($key,11);
				$userinfo[$i]=$key." ".$value;
				$i++;
			}

			//var_dump($userinfo);
			$userinfo_json = json_encode($userinfo);
			echo $userinfo_json;
    } 
?>