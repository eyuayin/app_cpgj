<?php
session_start();
if (isset($_SESSION['valid_user'])){
print <<<EOT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>New Role | Strass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">

    <link href="css/bootstrap.css" rel="stylesheet" />
	<link href="css/site.css" rel="stylesheet" />
    <link href="css/bootstrap-responsive.css" rel="stylesheet" />
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
				<h1>New Class <small>新建课程</small></h1>
			</div>
			<form class="form-horizontal" action="add_class.php" method="post" >
				<fieldset>
                    <div class="control-group">
                        <label class="control-label" for="begin_date">课程开始时间</label>
                        <div class="controls">
                            <input type="datetime-local" class="input-xlarge" id="begin_date" name="begin_date" required="required" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="end_date">课程结束时间</label>
                        <div class="controls">
                            <input type="datetime-local" class="input-xlarge" id="end_date" name="end_date" required="required" />
                        </div>
                    </div>
                     <div class="control-group">
                        <label class="control-label" for="class_name">课程名称</label>
                        <div class="controls">
                             <input type="text" id="class_name" name="class_name" class="input-xlarge"  required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="priority">常温/高温</label>
                        <div class="controls">
                            <select style="line-height:35px;" id="priority" name="priority" class="dropdown-select"  required="required"> <option value="1" selected>高温</option> <option value="2">常温</option></select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="location">上课地点</label>
                        <div class="controls">
                           <select style="line-height:35px;" id="location" name="location" class="dropdown-select"  required="required"> <option value="1">翠屏国际</option></select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="classroom">上课教室</label>
                        <div class="controls">
                             <select style="line-height:35px;" id="classroom" name="classroom" class="dropdown-select" required="required">
                               <option value="" selected="">请选择教室</option>
                                   <option value="1">一楼大教室</option>
                                   <option value="2">二楼大教室</option>
                                   <option value="3">二楼小教室</option>
                                   <option value="4">百家湖一楼教室</option>
                                   <option value="5">百家湖二楼教室</option>
                             </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="teacher">上课教师</label>
                        <div class="controls">
                            <input type="text" value="" class="input-xlarge" id="teacher" name="teacher" required="required" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="num_limit">课程预约人数限制</label>
                        <div class="controls">
                            <input type="text" value="20" class="input-xlarge" id="num_limit" name="num_limit" required="required" />
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-success btn-large" value="新增" /> <a class="btn" href="new-class.php">取消</a>
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
echo "<a href='login.html'>login</a>";
}
?>