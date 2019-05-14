<?php

/*手机号验证*/

use \think\Session;

function phone_ya($p){
    if(preg_match("/1[3456789]{1}\d{9}$/",$p)){

        $m='ok';
    }else{

        $m='no';
    }
    return $m;
}

//创建二次提交
function createJianc() {
    $code = chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) .       chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) . chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE));
    Session::set('add_Jianc', authcode($code));
}
//判断TOKEN
function checkJianc($token) {
    if ($token == Session::get('add_Jianc') and $token !== NULL and Session::get('add_Jianc') !== NULL) {
        Session::clear('add_Jianc');
        return true;
    } else {
        return false;
    }
}
/* 加密TOKEN */
function authcode($str) {
    $key = "YOURKEY";
    $str = substr(md5($str), 8, 10);
    return md5($key . $str);
}

/* 判断图片是否符合规定 */
function is_image($img,$width,$height){
    //取图片宽高
    $are=Image_Size($img);
    //判断
    if ($are[0] == $width and $are[1] == $height){
        return true;
    }else{
        return false;
    }
}

/* 获取image 宽高 */
function Image_Size($arr){
    //图片宽高
    $image = \think\Image::open($arr);

    // 返回图片的宽度
    $width = $image->width();
    // 返回图片的高度
    $height = $image->height();

    $info_image=array($width,$height);
    return $info_image;
}

/* 取前七天的日期 */
function get_weeks($time = '', $format='m-d'){
    $time = $time != '' ? $time : time();
    //组合数据
    $date = [];
    for ($i=1; $i<=7; $i++){
        $date[$i] = date($format ,strtotime( '+' . $i-7 .' days', $time));
    }
    return $date;
}
/* 取前七天的日期 */
function get_weekss($time = '', $format='d'){
    $time = $time != '' ? $time : time();
    //组合数据
    $date = [];
    for ($i=1; $i<=7; $i++){
        $date[$i] = date($format ,strtotime( '+' . $i-7 .' days', $time));
    }
    return $date;
}
/* 取前一个月每天的日期 */
function get_day($time = '', $format='m-d'){
    $j = date("t"); //获取当前月份天数
    $start_time = strtotime(date('Y-m-01'));  //获取本月第一天时间戳
    $array = array();
    for($i=0;$i<$j;$i++){
        $array[] = date('m-d',$start_time+$i*86400); //每隔一天赋值给数组
    }

    return $array;
}

/* 取往年的日期 */
function get_year($time = '', $format='Y'){
    $time = $time != '' ? $time : time();
    //组合数据
    $date = [];
    for ($i=1; $i<=7; $i++){
        $date[$i] = date($format ,strtotime( '+' . $i-7 .' year', $time));
    }
    return $date;
}

