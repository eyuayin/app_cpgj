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
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>课程名称</th>
                                <th>课程开始时间</th>
                                <th>课程结束时间</th>
                                <th>授课老师</th>
                                <th>授课地点</th>
                                <th>预约人数限制</th>
                                <th>实际预约人数</th>
                                <th>等待预约人数</th>
                                <th>点击查看已约课会员信息</th>
                                <th>删除课程</th>
                            </tr>
                        </thead>
EOT;


    require("../constant_var_define.php");

    $currentPage = $_GET["currentPage"];//当前下显示第几页
    $currentPage = $currentPage == NULL ? 1 : $currentPage;
    $pageSize = ITEMS_PER_PAGE; //每页显示的记录数
    $start = ($currentPage - 1) * $pageSize;//每页记录起始值

    //连接数据库
    $conn = db_connect();

    //求总记录数
    $st = $conn->query("select count(*) from class_info_table_cui");
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

    $st = $conn->query("select * from (select * from class_info_table_cui order by class_begin_time desc) a limit {$start},$pageSize");
    debug_output("select * from (select * from class_info_table_cui order by class_begin_time desc) a limit {$start},$pageSize");
    $rs = $st->fetchAll();

    //显示所有记录
    foreach ($rs as $value) {
        //查出当前class_id已约人数（waiting_No为0的）
        $query_result = $conn->query("select count(*) from class_booking_table_cui where class_id=$value[0] and waiting_No=0 and canceled=0");
        debug_output("select count(*) from class_booking_table_cui where class_id=$value[0] and waiting_No=0 and canceled=0");
        $result = $query_result->fetch();
        $db_booking_num = $result[0]; //当前课程实际预约人数
        debug_output("实际上课人数是：".$db_booking_num);
        $q_result = $conn->query("update class_info_table_cui set selected_user_number=$db_booking_num where class_id=$value[0]");
        debug_output("update class_info_table_cui set selected_user_number=$db_booking_num where class_id=$value[0]");

        //查出当前课程最大等待的编号
        $query_result = $conn->query("select waiting_No from class_booking_table_cui where class_id=$value[0] order by waiting_No desc");
        debug_output("select waiting_No from class_booking_table_cui where class_id=$value[0] order by waiting_No desc");
        $result = $query_result->fetch();
        $db_max_waiting_No = $result[0]; //当前课程中最大的等待号码
        if (empty($db_max_waiting_No))   //为空时，则认为无人等待
        {
            $db_max_waiting_No = 0;
        }

        $cal_location_class = $location_num_to_name[$value[4]] . $classroom_num_to_name_cui[$value[5]];
        debug_output("地点编号：" . $value[4]);
        debug_output("教室编号：" . $value[5]);
        debug_output("地点：" . $location_num_to_name[$value[4]]);
        debug_output("教室：" . $classroom_num_to_name_cui[$value[5]]);
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
             <td><a href="delete_class.php?class_id=$value[0]" onclick="return confirm('确认要删除？')">删除</a></td>
        </tr>
        </tbody>
EOT;
    }

    //关闭数据库
    unset($rs);
    unset($st);
    unset($conn);

}

else
echo "<a href='login.html'>Click to login first!</a>";

?>


                    </table>
                    <div class="pagination">
                        <!--页面跳转 -->
                        <td colspan="4" align="center"><a href="all_class_info.php?currentPage=1">首页</a> <a href="all_class_info.php?currentPage=<?php echo $lastpage ?>">上一页</a> <?php echo $currentPage; ?>/<?php echo $totalPage; ?> <a href="all_class_info.php?currentPage=<?php echo $nextpage; ?>">下一页</a> <a href="all_class_info.php?currentPage=<?php echo $totalPage ?>">尾页</a>
                    </div>
                    <div class="row" style="margin-left:10px;">
                        <a href="new-role.php" class="btn btn-success col-md-6">预约课程</a>
                        <a href="cancel_class.html" class="btn btn-success col-md-6">取消约课</a>
                    </div>
                    </div>
                </div>
        </div>
            <?php include("./page_footer.php"); ?>
        </div>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="//www.w3cschool.cc/try/angularjs/1.2.5/angular.min.js"></script>
        <script>
            $(document).ready(function() {
            $('.dropdown-menu li a').hover(
            function() {
            $(this).children('i').addClass('icon-white');
            },
            function() {
            $(this).children('i').removeClass('icon-white');
            });

            if($(window).width() > 760)
            {
            $('tr.list-users td div ul').addClass('pull-right');
            }
            });
        </script>
    </body>
</html>





