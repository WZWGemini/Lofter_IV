<?php
namespace app\api\controller;

class Consigner
{
  //保存收货人信息
  public function save(){
      $Model = model('shopConsigner');
      // 查询是否有重复收货人信息
      $consigner_name = input('consigner_name');
      $consigner_addr = input('consigner_addr');
      $consigner_tel = input('consigner_tel');
      $query_info = $Model->where("consigner_name='$consigner_name'")
                          ->where("consigner_tel='$consigner_tel'")
                          ->where("consigner_address='$consigner_addr'")
                          ->find();
      if ($query_info) {
          $data = ['consigner_id'=> $query_info['consigner_id']];
          return json(['status'=>1,"msg"=>"收货人信息已存在","html"=>'',"data"=>$data]);
      }else{ 
          $Model->save(['consigner_name' => $consigner_name,
                          'consigner_tel' => $consigner_tel,
                          'consigner_address' => $consigner_addr,
                          'user_id' => input('user_id')]);
          $data = ['consigner_id'=> $Model->getLastInsID()];
          return json(['status'=>1,"msg"=>"添加成功","html"=>'',"data"=>$data]);
      }
  }

  // 查询收货人信息
  public function read($id){
    // 收货人信息信息
    $consigner_info = model('shopConsigner')
                    ->where('user_id='.$id)
                    ->where('is_default=1')
                    ->find();
    $consigner_user = model('shopConsigner')
                    ->where('user_id='.$id)
                    ->select();
    $rtn = array('consigner_info' => $consigner_info, 
                'consigner_user' => $consigner_user);
    return json(['status' => 1, 'msg' => 'success', 'rtn'=> $rtn]);
  }
}