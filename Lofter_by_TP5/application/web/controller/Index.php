<?php
namespace app\web\controller;
use think\Controller;


class Index extends Controller{
    //页面跳转模块
    private static $_user_info =array(
        'user_id'=>0,
        'user_name'=>"未登录",
        'user_head'=>'upload/img/default_head.jpg',
        'user_article_num' => 0,
        'user_message_num' => 0,
        'user_attention_num' => 0
    );
    
    //主页显示
    public function index(){
        ///采集用户信息:判断是否有用户登录？采用默认值
        $user_info = empty(session('user_info'))? self::$_user_info : session('user_info');
        // 查询显示的文章列表
        $select_art = model("article")->alias("a")
                    ->order("a.article_id desc")->page(1,10)->select();
                    

        foreach ($select_art as $key => $value) {
            //文章id
            $article_id = $select_art[$key]["article_id"];
            //查询评论数
            $commnet_count = model("comment")->field("count(comment_id) AS num")
                            ->where("article_id = $article_id")
                            ->find();
            $select_art[$key]["comment_num"] =  $commnet_count['num'] ;
            // 查询tag标签
            $select_art[$key]["tag"] = model("tagArticle")->join("lofter_tag","lofter_tag_article.tag_id = lofter_tag.tag_id","inner")
                        ->where("article_id = $article_id")->select();
            //查询发表的用户
            $user_id = $select_art[$key]["user_id"];
            $select_art[$key]["user_info"] = model("user")->field("user_name , user_id , user_head")
                                            ->where("user_id = $user_id")->find();
        }
        // 采集博文内容
        $blog_list = $select_art;
        //注册samrty变量           
        $this->assign('user_info' ,$user_info );  //用户信息
        if( !empty( $blog_list) ){//渲染页面
            $this->assign('blog_list',$blog_list);  
            }          
        return $this->fetch();

    }

    // 登录页面显示
    public function login(){//ok
        return $this->fetch();
    }

    //注册页面显示
    public function register(){//ok
        return $this->fetch();
    }

    // 浏览页面显示
    public function browse() {
        
        return $this->fetch("order/browse");
    }

    // app页面显示
    public function app() {
        return $this->fetch("order/app");
    }

    // // 摄影课堂页面显示
    // public function potoshop() {
    //     return $this->fetch("order/potoshop");
    // }

    // 个人主页页面显示
    public function userHome() {
        return $this->fetch("order/userHome");
    }

    // 长文章页面显示
    public function lognArticle() {
        return $this->fetch("order/lognArticle");
    }
    //  // 摄影课堂页面显示
    // public function potoshop(){
    //     $file = $_SERVER['DOCUMENT_ROOT']."/Lofter_by_TP5/application/bin/pic.json";
    //     $pic_json = file_get_contents($file);
    //     $pic_arr = json_decode($pic_json,true);
    //     $this->assign('pic_arr',$pic_arr);
    //     return $this->fetch();
    // }
    // // 数据采集
    // public function collectPic() {
    //     $path = $_SERVER['DOCUMENT_ROOT']."/Lofter_by_TP5/application/bin/sheying";
    //     $file = $_SERVER['DOCUMENT_ROOT']."/Lofter_by_TP5/application/bin/pic.json";
    //     exec("node $path http://699pic.com/people.html");
    //     return $pic_json = file_get_contents($file);
    // }
    //  传用户Id uid
    public function userShow(){
        $uid = input("uid");
        $userModel = model("user");
        $concernModel = model("concern");
        $myId = empty(session("user_info")['user_id'])?0:session("user_info")['user_id'];
        //查询用户信息
        $user_info = $userModel->field("user_name,user_head,user_id")->where("user_id=$uid")->find();
        //自己关注的列表
        $concern_list = $concernModel->field("concern_user_id as cid")
                      ->where("user_id=$myId")->select();
        //查询对方关注的数量
        $other_attention_num = $concernModel->field("count(*) as num")
                             ->where("user_id=$uid")->find()['num'];
        //查询用户文章数量
        $user_article_num = $userModel->alias("u")
                            ->field("count(*) as num")
                            ->join("article a","u.user_id=a.user_id")
                            ->where("u.user_id=$uid")
                            ->find()['num'];
        //查询用户三个有图片的微博
        $user_img = $userModel->alias("u")
                    ->field("article_img")
                    ->join("article a","u.user_id=a.user_id")
                    ->where("a.article_img != '[]' and u.user_id=$uid")
                    ->order("a.article_id desc")
                    ->limit(3)
                    ->select();
        $this->assign("user_info",$user_info);
        $this->assign("concern_list",$concern_list);
        $this->assign("user_article_num",$user_article_num);
        $this->assign("other_attention_num",$other_attention_num);        
        $this->assign("user_img",$user_img);
        $html = $this->fetch();
        return ['status'=>1,"msg"=>"成功","html"=>$html,"data"=>""];
    }
     //传标签id tag_id------------------------
     public function tagShow(){
        $tagId = input("tag_id");
        //查询三个有图片的该标签微博
        $tag_img = model("article")->alias("a")
                    ->field("article_img")
                    ->join("tagArticle ta","a.article_id=ta.article_id")
                    ->join("tag t","t.tag_id=ta.tag_id")
                    ->where("a.article_img != '[]' and t.tag_id=$tagId")
                    ->order("a.article_id desc")
                    ->limit(3)
                    ->select();  
        $tag_content = model("tag")->field("tag_content")->where("tag_id=$tagId")->find()['tag_content'];    
        $this->assign("tag_img",$tag_img);
        $this->assign("tag_content",$tag_content);        
        $html = $this->fetch();
        return ['status'=>1,"msg"=>"成功","html"=>$html,"data"=>""];
    }
}

?>