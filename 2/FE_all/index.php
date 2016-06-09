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
            <h1>欢迎, 管理员</h1>
            <p>欢迎访问本会员管理系统 </p>
            <p><a class="btn btn-success btn-large" href="new-user.php">新建会员</a></p>
            <p><a class="btn btn-success btn-large" href="search_and_update_user.php">查找会员</a></p>
              <p><a class="btn btn-success btn-large" href="new-role.php">预约课程</a></p>
              <p><a class="btn btn-success btn-large" href="search_and_update_class.php">查看预约情况</a></p>
          </div>
		  <br />
        </div>
      </div>

      <hr>


    </div>

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
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
