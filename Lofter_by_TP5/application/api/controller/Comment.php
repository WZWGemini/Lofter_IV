<?php
namespace app\api\controller;

use think\Controller;

class Comment extends Controller
{
//    index  get  user
    public function index()
    {
        $rtn = model('comment')->alias('c')
        ->where(input())
        ->order('comment_id desc')
        ->join('user u','u.user_id = c.user_id')
        ->field('c.*,u.user_name')
        ->select();
        return json(['status' => 1, 'msg' => 'success', 'rtn'=> $rtn]);
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
        $rtn = model('comment')->save(input());
        if ($rtn == 1) {
            return json(['status' => 1, 'msg' => '评论成功！','rtn'=>$rtn]);
        } else {
            return json(['status' => 0, 'msg' => '评论失败！']);   
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