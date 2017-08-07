<?php
namespace app\web\controller;
use think\Controller;


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
        $table = 'article';
        $key = array_keys(self::$_data);
        $val = array_values(self::$_data);
        //返回博文内容
        $blog = model("article")->save(self::$_data);


//写到这


        $blog = $this->insert_info($table ,$key ,$val);//返回1    
        //返回插入标签
        $tag = array();
        $tag_key = array('article_id' ,'tag_id');
        for( $i =0 ; $i < count($tag_arr) ; $i++ ){
            $tag_val = array( $blog[0]['article_id'] ,$tag_arr[$i]  );
            // $select_art[$i]["tag"] = $this->fetchAll($tag_sql)
            $result_tag = $this->insert_info('tag_article' ,$tag_key ,$tag_val)[0];
            // 查询tag内容
            $tag_sql = "select * from lofter_tag  where tag_id = $result_tag[tag_id]";
            $tag_data = $this->fetchAll($tag_sql)[0] ;
            // 往数组里面插入数据
            $tag[$i] = $tag_data ;
        }
        // var_dump($tag);
        // $tag
        $blog[0]["user_info"] = $_SESSION["user_info"];
        $blog[0]["tag"]  = $tag;
        return $blog;
    }
}

?>