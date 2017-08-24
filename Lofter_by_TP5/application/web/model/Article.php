<?php
namespace app\web\model;
use think\Model;

class Article extends Model
{
    protected $createTime = 'article_time';
    protected $updateTime = 'article_time';
    protected $autoWriteTimeStamp = true ;
    // protected $insert = ['article_time'];
    // protected $name = "article";

    public function user(){
        return $this->belongsTo('User');
    }


}



?>