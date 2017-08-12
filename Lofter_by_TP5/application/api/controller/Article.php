<?php
namespace app\api\controller;
use think\Controller;
class Article extends Controller
{
//    index  get  user
    public function index()
    {
        
        $user_article = model("article")->alias("a")
                    ->where(input())
                    ->paginate(2);
        $tag = model("tag");
        foreach ($user_article as $key => $value) {
            $atricleTag = $tag->alias('t')->join('tagArticle ta','ta.tag_id=t.tag_id')
                              ->where("ta.article_id=".$value['article_id'])
                              ->field('t.tag_content')
                              ->select();
            $value['atricleTag']=$atricleTag;
        }
        return json(['status' => 1, 'msg' => '请求成功！','$user_article'=>$user_article]);
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