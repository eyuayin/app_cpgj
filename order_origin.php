<?php
        //$openid = $_GET["openid"];
        $openid = "oqUOZwUXs9YeUF0uMyWr9-M8cH3U";
     
     print <<<EOT
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
    <title>预约瑜伽课程</title>
    <meta name="viewport" content="width=device-width,height=device-height,maximum-scale=1.0,user-scalable=no"></meta>
    <meta name="apple-mobile-web-app-capable" content="yes"></meta>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"></meta>
    <meta name="format-detection" content="telephone=no"></meta>
    <link href="order.css" rel="stylesheet" type="text/css"></link>
    <link href="wx_css/style.css" rel="stylesheet" type="text/css" />
    <link href="wx_css/Wx.css" rel="stylesheet" type="text/css" />
    <link href="wx_css/iconfont.css" rel="stylesheet" type="text/css" />
    <link href="FE_all_cui/css/bootstrap.css" rel="stylesheet"></link>

    <link href="order.css" rel="stylesheet" type="text/css"></link>
    <link href="order.css" rel="stylesheet" type="text/css"></link>
    <link href="order.css" rel="stylesheet" type="text/css"></link>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    
     <script type="text/javascript" src="JS_weixin/generate_classes_7_days.js"></script>


  </head>
  
  <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#ordinary" aria-controls="ordinary" role="tab" data-toggle="tab">大课预约</a></li>
    <li role="presentation"><a href="#min" aria-controls="min" role="tab" data-toggle="tab">精品课预约</a></li>
    <li role="presentation"><a href="#private" aria-controls="private" role="tab" data-toggle="tab">私教课预约</a></li>
    
  </ul>
  
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="ordinary">
    
    <title>课程预约</title>
    <body style="margin:0">
        <div class="div-title">天环瑜伽</br><span class="inner-small">课程预约</span></div>
        <input type="hidden" name="openid" value="<?php echo $openid;?>" id="openid_input"/>

  
        
    </div>
    <div role="tabpanel" class="tab-pane" id="min">every</div>
    <div role="tabpanel" class="tab-pane" id="private">one</div>
  </div>

  </div>



 
    
	<script src="FE_all_cui/js/bootstrap.min.js"></script>

  </body>
</html>
EOT;

    require("constant_var_define.php");

    $conn = db_connect();
    
    
  
      //执行select查询语句，返回数据库操纵对象statement
      $st_cpgj = $conn->query("select * from member_info_table_cui where open_id='oqUOZwUXs9YeUF0uMyWr9-M8cH3U'");
      $st_jzl = $conn->query("select * from member_info_table where open_id='oqUOZwUXs9YeUF0uMyWr9-M8cH3U'");

        //获得结果集，结果集就是一个二维数组
        
        $rs_cpgj = $st_cpgj->fetchAll();
        $rs_jzl = $st_jzl->fetchAll();
        
        //var_dump($rs);

        if($rs_cpgj)
        {
            $st = $conn->query("select * from class_detail_in_7_days where location=1 ORDER BY date ASC");
            //获得结果集，结果集就是一个二维数组
            $rs = $st->fetchAll();
            //var_dump($rs);
        }
        
        else if($rs_jzl)
        {
            $st = $conn->query("select * from class_detail_in_7_days where location=2 ORDER BY date ASC");
            //获得结果集，结果集就是一个二维数组
            $rs = $st->fetchAll();
            //var_dump($rs);
        }
        else
        {echo "无权查看课程！";}
        
        
        //显示所有记录
        foreach ($rs as $value) {
            echo "<div style='height:10px;'></div>";
            
            switch ($value[3])
                {
                case 1:
                  $value[3] = "星期 日 ";
                  break;
                case 2:
                  $value[3] =  " 星期 一 ";
                  break;
                case 3:
                  $value[3] =  " 星期 二 ";
                  break;
                case 4:
                  $value[3] =  " 星期 三 ";
                  break;
                case 5:
                  $value[3] =  " 星期 四 ";
                  break;
                case 6:
                  $value[3] =  " 星期 五 ";
                  break;
                case 7:
                  $value[3] =  " 星期 六 ";
                  break;
                }
                            
            $value[9] = $value[7]-$value[8];  //计算剩余可约次数
            
            echo "<div class='div-class-header'> {$value[3]}/{$value[2]}</div>";
            echo "<table id='day2' cellpadding='6' cellspacing='0' width='100%'>";
            echo "<tbody>";
            echo "<volist name='data2' id='vo2'>";
            echo "<tr style='height: 60px;' onclick='book_class(this);'>";         
            echo "<td class='td-class-time-valid'>{$value[4]}</td>" ;     
            echo "<td class='td-class-info-valid'>";
            echo "<div>{$value[0]}</div>";
            echo "<div class='inner-small'>{$value[1]}</div>";
            echo "</td>";          
            echo " <td class='td-right-valid1'>";
            echo "<span>";
            echo "<img src='wx_image/head.jpg' style='height: 50%;'>";
            echo "</br>剩余席位：{$value[9]}";
            echo "</span>";
            echo "</td>";        
            echo "<td class='td-right-valid2'>";
            echo "<img src='wx_image/right-arrow.jpg' style='height: 40%;'>";
            echo "</td>" ;       
            echo "</tr>"  ;       
            echo " </volist>";       
            echo "</tbody>";     
            echo "</table>" ;       
        }   
?> 