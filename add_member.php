<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
    require("./constant_var_define.php");

    //获取前端用户输入的数据
    $open_id = $_POST["openid"];
	$location = $_POST["location"];
    debug_output("前端用户产生的open_id是：".$open_id);
    debug_output("前端用户产生的location是：".$location);
    if(empty($open_id))    //判断open_id是否获取到
    {
        page_output("black", 15, "未获取到open ID，注册失败！");
        return;
    }
	


    $card_id = $_POST["card_id"];    //card_id和phone由前端保证不为空
    debug_output("前端用户输入的card_id是：".$card_id);
    $phone = $_POST["phone"];
    debug_output("前端用户输入的phone是：".$phone);

    $dbcon = db_connect();
    
	
	 if ($location == 2)
	   {
		 
			//从数据库中查出会员卡号对应的手机号，看是否匹配
			$query_result = $dbcon->query("select phone from member_info_table where card_id='".$card_id."'");
			debug_output("select phone from member_info_table where card_id='".$card_id."'");
			$result = $query_result->fetch();
			$phone_inDB = $result[0];
			debug_output("从数据库中读出的phone是".$phone_inDB);
			
			if(!isset($phone_inDB))
			{
				page_output("black", 15, "在系统中没有找到您的会员卡号，请联系瑜伽馆工作人员！");
				return;
			}
			else if(strcmp($phone_inDB, $phone) != 0)   //输入的手机号和数据库中的不匹配
			{
				page_output("black", 15, "您输入的手机号和办卡时的手机号不一致，请重新输入！");
				return;
			}
			
			//如果数据库中的数据和用户输入一致，则看此条记录中的open_id是否存在
			$query_result = $dbcon->query("select open_id from member_info_table where card_id='".$card_id."'");
			$result = $query_result->fetch();
			$open_id_inDB = $result[0];
			debug_output("从数据库中读出的open_id是".$open_id_inDB);
			
			if(!empty($open_id_inDB))    //假如DB中此条记录已经有open_id
			{
				if(strcmp($open_id_inDB, $open_id) == 0)    //用户本次绑定时产生的open_id和DB中一致
				{
					page_output("black", 15, "您的微信已经和此会员卡绑定过，无需再次绑定！");
					debug_output("<br/>open_id".$open_id);
					return;
				}
				else    //用户本次绑定时产生的open_id和DB中不一致
				{
					page_output("black", 15, "您输入的会员卡号已经和其他微信绑定，请先解除绑定或联系瑜伽馆人员！");
					return;
				}
			}
			
			//DB中此条记录的open_id为空，可以绑定；再继续判断此open_id是否已经和其他会员卡绑定过
			$query_result = $dbcon->query("select card_id from member_info_table where open_id='".$open_id."'");
			debug_output("select card_id from member_info_table where open_id='".$open_id."'");
			$result = $query_result->fetchAll();
			$card_id_inDB  = $result[0][0]; //此open_id绑定过的会员卡号
			debug_output("绑定过的卡号是".$card_id_inDB);
			
			if(!empty($card_id_inDB))    //数据库中找到此open_id绑定的会员卡号
			{
				page_output("black", 15, "您的微信已经和卡号".$card_id_inDB."绑定过，请先解除绑定或联系瑜伽馆人员！");
				return;
			}
			
			//DB中，此条记录的open_id为空，且本次产生的open_id也没有和其他会员卡绑定过，则将此open_id更新到相应的记录中
			$query_result = $dbcon->query("update member_info_table set open_id='".$open_id."' where card_id='".$card_id."'");
			debug_output("update member_info_table set open_id='".$open_id."' where card_id='".$card_id."'");
			if(!$query_result)
			{
				page_output("black", 15, "数据库错误！微信绑定失败！请重试！");
				return;
			}

			page_output("black", 15, "恭喜您！绑定成功！");
			page_output("black", 15, "您现在可以去预约课程啦！");
	   }
	  else if( $location == 1)
	    {
			//从数据库中查出会员卡号对应的手机号，看是否匹配
			$query_result = $dbcon->query("select phone from member_info_table_cui where card_id='".$card_id."'");
			debug_output("select phone from member_info_table_cui where card_id='".$card_id."'");
			$result = $query_result->fetch();
			$phone_inDB = $result[0];
			debug_output("从数据库中读出的phone是".$phone_inDB);
			
			if(!isset($phone_inDB))
			{
				page_output("black", 15, "在系统中没有找到您的会员卡号，请联系瑜伽馆工作人员！");
				return;
			}
			else if(strcmp($phone_inDB, $phone) != 0)   //输入的手机号和数据库中的不匹配
			{
				page_output("black", 15, "您输入的手机号和办卡时的手机号不一致，请重新输入！");
				return;
			}
			
			//如果数据库中的数据和用户输入一致，则看此条记录中的open_id是否存在
			$query_result = $dbcon->query("select open_id from member_info_table_cui where card_id='".$card_id."'");
			$result = $query_result->fetch();
			$open_id_inDB = $result[0];
			debug_output("从数据库中读出的open_id是".$open_id_inDB);
			
			if(!empty($open_id_inDB))    //假如DB中此条记录已经有open_id
			{
				if(strcmp($open_id_inDB, $open_id) == 0)    //用户本次绑定时产生的open_id和DB中一致
				{
					page_output("black", 15, "您的微信已经和此会员卡绑定过，无需再次绑定！");
					debug_output("<br/>open_id".$open_id);
					return;
				}
				else    //用户本次绑定时产生的open_id和DB中不一致
				{
					page_output("black", 15, "您输入的会员卡号已经和其他微信绑定，请先解除绑定或联系瑜伽馆人员！");
					return;
				}
			}
			
			//DB中此条记录的open_id为空，可以绑定；再继续判断此open_id是否已经和其他会员卡绑定过
			$query_result = $dbcon->query("select card_id from member_info_table_cui where open_id='".$open_id."'");
			debug_output("select card_id from member_info_table_cui where open_id='".$open_id."'");
			$result = $query_result->fetchAll();
			$card_id_inDB  = $result[0][0]; //此open_id绑定过的会员卡号
			debug_output("绑定过的卡号是".$card_id_inDB);
			
			if(!empty($card_id_inDB))    //数据库中找到此open_id绑定的会员卡号
			{
				page_output("black", 15, "您的微信已经和卡号".$card_id_inDB."绑定过，请先解除绑定或联系瑜伽馆人员！");
				return;
			}
			
			//DB中，此条记录的open_id为空，且本次产生的open_id也没有和其他会员卡绑定过，则将此open_id更新到相应的记录中
			$query_result = $dbcon->query("update member_info_table_cui set open_id='".$open_id."' where card_id='".$card_id."'");
			debug_output("update member_info_table_cui set open_id='".$open_id."' where card_id='".$card_id."'");
			if(!$query_result)
			{
				page_output("black", 15, "数据库错误！微信绑定失败！请重试！");
				return;
			}

			page_output("black", 15, "恭喜您！绑定成功！");
			page_output("black", 15, "您现在可以去预约课程啦！");
		}
	  else
		  echo "请确定您的会馆是否选择正确！";
?>
