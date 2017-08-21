<template id="car-view">
  <div id="car">
    <label>
      <input type="checkbox" v-model="CheckAll" @click="checkAll()" :value="CheckAll"/>
      &nbsp;&nbsp;全选
    </label>
    <div class="carGoodsList">
      <div class="border-bottom">
        <ul>
          <li class="col-xs-1 carGoodsListCheck">
            <input type="checkbox" :value="item" v-model="checkAllFlag"/>
          </li>
          <li class="col-xs-3 carGoodsListImg">
            <img src="img/pms_1495692033.10494295!180x180.jpg"/>
          </li>
          <li class="col-xs-6">
            <ul>
              <li class="carGoodsListTitle">
                {{item.cur_version}}
                {{item.cur_color}}
              </li>
              <li class="carGoodsListPrice">
                售价：{{item.goods_price}}
              </li>
              <li class="carGoodsListLi">
                <button class="col-md-2 carGoodsListButton" @click="jianNum(item)">-</button>
                <input class="col-md-2 carGoodsListText" type="text" v-model="item.goods_num"/>
                <button class="col-md-2 carGoodsListButton" @click="jiaNum(item)">+</button>
              </li>
            </ul>
          </li>
          <li class="col-xs-1 carGoodsListDelete icon-bin2" @click="delItem(index,item)"></li>
        </ul>
      </div>
    </div>
  </div>	
</template>

<script>
// 单独引入 辅助函数
import {mapState, mapMutations} from 'vuex'
export default {
  data () {
    return {
      // 对添加到购车的商品 验证是否存在
      hasExists: false, // 默认否
      CheckAll: false,
      checkAllFlag: [],
      tolprice: null
    }
  },
  methods: {
    ...mapMutations(['setCart']),
    checkAll () {
      if (this.CheckAll) {
        this.checkAllFlag = []
        // store.state.cartList.forEach((item,index)=>{
        //   this.checkAllFlag.push(item)
        // })
      // this.checkAllFlag = true
      // alert('hello')
      } else {
        this.checkAllFlag = []
        // alert('hi')
      }
    }
    // addCart () {
    //   // 对状态数组 进行遍历 检查是否存在   若已存在则讲 hasExists置为true
    //   store.state.cartList.forEach(item => {
    //     // console.log(item)
    //     if (item.cur_color === this.showColor && item.cur_version === this.showName) {
    //       hasExists = true;
    //       item.goods_num++
    //     };
    //   })
    //   // 判断hasExists是否为否,为否则添加到vuex
    //   if (!hasExists) {
    //   // 也就是把当前选择的版本、颜色、价格都传给在vuex定义的设置购物车方法
    //   // store 是Vuex.Store返回对象
    //   // commit 方法是触发mutations里面定义的方法
    //   // 第一个参数：方法的名称
    //   // 第二个参数：传过去的值
    //     store.commit('setCart', {
    //       cur_version: this.showName,
    //       cur_color: this.showColor,
    //       goods_num: 1,
    //       goods_price: this.showPrice
    //     })
    //     this.$toast('添加成功')
    //     // alert(store.state.cartList.length)
    //   }
    // }
  },
  computed: {
    ...mapState(['cartList'])
  }
}
</script>


<style lang="scss">
@import '../../assets/common.scss';
#car{
	margin-bottom: .8rem;
}
#car label{
	width: 100%;
	border-bottom: 1px dashed #C8C8CD;
}
#car .carGoodsList img{
	width: 100%;
}
#car .carGoodsList ul{
	overflow: hidden;
	padding: 0 !important;
}
#car .carGoodsList .carGoodsListCheck{
	margin: 13% 0 0 4%;
}
#car .carGoodsList .carGoodsListImg{
	margin-top: 3.5%;
}
#car .carGoodsList .carGoodsListTitle{
    font-size: .2rem;
    line-height: .2rem;
    color: #666;
}
#car .carGoodsList .carGoodsListPrice{
    font-size: .15rem;
    color: #999;
    margin: 0.2rem 0.2rem;
}
#car .carGoodsList .carGoodsListButton{
	
}
#car .carGoodsList .carGoodsListText{
	width: 30%;
	text-align: center;
}
#car .carGoodsList ul li ul{
	margin-top: 7%;
	text-align: center;
}
#car .carGoodsList .carGoodsListDelete{
	margin:13% 0 0 4% ;
}
#car .carBottom{
	width: 100%;
	position: fixed;
	bottom: 0;
	border-top: 1px dashed #C8C8CD;
}
#car .carBottom ul{
	overflow: hidden;
	padding: 0 !important;
	margin: 0 !important;
	text-align: center;
}
#car .carBottom li{
    height: 0.8rem;
    line-height: 0.8rem;
}
#car .carBottom li.p{
	background-color: white;
    height: 0.8rem;
    line-height: 0.4rem;
}
#car .carBottom li.buy{
	background-color: orangered;
}
#car .carBottom li.b{
	background-color: #C8C8CD;
}

</style>