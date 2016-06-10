<?php
session_start();
if (isset($_SESSION['valid_user'])){
print <<<EOT
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin | Strass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>

    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/site.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">   
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->  
  </head>
EOT;
    include("./navigator_bar.php");
print <<<EOT
 
<body>  
  <div id="container">  
    <form action="upload_pic_be.php" method="post" enctype="multipart/form-data" style="margin-left: 26px;">  
      <p><input type="file" name="filename" /></p>  
      <input type="submit"  id="postBtn" value="上传图片">  
    </form>    
  </div>  

EOT;
 include("./navigator_bar.php");
print <<<EOT
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
   