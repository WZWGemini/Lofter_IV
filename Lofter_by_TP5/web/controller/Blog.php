<?php
namespace app\web\controller;
use think\Controller;
use think\Db;


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
            'article_title'=> self::$_data['article_title'],
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

    // 查询
    public function selectBlog(){
        $blog_list = model('user')->alias('u')->join("article a","a.user_id = u.user_id")
                        ->field('u.user_name, u.user_head, u.user_id, a.article_id, a.article_img, a.article_content')->limit(15)->select();
        if(!empty($blog_list)){
            $this->assign('blog_list',$blog_list);
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

}

?>