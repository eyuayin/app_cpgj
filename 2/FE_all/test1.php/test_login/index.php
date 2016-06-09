<?php
//session_start();
print <<<EOT
<meta charset="utf-8">
<body>
<form id="form1" name="form1" method="post" action="" >
    用户名:
    <input type="text" name="username" />
    <br/>
    <br/>
    密码:
    <input type="password" name="password" />
    <br />
    <br/>
    <input type="button" value="登入" onclick="check();"/>
    <input type="reset" value="重置" />
</form>
<script language="javascript">
    function check(){
        var user = "user", password = "123456";
        var temUser = document.form1.username.value;
        var temPassword = document.form1.password.value;
        if(user==temUser && password==temPassword)
        {
            alert("登入成功!");
            window.location.href="test.php";//在这里进行页面跳转
        }
        else{
            alert("用户名或密码错误!");
            //这里可以跳转到错误提示页面，或者不跳转
        }
    }

</script>
EOT;
</body>