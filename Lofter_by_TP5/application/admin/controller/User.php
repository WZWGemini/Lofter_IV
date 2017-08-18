<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/11
 * Time: 14:56
 */

namespace app\admin\controller;


use think\Controller;
use think\Request;
use app\admin\model\User as userModel;

class User extends Controller
{
//   index  get user/index
    public function index(){//渲染用户列表或者查询
    //   获取列名
       $user = userModel::withTrashed();
       $column = $user->getTableFields();//获取所有表字段
       $result = $user
                    //   ->order('user_id ASCE')
                      ->paginate(8);//获取表数据
      $data = [];// 封装好传到获取的数据
      $page = $result->render();//分页
      foreach($result as $val){
        //   dump($val->getdata());
          $data[] = $val->getdata();
      }
    //   注册模版变量
        $this->assign("data", $data);
        $this->assign("column", $column);
        $this->assign("page", $page); 
        $this->assign("table", 'user');       
        return $this->fetch('/layout');
        // dump($data);
    }


    // select get user/select/:id
    public function select(Request $request){
       dump( $request->param() );
    }


//    create get user/create/:id
    public function create(Request $request){//添加用户
       dump($request->post());
    }


//    update post user/edit/:id
    public function edit(Request $request){//更新用户信息
        $user_id = $request->only(["user_id"]) ;
        $edit_info = $request->except(["user_id","delete_time"]);

        $post = $request->post();
        $user = userModel::get($user_id);
        $res = $user->save($post);
        if($res){
            return [
                "status" => 1,
                "msg"    => "更新成功",
                "data"   => $user->getdata()
            ];
        }else{
            return [
                "status" => 0,
                "msg"    => "失败",
                "data"   => []
             ];
        }
    }


//    delete  get user/delete/:id
    public function delete(Request $request){//删除用户已列表
        $id = $request->get()["user_id"];
        $res = userModel::destroy($id);//destroy无论数据是否已经删除，也能进行删除，更新delete_time的值
        // $res = $user->destroy();
        if($res){
            $data = userModel::onlyTrashed(true)->select($id)[0];
            return [
                "status" => 1,
                "msg" => "删除成功",
                "data" => $data
            ];
        }else{
            return ["status" => 0, "msg" => "删除失败"];
        }
    }
}