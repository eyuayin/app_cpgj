<html lang="en" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="/FE_all/css/bootstrap.css" rel="stylesheet"/>
<link href="/FE_all/css/site.css" rel="stylesheet"/>
<link href="/FE_all/css/bootstrap-responsive.css" rel="stylesheet"/>
<script src="FE_all/js/jquery.js"></script>
</head>
<style type="text/css">
    .white_content{
        display: none;
        position: absolute;
        top: 25%;  left: 25%;
        width: 50%;
        height: 80%;
        padding: 16px;
        border: 1px solid black;
        background-color: white;
        z-index:1002;
        overflow:auto
    }
</style>
<body>
 <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>                       
                        <th>会员卡类型</th>
                        <th>会员卡号</th>                      
                        <th>姓名</th>
                        <th>手机号码</th>
                        <th>常温卡/高温卡</th>
                        <th>会员卡状态</th>
                        <th>会员卡开卡日期</th>
                        <th>会员卡失效日期</th>                                                                  
                    </tr>
                </thead>
                <tbody>
               
<?php
    require("../constant_var_define.php");
   
    $search_type = $_POST['type']; 
    $begin_time = $_POST['begin_time'];
    $end_time = $_POST['end_time'];
    $card_type = $_POST['card_type'];

    //连接数据库的参数
    $conn = db_connect();

    if($search_type == 0)   //开卡信息查询
    {
        if($card_type == 0)
        {
        $query_result = $conn->query("select * from member_card_sum_view_cui where begin_date > '".$begin_time."' AND begin_date < '".$end_time."'");
        debug_output("select * from member_card_sum_view_cui where begin_date > '".$begin_time."' AND begin_date < '".$end_time."'");
        }
        else if ($card_type != 0)
        {
         $query_result = $conn->query("select * from member_card_sum_view_cui where begin_date > '".$begin_time."' AND begin_date < '".$end_time."' and card_type = $card_type ");
        debug_output("select * from member_card_sum_view_cui where begin_date > '".$begin_time."' AND begin_date < '".$end_time."' and card_type = $card_type");   
        }
        if(!$query_result)
        {
            debug_output("0.数据库错误！");
            echo "数据库错误！";
            return;
        }
        $value = $query_result->fetchAll();
        foreach($value as $value){
           
print <<<EOT
           
       
            <tr>
            <td>{$card_tyep_num_to_name[$value[0]]}</td>
          
            <td>{$value[1]}</td>
           
            <td>{$value[2]}</td>
           
            <td>{$value[3]}</td>
            <td>{$class_priority_num_to_name[$value[4]]}</td>
            <td>{$card_status_num_to_name[$value[5]]}</td>
            <td>{$value[6]}</td>
            <td>{$value[7]}</td>                   
            </tr>        
EOT;
        }
    }

    else if($search_type == 2)  //即将到期卡信息查询
    {
       if($card_type == 0)
        {
        $query_result = $conn->query("select * from member_card_sum_view_cui where end_date > '".$begin_time."' AND end_date < '".$end_time."'");
        debug_output("select * from member_card_sum_view_cui where end_date > '".$begin_time."' AND end_date < '".$end_time."'");
        }
        else if ($card_type != 0)
        {
         $query_result = $conn->query("select * from member_card_sum_view_cui where end_date > '".$begin_time."' AND end_date < '".$end_time."' and card_type = $card_type ");
        debug_output("select * from member_card_sum_view_cui where end_date > '".$begin_time."' AND end_date < '".$end_time."' and card_type = $card_type");   
        }
        if(!$query_result)
        {
            debug_output("0.数据库错误！");
            echo "数据库错误！";
            return;
        }
        $value = $query_result->fetchAll();
        foreach($value as $value){
           
print <<<EOT
           
       
            <tr>
            <td>{$card_tyep_num_to_name[$value[0]]}</td>
          
            <td>{$value[1]}</td>
           
            <td>{$value[2]}</td>
           
            <td>{$value[3]}</td>
            <td>{$class_priority_num_to_name[$value[4]]}</td>
            <td>{$card_status_num_to_name[$value[5]]}</td>
            <td>{$value[6]}</td>
            <td>{$value[7]}</td>                   
            </tr>        
EOT;
        }
    }
    
    else if($search_type == 1)  //已到期卡信息查询
    {
        if($card_type == 0)
        {
        $query_result = $conn->query("select * from member_card_sum_view_cui where end_date < '".$begin_time."'");
        debug_output("select * from member_card_sum_view_cui where end_date < '".$begin_time."'");
        }
        else if ($card_type != 0)
        {
         $query_result = $conn->query("select * from member_card_sum_view_cui where end_date < '".$begin_time."' and card_type = $card_type ");
        debug_output("select * from member_card_sum_view_cui where end_date < '".$begin_time."' and card_type = $card_type");   
        }
        if(!$query_result)
        {
            debug_output("0.数据库错误！");
            echo "数据库错误！";
            return;
        }
        $value = $query_result->fetchAll();
        foreach($value as $value){
           
print <<<EOT
           
       
            <tr>
            <td>{$card_tyep_num_to_name[$value[0]]}</td>
          
            <td>{$value[1]}</td>
           
            <td>{$value[2]}</td>
           
            <td>{$value[3]}</td>
            <td>{$class_priority_num_to_name[$value[4]]}</td>
            <td>{$card_status_num_to_name[$value[5]]}</td>
            <td>{$value[6]}</td>
            <td>{$value[7]}</td>                   
            </tr>        
EOT;
    }
}
    /*
    else
    {
        echo "暂不支持此种查询方式！";
        return;
    }
*/
?>
    </tbody>
    </table>

</body>
</html>