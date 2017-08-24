<template class="shopBalance-view">
  <div class="shopBalance">
    <shead></shead>
    <div class="null"></div>
    <div class="consigner-info">
      <div class="consigner_name"></div>
      <div class="consigner_tel"></div>
      <div class="consigner_address"></div>
    </div>
    <div class="carGoodsList">
      <div class="goods-box" v-for="order in goods_info">
        <ul>
           <li class="carGoodsListImg">
              <img :src="JSON.parse(order.goods_info.shop_img)"/>
          </li>
          <li class="carGoodsListInfo">
            <ul>
              <li class="goods-title">{{order.goods_info.shop_name}}</li>
              <li class="goods-attr">
                <span class="goods-color">{{order.color_attr_name}}</span>
                <span class="goods-size">{{order.size_attr_name}}</span>
              </li>
              <li class="goods-price">数量：<span class="">{{order.num}}</span></li>
              <li class="goods-price">单价：<span class="red">￥{{order.attr_info.shop_price}}</span></li>
              <li class="goods-price">小计：<span class="red">￥{{order.num * order.attr_info.shop_price}}</span></li>
            </ul>
          </li>
        </ul>     
      </div>
      <div class="orderTotal">总数量：<span class="red">{{order_num}}</span></div>
      <div class="orderTotal">总价格：<span class="red">￥{{order_price}}</span></div>
    </div>
    <router-link to='' class="link-class" @click.native="addCart()">
      <div class="order-pay">
        <span class="icon-cart"></span>
        <span>立即付款</span>
      </div>
    </router-link>
  </div>
</template>

<script>
import shead from './home_top_nav'
import sfoot from './shop_bottom_nav'
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
    ...mapState(['orderList'])
  },
  components: {
    shead,
    sfoot
  },
  mounted () {
    this.getConsigner()
  },
  methods: {
    ...mapMutations(['cartInfoSave']),
    getConsigner: function () {
      this.goods_info = this.orderList[0].orderList_arr
      this.order_num = this.orderList[0].totalNum
      this.order_price = this.orderList[0].totalPrice
      // 获取收货人信息
      // console.log(this.orderList[0].user_id)
      this.$http.get('/api/consigner/' + this.orderList[0].user_id)
        .then((rtnD) => {
          // this.consignerInfo = rtnD
          console.log(rtnD)
        })
    }
  }
}
</script>


<style lang="scss">
@import '../../assets/common.scss';
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
