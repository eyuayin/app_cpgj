<?php
session_start();
if (isset($_SESSION['valid_user'])){
    print <<<EOT
<html>
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
                    <h1>Search Class <small>查找课程信息</small></h1>
                </div>
                <form class="form-horizontal" action="../search_class.php" method="post">
                        <div class="control-group" id="name_div">
                            <label class="control-label" for="name">请输入日期</label>
                            <div class="controls">
                                <input type="date" class="input-xlarge" id="name" name="date" style="height: 27px" required="required"/>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" class="btn btn-success btn-large" value="搜索" /> <a class="btn" href="#">取消</a>
                        </div>
                </form>
                <table id="tab" border="1" width="60%" align="center" style="margin-top:20px"></table>
            </div>
        </div>
    </div>



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
    echo "<br/>";
    echo "<a href='login.html'>login</a>";
}
?>