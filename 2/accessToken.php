<?php

$appid = "wxfbb810b7659eac2f";
$appsecret = "84e3877521b923db34464931ae397447";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$jsoninfo = json_decode($output, true);
$access_token = $jsoninfo["access_token"];

$jsonmenu = '{
     
    "button": [
        {
            "name": "场馆介绍", 
            "sub_button": [
                {
                    "type": "click", 
                    "name": "场馆介绍", 
                    "key": "int"
                }, 
                {
                    "type": "click", 
                    "name": "教练美图", 
                    "key": "pic"
                }, 
                {
                    "type": "click", 
                    "name": "会员风采", 
                    "key": "mem"
                }
            ]
        }, 
        {
            "name": "课程介绍", 
            "sub_button": [
                {
                    "type": "click", 
                    "name": "课程简介", 
                    "key": "his"
                }, 
                {
                    "type": "click", 
                    "name": "往期回顾", 
                    "key": "class"
                }, 
                {
                    "type": "click", 
                    "name": "初学者", 
                    "key": "new"
                }
            ]
        }, 
        {
            "name": "课程预约", 
            "sub_button": [
                {
                    "type": "view", 
                    "name": "课程表", 
                    "url": "http://1.thyjjzl.sinaapp.com/mmexport1439827582607.jpg"
                }, 
                {
                    "type": "click", 
                    "name": "课程预约", 
                    "key": "book"
                }, 
                {
                    "type": "click", 
                    "name": "已约课程查询", 
                    "key": "one"
                }
            ]
        }
    ]
}';
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}


?>