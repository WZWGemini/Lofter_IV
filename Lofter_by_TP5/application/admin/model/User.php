<?php
namespace app\admin\model;

use think\Model;
// use traits\model\SoftDelete;

class User extends Model{
    // use SoftDelete;//引用软删除
    protected $createTime = 'create_time';
    protected $updateTime = 'create_time';
    protected $autoWriteTimestamp = true ;//设置自动插入时间戳
    
    // public function setUserPwdAttr($val){
    //     return md5($val);
    // }
}