<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8"/>
    <title>Users | Strass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Admin panel developed with the Bootstrap from Twitter."/>
    <meta name="author" content="travis"/>
    <link href="FE_all_cui/css/bootstrap.css" rel="stylesheet"/>
    <link href="FE_all_cui/css/site.css" rel="stylesheet"/>
    <link href="FE_all_cui/css/bootstrap-responsive.css" rel="stylesheet"/>
    <script src="FE_all_cui/js/jquery.js"></script>
    <script src="FE_all_cui/js/bootstrap.min.js"></script>
    <link href="FE_all_cui/css/bootstrap.css" rel="stylesheet" />
    <link href="FE_all_cui/css/site.css" rel="stylesheet" />
    <link href="FE_all_cui/css/bootstrap-responsive.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<style type="text/css">
    .white_content{
        display: none;
        position: absolute;
        top: 25%;  left: 25%;
        width: 50%;
        height: 50%;
        padding: 16px;
        border: 1px solid black;
        background-color: white;
        z-index:1002;
        overflow:auto
    }
</style>
<body>
 <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"> 翠屏国际会员管理系统 </a>
          <div class="btn-group pull-right">
			<a class="btn" href="my-profile.html"><i class="icon-user"></i> Admin</a>
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
			  <!--<li><a href="my-profile.html">Profile</a></li>-->
              <!--<li class="divider"></li>-->
              <li><a href="destroy.php">Logout</a></li>
            </ul>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
			<li><a href="/FE_all_cui/index.php">首页</a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">会员信息 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="/FE_all_cui/new-user.php">新增会员</a></li>
					<li class="divider"></li>
					<li><a href="/FE_all_cui/users.php">查看所有会员</a></li>
                    <li class="divider"></li>
                    <li><a href="/FE_all_cui/search_and_update_user.php">查找会员</a></li>
                    <li class="divider"></li>
                    <li><a href="/FE_all_cui/delete-user.php">删除会员</a></li>
				</ul>
			  </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">预约管理 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="/FE_all_cui/new-role.php">预约课程</a></li>
					<li class="divider"></li>
					<li><a href="/FE_all_cui/query_booked_class.php">预约查询</a></li>
				</ul>
			  </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">课程管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/FE_all_cui/new-class.php">新建课程</a></li>
                        <li class="divider"></li>
                        <li><a href="/FE_all_cui/search_and_update_class.php">课程查询</a></li>
                        <li class="divider"></li>
                        <li><a href="/FE_all_cui/all_class_info.php">所有课程列表</a></li>
                        <li class="divider"></li>
                        <li><a href="/FE_all_cui/upload_class.php">导入本月课程</a></li>
                 </ul>
                </li>
				 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">小班课管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/FE_all_cui/new-class.php">新建小班课</a></li>
                        <li class="divider"></li>
                        <li><a href="/FE_all_cui/search_and_update_class.php">小班课查询</a></li>
                        <li class="divider"></li>
                        <li><a href="/FE_all_cui/all_class_info.php">小班课预约</a></li>
                 </ul>
                </li>
				 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">私教管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/FE_all_cui/new-class.php">新建私教课程</a></li>
                        <li class="divider"></li>
                        <li><a href="/FE_all_cui/search_and_update_class.php">私教课程查询</a></li>
                        <li class="divider"></li>
                        <li><a href="/FE_all_cui/all_class_info.php">私教预约</a></li>
                    </ul>
                </li>
				<li class="dropdown"><a href="./FE_all/index.php">切换君子兰馆</a>
			    </li>
                </ul>

          </div>
        </div>
      </div>
    </div>

<div class="container-fluid">
<div class="row-fluid">
<div class="span9">
<div class="row-fluid">
<div class="page-header">
    <h1>Classes <small>课程信息列表</small></h1>
</div>
<div id="light" class="white_content">
    <div id="dituContent">
        <form action="modify_class_cui.php" method="post"  onsubmit="return check_input_valid();">
            <div class="control-group">
                <label class="control-label" for="begin_date">课程开始时间</label>
                <div class="controls">
                    <input type="datetime" class="input-xlarge" id="begin_date" name="begin_date" required="required" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="end_date">课程结束时间</label>
                <div class="controls">
                    <input type="datetime" value="$value[3]" class="input-xlarge" id="end_date" name="end_date" required="required" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="class_name">课程名称</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="class_name" name="class_name" required="required" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="teacher_name">授课教师</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="teacher_name" name="teacher_name" required="required" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="priority">常温/高温</label>
                <div class="controls">
                    <select style="line-height:35px;" id="priority" name="priority" class="dropdown-select"  required="required"> <option value="1" >高温</option> <option value="2" selected="selected">常温</option></select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="class_location">上课地点</label>
                <div class="controls">
                    <select style="line-height:35px;" id="class_location" name="class_location" class="dropdown-select"  required="required"> <option value="翠屏国际" >翠屏国际</option></select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="class_room">上课教室</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="class_room" name="class_room" required="required" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="num_limit">课程预约人数限制</label>
                <div class="controls">
                    <input type="text"  class="input-xlarge" id="num_limit" name="num_limit" required="required" />
                </div>
            </div>
            <input type="hidden"  class="input-xlarge" id="former_begin_date" name="former_begin_date" />
            <input type="hidden"  class="input-xlarge" id="former_classroom" name="former_classroom"  />
            <input type="hidden"  class="input-xlarge" id="former_location" name="former_location"/>
            <input type="submit" class="btn btn-success btn-large" value="确认修改"/> <a class="btn" href="#" onClick="document.getElementById('light').style.display='none';" >取消</a>
        </form>
    </div>
</div>
<table class="table table-striped table-bordered table-condensed" id="table_id">
<thead>
<tr>  
    <th>课程 ID</th>
    <th>课程名称</th>
    <th>优先级</th>    
    <th>课程开始时间</th>
    <th>课程结束时间</th>
    <th>授课老师</th>
    <th>授课地点</th>
    <th>授课教室</th>
    <th>预约人数限制</th>
    <th>预约人数</th>
    <th>实到人数</th>
    <th>等待预约人数</th>
    <th>点击查看已约课会员信息</th>
    <th>删除课程</th>
    <th>修改课程</th>
</tr>
</thead>

<?php

require("./constant_var_define.php");

$currentPage = $_GET["currentPage"];//当前下显示第几页
$currentPage = $currentPage==NULL?1:$currentPage;
$pageSize = 15; //每页显示的记录数
$start = ($currentPage-1)*$pageSize;//每页记录起始值

$selected_date = $_POST['date'];
$selected_date_begin =  $selected_date." "."00:00:00";
$selected_date_end =  $selected_date." "."23:59:59";

$conn = db_connect();

$st = $conn->query("select * from (select * from class_info_table_cui order by class_begin_time)  as table_a where class_begin_time between '".$selected_date_begin."' and '".$selected_date_end."'");
debug_output("select * from (select * from class_info_table_cui order by class_begin_time) as table_a  where class_begin_time between '".$selected_date_begin."' and '".$selected_date_end."'");
$rs = $st->fetchAll();

//显示所有记录
foreach($rs as $value)
{
    //查出当前课程最大等待的编号
    //$query_result = $conn->query("select waiting_No,sign_in from class_booking_table_cui where class_id=$value[0] order by waiting_No desc");
    //debug_output("select waiting_No from class_booking_table_cui where class_id=$value[0] order by waiting_No desc");
    //$result = $query_result->fetchAll();
    //$db_max_waiting_No = $result[0]; //当前课程中最大的等待号码
    ///if(empty($db_max_waiting_No))   //为空时，则认为无人等待
    //{
    //    $db_max_waiting_No = 0;
    //}
    
    //$db_attendees_No = 0;
    
    //计算已签到人数
    //foreach($result as $qr){
    //    $db_attendees_No = $db_attendees_No+$qr[1];
    //}
    //echo "$db_attendees_No";
    //echo $db_attendees_No;

    //查出预约上课人数
    $q_result = $conn->query("select count(*) from class_booking_table_cui where class_id=$value[0] and waiting_No=0 and canceled=0");
    debug_output("select count(*) from class_booking_table_cui where class_id=$value[0] and waiting_No=0 and canceled=0");
    $q_value = $q_result->fetch();
    $db_booking_num = $q_value[0];
    debug_output("预约上课人数是：".$db_booking_num);
    $q_result = $conn->query("update class_info_table_cui set selected_user_number=$db_booking_num where class_id=$value[0]");
    debug_output("update class_info_table_cui set selected_user_number=$db_booking_num where class_id=$value[0]");

    //查出实际签到人数
    $q_result = $conn->query("select count(*) from class_booking_table_cui where class_id=$value[0] and sign_in=1 and waiting_No=0 and canceled=0");
    debug_output("select count(*) from class_booking_table_cui where class_id=$value[0] and sign_in=1 and waiting_No=0 and canceled=0");
    $q_value = $q_result->fetch();
    $db_attendees_No = $q_value[0];
    debug_output("实际签到人数是：".$db_attendees_No);

    debug_output("地点编号：".$value[4]);
    debug_output("教室编号：".$value[5]);
    debug_output("地点：".$location_num_to_name[$value[4]]);
    debug_output("教室：".$classroom_num_to_name_cui[$value[5]]);

    print <<<EOT
        <tbody>
        <tr>
        <td>{$value[0]}</td>
        <td>{$value[1]}</td>
        <td>{$class_priority_num_to_name[$value[9]]}</td>        
        <td>{$value[2]}</td>
        <td>{$value[3]}</td>
        <td>{$value[6]}</td>
        <td>{$location_num_to_name[$value[4]]}</td>
        <td>{$classroom_num_to_name_cui[$value[5]]}</td>
        <td>{$value[7]}</td>
        <td>$db_booking_num</td>
        <td>$db_attendees_No</td>        
        <td>0</td>
        <td><a href="./FE_all_cui/list_booked_members.php?begin_time=$value[2]&location=$value[4]&classroom=$value[5]&class_id=$value[0]">查看会员</a></td>
        <td><a href="./FE_all_cui/delete_class.php?class_id=$value[0]" onClick="return confirm('确认要删除？')">删除</a></td>
        <td class="modify_class_info" style="cursor:pointer"><a>修改</a></td>
        </tr>
        </tbody>


EOT;
}

//关闭数据库
unset($rs);
unset($st);
unset($conn);
?>

</table>

<div class="row" style="margin-left:10px;">
    <a href="FE_all_cui/new-role.php" class="btn btn-success col-md-6">预约课程</a>
    <a href="FE_all_cui/search_and_update_class.php" class="btn btn-success col-md-6">预约查询</a>
</div>
</div>
</div>
</div>
<footer class="well">
     <a target="_blank" title="天环瑜伽">天环瑜伽</a> - Collect from <a href="#" title="南京沃卓" target="_blank">南京沃卓</a>
</footer>

</div>


<!--<script src="//www.w3cschool.cc/try/angularjs/1.2.5/angular.min.js"></script>-->
<script>
    $(document).ready(function() {
        $('.dropdown-menu li a').hover(
            function () {
                $(this).children('i').addClass('icon-white');
            },
            function () {
                $(this).children('i').removeClass('icon-white');
            });

        if ($(window).width() > 760) {
            $('tr.list-users td div ul').addClass('pull-right');
        }
    });

    function myrefresh() 
    { 
       window.location.reload(); 
    } 
    setTimeout('myrefresh()', 300000); //指定5分钟刷新一次 

    $(".modify_class_info").click(function(){
        document.getElementById('light').style.display='block';
        var className = $(this).parent().children("td:eq(1)").text();
        var priority = $(this).parent().children("td:eq(2)").text();
        var begin_time = $(this).parent().children("td:eq(3)").text();
        var end_time = $(this).parent().children("td:eq(4)").text();
        var teacher = $(this).parent().children("td:eq(5)").text();
        var location = $(this).parent().children("td:eq(6)").text();
        var classroom = $(this).parent().children("td:eq(7)").text();
        var max_num = $(this).parent().children("td:eq(8)").text();
        
        console.log("location is ",location)
        
        $("#class_name").val(className);
        $("#begin_date").val(begin_time);
        $("#end_date").val(end_time);
        //$("#class_location").val(location);
        $("#class_room").val(classroom);
        $("#num_limit").val(max_num);
        $("#teacher_name").val(teacher);
        $("#former_location").val(location);
        $("#former_classroom").val(classroom);
        $("#former_begin_date").val(begin_time);


//            $(this).text("");
//            var input = "<input type='datetime'>";
//            $(this).append(input);
//            $("input").focus();
//            $("input").blur(function(){
//            if($(this).val()==""){
//            $(this).remove();
//                        }else{
//                            $(this).closest("td").text($(this).val());
//                        }
//                    })
        //   $("#class_location option[value=location]").attr('selected',true);
       //    $("#class_name option[value=$value[1]]").attr('selected',true);
        $('#class_location option').each(function() {
            if($(this).val()==location){
                console.log("in",$(this).val());
               $(this).attr('selected',true);
            }
        });
    });

    function check_input_valid() {

        var objRegExp = /^(\d{4})\-(\d{2})\-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/;
        var reg = /^\d{1,}$/;
        var begin_time = $("#begin_date").val();
        var end_time =   $("#end_date").val();
        var num_limit = $("#num_limit").val();

        console.log("begin_time",begin_time);
        if (!objRegExp.test(begin_time) || !objRegExp.test(end_time)) {
             alert("请输入正确的日期格式，例如 2015-09-01 02:45:00");
            console.log("false");
            return false;
        }
        else if(!reg.test(num_limit)){
            alert("约课人数必须为数字");
            return false;
        }
        else {
            console.log("true");
            return true;
        }
    }

</script>
</body>
</html>

