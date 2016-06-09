<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    require("../constant_var_define.php");

    $input_name = $_POST["name"];				//会员姓名
    $input_card_id = $_POST["cardNo"];			//会员卡号
    debug_output("姓名：".$input_name);
    debug_output("会员卡号：".$input_card_id);

    if(empty($input_name) || empty($input_card_id))
    {
        echo "请输入删除条件！";
        return;
    }

    $conn = db_connect();

    //先删除卡对应表中的信息
    //先要查出对应的表
    $query_result = $conn->query("select card_type,member_id from member_info_table where member_name='".$input_name."' and card_id='".$input_card_id."'");
    if(!$query_result)
    {
        debug_output("1.删除失败！数据库错误！");
        echo "删除失败！数据库错误！";
        return;
    }
    $value = $query_result->fetch();
    if(empty($value))
    {
        echo "删除失败！无对应用户数据！";
        return;
    }
    $db_card_type = $value[0];
    $db_member_id = $value[1];
    debug_output("查出来的卡类型是：".$db_card_type);
    debug_output("查出来的member_id是：".$db_member_id);

    //根据卡类型，选择合适的要删除的表
    if($db_card_type == TIME_CARD_TYPE)  //计时卡
    {
        $query_result = $conn->query("delete from time_card_table where card_id='".$input_card_id."'");
        if(!$query_result)
        {
            debug_output("2.删除失败！数据库错误！");
            echo "删除失败！数据库错误！";
            return;
        }
        //printf("计时卡，删除%d行", mysql_affected_rows());
        //此处不用判空，因为就算卡信息没有数据可删除，但是用户信息删除数据了，也认为删除成功，而且这条用户数据应该是有问题的！
    }
    else if($db_card_type == MEASURED_CARD_TYPE) //计次卡
    {
        $query_result = $conn->query("delete from measured_card_table where card_id='".$input_card_id."'");
        if(!$query_result)
        {
            debug_output("3.删除失败！数据库错误！");
            echo "删除失败！数据库错误！";
            return;
        }
    }
    else
    {
        echo "删除失败！数据库错误！";
        return;
    }

    //删除member_info_table中对应信息
    $query_result = $conn->query("delete from member_info_table where card_id='".$input_card_id."'");
    if(!$query_result)
    {
        debug_output("4.用户信息表中无对应卡号！");
        //echo "删除失败！数据库错误！";
    }

    //删除class_booking_table中的对应member_id的数据
    $query_result = $conn->query("delete from class_booking_table where member_id=$db_member_id");
    if(!$query_result)
    {
        debug_output("5.约课信息表中无相关数据！");
        //echo "删除失败！数据库错误！";
    }

    //重新查一遍刚才删除的数据是否还在，从而判断删除是否成功
    $query_result = $conn->query("select member_id from member_info_table where member_name='".$input_name."' and card_id='".$input_card_id."'");
    if(!$query_result)
    {
        debug_output("6.删除失败！数据库错误！");
        echo "删除失败！数据库错误！";
        return;
    }
    $value = $query_result->fetch();
    if(!empty($value[0]))
    {
        echo "删除失败！数据库出错";
    }
    else
    {
        echo "删除成功！";
    }

    //关闭数据库
    unset($value);
    unset($query_result);
?>