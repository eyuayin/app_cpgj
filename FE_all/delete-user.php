<?php
session_start();
if (isset($_SESSION['valid_user'])){
print <<<EOT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>New User | Strass</title>
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
		  <div class="row-fluid">
			<div class="page-header">
				<h1>Delete User <small>删除会员信息</small></h1>
			</div>
			<form class="form-horizontal" action="delete_member.php" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="name">姓名</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="name" name="name" />
						</div>
					</div>		
					<div class="control-group">
						<label class="control-label" for="cardNo">会员卡号</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="cardNo" name="cardNo" />
						</div>
					</div>	
					<div class="form-actions">
						<input type="submit" class="btn btn-success btn-large" value="删除" /> <a class="btn" href="delete-user.html">取消</a>
					</div>					
				</fieldset>
			</form>
		  </div>
        </div>
      </div>

      <hr>

EOT;
      include("./page_footer.php");
print <<<EOT

    </div>

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
  </body>
</html>
EOT;
}
else{
echo "please login first!";
echo "<a href='login.html'>Please login first</a>";
}
?>

