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
                    ->order("a.article_id desc")->page(1,3)->select();
                    
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
            // echo ajaxRes(0,'发布失败');
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
}
?>