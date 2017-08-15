<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\model\Index as indexModel ;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function test(){
        echo 'dd';
    }
 

}
