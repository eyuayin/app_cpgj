<?php
    require("./constant_var_define.php");

    //连接数据库的参数
    $conn = db_connect();

    $query_result = $conn->query("select teacher,class_id from class_info_table");
    $value = $query_result->fetchAll();

    foreach($value as $teacher_name_arr)
    {
        $db_teacher_name_num = $teacher_name_arr[0];
        $teacher_name = $teacher_num_to_name[$db_teacher_name_num];
        echo "teacher_name:".$teacher_name."<br />";

        $query_result2 = $conn->query("update class_info_table set teacher = '".$teacher_name."' where class_id=$teacher_name_arr[1]");
    }
?>