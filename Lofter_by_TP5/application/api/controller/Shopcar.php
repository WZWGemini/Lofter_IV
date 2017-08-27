<?php
namespace app\api\controller;
use app\api\model\Shopcar as cartModel;
class Shopcar
{
  
  // 保存购物车信息
  public function save(){
    $carModel = model("shopcar");
    $cartInfo = input()['cartInfo'];
    $cartColor = $cartInfo['color_attr'];
    $cartSize = $cartInfo['size_attr'];
    // print_r($cartInfo['attr_info']['shop_detail_json']);
    $shop_detail_json = $cartInfo['attr_info']['shop_detail_json'];
    $shop_price = $cartInfo['attr_info']['shop_price'];
    // 查询是否有相同属性的商品
    $query_info = $carModel->where(array('shop_detail_json' => $shop_detail_json))->find();
    if($query_info) {
      // 存在同一属性的商品则在数量上加一
      $shopcarId = $carModel->where(array('shop_detail_json' => $shop_detail_json))->field('shopcar_id')->find();
      $shopcar_id = $shopcarId['shopcar_id'];
      $cart = cartModel::get($shopcar_id);
      $shop_num = $carModel->where("shopcar_id='$shopcar_id'")->field('shop_num')->find();
      $cart->shop_num = $shop_num['shop_num'] + 1;
      $res = $cart->save();
      return json(['status'=>1,"msg"=>"添加成功","html"=>'',"data"=>$res]);
    } else {
      $carModel->save(['user_id' => $cartInfo['goods_info']['user_id'],
                        'shop_id' => $cartInfo['attr_info']['shop_id'],
                        'shop_detail_json' => $shop_detail_json,
                        'shop_num' => $cartInfo['num'],
                        'shop_price' => $shop_price]);
      $data = ['cart_id' => $carModel->getLastInsID()];
      return json(['status' => 2,"msg"=>"添加成功","html"=>'',"data" => $data]);
    }
  }

  // 查询购物车信息
  public function read($id) {
    $carModel = model("shopcar");
    $detailModel = model("shopDetail");
    $shopModel = model("shop");
    $shop_id_list = [];
    $shop_json_list = [];
    $shop_detail_list = [];
    $shop_list_a = [];
    $color_attr = [];
    $size_attr = [];
    $carList = $carModel->where("user_id='$id'")->select();
    foreach ($carList as $key => $value) {
      $shop_id_list[$key] = $value['shop_id'];
      $shop_json_list[$key] = $value['shop_detail_json'];
      // 拆解shop_detail_json
      foreach ($shop_json_list as $value2) {
        // print_r(json_decode($value,true));
        $attr_json_ktmp = json_decode($value2,true);
        foreach ($attr_json_ktmp as $k => $v){
          // print_r($v);
          foreach ($v as $k2 => $v2) {
            // print_r($v2);
            if ($k2 == 'color') {
              $color_attr[$key] = $v2;
            } else {
              $size_attr[$key] = $v2;
            }
          }
          
        }
      }
    }
    // $shop_json_list = array_unique($shop_json_list);
    // print_r($shop_json_list);
    // print_r($color_attr);
    foreach ($shop_json_list as $key => $value) {
      // $tmp = json_encode($shop_json_list[$key]);
      // print_r(array('shop_detail_json'=>$value));
      $shop_detail_list[$key]['shop_store'] = $detailModel->where(array('shop_detail_json'=>$value))->field('shop_store')->find();
      $shop_detail_list[$key]['shop_price'] = $carModel->where(array('shop_detail_json'=>$value))->field('shop_price')->find();
    }
    foreach ($shop_id_list as $key => $value) {
      $shop_list_a[$key] = $shopModel->where("shop_id='$value'")->field('shop_id,shop_name,shop_img')->find();
    }
    $shop_list_unique = array_unique($shop_list_a);
    $data = ['carList' => $carList,
              'shop_detail_list' => $shop_detail_list,
              'color_attr' => $color_attr,
              'size_attr' => $size_attr,
              'shop_list_a' => $shop_list_a,
              'shop_id_unique' => $shop_list_unique];
    return json(['status' => 1,"msg"=>"请求成功","html"=>'',"data" => $data]);
  }
}