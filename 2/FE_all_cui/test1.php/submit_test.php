<?php
//数据库连接建立
$host=SAE_MYSQL_HOST_M;//"127.0.0.1";//
$port=SAE_MYSQL_PORT;//"3306";//
$dbname=SAE_MYSQL_DB;//"test";//
$dbuser=SAE_MYSQL_USER;//"root";//
$dbpassw=SAE_MYSQL_PASS;//"nopass";//

$dsn = "mysql:host=".$host.";port=".$port.";dbname=".$dbname;
$dbcon = new PDO($dsn, $dbuser, $dbpassw);


$register   = $_POST["register"];

if($register == "yes")    //是注册阶段,此时要将openid等信息注册进入是数据库
{
    $openid     = $_POST["openid"];
    $name       = $_POST["name"];
    $sex        = $_POST["sex"];
    $card_id    = $_POST["card_id"];
    $phone     = $_POST["mobile"];
    
    if(!isset($card_id))
    {
        echo "卡号信息为空.";
        return;
    }
    
    $query  = "select id from card where id = :card_id";
    $stmt   = $dbcon->prepare($query);
    $stmt->bindParam(":card_id", $card_id);
    $stmt->execute();
    
    //
    //此处现在的设计逻辑是, 用户仅通过输入card_id来进行绑定;
    //如果card_id在系统中不存在,则该卡是一张废卡
    //如果card_id对应的wechat_id在系统中存在已经绑定,则认为当前注册用户非法;
    
    $card_id   = $stmt->fetchColumn(0);
    
    if(!isset($card_id))
    {
        echo "在系统中没有找到你的卡号, 请联系瑜伽馆人员.";
        return;
    }
    
    $query  = "select id, wechat_id from user where card_id = :card_id";
    $stmt   = $dbcon->prepare($query);
    $stmt->bindParam(":card_id", $card_id);
    $stmt->execute();
    $user_id  = $stmt->fetchColumn(0);
    $pre_wechat_id = $stmt->fetchColumn(1);
    if(strlen($pre_wechat_id) > 0)
    {
        echo "该卡在系统中已经注册,请联系瑜伽馆人员.";
        echo "<br/>wechatid".$pre_wechat_id;
        return;
    }
    
    $query  = "update user set wechat_id=:wechat_id where id=:id";
    $stmp   = $dbcon->prepare($query);
    $stmp->bindParam(":wechat_id", $openid);
    $stmp->bindParam(":id", $user_id);
    $stmp->execute();
    echo "绑定成功";
}
else                    //是订阅阶段,要把订阅信息写入数据库 
{
    echo "测试阶段,暂时不提供约课功能";
}




