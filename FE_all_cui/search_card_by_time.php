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
                    <h1>Search<small>查询各类卡信息</small></h1>
                </div>
                <form class="form-horizontal" action="search_card_by_time_be.php" method="post">
                    <fieldset>
                            <div class="control-group" id="search_type_div">
                                <label class="control-label" for="search_type">请选择搜索类型</label>
                                <div class="controls">
                                    <select id="search_type" name="type" onchange="search_type_change()">
                                        <option value="0" selected="selected">开卡信息查询</option>
                                        <option value="2" >到期卡信息查询</option>
                                        <option value="3">出勤频率查询</option>
                                    </select>
                                </div>
                            </div>
                        <div class="control-group" id="name_div">
                            <label class="control-label" for="name">请输入查询开始日期</label>
                            <div class="controls">
                                <input style="height: 26px;" type="date" class="input-xlarge" id="name" name="begin_time" required="required">
                            </div>
                        </div>
                        <div class="control-group" id="cardNo_div">
                            <label class="control-label" for="cardNo">请输入查询截止日期</label>
                            <div class="controls">
                                <input style="height: 26px;" type="date" value="" class="input-xlarge" id="cardNo" name="end_time" required="required" >
                            </div>
                        </div>
                         <div class="control-group" >
                        <label class="control-label" for="select_card_type">会员卡类型</label>
                        <div class="controls">
                            <select style="line-height:35px;" id="select_card_type" name="card_type" class="dropdown-select" onchange="card_type_change()"><option value="0" selected="">不限类型</option><option value="1">年卡</option><option value="8">年卡(不限次)</option><option value="2" >半年卡</option><option value="3">季卡</option><option value="4">月卡</option><option value="6">学期周卡</option><option value="7">学期次卡</option><option value="5">次卡</option><option value="9">私教卡</option><option value="10">精品课卡</option></select>
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
<script src="js/search.js"></script>

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

