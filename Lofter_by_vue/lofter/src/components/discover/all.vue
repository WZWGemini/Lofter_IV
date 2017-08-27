<template>
  <!-- 发现详情页面 -->
  <div class="all">
    <div style="height:.8rem"></div>
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
      <ul
      v-infinite-scroll="loadMore"
      infinite-scroll-disabled="loading"
      infinite-scroll-distance="10">
        <li v-for="(item,index) in disAllArt"  v-if="JSON.parse(item.article_img).length!==0">
          <div class="article-box" >
              <a @click="setArtIndexp(item)" >
                <div class="article-img-box">
                  <img :src="JSON.parse(item.article_img)[0]" class="article-img">
                </div>
                <div class="article-author">
                  <span class="tip">作者：</span>
                  <span class="user-name">{{item.user_name}}</span>
                </div>
              </a>          
          </div>
        </li>
      </ul>
    </div>
    <!--解决底部导航栏挡住内容问题  -->
    <div style="height:1rem">
    </div>
  </div>
</template>
      
<script>
  // 引入进度条插件 nprogress
import nprogress from 'nprogress'
import axios from 'axios'
import {mapMutations, mapState} from 'vuex'
export default{
    name: 'homeFollow',
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
      ...mapState([
        'disAllArt', // 已加载文章 []
        'disAllLastPage', // 该页面api返回最后一页
        'disAllArticleNum', // 该页面api返回的所有文章数目
        'disAllCurPage' // 该页面下次加载的第几页 num
      ])
    },
    methods: {
      ...mapMutations(['setDisAllarticle', 'setArtIndex']),
      showSheet () {
        this.sheetVisible = true
      },
      setArtIndexp (item) {
        this.setArtIndex(item)
        this.$router.push('/onearticle')
      },
      closeHeadImg () {
        this.showHeadImg = false
      },
      loadMore () {
        this.loading = true
        nprogress.start()
        setTimeout(() => {
        // 滚动到底部请求数据
          axios.get('api/article', {
            params: {
              page: this.disAllCurPage
            }
          }).then((response) => {
            console.log(response)
            // 调用 mutations的setUarticle方法，将获取到的文章添加到uarticle
            this.setDisAllarticle(response.data.$user_article)
            if (this.disAllCurPage <= this.disAllLastPage) {
              this.loading = false
            } else {
              this.loading = true
              this.$toast('已经到底了！')
            }
            nprogress.done()
          }).catch((error) => {
            console.log(error)
          })
        }, 1000)
      }
    },
      // 使用导航钩子 检查跳转
    beforeRouteEnter (to, from, next) {
      next(vm => {
        // 每次进入检查
        if (to.path === '/lofter/discover/all') {
          // 若还未加载文章，发送请求
          if (vm.disAllArt.length === 0) {
            axios.get('/api/article', {
              params: {

              }
            }).then((response) => {
              console.log(response)
              if (response.data.status === 1) {
                vm.setDisAllarticle(response.data.$user_article)
                next()
              }
            }).catch((error) => {
              console.log(error)
            })
          } else {
            if (vm.disAllCurPage <= vm.disAllLastPage) {
              vm.loading = false
            }
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
  .content {
    /*头部广告  */
    .ad-box{
        position:relative;
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
      