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
        // 将需要的名字 id 头像 存入数组返回
        $rtnInfo = array('user_name'=>$user_info['user_name'],'user_id'=>$user_info['user_id'],'user_head'=>$user_info['user_head']);
        return json(['status' => 1, 'msg' => '登录成功','info'=>$rtnInfo]);
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
        if(validate('user')->check(input())){

			model('user')->user_pwd = '';
            
			$user_info = model('user')->save(array('user_name'=>input('user_name'),'user_pwd'=>input('user_pwd')));
            // 将需要的名字 id 头像 存入数组返回
            $rtnInfo = array('user_name'=>$user_info['user_name'],'user_id'=>$user_info['user_id'],'user_head'=>$user_info['user_head']);
			return json(['status'=>1,'msg'=>'注册成功','info'=>$rtnInfo]);
		}else{
			return json(['status'=>0,'msg'=>validate('user')->getError()]);
		}
        
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