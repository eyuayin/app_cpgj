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
        <script src="js/bookMinClass.js"></script>         
		<link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
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
                        <h1>Quality Classes <small>课程信息列表</small></h1>
                    </div>
                     <div class="ui-widget" style="margin-bottom:23px;">		  
		                <button class="btn-large" data-toggle="modal" data-target="#otherClass" data-whatever="@mdo">点击此处新增精品课</button>
                     </div>
                     <div>
                     <table class="table table-striped table-bordered table-condensed" id="table">
                       <thead>
                          <tr>
                            <td>课程序号</td>
                            <td>上课时间</td>
                            <td>下课时间</td>
                            <td>精品课授课教师</td>
                            <td>精品课授课教室</td> 
                            <td>新增预约会员</td>
                            <td>查看预约会员</td>
                          </tr>
                       </thead>
                       <tbody>
                     
                     
                     
                    
EOT;
 
}
else
echo "<a href='login.html'>Click to login first!</a>";


require("../constant_var_define.php");

    //连接数据库的参数
$conn = db_connect();

$st = $conn->query("select * from personal_class_info_table ORDER BY class_begin_time DESC");

$rs = $st->fetchAll();
     
foreach ($rs as $value) 
    {
                    echo "<tr>";
                    echo "<td>{$value[0]}</td>";  //class_id
                    echo "  <td >{$value[1]}</td>";  //begin
                    echo "  <td>{$value[2]}</td>";  //end
                    echo "  <td>{$value[5]}</td>";  //teacher
                    echo "  <td>{$classroom_num_to_name[$value[4]]}</td>";  //classroom
                    echo "<td>";
                    echo "<a class='btn-info' data-toggle='modal' data-target='#insertMeb' data-whatever='@mdo'  onclick='get_booking_info(this);'>新增</a>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='./list_booked_members_min.php?class_id=$value[0]' class='btn-info'>查看会员</a>";
                    echo "</td>";
                    echo "</tr>";                   
    }

?>
        </tbody>
        </table>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="//www.w3cschool.cc/try/angularjs/1.2.5/angular.min.js"></script>                
		<div class="modal fade" id="otherClass" tabindex="-1" role="dialog" aria-labelledby="otherLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="otherLabel">新增精品课</h4>
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
					<select id="classroom"><option value="3" >一楼VIP</option><option value="4">二楼VIP_1</option><option value="5">二楼VIP_2</option><option value="6">二楼VIP_3</option></select>
				  </div>
                  <div class="form-group">
					<label for="teacher" class="control-label">授课教师:</label>
					<input type="text" class="form-control" id="teacher">
				  </div>
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary" onClick="insertConfirm();" data-dismiss="modal">确定</button>
			  </div>
			</div>
		  </div>
		</div>
       
       <div class="modal fade" id="insertMeb" tabindex="-1" role="dialog" aria-labelledby="otherLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="otherLabel">预约会员</h4>
			  </div>
			  <div class="modal-body">
				<form id="memberNameModel">
                  <div style="display:none;" id="begin_time" >
				  </div>
                  <div style="display:none;" id="class_id" >
				  </div>
   				  <div class="form-group" id="mebname" >
					<label for="memberName" class="control-label">会员姓名:</label>
					<input type="text" class="form-control abc" id="memberName">
                    <a class="btn btn-info" onClick="addMoreMeb();" >添加更多会员</a>
				  </div>                  
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary" onClick="insertMebConfirm();" data-dismiss="modal">确定</button>
			  </div>
			</div>
		  </div>
		</div>
       

    </body>
</html>





