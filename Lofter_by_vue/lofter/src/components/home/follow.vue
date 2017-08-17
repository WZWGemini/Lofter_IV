<template>
    <div class="follow">
      <!--顶部广告照片  -->
        <header  v-show='showHeadImg'>
            <span class="icon-cross" @click='showSheet()'>
            </span>
            <img src="../../assets/img/copyright_watermark_sample.png">
            <mt-actionsheet
              :actions="actions"
              v-model="sheetVisible">
            </mt-actionsheet>
        </header>
          <!--内容  -->
        <div class="fol-list">
          <!-- mint 下拉刷新 -->
            <ul
            v-infinite-scroll="loadMore"
            infinite-scroll-disabled="loading"
            infinite-scroll-distance="10">
              <li v-for="val in allArticle">
                <!-- 为了方便后续 -->
                <list :item = val></list>
              </li>
            </ul>
            <!--解决底部导航栏挡住内容问题  -->
            <div style="height:1rem">
            </div>
        </div>
    </div>    
</template>
<script>
// 引入进度条插件 nprogress
import nprogress from 'nprogress'
// 引入模版list
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
      loading: true // 无限刷新锁
    }
  },
  computed: {
    ...mapState(['allArticle', 'totalAllArtNum', 'allLastPage', 'allCurPage', 'allArticleNum'])
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
      nprogress.start()
      setTimeout(() => {
      // 滚动到底部请求数据
        axios.get('api/article', {
          params: {
            page: this.allCurPage
          }
        }).then((response) => {
          // 调用 mutations的setUarticle方法，将获取到的文章添加到uarticle
          this.setAllArticle(response.data.$user_article)
          if (this.allCurPage <= this.allLastPage) {
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
      if (to.path === '/lofter/home/follow') {
        // 发送请求
        console.log(vm.totalAllArtNum)
        if (vm.totalAllArtNum === 0) {
          axios.get('/api/article', {

          }).then((response) => {
            console.log(response)
            if (response.data.status === 1) {
              vm.setAllArticle(response.data.$user_article)
              vm.loading = false
              next()
            }
          }).catch((error) => {
            console.log(error)
          })
        } else {
          if (vm.allCurPage <= vm.allLastPage) {
            vm.loading = false
          }
          next()
        }
      }
    })
  }
}
</script>
<style lang="scss">
@import "../../assets/common.scss";

.follow{
  margin-top: 2px;
    height: 100%;
    /*头部  */
    header{
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
    .line{
      height:.6rem;
      background-color: #F0F0F0;
    }

    /*内容列表  */
    .content-list-box{
      width: 100%;
      .top{
        overflow: hidden;
        line-height: .9rem;
        font-size: 0.2rem;
        padding:0 3%; 
        width:94%;
        height: 20%;
        ul{
          overflow: hidden;
          li{
            list-style:none;
            float:left;
            img{
              width: 100%;
            }
          }
          .head-img{
            width: .7rem;
            height: 0;
            padding-bottom: .7rem;
            margin-top: .15rem;
            border-radius: 50%;
            overflow: hidden;
            img {
              width: .7rem;
            }
          }
          .user-name{
            width: 30%;
            padding-left:5%; 
            font-size: .3rem;
            line-height: 1rem;
          }
          .time{
            color: #ccc;
            padding-left: 20%; 
            width: 20%;
            font-size: .2rem;
            line-height: 1rem;
            float: right;
          }
        }
      }
      .mid{
        width: 100%;

        img{
          display:inline-block;
          width: 100%;
          height: auto;
        }
        .content{
          margin: 0 3%;
          border-left: 2px solid #ccc;
        }
        .tag{  
          margin: 0 5%;
          border-bottom: 1px dashed #888;
          span{
            padding:0 .1rem;
            font-size: .3rem;
            color:#888;
          }
        }
      }
      .foot{
        margin-top:3%; 
        .btn-box{
          margin-bottom: 2%;
          font-size: .3rem;
          color:#9e9e9e;
          span{
            margin-left: 10%;
          }
          .heart{

          }
          .dot{
            margin-left:25% 
          }
        }
        .comment{
          dt{
            margin-left:7%;
            color:#777;
            font-size:.22rem;
          }
          dd{
            margin: .1rem 0;
            margin-left:7%;
            font-size: .25rem;
            .comment-user {
              color: $topic_color;
              font-weight: 600;
            }
            .comment-content, .comment-colon {
              color: #777;
              font-size: .23rem;
            }
          }
        }
      }
    } 
}
</style>