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
                    <h1>Search Class <small>查找已预约课程信息</small></h1>
                </div>
                <form class="form-horizontal" action="member_selected_classes.php" method="post">
                    <fieldset>
                        <!--<div class="control-group" id="search_type_div">-->
                            <!--<label class="control-label" for="search_type">请选择搜索类型</label>-->
                            <!--<div class="controls">-->
                                <!--<select id="search_type" name="search_type" onchange="search_type_change()">-->
                                    <!--<option value="1" selected="selected">按姓名搜索</option>-->
                                    <!--&lt;!&ndash;<option value="2" >按卡号搜索</option>&ndash;&gt;-->
                                <!--</select>-->
                            <!--</div>-->
                        <!--</div>-->
                        <div class="control-group" id="name_div">
                            <label class="control-label" for="name">请输入姓名</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="name" name="name" required="required"/>
                            </div>
                        </div>
                        <div class="control-group" id="cardNo_div">
                            <label class="control-label" for="begin_time">请输入起始时间</label>
                            <div class="controls">
                                <input type="date" class="input-xlarge" id="begin_time" name="begin_time" required="required"/>
                            </div>
                        </div>
                        <!--<div class="control-group" id="phone_div">-->
                            <!--<label class="control-label" for="phone">请输入手机号码</label>-->
                            <!--<div class="controls">-->
                                <!--<input type="text" class="input-xlarge" id="phone" name="phone" required="required"/>-->
                            <!--</div>-->
                        <!--</div>-->
                        <div class="form-actions">
                            <input type="submit" class="btn btn-success btn-large" value="搜索"/> <a class="btn" href="#">取消</a>
                        </div>
                    </fieldset>
                </form>
                <table id="tab" border="1" width="60%" align="center" style="margin-top:20px"></table>
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
<!--<script src="js/search_user.js"></script>-->
</body>
</html>
EOT;
}
else{
echo "please login first!";
echo "<a href='login.html'>login</a>";
}
?>
