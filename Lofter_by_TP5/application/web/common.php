<?php


function object2array(&$object) {
    $object =  json_decode( json_encode( $object),true);
    return  $object;
}


/**
*     判断值$req 是否在二维数组$list 的$arg 字段中
*/
function inArray($req,$list,$arg){
    if(empty($list)) return false;
    foreach($list as $key=>$value){
        if($req == $value["$arg"]){
            return true;
        }
    }
    return false;
}

//判断登录
function isLogin(){
    if(empty(session("user_info")["user_id"])){
        //将该页面设置成无权限访问
        header('HTTP/1.1 401 Unauthorized');
        header("Location:".url('index/login'));
        // header("Refresh: 0; url=".url('index/login'));
        exit();
    }
}

function timeago( $ptime ) {
	$etime = time() - $ptime;
	if ($etime < 59) return '刚刚'; 
	$interval = array ( 
		12 * 30 * 24 * 60 * 60 => '年前 ('.date('Y-m-d', $ptime).')',
		30 * 24 * 60 * 60 => '个月前 ('.date('Y-m-d', $ptime).')',
		7 * 24 * 60 * 60 => '周前 ('.date('m-d', $ptime).')',
		24 * 60 * 60 => '天前',
		60 * 60 => '小时前',
		60 => '分钟前',
		1 => '秒前'
	);
	foreach ($interval as $secs => $str) {
		$d = $etime / $secs;
		if ($d >= 1) {
			$r = round($d);
			return $r . $str;
		}
	}
}