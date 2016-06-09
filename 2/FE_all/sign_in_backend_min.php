<?php
require("../constant_var_define.php");

//已签到是否勾选
$whether_checked = $_POST['whether_checked'];
//echo "是否签到";
//echo $whether_checked;

//获取签到课程ID
$class_id = $_POST['class_id'];

//获取签到会员卡号
$card_No = $_POST['card_No'];

if($whether_checked == "true")
   {
      $checked = 1;
      //echo "checked is 1 :";
     // echo $checked;
    }
else if($whether_checked == "false")
   {
      $checked = 0;
     // echo "checked is 0:";
     // echo $checked;
    }
else
{
    echo "异常错误，请联系开发人员！";
}

//echo $class_id;
//echo $card_No;

//连接数据库                   
$conn = db_connect();

//根据会员卡号查出 Member_id
$query_result = $conn->query("select member_id from member_info_table where card_id='$card_No'");
$member_result = $query_result->fetch();
  
 if(empty($member_result))
    {
        echo "未查找到该记录，请确定会员卡号是否正确！";
        return;
    }
//记录会员是否签到信息到数据库 
    $update_result = $conn->query("UPDATE min_class_booking_table SET sign_in = '$checked' WHERE class_id = '$class_id' AND member_id = '$member_result[0]'");
    debug_output("UPDATE min_class_booking_table SET sign_in = '$checked' WHERE class_id = '$class_id' AND member_id = '$member_result[0]'");

    if(!$update_result)
        {
            echo "数据库错误！签到失败！请重试！";
            return;
        }
    else if ($checked == 1){
        echo "签到成功";
    }
    else if ($checked == 0){
        echo "签到取消成功";
    }
    else
    {
        echo "异常错误，请联系开发人员！";
    }
    
   
 //关闭数据库
    unset($result);
    unset($query_result);
?>