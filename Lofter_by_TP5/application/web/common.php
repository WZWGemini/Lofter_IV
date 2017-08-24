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