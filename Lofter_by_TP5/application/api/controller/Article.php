<?php
namespace app\api\controller;
use think\Controller;
class Article extends Controller
{
//    index  get  user
    public function index()
    {
        $inputData = input();
        unset($inputData['page']);
        $user_article = model("article")->alias("a")
                    ->where($inputData)
                    ->paginate(2);
        $tag = model("tag");
        foreach ($user_article as $key => $value) {
            $atricleTag = $tag->alias('t')->join('tagArticle ta','ta.tag_id=t.tag_id')
                              ->where("ta.article_id=".$value['article_id'])
                              ->field('t.tag_content,t.tag_id')
                              ->select();
            $value['articleTag']=$atricleTag;
            $value['article_time']=date('Y-m-d H:i:s',$value['article_time']); 
        }
        return json(['status' => 1, 'msg' => '请求成功！','$user_article'=>$user_article]);
    }

//    read get user/:id
    public function read($id)
    {
        return json(['status' => 1, 'msg' => 'read']);
    }

//    edit get user/:id/edit
    public function edit($id)
    {
        return json(['status' => 1, 'msg' => 'edit']);
    }

//    create get user/create
    public function create()
    {
        return json(['status' => 1, 'msg' => 'create']);
    }

//    save post user
    public function save()
    {
        if(validate('article')->check(input())){

			$article_arr = array(
                'user_id' => input('user_id'),
                'article_title' => input('article_title'),
                'article_content' => input('article_content'),
                'article_time' => time());
            
			$article_info = model('article')->save($article_arr);
			return json(['status'=>1,'msg'=>'发布成功']);
		}else{
			return json(['status'=>0,'msg'=>validate('article')->getError()]);
		}
        // return json(['status' => 1, 'msg' => 'save']);
    }

//    update put user/:id
    public function update($id)
    {
        return json(['status' => 1, 'msg' => 'update']);
    }

//    delete delete user/:id
    public function delete($id)
    {
        return json(['status' => 1, 'msg' => 'delete']);
    }
}