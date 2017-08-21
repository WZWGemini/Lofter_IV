<template>
  <!-- 添加关注 页面 -->
  <div class="tag">

    <!-- 顶部固定导航栏 -->
    <div fixed class="top-nav">
      <router-link to="/lofter/home/follow" class="top-icon">
        <span class="mintui mintui-back"></span>
      </router-link>
       <mt-search v-model="value" placeholder="搜索" class="top-search"></mt-search> 
       <router-link to="" @click.native="follow()" class="follow_class"><span>+</span> 关注</router-link> 
    </div>
    
    <!-- 内容盒子 -->
    <div class="content">

      <!-- 关注内容盒子 -->
       <div class="follow-list">
        <div class="follow-box" v-for="tagarticle in tagArticleInfo[0]">
            <div class="user-info">
              <div class="user-head"><img src="../assets/img/user_head.jpg"></div>              
              <div class="user-left">
                <span class="user-name">{{tagarticle.user_name}}</span>
                <span class="user-like">被喜欢
                    <span class="user-like-d">3158</span>
                次</span>
              </div>
              <div class="user-right">
                  <router-link to="" class="btn-follow">关 注</router-link>
              </div>
            </div>
            <div class="user-album">
               <div class="img-box" v-for="item in JSON.parse(tagarticle.article_img)"> 
                 <img :src="item"> 
              </div>
            </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
// import {Toast} from 'mint-ui'
import {mapState, mapMutations} from 'vuex'
export default {
  name: 'tag',
  components: {

  },
  data () {
    return {
      follow_class: '',
      value: ''
    }
  },
  computed: {
    ...mapState(['uinfo', 'tagArticleInfo']),
    showFollowStatus: function () {
      // return this.follow_class == 'follow_class' ? '取消关注' : '关注'
    }
  },
  // beforeRouteEnter (to, from, next) {
  //   // 由于beforeRouteEnter钩子 在组件被创造之前被调用，所以无法使用this获取组件定义的方法计算属性等
  //   // 要使用next(vm => {}) 就可以获取
  //   next(vm => {
  //     if (from.path === '/tag/:tag_id') {
  //       console.log('hahaha')
  //       // console.log(vm.hasLogin)
  //       // 判断是否有登录
  //       if (vm.hasLogin) {
  //         next()
  //       } else {
  //         next({ path: '/login' })
  //       }
  //     }
  //   })
  // },
  mounted () {
    this.init()
  },
  methods: {
    ...mapMutations(['tagArticleSave']),
    init: function () {
      let tagId = this.$route.params.tag_id
      this.$http.get('/api/tag/' + tagId)
        .then((rtnD) => {
          this.tagArticleSave(rtnD.data.rtn)
          // console.log(this.article_info)
        })
    },
    follow: function () {
    // console.log(localStorage.getItem)
    //   // 获取user_id
    //   if (localStorage.getItem('user_id') > 0) {
    //     // tag_id
    //     let tag_id = this.$route.params.user_id
    //     let user_id = localStorage.getItem('user_id')
    //     this.$http.post('/public/follow',{tag_id,user_id})
    //       .then((rtnD)=>{
    //         // 已关注
    //         if (rtnD.data.has_follow>0) {
    //           this.follow_class = 'follow_class'
    //         } else {
    //           this.follow_class = 'follow_class_d'
    //         }
    //       })
    //   } else {
    //     Toast('没有登录')
    //   }
    }
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style lang="scss">
  @import '../assets/common.scss';
  /* CSS Document */

  .addFollow, .follow-list {
    background-color: #efefef;
    font-size: .3rem;   
  }

  // 顶部固定导航栏
  .top-nav{
    color: $topic_color;
    background-color: #fff;
    font-size: .3rem;
    height: .8rem;
    position: fixed;
    width: 100%;
    .top-icon {
      display: inline-block;
      height: 100%;
      float: left;
      font-weight: 600;
      span {
        color: $topic_color;
        padding: .25rem .2rem .5rem;
        float: left;
      }
    }
    .top-search {
      width: 65%;
      display: inline-block;
      margin-top: 4px;
      margin-right: .2rem;
      float: left;
      .mint-searchbar {
        padding: 0;
        background-color: #fff;
        .mint-searchbar-inner {
          background-color: #efefef;
          border-radius: .3rem;
          i {
            font-size: .3rem;
            color: $topic_color;
            margin-right: .1rem;
          }
          input {
            color: $topic_color;
            background-color: #efefef;
          }
        }
        .mint-searchbar-cancel {
          color: #777;
        }
      }
    }
    .follow_class {
      float: left;
      color: #fff;
      padding: .1rem;
      margin-top: .13rem;
      background-color: $topic_color;
      span {
        font-weight: 600;
      }
    }
  }

  .content {
    width: 100%;
    padding-top: .8rem;
  }

  .follow-box {
    margin: .2rem 0 .1rem;
    background-color: #fff;
    font-size: .2rem;  
    display: inline-block;
    width: 100%;
    .user-info {
      width: 100%;
      display: inline-block;   
      .user-head {
        width: .8rem;
        height: 0;
        padding-bottom: .8rem;
        overflow: hidden;
        border: 1px solid #fff;
        border-radius: 50%;
        display: inline-block;
        float: left;
        margin: .15rem .2rem 0;
        img{
          width: .8rem;
          float: left;
        }
      }
      .user-left {
        width: 20%;
        float: left;
        .user-name {
          font-size: .3rem;
          display: inline-block;
          float: left;
          padding-top: .25rem;    
        }
        .user-like {
          font-size: .2rem;
          display: inline-block;
          float: left;
          color: #777;
        }
      }
      .user-right {
        float: right;
        font-size: .25rem;
        padding-top: .4rem;
        .btn-follow {
          color: red;
          border-radius: .3rem;
          border: 1px solid red;
          padding: .1rem .2rem;
          margin-right: .35rem;
        }
      }
    }

    .user-album {
      width: 100%;
      // clear: both;
      display: inline-block;
      img {
        width: 32%;
        float: left;
        margin: .03rem 0 0 .03rem;
      }
    }
  }
  
</style>
