<template>
  <div class="sport">
      <div style="height:.8rem"></div>
    <div>
        <ul
        v-infinite-scroll="loadMore"
        infinite-scroll-disabled="loading"
        infinite-scroll-distance="10">
        <li v-for="item in spoTagArt">
              <!--每个头像上的灰条  -->
             <div class="line"></div>
            <list :item="item" :folBoxVisible="item.user_id === uinfo.user_id ? false:true"></list>
        </li>
      </ul>   
      <div style="height:1rem"></div>   
    </div>
  </div>
</template>
<script>
import list from './list'
import axios from 'axios'
import {mapState, mapMutations} from 'vuex'
import nprogress from 'nprogress'
export default {
  data () {
    return {
      loading: false
    }
  },
  computed: {
    ...mapState([
      'spoTagArt',
      'spoTagLastPage', // 其他标签页面文章最后一页
      'spoTagArticleNum', // 其他标签页面文章总数
      'spoTagCurPage',
      'uinfo'
    ])
  },
  methods: {
    ...mapMutations(['setSpoarticle']),
    loadMore () {
      this.loading = true
      nprogress.start()
      setTimeout(() => {
      // 滚动到底部请求数据
        axios.get('api/distag', {
          params: {
            page: this.spoTagCurPage,
            tag_content: '纪实'
          }
        }).then((response) => {
          console.log(response)
          // 调用 mutations的setUarticle方法，将获取到的文章添加到uarticle
          this.setSpoarticle(response.data.$user_article)
          if (this.spoTagCurPage <= this.spoTagLastPage) {
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
  components: {
    list
  },
  // 每次路由进来 清空存储数据，并请求数据
  beforeRouteEnter (to, from, next) {
    next(vm => {
        // 若还未加载文章，发送请求
      if (vm.spoTagArt.length === 0) {
        axios.get('/api/distag', {
          params: {
            tag_content: '纪实'
          }
        }).then((response) => {
          console.log(response)
          if (response.data.status === 1) {
            vm.setSpoarticle(response.data.$user_article)
            next()
          }
        }).catch((error) => {
          console.log(error)
        })
      } else {
        if (vm.spoTagCurPage <= vm.spoTagLastPage) {
          vm.loading = false
        }
        next()
      }
    })
  }
}
</script>
<style>
.line{
  height:.6rem;
  background-color: #F0F0F0;
}
</style>