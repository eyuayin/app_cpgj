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
    <script> 
          $(function() 
          {
               //关闭异步
                $.ajaxSetup (
                {
                    async: false
                });
              
                var availableTags = new Array();//定义一个函数内的数组，用于存放姓名
                
                //请求后台数据
                $.post("queryMemberNameBankend.php",
                function(data,status)
                {
                      //console.log("data is:",data);
                      data = JSON.parse(data);
                        //将数组对象转换成数组
                        var i = 0; 
                        for(i=0;i<data.length;i++)
                        {
                          
                          availableTags.push(data[i]);
                        }      
                });       
                 
                //console.log("availableTags outside is:",availableTags);
                $( "#name" ).autocomplete(
                    {
                      source: availableTags
                    });
          });
  
  
  </script>

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
                    <h1>Search User <small>查找会员信息</small></h1>
                </div>
                <form class="form-horizontal" action="../search_user_cui.php" method="post">
                    <fieldset>
                            <div class="control-group" id="search_type_div">
                                <label class="control-label" for="search_type">请选择搜索类型</label>
                                <div class="controls">
                                    <select id="search_type" name="type" onchange="search_type_change()">
                                        <option value="1" selected="selected">按姓名搜索</option>
                                        <option value="2" >按手机号搜索</option>
                                        <option value="3">按卡号搜索</option>
                                    </select>
                                </div>
                            </div>
                        <div class="control-group" id="name_div">
                            <label class="control-label" for="name">请输入姓名</label>
                            <div class="controls">
                                <input style="height: 26px;" type="text" class="input-xlarge" id="name" name="search_value_name">
                            </div>
                        </div>
                        <div class="control-group" id="cardNo_div">
                            <label class="control-label" for="cardNo">请输入会员卡号</label>
                            <div class="controls">
                                <input style="height: 26px;" type="text" value="" class="input-xlarge" id="cardNo" name="search_value_card" >
                            </div>
                        </div>
                        <div class="control-group" id="phone_div">
                            <label class="control-label" for="phone">请输入手机号码</label>
                            <div class="controls">
                                <input  style="height: 26px;" type="text" class="input-xlarge" id="phone" name="search_value_phone">
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

