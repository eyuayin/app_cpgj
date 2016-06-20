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
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    
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
                    <h1>Search User <small>分类查找会员卡信息</small></h1>
                </div>
                <form class="form-horizontal" action="../search_by_card_time_be.php" method="post">
                    <fieldset>
                            <div class="control-group" id="search_type_div">
                                <label class="control-label" for="search_type">请选择卡类型</label>
                                <div class="controls">                                            
                                    <select id="card_type" name="card_type">
                                        <option value="1" selected="selected">年卡</option>
                                        <option value="8">年卡(不限次)</option>
                                        <option value="9">私教卡</option>
                                        <option value="10">精品课卡</option>
                                        <option value="2" >半年卡</option>
                                        <option value="3">季卡</option>
                                        <option value="4">月卡</option>
                                        <option value="5">次卡</option>
                                        <option value="6">学期周卡</option>
                                        <option value="7">学期次卡</option>  
                                    </select>    
                                </div>
                            </div>
                            <div class="control-group" id="name_div">
                                <label class="control-label" for="name">请选择查询起始时间</label>
                                <div class="controls">
                                    <input type="date" class="input-xlarge" id="serach_begin_time" name="serach_begin_time">
                                </div>
                            </div>
                            <div class="control-group" id="name_div">
                                <label class="control-label" for="name">请选择查询截止时间</label>
                                <div class="controls">
                                    <input type="date" class="input-xlarge" id="serach_end_time" name="serach_end_time">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success btn-large" value="搜索"  onclick='window.location.reload()'> <a class="btn" href="#">取消</a>
                            </div>
                        </fieldset>
                    </form>
                <table id="tab" border="1" width="60%" align="center" style="margin-top:20px"></table>
            </div>
        </div>
    </div>



EOT;
      include("./page_footer.php");
print <<<EOT

</div>

<script src="js/bootstrap.min.js"></script>
<script src="js/search_user.js"></script>

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

