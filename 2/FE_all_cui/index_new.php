<?php
session_start();
if (isset($_SESSION['valid_user'])){
print <<<EOT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin | Strass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">

    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/site.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    
   
    
   
    
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->  
  </head>
  <body>
EOT;
    include("./navigator_bar.php");
print <<<EOT
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
    <div id="createtable">
    <table  class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>                
                <th>课程 ID</th>
                <th>课程名称</th>
                <th>上课时间</th>
                <th>授课教室</th>
                <th>授课老师</th>
                <th>实际预约人数</th>
                <th>常温/高温</th>
                <th>查看预约会员</th>
            </tr>
        </thead>
        <tbody id="add_td">
        </tbody>
    </table>
    <div>
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/index-new.js"></script>
   
    
  </body>
  
   
</html>
EOT;
    include("./page_footer.php");
}
else{
    echo "please login first!";
    echo "<a href='login.html'>login</a>";
}
?>
