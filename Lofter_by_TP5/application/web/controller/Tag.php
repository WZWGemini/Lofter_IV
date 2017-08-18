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
    public function tagIndex(Request $request){
        $tag_id = empty($request->get()["tag_id"])?1:$request->get()["tag_id"];
        $tag =tagModel::get($tag_id);
        $type = empty($request->get()["type"])?"tag":$request->get()["type"];
        $arts = Db::name("tag")->alias("t")
                              ->where("t.tag_id",$tag_id)
                              ->join("tag_article ta","t.tag_id = ta.tag_id")
                              ->join("article a","a.article_id=ta.article_id")
                              ->select();
        foreach($arts as $key => $art){
            $tags = DB::name('tag_article')->alias("ta")
                                        ->join("tag t","t.tag_id = ta.tag_id")
                                        ->where("ta.article_id", $art["article_id"])
                                        ->select();
            $user_info =DB::name('user')->field("user_name , user_id , user_head")
                                        ->where("user_id",$art["user_id"])
                                        ->find();
            $arts[$key]["tag"] = $tags;
            $arts[$key]["user_info"]= $user_info;
        }
        // dump($arts);
        $this->assign("tag" ,$tag);
        $this->assign('blog_list' ,$arts);
        return $this->fetch($type);
        // dump($html)
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
}




?>