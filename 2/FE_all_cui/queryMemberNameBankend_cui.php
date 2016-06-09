<?php

    require("../constant_var_define.php");
    //连接数据库
    $conn = db_connect();

    $st = $conn->query("select member_name from member_info_table");
    //debug_output("select member_name from member_info_table");
    $rs = $st->fetchAll();
	
	$member_name_array = array(); //新建数组用于保存会员姓名

    //显示所有记录
    foreach ($rs as $value) {
        //echo $value[0];
		$member_name_array[] = $value[0];
	} 
    
    //此类用来充定义json_encode,避免将中文转换成unicode    
    class Util
        {
          static function json_encode($input){
            if(is_string($input)){
              $text = $input;
              $text = str_replace('\\', '\\\\', $text);
              $text = str_replace(
                array("\r", "\n", "\t", "\""),
                array('\r', '\n', '\t', '\\"'),
                $text);
              return '"' . $text . '"';
            }else if(is_array($input) || is_object($input)){
              $arr = array();
              $is_obj = is_object($input) || (array_keys($input) !== range(0, count($input) - 1));
              foreach($input as $k=>$v){
                if($is_obj){
                  $arr[] = self::json_encode($k) . ':' . self::json_encode($v);
                }else{
                  $arr[] = self::json_encode($v);
                }
              }
              if($is_obj){
                return '{' . join(',', $arr) . '}';
              }else{
                return '[' . join(',', $arr) . ']';
              }
            }else{
              return $input . '';
            }
          }
        }
    
    $a = new Util(); 
    echo $a->json_encode($member_name_array);
	
?>