<template>
  <!--主页  -->
  <div class="shome">
    <shead></shead>
    <div class="null"></div>
    <div class="content">
      <!--内容  -->
      <div class="fol-list">
        <ul>
          <li v-for="goods in shomeInfo[0]">
            <div class="article-box">
              <router-link :to="'/sgoods/'+goods.shop_id">
                <div class="article-img-box">
                  <img :src="JSON.parse(goods.shop_img)" class="article-img">
                </div>
                <div class="article-author" >
                  <span class="tip">作者：</span>
                  <span class="user-name">{{goods.user_name}}</span>
                </div>
              </router-link> 
            </div>
          </li>
        </ul>
        <!--解决底部导航栏挡住内容问题  -->
        <div style="height:1rem">
        </div>
      </div>
    </div>
    <foot></foot>
  </div>
</template>
<script>
// 引入进度条插件 nprogress
import nprogress from 'nprogress'
import axios from 'axios'
import {mapMutations, mapState} from 'vuex'
import shead from './home_top_nav'
import foot from './home_bottom_nav'
export default{
  name: 'shome',
  data () {
    return {
    }
  },
  components: {
    shead,
    foot
  },
  computed: {
    ...mapState(['shomeInfo'])
  },
  mounted () {
    this.init()
  },
  methods: {
    ...mapMutations(['shomeInfoSave']),
    init: function () {
      this.$http.get('/api/shop')
        .then((rtnD) => {
          console.log(rtnD.data.rtn.data)
          // this.shop_list = rtnD.data.rtn.data
          this.shomeInfoSave(rtnD.data.rtn.data)
        })
    },
    loadMore () {
      this.loading = true
      nprogress.start()
      setTimeout(() => {
      // 滚动到底部请求数据
        axios.get('api/concern', {
          params: {
            page: this.allCurPage,
            user_id: this.uinfo.user_id
          }
        }).then((response) => {
          // console.log(response)
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
  }
}
</script>

<style scoped lang='scss'>
@import '../../assets/common.scss';
.shome{
  height: 100%;
}
/*内容列表  */
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
</style>