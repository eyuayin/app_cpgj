<?php
session_start();
print <<<EOT
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>hello</title>
    </head>
    <body>
        <form action="cookie.php" method="post">
            用户名:<input type="text" id="UserName" name="UserName"/>
            密码:<input type="password" id="Pwd" name="Pwd"/>
            <input type="submit" value="登录" />
            <input type="reset" value="重置" />
            <input type="reset" value="logout" onclick="destroy_session()"/>
        </form>
    <script>
        function destroy_session(){
            window.location.href="destroy.php";
        }
        </script>
    </body>
</html>
EOT;

    session_start();
    $username=$_POST['UserName'];
    $passwd=$_POST['Pwd'];
        if($username=="user" && $passwd == 123456){
            $_SESSION['valid_user']=$username;
            echo "<script>alert('登录成功!');location='test.php';</script>";
        }
    ?>