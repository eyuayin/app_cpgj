<?php
    require("./constant_var_define.php");

    $conn = db_connect();
    
    //每周一0点，清除上周取消次数
    $query_result = $conn->query("update time_card_table set cancel_times=0");
    $query_result = $conn->query("update measured_card_table set cancel_times=0");
	$query_result = $conn->query("update time_card_table_cui set cancel_times=0");
    $query_result = $conn->query("update measured_card_table_cui set cancel_times=0");
?>