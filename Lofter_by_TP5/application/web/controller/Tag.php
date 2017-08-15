<?php
namespace app\web\controller;
use think\Controller;

class Tag extends Controller
{
    private static $_data ;
        
    function _initialize(){
        //这个$post就是前端请求的数据，传到这里没做任何修改
        self::$_data = $_POST;//接收请求
    }

    public function addTag(){
        $tagModel = model('tag');
        // 查询是否有重复标签
        $tag_content = self::$_data['tag_content'];
        $query_info = $tagModel->where("tag_content='$tag_content'")->find();
        if ($query_info) {
            $data = ['tag_id'=> $query_info['tag_id']];
            return ['status'=>1,"msg"=>"标签已存在","html"=>'',"data"=>$data];
        }else{ 
            $tagModel->save(['tag_content'=>self::$_data['tag_content']]);
            $data = ['tag_id'=> $tagModel->getLastInsID()];
            return ['status'=>1,"msg"=>"插入成功","html"=>'',"data"=>$data];
        }
    }
}




?>