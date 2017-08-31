<?php
namespace app\web\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\web\model\Tag as tagModel;

class Tag extends Controller
{
    private static $_data ;
        
    function _initialize(){
        //这个$post就是前端请求的数据，传到这里没做任何修改
        self::$_data = $_POST;//接收请求
    }

    // 添加标签
    public function addTag(){
        $tagModel = model('tag');
        // 查询是否有重复标签
        $tag_content = self::$_data['tag_content'];
        $query_info = $tagModel->where("tag_content='$tag_content'")->find();
        if ($query_info) {
            $data = ['tag_id'=> $query_info['tag_id_exit']];
            return ['status'=>1,"msg"=>"标签已存在","html"=>'',"data"=>$data];
        }else{ 
            $tagModel->save(['tag_content'=>self::$_data['tag_content']]);
            $data = ['tag_id'=> $tagModel->getLastInsID()];
            return ['status'=>1,"msg"=>"插入成功","html"=>'',"data"=>$data];
        }
    }

    // 
    public function tagIndex(Request $request){
        $user_info = empty(session('user_info'))? self::$_user_info : session('user_info');
        $tag_id = empty($request->get()["tag_id"])?1:$request->get()["tag_id"];
        $tag =tagModel::get($tag_id);
        $type = empty($request->get()["type"])?"tag":$request->get()["type"];
        $arts = Db::name("tag")->alias("t")
                              ->where("t.tag_id",$tag_id)
                              ->join("tag_article ta","t.tag_id = ta.tag_id")
                              ->join("article a","a.article_id=ta.article_id")
                              ->limit(10)
                              ->select();
        ///采集用户信息:判断是否有用户登录？采用默认值
        $user_info = empty(session('user_info'))? self::$_user_info : session('user_info');
        // 采集博文内容
        $arts = $this->getBlogDetial($arts, $user_info);
        
        //可改进，使用limint（最高，数量）
        $user_orther_list = model("user")
                    ->field("user_name, user_head,user_id")
                    ->order('rand()')
                    ->limit(6)
                    ->select();
        $tag_orther_list = model('tag')
                    ->field("tag_id, tag_content,tag_photo")
                    ->order('rand()')
                    ->limit(6)
                    ->select();
        $this->assign("orther_user", $user_orther_list);
        $this->assign("orther_tag", $tag_orther_list);
         //注册samrty变量           
         $this->assign('user_info' ,$user_info);  //用户信息
        $this->assign("tagM" ,$tag);
        $this->assign('blog_list' ,$arts);
        return $this->fetch($type);
    }
    public function archive(){
        return $this->fetch("tabArchive");
    }

    public function getTagInfo(Request $request){
        $key = $request->get("key");//获取关键字
        $path = $_SERVER['DOCUMENT_ROOT']."/Lofter_by_TP5/application/bin/tag";
        //读取tag.json 的数据
        $tag_file = ROOT_PATH."application/bin/tag.json";
        $tag_obj = json_decode(file_get_contents($tag_file));
        $tag_arr =  object2array($tag_obj) ;
        $tag_id_exit = 0;//标签id
        
        foreach($tag_arr as $item){//根据关键字寻找id
           if($key == $item['tag_content']){
              $tag_id_exit = $item['tag_id_exit'];
              break ;
           }
        }
        // exec("node $path ",$key);//执行不了？

        $blog_file = ROOT_PATH."application/bin/blog/b".$tag_id_exit.".json";
        $user_file = ROOT_PATH."application/bin/user/u".$tag_id_exit.".json";
        // 获得数据对象
        $blog_obj = json_decode(file_get_contents($blog_file));
        $user_obj = json_decode(file_get_contents($user_file));
        //获得数据数组
        $blog_arr = object2array($blog_obj);
        $user_arr = object2array($user_obj);
        $tag_article = array();

        // 去除数组的某些字段
        foreach($user_arr as $key => $user_li){
            unset($user_arr[$key]["user_id"]);
        }
        $users =  model('user')->saveAll($user_arr);
        // dump($user);
        foreach($blog_arr as $key => $blog_li){
            $blog_arr[$key]["user_id"] = $users[$key]["user_id"];
        }
        // dump($blog_arr);
        $blogs =  model('article')->saveAll($blog_arr);

        foreach($blogs as $key => $blog){
            $tag_article[$key]["article_id"] = $blogs[$key]["article_id"];
            $tag_article[$key]["tag_id"] = model("tag")->where("tag_id_exit",$tag_id_exit)->find()->getdata()["tag_id"];
        }
        $tag_articles = model("tag_article")->saveAll($tag_article);
        if($tag_articles){
            echo "完成";
        }
    }
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

    // 加载更多
    public function loadMore (Request $request) {
        $user_info = empty(session('user_info'))? self::$_user_info : session('user_info');
        $tag_id = empty($request->get()["tag_id"])?1:$request->get()["tag_id"];
        $tag =tagModel::get($tag_id);
        $type = empty($request->get()["type"])?"tag":$request->get()["type"];
        $page = input('page');
        $arts = Db::name("tag")->alias("t")
                              ->where("t.tag_id",$tag_id)
                              ->join("tag_article ta","t.tag_id = ta.tag_id")
                              ->join("article a","a.article_id=ta.article_id")
                              ->page($page, 10)
                              ->select();
        ///采集用户信息:判断是否有用户登录？采用默认值
        $user_info = empty(session('user_info'))? self::$_user_info : session('user_info');
       
        // 采集博文内容
        $arts = $this->getBlogDetial($arts, $user_info);        
        if( !empty( $arts) ){//渲染页面
            $this->assign('blog_list',$arts);
            $html = $this->fetch('element/ele-list');            
            return ['status'=>1,"msg"=>"成功",'html'=>$html,"data"=>$arts];
        }else{
            return ['status'=>0,"msg"=>"获取失败","html"=>"","data"=>""];
        }
    }
}




?>