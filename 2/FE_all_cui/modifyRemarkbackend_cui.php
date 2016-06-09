<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    require("../constant_var_define.php");

    $remarks = $_POST["remarks"];				//备注
    $member_id = $_POST["member_id"];				//备注


   // debug_output("备注:".$remarks);
	

    //连接数据库
    $conn = db_connect();


    //将备注插入数据库
    $query_result = $conn->query("UPDATE member_info_table SET remarks = '".$remarks."' WHERE member_id = $member_id");
    //debug_output("UPDATE member_info_table SET remarks = $remarks WHERE member_id = $member_id");
    if($conn->errorCode() != '00000')
    {
        echo "数据库错误！\r\n";
        print_r($conn->errorInfo());
        exit;
    }

    //关闭数据库
    unset($result);
    unset($query_result);
?>