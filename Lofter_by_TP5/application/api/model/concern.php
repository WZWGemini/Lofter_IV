<?php
namespace app\api\model;
use think\Model;

class Concern extends Model
{
    protected $updateTime = false;
    protected $insert = ['create_time'];
}



?>