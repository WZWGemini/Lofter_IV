<?php

namespace app\api\Validate;
use think\Validate;

class User extends Validate{

    protected $rule = [
        'user_name'=> "require|unique:user",
        'user_pwd'=> "require|confirm:user_repwd"
    ];

    protected $message = [
        'user_name.require'=>"用户名不能为空",
        'user_name.unique'=>"用户名已存在",
        'user_pwd.require'=>"密码不能为空",
        'user_pwd.confirm'=>"密码和确认密码不一致"
    ];

}

?>