<?php
namespace app\api\controller;

use think\Controller;

class Personal extends Controller
{
//    index  get  user
    public function index()
    {
        $concern = model('concern')->alias('c');
        $data = array('c.user_id'=>input('user_id'));
        $follow = $concern->where($data)
                ->join('user u','c.concern_user_id = u.user_id')
                ->field('u.*')
                ->select();
        $fans = $concern->where(array('concern_user_id'=>input('user_id')))->select();
        $data = array('a.user_id'=>input('user_id'));
        $love = model('article')->alias('a')
                ->where($data)
                ->join('hot h','h.article_id=a.article_id')
                ->field('a.*')
                ->order('a.article_id desc')
                ->select();
        return json(['status' => 1, 'msg' => 'index', 'follow' =>$follow, 'fans' => $fans, 'love' => $love]);
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