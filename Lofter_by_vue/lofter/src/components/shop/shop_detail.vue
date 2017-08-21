<template class="shopDetail-view">
  <div class="shopDetail">
    <div class="goodsSwiper">
      <mt-swipe :auto="4000" class="shopPic">
          <mt-swipe-item>
              <img src="../../assets/img/shop_img/11.jpg"/>
          </mt-swipe-item>
          <mt-swipe-item>
              <img src="../../assets/img/shop_img/11.jpg"/>
          </mt-swipe-item>
          <mt-swipe-item>
              <img src="../../assets/img/shop_img/11.jpg"/>
          </mt-swipe-item>
          <mt-swipe-item>
              <img src="../../assets/img/shop_img/11.jpg"/>
          </mt-swipe-item>
      </mt-swipe>
      <div class="goodsDepict">
        <h3>小米 Max2</h3>
        <p class="m"><span class="red">【64GB 现货在售】</span>6.44''大屏 / 5300mAh 充电宝级的大电量 / 大像素相机 / 轻薄全金属 / ​4GB 大内存 / 骁龙八核处理器</p>
        <p class="red j">￥{{showPrice}}</p>
        <div class="goodsDiscount">
          <b class="bStyle">促销</b>
          <span>可分期</span>
        </div>
      </div>
      <mt-popup class="goodsPopup"
        v-model="goodsParamPopupVisible"
          position="bottom"
        popup-transition="popup-fade">
        <div class="goodsParam">
          <dl>
            <dt>版本</dt>
            <dd v-on:click="Click_one(item)" v-for="item in names" v-bind:class="{border:item.active}">{{item.name}}</dd>
          </dl>
          <dl>
            <dt>颜色</dt>
              <dd v-on:click="Click_two(item)" v-for="item in colors" v-bind:class="{border:item.active}">{{item.color}}</dd>
          </dl>
        </div>
      </mt-popup>
      <div class="goodsChoose">
        <b class="bStyle">已选</b>
        <span>
          小米Max2{{showName}}{{showColor}}X1
        </span>
        <i class="icon-circle-up goodsChooseIcon" @click="goodsParamPopup()"></i>
      </div>

    </div>
  </div>
  
</template>

<style lang="scss">
@import '../../assets/common.scss';

/*
商品页面样式
*/

.goodsSwiper{
	width: 100%;
	height: 56.25%;
	/*height: 380px;*/
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
  p.m{
    margin: 0 0;
    font-size: .2rem;
    color: #777;
    line-height: .26rem;
  }
  p.j{
    margin: 0 0;
    font-size: .28rem;
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
  font-weight: normal;
  color: rgba(0,0,0,.54);
  max-width: 2rem;
  margin: .1rem .22rem 0rem .1rem;
}
.goodsPopup{
	width: 100%;
  margin-bottom:.5rem !important;
  .goodsParam dl{
    padding:0.1rem 0.3rem 0.2rem 0.3rem;
    margin-bottom:0 !important;
    border-bottom: 1px solid #f4f4f4;
    dt{
      font-weight: normal;
      margin-top: .12rem;
      margin-bottom: .06rem;
      line-height: .24rem;
      font-size: .18rem;
      color: #beb5cc;
    }
    dd{
      border: 1px dashed #ccc;
      padding:0.1rem 0.2rem 0.1rem 0.3rem;
      margin-top: 0.1rem;
    }
  }
}

.goodsChoose{
	padding: 0.1rem .22rem ;
	border-bottom: 1px solid #f4f4f4;
  position: relative;
  font-size: .25rem;
  border-bottom: .16rem solid #efefef;
  span{
    font-size: .18rem;
    color: #777;
    line-height: .3rem;
    padding-right: .4rem;
  }
  .goodsChooseIcon{
    position: absolute;
    top: 0.2rem;
    right: 0.4rem;
  }
} 



</style>
