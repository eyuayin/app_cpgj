<?php

class Table {

    private $data;//array

    private $head;//array

    private $table_class;//array


    function __construct($_head, $_data, $_class = null){
        $this->head = $_head;
        $this->data = $_data;
        $table_class = $_class;
    }

    public function set_data($_data){
        $this->data = $_data;
    }

    public function set_head($_head){
        $this->head = $_head;
    }

    public function show_var(){
        var_dump($this->data);
        var_dump($this->head);
    }

    private function tag_gen($_tag, $content){
        $tag = "<$_tag>".$content."</$_tag>";
        return $tag;
    }

    private function br_gen(){
        return "<br />";
    }

    private function table_head_gen(){
        $content = "";
        foreach($this->head as $item){
            $content .= $this->tag_gen("th", $item);
        }
        $table_head = $this->tag_gen("tr", $content);
        return $table_head;
    }

    private function table_body_gen(){
        $content = "";
        foreach($this->data as $row){
            $row_content = "";
            foreach($row as $item){
                $row_content .= $this->tag_gen("td", $item);
            }
            $content .= $this->tag_gen("tr", $row_content);
        }
        return $content;
    }

    public function table_gen(){
        $_head = $this->table_head_gen();
        $_body = $this->table_body_gen();
        $content = $this->tag_gen("table", $_head.$_body);
        return $content;
    }

}


$_head = array("会员id", "会员姓名", "会员卡id", "会员卡类型", "卡状态", "位置", "开始时间", "结束时间","dddd");


require_once("./mysql_crud.php");
$db = new Database();
$db->connect();
$db->select('class_detail_in_7_days');
$res = $db->getResult();

$t = new Table($_head, $res);
print_r($t->table_gen());

?>
