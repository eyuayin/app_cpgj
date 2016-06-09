<html lang="en" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="/FE_all/css/bootstrap.css" rel="stylesheet"/>
    	<link href="/FE_all/css/site.css" rel="stylesheet"/>
      <link href="/FE_all/css/bootstrap-responsive.css" rel="stylesheet"/>
    <script src="FE_all/js/jquery.js"></script>


    </head>
    <style type="text/css">
    .white_content{
        display: none;
        position: absolute;
        top: 25%;  left: 25%;
        width: 50%;
        height: 80%;
        padding: 16px;
        border: 1px solid black;
        background-color: white;
        z-index:1002;
        overflow:auto
    }
</style>
    <body>
        <div id="light_meaCard" class="white_content">
        <div id="dituContent">
            <form action="modify_user_cui.php" method="post"  onsubmit="return check_input_valid();">
                <div class="control-group">
                    <label class="control-label" for="name">姓名</label>
                    <div class="controls">
                        <input type="datetime" class="input-xlarge" id="name" name="name" required="required" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sex">性别</label>
                    <div class="controls">
                        <select style="line-height:35px;" id="sex" name="sex" class="dropdown-select"  required="required"> <option value="男" >男</option><option value="女" >女</option></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="id_num">身份证号</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="id_num" name="id_num" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="birthday">生日</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="birthday" name="birthday" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="phone">手机号码</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="phone" name="phone"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="card_no">会员卡号</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="card_no" name="card_no" required="required" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="card_type">会员卡类型</label>
                    <div class="controls">
                        <select style="line-height:35px;" id="card_type" name="card_type" class="dropdown-select"  required="required"><option value="次卡" >次卡</option><option value="学期次卡" >学期次卡</option></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="priority">常温卡/高温卡</label>
                    <div class="controls">
                        <select style="line-height:35px;" id="priority" name="priority" class="dropdown-select"  required="required"> <option value="高温卡" >高温卡</option> <option value="常温卡" >常温卡</option></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="state">会员卡状态</label>
                    <div class="controls">
                        <select style="line-height:35px;" id="state" name="state" class="dropdown-select"  required="required"> <option value="未激活" >未激活</option> <option value="激活">激活</option> <option value="停卡">停卡</option> <option value="无效卡">无效卡</option></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="active_date">会员卡开卡日期</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="active_date" name="active_date"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="deactive_date">会员卡失效日期</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="deactive_date" name="deactive_date"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="frozen_date">会员卡冻结起始日期</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="frozen_date" name="frozen_date"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="unfrozen_date">会员卡冻结截止日期</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="unfrozen_date" name="unfrozen_date" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="used">已使用次数</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="used" name="used" required="required" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="total">总使用次数</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="total" name="total" required="required" />
                    </div>
                </div>
                <input type="hidden"  class="input-xlarge" id="former_card_id" name="former_card_id" />
                <input type="submit" class="btn btn-success btn-large" value="确认修改"/> <a class="btn" href="#" onClick="document.getElementById('light_meaCard').style.display='none';" >取消</a>
            </form>
        </div>
    </div>
        <div id="light_timeCard" class="white_content">
        <div id="dituContent">
            <form action="modify_user_cui.php" method="post"  onsubmit="return check_input_valid_timecard();">
                <div class="control-group">
                    <label class="control-label" for="name_timecard">姓名</label>
                    <div class="controls">
                        <input type="datetime" class="input-xlarge" id="name_timecard" name="name_timecard" required="required" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sex_timecard">性别</label>
                    <div class="controls">
                        <select style="line-height:35px;" id="sex_timecard" name="sex_timecard" class="dropdown-select"  required="required"> <option value="男" >男</option><option value="女" >女</option></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="id_num_timecard">身份证号</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="id_num_timecard" name="id_num_timecard" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="birthday_timecard">生日</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="birthday_timecard" name="birthday_timecard" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="phone_timecard">手机号码</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="phone_timecard" name="phone_timecard"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="card_no_timecard">会员卡号</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="card_no_timecard" name="card_no_timecard" required="required" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="card_type_timecard">会员卡类型</label>
                    <div class="controls">
                        <select style="line-height:35px;" id="card_type_timecard" name="card_type_timecard" class="dropdown-select"  required="required"> <option value="年卡" >年卡</option> <option value="年卡(不限次)" >年卡(不限次)</option> <option value="半年卡" >半年卡</option><option value="季卡" >季卡</option><option value="月卡" >月卡</option><option value="学期周卡" >学期周卡</option></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="priority_timecard">常温卡/高温卡</label>
                    <div class="controls">
                        <select style="line-height:35px;" id="priority_timecard" name="priority_timecard" class="dropdown-select"  required="required"> <option value="高温卡" >高温卡</option> <option value="常温卡" >常温卡</option></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="state_timecard">会员卡状态</label>
                    <div class="controls">
                        <select style="line-height:35px;" id="state_timecard" name="state_timecard" class="dropdown-select"  required="required"> <option value="未激活" >未激活</option> <option value="激活">激活</option> <option value="停卡">停卡</option> <option value="无效卡">无效卡</option></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="active_date_timecard">会员卡开卡日期</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="active_date_timecard" name="active_date_timecard"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="deactive_date_timecard">会员卡失效日期</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="deactive_date_timecard" name="deactive_date_timecard"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="frozen_date_timecard">会员卡冻结起始日期</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="frozen_date_timecard" name="frozen_date_timecard"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="unfrozen_date_timecard">会员卡冻结截止日期</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="unfrozen_date_timecard" name="unfrozen_date_timecard" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="total_timecard">本周最多可约课次数</label>
                    <div class="controls">
                        <input type="text"  class="input-xlarge" id="total_timecard" name="total_timecard" required="required" />
                    </div>
                </div>
                <input type="hidden"  class="input-xlarge" id="former_card_id_timecard" name="former_card_id_timecard" />
                <input type="submit" class="btn btn-success btn-large" value="确认修改"/> <a class="btn" href="#" onClick="document.getElementById('light_timeCard').style.display='none';" >取消</a>
            </form>
        </div>
    </div>
        <table class="table table-striped table-bordered table-condensed">
<?php
    require("./constant_var_define.php");

    function list_member_info($value, $conn)
    {
        global $card_tyep_num_to_name;
        global $sex_english_to_chinese;
        global $card_priority_num_to_name;
        global $card_status_num_to_name;
        global $sex_english_to_chinese;

        if($value[9] == TIME_CARD_TYPE)    //计时卡
        {
            $query_result = $conn->query("select * from time_card_table_cui where card_id='".$value[6]."'");
            debug_output("select * from time_card_table_cui where card_id='".$value[6]."'");
            $value_card = $query_result->fetch();

print <<<EOT
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>性别</th>
                        <th>身份证号</th>
                        <th>生日</th>
                        <th>手机号码</th>
                        <th>会员卡号</th>
                        <th>微信号码</th>
                        <th>会员卡类型</th>
                        <th>常温卡/高温卡</th>
                        <th>会员卡状态</th>
                        <th>会员卡开卡日期</th>
                        <th>会员卡失效日期</th>
                        <th>会员卡冻结起始日期</th>
                        <th>会员卡冻结截止日期</th>
                        <th>本周已约课次数</th>
                        <th>每周最多可约课次数</th>
                        <th>修改</th>
                    </tr>
                </thead>

            <tbody>
            <tr>
            <td>{$value[1]}</td>
            <td>{$sex_english_to_chinese[$value[2]]}</td>
            <td>{$value[3]}</td>
            <td>{$value[4]}</td>
            <td>{$value[5]}</td>
            <td>{$value[6]}</td>
            <td>{$value[8]}</td>
            <td>{$card_tyep_num_to_name[$value_card[9]]}</td>
            <td>{$card_priority_num_to_name[$value_card[1]]}</td>
            <td>{$card_status_num_to_name[$value_card[8]]}</td>
            <td>{$value_card[4]}</td>
            <td>{$value_card[5]}</td>
            <td>{$value_card[6]}</td>
            <td>{$value_card[7]}</td>
            <td>{$value_card[2]}</td>
            <td>{$value_card[3]}</td>
            <td class="modify_member_timeCard"><a style="cursor:pointer">修改</a></td>
            </tr>
            </tbody>
EOT;
        }
        else if($value[9] == MEASURED_CARD_TYPE)   //计次卡
        {
            debug_output("[6]是:".$value[6]);
            $query_result = $conn->query("select * from measured_card_table_cui where card_id='".$value[6]."'");
            debug_output("select * from measured_card_table_cui where card_id='".$value[6]."'");
            $value_card = $query_result->fetch();

print <<<EOT
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>性别</th>
                        <th>身份证号</th>
                        <th>生日</th>
                        <th>手机号码</th>
                        <th>会员卡号</th>
                        <th>微信号码</th>
                        <th>会员卡类型</th>
                        <th>常温卡/高温卡</th>
                        <th>会员卡状态</th>
                        <th>会员卡开卡日期</th>
                        <th>会员卡失效日期</th>
                        <th>会员卡冻结起始日期</th>
                        <th>会员卡冻结截止日期</th>
                        <th>已用次数</th>
                        <th>总次数</th>
                        <th>修改</th>
                    </tr>
                </thead>

            <tbody>
            <tr>
            <td>{$value[1]}</td>
            <td>{$sex_english_to_chinese[$value[2]]}</td>
            <td>{$value[3]}</td>
            <td>{$value[4]}</td>
            <td>{$value[5]}</td>
            <td>{$value[6]}</td>
            <td>{$value[8]}</td>
            <td>{$card_tyep_num_to_name[$value_card[7]]}</td>
            <td>{$card_priority_num_to_name[$value_card[1]]}</td>
            <td>{$card_status_num_to_name[$value_card[6]]}</td>
            <td>{$value_card[2]}</td>
            <td>{$value_card[3]}</td>
            <td>{$value_card[4]}</td>
            <td>{$value_card[5]}</td>
            <td>{$value_card[8]}</td>
            <td>{$value_card[9]}</td>
            <td  class="modify_member_MeaCard"><a style="cursor:pointer" >修改</a></td>
            </tr>
            </tbody>
EOT;
        }
        else
        {
            echo "无相应数据！";
            return;
        }
    }

    $search_type = $_POST['type'];
    $search_type = trim($search_type);

    if($search_type == 2)   //按手机号查询
    {
        debug_output("按手机号查询");
        $key_word = $_POST['search_value_phone'];
    }
    else if($search_type == 3)   //按会员卡号查询
    {
        debug_output("按会员卡号查询");
        $key_word = $_POST['search_value_card'];
    }
    else if($search_type == 1)  //按姓名查找
    {
        debug_output("按姓名查找");
        $key_word = $_POST['search_value_name'];
    }

    $key_word = trim($key_word);
    debug_output("查询方式为：".$search_type);
    debug_output("关键字为：".$key_word);

    if(empty($search_type))
    {
        echo "请输入查询方式！";
        return;
    }

    if($search_type >= 1 && $search_type <= 3)
    {
        if(empty($key_word))
        {
            echo "请输入查询关键字！";
            return;
        }
    }
    else
    {
        echo "暂不支持此种查询方式！";
        return;
    }


    //连接数据库的参数
    $conn = db_connect();

    if($search_type == 1)   //按姓名查询
    {
        $query_result = $conn->query("select * from member_info_table_cui where member_name='".$key_word."'");
        debug_output("select * from member_info_table_cui where member_name='".$key_word."'");
        if(!$query_result)
        {
            debug_output("0.数据库错误！");
            echo "数据库错误！";
            return;
        }
        $value = $query_result->fetchAll();
        
        foreach($value as $name)
        {
           debug_output("$name is'".$name."'");
           list_member_info($name, $conn); 
        }
    }
    else if($search_type == 2)  //按手机号查询
    {
        $query_result = $conn->query("select * from member_info_table_cui where phone='".$key_word."'");
        debug_output("select * from member_info_table_cui where phone='".$key_word."'");
        if(!$query_result)
        {
            debug_output("1.数据库错误！");
            echo "数据库错误！";
            return;
        }
        $value = $query_result->fetch();

        list_member_info($value, $conn);
    }
    else if($search_type == 3)  //按会员卡号查询
    {
        $query_result = $conn->query("select * from member_info_table_cui where card_id='".$key_word."'");
        debug_output("select * from member_info_table_cui where card_id='".$key_word."'");
        if(!$query_result)
        {
            debug_output("1.数据库错误！");
            echo "数据库错误！";
            return;
        }
        $value = $query_result->fetch();

        list_member_info($value, $conn);
    }
    else
    {
        echo "暂不支持此种查询方式！";
        return;
    }

?>
    </table>
    <script >
        //弹出输入框并保持内容和点击行一致
        $(".modify_member_MeaCard").click(function(){
            console.log("indddddd");
            document.getElementById('light_meaCard').style.display='block';

            //获取原始表格上的显示值
            var name = $(this).parent().children("td:eq(0)").text();
            var sex = $(this).parent().children("td:eq(1)").text();
            var id = $(this).parent().children("td:eq(2)").text();
            var birthday = $(this).parent().children("td:eq(3)").text();
            var phone = $(this).parent().children("td:eq(4)").text();
            var card_id = $(this).parent().children("td:eq(5)").text();
            var card_type = $(this).parent().children("td:eq(7)").text();
            var priority = $(this).parent().children("td:eq(8)").text();
            var state = $(this).parent().children("td:eq(9)").text();
            var active_time = $(this).parent().children("td:eq(10)").text();
            var deactive_time = $(this).parent().children("td:eq(11)").text();
            var frozen_time = $(this).parent().children("td:eq(12)").text();
            var unfrozen_time = $(this).parent().children("td:eq(13)").text();
            var used = $(this).parent().children("td:eq(14)").text();
            var total = $(this).parent().children("td:eq(15)").text();
            //var used = $(this).parent().children("td:eq(15)").text();

            //将原始表格值赋给弹出的表单
            $("#name").val(name);
            $("#former_card_id").val(card_id);
            $("#id_num").val(id);
            $("#birthday").val(birthday);
            $("#phone").val(phone);
            $("#card_no").val(card_id);
            $("#active_date").val(active_time);
            $("#deactive_date").val(deactive_time);
            $("#frozen_date").val(frozen_time);
            $("#unfrozen_date").val(unfrozen_time);
            $("#used").val(used);
            $("#total").val(total);
            $('#priority option').each(function() {
                if($(this).val()==priority){
                    console.log("in priority",$(this).val());
                    $(this).attr('selected',true);
                }
            });
            $('#card_type option').each(function() {
                if($(this).val()==card_type){
                    console.log("in type",$(this).val());
                    $(this).attr('selected',true);
                }
            });
            $('#state option').each(function() {
                if($(this).val()==state){
                    console.log("in state",$(this).val());
                    $(this).attr('selected',true);
                }
            });
            $('#sex option').each(function() {
                if($(this).val()==sex){
                    console.log("in sex");
                    $(this).attr('selected',true);
                }
            });
        });
        $(".modify_member_timeCard").click(function(){
            console.log("intimecard");
            document.getElementById('light_timeCard').style.display='block';

            //获取原始表格上的显示值
            var name = $(this).parent().children("td:eq(0)").text();
            var sex = $(this).parent().children("td:eq(1)").text();
            var id = $(this).parent().children("td:eq(2)").text();
            var birthday = $(this).parent().children("td:eq(3)").text();
            var phone = $(this).parent().children("td:eq(4)").text();
            var card_id = $(this).parent().children("td:eq(5)").text();
            var card_type = $(this).parent().children("td:eq(7)").text();
            var priority = $(this).parent().children("td:eq(8)").text();
            var state = $(this).parent().children("td:eq(9)").text();
            var active_time = $(this).parent().children("td:eq(10)").text();
            var deactive_time = $(this).parent().children("td:eq(11)").text();
            var frozen_time = $(this).parent().children("td:eq(12)").text();
            var unfrozen_time = $(this).parent().children("td:eq(13)").text();
            var total = $(this).parent().children("td:eq(15)").text();
            //var used = $(this).parent().children("td:eq(15)").text();

            //将原始表格值赋给弹出的表单
            $("#name_timecard").val(name);
            $("#id_num_timecard").val(id);
            $("#birthday_timecard").val(birthday);
            $("#phone_timecard").val(phone);
            $("#card_no_timecard").val(card_id);
            $("#former_card_id_timecard").val(card_id);
            $("#active_date_timecard").val(active_time);
            $("#deactive_date_timecard").val(deactive_time);
            $("#frozen_date_timecard").val(frozen_time);
            $("#unfrozen_date_timecard").val(unfrozen_time);
            $("#total_timecard").val(total);
            //$("#used").val(used);
            $('#priority_timecard option').each(function() {
                if($(this).val()==priority){
                    console.log("in priority",$(this).val());
                    $(this).attr('selected',true);
                }
            });
            $('#card_type_timecard option').each(function() {
                if($(this).val()==card_type){
                    console.log("in type",$(this).val());
                    $(this).attr('selected',true);
                }
            });
            $('#state_timecard option').each(function() {
                if($(this).val()==state){
                    console.log("in state",$(this).val());
                    $(this).attr('selected',true);
                }
            });
            $('#sex_timecard option').each(function() {
                if($(this).val()==sex){
                    console.log("in sex");
                    $(this).attr('selected',true);
                }
            });
        });

        //根据会员姓名查询该会员所有约课记录
        $(".check_book_record").click(function(){
            var name = $(this).parent().parent().children("td:eq(0)").text();
            console.log("name",name);
             $.post("/FE_all_cui/query_book_record_backend.php",
                    {   
                        name:name               
                    },
                    function (data, status) {
                        console.log("indata",data);
                        alert(data);
                    });
        });

        //check input 值有效
        function check_input_valid() {
            //输入日期格式正确
            var objRegExp = /^(\d{4})\-(\d{2})\-(\d{2})$/;
            var reg = /^1\d{10}$/;
            var reg1 = /^\d{1,}$/;
            var active = $("#active_date").val();
            var deactive =   $("#deactive_date").val();
            var frozen = $("#frozen_date").val();
            var unfrozen = $("#unfrozen_date").val();
            var birth =   $("#birthday").val();
            var phone =   $("#phone").val();
            var total =   $("#total").val();
            var active_timecard = $("#active_date_timecard").val();
            var deactive_timecard =   $("#deactive_date_timecard").val();
            var frozen_timecard = $("#frozen_date_timecard").val();
            var unfrozen_timecard = $("#unfrozen_date_timecard").val();
            var birth_timecard =   $("#birthday_timecard").val();
            var phone_timecard =   $("#phone_timecard").val();
            var total_timecard =   $("#total_timecard").val();

            if (!objRegExp.test(active) && active) {
                alert("请输入正确的'会员卡开卡日期'格式，例如 2015-09-01");
                console.log("false");
                return false;
            }
            else if(!objRegExp.test(deactive) && deactive){
                alert("请输入正确的'会员卡失效日期'格式，例如 2016-09-01");
                return false;
            }
            else if(!objRegExp.test(frozen) && frozen ){
                alert("请输入正确的'会员卡冻结起始日期'格式，例如 2015-10-01");
                return false;
            }
            else if(!objRegExp.test(unfrozen) && unfrozen){
                alert("请输入正确的'会员卡冻结截止日期'格式，例如 2015-11-01");
                return false;
            }
            else if(!objRegExp.test(birth) && birth){
                alert("请输入正确的'生日'格式，例如 1989-09-01");
                return false;
            }
            else if(!reg.test(phone) && phone){
                alert("手机号码应为11位，例如 18965436754");
                return false;
            }
            else if(!reg1.test(total)){
                alert("总使用次数必须为数字！");
                return false;
            }
            else {
                console.log("true");
                return true;
            }
        }
        function check_input_valid_timecard() {
            //输入日期格式正确
            var objRegExp = /^(\d{4})\-(\d{2})\-(\d{2})$/;
            var reg = /^1\d{10}$/;
            var reg1 = /^\d{1,}$/;
            var active = $("#active_date_timecard").val();
            var deactive =   $("#deactive_date_timecard").val();
            var frozen = $("#frozen_date_timecard").val();
            var unfrozen = $("#unfrozen_date_timecard").val();
            var birth =   $("#birthday_timecard").val();
            var phone =   $("#phone_timecard").val();
            var total =   $("#total_timecard").val();

            if (!objRegExp.test(active) && active) {
                alert("请输入正确的'会员卡开卡日期'格式，例如 2015-09-01");
                console.log("false");
                return false;
            }
            else if(!objRegExp.test(deactive) && deactive){
                alert("请输入正确的'会员卡失效日期'格式，例如 2016-09-01");
                return false;
            }
            else if(!objRegExp.test(frozen) && frozen ){
                alert("请输入正确的'会员卡冻结起始日期'格式，例如 2015-10-01");
                return false;
            }
            else if(!objRegExp.test(unfrozen) && unfrozen){
                alert("请输入正确的'会员卡冻结截止日期'格式，例如 2015-11-01");
                return false;
            }
            else if(!objRegExp.test(birth) && birth){
                alert("请输入正确的'生日'格式，例如 1989-09-01");
                return false;
            }
            else if(!reg.test(phone) && phone){
                alert("手机号码应为11位，例如 18965436754");
                return false;
            }
            else if(!reg1.test(total)){
                alert("本周最多可约课次数必须为数字！");
                return false;
            }
            else {
                console.log("true");
                return true;
            }
        }
    </script>
</body>
</html>