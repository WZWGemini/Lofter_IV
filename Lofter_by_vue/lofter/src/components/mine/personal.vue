<template>
  <!-- 个人页面 -->
  <div class="personal">
    
    <!-- 内容盒子 -->
    <div class="content">

      <!-- 头部信息盒子 -->
      <router-link to="/user">
        <div class="heading">
          <!-- 头部背景盒子 -->
          <div class="heading-bg">
            <img src="../../assets/img/user_bg.jpg" alt="">
          </div>
          <!-- 头部用户信息栏 -->
          <div class="heading-info">
              <div class="heading-user">
                  <img :src="uinfo.user_head" alt="">
              </div>
              <div class="heading-right">
                <span class="heading-username">{{uinfo.user_name}}</span>
                <span class="user-id">ahaha1948</span>
                <!-- 头部功能栏 -->
                <div class="heading-function">
                  {{fflnum}}
                  <router-link to="/" active-class="a-class">关注{{ffl.follow.length}}</router-link>
                  <router-link to="/" active-class="a-class">粉丝{{ffl.fans.length}}</router-link>
                  <router-link to="/" active-class="a-class">喜欢{{ffl.love.length}}</router-link>
                </div>
              </div>
          </div>
      </div>
      </router-link>
      
      <!-- 功能盒子 -->
      <div class="function-box">
        <ul class="news-class">
          <li>
            <span class="icon-user-plus2 icon"></span>
            <mt-cell class="cell-class" title="lowfter商城" icon="" is-link to="/shop/shome"></mt-cell>
          </li>  
          <li>
            <span class="icon-heart2 icon"></span>
            <mt-cell class="cell-class" title="设置头像" icon="" is-link to="/"></mt-cell>
          </li>
          <li>
            <span class="icon-bubble2 icon"></span>
            <mt-cell class="cell-class" title="分享wolfter" icon="" is-link to="/"></mt-cell>
          </li>
          <li>
            <span class="icon-sound icon"></span>
            <mt-cell class="cell-class" title="退出" icon="" is-link to="/guide" @click.native="loginOut()"></mt-cell>
          </li>
        </ul>
      </div>
    </div>

    
  </div>
</template>

<script>
import axios from 'axios'
// 单独引入 辅助函数
import {mapState, mapMutations} from 'vuex'
export default {
  name: 'personal',
  created () {

  },
  components: {

  },
  data () {
    return {
    }
  },
  computed: {
    ...mapState(['uinfo', 'hasLogin', 'ffl']),
    fflnum: function () {
      axios.get('api/personal', {
        params: {
          user_id: this.uinfo.user_id
        }
      }).then((response) => {
        console.log(response)
        this.setffl(response.data)
      }).catch((error) => {
        console.log(error)
      })
    }
  },
  methods: {
    ...mapMutations(['unsetUinfo', 'setffl']),
    loginOut () {
      this.unsetUinfo()
      this.$toast('成功退出！')
    }
  },
  beforeRouteEnter (to, from, next) {
    // 由于beforeRouteEnter钩子 在组件被创造之前被调用，所以无法使用this获取组件定义的方法计算属性等
    // 要使用next(vm => {}) 就可以获取
    next(vm => {
      if (to.path === '/lofter/mine') {
        // console.log(vm.hasLogin)
        // 判断是否有登录
        if (vm.hasLogin) {
          next()
        } else {
          next({ path: '/login' })
        }
      }
    })
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style scoped lang="scss">
  @import '../../assets/common.scss';
  /* CSS Document */

  // 顶部固定导航栏
  .top-nav{
    color: $topic_color;
    background-color: #fff;
    // opacity:0;
    font-size: .3rem;
    height: 7%;
  }

  // 头部信息盒子
  .heading-bg {
    width:100%;
    height: 3rem;
    overflow: hidden;
    position: absolute;
  }

  .heading-bg img {
    width: 100%;
    overflow: hidden;
    position: absolute;
    z-index: -1;
    top: -1rem;
    opacity: .5;
  }

  .heading-user {
    width: 1.2rem;
    height:0;
    padding-bottom: 1.2rem;
    overflow: hidden;
    border-radius: 50%;
    position: absolute;
    top: 1rem;
    margin-left:7%;
    border: 3px solid #fff;
    img {
        width: 1.2rem;
    }
  }

  .heading-right {
    display: inline-block;
    margin: 1rem 0 0 2rem;
    font-size: 0.4rem;    
    .heading-username {
      font-family:'STXinwei', sans-serif;
      display:block;
    }
    .user-id {
      font-size: 0.25rem;
      color: #777;
      
    }
    .heading-function {
      display:block;
      text-align:center;
      font-size: .25rem;
      margin-top: .2rem;
    }
  } 
  .function-box{
    overflow: hidden;
  }
.news-class {
  width: 100%;
  float: left;
  background-color: #fff;  
  margin-bottom: .5rem;
  li {
    width: 100%;
    float: left;
    height: .9rem;
    background-color: #fff;
    .icon {
      color: #bbb;
      float: left;
      padding: .2rem 0 0 .3rem;
      font-size: .5rem;
    }
    .cell-class {
      width: 85%;
      height: .9rem;
      float: right;
      border: none;
    }
  }
}
  

  

</style>
