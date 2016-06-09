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
        echo "会员信息导入失败，请重试！<br/>";
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
            echo "会员信息导入失败，请重试！<br/>";
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
            	$name = $val;
            else if($currentColumn == 'B')
            	$sex = $val;
            else if($currentColumn == 'C')
            	$ID = $val;
            else if($currentColumn == 'D')
            	$phone = $val;
            else if($currentColumn == 'E')
            	$card_id = $val;
             else if($currentColumn == 'F')
            	$card_type_detail = $val;
            else if($currentColumn == 'G')
            	$card_type = $val;
            else if($currentColumn == 'H')
            	$valid_time_lower = $val;
            else if($currentColumn == 'I')
            	$valid_time_upper = $val;
            else if($currentColumn == 'J')
            	$frozen_time_lower = $val;
            else if($currentColumn == 'K')
            	$frozen_time_upper = $val;
             else if($currentColumn == 'L')
            	$note = $val;
            
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
        
        //中文性别转换成英文性别
        $sex_english = $sex_chinese_to_english[$sex];
        
        //卡类型转换
        if($card_type == "计时卡")
           $card_type_num = TIME_CARD_TYPE;
        else
           $card_type_num = MEASURED_CARD_TYPE;
    
        //先根据card ID查询是否已经有相同会员信息
        $query_result = $conn->query("select card_id from member_info_table where card_id='".$card_id."'");
        $result = $query_result->fetch();
        if(!empty($result))
        {
            $errorRow = $currentRow;
            echo "会员信息文件中第".$errorRow."条会员卡号与其他会员卡号有冲突，请确认！<br/>";
            $fail_num++;
        }
        else	//没有冲突，则将新数据插入到数据库中
        {
            $conn->query("insert into member_info_table (member_name,sex,identy_card_number,phone,card_id,card_type,remarks) values ('".$name."','".$sex_english."','".$ID."','".$phone."','".$card_id."',$card_type_num,'".$note."')");
            //echo "insert into class_info_table (class_name,class_begin_time,class_end_time,location,classroom,teacher,max_user_number,class_priority) values ('".$class_name."','".$begin_time."','".$end_time."',$location_num,$class_room_num,'".$teacher."',$capacity,$priority)";
            if($card_type_num == TIME_CARD_TYPE)
              $conn->query("insert into member_info_table (member_,sex,identy_card_number,phone,card_id,card_type,remarks) values ('".$name."','".$sex_english."','".$ID."','".$phone."','".$card_id."',$card_type_num,'".$note."')");
            else if($card_type_num == MEASURED_CARD_TYPE) 
              $conn->query("insert into measured_card_table (card_id,sex,identy_card_number,phone,card_id,card_type,remarks) values ('".$name."','".$sex_english."','".$ID."','".$phone."','".$card_id."',$card_type_num,'".$note."')");             
            else
              echo "第".$errorRow."条会员填写的会员卡大类信息有误，请填写计时卡或者计次卡！"
            $success_num++;
        }
    }
    
echo <<<EOF
    <p>您的文件: {$sFileName} 已经上传成功</p>
    <p>大小: {$sFileSize}</p>
    <p>总会员: {$total_class} 条</p>
    <p>新增会员: {$success_num} 条</p>
    <p>失败会员: {$fail_num} 条</p>
EOF;

?>