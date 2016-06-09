<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    function debug_output($data)
    {
        echo "$data<br/>";
    }

    //连接数据库的参数
    $host=SAE_MYSQL_HOST_M;  
    $port=SAE_MYSQL_PORT;
    $dbname="app_vipmanage";
    $dbuser=SAE_MYSQL_USER;
    $dbpassw=SAE_MYSQL_PASS;
    $dsn = "mysql:host=".$host.";port=".$port.";dbname=".$dbname;
    //连接数据库
    $conn =  new PDO($dsn, $dbuser, $dbpassw);
    //设置编码
    $conn->query("set names utf8");

    //查出计时卡的总数，然后每次$item_num条进行遍历
    $query_result = $conn->query("select count(*) from measured_card_table");
    debug_output("select count(*) from measured_card_table");
    if($conn->errorCode() != '00000')
    {
        debug_output("查询条数时出错！");
        return;
    }
    $result = $query_result->fetch();
    $card_num = $result[0];
    debug_output("time_card_table中有".$card_num."条记录。");

    //每次要读取的条数
    $item_num = 50;
    //当前日期
    $today = date("Y-m-d",time());
    debug_output("今天是：".$today);
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

        $query_result = $conn->query("select valid_begin_date,valid_end_date,pause_begin_date,pause_end_date,card_id from measured_card_table limit $start_num,$item_num");
        debug_output("select valid_begin_date,valid_end_date,pause_begin_date,pause_end_date,card_id from measured_card_table limit $start_num,$item_num");
        $result = $query_result->fetchAll();

        foreach($result as $value)
        {
            $valid_begin_date = $value[0];
            $valid_end_date = $value[1];
            $pause_begin_date = $value[2];
            $pause_end_date = $value[3];
            $card_id = $value[4];
            debug_output("卡号：".$card_id);
            debug_output("开卡日期：".$valid_begin_date);
            debug_output("失效日期：".$valid_end_date);
            debug_output("停卡开始日期：".$pause_begin_date);
            debug_output("停卡截止日期：".$pause_end_date);

            //如果起始日期和终止日期都是0000-00-00，那么认为是0:未激活
            if(($valid_begin_date == '0000-00-00') && ($valid_end_date == '0000-00-00'))
            {
                $card_status = 0;
                debug_output("0:未激活");
            }
            else if($valid_end_date < $today)    //否则判断截止日期是否小于当前日期，若是，修改卡状态为3：失效卡
            {
                $card_status = 3;
                debug_output("3:失效卡");
            }
            else    //此时有可能是1：激活，2：停卡两种状态
            {
                $card_status = 1;   //默认是1：激活 状态
                debug_output("1:激活");
                if(($today > $pause_begin_date) && ($today < $pause_end_date))  //假如当天在停卡日期范围内
                {
                    $card_status = 2;   //2：停卡
                    debug_output("2:停卡");
                }
            }

            //把卡状态值更新到数据库
            $update_result = $conn->query("update measured_card_table set card_status=$card_status where card_id='".$card_id."'");
            debug_output("update measured_card_table set card_status=$card_status where card_id='".$card_id."'");
        }
    }
?>