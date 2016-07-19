
<?php
/*****************************************************************************************************
*************************                    常量定义                 ********************************
*****************************************************************************************************/
    define("CANCEL_TIME_LIMIT", "2");               //取消约课时间限制
    define("CANCEL_TIMES_PER_MONTH", "1");          //每月取消次数限制
    date_default_timezone_set('PRC');               //设置时区
    define("TODAY_DATE", date("Y-m-d",time()));     //当前日期，格式：2015-12-31
    define("NOW_TIME", date("Y-m-d H:i:s",time())); //现在时间，格式：2015-12-31 13:59:59
    define("TIME_CARD_TYPE", "1");                  //计时卡
    define("MEASURED_CARD_TYPE", "2");              //计次卡
    define("PERSONAL_COACH_CARD_TYPE", "9");        //私教卡
    define("SMALL_CLASS_CARD_TYPE", "10");           //小班卡
    define("ITEMS_PER_PAGE", "15");                 //课程信息、会员信息，每页显示的条目数

    //上课地点名称转换为编号
    $location_name_to_num = array(
        "翠屏国际"=>1,
        "君子兰"=>2,
        "百家湖"=>3   //useless
    );

    //上课地点编号转换为名称
    $location_num_to_name = array(
        1=>"翠屏国际",
        2=>"君子兰",
        3=>"百家湖"   //useless
    );

    //君子兰教室名称转换编号
    $classroom_name_to_num = array(
        "一楼大教室"=>1,
        "二楼大教室"=>2,
        "一楼VIP"=>3,
        "二楼VIP-1"=>4,
        "二楼VIP-2"=>5,
        "二楼VIP-3"=>6
    );
	
	//翠屏国际教室名称转换编号
    $classroom_name_to_num_cui = array(
        "一楼大教室"=>1,
        "二楼大教室"=>2,
        "二楼小教室"=>3,
        "百家湖一楼教室"=>4,
        "百家湖二楼教室"=>5
    );

    //君子兰教室编号转换名称
    $classroom_num_to_name = array(
        1=>"一楼大教室",
        2=>"二楼大教室",
        3=>"一楼VIP",
        4=>"二楼VIP-1",
        5=>"二楼VIP-2",
        6=>"二楼VIP-3"
    );
	
	 //翠屏教室编号转换名称
    $classroom_num_to_name_cui = array(
        1=>"一楼大教室",
        2=>"二楼大教室",
        3=>"二楼小教室",
        4=>"百家湖一楼教室",
        5=>"百家湖二楼教室"
    );

    //卡类型名称转换为卡类型编号
    $card_tyep_name_to_num = array(
        "年卡"=>1,
        "半年卡"=>2,
        "季卡"=>3,
        "月卡"=>4,
        "次卡"=>5,
        "学期周卡"=>6,
        "学期次卡"=>7,
        "年卡(不限次)"=>8,
        "私教卡"=>9,
        "精品课卡"=>10,
        "高温年卡不限次"=>11
    ); 

    //卡类型编号转换为卡类型名称
    $card_tyep_num_to_name = array(
        1=>"年卡",
        2=>"半年卡",
        3=>"季卡",
        4=>"月卡",
        5=>"次卡",
        6=>"学期周卡",
        7=>"学期次卡",
        8=>"年卡(不限次)",
        9=>"私教卡",
        10=>"精品课卡",
        11=>"高温年卡不限次"
    );

    //课程优先级名称转换为优先级编号
    $class_priority_name_to_num = array(
        "高温"=>1,
        "常温"=>2,
        "私教课"=>3,
        "小班课"=>4
    );

    //课程优先级编号转换为优先级名称
    $class_priority_num_to_name = array(
        1=>"高温",
        2=>"常温",
        3=>"私教课",
        4=>"小班课"
    );

    //卡优先级名称转换为优先级编号
    $card_priority_name_to_num = array(
        "高温卡"=>1,
        "常温卡"=>2,
        "私教卡"=>3,
        "小班卡"=>4
    );

    //卡优先级编号转换为优先级名称
    $card_priority_num_to_name = array(
        1=>"高温卡",
        2=>"常温卡",
        3=>"私教卡",
        4=>"小班卡"
    );

    //卡状态名称转换为编号
    $card_status_name_to_num = array(
        "未激活"=>0,
        "激活"=>1,
        "停卡"=>2,
        "无效卡"=>3
    );

    //卡状态编号转换为名称
    $card_status_num_to_name = array(
        0=>"未激活",
        1=>"激活",
        2=>"停卡",
        3=>"无效卡"
    );

    //性别中文转英文
    $sex_chinese_to_english = array
    (
        "女"=>"female",
        "男"=>"male"
    );

    //性别英文转中文
    $sex_english_to_chinese = array
    (
        "female"=>"女",
        "male"=>"男"
    );

    //签到数字转汉字
    $sign_num_to_name = array
    (
        0=>"未签到",
        1=>"已签到"
    );

    //课程名称转换为相应编号
    /*$class_name_to_num = array(
        "Ashtanga 阿斯汤加"=>1,
        "Basic 基础及伸展"=>2,
        "Iyengar 艾扬格"=>3,
        "Hot yoga 热瑜伽"=>4,
        "泡沫轴"=>5,
        "Yin Yoga 阴瑜伽"=>6,
        "Hatha 精准顺位"=>7,
        "Prenatal Yoga 孕妇瑜伽"=>8,
        "儿童瑜伽（6-9岁）"=>9,
        "Pilates Ball 普拉提球"=>10,
        "少儿拉丁"=>11,
        "艾扬格修复"=>12,
        "raqs sharqi 肚皮舞"=>13,
        "Jazz 爵士舞"=>14,
        "Shaping 舍宾"=>15,
        "有氧热舞"=>16,
        "Latin 拉丁舞"=>17,
        "儿童瑜伽（3-6岁）"=>18
    ); 

    //课程编号转换为课程名称
    $class_num_to_name = array(
        1=>"Ashtanga 阿斯汤加",
        2=>"Basic 基础及伸展",
        3=>"Iyengar 艾扬格",
        4=>"Hot yoga 热瑜伽",
        5=>"泡沫轴",
        6=>"Yin Yoga 阴瑜伽",
        7=>"Hatha 精准顺位",
        8=>"Prenatal Yoga 孕妇瑜伽",
        9=>"儿童瑜伽（6-9岁）",
        10=>"Pilates Ball 普拉提球",
        11=>"少儿拉丁",
        12=>"艾扬格修复",
        13=>"raqs sharqi 肚皮舞",
        14=>"Jazz 爵士舞",
        15=>"Shaping 舍宾",
        16=>"有氧热舞",
        17=>"Latin 拉丁舞",
        18=>"儿童瑜伽（3-6岁）"
    );

    //老师名字转换为编号
    $teacher_name_to_num = array(
        "谷老师"=>1,
        "环老师"=>2,
        "卢老师"=>3,
        "李老师"=>4,
        "穆老师"=>5,
        "甘老师"=>6,
        "萧老师"=>7,
        "付老师"=>8,
        "夏老师"=>9,
        "杨老师"=>10,
        "方老师"=>11,
        "Amy"=>12,
        "赵老师"=>13,
        "程老师"=>14,
        "曹老师"=>15
    );

    //老师编号转换为名字
    $teacher_num_to_name = array(
        1=>"谷老师",
        2=>"环老师",
        3=>"卢老师",
        4=>"李老师",
        5=>"穆老师",
        6=>"甘老师",
        7=>"萧老师",
        8=>"付老师",
        9=>"夏老师",
        10=>"杨老师",
        11=>"方老师",
        12=>"Amy",
        13=>"赵老师",
        14=>"程老师",
        15=>"曹老师"
    );*/


/*****************************************************************************************************
*************************                    函数定义                 ********************************
*****************************************************************************************************/
    function db_connect()
    {
        //连接数据库的参数
        $host="localhost";  
        $port=3306;
        $dbname="app_cpgj";
        $dbuser="root";
        $dbpassw="";
        $dsn = "mysql:host=".$host.";port=".$port.";dbname=".$dbname;
        //连接数据库
        try
        {
            $conn =  new PDO($dsn, $dbuser, $dbpassw);
        }
        catch(Exception $e)
        {
            echo $e;
            echo "数据库连接错误！请稍后重试！";
            return;
        }
        //设置编码
        $conn->query("set names utf8");

        return $conn;
    }

    function debug_output($data)
    {
        echo "$data<br />";
    }

    //设置输出字体
    function page_output($font_color, $font_size, $output_data)
    {
        echo "<font color=$font_color size=$font_size>";
        echo "$output_data<br />";
        echo "</font>";
    }
    
     //获得星期
      function   get_week($date){
        //强制转换日期格式
        $date_str=date('Y-m-d',strtotime($date));
   
        //封装成数组
        $arr=explode("-", $date_str);
        
        //参数赋值
        //年
        $year=$arr[0];
        
        //月，输出2位整型，不够2位右对齐
        $month=sprintf('%02d',$arr[1]);
        
        //日，输出2位整型，不够2位右对齐
        $day=sprintf('%02d',$arr[2]);
        
        //时分秒默认赋值为0；
        $hour = $minute = $second = 0;   
        
        //转换成时间戳
        $strap = mktime($hour,$minute,$second,$month,$day,$year);
        
        //获取数字型星期几
        $number_wk=date("w",$strap);
        
        //自定义星期数组
        $weekArr=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
        
        //获取数字对应的星期
        return $weekArr[$number_wk];
    }
    
    function get_current_date(){
        return date("y-m-d",time());
    }
    
?>
