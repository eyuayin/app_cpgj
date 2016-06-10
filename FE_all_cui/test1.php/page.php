<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php

//连接数据库的参数
$host=SAE_MYSQL_HOST_M;  
$port=SAE_MYSQL_PORT;
$dbname="app_vipmanage";
$dbuser=SAE_MYSQL_USER;
$dbpassw=SAE_MYSQL_PASS;
$dsn = "mysql:host=".$host.";port=".$port.";dbname=".$dbname;
//连接数据库
$conn =  new PDO($dsn, $dbuser, $dbpassw);
//设置编码
$conn->query("set names utf8");

$sql1="select * from member_info_table";
$query1=mysql_query($sql1);
$count=array();
while($row=mysql_fetch_assoc($query1)){
    $count[]=$row;
}
$totalnews=count($count);

//判断page
if($_GET['page']){
    $page=$_GET['page'];
}else{
    $page=1;
}
$newnum = 10;   //每页显示的条数
$start=($page-1)*$newnum;
   $sql="select * from member_info_table limit $start,$newnum";
   $query=mysql_query($sql);
   $ret=array();
   while($row=mysql_fetch_assoc($query)){
       $ret[]=$row;
       }
   var_dump($ret);
?>

<!--表格样式 -->
<div id="wrap" >
   <table border="1px"; >
     <?php foreach ($ret as $key=>$value){ ?>
       <tr>
           <td><?php echo $value['id'] ?></td>
           <td><?php echo $value['username'] ?></td>
           <td><?php echo $value['pwd'] ?></td>
           <td>删除|修改</td>
       </tr>
     <?php } ?>
     <tr >
<!--页面跳转 -->
           <td colspan="4" align="center"><a href="page.php?page=1">首页</a> <a href="page.php?page=<?php echo $lastpage ?>">上一页</a> <?php echo $page; ?>/<?php echo $pagenum; ?> <a href="page.php?page=<?php echo $nextpage; ?>">下一页</a> <a href="page.php?page=<?php echo $pagenum ?>">尾页</a><input type="text" name="text" /><input type="button" value="跳转" onclick="check(this)"/>
           </td>
     </tr>
   </table>
</div>