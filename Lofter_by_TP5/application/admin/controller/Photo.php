<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/11
 * Time: 14:56
 */

namespace app\admin\controller;


use think\Controller;

class Photo extends Controller
{
    public function index(){
       return $this->fetch('/layout');
    }
}