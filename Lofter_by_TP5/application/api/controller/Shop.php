<?php
namespace app\api\controller;

class Shop
{
  // 查询商品
  public function index(){
    $shop = model("shop")->alias("s")
                    ->where(1)
                    ->join('user u','u.user_id=s.user_id')
                    ->field('s.shop_id,s.shop_name,s.shop_describe,s.shop_img,u.user_name,u.user_id')
                    ->order('s.shop_id desc')
                    ->paginate(10);
    return json(['status' => 1, 'msg' => 'success', 'rtn'=> $shop]);
  }
}