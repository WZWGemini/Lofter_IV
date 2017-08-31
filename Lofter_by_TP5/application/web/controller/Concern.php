<?php
namespace app\web\controller;

use think\Controller;

class Concern extends Controller
{
//   页面显示
    public function index()
    {   

        // 考虑用户登录没有
        $user_info = !empty( session("user_info") )?session("user_info"):array();
        $user_concern_list = model("concern")->alias('c')
                             ->join("user u", "u.user_id = c.concern_user_id")
                             ->field("u.user_name, u.user_head, u.user_id")
                             ->where("c.user_id", $user_info->user_id)
                             ->limit(20)
                             ->select();
        foreach($user_concern_list as &$user){
            $time =  model("article")
                                ->field("article_time")
                                ->order("article_time DESC")
                                ->find()
                                ->article_time;
            $time = strtotime($time)!==false?strtotime($time):$time;
            $time = timeago($time);
            $user["new_time"] = $time ;
        }
        //可改进，使用limint（最高，数量）
        $user_orther_list = model("user")
                            ->field("user_name, user_head,user_id")
                            ->order('rand()')
                            ->limit(6)
                            ->select();
        $this->assign("user_list", $user_concern_list);
        $this->assign("concern_other", $user_orther_list);
        return $this->fetch('browse/guanzhu');
    
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
     //-------------------------------------------------------------------
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
        session('user_info')['user_attention_num'] = session('user_info')['user_attention_num']+1;        
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
    public function delete()
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
        session('user_info')['user_attention_num'] = session('user_info')['user_attention_num']-1;
        return json(['status' => 1, 'msg' => '取消关注成功']);
    }
}