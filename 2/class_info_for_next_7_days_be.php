<?php
$open_id = $_POST["open_id"];
//echo "open_id is".$open_id;
require_once("./mysql_crud.php");
$db = new Database();
$db->connect();
/*
$db->select('member_info_table');
$jzl = $db->getResult();
echo "jzl is:".$jzl;

$db->select('member_info_table_cui');
$cpgj = $db->getResult();
echo "cpgj is:".$cpgj;


$res_jzl = $jzl->getResult();

$res_cpgj = $cpgj->getResult();

if($res_cpgj){
    $db->select('class_detail_in_7_days','*','null','location = 1');
    $jzl = $db->getResult(); 
    //echo $jzl;
}
else if($res_jzl){
     $db->select('class_detail_in_7_days','*','null','location = 2');
     $cpgj = $db->getResult(); 
     //echo $cpgj;
}

else
    echo "未查到您的会员信息，请于工作人员联系！";
*/

$db->select('class_detail_in_7_days');
$res = $db->getResult();
echo "djdjd";
echo $res;

?>




