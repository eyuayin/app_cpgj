<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
    error_reporting(E_ALL);
	require_once './PHPExcel.php';
    require("../constant_var_define.php");
    
    function bytesToSize1024($bytes, $precision = 2) {
        $unit = array('B','KB','MB');
        return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
    }

	/**对excel里的日期进行格式转化*/ 
    function GetData($val){ 

    } 

    $sFileName = $_FILES['image_file']['name'];
    $sFileType = $_FILES['image_file']['type'];
    $sFileSize = bytesToSize1024($_FILES['image_file']['size'], 1);

    $ret = move_uploaded_file($_FILES['image_file']['tmp_name'], SAE_TMP_PATH.'/'.$_FILES['image_file']['name']);
    if(!$ret)
    {
        echo "课程信息导入失败，请重试！<br/>";
        return;
    }
    
	$filename = SAE_TMP_PATH.'/'.$_FILES['image_file']['name'];	//移动后的文件路径及名字
    
	//读取保存在storage的excel中的内容
	$PHPExcel = new PHPExcel();
	/**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/ 
    $PHPReader = new PHPExcel_Reader_Excel2007(); 
    if(!$PHPReader->canRead($filename))
    { 
    	$PHPReader = new PHPExcel_Reader_Excel5(); 
        if(!$PHPReader->canRead($filename))
        { 
            echo "课程信息导入失败，请重试！<br/>";
        	return ; 
    	} 
    } 
    
    $PHPExcel = $PHPReader->load($filename); 
    /**读取excel文件中的第一个工作表*/ 
    $currentSheet = $PHPExcel->getSheet(0); 
    /**取得最大的列号，为字母表示*/ 
    $allColumn = $currentSheet->getHighestColumn(); 
    /**取得一共有多少行，为数字表示*/ 
    $allRow = $currentSheet->getHighestRow(); 
	//echo "列：".$allColumn."  行：".$allRow."<br/>";

	$total_class = $allRow - 1;

	//设置变量，记录添加成功条数和失败条数
	$success_num = 0;
	$fail_num = 0;

    //连接数据库
    try
    {
        $conn =  db_connect();
    }
    catch(Exception $e)
    {
        echo "数据库连接错误！请稍后重试！";
        return;
    }

    /**从第二行开始读取数据，因为excel表中第一行为列名*/
    for($currentRow = 2;$currentRow <= $allRow; $currentRow++)
    { 
        /**从第A列开始输出*/ 
        for($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++)
        { 
            $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /**ord()将字符转为十进制数*/ 
            /**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/ 
            //echo iconv('utf-8','gb2312', $val)."\t";
            //echo $val."</br>";
            if($currentColumn == 'A')
            	$class_name = $val;
            else if($currentColumn == 'B')
            	$begin_time = $val;
            else if($currentColumn == 'C')
            	$end_time = $val;
            else if($currentColumn == 'D')
            	$location = $val;
            else if($currentColumn == 'E')
            	$class_room = $val;
            else if($currentColumn == 'F')
            	$teacher = $val;
            else if($currentColumn == 'G')
            	$capacity = $val;
            else if($currentColumn == 'H')
            	$priority = $val;
        }
        //echo "$class_name</br>";
        //echo "$begin_time</br>";
        //echo "$end_time</br>";
        //echo "$location</br>";
        //echo "$class_room</br>";
        //echo "$teacher</br>";
        //echo "$capacity</br>";
        //echo "$priority</br>";
        //echo "</br>"; 
        
        $location_num  = $location_name_to_num[$location];
        //echo "地点编号是：".$location_num."</br>";
        $class_room_num  = $classroom_name_to_num[$class_room];
        //echo "教室编号是：".$class_room_num."</br>";
        $priority  = $class_priority_name_to_num[$priority];
        //echo "优先级编号是：".$priority."</br>";
    
        //先根据begin_time,location,classroom查询是否已经有相同课程信息
        $query_result = $conn->query("select class_name from class_info_table where class_begin_time='".$begin_time."' and location=$location_num and classroom=$class_room_num");
        $result = $query_result->fetch();
        if(!empty($result))
        {
            $errorRow = $currentRow;
            echo "课程信息文件中第".$errorRow."条课程与其他课程安排有冲突，请确认！<br/>";
            $fail_num++;
        }
        else	//没有冲突，则将新数据插入到数据库中
        {
            $conn->query("insert into class_info_table (class_name,class_begin_time,class_end_time,location,classroom,teacher,max_user_number,class_priority) values ('".$class_name."','".$begin_time."','".$end_time."',$location_num,$class_room_num,'".$teacher."',$capacity,$priority)");
            //echo "insert into class_info_table (class_name,class_begin_time,class_end_time,location,classroom,teacher,max_user_number,class_priority) values ('".$class_name."','".$begin_time."','".$end_time."',$location_num,$class_room_num,'".$teacher."',$capacity,$priority)";
            $success_num++;
        }
    }
    
echo <<<EOF
    <p>您的文件: {$sFileName} 已经上传成功</p>
    <p>大小: {$sFileSize}</p>
    <p>总课程: {$total_class} 条</p>
    <p>新增课程: {$success_num} 条</p>
    <p>失败课程: {$fail_num} 条</p>
EOF;

?>