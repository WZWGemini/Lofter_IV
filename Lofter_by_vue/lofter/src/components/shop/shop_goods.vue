<template class="shopGoods-view">
  <div class="shopGoods">
    <shead></shead>
    <div class="null"></div>
    <div class="goodsSwiper">
      <mt-swipe :auto="4000" class="shopPic">
          <mt-swipe-item>
              <img :src="JSON.parse(goods_info.shop_img)">
          </mt-swipe-item>
          <mt-swipe-item>
              <img :src="JSON.parse(goods_info.shop_img)">
          </mt-swipe-item>
          <mt-swipe-item>
              <img :src="JSON.parse(goods_info.shop_img)">
          </mt-swipe-item>
          <mt-swipe-item>
              <img :src="JSON.parse(goods_info.shop_img)">
          </mt-swipe-item>
      </mt-swipe>
      <div class="goodsDepict">
        <h3>{{goods_info.goods_name}}</h3>
        <p class="shop-title">{{goods_info.shop_name}}</p>
        <p class="m">{{goods_info.shop_describe}}</p>
        <p class="red j">￥{{attr_info.shop_price}}</p>
        <div class="goodsDiscount">
          <b class="bStyle">促销</b>
          <span>可分期</span>
        </div>
      </div>
      <div class="goodsChoose" is-link @click="popupVisible=true">
        <b class="bStyle">已选</b>
        <span class="choose-content">
          {{color_attr}} {{size_attr}}
        </span>
      <!-- <mt-cell class="bStyle goodsChoose" title="已选：" is-link @click.native="popupVisible=true"></mt-cell> -->
        <!-- <b>已选</b> -->
        <!-- <span>
          小米Max2{{showName}}{{showColor}}X1
        </span>
        <i class="icon-circle-up goodsChooseIcon" @click="goodsParamPopup()"></i> -->
      </div> 

      <mt-popup class="goodsPopup"
        v-model="popupVisible"
        position="bottom"
        popup-transition="popup-fade">
        <div class="goods-top">
          <p class="goods-name">{{goods_info.shop_name}}</p>
          <p class="goods-price">商品价格：<span class="red">￥{{attr_info.shop_price}}</span></p>
        </div>
        
        <div class="goodsParam">
          <dl>
            <dt>颜色</dt>
            <dd :class="{attr_class:color==color_attr}" v-for="color in spec_list.color_attr">
            <span @click="selectColor(color)">{{color}}</span>
          </dd>
          </dl>
          <dl>
            <dt>尺寸</dt>
          <dd :class="{attr_class:size==size_attr}" v-for="size in spec_list.size_attr">
            <span  @click="selectSize(size)">{{size}}</span>
          </dd>
          </dl>
        </div>
        <div class="cart-add">
          <router-link to='' class="link-class" @click.native="addCart()">
            <span class="icon-cart"></span>
            <span>加入购物车</span>
          </router-link>
        </div>
      </mt-popup>
    </div>
    <div class="null"></div>
    <div class="bottomNav">
      <ul>
        <li>
          <router-link to='/goods' class="link-class">
            <span class="icon-home"></span>
            <p>主页</p>
          </router-link>
        </li>
        <li>
          <router-link to='' class="link-class" @click.native="goCart(uinfo.user_id)">
            <span class="icon-cart"></span>
            <p>购物车</p>
          </router-link>
        </li>
        <li class="li-class-add">
          <router-link to='' class="link-class" @click.native="addCart()">
            <span class="icon-user"></span>
            <p>加入购物车</p>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import shead from './home_top_nav'
import {mapState} from 'vuex'
import {Toast} from 'mint-ui'
export default {
  name: 'sgoods',
  data () {
    return {
      goods_info: [], // 商品信息
      spec_list: [], // 属性列表
      attr_price_list: [], // 属性价格
      color_attr: [], // 当前颜色属性
      size_attr: [], // 当前尺寸属性
      attr_info: [], // 当前属性价格和库存
      popupVisible: false
    }
  },
  components: {
    shead
  },
  mounted () {
    this.init()
  },
  watch: {
    'color_attr' (val) {
      // 观察当前颜色属性是否变化
      this.attr_price_list.forEach((item) => {
        let detailArr = item.shop_detail_json
        if (detailArr === '[{"color":"' + val + '","size":"' + this.size_attr + '"}]') {
          this.attr_info = item
          // console.log(this.attr_info)
        }
      })
    },
    'size_attr' (val) {
      this.attr_price_list.forEach((item) => {
        let detailArr = item.shop_detail_json
        if (detailArr === '[{"color":"' + this.color_attr + '","size":"' + val + '"}]') {
          this.attr_info = item
          // console.log(this.attr_info)
        }
      })
    }
  },
  computed: {
    ...mapState(['uinfo', 'tag'])
  },
  methods: {
    // ...mapMutations(['cartInfoSave']),
    init: function () {
      let shopId = this.$route.params.goods_id
      this.$http.get('/api/sgoods/' + shopId)
        .then((rtnD) => {
          console.log(rtnD)
          // 赋值商品信息
          this.goods_info = rtnD.data.rtn.goods_info
          // 赋值属性列表
          this.spec_list = rtnD.data.rtn.spec_list
          this.color_attr_list = this.spec_list.color_attr
          this.color_attr = this.color_attr_list[0]
          this.size_attr_list = this.spec_list.size_attr
          this.size_attr = this.size_attr_list[0]
          // 赋值属性价格
          this.attr_price_list = rtnD.data.rtn.detail_list
          this.attr_info.shop_price = this.attr_price_list[0].shop_price
          // console.log(this.spec_list.size_attr)
        })
    },
    selectColor: function (color) {
      // 设置当前颜色属性ID
      this.color_attr = color
      // console.log(this.color_attr)
    },
    selectSize: function (size) {
      // 设置当前尺寸属性ID
      this.size_attr = size
      // console.log(this.size_attr)
    },
    addCart: function () {
      // 当前属性
      let cartInfo = {
        color_attr: this.color_attr,
        size_attr: this.size_attr,
        goods_info: this.goods_info,
        attr_info: this.attr_info,
        user_id: this.uinfo.user_id,
        attr_json: '[{"color":"' + this.color_attr + '","size":"' + this.size_attr + '"}]',
        num: 1
      }
      // console.log(cartInfo)
      this.popupVisible = false
      this.$http.post('/api/shopcar', {
        cartInfo: cartInfo
      }).then((rtnD) => {
        // console.log(rtnD)
        if (rtnD.data.status === 1) {
          // this.cartInfoSave(rtnD.config.data)
          // console.log(rtnD.config.data)
          Toast('加入购物车成功')
        }
      })
    },
    goCart: function (userId) {
      this.$router.push('/shopcar/' + userId)
    }
  }
}
</script>


<style lang="scss">
@import '../../assets/common.scss';
/*
商品页面样式
*/

.goodsSwiper{
	width: 100%;
	margin-bottom: .3rem;
  .shopPic {
    width: 100%;
    height: 7rem;
    img {
      width: 100%;
    }
  }
}

.goodsDepict{
	padding: .22rem .22rem 0;
  font-size: .25rem;
  border-bottom: .16rem solid #efefef;
  h3{
    font-size: .26rem;
      line-height: .38rem;
      color: #222;
      margin: 0;
  }
  span{
      font-size: .2rem;
      line-height: .26rem;
  }
  .shop-title {
    font-size: .4rem;
    font-weight: 600;
    color: $topic_color;
  }
  p.m{
    margin: 0 0;
    color: #777;
    line-height: .26rem;
  }
  p.j{
    margin: 0 0;
    font-size: .3rem;
    text-align: right;
    border-bottom: 1px solid #f4f4f4;
  }
}

.goodsDiscount {
  margin-top: 0.05rem;
  padding-bottom: 0.1rem;
  font-size: .25rem;
  span {
      display: inline-block;	
      font-size: .18rem;
      color: #f56600;
      border: 1px solid #f56600;
      border-radius: 1px;
      padding: .01rem .04rem;
      margin-right: .08rem;
  }
}
.bStyle{
  font-size: .25rem;
  display: inline-block;
  color: #777;
  max-width: 2rem;
  margin: .1rem .22rem 0rem .1rem;
}
.v-modal {
  z-index: 90 !important;
}
.goodsPopup{
	width: 100%;
  z-index: 99 !important;
  .goods-top {
    padding-left: .2rem;
    .goods-name {
      font-size: .7rem;
    }
    .goods-price {
      font-size: .5rem;
    }
  }
  
  .goodsParam dl{
    margin:0.1rem 0.3rem 0;
    font-size: .3rem;
    padding-bottom: .2rem;
    border-bottom: 1px solid #dfdfdf;
    dt{
      margin: .12rem .06rem 0;
      font-size: .35rem;
      color: #777;
    }
    dd{
      border: 1px dashed #ccc;
      display: inline-block;
      padding:0.1rem 0.2rem;
      margin: 0.1rem .1rem 0 0;
      span {
        color: #777;
        font-weight: 600;
      }
    }
  }
  .cart-add {
    font-size: .35rem;
    width: 100%;
    text-align: center;
    line-height: 1rem;
    background-color: $topic_color;
    .link-class {
      color: #fff;
    }
  }
}

.goodsChoose{
	padding: 0.1rem .22rem ;
  font-size: .3rem;
} 
.attr_class {
  // padding:0.1rem 0.2rem;
  border: 1px solid $topic_color !important;
}

/* 底部导航栏样式 */
.bottomNav{
	width: 100%;
	position: fixed;
  bottom: 0;
  font-size: .35rem;
  background-color: #fff;
  ul {
    // text-align: center;
    width: 100%;
    li {
      width: 23%;
      padding: .15rem 0 .1rem;
      display: inline-block;
      text-align: center;
      .link-class {
        color: $topic_color;
        p {
          font-size: .3rem;
        }
      }
    }
    .li-class-add {
      float: right;
      width: 50%;
      background-color: $topic_color;
      .link-class {
        color: #fff;
      }
    }
  }
}
</style>
