<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    require("./constant_var_define.php");

    $former_time_card_id = $_POST['former_card_id_timecard'];   //计时卡   
    $former_measured_card_id = $_POST['former_card_id'];    //计次卡

    if(!empty($former_time_card_id))    //计时卡   
    {
        //variable transferred for time card 
        $input_name = $_POST['name_timecard'];
        $input_gender= $sex_chinese_to_english[$_POST['sex_timecard']];
        $input_id_num = $_POST['id_num_timecard'];
        $input_birthday = $_POST['birthday_timecard'];
        $input_open_id = $_POST['open_id'];
        $input_phone = $_POST['phone_timecard'];
        $input_cardNo = $_POST['card_no_timecard'];
        $card_type = 1;   //计时卡
        $input_concrete_cardType = $card_tyep_name_to_num[$_POST['card_type_timecard']];
        $input_card_priority = $card_priority_name_to_num[$_POST['priority_timecard']];
        $input_card_status = $card_status_name_to_num[$_POST['state_timecard']];
        $input_begin_date = $_POST['active_date_timecard'];
        $input_end_date = $_POST['deactive_date_timecard'];
        $input_frozen_date = $_POST['frozen_date_timecard'];
        $input_unfrozen_date = $_POST['unfrozen_date_timecard'];
        $input_total_times = $_POST['total_timecard'];
        $input_former_card_id = $former_time_card_id;
        
    }
    else if(!empty($former_measured_card_id))  //计次卡
    {
        //variable transferred for measure card
        $input_name = $_POST['name'];
        $input_gender = $sex_chinese_to_english[$_POST['sex']];
        $input_id_num = $_POST['id_num'];
        $input_birthday = $_POST['birthday'];
        $input_phone = $_POST['phone'];
        $input_cardNo = $_POST['card_no'];
        $input_open_id = $_POST['open_id'];
        $card_type = 2;   //计次卡
        $input_concrete_cardType = $card_tyep_name_to_num[$_POST['card_type']];
        $input_card_priority = $card_priority_name_to_num[$_POST['priority']];
        $input_card_status = $card_status_name_to_num[$_POST['state']];
        $input_begin_date = $_POST['active_date'];
        $input_end_date = $_POST['deactive_date'];
        $input_frozen_date = $_POST['frozen_date'];
        $input_unfrozen_date = $_POST['unfrozen_date'];
        $input_used_times = $_POST['used'];
        $input_total_times = $_POST['total'];
        $input_former_card_id = $former_measured_card_id;
    }
    else
    {
        page_output("black", 14, "网络传输错误，请稍后重试！");
        return;
    }
    
    debug_output("name:".$input_name);
    debug_output("sex:".$input_gender);
    debug_output("id no:".$input_id_num);
    debug_output("birthday:".$input_birthday);
    debug_output("phone:".$input_phone);
    debug_output("card_id:".$input_cardNo);
    debug_output("card type:".$card_type);
    debug_output("concrete type:".$input_concrete_cardType);
    debug_output("priority:".$input_card_priority);
    debug_output("status:".$input_card_status);
    debug_output("begin date:".$input_begin_date);
    debug_output("end date:".$input_end_date);
    debug_output("frozen date:".$input_frozen_date);
    debug_output("unfrozen date:".$input_unfrozen_date);
    debug_output("used times:".$input_used_times);
    debug_output("total times:".$input_total_times);
    debug_output("former card id:".$input_former_card_id);
    debug_output("open id is:".$input_open_id);

    //连接数据库
    $conn = db_connect();

    //更新卡信息
    if($card_type == 1)  //计时卡
    {
        //更新time_card_table中信息
        $affect_rows = $conn->exec("update time_card_table set card_id='".$input_cardNo."',card_priority='".$input_card_priority."',max_times=$input_total_times,valid_begin_date='".$input_begin_date."',valid_end_date='".$input_end_date."',pause_begin_date='".$input_frozen_date."',pause_end_date='".$input_unfrozen_date."',card_status='".$input_card_status."',concrete_card_type=$input_concrete_cardType where card_id='".$input_former_card_id."'");
        debug_output("update time_card_table set card_id='".$input_cardNo."',card_priority='".$input_card_priority."',max_times=$input_total_times,valid_begin_date='".$input_begin_date."',valid_end_date='".$input_end_date."',pause_begin_date='".$input_frozen_date."',pause_end_date='".$input_unfrozen_date."',card_status='".$input_card_status."',concrete_card_type=$input_concrete_cardType where card_id='".$input_former_card_id."'");
        if($conn->errorCode() != '00000')
        {
            echo "会员信息修改失败！请保存截图并发给瑜伽馆工作人员，谢谢！";
            //echo "课程信息修改失败！请保存截图并发给瑜伽馆工作人员，谢谢！";
            print_r($conn->errorInfo());
            return;
        }
    }
    else if($card_type == 2) //计次卡
    {
        //更新measured_card_table中信息
        $affect_rows = $conn->exec("update measured_card_table set card_id='".$input_cardNo."',card_priority='".$input_card_priority."',used_times=$input_used_times,max_times=$input_total_times,valid_begin_date='".$input_begin_date."',valid_end_date='".$input_end_date."',pause_begin_date='".$input_frozen_date."',pause_end_date='".$input_unfrozen_date."',card_status='".$input_card_status."',concrete_card_type=$input_concrete_cardType where card_id='".$input_former_card_id."'");
        debug_output("update measured_card_table set card_id='".$input_cardNo."',card_priority='".$input_card_priority."',used_times=$input_used_times,max_times=$input_total_times,valid_begin_date='".$input_begin_date."',valid_end_date='".$input_end_date."',pause_begin_date='".$input_frozen_date."',pause_end_date='".$input_unfrozen_date."',card_status='".$input_card_status."',concrete_card_type=$input_concrete_cardType where card_id='".$input_former_card_id."'");
        if($conn->errorCode() != '00000')
        {
            echo "会员信息修改失败！请保存截图并发给瑜伽馆工作人员，谢谢！";
            //echo "课程信息修改失败！请保存截图并发给瑜伽馆工作人员，谢谢！";
            print_r($conn->errorInfo());
            return;
        }
    }

    //更新用户信息
    $affect_rows = $conn->exec("update member_info_table set member_name='".$input_name."',open_id='".$input_open_id."',sex='".$input_gender."',identy_card_number='".$input_id_num."',birthday='".$input_birthday."',phone='".$input_phone."',card_id='".$input_cardNo."' where card_id='".$input_former_card_id."'");
    debug_output("update member_info_table set member_name='".$input_name."',open_id='".$input_open_id."',sex='".$input_gender."',identy_card_number='".$input_id_num."',birthday='".$input_birthday."',phone='".$input_phone."',card_id='".$input_cardNo."' where card_id='".$input_former_card_id."'");
    if($conn->errorCode() != '00000')
    {
        echo "会员信息修改失败！请保存截图并发给瑜伽馆工作人员，谢谢！";
        //echo "课程信息修改失败！请保存截图并发给瑜伽馆工作人员，谢谢！";
        print_r($conn->errorInfo());
        return;
    }

    echo "会员信息修改成功！";
?>