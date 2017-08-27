<?php
namespace app\api\controller;

class Sgoods
{
  // 查询商品
  public function read($id){
    // 商品信息
    $goods_info = model('shop')
                    ->where('shop_id='.$id)
                    ->field('shop_name,shop_img,shop_describe,user_id')
                    ->find();
    // 商品详情
    $detail_list = model('shopDetail')
                    ->where('shop_id='.$id)
                    ->select();
    // 商品属性
    $attrModel = model('shopAttr');
    $spec_list = [];
    foreach ($detail_list as $key => $value) {
      $attr_arr_tmp = json_decode($detail_list[$key],true);
      // var_dump(json_decode($detail_list[$key],true));
      foreach ($attr_arr_tmp as $k => $v) {
        // print_r($attr_arr_tmp['shop_detail_json']);
        $attr_json[$key] = $attr_arr_tmp['shop_detail_json'];
        $spec_list[$key] = $attr_arr_tmp['shop_detail_json'];
      }
    }
    $color_attr = [];
    $size_attr = [];
    // 拆解shop_detail_json
    foreach ($attr_json as $key => $value) {
      // print_r($attr_json);
      // print_r(json_decode($attr_json[$key],true));
      $attr_json_ktmp = json_decode($attr_json[$key],true);
      foreach ($attr_json_ktmp as $v){
      //   $spec_list[$key] = json_decode($attr_json_ktmp[$k],true);
        // print_r($attr_json_ktmp);
        foreach ($v as $k2 => $v2) {
          if ($k2 == 'color') {
            $color_attr[0] = '黑色';
            for ($i = 1; $i<=$k2+1; $i++) {
              if ($v2 !== $color_attr[$i-1]) {
                $color_attr[$i] = $v2;
              }
            }
          } else {
            $size_attr[0] = '大';
            for ($i = 1; $i<=$k2+1; $i++) {
              if ($v2 !== $size_attr[$i-1]) {
                $size_attr[$i] = $v2;
              }
            }
          }
        }
      }
    }
    // print_r($color_attr);
    // print_r($size_attr);
    $spec_list['color_attr'] = $color_attr;
    $spec_list['size_attr'] = $size_attr;
    $rtn = array('goods_info' => $goods_info, 
                'detail_list' => $detail_list,
                'spec_list' => $spec_list);

        return json(['status' => 1, 'msg' => 'success', 'rtn'=> $rtn]);
  }
}