<?php
namespace app\web\controller;
use think\Controller;

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
            $user_info["user_message_num"] = 0;
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
        //插入查询信息
        $user_info[ "user_article_num" ] = $user_article_num['num'] ;
        $user_info["user_message_num"] = 0;
        $user_info["user_attention_num"] = 0;
        //设置用户session
        session("user_info",$user_info);
        return ['status'=>1,"msg"=>"登录成功",'data'=>$user_info];
    }

    //退出
    public function logout(){
        session("user_info",null);
        return ['status'=>1,"msg"=>"退出成功"];
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
        //查询文章信息
        $blog = model("article")->where("user_id=$uid")->order("article_id desc")->select();
        //文章插入标签
        foreach($blog as $key){
            $tag = model("tagArticle")->alias('ta')
                 ->join('tag t','ta.tag_id = t.tag_id')
                 ->field("t.tag_content")
                 ->where("ta.article_id=".$key['article_id'])
                 ->select();
            $key['tag']=$tag;
        }
        //查询用户信息
        $user = model('user')->where("user_id=$uid")->find();
        $this->assign('blog',$blog);
        $this->assign('user',$user);
        return $this->fetch("userHome");
    }

}




?>