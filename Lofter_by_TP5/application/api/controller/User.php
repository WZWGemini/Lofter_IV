<?php
namespace app\api\controller;

use think\Controller;

class User extends Controller
{
//    index  get  user
    public function index()
    {
        $user_name = input('user_name');
        $user_pwd = input('user_pwd');
        //查询用户信息
        $user_info = model("user")->alias("u")
                    ->where("u.user_name='$user_name' and u.user_pwd='$user_pwd'")
                    ->find();
        if(count($user_info)==0){
            return json(['status'=>0,"msg"=>"登录失败"]);
        }
        return json(['status' => 1, 'msg' => '登录成功','info'=>"$user_info"]);
    }

//    read get user/:id
    public function read($id)
    {
        return json(['status' => 1, 'msg' => 'read']);
    }

//    edit get user/:id/edit
    public function edit($id)
    {
        return json(['status' => 1, 'msg' => 'edit']);
    }

//    create get user/create
    public function create()
    {
        return json(['status' => 1, 'msg' => 'create']);
    }

//    save post user
    public function save()
    {
        return json(['status' => 1, 'msg' => 'save']);
    }

//    update put user/:id
    public function update($id)
    {
        return json(['status' => 1, 'msg' => 'update']);
    }

//    delete delete user/:id
    public function delete($id)
    {
        return json(['status' => 1, 'msg' => 'delete']);
    }
}