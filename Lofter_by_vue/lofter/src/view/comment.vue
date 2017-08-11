<template>
  <!-- 评论页面 -->
  <div class="comment">

    <!-- 顶部固定导航栏 -->
     <mt-header fixed class="top-nav" title="评论">
      <router-link to="/" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
    </mt-header> 
    
    <!-- 内容盒子 -->
    <div class="content">

        <!-- 评论列表 -->
        <ul class="comment-list">
            <li>
                <div class="user-header"><img src="../assets/img/user_head.jpg"></div>
                <div class="comment-right">
                    <div class="comment-top">
                        <span class="user-name">啊哈哈</span>
                        <span class="create-time">1天前</span>
                    </div>
                    <span class="comment-content">哈哈哈</span>
                </div>
                
            </li>
            <li>
                <div class="user-header"><img src="../assets/img/user_head.jpg"></div>
                <div class="comment-right">
                    <div class="comment-top">
                        <span class="user-name">啊哈哈</span>
                        <span class="create-time">1天前</span>
                    </div>
                    <span class="comment-content">哈哈哈</span>
                </div>
                
            </li>
        </ul>
    </div>

    <!-- 底部固定发布栏 -->
    <div class="bottom-box clear">
        <div class="bottom-left">
            <mt-field placeholder="发表评论" v-model="comment_content" class="input-class"></mt-field>
        </div>
         <div class="bottom-right"> 
            <router-link to="/" class="send">发送</router-link>
         </div> 
    </div>
  </div>
</template>

<script>
export default {
  name: 'comment',
  data () {
    return {
      comment_content: ''
    }
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
    border-bottom: 1px solid $topic_color;
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
    border-top: 1px dotted $topic_color;
      position: absolute;
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
