<?php
session_start();
if (isset($_SESSION['valid_user'])){
    print <<<EOT

<!DOCTYPE html>
<html lang="en">
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
				    <h1>Users <small>会员信息列表</small></h1>

			</div>
            <div>
              <button class="btn btn-large btn-success" onClick="getAnnualcard();">查看所有年卡会员</button>
              <button class="btn btn-large btn-success" style="margin-left: 9px;">查看所有次卡会员</button>
            </div>
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th>会员编号</th> 
			            <th>姓名</th>
			            <th>性别</th> 
			            <th>身份证号</th>
			            <th>生日</th>
			            <th>手机号码</th>
			            <th>会员卡号</th>
			            <th>微信号码</th>
			            <th>会员卡类型</th>
                        <th>会员卡状态</th>
			            <th>会员卡开卡日期</th>
			            <th>会员卡失效日期</th>
			            <th>会员卡冻结起始日期</th>
			            <th>会员卡冻结截止日期</th>
					    <th>备注</th>

						
                       
					</tr>
				</thead>
EOT;
}
else{
    echo "please login first!";
    echo "<a href='login.html''>login</a>>";
}
?>


<?php
    require("../constant_var_define.php");
    session_start();
    if (isset($_SESSION['valid_user'])) {


        $currentPage = $_GET["currentPage"];//当前下显示第几页
        $currentPage = $currentPage == NULL ? 1 : $currentPage;
        $pageSize = ITEMS_PER_PAGE;         //每页显示的记录数
        $start = ($currentPage - 1) * $pageSize;//每页记录起始值

        $conn = db_connect();

        //求总记录数
        $st = $conn->query("select count(*) from member_info_table");
        
        //echo "total record:";
        //debug_output("select count(*) from member_info_table");
        
        $rs = $st->fetchAll();

        $totalRow = $rs[0][0];  //总记录数
        debug_output("totalRow=".$totalRow);
        $totalPage = ceil($totalRow / $pageSize); //总页数

        if ($currentPage >= $totalPage) {
            $lastpage = $currentPage - 1;
            $nextpage = $totalPage;
        } else if ($currentPage == 1) {
            $lastpage = 1;
            $nextpage = $currentPage + 1;
        } else {
            $lastpage = $currentPage - 1;
            $nextpage = $currentPage + 1;
        }

        //执行select查询语句，返回数据库操纵对象statement
        $st = $conn->query("select * from member_info_table limit {$start},$pageSize");
        //获得结果集，结果集就是一个二维数组
        $rs = $st->fetchAll();
        var_dump($rs);

        //显示所有记录
        foreach ($rs as $value) {
            //根据卡类型确定要查询的表名称
            if ($value[9] == TIME_CARD_TYPE)    //计时卡
            {
                $query_result = $conn->query("select * from time_card_table where card_id='" . $value[6] . "'");
                $result = $query_result->fetchAll();

                echo "<tbody>";
                echo "<tr>";
				echo "  <td >{$value[0]}</td>";  //member_id
                echo "  <td>{$value[1]}</td>";  //member_name
                echo "  <td>{$sex_english_to_chinese[$value[2]]}</td>";  //sex
                echo "  <td>{$value[3]}</td>";  //identy_card_number
                echo "  <td>{$value[4]}</td>";  //birthday
                echo "  <td>{$value[5]}</td>";  //phone
                echo "  <td>{$value[6]}</td>";  //card_id
                echo "  <td>{$value[8]}</td>";  //open_id
                echo "<td>{$card_tyep_num_to_name[$result[0][9]]}</td>";    //concrete_card_type
                echo "<td>{$card_status_num_to_name[$result[0][8]]}</td>";    //card_status
                echo "  <td>{$result[0][4]}</td>";  //valid_begin_date
                echo "  <td>{$result[0][5]}</td>";  //valid_end_date
                echo "  <td>{$result[0][6]}</td>";  //pause_begin_data
                echo "  <td>{$result[0][6]}</td>";  //pause_end_date
				echo "  <td>";
				echo "    <b class='removeButton'>{$value[10]}</b>";
				echo "  </td>";  
                echo "</tr>";
                echo "</tbody>";
            } else if ($value[9] == MEASURED_CARD_TYPE) //计次卡
            {
                $query_result = $conn->query("select * from measured_card_table where card_id='" . $value[6] . "'");
                $result = $query_result->fetchAll();

                echo "<tbody>";
                echo "<tr>";
				echo "  <td>{$value[0]}</td>";  //member_id
                echo "  <td>{$value[1]}</td>";  //member_name
                echo "  <td>{$sex_english_to_chinese[$value[2]]}</td>";  //sex
                echo "  <td>{$value[3]}</td>";  //identy_card_number
                echo "  <td>{$value[4]}</td>";  //birthday
                echo "  <td>{$value[5]}</td>";  //phone
                echo "  <td>{$value[6]}</td>";  //card_id
                echo "  <td>{$value[8]}</td>";  //open_id
                echo "<td>{$card_tyep_num_to_name[$result[0][7]]}</td>";    //concrete_card_type
                echo "<td>{$card_status_num_to_name[$result[0][6]]}</td>";    //card_status
                echo "  <td>{$result[0][2]}</td>";  //valid_begin_date
                echo "  <td>{$result[0][3]}</td>";  //valid_end_date
                echo "  <td>{$result[0][4]}</td>";  //pause_begin_data
                echo "  <td>{$result[0][5]}</td>";  //pause_end_date
				echo "  <td >";
				echo "<b class='removeButton'>{$value[10]}</b>";
				echo "</td>"; 
                echo "</tr>";
                echo "</tbody>";
            }
        }

        //关闭数据库
        unset($rs);
        unset($st);
        unset($conn);
    }
?>
                
			</table>
			<div class="pagination">
                <!--页面跳转 -->
               <td colspan="4" align="center"><a href="users.php?currentPage=1">首页</a> <a href="users.php?currentPage=<?php echo $lastpage; ?>">上一页</a> <?php echo $currentPage; ?>/<?php echo $totalPage; ?> <a href="users.php?currentPage=<?php echo $nextpage; ?>">下一页</a> <a href="users.php?currentPage=<?php echo $totalPage; ?>">尾页</a>
			</div>
			<div class="row" style="margin-left:10px;">
			<a href="new-user.php" class="btn btn-success col-md-6">新增会员</a>
			<a href="delete-user.php" class="btn btn-success col-md-6">删除会员</a>
			<div/>
		  </div>
        </div>
      </div>

      <?php include("./page_footer.php"); ?>

    </div>
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
	
	$(function() { 
		//获取class为caname的元素 
		$(".removeButton").click(function() { 
		var td = $(this); 
		var txt = td.text(); 
		var input = $("<input type='text' />"); 
		td.html(input); 
		input.click(function() { return false; }); 
		//获取焦点 
		input.trigger("focus"); 
		//文本框失去焦点后提交内容，重新变为文本 
		input.blur(function() { 
		var newtxt = $(this).val(); 
        var memberID = $(this).parent().parent().parent().children("td:eq(0)").text();
        //console.log("memberID is ",memberID);		
		td.html(newtxt); 
			
			$.post("modifyRemarkbackend.php",
            {
                remarks: newtxt,
				member_id:memberID
            },
			function(data,status){
				alert(data);
			});
		});
		});
		});
        
        function getAnnualcard(){
            $.post("getAnnualcardBe.php",
            {
               cardtype : 1 
            },
            function(data,status){
                console.log("in--------",data);
                alert("data is"+data);
            });
        }
			
	</script>
    </body>
</html>

