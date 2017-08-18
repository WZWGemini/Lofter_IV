<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Article extends Model{
    use SoftDelete;//引用软删除
    protected $autoWriteTimestamp = true ;//设置自动插入时间戳
}