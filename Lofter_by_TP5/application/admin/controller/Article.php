<?php
/**
 * Created by PhpStorm.
 * art: Administrator
 * Date: 2017/8/11
 * Time: 14:56
 */

namespace app\admin\controller;


use think\Controller;
use think\Request;
use app\admin\model\Article as artModel;

class Article extends Controller
{
    public function index(){//渲染用户列表或者查询
    //   获取列名
       $art = new artModel;
       $column = $art->getTableFields();//获取所有表字段
       $result = $art
                    //   ->order('art_id ASCE')
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
        $this->assign("table", 'art');       
        return $this->fetch('/layout');
        // dump($data);
    }


    // select get art/select/:id
    public function select(Request $request){
       dump( $request->param() );
    }


//    create get art/create/:id
    public function create(Request $request){//添加用户
       dump($request->post());
    }


//    update post art/edit/:id
    public function edit(Request $request){//更新用户信息
        $art_id = $request->only(["artcle_id"]) ;
        $edit_info = $request->except(["artcle_id","delete_time"]);

        $post = $request->post();
        $art = artModel::get($art_id);
        $res = $art->save($post);
        if($res){
            return [
                "status" => 1,
                "msg"    => "更新成功",
                "data"   => $art->getdata()
            ];
        }else{
            return [
                "status" => 0,
                "msg"    => "失败",
                "data"   => []
             ];
        }
    }


//    delete  get art/delete/:id
    public function delete(Request $request){//删除用户已列表
        $id = $request->get()["article_id"];
        $res = artModel::destroy($id);//destroy无论数据是否已经删除，也能进行删除，更新delete_time的值
        // $res = $art->destroy();
        if($res){
            $data = artModel::onlyTrashed(true)->select($id)[0];
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