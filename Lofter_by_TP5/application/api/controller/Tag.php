<?php
namespace app\api\controller;

class Tag
{
    //保存标签
    public function save(){
        $tagModel = model('tag');
        // 查询是否有重复标签
        $tag_content = input('tag_content');
        $query_info = $tagModel->where("tag_content='$tag_content'")->find();
        if ($query_info) {
            $data = ['tag_id'=> $query_info['tag_id']];
            return json(['status'=>1,"msg"=>"标签已存在","html"=>'',"data"=>$data]);
        }else{ 
            $tagModel->save(['tag_content'=>input('tag_content')]);
            $data = ['tag_id'=> $tagModel->getLastInsID()];
            return json(['status'=>1,"msg"=>"插入成功","html"=>'',"data"=>$data]);
        }
    }
}