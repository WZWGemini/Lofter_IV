<?php
// discover页面下 其他标签 请求 api
namespace app\api\controller;

use think\Controller;

class Distag extends Controller
{
//    index  get  user
    public function index()
    {
        $inputData = input();
        unset($inputData['page']);
        $tag = model('tag')->alias('t');
        $user_article = $tag->where($inputData)
                ->join('tagArticle ta','t.tag_id = ta.tag_id')
                ->join('article a', 'a.article_id = ta.article_id')
                ->join('user u','u.user_id=a.user_id')
                ->field('a.*,u.user_name,u.user_head')
                ->order('a.article_id desc')
                ->paginate(2);
        $comment = model("comment");
        foreach ($user_article as $key => $value) {
            $articleTag = $tag->alias('t')->join('tagArticle ta','ta.tag_id=t.tag_id')
                                ->where("ta.article_id=".$value['article_id'])
                                ->field('t.tag_content,t.tag_id')
                                ->select();
            $value['articleTag']=$articleTag;
            $value['article_time']=date('Y-m-d H:i:s',$value['article_time']); 
            $articleComment = $comment->alias('c')
                                ->join('user u','u.user_id=c.user_id')
                                ->where("c.article_id=".$value['article_id'])
                                ->order('c.comment_id desc')
                                ->field('c.*,u.user_name')
                                ->select();            
            $value['articleComment']=$articleComment;                    
        }
        return json(['status' => 1, 'msg' => 'index', '$user_article' => $user_article]);
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