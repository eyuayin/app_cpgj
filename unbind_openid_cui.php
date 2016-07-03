<?php
$card_id = $_GET['card_id'];
require("constant_var_define.php");

//连接数据库的参数
 $conn = db_connect();
 
 $query_result = $conn->query("select open_id from member_info_table_cui where card_id=$card_id");
 debug_output("select open_id from member_info_table_cui where card_id=$card_id");
 
 
 if(!$query_result)
 {
       debug_output("0.数据库错误！");
       echo "没有查到该会员信息，无法解绑！";
       return;
       
 }
 
 $value = $query_result->fetchAll();
 foreach ($value as $value)
 {
 if(!$value[0])
 {
     echo "已解绑过，无需再次解绑！";
     return;
     
 }
 else 
 {
    $update_result = $conn->query("update member_info_table_cui set open_id = null where card_id=$card_id");
    debug_output("update member_info_table_cui set open_id = null where card_id=$card_id");
       if(!$update_result)
       {
           echo "解绑失败！";
           return;
       }
       else
           echo "解绑成功！";
 }
     
 }   
?>
