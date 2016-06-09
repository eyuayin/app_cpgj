<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    require("../constant_var_define.php");

    $input_card_id = $_GET['card_id'];
    debug_output("输入的卡号是：".$input_card_id);
    $input_class_id = $_GET['class_id'];
    debug_output("输入的课程ID是：".$input_class_id);
    $input_class_begin_time = $_GET['begin_time'];
    debug_output("输入的上课时间是：".$input_class_begin_time);

    //取消限制：两小时内禁止取消
//    debug_output("当前时间：".NOW_TIME);
//    debug_output("当前时间两小时后是：".date('Y-m-d H:i:s',strtotime("+2 hour")));
//    if((date('Y-m-d H:i:s',strtotime("+2 hour"))) > $input_class_begin_time)   //比当前时间多两小时，如果此时间大于课程开始时间，则禁止取消
//    {
//        echo "已经超出取消截止时间，无法取消！";
//        return;
//    }

    $conn = db_connect();
    
    //从personal_coach_card_table中查出member_id
    $query_result = $conn->query("select member_id from personal_coach_card_table where personal_coach_card_id='".$input_card_id."'");
    debug_output("select member_id from personal_coach_card_table where personal_coach_card_id='".$input_card_id."'");
    $result = $query_result->fetch();
    $db_member_id = $result[0];
    debug_output("从DB中查出的member_id是".$db_member_id);
    if(empty($db_member_id))
    {
        echo "没有找到对应的会员信息！取消失败！";
        return;
    }

    //到personal_class_info_table中查出max_user_number,selected_user_number
    $query_result = $conn->query("select max_user_number,selected_user_number from personal_class_info_table where class_id=$input_class_id");
    debug_output("select max_user_number,selected_user_number from personal_class_info_table where class_id=$input_class_id");
    $result = $query_result->fetch();
    
    $db_max_user_number = $result[0];
    debug_output("从DB中查出的max_user_number是".$db_max_user_number);
    $db_selected_user_number = $result[1];
    debug_output("从DB中查出的selected_user_number是".$db_selected_user_number);
    if(empty($db_max_user_number))
    {
        echo "没有查询到课程信息！取消失败！";
        return;
    }

    //从personal_class_booking_table中根据member_id，class_id找出对应的waiting_No
    $query_result = $conn->query("select count(*) from personal_class_booking_table where member_id=$db_member_id and class_id=$input_class_id and canceled=0");
    debug_output("select count(*) from personal_class_booking_table where member_id=$db_member_id and class_id=$input_class_id and canceled=0");
    if(empty($query_result))
    {
        echo "没有查到相应的约课信息！取消失败！";
        return;
    }

    //在取消之前，先到私教卡表中查看本周已经取消过的次数是否已达最大值
//    if($db_card_type == TIME_CARD_TYPE) //计时卡
//    {
//        debug_output("计时卡");
//        $query_result = $conn->query("select concrete_card_type from time_card_table where card_id='".$input_card_id."'");
//        debug_output("select concrete_card_type from time_card_table where card_id='".$input_card_id."'");
//        $result = $query_result->fetch();
//        
//        $concrete_card_type = $result[0];
//        debug_output("从DB中查出的concrete_card_type是".$concrete_card_type);
//
//    }


    //对于要取消的预约，更新该条记录的canceled字段为1，表示此条预约已取消
    $query_result = $conn->query("update personal_class_booking_table set canceled=1 where member_id=$db_member_id and class_id=$input_class_id");
    debug_output("update personal_class_booking_table set canceled=1 where member_id=$db_member_id and class_id=$input_class_id");
    if($conn->errorCode() != '00000')
    {
        debug_output("1.取消失败！数据库错误！");
        echo "取消失败！数据库错误！错误码：0x0001";
        return;
    }
    debug_output("取消预约课程信息成功！");

    //class_info_table中取消成功，对selected_user_number减1
    if($db_selected_user_number > 0)
    {
        $new_selected_user_number = $db_selected_user_number - 1;
    
        $query_result = $conn->query("update personal_class_info_table set selected_user_number=$new_selected_user_number where class_id=$input_class_id");
        debug_output("update personal_class_info_table set selected_user_number=$new_selected_user_number where class_id=$input_class_id");
        if(!$query_result)
        {
            //如果此时更新失败，留给以后的容错机制处理，取消流程继续
            debug_output("3.取消失败！数据库错误！");
        }
    }

    debug_output("私教卡");
    $query_result = $conn->query("select card_status,used_times,max_times from personal_coach_card_table where personal_coach_card_id='".$input_card_id."'");
    debug_output("select card_status,used_times,max_times from personal_coach_card_table where personal_coach_card_id='".$input_card_id."'");
    $result = $query_result->fetch();
    
    $db_card_status = $result[0];
    debug_output("从DB中查出的db_card_status是".$db_card_status);
    $db_used_times = $result[1];
    debug_output("从DB中查出的used_times是".$db_used_times);
    $db_max_times = $result[2];
    debug_output("从DB中查出的max_times是".$db_max_times);

    if($db_used_times > 0)
    {
        $db_used_times--;
    }

    //如果取消之前卡状态是3：无效卡，且used_times==max_times，那么在减少一次使用次数之后，应该恢复卡状态为1：激活
    if(($db_card_status == 3) && ($db_used_times == ($db_max_times - 1)))
    {
        $query_result = $conn->query("update personal_coach_card_table set card_status=1,used_times=$db_used_times where personal_coach_card_id='".$input_card_id."'");
        debug_output("update personal_coach_card_table set card_status=1,used_times=$db_used_times where personal_coach_card_id='".$input_card_id."'");
        if($conn->errorCode() != '00000')
        {
            echo "私教卡：".$input_card_id."已用次数恢复失败！请手动增加可用次数一次！并将会员卡置为激活状态！";
            return;
        }
    }
    else
    {
        $query_result = $conn->query("update personal_coach_card_table set used_times=$db_used_times where personal_coach_card_id='".$input_card_id."'");
        debug_output("update personal_coach_card_table set used_times=$db_used_times where personal_coach_card_id='".$input_card_id."'");
        if($conn->errorCode() != '00000')
        {
            echo "私教卡：".$input_card_id."已用次数恢复失败！请手动增加可用次数一次！";
            return;
        }
    }

    //到此“取消”流程结束
    echo "私教课取消成功！";

?>