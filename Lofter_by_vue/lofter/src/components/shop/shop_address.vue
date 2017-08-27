<template class="shopAddress-view">
  <div class="shopAddress">
    <shead></shead>
    <div class="null"></div>
     <div v-for="consigner in consignerList">
       <div class="consigner-info" v-for="con in consigner">
        <div class="consigner_name">收货人：{{con.consigner_name}}</div>
        <div class="consigner_tel">联系电话：{{con.consigner_tel}}</div>
        <div class="consigner_address">收货地址：{{con.consigner_address}}</div>
       </div>
      
    </div>
    <router-link to='' class="link-class" @click.native="openConsigner()">
      <div class="consigner-add">
        <span class="icon-cart"></span>
        <span>添加收货人</span>
      </div>
    </router-link>
    <mt-popup v-model="popupVisible" position="bottom" class="add-pop">
      <div>
        <ul class="consigner-ul">
          <li class="consigner-li">
            <label for="consigner_name">收货人：</label>
            <input type="text" id='consigner_name' v-model="consigner_name"/>
          </li>
          <li class="consigner-li">
            <label for="consigner_tel">联系电话：</label>
            <input type="text" id='consigner_tel' v-model="consigner_tel"/>
          </li>
          <li class="consigner-li">
            <label for="consigner_addr">收货地址：</label>
            <input type="text" id='consigner_addr' v-model="consigner_addr"/>
          </li>
        </ul>
        <router-link to="" class="add-consigner" @click.native="addConsigner()">
          <span>添加</span>
        </router-link>
      </div>
    </mt-popup>
  </div>
</template>

<script>
import shead from './home_top_nav'
import {mapMutations, mapState} from 'vuex'
import {Toast} from 'mint-ui'
export default {
  name: 'address',
  data () {
    return {
      consigner_info: [], // 收货人信息
      consigner_name: '',
      consigner_tel: '',
      consigner_addr: '',
      popupVisible: false
    }
  },
  computed: {
    ...mapState(['consignerList', 'uinfo'])
  },
  components: {
    shead
  },
  mounted () {
    this.init()
  },
  methods: {
    ...mapMutations(['orderInfoSave']),
    init: function () {
      // this.goods_info_detail = this.orderList[0].orderList_arr_detail
      // this.order_num = this.orderList[0].totalNum
      // this.order_price = this.orderList[0].totalPrice
      // 获取收货人信息
      this.consigner_info = this.consignerList
      console.log(this.consigner_info)
      // this.$http.get('/api/consigner/' + this.orderList[0].user_id)
      //   .then((rtnD) => {
      //     this.consignerInfo = rtnD.data.rtn.consigner_info
      //     this.consignerUser = rtnD.data.rtn.consigner_user
      //     // console.log(this.consignerUser)
      //   })
    },
    openConsigner: function () {
      this.popupVisible = true
    },
    addConsigner: function () {
      this.$http.post('/api/consigner/', {
        consigner_name: this.consigner_name,
        consigner_tel: this.consigner_tel,
        consigner_addr: this.consigner_addr,
        user_id: this.uinfo.user_id
      }).then((rtnD) => {
        // this.consignerInfo = rtnD.data.rtn.consigner_info
        // this.consignerUser = rtnD.data.rtn.consigner_user
        this.popupVisible = false
        console.log(rtnD)
        Toast(rtnD.data.msg)
      })
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

.consigner-add, .add-consigner {
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

.add-pop {
  font-size: .4rem;
  width: 100%;
  div {
    ul {
      padding: .1rem .25rem;
      margin-bottom: 1rem;
      li {
        line-height: .8rem;
        border-bottom: 2px solid #efefef;
        // margin-bottom: .2rem;
        padding: .1rem;
        font-size:.35rem;
        label {
          text-align:center;
          display:inline-block;
          width: 28%;
          font-size: .3rem;
          margin-right: 0.05rem;
        }
        input {
          border: none;
          height: .55rem;
          outline: none;
          width: 60%;
          color: #9d9d9d;
          font-size: .35rem;
        }
      }
    }
  }
}
</style>
