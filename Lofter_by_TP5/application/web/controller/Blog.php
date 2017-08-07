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
        // 把tag_arr拿出来
        $tag_arr = isset( self::$_data["tag_arr"] )? self::$_data["tag_arr"] : "";
        $tag_arr = explode("," ,$tag_arr);
        // 参数处理
        self::$_data['article_title']=isset($_POST['article_title'])?$_POST['article_title']:"";
        self::$_data['article_img']=isset($_POST['article_img'])?$_POST['article_img']:"";
        self::$_data['article_content']=isset($_POST['article_content'])?$_POST['article_content']:""; 
        //用户没有登录就会报错           
        self::$_data['user_id']=session("user_info")["user_id"];
        unset(self::$_data['content']);
        unset(self::$_data['tag_arr']);
        //返回博文内容
        $articleModel = model("article");
        $blog_save = $articleModel->save(self::$_data);
        if($blog_save){
            $id=$articleModel->getLastInsID();
            $blog = $articleModel->where("article_id=$id")->find();
        }
        //返回插入标签
        $tag = array();
        for( $i =0 ; $i < count($tag_arr) ; $i++ ){
            $tagArticleModel = model("tagArticle");
            $tagArticleModel->save(['article_id'=>$blog['article_id'],'tag_id'=>$tag_arr[$i]]);
            $result_tag = $tagArticleModel->where("tag_article_id =".$tagArticleModel->getLastInsID())->find();
            // 查询tag内容
            $tag_data = model("tag")->where("tag_id = ".$result_tag['tag_id'])->find();
            // 往数组里面插入数据
            $tag[$i] = $tag_data ;
        }
        $blog["user_info"] = empty(session("user_info"))?"":session("user_info");
        $blog["tag"]  = $tag;
        if( empty( $blog) ){
            return ['status'=>0,"msg"=>"发布失败"];
        }else{
            $this->assign('blog_list' ,[$blog]) ;//注册变量 blog  
            $html = $this->fetch();//发布文章的html模版
            return ['status'=>1,"msg"=>"发布成功","html"=>$html,"data"=>[$blog]];
        }  
    }

    //删除
    public function deleteBlog(){
       // 启动事务
        Db::startTrans();
        try{
            Db::table('lofter_comment')->where("article_id=".self::$_data['article_id'])->delete();
            Db::table('lofter_article')->where("article_id=".self::$_data['article_id'])->delete();
            // 提交事务
            Db::commit();    
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['status'=>0,"msg"=>"删除失败"];
        }
        return ['status'=>1,"msg"=>"删除成功"];
    }
    
    //更新编辑内容
    public function updateBlog(){
        $article_id = self::$_data["article_id"];
         // 把tag_arr拿出来
        $tag_arr = isset( self::$_data["tag_arr"] )? self::$_data["tag_arr"] : "";
        $tag_arr = explode("," ,$tag_arr);
        // 参数处理
        self::$_data['article_title']=isset($_POST['article_title'])?$_POST['article_title']:"";
        self::$_data['article_img']=isset($_POST['article_img'])?$_POST['article_img']:"";
        self::$_data['article_content']=isset($_POST['article_content'])?$_POST['article_content']:""; 
        //用户没有登录就会报错           
        self::$_data['user_id']=session("user_info")["user_id"];
        unset(self::$_data['content']);
        unset(self::$_data['tag_arr']);
        unset(self::$_data['article_id']);
        unset(self::$_data['article_time']);
        //返回博文内容
        $articleModel = model("article");
        $blog_save = $articleModel->where("article_id = $article_id")->update(self::$_data);
        //返回插入标签
        $tag = array();
        for( $i =0 ; $i < count($tag_arr) ; $i++ ){
            $tagArticleModel = model("tagArticle");
            $tagArticleModel->save(['article_id'=>$article_id,'tag_id'=>$tag_arr[$i]]);
            $result_tag = $tagArticleModel->where("tag_article_id =".$tagArticleModel->getLastInsID())->find();
            // 查询tag内容
            $tag_data = model("tag")->where("tag_id = ".$result_tag['tag_id'])->find();
            // 往数组里面插入数据
            $tag[$i] = $tag_data ;
        }
        $blog["user_info"] = empty(session("user_info"))?"":session("user_info");
        $blog["tag"]  = $tag;
        if( empty( $blog) ){
            return ['status'=>0,"msg"=>"失败"];
        }else{
            return ['status'=>1,"msg"=>"成功","data"=>[$blog]];
        }  
    }


    //个人博客
    public function personalBlog(){
    //     $user_id=self::$_data['user_id'];
    //     $userModel = model("user")->alias("us");
    //     $result = $userModel->join("article a");
    //     $sql = " SELECT * from lofter_user INNER JOIN lofter_article on lofter_article.user_id = lofter_user.user_id where lofter_user.user_id = $user_id ";
    //     // 对所有$result 进行数据排除
    //     $result = $this->fetchAll($sql);
    //     foreach($result as $val){
    //         unset($val["user_pwd"]);
    //         unset($val['create_time']);
    //     }
    //     // var_dump($result);
    //     return $result;
    // }

}

?>