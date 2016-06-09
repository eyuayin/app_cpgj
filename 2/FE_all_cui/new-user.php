<?php
session_start();
if (isset($_SESSION['valid_user'])) {
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
				<h1>New User <small>新增会员信息</small></h1>
			</div>
			<form class="form-horizontal" action="add_member.php" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="name">姓名</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="name" name="name" required="required"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="sex">性别</label>
						<div class="controls">
							<select id="sex" name="gender">
								<option value="male">男</option>
								<option value="female" selected>女</option>
							</select>
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label" for="id">身份证号</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="id" name="id_num" value="0"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="cardNo">会员卡号</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="cardNo" name="cardNo" required="required"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="birthday">会员生日</label>
						<div class="controls">
							<input type="date" class="input-xlarge" value="1985-01-01" id="birthday" name="birthday"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="phone">手机号码</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="phone" name="phone"/>
						</div>
					</div>
                    <div class="control-group" >
                        <label class="control-label" for="select_card_type">会员卡类型</label>
                        <div class="controls">
                            <select style="line-height:35px;" id="select_card_type" name="card_type" class="dropdown-select" onchange="card_type_change()"><option value="" selected="">请选择卡类型</option><option value="年卡">年卡</option><option value="年卡(不限次)">年卡(不限次)</option><option value="半年卡" >半年卡</option><option value="季卡">季卡</option><option value="月卡">月卡</option><option value="学期周卡">学期周卡</option><option value="学期次卡">学期次卡</option><option value="次卡">次卡</option><option value="私教卡">私教卡</option><option value="精品课卡">精品课卡</option></select>
                        </div>
                    </div>
                    <div class="control-group" id="times_per_week_div">
                        <label class="control-label" for="times_per_week">一周内约课次数限制</label>
                        <div class="controls">
                            <input type="text" value="7" class="input-xlarge" id="times_per_week" name="times_per_week"/>
                        </div>
                    </div>
                    <div class="control-group" id="total_times_div">
                        <label class="control-label" for="total_times">总次数</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="total_times" name="total_times"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="temp">高温/常温</label>
                        <div class="controls">
                            <select id="temp" name="temp">
                                <option value="1" selected>高温</option>
                                <option value="2" >常温</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="if_active">是否激活</label>
                        <div class="controls">
                            <select id="if_active" name="if_active" onchange="active_change()">
                                <option value="1" >激活</option>
                                <option value="0" selected>不激活</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group" id="begin_date_div">
                        <label class="control-label" for="begin_date">开卡日期</label>
                        <div class="controls">
                            <input type="date"  class="input-xlarge" id="begin_date" name="begin_date"/>
                        </div>
                    </div>
                    <div class="control-group" id="end_date_div">
                        <label class="control-label" for="end_date">卡失效日期</label>
                        <div class="controls">
                            <input type="date"  class="input-xlarge" id="end_date" name="end_date" value="end_date"/>
                        </div>
                    </div>

					<div class="form-actions">
						<input type="submit" class="btn btn-success btn-large" value="添 加" /> <a class="btn" href="users.php">取消</a>
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
	<script src="js/input_change_card_type.js"></script>
  </body>
</html>
EOT;
}
        else
        echo "<a href='login.html'>please go Login in first</a>";

?>



