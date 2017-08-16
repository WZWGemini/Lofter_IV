<?php
namespace app\api\controller;

use think\Controller;

class Concern extends Controller
{
//    index  get  user
    public function index()
    {

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

    //传要关注的用户的Id   参数:concern_user_id
    public function save()
    {
        $concernModel = model("concern");
        $data = [
            'user_id'=>session('user_info')['user_id'],
            'concern_user_id' => input('concern_user_id')
        ];
        //查询是否已关注
        $ifConcern = $concernModel->where($data)->find();
        if(!empty($ifConcern)){
            return json(['status' => 0, 'msg' => '该用户已关注不需要重复关注']);
        }
        $concernModel->save($data);
        return json(['status' => 1, 'msg' => '关注成功']);
    }

//    update put user/:id
    public function update($id)
    {
        return json(['status' => 1, 'msg' => 'update']);
    }

    /**
    *  取消关注
    *  参数:concern_user_id
    */
    public function delete($id)
    {
        $concernModel = model("concern");
        $data = [
            'user_id'=>session('user_info')['user_id'],
            'concern_user_id' => input('concern_user_id')
        ];
        //查询是否已关注
        $ifConcern = $concernModel->where($data)->find();
        if(empty($ifConcern)){
            return json(['status' => 0, 'msg' => '没有关注该用户不需要取消关注']);
        }
        $concernModel->where($data)->delete();
        return json(['status' => 1, 'msg' => '取消关注成功']);
    }
}