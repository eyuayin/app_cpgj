<?php
 
  //$openid = $_GET["openid"];
  
print <<<EOT
 
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>ԤԼ�٤�γ�</title>
   
    <meta name="viewport" content="width=device-width,height=device-height,maximum-scale=1.0,user-scalable=no"></meta>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
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
    <li role="presentation" class="active"><a href="#ordinary" aria-controls="ordinary" role="tab" data-toggle="tab">���ԤԼ</a></li>
    <li role="presentation"><a href="#min" aria-controls="min" role="tab" data-toggle="tab">��Ʒ��ԤԼ</a></li>
    <li role="presentation"><a href="#private" aria-controls="private" role="tab" data-toggle="tab">˽�̿�ԤԼ</a></li>
    
  </ul>
  
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="ordinary">
    
    <title>�γ�ԤԼ</title>
    <body style="margin:0">
        <div class="div-title">�컷�٤</br><span class="inner-small">�γ�ԤԼ</span></div>
      
EOT;

 require("constant_var_define.php");

    $conn = db_connect();

?>