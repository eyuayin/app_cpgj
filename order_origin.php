<?php
        $openid = $_GET["openid"];

        
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
        $st = $conn->query("select * from class_detail_in_7_days ORDER BY date ASC");
        //获得结果集，结果集就是一个二维数组
        $rs = $st->fetchAll();
        //var_dump($rs);

        //显示所有记录
        foreach ($rs as $value) {
            //根据卡类型确定要查询的表名称
                echo "<tbody>";
                echo "<tr>";
				echo "  <td >{$value[0]}</td>";  
                echo "  <td>{$value[1]}</td>"; 
                echo "  <td>{$value[2]}</td>"; 
                echo "  <td>{$value[3]}</td>"; 
                echo "  <td>{$value[4]}</td>";  
    
        }   
?> 