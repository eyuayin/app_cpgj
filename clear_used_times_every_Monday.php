<?php
    require("./constant_var_define.php");

    $conn = db_connect();

    //查出计时卡的总数，然后每次$item_num条进行遍历
    $query_result = $conn->query("select count(*) from time_card_table_cui");
    debug_output("select count(*) from time_card_table_cui");
    if($conn->errorCode() != '00000')
    {
        debug_output("查询条数时出错！");
        return;
    }
    $result = $query_result->fetch();
    $card_num = $result[0];
    debug_output("time_card_table_cui中有".$card_num."条记录。");

    //每次要读取的条数
    $item_num = 50;

    //每次$item_num条，算出要分成多少次
    $loop_num = ceil($card_num / $item_num);   //向上取整
    $last_num = $loop_num - 1;
    debug_output("循环次数是：".$loop_num);

    for($i = 0; $i < $loop_num; $i++)
    {
        $start_num = $i * $item_num;
        if($i == $last_num)  //最后一次读取
        {
            if($card_num > $item_num)
            {
                $item_num = $card_num - ($i * $item_num);
            }
            else
            {
                $item_num = $card_num;
            }
        }
        debug_output("第".$i."次读取。");
        debug_output("起始条数：".$start_num);
        debug_output("读取条数：".$item_num);
        
        //查出下周已用次数和卡号
        $query_result = $conn->query("select next_used_times,card_id from time_card_table_cui limit $start_num,$item_num");
        debug_output("select next_used_times,card_id from time_card_table_cui limit $start_num,$item_num");
        $result = $query_result->fetchAll();

        foreach($result as $value)
        {
            $db_next_used_times = $value[0];
            $card_id = $value[1];
            debug_output("卡号：".$card_id);
            debug_output("下周已用次数：".$db_next_used_times);

            //把下周已用次数更新到本周已用次数，并把下周已用次数清0
            $update_result = $conn->query("update time_card_table_cui set used_times=$db_next_used_times,next_used_times=0 where card_id='".$card_id."'");
            debug_output("update time_card_table_cui set used_times=$db_next_used_times,next_used_times=0 where card_id='".$card_id."'");
        }
    }
    
    //每周一0点，清除计时卡的上周已用次数
    //$query_result = $conn->query("update time_card_table_cui set used_times=0");
?>