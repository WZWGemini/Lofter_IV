<?php
namespace app\web\controller;
use think\Controller;
use think\Route;
use think\Db;

class Shop extends Controller
{
    /**
     * 遍历获取该节点下所有叶子节点
     * @param Model对象 $shopTypeModel
     * @param [["shop_type_id"=>$typeId]] shop_type_id为该节点id
     * @return [['shop_type_id','shop_type_name']]
     */
    public function bianLiLeaves($shopTypeModel, $reqArr){
        $arr = [];
        foreach($reqArr as $key=>$value){
            $typeId = $value['shop_type_id'];
            $stResult = $shopTypeModel->field("shop_type_id, shop_type_name")->where("shop_parent_id = $typeId")->select();
            if(empty($stResult)){
                $resArr = [
                    'shop_type_id'=>$value['shop_type_id'],
                    'shop_type_name'=>$value['shop_type_name'],
                ];
                $arr[] = $resArr;
            }else{
                $arr = array_merge($arr, $this->bianLiLeaves($shopTypeModel, $stResult));
            }
        }
        return $arr;
    }

     /**
     * 获取该节点下的商品信息   默认8条
     * @param  shop_type_id为该节点id
     * @param  num 返回信息条数
     * @return [['shop_id', 'shop_name', 'shop_img', 'user_name']]
     */
    public function getInfoAfterLeave($shop_type_id, $num=8){
        $shopTypeModel = Db::name("shop_type");
        //获取所有叶子节点 [['shop_type_id','shop_type_name']]
        $arrLeaves = $this->bianLiLeaves($shopTypeModel, [["shop_type_id"=>$shop_type_id]]);
        $arr = [];
        foreach($arrLeaves as $key=>$value){
            $arr[]=$value["shop_type_id"];
        }
        $shopModel = Db::name("shop");
        //获取信息
        $res = $shopModel->alias("s")
                  ->join("user u","s.user_id = u.user_id")
                  ->field("s.shop_id, s.shop_name, s.shop_img, u.user_name")
                  ->where("s.shop_type_id","in",$arr)
                  ->order("s.shop_id desc")
                  ->paginate($num);
        return $res;
    }


     /**
     * 首页显示
     * 显示8张框画和明信片，购物车数量
     * @return 跳转
     */
    public function art(){
        $cardTypeId = 1;
        $picTypeId = 2;

        //获取该类型下8条商品信息
        $card_res = $this->getInfoAfterLeave($cardTypeId);
        $pic_res = $this->getInfoAfterLeave($picTypeId);
        //获取购物车商品数量
        $shop_num = $this->ShopCarNum();
        
        $this->assign("card_res",$card_res);
        $this->assign("pic_res",$pic_res);
        $this->assign("shop_num",$shop_num);
        return $this->fetch("art/ART");
    }

     /**
     * 返回分页信息 每页16条
     * 参数： 页数page, 商品类型id shop_type_id
     * @return json
     */
    public function getShopInfoByPage(){
        $shop_type_id = input('shop_type_id');

        //获取该类型下16条商品信息
        $res_arr = $this->getInfoAfterLeave($shop_type_id,16);
        $this->assign("res_arr", $res_arr);
        $html = $this->fetch();
        return ['status'=>1,'info'=>"成功", 'html'=>$html];
    }


    /**
    * 框画页面
    * @return 页面
    */
    public function goFrame(){
        $picTypeId = 2;

        //获取该类型下16条商品信息
        $pic_res = $this->getInfoAfterLeave($picTypeId,16);
        
        $this->assign("pic_res",$pic_res);
        return $this->fetch('art/frame');
    }

    /**
    * 明信片页面
    * @return 页面
    */
    public function goPostcard(){
        $cardTypeId = 1;

        //获取该类型下16条商品信息
        $card_res = $this->getInfoAfterLeave($cardTypeId,16);
   
        $this->assign("card_res",$card_res);
        return $this->fetch('art/postcard');
    }

    /**
    * 商品详情页面
    * @return 页面
    */
    public function addCart(){
        $shop_id = input('shopInfo');
        $shopModel = Db::name("shop");
        //获取信息
        $res = $shopModel->alias("s")
                  ->join("user u","s.user_id = u.user_id")
                  ->field("s.shop_id, s.shop_name, s.shop_img, u.user_name, u.user_head")
                  ->where("s.shop_id = $shop_id")
                  ->find();
        $this->assign('shop',$res);
        // print_r($res);
        return $this->fetch('art/addCart');
    }


    /**
    * 商品管理页面
    * @return 页面
    */
    public function shopManage(){
        isLogin();
        $shopInfo = Db::name("shop")->field("shop_id, shop_name, shop_img, shop_describe, shop_type_id, is_show")
                                    ->where("user_id=".session("user_info")['user_id'])
                                    ->select();
        $this->assign("shopInfo", json_encode($shopInfo,true));
        return $this->fetch('art/shopManage');
    }


    /**
    * 商品发布页面
    * @return 页面
    */
    public function publish(){
        isLogin();
        //如果是框画state[3,4],明信片为state[5,6]
        //默认是框画
        $state = [3,4];
        $this->assign('state',$state);
        return $this->fetch('art/publish');
    }

    // 
    public function salesRecord(){
        isLogin();
        return $this->fetch('art/salesRecord');
    }


    /**
    * 购物车页面
    * @return 页面
    */
    public function ShopCar(){
        isLogin();
        $shopcarModel = Db::name('shopcar');
        $shopInfo = $shopcarModel->alias("sc")
                    ->join('shop s',"sc.shop_id = s.shop_id")
                    ->join("user u","s.user_id = u.user_id")
                    ->field("s.shop_name, s.shop_img, u.user_name, sc.shopcar_id, sc.shop_price, sc.shop_detail_json, sc.shop_num")
                    ->where('sc.user_id='.session("user_info")["user_id"])
                    ->select();
        $this->assign("shopInfo",$shopInfo);
        return $this->fetch("art/shopCar");
    }

    /**
    * 购物车数量
    * @return num
    */
    public function ShopCarNum(){
        //获取购物车商品数量
        if(!empty(session("user_info")["user_id"])){
            $shop_num = Db::name('shopcar')->field("count(*) as num")
                    ->where("user_id = ".session("user_info")["user_id"])
                    ->find()['num'];
        }else{
            $shop_num = 0;
        }
        return $shop_num;
    }



    /**
    * 加入购物车
    * 参数： shop_id, shop_color, shop_size, shop_detail_id
    * @return json
    */
    public function addToShopCar(){
        $data = [
            'user_id' => session("user_info")["user_id"],
            'shop_detail_json' => input('shop_detail_json'),
            'shop_id' => input('shop_id'),
            'shop_num'=> 1,
            'shop_price'=>input('shop_price')
        ];
        $shop_detail_json = input('shop_detail_json');
        $shopcarModel = Db::name('shopcar');
        if(!$shopcarModel->where("shop_detail_json","=","$shop_detail_json")->find()){
            $shopcarModel->insert($data);
            return ['status'=>1,"msg"=>"商品已加入购物车"];
        }else{
            return ['status'=>0,"msg"=>"购物车已存在该商品"];
        }
    }

    /**
    * 移除购物车商品
    * 参数： shopcar_arr [shopcar_id,shopcar_id2.....]
    * @return json
    */
    public function removeShopCar(){
        $shopcarModel = Db::name('shopcar');
        $user_id = session("user_info")["user_id"];
        $shopcar_tostr = implode(",",json_decode(input('shopcar_arr')));
        // 启动事务
        Db::startTrans();
        try{
            $shopcarModel->where("user_id = $user_id and shopcar_id in ($shopcar_tostr)")->delete();
            // 提交事务
            Db::commit();    
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['status'=>0,"msg"=>"移除失败"];
        }
        return ['status'=>1,"msg"=>"移除成功"];
    }


    /**
    * 修改购物车商品数量
    * 参数： shopcar_id  num
    * @return json
    */
    public function updateShopCar(){
        $shopcar_id=input('shopcar_id');
        $shopcarModel = Db::name('shopcar');
        $shopcarModel->where("shopcar_id=$shopcar_id and user_id=".session("user_info")["user_id"])->update(['shop_num'=>input('num')]);
        return ['status'=>1,"msg"=>"数量修改成功"];
    }


    /**
    * 订单页面 填地址
    * 参数： shopcar_id  num
    * @return json
    */
    public function sureOrder(){
        return $this->fetch('art/sureOrder');
    }



    /**
    * 购买商品（购物车结算，并支付）
    * 参数： shopcar_arr [shopcar_id,shopcar_id2.....]
    * 参数： user_address
    * @return 商品数量不足返回 json+data=shopcar_id
    * @return json
    */
    public function buyShopCar(){
        $shopcarModel = Db::name('shopcar');
        $shopDetailModel = Db::name('shopDetail');
        $shopHistoryModel = Db::name('shopHistory');
        $shopcar_arr = json_decode(input('shopcar_arr'));
        $user_address = input('user_address');
        // 启动事务
        Db::startTrans();
        try{
            $shop_arr = $shopcarModel->field('shopcar_id, shop_id, shop_detail_json, shop_num, shop_price')->where("shopcar_id","in",$shopcar_arr)->select();
            foreach($shop_arr as $key=>$value){
                //获取该商品库存
                // $shop_detail_json = $value['shop_detail_json'];
                // $shop_num = $shopDetailModel->field("shop_store")->where("shop_detail_json = '$shop_detail_json'")->find()['shop_store'];
                // if($shop_num<$value['shop_num']){
                //     return ['status'=>0,"msg"=>"购买失败，商品数量不足","data"=>$value['shopcar_id']];
                // }else{
                    //购物车移除该商品
                    $shopcarModel->where("shopcar_id =".$value['shopcar_id'])->delete();
                //     //原商品数量减少
                //     $new_num = $shop_num - $value['shop_num'];
                //     $shopDetailModel->update(['shop_num'=>$new_num]);
                    //历史订单列表增加该商品
                    $data = [
                        'shop_id' => $value['shop_id'],
                        'shop_price' => $value['shop_price'],
                        'shop_detail_json'=>$value['shop_detail_json'],
                        'shop_num'=>$value['shop_num'],
                        'user_address'=>$user_address,
                        'shop_time'=>time()
                    ];
                    $shopHistoryModel->insert($data);
                // }
            }
            // 提交事务
            Db::commit();    
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['status'=>0,"msg"=>"购买失败"];
        }
        return ['status'=>1,"msg"=>"购买成功"];
    }


    /**
    * 确认收货
    * 参数 shop_history_id
    * @return json
    */
    public function sureGet(){
        $shopHistoryModel = Db::name('shopHistory');
        $shopHistoryModel->where("shop_history_id = ".input("shop_history_id"))->update(['is_get'=>1]);
        return ['status'=>1,"msg"=>"确认收货成功"];
    }
    
    
    /**
    * 添加商品
    * 参数 shop_name, shop_img, shop_describe, shop_type_id, shop_price
    * shop_detail_json  类型为JSON.stringify后的json  '[{"4":1},{"5":5}]'   '[{规格:属性}]'
    * 可不传 shop_store
    * @return json
    */
    public function add(){
        isLogin();
        $shopModel = Db::name("shop");
        // $shopDetailModel = Db::name("shopDetail");
        $data = $_POST['data'];
        $data = json_decode($data, true);
        $file_pic = $_FILES;
        $file_name = $_FILES['img']['name'];
        $file_floder = './upload/';
        $shopInfo = [
            'shop_name' => $data['shop_name'],
            'shop_img' => input('shop_img'),
            'shop_describe' => $data['shop_describe'],
            'shop_type_id' => $data['shop_type_id'],
            'user_id' => session("user_info")['user_id'],
            'create_time' => time()
        ];
            move_uploaded_file( $file_pic['img']['tmp_name'],$file_floder.$file_pic['img']['name']);        
            $shopInfo['shop_img'] = "__PUBLIC_UPLOAD__".'/'.$file_pic['img']['name'];      
        
        //存入商品信息
        $shopModel->insert($shopInfo);

        // $shopDetailInfo = [
        //     'shop_detail_json' => input('shop_detail_json'),
        //     'shop_store' => 99999,
        //     'shop_id' => $shopDetailModel->getLastInsID(),
        //     'shop_price'=> input('shop_price')
        // ];
        // //存入商品详情
        // $shopDetailModel->insert($shopDetailInfo);
        return ['status'=>1,"msg"=>"添加商品成功"];
    }


    /**
    * 商品编辑
    * 参数 shop_id
    * @return 页面跳转
    */
    public function edit(){
        $shopModel = Db::name("shop");
        $shopTypeModel = Db::name("shopType");
        //商品基本信息
        $shopInfo = $shopModel->field("shop_name, shop_img, shop_describe, shop_type_id")
                              ->where("shop_id=".input('shop_id'))
                              ->find();
        //分类信息
        $shopTypeInfo = $shopTypeModel->alias("st1")->field("st1.shop_type_id, st1.shop_type_name")
                        ->join("shopType st2","st1.shop_parent_id=st2.shop_type_id")
                        ->select();
        $this->assign("shopInfo",$shopInfo);
        $this->assign("shopTypeInfo",$shopTypeInfo);
        return $this->fetch();
    }


    // 数据采集
    public function collectPic() {
        $shopModel = Db::name("shop");
        $userModel = Db::name("user");
        $file = $_SERVER['DOCUMENT_ROOT']."/Lofter_by_TP5/application/bin/text.json";
        $pic_json = file_get_contents($file);;
        $res = json_decode($pic_json,true);
        $shop_type_id = 4;
              
        // 启动事务
        Db::startTrans();
        try{
            foreach ($res as $key => $value) {
                $user_name = $value['user_name'];
                $user_id = $userModel->field("user_id")->where("user_name='$user_name'")->find()['user_id'];
                if(empty($user_id)){
                    $user_data=[
                        'user_name'=>$value['user_name'],
                        'user_pwd'=>$value['user_name'],
                        'create_time'=>time()
                    ];
                    $userModel->insert($user_data);
                    $shop_data=[
                        'shop_type_id'=>$shop_type_id,
                        'user_id'=>$userModel->getLastInsID(),
                        'shop_name'=>$value['shop_name'],
                        'shop_img'=>$value['shop_img'],
                        'shop_describe'=>$value['shop_describe'],
                        'create_time'=>time()                        
                    ];
                    $shopModel->insert($shop_data);
                }else{
                    $shop_data=[
                        'user_id'=>$user_id,
                        'shop_type_id'=>$shop_type_id,
                        'shop_name'=>$value['shop_name'],
                        'shop_img'=>$value['shop_img'],
                        'shop_describe'=>$value['shop_describe'],
                        'create_time'=>time()
                    ];
                    $shopModel->insert($shop_data);
                }
            }
            // 提交事务
            Db::commit();    
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            echo "失败";
        }
        echo "成功";
    }

}