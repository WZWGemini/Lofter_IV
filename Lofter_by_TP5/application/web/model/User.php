<?php
namespace app\web\model;
use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp = true ;//设置自动插入时间戳
    protected $updateTime = false;
    //用来定义只在添加操作自动完成的字段
    protected $insert = ['user_pwd'];

    //md5加密
    public function setUsePwdAttr(){
        return md5(input('user_pwd'));
    }

    public function blogs(){
        return $this->hasMany("Article");
    }

}



?>