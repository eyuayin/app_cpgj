<?php
session_start();
if(isset($_SESSION['valid_user'])) {
    print <<<EOT
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8"></meta>
        <title>Users | Strass</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
        <meta name="description" content="Admin panel developed with the Bootstrap from Twitter."></meta>
        <meta name="author" content="travis"></meta>
        <link href="css/bootstrap.css" rel="stylesheet"></link>
        <link href="css/site.css" rel="stylesheet"></link>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"></link>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script src="js/bookPrivateClass.js"></script>         
		<link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
				<!--[if lt IE 9]>
         <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
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
                      console.log("data is:",data);
                      data = JSON.parse(data);
                        //将数组对象转换成数组
                        var i = 0; 
                        for(i=0;i<data.length;i++)
                        {
                          
                          availableTags.push(data[i]);
                        }      
                });       
                 
                //console.log("availableTags outside is:",availableTags);
                $( "#memeber_name" ).autocomplete(
                    {
                      source: availableTags
                    });
          });
  
  
  </script>
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
                        <h1>Search <small>查询</small></h1>
                    </div>
                     <div class="ui-widget" style="margin-bottom:23px;">		  
		                <button class="btn-large" data-toggle="modal" data-target="#otherClass" data-whatever="@mdo">开卡信息查询</button>
                     </div>
                      <div class="ui-widget" style="margin-bottom:23px;">		  
		                <button class="btn-large" data-toggle="modal" data-target="#otherClass" data-whatever="@mdo">即将到期卡信息查询</button>
                     </div>
                      <div class="ui-widget" style="margin-bottom:23px;">		  
		                <button class="btn-large" data-toggle="modal" data-target="#otherClass" data-whatever="@mdo">已到期卡信息查询</button>
                     </div>
                      <div class="ui-widget" style="margin-bottom:23px;">		  
		                <button class="btn-large" data-toggle="modal" data-target="#otherClass" data-whatever="@mdo">出勤频率查询</button>
                     </div>
                     <div>
EOT;
 
}
else
echo "<a href='login.html'>Click to login first!</a>";


require("../constant_var_define.php");

?>
 
        </table>
        </div>            
		<div class="modal fade" id="otherClass" tabindex="-1" role="dialog" aria-labelledby="otherLabel" style="top: 62%;">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="otherLabel">私教预约</h4>
			  </div>
			  <div class="modal-body">
				<form>
				  <div class="form-group">
					<label for="date" class="control-label">预约日期:</label>
					<input type="date" class="form-control" id="date">
				  </div>
                  <div class="form-group">
					<label for="begin" class="control-label">上课时间:</label>
					<input type="time" class="form-control" id="begin">
				  </div>
                  <div class="form-group">
					<label for="end" class="control-label">下课时间:</label>
					<input type="time" class="form-control" id="end">
				  </div>
				  <div class="form-group">
					<label for="classroom" class="control-label">预约教室:</label>
					<select id="classroom"><option>一楼VIP</option><option>二楼VIP_1</option><option>二楼VIP_2</option><option>二楼VIP_3</option></select>
				  </div>
                  <div class="form-group">
					<label for="teacher" class="control-label">授课教师:</label>
					<input type="text" class="form-control" id="teacher">
				  </div>
                  <div class="form-group">
					<label for="memeber_name" class="control-label">预约会员:</label>
                    <input type="text" class="form-control" id="memeber_name">
				  </div>
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary" onClick="bookConfirm();">确定</button>
			  </div>
			</div>
		  </div>
		</div>
       
        <script src="js/bootstrap.min.js"></script>
        <script src="//www.w3cschool.cc/try/angularjs/1.2.5/angular.min.js"></script>    

    </body>
</html>





