<?php
namespace app\web\model;
use think\Model;

class Concern extends Model
{
    protected $updateTime = false;
    protected $insert = ['create_time'];

    protected function getCreateTimeAttr($create_time){
        $etime = time() - $create_time;
        // return 1;
        if ($etime < 59) return '刚刚'; 
        $interval = array ( 
            12 * 30 * 24 * 60 * 60 => '年前 ('.date('Y-m-d', $create_time).')',
            30 * 24 * 60 * 60 => '个月前 ('.date('Y-m-d', $create_time).')',
            7 * 24 * 60 * 60 => '周前 ('.date('m-d', $create_time).')',
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
}



?>