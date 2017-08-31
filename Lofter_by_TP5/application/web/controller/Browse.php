<?php
namespace app\web\controller;
use think\Controller;

class Browse extends Controller
{

    //趋势选项卡
    public function browseQushi(){
        return $this->fetch();
    }
    // 话题选项卡
    public function browseHuati(){
        return $this->fetch();        
    }
    //达人选项卡
    public function browseMaster(){
        //查询发布文章数量前几的用户id
        $user_master = model('user')->alias("u")
                 ->join("article a","a.user_id = u.user_id")
                 ->group("u.user_id")
                 ->field("u.user_id, u.user_name, u.user_head")
                 ->order("count(u.user_id) desc")
                 ->limit(5)
                 ->select();
                 
        $tagModel = model('tag');
        $tag_list = $tagModel->field("tag_id,tag_content,tag_photo")->select();
        foreach($user_master as $key){
            //查询发布文章图片            
            $article_img = model("article")->alias("a")
                        ->join("user u","u.user_id = a.user_id")
                        ->where("u.user_id=".$key['user_id'])
                        ->where("a.article_img != '[]'")
                        ->order("a.article_id desc")
                        ->field("a.article_img")
                        ->limit(6)
                        ->select();
            //查询标签
            $tag = $tagModel->alias("t")
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
        // return json_decode(json_encode($user_master),true);
        $user_id = session("user_info")["user_id"];
        $user_follow_num = $this->getFollow($user_id)["user_follow_num"];
        $this->assign("user_follow_num", $user_follow_num);

        $this->assign('user_master',$user_master);
        $this->assign('tag_list',$tag_list);
        // $html = $this->fetch();
        // return ['status'=>1, 'html'=>$html];
        return $this->fetch();
    }

    //标签选项卡
    public function browseTags(){

        $tag = model("tag")
               ->field("tag_id, tag_content, tag_photo")
               ->limit(15)
               ->select();
        //查询标签名
        $tag_pic = model('tag')->alias("t")
                 ->join("tagArticle ta","t.tag_id = ta.tag_id")
                 ->join("article a","a.article_id = ta.article_id")
                //  ->where("a.article_img != '[]'")
                 ->group("t.tag_id")
                 ->field("t.tag_id, t.tag_content, count(t.tag_content), tag_photo")
                 ->limit(15)
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
                        // ->limit(1)
                        ->find();
            $key['article_img']=$article_img['article_img'];
        }
        // return json_decode(json_encode($tag_pic),true);

        $this->assign('tag',$tag);
        // $html = $this->fetch();
        // return ['status'=>1, 'html'=>$html];
        return $this->fetch();
    }
    // 专题选项卡
    public function browseZhuanti(){
        return $this->fetch();        
    }
    // 达人选项卡的关注
    public function browseFollow()
    {   
        // 考虑用户登录没有
        $user_info = !empty( session("user_info") )?session("user_info"):array();
        $user_concern_list = model("concern")->alias('c')
                             ->join("user u", "u.user_id = c.concern_user_id")
                             ->field("u.user_name, u.user_head, u.user_id")
                             ->where("c.user_id", $user_info->user_id)
                             ->limit(20)
                             ->select();
        foreach($user_concern_list as &$user){
            $time =  model("article")
                                ->field("article_time")
                                ->order("article_time DESC")
                                ->find()
                                ->article_time;
            $time = strtotime($time)!==false?strtotime($time):$time;
            $time = timeago($time);
            $user["new_time"] = $time ;
        }
        //可改进，使用limint（最高，数量）
        $user_orther_list = model("user")
                            ->field("user_name, user_head,user_id")
                            ->order('rand()')
                            ->limit(6)
                            ->select();
        $this->assign("user_list", $user_concern_list);
        $this->assign("concern_other", $user_orther_list);
        return $this->fetch('');
    
    }
    // 获取关注
    public function getFollow ($user_id = null) {
        $user_follow_num = 0;
        if (  $user_id != null ){
            $user_follow_num = model("concern")->where("user_id", $user_id)->count();
        }
        return [ "user_follow_num" => $user_follow_num ];
    }
}




?>