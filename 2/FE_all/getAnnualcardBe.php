<?php
$cardType = $_POST["cardtype"];

require("../constant_var_define.php");

    //连接数据库的参数
    $conn = db_connect();
    $st = $conn->query("select * from member_info_table where card_type=$cardType ORDER BY card_id");
    debug_output("select * from member_info_table where card_type=$cardType ORDER BY card_id ");
    $rs = $st->fetchAll();
    $arr = array();
    foreach($rs as $value){
       array_push($arr,$value[0],$value[1],$value[2],$value[3],$value[4],$value[5],$value[6],$value[7],$value[9]);
    }
    print_r($arr);
    //echo json_encode($arr);    


?>