<?php
       
        $openid = "oqUOZwUpcXNvNKfqrnAEMvzKKfff";
       //$openid = $_GET["openid"];          
     
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
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    


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
        <input type="hidden" name="openid" value="$openid" id="openid_input"/>
  
        
EOT;





    require("constant_var_define.php");

    $conn = db_connect();
    
    
  
      //执行select查询语句，返回数据库操纵对象statement
      //$st_cpgj = $conn->query("select * from member_info_table_cui where open_id = '".$openid."'");
      //debug_output("select * from member_info_table_cui where open_id = '".$openid."'");
      $st_jzl = $conn->query("select * from member_info_table where open_id = '".$openid."'");
      debug_output("select * from member_info_table where open_id = '".$openid."'");

        //获得结果集，结果集就是一个二维数组
        
        //$rs_cpgj = $st_cpgj->fetchAll();
        $rs_jzl = $st_jzl->fetchAll();   //
        
        //var_dump($rs_cpgj);
       // var_dump($rs_jzl);

        
        //是君子兰会员
        if($rs_jzl)
        {
           $location = 2;
        }
        
        //非君子兰会员
        else 
        {
           $location =1;   
        }
        
        $st = $conn->query("select date,weekday from class_detail_in_7_days where location='".$location."' ORDER BY date ASC");
        //debug_output("select date,weekday from class_detail_in_7_days where location='".$location."' ORDER BY date ASC");
          //获得结果集，结果集就是一个二维数组
        $vl = $st->fetchAll();
       // echo "vl is ";
       //  var_dump($vl);
        //新建数组，存入所有数据库读出的日期列表
        $vl_all = array();
            for($i=0;$i<count($vl,COUNT_NORMAL);$i++) 
            {
                
                $vl_all[] = $vl[$i][0]."*".$vl[$i][1];
            }
        //  echo "vl_all is ";
         // var_dump($vl_all);
        //去除重复的日期
        $vl_unique = array_unique($vl_all);
        //var_dump($vl_unique);
      //  echo "count is:";
       // echo count($vl_unique);
        //截取 date 部分
        foreach($vl_unique as $vl_un )
        { 
            $date_only = strstr($vl_un, '*', true); 
            $weekday_only =  substr($vl_un,11); 
            $qr = $conn->query("select * from class_detail_in_7_days where date = '".$date_only."' and location = '".$location."' ORDER BY date ASC"); 
            $fa = $qr->fetchAll();  
           
                switch ($weekday_only)
                    {
                    case 1:
                      $weekday_only = "星期 日 ";
                      break;
                    case 2:
                      $weekday_only =  " 星期 一 ";
                      break;
                    case 3:
                      $weekday_only =  " 星期 二 ";
                      break;
                    case 4:
                      $weekday_only =  " 星期 三 ";
                      break;
                    case 5:
                      $weekday_only =  " 星期 四 ";
                      break;
                    case 6:
                      $weekday_only =  " 星期 五 ";
                      break;
                    case 7:
                      $weekday_only =  " 星期 六 ";
                      break;
                    }
                echo "<div style='height:10px;'></div>";
                echo "<div class='div-class-header'> {$weekday_only}/{$date_only}</div>";
                echo "<table id='day2' cellpadding='6' cellspacing='0' width='100%'>";                                              
                
                   
                 
                foreach ($fa as $value)
                {
                     $value[10] = $value[8]-$value[9];  //计算剩余可约次数
                     
                    echo "<tbody>";
                    echo "<volist name='data2' id='vo2'>";
                    echo "<tr style='height: 60px;' onclick='book_class(this);'>";         
                    echo "<td class='td-class-time-valid'>{$value[5]}</td>" ;     
                    echo "<td class='td-class-info-valid'>";
                    echo "<div>{$value[1]}</div>";
                    echo "<div class='inner-small'>{$value[2]}</div>";
                    echo "</td>";          
                    echo " <td class='td-right-valid1'>";
                    echo "<span>";
                    echo "<img src='wx_image/head.jpg' style='height: 50%;'>";
                    echo "</br>余{$value[10]}";
                    echo "</span>";
                    echo "</td>";        
                    echo "<td class='td-right-valid2'>";
                    echo "<img src='wx_image/right-arrow.jpg' style='height: 40%;'>";
                    echo "</td>" ;  
                    echo "<td  style='DISPLAY:none'>{$value[0]}</td>";
                    echo "<td  style='DISPLAY:none'>{$value[7]}</td>";
                    echo "</tr>"  ;       
                    echo " </volist>";       
                    echo "</tbody>";     
                           
                    
                }   
               
                echo "</table>" ;    
        }
        
        //查询日期对应的
       
 
        //获得结果集，结果集就是一个二维数组
                                
              
        echo " </div>";
        echo " <div role='tabpanel' class='tab-pane' id='min'>精品课微预约功能敬请期待！</div>";
        echo " <div role='tabpanel' class='tab-pane' id='private'>私教课微预约功能敬请期待！</div>";
        echo "</div>";
        echo "</div>";
        


 
    
	    echo "<script src='FE_all_cui/js/bootstrap.min.js'></script>";
        echo "<script src='JS_weixin/order_new.js' charset='gbk'></script>";


        echo "</body>";
        echo "</html>";

          

        
  

?> 
