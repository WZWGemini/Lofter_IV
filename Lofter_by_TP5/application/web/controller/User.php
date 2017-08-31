<?php
namespace app\web\controller;
use think\Controller;
use think\Request;
use think\Session;
use app\web\model\User as userModel;

class User extends Controller
{

    //注册
    public function register(){
        $validate = validate("user");
        $user_name = input('user_name');
        $user_pwd = input('user_pwd');
        if($validate->check($_POST)){
            unset($_POST['captcha']);
            unset($_POST['user_pwd2']);
            model("user")->save($_POST);
            //查询用户信息
            $user_info = model("user")->alias("u")
                        ->where("u.user_name='$user_name' and u.user_pwd='$user_pwd'")
                        ->find();
            if(count($user_info)==0){
                return ['status'=>0,"msg"=>"注册失败"];
            }
            //插入查询信息
            $user_info[ "user_article_num" ] = 0 ;
            $user_info["user_recommend_num"] = 0;
            $user_info["user_attention_num"] = 0;
            //设置用户session
            session("user_info",$user_info);
            return ['status'=>1,"msg"=>"注册成功",'data'=>$user_info];
        }else{
        //    return $validate->getError();
            return ['status'=>0,"msg"=>"注册失败"];
        }
    }

    //登录
    public function login(){
        $user_name = input('user_name');
        $user_pwd = input('user_pwd');
        //查询用户信息
        $user_info = model("user")->alias("u")
                    ->where("u.user_name='$user_name' and u.user_pwd='$user_pwd'")
                    ->find();
        if(count($user_info)==0){
            return ['status'=>0,"msg"=>"登录失败"];
        }
        //查询用户发表文章数量
        $user_article_num = model("article")->alias("a")
                            ->field("count(*) AS num")->where("a.user_id=".$user_info['user_id'])
                            ->find();
        //查询用户关注数量
        $user_attention_num = model("concern")->field("count(*) AS num")
                            ->where("user_id=".$user_info['user_id'])
                            ->find();
        
        // 查询点赞的数量
        $user_recommend_num = model("hot")->field("count(*) AS num")
                            ->where("user_id=".$user_info['user_id'])
                            ->where("hot_recommend",1)
                            ->find();
        //插入查询信息
        $user_info[ "user_article_num" ] = $user_article_num['num'] ;
        $user_info["user_attention_num"] = $user_attention_num['num'];
        $user_info["user_recommend_num"] = $user_recommend_num['num'];
        //设置用户session
        session("user_info",$user_info);
        return ['status'=>1,"msg"=>"登录成功",'data'=>$user_info];
    }

    //退出
    public function logout(){
        Session::delete("user_info");
        // return ["status" => 1];
        // $this->redirect('index/login');
        // header("http://localhost/Lofter_by_TP5/public/web/index");
        // 需要清空所有session
        // return redirect( url('web') );
    }

    //查询用户是否存在
    public function queryUser(){
        $user_name = input('user_name');
        $user_info = model("user")->alias("u")->where("u.user_name='$user_name'")->find();
        if( empty($user_info) ){
            return ['status'=>1,"msg"=>"用户不存在"];
        }else{
            return ['status'=>0,"msg"=>"用户存在"];
        }
    }
    //个人主页
    public function goUserHome(){
        $uid = input("uid");
        $myId = empty(session("user_info")['user_id'])?0:session("user_info")['user_id'];
        //查询文章信息
        $blog = model("article")->where("user_id",$uid)->order("article_id desc")->select();
        //文章插入标签
        foreach($blog as &$key){
            $tag = model("tagArticle")->alias('ta')
                 ->join('tag t','ta.tag_id = t.tag_id')
                 ->field("t.tag_content")
                 ->where("ta.article_id", $key['article_id'])
                 ->select();
            $key['tag']=$tag;
        }
        //判断用户是否已关注了
       //自己关注的列表
        $concern_list = model("concern")->field("concern_user_id as cid")
                        ->where("user_id=$myId")->select();
        //查询用户信息
        $user = model('user')->where("user_id=$uid")->find();
        $this->assign("concern_list",$concern_list);
        $this->assign('blog',$blog);
        $this->assign('user',$user);
        return $this->fetch("userHome");
    }
    public function getUserInfo(){
        //爬取用户列表的文件路径
        $file = $_SERVER['DOCUMENT_ROOT']."/Lofter_by_TP5/application/bin/user/u0.json";
        //获取文件数据
        $user_json = file_get_contents($file);
        //
        $user_arr = json_decode($user_json);
        dump($user_arr);
    }

}




?>