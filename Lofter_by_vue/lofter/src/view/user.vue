<template>
  <!-- 个人页面 -->
  <div class="user">

    <!-- 顶部固定导航栏 -->
    <mt-header fixed class="top-nav" :title="uinfo.user_name">
      <router-link :to="backUrl" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
      <mt-button icon="more" slot="right"></mt-button>
    </mt-header>
    
    <!-- 内容盒子 -->
    <div class="content">

      <!-- 头部信息盒子 -->
      <div class="heading">

          <!-- 头部背景盒子 -->
          <div class="heading-bg">
            <img src="../assets/img/user_bg.jpg" alt="">
          </div>
          <!-- 头部用户信息栏 -->
          <div class="heading-info">
              <div class="heading-user">
                <img :src="uinfo.user_head" alt="">
              </div>
              <p class="heading-username">{{uinfo.user_name}}</p>

              <!-- 头部功能栏 -->
              <div class="heading-function">
                  <router-link to="/myfollow" active-class="a-class">关注{{ffl.follow.length}}</router-link>
                  <router-link to="/" active-class="a-class">粉丝{{ffl.fans.length}}</router-link>
                  <router-link to="/" active-class="a-class">喜欢{{ffl.love.length}}</router-link>
              </div>
          </div>
      </div>
      <!-- 博文内容盒子 -->
      <div class="blog-list">
          <div>
            共{{uArticleNum}}篇文章
          </div>
        <ul
        v-infinite-scroll="loadMore"
        infinite-scroll-disabled="loading"
        infinite-scroll-distance="10">
          <li class="blog-box" v-for="item in uarticle">
              <list :item = item></list>
          </li>
      </ul>      
      </div>
    </div>
  </div>
</template>

<script>
// 引入进度条插件 nprogress
import nprogress from 'nprogress'
// 单独引入 辅助函数
import {mapState, mapMutations} from 'vuex'
// 引入内容列表 组件
import list from '../components/content_list'
// 为了获取用户个人发表文章引入axios
import axios from 'axios'
export default {
  name: 'user',
  created () {

  },
  components: {
    list
  },
  data () {
    return {
      showLoading: false,
      loading: true,
      backUrl: '/lofter/home/follow'
    }
  },
  methods: {
    ...mapMutations(['setUarticle']),
    loadMore () {
      console.log(this.uCurPage)
      this.loading = true
      nprogress.start()
      setTimeout(() => {
        // 滚动到底部请求数据
        axios.get('api/article', {
          params: {
            page: this.uCurPage,
            user_id: this.uinfo.user_id
          }
        }).then((response) => {
          console.log(response)
          if (this.uCurPage <= this.uLastPage) {
            this.loading = false
          } else {
            this.loading = true
            this.$toast('已经到底了！')
          }
          // 调用 mutations的setUarticle方法，将获取到的文章添加到uarticle
          this.setUarticle(response.data.$user_article)
          nprogress.done()
        }).catch((error) => {
          console.log(error)
        })
      }, 1000)
    }
  },
  computed: {
    ...mapState(['hasLogin', 'uinfo', 'uarticle', 'uArticleNum', 'uLastPage', 'uCurPage', 'ffl'])
  },
  beforeRouteEnter (to, from, next) {
    // 由于beforeRouteEnter钩子 在组件被创造之前被调用，所以无法使用this获取组件定义的方法计算属性等
    // 要使用next(vm => {}) 就可以获取
    next(vm => {
      // 判断是否有登录
      if (vm.hasLogin) {
        if (from.path === '/lofter/mine') {
          vm.backUrl = from.path
            // 判断在store中是否已经有文章，无则请求，有则不请求
          if (vm.uarticle.length === 0) {
            axios.get('api/article', {
              params: {
                user_id: vm.uinfo.user_id
              }
            }).then((response) => {
              console.log(response)
                // 调用 mutations的setUarticle方法，将获取到的文章添加到uarticle
              vm.setUarticle(response.data.$user_article)
              vm.loading = false
              next()
            }).catch((error) => {
              console.log(error)
            })
          } else {
            if (vm.uCurPage <= vm.uLastPage) {
              vm.loading = false
            }
            next()
          }
        }
      } else {
        next({ path: '/login' })
      }
    })
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style scoped lang="scss">
  @import '../assets/common.scss';
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
  }

  .heading-bg img {
    width: 100%;
    /* height: 35%; */
    overflow: hidden;
    position: absolute;
    z-index: -1;
    top: -1rem;
  }

  .heading-info {
    background: #FFF;
    height: 2rem;
  }

  .heading-user {
    width: 1.8rem;
    height: 1.8rem;
    overflow: hidden;
    background-position: center;
    background-size: cover;
    border-radius: 50%;
    position: absolute;
    top: 2rem;
    margin-left:35%;
    border: 3px solid #fff;
    img{
      width:100%;
    }
  }

  .heading-username {
    font-family:'STXinwei', sans-serif;
    display:block;
    text-align:center;
    padding-top: 1rem;
    font-size: 0.4rem;
  }

  .heading-function {
    display:block;
    text-align:center;
    font-size: .25rem;
    margin-top: .1rem;
  }
  .blog-list{
    font-size: .3rem;
  }

</style>
