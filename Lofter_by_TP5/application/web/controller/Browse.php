<?php
namespace app\web\controller;
use think\Controller;

class Browse extends Controller
{

    //达人选项卡
    public function browseMaster(){
        //查询发布文章数量前几的用户id
        $user_master = model('user')->alias("u")
                 ->join("article a","a.user_id = u.user_id")
                 ->group("u.user_id")
                 ->field("u.user_id, u.user_name, u.user_head")
                 ->order("count(u.user_id) desc")
                 ->limit(3)
                 ->select();
        foreach($user_master as $key){
            //查询发布文章图片
            $article_img = model('tag')->alias("t")
                        ->join("tagArticle ta","t.tag_id = ta.tag_id")
                        ->join("article a","a.article_id = ta.article_id")
                        ->join("user u","u.user_id = a.user_id")
                        ->where("u.user_id=".$key['user_id'])
                        ->where("a.article_img != '[]'")
                        ->order("a.article_id desc")
                        ->field("a.article_img")
                        ->limit(4)
                        ->select();
            //查询标签
            $tag = model('tag')->alias("t")
                        ->join("tagArticle ta","t.tag_id = ta.tag_id")
                        ->join("article a","a.article_id = ta.article_id")
                        ->join("user u","u.user_id = a.user_id")
                        ->where("u.user_id=".$key['user_id'])
                        ->order("count(t.tag_content) desc")
                        ->group("t.tag_id")
                        ->field("t.tag_id, t.tag_content, count(t.tag_content)")
                        ->limit(8)
                        ->select();
            $key['article_img']=$article_img;                        
            $key['tag']=$tag;
        }
        return json_decode(json_encode($user_master),true);
        $this->assign('user_master',$user_master);
        $html = $this->fetch();
        return ['status'=>1, 'html'=>$html];
    }

    //标签选项卡
    public function browseTags(){
        //查询标签名
        $tag_pic = model('tag')->alias("t")
                 ->join("tagArticle ta","t.tag_id = ta.tag_id")
                 ->join("article a","a.article_id = ta.article_id")
                 ->where("a.article_img != '[]'")
                 ->group("t.tag_content")
                 ->field("t.tag_content,count(t.tag_content)")
                 ->limit(20)
                 ->select();
        //传入第一张图片
        foreach($tag_pic as $key){
            $article_img = model('tag')->alias("t")
                        ->join("tagArticle ta","t.tag_id = ta.tag_id")
                        ->join("article a","a.article_id = ta.article_id")
                        ->where("t.tag_content='".$key['tag_content']."'")
                        ->where("a.article_img != '[]'")
                        ->order("a.article_id desc")
                        ->field("a.article_img")
                        ->limit(1)
                        ->find();
            $key['article_img']=$article_img['article_img'];
        }
        // return json_decode(json_encode($tag_pic),true);
        $this->assign('tag_pic',$tag_pic);
        $html = $this->fetch();
        return ['status'=>1, 'html'=>$html];
    }

}




?>