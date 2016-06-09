<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    require("./constant_var_define.php");

    $input_card_id = $_GET['card_id'];
    debug_output("输入的卡号是：".$input_card_id);
    $input_class_id = $_GET['class_id'];
    debug_output("输入的class_id是：".$input_class_id);
    $input_class_begin_time = $_GET['begin_time'];
    debug_output("输入的上课时间是：".$input_class_begin_time);

    //取消限制：两小时内禁止取消
    debug_output("当前时间：".NOW_TIME);
    debug_output("当前时间两小时后是：".date('Y-m-d H:i:s',strtotime("+2 hour")));
    if((date('Y-m-d H:i:s',strtotime("+2 hour"))) > $input_class_begin_time)   //比当前时间多两小时，如果此时间大于课程开始时间，则禁止取消
    {
        echo "已经超出取消截止时间，无法取消！";
        return;
    }

    //连接数据库的参数
    $conn = db_connect();
    
    //从member_info_table中查出member_id和card_type
    $query_result = $conn->query("select member_id,card_type from member_info_table where card_id='".$input_card_id."'");
    debug_output("select member_id,card_type from member_info_table where card_id='".$input_card_id."'");
    $result = $query_result->fetch();
    $db_member_id = $result[0];
    debug_output("从DB中查出的member_id是".$db_member_id);
    $db_card_type = $result[1];
    debug_output("从DB中查出的card_type是".$db_card_type);

    //到class_info_table中查出class_id,max_user_number,selected_user_number
    $query_result = $conn->query("select max_user_number,selected_user_number from class_info_table where class_id=$input_class_id");
    debug_output("select max_user_number,selected_user_number from class_info_table where class_id=$input_class_id");
    $result = $query_result->fetch();
    
    $db_max_user_number = $result[0];
    debug_output("从DB中查出的max_user_number是".$db_max_user_number);
    $db_selected_user_number = $result[1];
    debug_output("从DB中查出的selected_user_number是".$db_selected_user_number);

    //从class_booking_table中根据member_id，class_id找出对应的waiting_No
    $query_result = $conn->query("select waiting_No from class_booking_table where member_id=$db_member_id and class_id=$input_class_id");
    debug_output("select waiting_No from class_booking_table where member_id=$db_member_id and class_id=$input_class_id");
    if(empty($query_result))
    {
        echo "没有查到相应的约课信息！取消失败！";
        return;
    }
    $result = $query_result->fetch();
    $waiting_No = $result[0];
    if($waiting_No != 0)   //处于排队队列，就是没有约课成功，当然也不需要取消！
    {
        echo "此课程没有预约信息，无需取消！";
        return;
    }

    //在取消之前，先到对应的卡信息表中查看本月已经取消过的次数是否已达最大值
    if($db_card_type == TIME_CARD_TYPE) //计时卡
    {
        debug_output("计时卡");
        $query_result = $conn->query("select cancel_times,concrete_card_type from time_card_table where card_id='".$input_card_id."'");
        debug_output("select cancel_times,concrete_card_type from time_card_table where card_id='".$input_card_id."'");
        $result = $query_result->fetch();
        
        $db_cancel_times = $result[0];
        debug_output("从DB中查出的db_cancel_times是".$db_cancel_times);
        $concrete_card_type = $result[1];
        debug_output("从DB中查出的concrete_card_type是".$concrete_card_type);

        //本周已经取消过1次，禁止取消
        if($db_cancel_times >= CANCEL_TIMES_PER_MONTH)
        {
            echo "您本周已达最多取消次数，无法取消！";
            return;
        }
    }
    else if($db_card_type == MEASURED_CARD_TYPE) //计次卡
    {
        debug_output("计次卡");
        $query_result = $conn->query("select cancel_times from measured_card_table where card_id='".$input_card_id."'");
        $result = $query_result->fetch();
        
        $db_cancel_times = $result[0];
        debug_output("从DB中查出的cancel_times是".$db_cancel_times);

        //本周已经取消过1次，禁止取消
        if($db_cancel_times >= CANCEL_TIMES_PER_MONTH)
        {
            echo "您本周已达最多取消次数，无法取消！";
            return;
        }
    }

    //对于要取消的预约，更新该条记录的canceled字段为1，表示此条预约已取消
    $query_result = $conn->query("update class_booking_table set canceled=1 where member_id=$db_member_id and class_id=$input_class_id");
    debug_output("update class_booking_table set canceled=1 where member_id=$db_member_id and class_id=$input_class_id");
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
    
        $query_result = $conn->query("update class_info_table set selected_user_number=$new_selected_user_number where class_id=$input_class_id");
        debug_output("update class_info_table set selected_user_number=$new_selected_user_number where class_id=$input_class_id");
        if(!$query_result)
        {
            //如果此时更新失败，留给以后的容错机制处理，取消流程继续
            debug_output("3.取消失败！数据库错误！");
        }
    }

    //做相应卡的数据恢复
    if($db_card_type == TIME_CARD_TYPE) //计时卡
    {
        debug_output("计时卡");
        $query_result = $conn->query("select used_times,cancel_times,next_used_times from time_card_table where card_id='".$input_card_id."'");
        debug_output("select used_times,cancel_times,next_used_times from time_card_table where card_id='".$input_card_id."'");
        $result = $query_result->fetch();
        
        $db_used_times = $result[0];
        debug_output("从DB中查出的used_times是".$db_used_times);
        $db_cancel_times = $result[1];
        debug_output("从DB中查出的cancel_times是".$db_cancel_times);
        $db_next_used_times = $result[2];
        debug_output("从DB中查出的db_next_used_times是".$db_next_used_times);

        $db_cancel_times++; //本月取消次数增加1次

        if($concrete_card_type != 8)    //非不限次数卡
        {
            //根据课程时间计算出当前是第几周
            $class_week = intval(date('W',strtotime($input_class_begin_time)));
            debug_output("课程是第：".$class_week."周；");
            $this_week = intval(date('W',strtotime(TODAY_DATE)));
            debug_output("今天是第：".$this_week."周；");

            if($class_week == $this_week)   //本周的课程
            {
                if($db_used_times > 0)
                {
                    $db_used_times--;
                }
                //更新到数据库中
                $query_result = $conn->query("update time_card_table set used_times=$db_used_times,cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
                debug_output("update time_card_table set used_times=$db_used_times,cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
                if($conn->errorCode() != '00000')
                {
                    echo "会员卡本周已用次数恢复失败！请截图联系瑜伽馆工作人员，增加本周可上课次数一次并增加一次本周取消次数！";
                    return;
                }
            }
            else if($class_week == ($this_week + 1))   //下周的课程
            {
                if($db_next_used_times > 0)
                {
                    $db_next_used_times--;
                }
                //更新到数据库中
                $query_result = $conn->query("update time_card_table set next_used_times=$db_next_used_times,cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
                debug_output("update time_card_table set next_used_times=$db_next_used_times,cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
                if($conn->errorCode() != '00000')
                {
                    echo "会员卡下周已用次数恢复失败！请截图联系瑜伽馆工作人员，增加下周可上课次数一次并增加一次本周取消次数！";
                    return;
                }
            }
        }
        else
        {
            //更新到数据库中
            $query_result = $conn->query("update time_card_table set cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
            debug_output("update time_card_table set cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
            if($conn->errorCode() != '00000')
            {
                echo "请截图联系瑜伽馆工作人员，增加一次本周取消次数！";
                return;
            }
        }
    }
    else if($db_card_type == MEASURED_CARD_TYPE) //计次卡
    {
        debug_output("计次卡");
        $query_result = $conn->query("select card_status,used_times,max_times,cancel_times from measured_card_table where card_id='".$input_card_id."'");
        debug_output("select card_status,used_times,max_times,cancel_times from measured_card_table where card_id='".$input_card_id."'");
        $result = $query_result->fetch();
        
        $db_card_status = $result[0];
        debug_output("从DB中查出的db_card_status是".$db_card_status);
        $db_used_times = $result[1];
        debug_output("从DB中查出的used_times是".$db_used_times);
        $db_max_times = $result[2];
        debug_output("从DB中查出的max_times是".$db_max_times);
        $db_cancel_times = $result[3];
        debug_output("从DB中查出的cancel_times是".$db_cancel_times);

        if($db_used_times > 0)
        {
            $db_used_times--;
        }
        $db_cancel_times++; //本周取消次数增加1次

        //如果取消之前卡状态是3：无效卡，且used_times==max_times，那么在减少一次使用次数之后，应该恢复卡状态为1：激活
        if(($db_card_status == 3) && ($db_used_times == ($db_max_times - 1)))
        {
            $query_result = $conn->query("update measured_card_table set card_status=1,used_times=$db_used_times,cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
            debug_output("update measured_card_table set card_status=1,used_times=$db_used_times,cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
            if($conn->errorCode() != '00000')
            {
                echo "会员卡已用次数恢复失败！请截图联系瑜伽馆工作人员！";
                return;
            }
        }
        else
        {
            $query_result = $conn->query("update measured_card_table set used_times=$db_used_times,cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
            debug_output("update measured_card_table set used_times=$db_used_times,cancel_times=$db_cancel_times where card_id='".$input_card_id."'");
            if($conn->errorCode() != '00000')
            {
                echo "会员卡已用次数恢复失败！请截图联系瑜伽馆工作人员！";
                return;
            }
        }
    }
    //到此“取消”流程结束
    echo "取消成功！";
    return;
/***************************************************************************************

下面是通知等待的会员，因为没有发送微信消息的权限，下面的部分暂时无法调试
等后续调试时，把上面的return要删掉。

***************************************************************************************/
    //查找此class_id对应的预约信息，是否有会员在排队等待
    $query_result = $conn->query("select * from class_booking_table where class_id=$input_class_id order by waiting_No");
    debug_output("select * from class_booking_table where class_id=$input_class_id order by waiting_No");
    $result = $query_result->fetch();
    if(empty($result))  //没有预约此节课的会员
    {
        return;
    }

    foreach($result as $value)
    {
        $db_waiting_No = $value[2]; //等待编号
        if($db_waiting_No == 0) //不是在等待的会员，不做处理
        {
            continue;
        }
        else if($db_waiting_No > 0)
        {
            $new_waiting_No = $db_waiting_No - 1;
            //将新的waiting_No更新到数据库
            $update_result = $conn->query("update class_booking_table set waiting_No=$new_waiting_No where class_id=$input_class_id and member_id=$value[1]");
            debug_output("update class_booking_table set waiting_No=$new_waiting_No where class_id=$input_class_id and member_id=$value[1]");
        }

        if($db_waiting_No == 1)
        {
            //通知处在第一个等待的会员
            //to be done... 因为没有微信发消息的权限
        }
    }
?>