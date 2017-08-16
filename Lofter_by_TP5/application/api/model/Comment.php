<?php
namespace app\api\model;

use think\Model;

class Comment extends Model
{
    protected $insert = ['comment_time'];
    protected $createTime = "";
    protected $updateTime = "";
    protected function setCommentTimeAttr()
    {
        return time();
    }
}