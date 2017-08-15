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
<style lang="scss">
@import "../../assets/common.scss";

.follow{
  width: 100%;
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
}
</style>