<?php
namespace app\api\controller;

use think\Controller;

class Music extends Controller
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
        //判断登录
        if(empty(session('user_info'))){
            return ['status'=>0,"msg"=>"发布失败,请先登录"];
        }
        $data =[
            'user_id'=> session("user_info")["user_id"],
            'article_title'=> empty(input('article_title'))?"":input('article_title'),
            'article_music'=> empty(input('article_music'))?"":input('article_music'),            
            'article_img' =>  empty(input('article_img'))?'[]':input('article_img'),
            'article_content' => input('article_content'),
            'article_time' => time()
        ];
        $tag_arr = empty(input('tag_arr'))?null:explode(",",input('tag_arr'));
        $tag_insert=[];
        $article_id =null;
        // 启动事务
        Db::startTrans();
        try{
            //保存博客
            $db_article = Db::name('article');
            $db_article->insert($data);
            $article_id = $db_article->getLastInsID();
            //保存标签
            $db_tagArticle = Db::name('tagArticle');
            if($tag_arr != null){
                foreach ($tag_arr as $key => $value) {
                    $tag_insert[$key] = ['article_id'=>$article_id, 'tag_id'=>$value];
                }
                $db_tagArticle->insertAll($tag_insert);;
            }   
            // 提交事务
            Db::commit();    
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            return json(['status'=>0,"msg"=>"发布失败"]);
        }
        //查询博客的所有内容
        $blog = $db_article->where("article_id=$article_id")->find();
        //查询该博客的标签
        $tag = $db_tagArticle->alias("ta")
                ->join("tag t","t.tag_id = ta.tag_id")
                ->where("ta.article_id=$article_id")
                ->select();
        $blog["tag"]  = $tag;
        $blog["user_id"] = session("user_info")['user_id'];
        $blog["user_head"] = session("user_info")['user_head'];
        return json(['status'=>1,"msg"=>"发布成功","data"=>[$blog]]);
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