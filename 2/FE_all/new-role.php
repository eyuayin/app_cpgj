<?php
session_start();
if(isset($_SESSION['valid_user'])){
print <<<EOT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>New Role | Strass</title>
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
				<h1>New Role <small>预约课程</small></h1>
			</div>
			<form class="form-horizontal" >
				<fieldset>
                    <div class="control-group" id="type_div">
                        <label class="control-label" for="search_type">请选择预约方式</label>
                        <div class="controls">
                            <select id="search_type" name="type" onchange="book_type_change()">
                                <option value="1" selected="selected" >姓名</option>
                                <option value="2" >卡号</option>
                            </select>
                        </div>
                    </div>
                        <div class="control-group" id="name_div">
                            <label class="control-label" for="name">请输入姓名</label>
                            <div class="controls">
                                <input style="height: 26px;" type="text" class="input-xlarge" id="name" name="search_value_name"/>
                            </div>
                        </div>
                        <div class="control-group" id="cardNo_div">
                            <label class="control-label" for="cardNo">请输入会员卡号</label>
                            <div class="controls">
                                <input style="height: 26px;" type="text" value="" class="input-xlarge" id="cardNo" name="search_value_card" />
                            </div>
                        </div>                    
                     <div class="control-group">
                        <label class="control-label" for="location">预约地点</label>
                        <div class="controls">
                            <td><select style="line-height:35px;" id="location" name="location" class="dropdown-select"><option value="2">君子兰</option></select></td>
                        </div>
                    </div>
                     <div class="control-group">
                        <label class="control-label" for="location">预约教室</label>
                        <div class="controls">
                            <td><select style="line-height:35px;" id="classroom" name="classroom" class="dropdown-select"><option value="1">一楼大教室</option><option value="2">二楼大教室</option><option value="3">一楼VIP</option><option value="4">二楼VIP-1</option><option value="5">二楼VIP-2</option><option value="6">二楼VIP-3</option></select></td>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="select_day">预约日期</label>
                        <div class="controls">
                           <input type="date" class="input-xlarge" id="select_day" name="select_day" onchange="check_class_change()">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="select_class">预约课程</label>
                        <div class="controls">
                             <select style="line-height:35px;" id="select_class" name="bookexpert" class="dropdown-select">
                               <option value="" selected="">请选择课程</option>
                             </select>
                        </div>
                    </div>
					<div class="control-group">
                        <label class="control-label" for="whetherWait">是否等待</label>
                        <div class="controls">
                            <td><select style="line-height:35px;" id="whetherWait" name="ifWait" class="dropdown-select"><option value="1">是</option><option value="0" selected="selected">否</option></select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="button" class="btn btn-success btn-large" value="提交" onClick="send_info()" /> <a class="btn" href="new-role.php">取消</a>
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
    <script src="js/new-role.js"></script>
    <script type="text/javascript" src="../main.js"></script>
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
