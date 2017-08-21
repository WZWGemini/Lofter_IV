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

  // 查询标签
  public function read($id){
    $taModel = model('tagArticle');
    // $article_arr = $taModel->alias('ta')->where('tag_id='.$id)->field('ta.article_id')->select();


    $rtn = $taModel->alias('ta')
        ->where('tag_id='.$id)
        ->order('article_id desc')
        ->join('article a','a.article_id = ta.article_id')
        ->join('user u','u.user_id = a.user_id')
        ->field('ta.article_id,ta.tag_id,a.user_id,a.article_img,u.user_name')
        ->select();
        return json(['status' => 1, 'msg' => 'success', 'rtn'=> $rtn]);
  }
}