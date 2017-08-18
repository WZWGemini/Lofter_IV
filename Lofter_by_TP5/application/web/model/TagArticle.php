<?php
namespace app\web\model;
use think\Model;

class TagArticle extends Model
{
    protected $table = "lofter_tag_article";
    protected $createTime = false;
    protected $updateTime = false;

    public function article(){
        return $this->hasOne("Article");
    }
}



?>