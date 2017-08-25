<?php
namespace app\api\controller;

use think\Controller;

class Personalhome extends Controller
{
//    index  get  user
    public function index()
    {
        return json(['status' => 1, 'msg' => 'index']);
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