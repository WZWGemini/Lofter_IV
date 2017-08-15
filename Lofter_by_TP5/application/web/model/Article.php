<?php
namespace app\web\model;
use think\Model;

class Article extends Model
{
    protected $createTime = false;
    protected $updateTime = false;
    protected $insert = ['article_time'];
    // protected $name = "article";

    public function user(){
        return $this->belongsTo('User');
    }


}



?>