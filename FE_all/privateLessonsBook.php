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
                        <h1>Classes <small>课程信息列表</small></h1>
                    </div>
                     <div class="ui-widget" style="margin-bottom:23px;">
		  
		                <a data-toggle="modal" data-target="#otherClass" data-whatever="@mdo">点击此处预约其他时间段课程</a>
                     </div>
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr id="addWeek">
							<th class="today-3"></th>
							<th class="today-2"></th>
							<th class="today-1"></th>
							<th class="today"></th>
							<th class="tomorrow"></th>
							<th class="afterTomorrow"></th>
							<th class="houtian"></th>
                            </tr>
                        </thead>
						<tbody>
						<tr>						
                        <td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约一楼VIP</a>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">私教预约</h4>
			  </div>
			  <div class="modal-body">
				<form>
                <div class="form-group">
					<label for="recipient-begin" class="control-label">上课时间:</label>
					<input type="time" class="form-control" id="recipient-begin">
				  </div>
                  <div class="form-group">
					<label for="recipient-end" class="control-label">下课时间:</label>
					<input type="time" class="form-control" id="recipient-end">
				  </div>
				  <div class="form-group">
					<label for="recipient-name" class="control-label">授课教师:</label>
					<input type="text" class="form-control" id="recipient-name">
				  </div>
				  <div class="form-group">
					<label for="message-text" class="control-label">预约会员姓名:</label>
					<textarea class="form-control" id="message-text"></textarea>
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
						</td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约一楼VIP</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约一楼VIP</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约一楼VIP</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约一楼VIP</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约一楼VIP</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约一楼VIP</a></td>
						</tr>
						<tr>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-3</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-3</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-3</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-3</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-3</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-3</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-3</a></td>

						</tr>
						<tr>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-2</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-2</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-2</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-2</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-2</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-2</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-2</a></td>

						</tr>
						<tr>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-1</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-1</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-1</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-1</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-1</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-1</a></td>
						<td><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">预约二楼VIP-1</a></td>
						</tr>
						</tbody>
                   <div>
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                     <tr>
                       <td>上课时间</td>
                       <td>下课时间</td>
                       <td>教室</td>
                       <td>老师</td>
                       <td>会员</td>
                     </tr>  
                    </thead>                     
                    </table>                     
                    </div>
EOT;


    require("../constant_var_define.php");

   /*
    //连接数据库
    $conn = db_connect();

    //求总记录数
    $st = $conn->query("select count(*) from class_info_table");
    $rs = $st->fetchAll();

    $totalRow = $rs[0][0];  //总记录数
    $totalPage = ceil($totalRow / $pageSize); //总页数

    if ($currentPage >= $totalPage)  //到达最后页
    {
        $lastpage = $currentPage - 1;
        $nextpage = $totalPage;
    } else if ($currentPage == 1)  //到达首页
    {
        $lastpage = 1;
        $nextpage = $currentPage + 1;
    } else    //除了首页、尾页的中间页
    {
        $lastpage = $currentPage - 1;
        $nextpage = $currentPage + 1;
    }

    $st = $conn->query("select * from (select * from classroom order by index) a limit {$start},$pageSize");
    debug_output("select * from (select * from class_info_table order by class_begin_time desc) a limit {$start},$pageSize");
    $rs = $st->fetchAll();

    //显示所有记录
    foreach ($rs as $value) {
        //查出当前class_id已约人数（waiting_No为0的）
        $query_result = $conn->query("select count(*) from class_booking_table where class_id=$value[0] and waiting_No=0 and canceled=0");
        debug_output("select count(*) from class_booking_table where class_id=$value[0] and waiting_No=0 and canceled=0");
        $result = $query_result->fetch();
        $db_booking_num = $result[0]; //当前课程实际预约人数
        debug_output("实际上课人数是：".$db_booking_num);
        $q_result = $conn->query("update class_info_table set selected_user_number=$db_booking_num where class_id=$value[0]");
        debug_output("update class_info_table set selected_user_number=$db_booking_num where class_id=$value[0]");

        //查出当前课程最大等待的编号
        $query_result = $conn->query("select waiting_No from class_booking_table where class_id=$value[0] order by waiting_No desc");
        debug_output("select waiting_No from class_booking_table where class_id=$value[0] order by waiting_No desc");
        $result = $query_result->fetch();
        $db_max_waiting_No = $result[0]; //当前课程中最大的等待号码
        if (empty($db_max_waiting_No))   //为空时，则认为无人等待
        {
            $db_max_waiting_No = 0;
        }

        $cal_location_class = $location_num_to_name[$value[4]] . $classroom_num_to_name[$value[5]];
        debug_output("地点编号：" . $value[4]);
        debug_output("教室编号：" . $value[5]);
        debug_output("地点：" . $location_num_to_name[$value[4]]);
        debug_output("教室：" . $classroom_num_to_name[$value[5]]);
        debug_output("上课地点：" . $cal_location_class);

print <<<EOT
        <tbody>
        <tr>
             <td>{$value[1]}</td>
             <td>{$value[2]}</td>
             <td>{$value[3]}</td>
             <td>{$value[6]}</td>
             <td>$cal_location_class</td>
             <td>{$value[7]}</td>
             <td>$db_booking_num</td>
             <td>$db_max_waiting_No</td>
             <td><a href="list_booked_members.php?begin_time=$value[2]&location=$value[4]&classroom=$value[5]&class_id=$value[0]">查看会员</a></td>
             <td><a href="delete_class.php?begin_time=$value[2]&location=$value[4]&classroom=$value[5]" onClick="return confirm('确认要删除？')">删除</a></td>
        </tr>
        </tbody>
EOT;
    }

    //关闭数据库
    unset($rs);
    unset($st);
    unset($conn);

}
*/
}
else
echo "<a href='login.html'>Click to login first!</a>";

?>
 
           
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="//www.w3cschool.cc/try/angularjs/1.2.5/angular.min.js"></script>
        <script>
            $(document).ready(function() {
				function GetDateStr(AddDayCount) { 
					var dd = new Date(); 
					dd.setDate(dd.getDate()+AddDayCount);//获取AddDayCount天后的日期 
					var y = dd.getFullYear(); 
					var m = dd.getMonth()+1;//获取当前月份的日期 
					var d = dd.getDate(); 
					var w = dd.getDay();
					if(w == 0)
					 return y+"-"+m+"-"+d+" "+"星期日";
                    else
					 return y+"-"+m+"-"+d+" "+"星期"+w;
                } 
				
				//var mydate = new Date();
                //var currentWeek = mydate.getDay(); //获取当前星期X(0-6,0代表星期天)
                //var currentDate = mydate.toLocaleDateString()+9; //获取当前日期
				//console.log("date is:",currentDate);
                 
				 $(".today").text(GetDateStr(0));//显示今天日期
				 $(".today-1").text(GetDateStr(-1));//显示昨天日期
				 $(".today-2").text(GetDateStr(-2));
				 $(".today-3").text(GetDateStr(-3));
				 $(".tomorrow").text(GetDateStr(1));//显示明天日期
				 $(".afterTomorrow").text(GetDateStr(2));
				 $(".houtian").text(GetDateStr(3));					 
            });
			$(function(){
		       $("td").bind("click",function(){
				
		    });
	});
	
		  $(function() {
			var availableTags = [
			  "ActionScript",
			  "AppleScript",
			  "Asp",
			  "BASIC",
			  "C",
			  "C++",
			  "Clojure",
			  "COBOL",
			  "ColdFusion",
			  "Erlang",
			  "Fortran",
			  "Groovy",
			  "Haskell",
			  "Java",
			  "JavaScript",
			  "Lisp",
			  "Perl",
			  "PHP",
			  "Python",
			  "Ruby",
			  "Scala",
			  "Scheme"
			];
			$( "#tags" ).autocomplete({
			  source: availableTags
			});
		  });
          </script>
		 
          
		<div class="modal fade" id="otherClass" tabindex="-1" role="dialog" aria-labelledby="otherLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="otherLabel">私教预约</h4>
			  </div>
			  <div class="modal-body">
				<form>
				  <div class="form-group">
					<label for="date" class="control-label">预约时间:</label>
					<input type="date" class="form-control" id="date">
				  </div>
				  <div class="form-group">
					<label for="classroom" class="control-label">预约教室:</label>
					<textarea class="form-control" id="classroom"></textarea>
				  </div>
                  <div class="form-group">
					<label for="teacher" class="control-label">授课教师:</label>
					<textarea class="form-control" id="teacher"></textarea>
				  </div>
                  <div class="form-group">
					<label for="vip" class="control-label">预约会员:</label>
					<textarea class="form-control" id="vip"></textarea>
				  </div>
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary">确定</button>
			  </div>
			</div>
		  </div>
		</div>
       

    </body>
</html>





