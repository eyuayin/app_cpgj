<?php
$openid = $_GET["openid"];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<title>会员信息注册</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;"></meta>
<meta name="apple-mobile-web-app-capable" content="yes"></meta>
<meta name="apple-mobile-web-app-status-bar-style" content="black"></meta>
<meta name="format-detection" content="telephone=no"></meta>
<link href="order.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="main.js"></script>
</head>

<body id="wrap" style="">
<style>
      .deploy_ctype_tip{z-index:1001;width:100%;text-align:center;position:fixed;top:50%;margin-top:-23px;left:0;}.deploy_ctype_tip p{display:inline-block;padding:13px 24px;border:solid #d6d482 1px;background:#f5f4c5;font-size:16px;color:#8f772f;line-height:18px;border-radius:3px;}
</style>
<div class="banner">
    <div id="wrapper">
        <div id="scroller" style="float:none">
            <ul id="thelist">
                <img src="84z58PICjwu_1024.jpg" alt="注册" style="width:100%"></img>
            </ul>
        </div>
    </div>
    <div class="clr"></div>
</div>
<div class="cardexplain">
    <ul class="round">
        <li>
            <h2>会员信息注册</h2>
            <div class="text"> 天环瑜伽感谢您的配合<br/>
                有任何问题请致电：025-52892008</div>
        </li>
    </ul>
    <form id="form" onSubmit="return tgSubmit()" action="add_member.php" method="post">
        <ul class="round">
            <li class="title mb"><span class="none">请填写本人信息注册预约系统</span></li>
			<li class="nob">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
                    <tbody>
                        <tr>
                            <th>会馆</th>
                            <td><select class="px" name="location"><option value=1 >翠屏国际会馆</option><option value=2 selected>君子兰会馆</option></select></td>
                        </tr>
                    </tbody>
                </table>
            </li>
			
            <li class="nob">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
                    <tbody>
                        <tr>
                            <th>会员卡号</th>
                            <td><input type="text" class="px" placeholder="请输入会员卡号" id="card_id" name="card_id" value=""/></td>
                        </tr>
                    </tbody>
                </table>
            </li>
            <li class="nob">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
                    <tbody>
                        <tr>
                            <th>手机号</th>
                            <td><input type="text" class="px" placeholder="请输入手机号" id="phone" name="phone" value=""/></td>
                        </tr>
                    </tbody>
                </table>
            </li>
        </ul>
        <div class="footReturn" style="text-align:center">
            <input type="hidden" name="openid" value="<?php echo $openid;?>"/>
            <input type="hidden" name="register" value="yes"/>
            <input type="submit" style="margin:0 auto 20px auto;width:90%" class="submit" value="提交信息"/>
        </div>
    </form>
    <script>
        function showTip(tipTxt) 
		{
          var div = document.createElement('div');
          div.innerHTML = '<div class="deploy_ctype_tip"><p>' + tipTxt + '</p></div>';
          var tipNode = div.firstChild;
          $("#wrap").after(tipNode);
		  
          setTimeout(
		  function () 
		  {
            $(tipNode).remove();
          }, 
		  1500);
        }
        function tgSubmit()
		{
          var card=$("#card_id").val();
          if($.trim(card) == "")
		  {
            showTip('会员卡号不能为空')
            return false;
          }
            
          var phone=$("#phone").val();
          if($.trim(phone) == "")
		  {
            showTip('手机号码不能为空')
            return false;
          }
          
           var patrn = /^[0-9]{11}$/;
          if (!patrn.exec($.trim(phone)))
		   {
            showTip('手机号码必须为11位且全部是数字')
            return false;
          }
           
		  //TODO：会员卡卡号需要多少位还要与店家商量，或者是位数不定,手机号的前端控制，搞清楚tgSubmit函数何时被调用，
            //搞清楚65行代码
         

          return true;
        }
      </script> 
</div>
</body>
</html>