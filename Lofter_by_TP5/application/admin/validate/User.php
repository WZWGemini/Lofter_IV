<?php
namespace app\admin\validate;
use think\Validate;

class User extends Validate{
    protected $rule = [
        "user_name" => "require|unique:user" ,
        "user_pwd" => "require"
    ];
    protected $message =[
        "user_name.require" => "用户名不能为空",
        "user_name.unique"  => "用户名已存在"
    ];

    protected $scene = [
        'name'   =>  ['user_name'],
        'edit'   =>  ['email'],
    ];
}