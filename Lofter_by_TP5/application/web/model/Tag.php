<?php
namespace app\web\model;
use think\Model;

class Tag extends Model
{
    protected $createTime = false;
    protected $updateTime = false;

    public function tagArticle(){
        return $this->hasMany("TagArticle");
    }
}



?>