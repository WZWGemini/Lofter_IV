<?php
namespace app\web\controller;
use think\Controller;
use think\Request;
class Hot extends Controller
{
    private static $_data ;
    
    //tp5 构造函数，自动运行父类构造函数
    function _initialize(){
        self::$_data = $_POST;//接收请求
    }

    //获取所有热度
    public function showHot(Request $request){
        $article_id = $request->request()['article_id'];
        //获取评论Id，文章Id，用户名，用户Id，评论内容，评论时间，用户头像
        $result = model("hot")->alias("h")
                ->join("user u","u.user_id = h.user_id")
                ->field("h.hot_id, h.user_id, h.hot_love, h.hot_recommend, u.user_head, u.user_name")
                ->where("article_id",$article_id)
                ->select();
        if( !empty( $result ) ){
            $this->assign('hot' , $result);
            $html = $this->fetch('index');
            return ['status'=>1,"msg"=>"成功","html"=>$html,"data"=>$result];
        }else{
            return ['status'=>0,"msg"=>"无内容","html"=>"","data"=>$result];
        }
    }

    //点赞
    public function Love(Request $request){
        $article_id = $request->request()['article_id'];
        $user_id = $request->session("user_info")["user_id"];
        $islove = $this->search($user_id, $article_id, "hot_love");
        // $user_info = $request->session("user_info");
        if( !empty($islove)){
            $hot_id = $islove->hot_id;
                $islove ->delete();
                // $user_info["user_love_num"] -= 1;
                // session("user_info",$user_info);
                return ['status'=>0,"msg"=>"取消顶赞","data" => ["hot_id" => $hot_id] ];
        }else{
            $hot = model("hot");
            $hot->article_id = $article_id;
            $hot->user_id = $user_id;
            $hot->hot_love = 1;
            if($hot->save()){
                $data = $hot->getdata();
                $data["user_head"] = $request->session("user_info")["user_head"];
                $data["user_name"] = $request->session("user_info")["user_name"];
                
                //修改session中的user_love_num的值
                // $user_info["user_love_num"] += 1;
                // session("user_info",$user_info);
                return ['status'=>1,"msg"=>"顶赞","data"=> $data];
            }      
        }
    }
    // 推荐
    public function Recommend(Request $request){
        $article_id = $request->request()['article_id'];
        $user_id = $request->session("user_info")["user_id"];
        $isRecommend = $this->search($user_id, $article_id, "hot_recommend");
        $user_info = $request->session("user_info");
        if( !empty($isRecommend )){
                $hot_id = $isRecommend->hot_id;
                $isRecommend->delete();
                $user_info["user_recommend_num"] -= 1;
                session("user_info",$user_info);
                return ['status'=>0,"msg"=>"取消推荐","data" => ["hot_id" => $hot_id] ];
        }else{
            $hot = model("hot");
            $hot->article_id = $article_id;
            $hot->user_id = $user_id;
            $hot->hot_recommend = 1;
            if($hot->save()){
                $data = $hot->getdata();
                $data["user_head"] = $request->session("user_info")["user_head"];
                $data["user_name"] = $request->session("user_info")["user_name"];
                //修改session中的user_recommend_num的值
                $user_info["user_recommend_num"] += 1;
                session("user_info",$user_info);
                return ['status'=>1,"msg"=>"推荐","data"=> $data];
            }      
        }
    }
    //查看是否已经存在了
    public function search($user_id ,$article_id, $type){
        $result = model("hot")->where([
            "user_id"    => $user_id,
            "article_id" => $article_id,
            $type        => 1
        ])->find();
        if( empty($result) ){
            return array();
        }else{
           return $result;
        }
    }

    public function recommendShow($uid = null){
        $user_info = empty(session('user_info'))? self::$_user_info : session('user_info');
        if(!$uid){
            exit;
        }
        $re_list = model("hot")->alias('h')
                 ->join('article a',"h.article_id=a.article_id")
                //  ->join('user u',"u.user_id=h.user_id")
                 ->where("h.user_id",$uid)
                 ->where("hot_recommend",1)
                 ->select();
        $re_list = $this->getBlogDetial($re_list,$user_info);
        // dump($re_list);
        $this->assign('user_info' ,$user_info );  //用户信息
        $this->assign('blog_list',$re_list);
        return $this->fetch();
    }

    //获取文章详细内容
    public function getBlogDetial($select_art, $user_info){
        foreach ($select_art as $key => $value) {
            //文章id
            $article_id = $select_art[$key]["article_id"];
            //查询评论数
            $commnet_count = model("comment")->field("count(comment_id) AS num")
                            ->where("article_id = $article_id")
                            ->find();
             //查询热度数量
            $hot_count = model("hot")->field("count(hot_id) AS num")
                            ->where("article_id = $article_id")
                            ->find();  
            // 添加数据                             
            $select_art[$key]["comment_num"] =  $commnet_count['num'] ;
            $select_art[$key]["hot_num"]     =  $hot_count['num'] ;
            // 查询tag标签
            $select_art[$key]["tag"] = model("tagArticle")->join("lofter_tag","lofter_tag_article.tag_id = lofter_tag.tag_id","inner")
                        ->where("article_id = $article_id")->select();
            //查询发表的用户
            $user_id = $select_art[$key]["user_id"];
            $select_art[$key]["user_info"] = model("user")->field("user_name , user_id , user_head")
                                            ->where("user_id = $user_id")->find();

            //判断登录的用户是否已经推荐？点赞？
            $hot_recommend = model("hot")->field("hot_love, hot_recommend")
                            ->where([
                                "user_id"    => $user_info["user_id"],
                                "article_id" => $article_id,
                                "hot_recommend" => 1
                                ])
                            ->find();
            $isRecommend = !empty($hot_recommend)?true:false;
            $hot_love = model("hot")->field("hot_love, hot_recommend")
                        ->where([
                            "user_id"    => $user_info["user_id"],
                            "article_id" => $article_id,
                            "hot_love" => 1
                        ])
                        ->find();
            $isLove = !empty($hot_love)?true:false;
            $select_art[$key]["isRecommend"] = $isRecommend;
            $select_art[$key]["isLove"] = $isLove;            
        }
        return $select_art;
    }

}

