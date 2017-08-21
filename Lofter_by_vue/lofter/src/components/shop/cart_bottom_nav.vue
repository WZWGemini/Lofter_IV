<template class="bottomNav-cart">
  <div class="carBottom">
    <ul style="width: 100%;">
      <li class="p">
        共{{goods_checknum}}件
        <p>金额：&nbsp;<span class="red">{{goods_checkprice}}元</span></p>
      </li>
      <li class="buy">结算</li>
      <li class="b">
        <router-link to='/' class="b-class">继续购物</router-link>
      </li>
    </ul>
  </div>
</template>
<<script>
export default {
  data () {
    return {

    }
  }
}
</script>

<style lang="scss">
@import '../../assets/common.scss';

/* 底部导航栏样式 */

.carBottom{
  width: 100%;
  position: fixed;
  bottom: 0;
  font-size: .35rem;
  border-top: 1px dashed #cfcfcf;
  ul{
    li{
      width: 33%;
      text-align: center;
      display: inline-block;
      height: 0.8rem;
      line-height: 0.8rem;
    }
    li.p{
      background-color: white;
      color: $topic_color;
      float: left;
      height: 0.8rem;
      font-size: .3rem;
      line-height: 0.4rem;
    }
    li.b{
      float: right;
      background-color: #dfdfdf;
      .b-class {
        color: $topic_hcolor;
      }
    }
    li.buy{
      color: #fff;
      float: right;
      background-color: $topic_hcolor;
    }
  }
}
</style>
