<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    require("../constant_var_define.php");

    $input_name = $_POST["name"];				//会员姓名
    $input_gender = $_POST["gender"];			//性别
    $input_id_num = $_POST["id_num"];			//身份证号码
    $input_cardNo = $_POST["cardNo"];			//会员卡号
    $input_concrete_cardType = $_POST["card_type"];  //会员卡具体类型
    $input_card_priority = $_POST["temp"];      //课程类型（高温，常温）
    $input_birthday = $_POST["birthday"];		//生日
    $input_phone = $_POST["phone"];				//手机号码
    $input_if_active = $_POST["if_active"];		//是否激活
    $input_begin_date = $_POST["begin_date"];   //起始日期
    $input_end_date = $_POST["end_date"];       //结束日期
    $input_times_per_week = $_POST["times_per_week"];   //每周最多使用次数
    $input_max_times = $_POST["total_times"];   //总可用次数

    debug_output("姓名:".$input_name);
    debug_output("性别:".$input_gender);
    debug_output("身份证号:".$input_id_num);
    debug_output("会员卡号:".$input_cardNo);
    debug_output("具体卡类型:".$input_concrete_cardType);
    debug_output("生日:".$input_birthday);
    debug_output("手机号".$input_phone);
    debug_output("卡优先级".$input_card_priority);
    debug_output("是否激活".$input_if_active);
    debug_output("起始日期".$input_begin_date);
    debug_output("结束日期".$input_end_date);
    debug_output("每周可用次数".$input_times_per_week);
    debug_output("总可用次数".$input_max_times);

    if(empty($input_name))
    {
        echo "姓名不能为空！";
        return;
    }
    if(empty($input_gender))
    {
        echo "性别不能为空！";
        return;
    }
    if(empty($input_cardNo))
    {
        echo "会员卡号不能为空！";
        return;
    }
    if(empty($input_concrete_cardType))
    {
        echo "会员卡类型不能为空！";
        return;
    }
    if(empty($input_card_priority))
    {
        echo "高温？常温？";
        return;
    }

    //转换出具体卡类型编号
    $cal_concrete_card_type = $card_tyep_name_to_num[$input_concrete_cardType];
    debug_output("转换后具体卡类型编号：".$cal_concrete_card_type);

    if(($cal_concrete_card_type == 5) || ($cal_concrete_card_type == 7) || ($cal_concrete_card_type == 9) || ($cal_concrete_card_type == 10))    //计次卡
    {
        if(empty($input_max_times))
        {
            echo "总次数不能为空！";
            return;
        }
        $cal_card_type = 2; //计次卡
    }
    else
    {
        if(empty($input_times_per_week))
        {
            echo "每周最多可用次数不能为空！";
            return;
        }
        $cal_card_type = 1; //计时卡
    }

    //连接数据库
    $conn = db_connect();

    //因为卡号字段是唯一值，先判断数据库中是否已有
    //$query_result = $conn->query("select member_name from member_info_table where member_name='".$input_name."'");
    //debug_output("select member_name from member_info_table where member_name='".$input_name."'");
    //$result = $query_result->fetch();
    //if(!empty($result))
    //{
    //    echo "输入的会员名有重名，请重新输入姓名！";
    //    return;
    //}
    $query_result = $conn->query("select card_id from member_info_table where card_id='".$input_cardNo."'");
    debug_output("select card_id from member_info_table where card_id='".$input_cardNo."'");
    $result = $query_result->fetch();
    if(!empty($result))
    {
        echo "输入的会员卡号有重复，请重新输入卡号！";
        return;
    }

    //先将member_info_table表中的信息插入此表。包括：姓名，性别，身份证号，会员卡号，card_type（这个已经转换为数字）
    //生日，手机号，共7项
    $query_result = $conn->query("insert into member_info_table(`member_name`, `sex`, `identy_card_number`, `birthday`, `phone`, `card_id`, `card_type`) values('".$input_name."', '".$input_gender."', '".$input_id_num."', '".$input_birthday."', '".$input_phone."', '".$input_cardNo."', $cal_card_type)");
    debug_output("insert into member_info_table(`member_name`, `sex`, `identy_card_number`, `birthday`, `phone`, `card_id`, `card_type`) values('".$input_name."', '".$input_gender."', '".$input_id_num."', '".$input_birthday."', '".$input_phone."', '".$input_cardNo."', $cal_card_type)");
    if($conn->errorCode() != '00000')
    {
        echo "数据库错误！\r\n";
        print_r($conn->errorInfo());
        exit;
    }

    //卡状态转换
    if($input_if_active == 1)   //激活
    {
        $cal_card_status = 1;
    }
    else    //不激活
    {
        $cal_card_status = 0;
    }

    //转换卡优先级
    if(strcmp($input_card_priority, "高温"))    //高温卡
    {
        $cal_card_priority = 1;
    }
    else if(strcmp($input_card_priority, "常温"))    //常温卡
    {
        $cal_card_priority = 2;
    }

    //根据卡类型，将卡信息插入对应的表中
    if($cal_card_type == 1) //计时卡
    {
        //将卡号，卡优先级，已用次数（0），每周最多可用次数，开卡日期，结束日期，卡状态，具体卡类型，共8项插入time_card_table表中
        $query_result = $conn->query("insert into time_card_table(`card_id`, `card_priority`, `used_times`, `max_times`, `valid_begin_date`, `valid_end_date`, `card_status`, `concrete_card_type`) values('".$input_cardNo."', $cal_card_priority, 0, $input_times_per_week, '".$input_begin_date."', '".$input_end_date."', $cal_card_status, $cal_concrete_card_type)");
        debug_output("insert into time_card_table(`card_id`, `card_priority`, `used_times`, `max_times`, `valid_begin_date`, `valid_end_date`, `card_status`, `concrete_card_type`) values('".$input_cardNo."', $cal_card_priority, 0, $input_times_per_week, '".$input_begin_date."', '".$input_end_date."', $cal_card_status, $cal_concrete_card_type)");
        if(!$query_result)
        {
            debug_output("2.数据库错误！");
            //卡信息存储出错，需要将刚才存入用户信息表中的数据删除
            $query_result = $conn->query("delete from member_info_table where card_id='".$input_cardNo."'");
            echo "数据库错误！";
            return;
        }
    }
    else if($cal_card_type == 2) //计次卡
    {
        //将卡号，卡优先级，开卡日期，结束日期，卡状态，具体卡类型，总已用次数（0），总可用次数，共8项插入measured_card_table表中
        $query_result = $conn->query("insert into measured_card_table(`card_id`, `card_priority`, `valid_begin_date`, `valid_end_date`, `card_status`, `concrete_card_type`, `used_times`, `max_times`) values('".$input_cardNo."', $cal_card_priority, '".$input_begin_date."', '".$input_end_date."', $cal_card_status, $cal_concrete_card_type, 0, $input_max_times)");
        debug_output("insert into measured_card_table(`card_id`, `card_priority`, `valid_begin_date`, `valid_end_date`, `card_status`, `concrete_card_type`, `used_times`, `max_times`) values('".$input_cardNo."', $cal_card_priority, '".$input_begin_date."', '".$input_end_date."', $cal_card_status, $cal_concrete_card_type, 0, $input_max_times)");
        if(!$query_result)
        {
            debug_output("3.数据库错误！");
            //卡信息存储出错，需要将刚才存入用户信息表中的数据删除
            $query_result = $conn->query("delete from member_info_table where card_id='".$input_cardNo."'");
            echo "数据库错误！";
            return;
        }
    }

    echo "新会员添加成功！";

    //关闭数据库
    unset($result);
    unset($query_result);
?>