<?php
namespace app\api\model;

use think\Model;

class Article extends Model
{
    protected $updateTime = "";
    protected $createTime = "";
    protected $insert = ['article_time'];
}