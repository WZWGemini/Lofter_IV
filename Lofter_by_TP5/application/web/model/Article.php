<?php
namespace app\web\model;
use think\Model;

class Article extends Model
{
    protected $createTime = false;
    protected $updateTime = false;
    protected $insert = ['article_time'];
}



?>