<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Cache-Control" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="css/bootstrap.css" rel="stylesheet"></link>
        <link href="css/site.css" rel="stylesheet"></link>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"></link>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span9">
          <div class="well hero-unit">
            <div style="float:left"><a class="btn btn-success btn-large" href="new-user.php">新建会员</a></div>
            <div style="float:left; margin-left: 10px;"><a class="btn btn-success btn-large" href="search_and_update_user.php">查找会员</a></div>
              <div style="float:left;margin-left: 10px;"><a class="btn btn-success btn-large" href="new-role.php">预约课程</a></div>
              <div style="float:left;margin-left: 10px;"><a class="btn btn-success btn-large" href="search_and_update_class.php">查看预约情况</a></div>
          </div>
		  <br />
        </div>
      </div>
      <hr>
    </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span9">
                    <div class="row-fluid">
                        <div class="page-header">
                            <h1>Selected class <small>当日课程列表</small></h1>

                        </div>
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>会员卡号</th>
                                    <th>电话号码</th>
                                    <th>课程编号</th>
                                    <th>课程名称</th>
                                    <th>上课时间</th>
                                </tr>
                            </thead>
<?php
    include("./navigator_bar.php");
    require("../constant_var_define.php");
    $conn = db_connect();

    //根据open_id查出card_id,member_id
    $query_result = $conn->query("select * from book_info_for_today_cui");
    $result = $query_result->fetchAll();
    
    //循环将所有输入的会员名字的课程列出来
    foreach($result as $value)
    {
        
print <<<EOT
                    <tbody>
                    <tr>
                    <td >{$value[3]}</td> 
                    <td >{$value[2]}</td>
                    <td >{$value[4]}</td>
                    <td >{$value[0]}</td>
                    <td >{$value[5]}</td>
                    <td >{$value[1]}</td
                    </tr>
 
EOT;
              
               }
               

?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

