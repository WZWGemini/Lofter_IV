<template class="shopBalance-view">
  <div class="shopBalance">
    <shead></shead>
    <div class="null"></div>
    <div class="consigner-info" @click="choseAddr(uinfo.user_id)">
      <div class="consigner_name">收货人：{{consignerInfo.consigner_name}}</div>
      <div class="consigner_tel">联系电话：{{consignerInfo.consigner_tel}}</div>
      <div class="consigner_address">收货地址：{{consignerInfo.consigner_address}}</div>
    </div>
     <div class="carGoodsList">
      <div class="goods-box" v-for="(orders, index) in goods_info">
        <ul v-for="order in orderList">
           <li class="carGoodsListImg">
            <img :src="JSON.parse(order.orderList_arr_detail[index].shop_img)"/>
          </li>
          <li class="carGoodsListInfo">
            <ul>
              <li class="goods-title">{{order.orderList_arr_detail[index].shop_name}}</li>
              <li class="goods-attr">
                 <span class="goods-color">{{order.color_attr_name}}</span>
                <span class="goods-size">{{order.size_attr_name}}</span> 
              </li>
              <li class="goods-price">数量：<span class="">{{order.orderList_arr[index].shop_num}}</span></li>
              <li class="goods-price">单价：<span class="red">￥{{order.orderList_arr[index].shop_price}}</span></li>
              <li class="goods-price">小计：<span class="red">￥{{order.orderList_arr[index].shop_num * order.orderList_arr[index].shop_price}}</span></li>
            </ul>
          </li> 
        </ul> 
      </div>
      <div class="orderTotal">
        <p class="order-num">总数量：<span class="red">{{order_num}}</span></p>
        <p class="order-price">总价格：<span class="red">￥{{order_price}}</span></p> 
      </div>
      
    </div>
    <router-link to='' class="link-class" @click.native="addOrder()">
      <div class="order-pay">
        <span class="icon-cart"></span>
        <span>立即付款</span>
      </div>
    </router-link>
  </div>
</template>

<script>
import shead from './home_top_nav'
import {mapMutations, mapState} from 'vuex'
// import {Toast} from 'mint-ui'
export default {
  name: 'sbalance',
  data () {
    return {
      goods_info: [], // 订单商品信息
      order_num: null, // 订单数量信息
      order_price: null, // 订单价格信息
      consignerInfo: [], // 收货人信息
      popupVisible: false
    }
  },
  computed: {
    ...mapState(['orderList', 'uinfo'])
  },
  components: {
    shead
  },
  mounted () {
    this.getConsigner()
  },
  methods: {
    ...mapMutations(['orderInfoSave', 'consignerInfoSave']),
    getConsigner: function () {
      this.goods_info = this.orderList[0].orderList_arr
      this.goods_info_detail = this.orderList[0].orderList_arr_detail
      this.order_num = this.orderList[0].totalNum
      this.order_price = this.orderList[0].totalPrice
      // 获取收货人信息
      console.log(this.orderList)
      this.$http.get('/api/consigner/' + this.orderList[0].user_id)
        .then((rtnD) => {
          this.consignerInfo = rtnD.data.rtn.consigner_info
          this.consignerUser = rtnD.data.rtn.consigner_user
          this.consignerInfoSave(this.consignerUser)
          // console.log(this.consignerUser)
        })
    },
    choseAddr: function (info) {
      this.$router.push('/address/' + this.uinfo.user_id)
    }
  }
}
</script>


<style lang="scss">
@import '../../assets/common.scss';
.consigner-info {
  font-size: .4rem;
  // margin: .2rem;
  padding: .2rem;
  // border: 1px dashed $topic_color;
  // border-radius: .2rem;
  // background-color:rgba(142, 204, 174, .5);
  border-bottom: .1rem dashed rgb(198, 229, 214);
}
.carGoodsList {
  font-size: .5rem;
  width: 100%;
  display: inline-block;
  margin-bottom: 1rem;
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
  .orderTotal {
    clear: both;
    font-size: .4rem;
    margin: 0 .2rem;
    padding: .2rem .1rem;
  }
}

.order-pay {
  font-size: .35rem;
  width: 100%;
  text-align: center;
  line-height: 1rem;
  background-color: $topic_color;
  position: fixed;
  bottom: 0;
  span {
    color: #fff;
  }
}

</style>
