<?php
    require("./constant_var_define.php");

    //连接数据库的参数
    $conn = db_connect();

    $query_result = $conn->query("select class_name,class_id from class_info_table");
    $value = $query_result->fetchAll();

    foreach($value as $class_name_arr)
    {
        $db_class_name_num = $class_name_arr[0];
        $class_name = $class_num_to_name[$db_class_name_num];
        echo "class_name:".$class_name."<br />";

        $query_result2 = $conn->query("update class_info_table set class_name = '".$class_name."' where class_id=$class_name_arr[1]");
    }
?>