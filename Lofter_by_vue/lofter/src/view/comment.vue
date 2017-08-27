<template>
  <!-- 评论页面 -->
  <div class="comment">

  <!-- 顶部固定导航栏 -->
   <mt-header fixed class="top-nav" title="评论">
    <router-link to="" @click.native="$router.go(-1)" slot="left">
    <mt-button icon="back"></mt-button>
    </router-link>
  </mt-header> 
  
  <!-- 内容盒子 -->
  <div class="content">

    <!-- 评论列表 -->
    <ul class="comment-list">
      <li v-for="item in this.curComment.articleComment">
        <div class="user-header"><img src="../assets/img/user_head.jpg"></div>
        <div class="comment-right">
          <div class="comment-top">
            <span class="user-name">{{item.user_name}}</span>
            <span class="create-time">{{item.comment_time}}</span>
          </div>
          <span class="comment-content">{{item.comment_content}}</span>
        </div>
      </li>
      <!--解决底部导航栏挡住内容问题  -->
      <div style="height:1rem">
      </div>
    </ul>
  </div>
  <!-- 底部固定发布栏 -->
  <div class="bottom-box clear">
    <div class="bottom-left">
      <mt-field placeholder="发表评论" v-model="comment_content" class="input-class"></mt-field>
    </div>
     <div class="bottom-right"> 
        <a @click="sendComment()" class="send">发送</a>
     </div> 
  </div>
  </div>
</template>

<script>
import {mapState} from 'vuex'
// import {toast} from 'mint-ui'
import axios from 'axios'
export default {
  name: 'comment',
  data () {
    return {
      comment_content: ''
    }
  },
  methods: {
    sendComment: function () {
      if (this.comment_content !== '') {
        axios.post('/api/comment', {
          user_id: this.uinfo.user_id,
          article_id: this.curComment.article_id,
          comment_content: this.comment_content
        }).then((response) => {
          this.$toast(response.data.msg)
          console.log(response)
          if (response.data.status === 1) {
            // 数据库操作成功，则将对应store中的articleComment改变
            axios.get('/api/comment', {
              params: {
                article_id: this.curComment.article_id
              }
            }).then((response) => {
              // console.log(response)
              // console.log(this.curComment.articleComment)
              // 将返回的数据赋值给curComment 使评论页面同步
              this.curComment.articleComment = response.data.rtn
            }).catch((error) => {
              console.log(error)
            })
          } else {
          }
        }).catch((error) => {
          console.log(error)
        })
      } else {
        this.$toast('内容不能为空！')
      }
    }
  },
  computed: {
    ...mapState(['curComment', 'uinfo', 'hasLogin'])
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      if (vm.hasLogin) {
        // 通过 `vm` 访问组件实例
        console.log(to)
        console.log(from)
        vm.backUrl = from.path
        next()
      } else {
        vm.$toast('请先登陆！')
        next('/login')
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
  font-size: .3rem;
  height: .8rem;
  border-bottom: 1px solid $topic_hcolor;
  }

  .comment-list {
  padding-top: .8rem; 
    li {
    float: left;
    width: 100%;
      .user-header {
      width: .6rem;
      height: 0;
      padding-bottom: .6rem;
      overflow: hidden;
      border: 1px solid #fff;
      border-radius: 50%;
      display: inline-block;
      margin: .25rem .2rem .1rem;
      float: left;
      img {
        width: .6rem;
        float: left;
      }
      }
      .comment-right {
      float: left;
      width: 80%;
      padding-bottom: .15rem;
      border-bottom: 1px solid #ccc;
      .comment-top {
        color: #777;
        font-size: .25rem;
        margin-top: .27rem;
        .create-time {
          float: right;
        }
      }
      .comment-content {
        margin-top: .1rem;
        font-size: .3rem;
        float: left;
      }
      }
    }
  }

  .bottom-box {
    background-color: #fff; 
    border-top: 1px dotted $topic_hcolor;
    position: fixed;
    bottom: 0;
    width: 100%;
    .bottom-left {
      width: 80%;
      margin: 0;
      float: left;
      .input-class {
        color: $topic_hcolor;
        input {
          background-color: $topic_color;
        }
      }
    }
    .bottom-right {
      float: right;
      margin-top: .25rem;
      padding-right: .4rem;
      .send {
        font-size: .25rem;
        color: $topic_hcolor;
        float: right;
      }
    }
  }
</style>
