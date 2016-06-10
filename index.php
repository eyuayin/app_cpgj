<?php


define("TOKEN", "testforshare");

$wechatObj=new wechatCallbackapiTest();
if(!isset($_GET['echostr']))
{
    $wechatObj->responseMsg();
}
else
{
    $wechatObj->valid();
}

class wechatCallbackapiTest
{

    private
        $myDBCon;
    private
        $tableName;

    public
        function __construct()
    {
        $dsn="mysql:host=" . SAE_MYSQL_HOST_M . ";port=" . SAE_MYSQL_PORT . ";dbname=" . SAE_MYSQL_DB;
        $this->myDBCon=new PDO($dsn, SAE_MYSQL_USER, SAE_MYSQL_PASS);
        $this->tableName="memberInfo";
    }

    public
        function valid()
    {
        $echoStr=$_GET["echostr"];
        if($this->checkSignature())
        {
            echo $echoStr;
            exit;
        }
    }

    private
        function checkSignature()
    {
        $signature=$_GET["signature"];
        $timestamp=$_GET["timestamp"];
        $nonce=$_GET["nonce"];
        $token=TOKEN;
        $tmpArr=array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr=implode($tmpArr);
        $tmpStr=sha1($tmpStr);

        if($tmpStr==$signature)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

//判断接受信息的类型
    public
        function responseMsg()
    {
        $postStr=$GLOBALS["HTTP_RAW_POST_DATA"];
        if(!empty($postStr))
        {
            $this->logger("R " . $postStr);
            $postObj=simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE=trim($postObj->MsgType);

            switch($RX_TYPE)
            {
                case "event":
                    $result=$this->receiveEvent($postObj);
                    break;
                case "text":
                    $result=$this->receiveText($postObj);
                    break;
            }
            $this->logger("T " . $result);
            echo $result;
        }
        else
        {
            echo "";
            exit;
        }
    }

//如果接收到的是事件类信息    
    private
        function receiveEvent($object)
    {
        $content="";
        $openid=$object->FromUserName;
        switch($object->Event)
        {
            case "subscribe":
                $content[]=array("Title"=>"欢迎关注天环瑜伽",
                    "Description"=>"请点击图片完善您的基本信息",
                    "PicUrl"=>"http://1.vipmanage.sinaapp.com/2531170_101520510559_2.jpg",
                    "Url"=>"http://1.vipmanage.sinaapp.com/register.php?openid=" . $object->FromUserName);
                break;
            case "unsubscribe":
                $content="取消关注";

                $query="update user set wechat_id = NULL where wechat_id = :wechat_id";
                $stmt=$this->myDBCon->prepare($query);
                $stmt->bindParam(":wechat_id", $openid);
                $stmt->execute();

                break;
            case "CLICK":
                switch($object->EventKey)
                {
                    case "book":

                        $query="select name from user where wechat_id =:wechat_id";
                        $stmt=$this->myDBCon->prepare($query);
                        $stmt->bindParam(":wechat_id", $openid);
                        $stmt->execute();
                        
                        $bind_id="";
                        $bind_name="";
                        $name=$stmt->fetchColumn(0);
                        if(strlen($name) > 0)
                        {
                            $bind_id = $openid;
                            $bind_name = $name;
                        }

                        $content[]=array("Title"=>"欢迎访问天环瑜伽预约课程系统",
                            "Description"=>"点击图片开始预约",
                            "PicUrl"=>"http://1.vipmanage.sinaapp.com/f11f3a292df5e0fef8858be75c6034a85fdf72b2.jpg",
                            "Url"=>"http://1.vipmanage.sinaapp.com/order.php?openid=" . $openid);
                        break;
                    case "find":
                        $query="select name from user where wechat_id =:wechat_id";
                        $stmt=$this->myDBCon->prepare($query);
                        $stmt->bindParam(":wechat_id", $openid);
                        $stmt->execute();

                        $bind_id="";
                        $bind_name="";
                        $name=$stmt->fetchColumn(0);
                        if(strlen($name) > 0)
                        {
                        $bind_id = $openid;
                        $bind_name = $name;
                        }

                        $content[]=array("Title"=>"欢迎访问天环瑜伽预约课程系统",
                        "Description"=>"点击图片查询您已预约的课程信息",
                        "PicUrl"=>"http://1.vipmanage.sinaapp.com/query.jpg",
                        "Url"=>"http://1.vipmanage.sinaapp.com/member_selected_classes_weixin.php?openid=" . $openid);
                        break;

                    default:
                        $content="http://www.xici.net/b1068282/";
                        break;
                }
        }
        $result=$this->transmitNews($object, $content);
        return $result;
    }

    private
        function receiveText($postObj)
    {
        $content="to be continued";
        $result=$this->transmitText($postObj, $content);
        return $result;
    }

    private
        function transmitText($object, $content)
    {
        $textTpl="<xml>
       <ToUserName><![CDATA[%s]]></ToUserName>
       <FromUserName><![CDATA[%s]]></FromUserName>
       <CreateTime>%s</CreateTime>
       <MsgType><![CDATA[text]]></MsgType>
       <Content><![CDATA[%s]]></Content>
       </xml>";
        $result=sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

    private
        function transmitNews($object, $arr_item)
    {
        if(!is_array($arr_item))
            return;

        $itemTpl="    <item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                        </item>";
        $item_str="";
        foreach($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);

        $newsTpl="<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <Content><![CDATA[]]></Content>
        <ArticleCount>%s</ArticleCount>
        <Articles>
        $item_str</Articles>
        </xml>";

        $result=sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item));
        return $result;
    }

    private
        function logger($log_content)
    {
        
    }

}

?>