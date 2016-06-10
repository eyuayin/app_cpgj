
<?php

    require("../constant_var_define.php");

    //获取用户输入信息
    $input_card_id = $_POST["card_id"];
    debug_output("输入的会员卡号是：".$input_card_id);
    $input_name = $_POST["name"];
    debug_output("输入的名字是：".$input_name);
    $input_class_id = $_POST["class_id"];
    debug_output("输入的class_id是：".$input_class_id);
    //$input_if_waiting = $_POST['whetherWait']; //用户在课程已满的情况下是否同意加入等待队列 1:是 2：否
    //debug_output("输入的whetherWait是：".$input_if_waiting);
    
    $book_mode = 0;
    if(empty($input_card_id) && empty($input_name))
    {
        echo "请输入姓名或卡号！";
        return;
    }

    if(empty($input_card_id))
    {
        debug_output("按照姓名预约！");
        $book_mode = BOOK_MODE_NAME;
    }
    else if(empty($input_name))
    {
        debug_output("按照卡号预约！");
        $book_mode = BOOK_MODE_CARD;
    }

    $conn = db_connect();
    
    $db_member_id = 0;
    $db_card_type = 0;

    if($book_mode == BOOK_MODE_CARD)    //按照卡号预约
    {
        //根据personal_coach_card_id在私教卡表中查出member_id、card_status、card_priority、used_times和max_times
        debug_output("按照卡号预约！");
        $query_result = $conn->query("select member_id,card_status,card_priority,used_times,max_times from personal_coach_card_table where personal_coach_card_id='".$input_card_id."'");
        debug_output("select member_id,card_status,card_priority,used_times,max_times from personal_coach_card_table where personal_coach_card_id='".$input_card_id."'");
        $result = $query_result->fetch();
        $db_member_id = $result[0];
        debug_output("从DB中查出的member_id是".$db_member_id);
        $db_card_status = $result[1];
        debug_output("从DB中查出的card_status是".$db_card_status);
        $db_card_priority = $result[2];
        debug_output("从DB中查出的card_priority是".$db_card_priority);
        $db_used_times = $result[3];
        debug_output("从DB中查出的used_times是".$db_used_times);
        $db_max_times = $result[4];
        debug_output("从DB中查出的max_times是".$db_max_times);
    }
    else if($book_mode == BOOK_MODE_NAME)   //按照姓名预约
    {
        //根据name从会员信息表查出member_id、card_type和extra_card
        debug_output("按照姓名预约！");
        $query_result = $conn->query("select member_id,extra_card from member_info_table where member_name='".$input_name."'");
        debug_output("select member_id,extra_card from member_info_table where member_name='".$input_name."'");
        $result = $query_result->fetch();
        $db_member_id = $result[0];
        debug_output("从DB中查出的member_id是".$db_member_id);
        $db_extra_card = $result[1];
        debug_output("从DB中查出的extra_card是".$db_extra_card);

        if(!(($db_extra_card == 1) || ($db_extra_card == 3)))   //表示此会员没有私教卡
        {
            echo "该会员没有私教卡！无法预约私教课程！";
            return;
        }

        //根据db_member_id在私教卡表中查出card_status、card_priority、used_times和max_times
        $query_result = $conn->query("select card_status,card_priority,used_times,max_times from personal_coach_card_table where member_id=$db_member_id");
        debug_output("select card_status,card_priority,used_times,max_times from personal_coach_card_table where member_id=$db_member_id");
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

    //卡信息校验
    if($db_used_times > $db_max_times)
    {
        echo "您私教卡次数已用完，无法继续使用！";
        return;
    }
    if($db_card_status != 1)   //卡是非激活状态
    {
        echo "您的私教卡不可用！";
        return;
    }
    if($db_card_priority != 3)   //非私教卡
    {
        echo "您的卡不是私教卡！无法预约私教课程！";
        return;
    }

    //根据class_id从personal_class_info_table查出class_priority,max_user_number,selected_user_number
    $query_result = $conn->query("select class_priority,max_user_number,selected_user_number from personal_class_info_table where class_id=$input_class_id");
    debug_output("select class_priority,max_user_number,selected_user_number from personal_class_info_table where class_id=$input_class_id");
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
        echo "没有查到预约的私教课程信息！预约失败";
        return;
    }
    if($class_priority != 3)    //非私教课
    {
        echo "您选择的不是私教课程！请确认！";
        return;
    }
    if($max_user_number <= $selected_user_number)   //课程已满，流程结束
    {
        echo "本节课程人数已满！";
        return;
    }

    //避免重复选课
    $query_result = $conn->query("select count(*) from personal_class_booking_table where class_id=$input_class_id and member_id=$db_member_id and canceled=0");
    debug_output("select count(*) from personal_class_booking_table where class_id=$input_class_id and member_id=$db_member_id and canceled=0");
    $result = $query_result->fetch();
    if(!empty($result)) //查到数据，表示该会员已经选过此课程
    {
        echo "您已经预约过此课程！无需重复预约！";
        return;
    }

    //选课成功，将数据插入到personal_class_booking_table
    $query_result = $conn->query("insert into personal_class_booking_table (class_id,member_id,sign_in,canceled,remark) values($input_class_id, $db_member_id, 0, 0, 0, null)");
    debug_output("insert into personal_class_booking_table (class_id,member_id,sign_in,canceled,remark) values($input_class_id, $db_member_id, 0, 0, 0, null)");
    if($conn->errorCode() != '00000')
    {
        echo "数据库错误！预约失败！请重试！";
        return;
    }

    //对personal_class_info_table中的已选人数累加
    $selected_user_number++;
    $query_result = $conn->query("update personal_class_info_table set selected_user_number=$selected_user_number where class_id=$input_class_id");
    debug_output("update personal_class_info_table set selected_user_number=$selected_user_number where class_id=$input_class_id");
    if($conn->errorCode() != '00000')
    {
        echo "数据库错误！预约失败！请重试！";
        return;
    }

    //对卡数据更新
    $db_used_times++;
    if($db_used_times >= $db_max_times)  //计次卡的次数用完，需要将卡状态设为无效卡:3
    {
        //更新数据库
        $query_result = $conn->query("update personal_coach_card_table set card_status=3, used_times=$db_used_times where member_id=$db_member_id");
        debug_output("update personal_coach_card_table set card_status=3, used_times=$db_used_times where member_id=$db_member_id");
    }
    else
    {
        //更新数据库
        $query_result = $conn->query("update personal_coach_card_table set used_times=$db_used_times where member_id=$db_member_id");
        debug_output("update personal_coach_card_table set card_status=3, used_times=$db_used_times where member_id=$db_member_id");
    }

    //约课成功
    echo "恭喜您！课程预约成功！";
    
    //关闭数据库
    unset($result);
    unset($query_result);
?>