<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function makeCache($filename,$data)
{
	$base_dir = 'datacache';
	if(!file_exists($base_dir)) mkdir($base_dir,0777,true);
    $file_path = $base_dir.'/'.$filename.'.js';
    @file_put_contents($file_path,$data);
	return true;
}

function getCache($filename)
{
	$base_dir = 'datacache';
	$file = $base_dir.'/'.$filename.'.js';
	$data = @file_get_contents($file);
	return json_decode($data,true);
}

/**
 * [getLang 获取语言包]
 * @param  [type] $lang_alias [description]
 * @return [type]             [description]
 */
function getLang($filename,$lang_alias)
{
	$base_dir = 'langcn';
	$lang_file = $base_dir . '/' .$filename.".php";
	$data = @file_get_contents($lang_file);
	if($data[$lang_alias] != '') $res = $data[$lang_alias];
	else $res = '操作成功';
	return $res;
}


function getRand()
{
	$rand = md5(rand());
	return $rand;
}

function create_id()
{
	return md5(time().mt_rand(10000,9999999).mt_rand(10000,9999999).mt_rand(10000,9999999));
}

function password($password)
{
    return substr(md5($password.config('config.salt')),0,28);
}

function ajax_cms($res, $message = '',$count = '0')
{
    //默认提示消息
    $messages = [
        1 => '操作失败',
        0 => '操作成功',
    ];
    $status = 0;  //默认状态
    if($res === false) $status = 1;
    if(!empty($message) && is_array($message)) {
        $message = !empty($res) ? current($message) : end($message);
    }
    if(empty($message)) $message = $messages[$status];
    $data['code']       = $status;
    $data['data']       = !empty($res) ? $res : array();
    $data['msg']    = $message;
    $data['count']    = $count;
    exit(json_encode($data));
}

/**
 * [check 数据验证方法]
 * @param  [type] $check [description]
 * @return [type]        [description]
 */
function check($check)
{
    if(empty($check)) return;
    foreach($check as $key=>$v)
    {
        switch($v['action'])
        {
            case 'phone':
                phone_check($v['value']);
                break;
            case 'email':
                email_check($v['value']);
                break;
            case 'string':
                string_check($v['value']);
                break;
            case 'number':
                number_check($v['value']);
                break;
            case 'cardid':
                card_check($v['value']);
                break;
            case 'carnum':
                car_number_check($v['value']);
                break;
            case 'ch':
                ch_check($v['value']);
                break;
        }
    }
}
/**
 * [手机号码验证]
 * @param $val
 * @return bool
 */
function phone_check($val)
{
    if(preg_match('^1(3|4|5|6|7|8|9)\d{9}$', $val)) return true;
    ajax_cms(false, '手机号验证失败');
}
/**
 * [邮箱验证]
 * @param $val
 * @return bool
 */
function email_check($val)
{
    $res = filter_var($val,FILTER_VALIDATE_EMAIL);
    if($res) return true;
    ajax_cms(false, '邮箱验证失败');
}
/**
 * [字符串码验证]
 * @param $val
 * @return bool
 */
function string_check($val)
{
    $val = trim($val);
    if($val == '' || empty($val) || is_null($val)) ajax_cms(false, '数据不完整,验证失败');
    return true;
}
/**
 * [数字验证]
 * @param $val
 * @return bool
 */
function number_check($val)
{
    if(is_numeric($val)) return true;
    ajax_cms(false, '数字验证失败');
}
/**
 * [车牌号验证]
 * @param  [type] $val [description]
 * @return [type]      [description]
 */
function car_number_check($val)
{
    if ($val==null || empty($val) || !preg_match('^[\x80-\xff][A-Z][A-Z_0-9]{5}$^', $val)) ajax_cms(false, $val.'车牌号验证失败');
    return true;
}
/**
 * [是否包含中文]
 * @param  [type] $val [description]
 * @return [type]      [description]
 */
function ch_check($val)
{
    if(preg_match("/[\x7f-\xff]/", $val)) ajax_cms(false,'内容包含中文');
    return true;
}

function get_cat_tree($arr,$pid='0',$step=0){
    static $tree;
    foreach($arr as $key=>$val) {
        if($val['parent'] == $pid) {
            $flg = str_repeat('└―',$step);
            $val['menu_name'] = $flg.$val['menu_name'];
            $tree[] = $val;
            unset($arr[$key]);
            get_cat_tree($arr , $val['id'] ,$step+1);
        }
    }
    return $tree;
}
function GetIP(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif(!empty($_SERVER["REMOTE_ADDR"])){
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else{
        $cip = "无法获取！";
    }
    return $cip;
}
