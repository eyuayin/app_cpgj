<?php
    session_start();
    //获得前端的数据
    $username = $_POST['name'];
    //echo $username;
    $passwd = $_POST['passwd'];
    //echo $passwd;

    //echo 'username'.$username;
    //echo 'passwd'.$passwd;

    //是否登录成功
    function login($username,$passwd){
        //check username and passwd with db
        //if yes, return true
        //else throw exception

        $host=SAE_MYSQL_HOST_M;  //连接数据库的参数
        $port=SAE_MYSQL_PORT;
        $dbname="app_cpgj";
        $dbuser=SAE_MYSQL_USER;
        $dbpassw=SAE_MYSQL_PASS;
        $dsn = "mysql:host=".$host.";port=".$port.";dbname=".$dbname;

        //连接数据库
        $conn =  new PDO($dsn, $dbuser, $dbpassw);
        //echo "连接数据库;";

        //设置编码
        $conn->query("set names utf8");

        $st = $conn->query("select count(*) from user where username='".$username."' and passwd=SHA1('".$passwd."')");
        //echo "select count(*) from user where username='".$username."' and passwd=SHA1('".$passwd."')";
        $rs = $st->fetch();

        //echo "count:".$rs[0];

        if(!$rs){
            throw new exception('无法登录!');
        }
        else{
            //echo "登录成功";
            $_SESSION['valid_user'] = $username;
            header("location:index.php");

            //echo "<a href='index.php'>去首页</a>";
        }
    }

    if($username && $passwd){
        try {
        login ($username, $passwd);
            //if they are in the database register the user id
        }
        catch(Exception $e){
            //unsuccessful login
            //var_dump($e);
            echo "password or account is wrong";
            exit;
        }
    }
    echo "<meta charset='utf-8'>";
    echo "</meta>";
?>