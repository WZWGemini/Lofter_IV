<?php
namespace app\web\controller;
use think\Controller;

class Comment extends Controller
{
    private static $_data ;
    
    //tp5 构造函数，自动运行父类构造函数
    function _initialize(){
        self::$_data = $_POST;//接收请求
    }

    //获取评论
    public function showComment(){
        $article_id = self::$_data['article_id'];
        //获取评论Id，文章Id，用户名，用户Id，评论内容，评论时间，用户头像
        $result = model("comment")->alias('c')
                ->join('user u',"c.user_id = u.user_id")
                ->field("c.comment_id, c.article_id, u.user_name, u.user_id, c.comment_content, c.comment_time, u.user_head")
                ->where("c.article_id = $article_id")
                ->select();
        if( !empty( $result ) ){
            $this->assign('comment' , $result);
            $html = $this->fetch('index');
            return ['status'=>1,"msg"=>"成功","html"=>$html,"data"=>$result];
        }else{
            return ['status'=>0,"msg"=>"无内容","html"=>"","data"=>$result];
        }
    }

    //添加评论
    public function addComment(){
        $data = self::$_data;
        $data["comment_time"]=time();
        $data['user_id'] = session("user_info")["user_id"];
        //保存数据
        $commentModel = model("comment");
        $res_add = $commentModel->save($data);
        //取出保存的数据
        $result = $commentModel->alias("c")->where("c.comment_id=".$commentModel->getLastInsID())->select();
        if($res_add == 0){
            return ['status'=>0,"msg"=>"保存数据失败"];
        }
        $result[0]["user_id"] = session("user_info")["user_id"];
        $result[0]["user_name"] = session("user_info")["user_name"];
        $result[0]["user_head"] = session("user_info")["user_head"];

        if( !empty($result) ){
            $this->assign('comment', $result);
            $html = $this->fetch('index');
            return ['status'=>1,"msg"=>"成功","html"=>$html,"data"=>$result];
        }else{
            return ['status'=>0,"msg"=>"失败","html"=>"","data"=>$result];
        }
    }

}

