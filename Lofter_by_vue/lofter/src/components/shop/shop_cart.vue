<template class="cart-view">
  <div class="cart">
    <shead></shead>
    <div class="null"></div>
    <div class="check-class">
      <input type="checkbox" @click="checkAll()" :checked="checkGoods.length==goodsList.length"/>    
      全选
    </div> 
    <div class="carGoodsList" v-for="(car,index) in goodsList">
       <div class="goods-box" v-for="cart in cartList"> 
        <ul>
           <li class="carGoodsListCheck">
            <input type="checkbox" v-model="checkGoods" :value="cart.carList[index]"/>
          </li>
          <li class="carGoodsListImg">
            <img :src="JSON.parse(cart.shop_list_a[index].shop_img)"/>
          </li>
          <li class="carGoodsListInfo">
            <ul>
              <li class="goods-title">{{cart.shop_list_a[index].shop_name}}</li>
              <li class="goods-attr">
                <span class="goods-color">{{cart.color_attr[index]}}</span>
                <span class="goods-size">{{cart.size_attr[index]}}</span>
              </li>
              <li class="goods-price">售价：<span class="red">￥{{cart.shop_detail_list[index].shop_price['shop_price']}}</span></li>
              <li class="goods-amount">
                <button class="goods-button" @click="minus(cart.carList[index])">-</button>
                 <input type="text" class="goods-num" :value="cart.carList[index].shop_num"> 
                <button class="goods-button" @click="add(cart, index)">+</button>
              </li>
            </ul>
          </li>
          <li class="carGoodsListDelete"><span class="icon-heart"></span></li> 
          <!-- <li class="carGoodsListDelete icon-bin2" @click="delItem(index,item)"></li> -->
         </ul>
       </div> 
    </div> 
    <div class="carBottom">
      <ul style="width: 100%;">
        <li class="p">
            共{{totalNum}}件
          <p>金额：<span class="red">￥{{totalPrice}}元</span></p>  
        </li>
        <li class="buy" @click="setAccount(uinfo.user_id)">结算</li>
        <li class="b">
          <router-link to='/shop/shome' class="b-class">继续购物</router-link>
        </li>
      </ul>
    </div>
  </div>	
</template>

<script>
// 单独引入 辅助函数
import {mapState, mapMutations} from 'vuex'
import {Toast} from 'mint-ui'
import shead from './home_top_nav'
export default {
  name: 'shopcar',
  data () {
    return {
      // 对添加到购车的商品 验证是否存在
      hasExists: false, // 默认否
      CheckAll: false,
      checkGoods: [],
      checkGoodsDetail: [],
      shopcarInfo: [],
      goodsList: [],
      tolprice: null
    }
  },
  components: {
    shead
  },
  mounted () {
    this.init()
  },
  methods: {
    ...mapMutations(['cartInfoSave', 'orderInfoSave']),
    init: function () {
      let userId = this.uinfo.user_id
      this.$http.get('api/shopcar/' + userId)
        .then((rtnD) => {
          // console.log(rtnD)
          this.shopcarInfo = rtnD.data.data
          this.cartInfoSave(this.shopcarInfo)
          this.goodsList = this.shopcarInfo['carList']
          this.goodsDetail = this.shopcarInfo['shop_id_unique']
          // console.log(this.goodsDetail)
        })
    },
    checkAll () {
      if (this.checkGoods.length > 0) {
        // 取消选中
        // console.log(this.checkGoods.length)
        this.checkGoods = []
      } else {
        // 全选
        this.goodsList.forEach((item) => {
          this.checkGoods.push(item)
        })
      }
    },
    minus: function (info) {
      if (info.shop_num > 0) {
        info.shop_num--
      }
    },
    add: function (info, index) {
      if (info.carList[index].shop_num <= info.shop_detail_list[index].shop_store['shop_store']) {
        info.carList[index].shop_num++
      }
    },
    setAccount: function (info) {
      this.checkGoods.forEach((item) => {
        this.goodsDetail.forEach((i) => {
          console.log(i)
          if (item.shop_id === i.shop_id) {
            this.checkGoodsDetail.push(i)
          }
        })
      })
      // 还要把确认要购买的商品存入订单列表中
      let orderInfo = {
        totalNum: this.totalNum,
        totalPrice: this.totalPrice,
        orderList_arr: this.checkGoods,
        orderList_arr_detail: this.checkGoodsDetail,
        user_id: info
      }
      this.orderList.length = 0
      this.orderInfoSave(orderInfo)
      // console.log(orderInfo.orderList_arr_detail)
      this.$router.push('/consigner/' + orderInfo.user_id)
      Toast('正在结算中……')
    }
  },
  computed: {
    ...mapState(['cartList', 'orderList', 'uinfo']),
    totalPrice: function () {
      let tPrice = 0
      this.checkGoods.forEach((item) => {
        // console.log(item)
        tPrice += Number(item.shop_price) * Number(item.shop_num)
      })
      return tPrice
    },
    totalNum: function () {
      let tNum = 0
      this.checkGoods.forEach((item) => {
        tNum += Number(item.shop_num)
      })
      return tNum
    }
  }
}
</script>


<style lang="scss">
@import '../../assets/common.scss';
.cart{
  width: 100%;
	margin-bottom: .8rem;
  display: inline-block;
  .check-class {
    display: block;
    padding: .2rem;
    font-size: .3rem;
	  border-bottom: 1px dashed #C8C8CD;
  }
  .carGoodsList {
    font-size: .5rem;
    width: 100%;
    display: inline-block;
    .goods-box {
      float: left;
      padding: .2rem;
      height: 2rem;
	    border-bottom: 1px dashed #C8C8CD;      
      ul {
        float: left;
        .carGoodsListCheck{
          // display: inline-block;
          float: left;
          height: 100%;
          width: 5%;
          margin-right: .3rem;
          input {
            margin: .8rem 0 0;
          }
        }
        .carGoodsListImg {
          width: 25%;
          height: 1.9rem;
          overflow: hidden;
          float: left;
          margin: .1rem .5rem 0 0;
          // display: inline-block;
          img {
            width: 100%;
          }
        }
        .carGoodsListInfo {
          width: 40%;
          float: left;
          font-size: .3rem;
          color: #777;
          text-align: center;
          .goods-title {
            text-align: left;
            font-weight: 600;
            color: $topic_color;
            font-size: .4rem;
            line-height: .6rem;
          }
          .goods-amount {
            text-align: center;
            margin-top: .1rem;
            input {
              width: 1rem;
              height: .35rem;;
              text-align: center;
              border: 1px solid $topic_color;
            }
            button {
              background-color: $topic_color;
              color: #fff;
              font-weight: 600;
              border: 1px solid $topic_color;
              outline: none;
            }
          }
        }
        .carGoodsListDelete {
          font-size: .4rem;
          float: right;
          margin: .7rem .4rem 0 0;
          span {
            color: $topic_color;
          }
        }
      }
    }
  }
  /* 底部导航栏样式 */
  .carBottom{
    width: 100%;
    position: fixed;
    bottom: 0;
    font-size: .35rem;
    border-top: 1px dashed #cfcfcf;
    background-color: #fff;
    ul{
      li{
        text-align: center;
        display: inline-block;
        height: 0.8rem;
        line-height: 0.8rem;
      }
      li.p{
        width: 38%;
        background-color: white;
        color: $topic_color;
        float: left;
        height: 0.8rem;
        font-size: .3rem;
        line-height: 0.4rem;
      }
      li.b{
        width: 30%;
        float: right;
        background-color: #dfdfdf;
        .b-class {
          color: $topic_color;
        }
      }
      li.buy{
        width: 30%;
        color: #fff;
        float: right;
        background-color: $topic_color;
      }
    }
  }
}
</style>