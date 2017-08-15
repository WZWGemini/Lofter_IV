<?php
namespace app\api\model;

use think\Model;

class User extends Model
{
    // protected $updateTime = false;
    // //用来定义只在添加操作自动完成的字段
    // protected $insert = ['create_time','user_pwd'];

    // //md5加密
    // public function setUsePwdAttr(){
    //     return md5(input('user_pwd'));
    // }
    protected $updateTime = "";
}