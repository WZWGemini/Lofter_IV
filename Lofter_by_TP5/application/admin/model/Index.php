<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/13
 * Time: 11:34
 */
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Index extends  Model
{
    use SoftDelete;
    protected $name = 'test';
    protected $autoWriteTimestamp = true;

}