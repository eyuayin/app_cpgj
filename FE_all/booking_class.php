
<?php

    require("../constant_var_define.php");

    //获取用户输入信息
    $input_card_id = $_POST["card_id"];
    debug_output("输入的会员卡号是：".$input_card_id);
    $input_name = $_POST["name"];
    debug_output("输入的名字是：".$input_name);
    $input_class_id = $_POST["class_id"];
    debug_output("输入的class_id是：".$input_class_id);
    $input_if_waiting = $_POST['whetherWait']; //用户在课程已满的情况下是否同意加入等待队列 1:是 2：否
    debug_output("输入的whetherWait是：".$input_if_waiting);
    
    $book_mode = 0;
    if(empty($input_card_id) && empty($input_name))
    {
        echo "请输入姓名或卡号！";
        return;
    }

    if(empty($input_card_id))
    {
        debug_output("按照姓名预约！");
        $book_mode = "BOOK_MODE_NAME";
    }
    else if(empty($input_name))
    {
        debug_output("按照卡号预约！");
        $book_mode = "BOOK_MODE_CARD";
    }

    $conn = db_connect();
    
    /*if(($input_card_id == 1) || ($input_name == '体验号'))
    {
        if($book_mode == BOOK_MODE_CARD)    //按照卡号查询
        {
            $query_result = $conn->query("select member_id from member_info_table where card_id='".$input_card_id."'");
            $result = $query_result->fetch();
            $db_member_id = $result[0];
        }
        else if($book_mode == BOOK_MODE_NAME)   //按照姓名查询
        {
            $query_result = $conn->query("select member_id from member_info_table where member_name='".$input_name."'");
            $result = $query_result->fetch();
            $db_member_id = $result[0];
        }

        debug_output("体验会员卡！");
        //根据class_id获取到class_priority,max_user_number,selected_user_number相应课程信息
        $query_result = $conn->query("select max_user_number,selected_user_number from class_info_table where class_id=$input_class_id");
        debug_output("select max_user_number,selected_user_number from class_info_table where class_id=$input_class_id");
        $result = $query_result->fetch();
        $max_user_number = $result[0];
        debug_output("从DB中查出的max_user_number是".$max_user_number);
        $selected_user_number = $result[1];
        debug_output("从DB中查出的selected_user_number是".$selected_user_number);

        if(empty($max_user_number))  //没有查到课程ID
        {
            echo "没有查到预约的课程信息！预约失败";
            return;
        }
        
        if($max_user_number <= $selected_user_number)   //课程已满，体验会员不考虑等待选项
        {
            echo "本节课程人数已满！";
            return;
        }

        $selected_user_number++;
        $query_result = $conn->query("update class_info_table set selected_user_number=$selected_user_number where class_id=$input_class_id");
        debug_output("update class_info_table set selected_user_number=$selected_user_number where class_id=$input_class_id");
        if($conn->errorCode() != '00000')
        {
            echo "数据库错误！预约失败！请重试！";
            return;
        }

        //选课成功，将数据插入到数据库
        $query_result = $conn->query("insert into class_booking_table values($input_class_id, $db_member_id, 0, 0)");
        debug_output("insert into class_booking_table values($input_class_id, $db_member_id, 0, 0)");
        if($conn->errorCode() != '00000')
        {
            echo "数据库错误！预约失败！请重试！";
            return;
        }
        echo "恭喜您！课程预约成功！";
    }
    else
    {*/
        $db_member_id = 0;
        $db_card_type = 0;

        if($book_mode == "BOOK_MODE_CARD")    //按照卡号预约
        {
            //根据card_id查出member_id和card_type
            debug_output("按照卡号预约！");
            $query_result = $conn->query("select member_id,card_type from member_info_table where card_id='".$input_card_id."'");
            debug_output("select member_id,card_type from member_info_table where card_id='".$input_card_id."'");
            $result = $query_result->fetch();
            $db_member_id = $result[0];
            debug_output("从DB中查出的member_id是".$db_member_id);
            $db_card_type = $result[1];
            debug_output("从DB中查出的card_type是".$db_card_type);
        }
        else if($book_mode == "BOOK_MODE_NAME")   //按照姓名预约
        {
            //根据name查出member_id和card_type
            debug_output("按照姓名预约！");
            $query_result = $conn->query("select member_id,card_type,card_id from member_info_table where member_name='".$input_name."'");
            debug_output("select member_id,card_type from member_info_table where member_name='".$input_name."'");
            $result = $query_result->fetch();
            $db_member_id = $result[0];
            debug_output("从DB中查出的member_id是".$db_member_id);
            $db_card_type = $result[1];
            debug_output("从DB中查出的card_type是".$db_card_type);
            $input_card_id = $result[2];
            debug_output("从DB中查出的card_id是".$input_card_id);
        }
        
        if($db_card_type == TIME_CARD_TYPE) //计时卡
        {
            debug_output("计时卡");
            $query_result = $conn->query("select card_status,card_priority,used_times,max_times,next_used_times,concrete_card_type,valid_begin_date,valid_end_date,pause_begin_date,pause_end_date from time_card_table where card_id='".$input_card_id."'");
            debug_output("select card_status,card_priority,used_times,max_times,next_used_times,concrete_card_type,valid_begin_date,valid_end_date,pause_begin_date,pause_end_date from time_card_table where card_id='".$input_card_id."'");
            $result = $query_result->fetch();
            
            $db_card_status = $result[0];
            debug_output("从DB中查出的card_status是".$db_card_status);
            $db_card_priority = $result[1];
            debug_output("从DB中查出的card_priority是".$db_card_priority);
            $db_used_times = $result[2];
            debug_output("从DB中查出的used_times是".$db_used_times);
            $db_max_times = $result[3];
            debug_output("从DB中查出的max_times是".$db_max_times);
            $db_next_used_times = $result[4];
            debug_output("从DB中查出的next_used_times是".$db_next_used_times);
            $concrete_card_type = $result[5];
            debug_output("从DB中查出的concrete_card_type是".$concrete_card_type);
            $valid_begin_date = $result[6];
            debug_output("从DB中查出的valid_begin_date是".$valid_begin_date);
            $valid_end_date = $result[7];
            debug_output("从DB中查出的valid_end_date是".$valid_end_date);
            $pause_begin_date = $result[8];
            debug_output("从DB中查出的pause_begin_date是".$pause_begin_date);
            $pause_end_date = $result[9];
            debug_output("从DB中查出的pause_end_date是".$pause_end_date);
            
        }
        
        else if($db_card_type == MEASURED_CARD_TYPE) //计次卡
        {
            debug_output("计次卡");
            $query_result = $conn->query("select card_status,card_priority,used_times,max_times from measured_card_table where card_id='".$input_card_id."'");
            debug_output("select card_status,card_priority,used_times,max_times from measured_card_table where card_id='".$input_card_id."'");
            $result = $query_result->fetch();
            
            $db_card_status = $result[0];
            debug_output("从DB中查出的card_status是".$db_card_status);
            $db_card_priority = $result[1];
            debug_output("从DB中查出的card_priority是".$db_card_priority);
            $db_used_times = $result[2];
            debug_output("从DB中查出的used_times是".$db_used_times);
            $db_max_times = $result[3];
            debug_output("从DB中查出的max_times是".$db_max_times);
        }
        
        if($db_card_status != 1)   //卡是非激活状态
        {
            echo "您的会员卡没有激活！请联系瑜伽馆工作人员！";
            return;
        }
        
       
        
        
        //根据class_id获取到class_priority,max_user_number,selected_user_number,class_begin_time相应课程信息
        $query_result = $conn->query("select class_priority,max_user_number,selected_user_number,class_begin_time from class_info_table where class_id=$input_class_id");
        debug_output("select class_priority,max_user_number,selected_user_number,class_begin_time from class_info_table where class_id=$input_class_id");
        $result = $query_result->fetch();

        $class_priority = $result[0];
        debug_output("从DB中查出的class_priority是".$class_priority);
        $max_user_number = $result[1];
        debug_output("从DB中查出的max_user_number是".$max_user_number);
        $selected_user_number = $result[2];
        debug_output("从DB中查出的selected_user_number是".$selected_user_number);
        $db_class_begin_time = $result[3];
        debug_output("从DB中查出的class_begin_time是".$db_class_begin_time);

        if(empty($max_user_number))  //没有查到课程ID
        {
            echo "没有查到预约的课程信息！预约失败";
            return;
        }

        if($db_card_type == TIME_CARD_TYPE) //计时卡
        {
            if($concrete_card_type == 8)    //不限次数卡
            {
                //算出要预约课程的日期
                $class_date = substr($db_class_begin_time, 0, 10);
                $book_begin_time = $class_date." 00:00:00";
                $book_end_time = $class_date." 23:59:59";
                //查出预约课程日期所有的class_id
                $query_result = $conn->query("select class_id from class_info_table where class_begin_time>'".$book_begin_time."' and class_begin_time<'".$book_end_time."'");
                debug_output("select class_id from class_info_table where class_begin_time>'".$book_begin_time."' and class_begin_time<'".$book_end_time."'");
                $result = $query_result->fetchAll();

                //在class_booking_table中查询，如果有此member_id对应的class_id，则表示该会员已经已约过当天的课程，不能再预约其他课程
                foreach($result as $each_class_id)
                {
                    $query_result = $conn->query("select count(*) from class_booking_table where class_id='".$each_class_id[0]."' and member_id='".$db_member_id."' and waiting_No=0 and canceled=0");
                    debug_output("select count(*) from class_booking_table where class_id='".$each_class_id[0]."' and member_id='".$db_member_id."' and waiting_No=0 and canceled=0");

                    $search_result = $query_result->fetch();
                    if($search_result[0] > 0)  //表示该会员选过改课程，且不是在等待队列
                    {
                        echo "您已经预约过当天的课程，无法再预约".$class_date."日的课程";
                        return;
                    }
                }
            }
            else
            {
                //根据课程时间计算出当前是第几周
                $class_date = substr($db_class_begin_time, 0, 10);
                $class_week = intval(date('W',strtotime($class_date)));
                debug_output("课程是第：".$class_week."周；");
                $this_week = intval(date('W',strtotime(TODAY_DATE)));
                debug_output("今天是第：".$this_week."周；");

                if($class_week == $this_week)   //本周的课程
                {
                    if($db_used_times >= $db_max_times)   //次数已用完
                    {
                        echo "您的会员卡次数已用完！无法预约课程！";
                        return;
                    }
                    $which_week = 1;
                }
                else if($class_week == ($this_week + 1))   //下周的课程
                {
                    if($db_next_used_times >= $db_max_times)   //下周课程次数已用完
                    {
                        echo "您的会员卡次数已用完！无法预约课程！";
                        return;
                    }
                    $which_week = 2;
                }
                //else    //其他周的课程，按逻辑不可能选择到
                //{
                //    echo "预约出错，请联系瑜伽馆工作人员！";
               //     echo $class_week;
                //    return;
               // }
            }
            
            //判断会员卡有效日期是否在预约日期内
            if($class_date<$valid_begin_date || $class_date > $valid_end_date) //会员卡不在有效期内
            {
                echo "预约日期不在该会员卡的有效范围内，无法预约！";
                return;
            }
            
            if($class_date>=$pause_begin_date && $class_date <= $pause_end_date) //会员卡停卡
            {
                echo "该会员卡已停卡，无法预约！";
                return;
            }
            
            
        }
        else if($db_card_type == MEASURED_CARD_TYPE) //计次卡
        {
            if($db_used_times >= $db_max_times)   //次数已用完
            {
                echo "您的会员卡次数已用完！无法预约课程！<br />";
                return;
            }
        }

        if($class_priority < $db_card_priority)    //此用户没有权限选此课程
        {
            echo "此会员卡没有权限预约此课程！";
            return;
        }
        
        if(($max_user_number <= $selected_user_number) && ($input_if_waiting != 1))   //课程已满，客户不愿与等待，则流程结束
        {
            echo "本节课程人数已满！";
            return;
        }

        //避免重复选课
        $query_result = $conn->query("select waiting_No from class_booking_table where class_id=$input_class_id and member_id=$db_member_id and canceled=0");
        debug_output("select waiting_No from class_booking_table where class_id=$input_class_id and member_id=$db_member_id and canceled=0");
        $result = $query_result->fetch();
        if(!empty($result)) //查到数据，表示该会员已经选过此课程
        {
            if($result[0] == 0) //waiting_No为零表示已经预约成功
            {
                echo "您已经预约过此课程！无需重复预约！";
                return;
            }
            else if($result[0] > 0) //waiting_No大于零表示已经在等待队列
            {
                echo "您已经在等待队列，您前面还有".($result[0] - 1)."位会员在等待！";
                return;
            }
            else    //waiting_No小于零，不应该发生
            {
                echo "预约出错！请联系瑜伽馆工作人员nnnnnnnnnnnnnnnnnnn！" ;
                echo $result[0];
                return;
            }
        }

        if($max_user_number <= $selected_user_number) //课程已满并且客户愿意加入等待队列
        {
            if($input_if_waiting == 1)
            {
                //从数据库中查出本课程class_id中最大的waiting_No，告知用户排在第几位
                $query_result = $conn->query("select waiting_No from class_booking_table where class_id=$input_class_id order by waiting_No desc");
                $result = $query_result->fetchAll();

                $max_waiting_No = $result[0][0];    //当前最大等待编号。查询结果按waiting_No降序排列，则第一个数据就是当前最大的waiting_No

                //将用户加入等待队列
                $user_waiting_No = $max_waiting_No + 1;
                $query_result = $conn->query("insert into class_booking_table values($input_class_id, $db_member_id, $user_waiting_No, 0, 0, null)");
                if($conn->errorCode() != '00000')
                {
                    echo "数据库错误！预约失败！请重试！";
                    return;
                }
                echo "本节课程人数已满！您已加入等待队列！您前面有".$max_waiting_No."位会员在等待！";
                return;
            }
            else    //这个分支应该进不来！
            {
                echo "本节课程人数已满！";
                return;
            }
        }
        else    //真的开始约课
        {
            //对class_info_table中的已选人数要累加
            $selected_user_number++;
            $query_result = $conn->query("update class_info_table set selected_user_number=$selected_user_number where class_id=$input_class_id");
            debug_output("update class_info_table set selected_user_number=$selected_user_number where class_id=$input_class_id");
            if($conn->errorCode() != '00000')
            {
                echo "数据库错误！预约失败！请重试！";
                return;
            }

            //选课成功，将数据插入到数据库
            $query_result = $conn->query("insert into class_booking_table values($input_class_id, $db_member_id, 0, 0, 0, null)");
            debug_output("insert into class_booking_table values($input_class_id, $db_member_id, 0, 0, 0, null)");
            if($conn->errorCode() != '00000')
            {
                echo "数据库错误！预约失败！请重试！";
                return;
            }
            
            //选课成功后，要对计时卡的本周次数累加，对计次卡的总使用次数累加
            if($db_card_type == TIME_CARD_TYPE) //计时卡
            {
                if($concrete_card_type != 8)    //非不限次数卡
                {
                    if($which_week == 1)
                    {
                        debug_output("计时卡，本周次数累加");
                        $db_used_times++;
                        //更新数据库
                        $query_result = $conn->query("update time_card_table set used_times=$db_used_times where card_id='".$input_card_id."'");
                        debug_output("update time_card_table set used_times=$db_used_times where card_id='".$input_card_id."'");
                    }
                    else if($which_week == 2)
                    {
                        debug_output("计时卡，下周次数累加");
                        $db_next_used_times++;
                        //更新数据库
                        $query_result = $conn->query("update time_card_table set next_used_times=$db_next_used_times where card_id='".$input_card_id."'");
                        debug_output("update time_card_table set next_used_times=$db_next_used_times where card_id='".$input_card_id."'");
                    }
                }
                else    //不限次数卡，不用对已用次数累加
                {
                    debug_output("不限次数卡，具体卡类型为8；");
                }
            }
            else if($db_card_type == MEASURED_CARD_TYPE) //计次卡
            {
                debug_output("计次卡，总使用累加");
                $db_used_times++;
                if($db_used_times >= $db_max_times)  //计次卡的次数用完，需要将卡状态设为无效卡:3
                {
                    //更新数据库
                    $query_result = $conn->query("update measured_card_table set card_status=3, used_times=$db_used_times where card_id='".$input_card_id."'");
                    debug_output("update measured_card_table set card_status=3, used_times=$db_used_times where card_id='".$input_card_id."'");
                }
                else
                {
                    //更新数据库
                    $query_result = $conn->query("update measured_card_table set used_times=$db_used_times where card_id='".$input_card_id."'");
                    debug_output("update measured_card_table set used_times=$db_used_times where card_id='".$input_card_id."'");
                }
            }
            
            echo "恭喜您！课程预约成功！";
        }

        //关闭数据库
        unset($result);
        unset($query_result);
    //}
?>