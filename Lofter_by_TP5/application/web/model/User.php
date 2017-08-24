<?php
namespace app\web\model;
use think\Model;

class User extends Model
{
    protected $createTime = 'create_time';
    protected $updateTime = 'create_time';
    protected $autoWriteTimeStamp = true ;
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