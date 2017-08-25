<?php
namespace app\api\controller;

use think\Controller;

class Onearticle extends Controller
{
//    index  get  user
    public function index()
    {
        $rtn = model('concern')->where(input())->find();
        if (!empty($rtn)) {
            $rtn = true;
        }
        return json(['status' => 1, 'msg' => 'index', 'rtn'=>$rtn]);
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
        $rtn = model('concern')->where(input())->find();
        if (empty($rtn)) {
            $rtn = model('concern')->save(input());
        }
        return json(['status' => 1, 'msg' => 'save','rtn' => $rtn]);
    }

//    update put user/:id
    public function update($id)
    {
        return json(['status' => 1, 'msg' => 'update']);
    }

//    delete delete user/:id
    public function delete($id)
    {
        $data = input();
        unset($data['id']);
        $rtn = model('concern')->where($data)->delete();
        return json(['status' => 1, 'msg' => 'delete','rtn'=>$rtn]);
    }
}