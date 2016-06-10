<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="css/bootstrap.css" rel="stylesheet"></link>
        <link href="css/site.css" rel="stylesheet"></link>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"></link>
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <script src="js/jquery.js"></script>
       
       
    </head>
    <body>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span9">
                    <div class="row-fluid">
                        <div class="page-header">
                            <h1>Selected class <small>已约精品课程列表</small></h1>

                        </div>
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>课程序号</th> 
                                    <th>姓名</th>
                                    <th>手机号</th>
                                    <th>会员卡号</th>
                                    <th>签到</th>
                                </tr>
                            </thead>

<?php
    require("../constant_var_define.php");

    //取到课编号
    $class_id = $_GET['class_id'];
    debug_output("输入的课程编号是：".$class_id);
   
    //连接数据库的参数
    $conn = db_connect();

    //从table中查出class_id,member_id
    $query_result = $conn->query("select class_id,member_id,sign_in from min_class_booking_table where class_id=$class_id");
    debug_output("");
    $result = $query_result->fetchAll();
    
    if(empty($result))
    {
        echo "此课程暂无会员预约！";
        return;
    }
    
    //对预约该课程的每一个会员
    foreach ($result as $value)
    {
        $db_member_id = $value[1]; //查出会员号
        debug_output("查出的member_id是：".$db_member_id);
        

            //列出所有member_id对应的会员信息，包括会员姓名、卡号、手机号
          
                $query_result = $conn->query("select member_name,phone,card_id from member_info_table where member_id=$value[1]");
                debug_output("select member_name,phone,card_id from member_info_table where member_id=$value[1]");
                $member_result = $query_result->fetch();
               
               print <<<EOT
               <tbody>
                <tr>
                     <td >{$class_id}</td>
                     <td >{$member_result[0]}</td>
                     <td >{$member_result[1]}</td>
                     <td >{$member_result[2]}</td>
                     <td ><input type="checkbox" class="sign_in_checked" id="$member_result[2]"/></td>
                </tr>
                </tbody>
                <script>
                $(document).ready(function ()
                {
                   console.log("in ready");           
                    console.log("value is :",$value[2]); 
                    if($value[2] == 0)
                    {
                        console.log("in false");
                        $("#$member_result[2]").attr("checked",false);
                    }
                    else if($value[2] == 1)
                    {
                        console.log("in true");
                        $("#$member_result[2]").attr("checked",true);
                    }
                   
                    
            });
                </script>
EOT;
    }
    
    

    
?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
         <script src="js/sign-in.js"></script>
    </body>
</html>
