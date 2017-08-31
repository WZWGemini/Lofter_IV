<?php
namespace app\web\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\web\model\Article as BlogModel;

class Blog extends Controller{

    private static $_data ;

    function __construct(){
        parent::__construct();
        self::$_data = $_POST;//接收请求
        self::$_data['article_time']=time();
    }
    
    //插入操作
    public function insertBlog(){
        //判断登录
        if(empty(session('user_info'))){
            return ['status'=>0,"msg"=>"发布失败,请先登录"];
        }
          $data =[
            'user_id'=> session("user_info")["user_id"],
            'article_title'=> empty(self::$_data['article_title'])?"":self::$_data['article_title'],
            'article_music'=> empty(self::$_data['article_music'])?"":self::$_data['article_music'],            
            'article_img' => self::$_data['article_img'],
            'article_content' => self::$_data['article_content'],
            'article_time' => time()
        ];
        $tag_arr = empty(self::$_data['tag_arr'])?null:explode(",",self::$_data['tag_arr']);
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
            return ['status'=>0,"msg"=>"发布失败"];
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
        $this->assign('blog_list' ,[$blog]) ;//注册变量 blog  
        $html = $this->fetch();//发布文章的html模版
        return ['status'=>1,"msg"=>"发布成功","html"=>$html,"data"=>[$blog]];
    }
    
    //删除
    public function deleteBlog(){
       // 启动事务
        Db::startTrans();
        try{
            Db::table('lofter_tag_article')->where("article_id=".self::$_data['article_id'])->delete();
            Db::table('lofter_comment')->where("article_id=".self::$_data['article_id'])->delete();
            Db::table('lofter_article')->where("article_id=".self::$_data['article_id'])->delete();
            // 提交事务
            Db::commit();    
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['status'=>0,"msg"=>"删除失败"];
        }
        $user_article_num = session('user_info')['user_article_num'];
        session('user_info')['user_article_num'] = $user_article_num-1;
        return ['status'=>1,"msg"=>"删除成功"];
    }
    
    //更新编辑内容
    public function updateBlog(){
        //判断登录
        if(empty(session('user_info'))){
            return ['status'=>0,"msg"=>"更新失败,请先登录"];
        }
        $data =[
            'article_title'=> self::$_data['article_title'],
            'article_img' => self::$_data['article_img'],
            'article_content' => self::$_data['article_content']
        ];
        $tag_arr = empty(self::$_data['tag_arr'])?null:explode(",",self::$_data['tag_arr']);
        $tag_insert=[];
        $article_id = self::$_data["article_id"];
        // 启动事务
        Db::startTrans();
        try{
            //更新博客
            $db_article = Db::name('article');
            $db_article->where("article_id=$article_id")->update($data);
            $db_tagArticle = Db::name('tagArticle');
            //删除原有标签
            $db_tagArticle->where("article_id=$article_id")->delete();
            //保存标签            
            if($tag_arr != null){
                foreach ($tag_arr as $key => $value) {
                    $tag_insert[$key] = ['article_id'=>$article_id, 'tag_id'=>$value];
                }
                $db_tagArticle->insertAll($tag_insert);
            }   
            // 提交事务
            Db::commit();    
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['status'=>0,"msg"=>"更新失败"];
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
        return ['status'=>1,"msg"=>"更新成功","html"=>"","data"=>[$blog]];
    }

    // 瀑布流文章列表
    public function selectBlog(Request $request){
        $page = $request->post("page");
        
        $start = $page*12 ;
        $end = ($page-1)*12;
        $myId = empty(session("user_info")['user_id'])?0:session("user_info")['user_id'];
         //自己关注的列表
        $concern_list = model("concern")->field("concern_user_id as cid")
                        ->where("user_id=$myId")->select();
        $blog_list =  model('user')->alias('u')
                     ->join("article a","a.user_id = u.user_id")
                     ->field('u.user_name, u.user_head, u.user_id, a.article_id, a.article_img, a.article_content')
                     ->limit($start, $end)
                     ->select();
        
        foreach($blog_list as &$blog){
            // 计算是点赞次数
            $blog["num"]    = model("hot")
                                ->where("article_id", $blog["article_id"])
                                ->count();
            $isLove         = model("hot")->where([
                                    "user_id" => $request->session("user_info")["user_id"],
                                    "article_id" => $blog["article_id"],
                                    "hot_love" => 1
                              ])->find();
            $blog["isLove"] = !empty($isLove)?true:false;
            if(inArray($blog["user_id"],$concern_list,'cid')){
                $blog["isFollow"] = true;
            }else{
                $blog["isFollow"] =false;
            }
        }
        if(!empty($blog_list)){
            // $this->assign("concern_list",$concern_list);
            // $this->assign('blog_list',$blog_list);
            // $html=$this->fetch('element/ele-browseQS');

            return ['status'=>1,"msg"=>"获取成功","html"=>"","data"=>$blog_list];
        }else{
            return ['status'=>0,"msg"=>"获取失败","html"=>"","data"=>""];
        }
        
    }

    //个人博客
    public function personalBlog(){
        $user_id=self::$_data['user_id'];
        $userModel = model("user")->alias("u");
        $result = $userModel->join("article a","a.user_id = u.user_id")->where("u.user_id = $user_id")->select();

        //返回插入标签
        $tag = array();
        // 对所有$result 加入标签
        foreach($result as $val){
            $val['tag'] = model("tagArticle")->alias("ta")
                        ->join("tag t","ta.tag_id = t.tag_id")
                        ->where("ta.article_id=".$val['article_id'])
                        ->select();
        }
        if( empty( $result) ){
            return ['status'=>0,"msg"=>"失败"];
        }else{
            $this->assign('blog_list' ,$result) ;//注册变量 blog
            $html = $this->fetch('insertBlog');//发布文章的html模版
            return ['status'=>1,"msg"=>"成功",'html'=>$html,"data"=>$result];
        }  
    }

    public function getBlogInfo(){
        //爬取用户列表的文件路径
        $file = $_SERVER['DOCUMENT_ROOT']."/Lofter_by_TP5/application/bin/article.json";
        //获取文件数据
        $blog_json = file_get_contents($file);
        //
        $blog_arr = json_decode($blog_json);
        dump($blog_arr);
    }
    // 跳转文章详情页
    public function BlogDetail($a_id = null){
        $myId = empty(session("user_info")['user_id'])?0:session("user_info")['user_id'];
        if($a_id){

            $article_info = model("article")->alias("a")
                          ->join("user u","u.user_id = a.user_id")
                          ->field('a.*,u.user_name,u.user_head')
                          ->where("a.article_id" ,$a_id)
                          ->find();
            $article_info["tag"] =model("tagArticle")->alias('ta')
                                ->join('tag t','ta.tag_id = t.tag_id')
                                ->field("t.tag_content")
                                ->where("ta.article_id", $article_info['article_id'])
                                ->select();
            $result         = model("hot")->alias("h")
                                ->join("user u","u.user_id = h.user_id")
                                ->field("h.hot_id, h.user_id, h.hot_love, h.hot_recommend, u.user_head, u.user_name")
                                ->where("article_id",$a_id)
                                ->select();
            $concern_list = model("concern")->field("concern_user_id as cid")
                                ->where("user_id=$myId")->select();
            $this->assign("concern_list",$concern_list);
            $this->assign('hot' , $result);
            $this->assign("article_info",$article_info);
            return $this->fetch();
        }else{
            echo "没有正确的参数";
            exit();
        }
    }

    // 搜索
    public function getSearchInfo (Request $request) {
        $search_key = $request->post("key");
        $tag['tag_content'] = array('like', '%'.$search_key.'%');
        $user['user_name'] = array('like', '%'.$search_key.'%');
        $search_data['tag'] = model('tag')->where($tag)->select();
        $search_data['user'] = model('user')->where($user)->field("user_id, user_name, user_head")->select();
        if (!empty($search_data)) {
            $this->assign('search_data',$search_data);
            $html = $this->fetch('element/ele-peoAndTags');
            return ['status'=>1,"msg"=>"获取成功","html"=>$html,"data"=>$search_data];
        }else{
            return ['status'=>0,"msg"=>"获取失败","html"=>"","data"=>""];
        }
    }
    
    
}

?>