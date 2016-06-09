<?php
        $openid = $_GET["openid"];
?>
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

  
        <div class="div-class-header">星期一 / 十二月 3</div>
        <table id="day1" cellpadding="6" cellspacing="0" width="100%">  
            <tbody>
              <volist name="data1" id="vo1">
                <tr style="height: 60px;" onclick="book_class(this);" id="{$vo1['class_id']}">
                  <td class="class-status"><input value="{$vo1['class_status']}"></td>
                  <td class="td-class-time-valid">09:00</td>  
                  <td class="td-class-info-valid"><div>基础瑜伽</div><div class="inner-small">环老师</div></td>
                  <td class="td-right-valid1"><span><img src="wx_image/head.jpg" style="height: 50%;"></br>剩余席位：8</span></td>
                  <td class="td-right-valid2"><img src="wx_image/right-arrow.jpg" style="height: 40%;"></td>
                </tr>
              </volist>
           </tbody>
       </table>  

  <div style="height:10px;"></div>
  <div class="div-class-header">星期二 / 十二月 4</div>
  <table id="day2" cellpadding="6" cellspacing="0" width="100%">  
    <tbody>
      <volist name="data2" id="vo2">
        <tr style="height: 60px;" onclick="book_class(this);" id="{$vo2['class_id']}">
          <td class="class-status"><input value="{$vo2['class_status']}"></td>
          <td class="td-class-time-valid">10:00</td>  
          <td class="td-class-info-valid"><div>普拉提</div><div class="inner-small">甘老师</div></td>
          <td class="td-right-valid1"><span><img src="wx_image/head.jpg" style="height: 50%;"></br>剩余席位：0</span></td>
          <td class="td-right-valid2"><img src="wx_image/right-arrow.jpg" style="height: 40%;"></td>
        </tr>
      </volist>
    </tbody>
  </table>
  
  <div style="height:10px;"></div>
  <div class="div-class-header">星期三 / 十二月 5</div>
  <table id="day3" cellpadding="6" cellspacing="0" width="100%">  
    <tbody>
      <volist name="data3" id="vo3">
        <tr style="height: 60px;" onclick="book_class(this);" id="{$vo3['class_id']}">
          <td class="class-status"><input value="{$vo3['class_status']}"></td>
          <td class="td-class-time-valid">18:00</td>  
          <td class="td-class-info-valid"><div>球操</div><div class="inner-small">甘老师</div></td>
          <td class="td-right-valid1"><span><img src="wx_image/head.jpg" style="height: 50%;"></br>剩余席位：6</span></td>
          <td class="td-right-valid2"><img src="wx_image/right-arrow.jpg" style="height: 40%;"></td>
        </tr>
      </volist>
    </tbody>
  </table>   
    </div>
    <div role="tabpanel" class="tab-pane" id="min">every</div>
    <div role="tabpanel" class="tab-pane" id="private">one</div>
  </div>

  </div>



 
    
	<script src="FE_all_cui/js/bootstrap.min.js"></script>

  </body>
</html>
