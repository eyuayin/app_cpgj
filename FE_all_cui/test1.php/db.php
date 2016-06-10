 <?php
                                      $host=SAE_MYSQL_HOST_M;  //链接数据库的参数
                                      $port=SAE_MYSQL_PORT;
                                      $dbname="app_vipmanage";
                                      $dbuser=SAE_MYSQL_USER;
                                      $dbpassw=SAE_MYSQL_PASS;
                                      $dsn = "mysql:host=".$host.";port=".$port.";dbname=".$dbname;

                                      //获取当前日期数组
                                      $date_array=getdate();
                                      //当前星期
                                      $weekday = $date_array[weekdat];
                                      //当前年月日时分秒
                                      $current_date= date("Y-m-d H:i:s",strtotime('0 day'));
                                      //三天后年月日
                                          $end_date=date('Y-m-d 00:00:00',strtotime("3 day"));
                                      //连接数据库
                                      $conn =  new PDO($dsn, $dbuser, $dbpassw);

                                      //设置编码
                                      $conn->query("set names utf8");

                                      //执行select查询语句，返回数据库操纵对象statement
									  $st = $conn->query("select * from class_info_table where class_begin_time between '".$_POST['date']."' and '".$end_date."'");
                                      
                                      //获得结果集，结果集就是一个二维数组
                                      $rs = $st->fetchAll();
									  return $rs;
// echo "<td>";
//  echo "<select style='line-height:35px;' id='bookexpert' name='bookexpert' class='dropdown-select'>";
//foreach($rs as $value){
                                          //  echo "<option value='$value[1]'>$value[1]</option>";
// }
//   echo "</select>";
//    echo "</td>";

?>
