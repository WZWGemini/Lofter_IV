<template>
  <!-- 发现详情页面 -->
  <div class="detail">

    <!-- 顶部固定导航栏 -->
    <header class="header">
      <nav class="navbar">
        <div class="navbar-wp">
          <router-link to="" class="top-icon icon active">
            <span class="icon-search"></span>
          </router-link> 
          <div class="top-nav">
            <div class="clear topnav-class">
              <router-link to="" class="li-class" active-class="a-li" v-for="i in 10">推荐</router-link>
            </div>
          </div>
          <router-link to="" class="open"></router-link>
        </div>  
      </nav> 
    </header> 

    
    <!-- 内容盒子 -->
    <div class="content">
      <!--顶部广告照片  -->
      <div class="ad-box" v-show='showHeadImg'>
        <span class="icon-cross" @click='showSheet()'>
        </span>
        <img src="../../assets/img/copyright_watermark_sample.png">
        <mt-actionsheet :actions="actions" v-model="sheetVisible">
        </mt-actionsheet>
      </div>

      <div class="article-box" v-for="i in 10">
        <div class="article-img-box">
          <img src="../../assets/img/user_bg.jpg" class="article-img">
        </div>
        <div class="article-author">
          <span class="tip">作者：</span>
          <span class="user-name">啊哈哈</span>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import list from '../content_list'
import axios from 'axios'
import {mapMutations, mapState} from 'vuex'
export default{
  name: 'homeFollow',
  components: {
    list
  },
  data () {
    return {
      // 头部广告图片
      showHeadImg: true,
      // actionSheet
      sheetVisible: false,
      actions: [{
        name: '不再显示',
        method: () => {
          this.closeHeadImg()
        }
      }],
      pageNum: 2
    }
  },
  computed: {
    ...mapState(['allArticle', 'totalAllArtNum'])
  },
  methods: {
    ...mapMutations(['setAllArticle']),
    showSheet () {
      this.sheetVisible = true
    },
    closeHeadImg () {
      this.showHeadImg = false
    },
    loadMore () {
      this.loading = true
      setTimeout(() => {
        // 滚动到底部请求数据
        axios.get('api/article', {
          params: {
            page: this.pageNum
          }
        }).then((response) => {
          console.log(this.allArticle)
          // 调用 mutations的setUarticle方法，将获取到的文章添加到uarticle
          this.setAllArticle(response.data.$user_article.data)
          // 将pageNum ++
          this.pageNum++
        }).catch((error) => {
          console.log(error)
        })
        this.loading = false
      }, 1000)
    }
  },
   // 使用导航钩子 检查跳转
  beforeRouteEnter (to, from, next) {
    console.log(to)
    console.log(from)
    next(vm => {
      if (to.path === '/lofter/home/follow') {
        // 发送请求
        if (vm.totalAllArtNum === 0) {
          axios.get('/api/article', {

          }).then((response) => {
            console.log(response)
            if (response.data.status === 1) {
              vm.setAllArticle(response.data.$user_article.data)
              next()
            }
          }).catch((error) => {
            console.log(error)
          })
        } else {
          next()
        }
      }
    })
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style lang="scss">
  @import '../../assets/common.scss';
  /* CSS Document */

  
  .header {
    .navbar {
      position: relative;
      height: .8rem;
      line-height: .8rem;
      font-size: .35rem;
      border-bottom: 1px solid #efefef;
      z-index: 999;
      text-align: center;
      .navbar-wp {
        position: relative;
        height: .8rem;
        margin: 0 .2rem 0 .8rem;
        .top-icon {
          position: relative;
          display: inline-block;
          height: 100%;
          span {
            color: $topic_color;
            padding: .25rem .2rem .5rem;
            float: left;
          }
        }
        .active {
          position: absolute;
          top: 0;
          width: .8rem;
          left: -.8rem;
        }
        .icon:after {
          content: "";
          position: absolute;
          right: -.5rem;
          top: 0;
          bottom: 0;
          width: .5rem;
          background-image: radial-gradient(ellipse at left, rgba(0, 0, 0, 0.1) 0, rgba(0, 0, 0, 0) 80%);
        }
        .top-nav {
          height: 100%;
          overflow: hidden;
          z-index: 2;
          .clear:after {
            content: "";
            display: table;
            clear: both;
          }
          .topnav-class {
            white-space: nowrap;
            height: 100%;
            overflow-y: hidden;
            .li-class {
              padding: .18rem .25rem;
              color: $topic_color;
            }
            .a-li {
              border-bottom: 2px solid $topic_color;
            }
          }
        }
      }
    }
  }
  .content {
    /*头部广告  */
    .ad-box{
        position:relative;
        margin-top: .8rem;
        width: 100%;
        height: 20%;
        overflow:hidden;
        img{  
          width: 100%;
        }
        span{
            display:inline-block;
            padding: 0.1rem;
            background-color: #636363;
            border-radius: 50%;
            font-size: 0.2rem;
            color:#ccc;
            position: absolute;
            top:5%;
            right:2%;
        }
    }

    .article-box {
      margin-bottom: .3rem;
      .article-img-box {
        width: 100%;
        height: 3rem;
        overflow: hidden;
        .article-img {
          width: 100%;
          position: relative;
          top: -.5rem;
        }
      }
      .article-author {
        width: 90%;
        color: #777;
        font-size: .35rem;
        margin: 0 auto;
        padding: .2rem 0;
        border-bottom: 1px solid #efefef;
      }
    }
  }
</style>
